<?php
/**
 * Cloudflare D1 Database Driver & PDO Emulation Layer
 * Memungkinkan aplikasi PHP menjalankan query SQL langsung ke Cloudflare D1 Serverless Database
 */

class CloudflareD1 {
    private string $accountId;
    private string $databaseId;
    private string $apiToken;
    private ?int $lastInsertId = null;

    public function __construct(string $accountId, string $databaseId, string $apiToken) {
        $this->accountId = trim($accountId);
        $this->databaseId = trim($databaseId);
        $this->apiToken = trim($apiToken);
    }

    public function query(string $sql) {
        $stmt = new CloudflareD1Statement($this, $sql);
        $stmt->execute();
        return $stmt;
    }

    public function prepare(string $sql) {
        return new CloudflareD1Statement($this, $sql);
    }

    public function exec(string $sql): int {
        $stmt = $this->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function lastInsertId(): ?int {
        return $this->lastInsertId;
    }

    public function setLastInsertId(?int $id): void {
        $this->lastInsertId = $id;
    }

    public function sendD1Request(string $sql, array $params = []): array {
        if (empty($this->accountId) || empty($this->databaseId) || empty($this->apiToken)) {
            throw new Exception("Konfigurasi Cloudflare D1 belum lengkap! Harap isi Account ID, Database ID, dan API Token di file config/app.php.");
        }

        $url = "https://api.cloudflare.com/client/v4/accounts/{$this->accountId}/d1/database/{$this->databaseId}/query";

        // Konversi tipe data params untuk SQLite/D1
        $formattedParams = [];
        foreach ($params as $param) {
            if (is_int($param) || is_float($param) || is_string($param)) {
                $formattedParams[] = $param;
            } elseif (is_bool($param)) {
                $formattedParams[] = $param ? 1 : 0;
            } elseif ($param === null) {
                $formattedParams[] = null;
            } else {
                $formattedParams[] = (string)$param;
            }
        }

        $payload = json_encode([
            'sql' => $sql,
            'params' => $formattedParams
        ]);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$this->apiToken}",
            "Content-Type: application/json"
        ]);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curlError = curl_error($ch);
        curl_close($ch);

        if ($response === false) {
            throw new Exception("Gagal terhubung ke Cloudflare D1 API: {$curlError}");
        }

        $data = json_decode($response, true);
        if (!$data) {
            throw new Exception("Respon tidak valid dari Cloudflare D1 API (HTTP {$httpCode}): {$response}");
        }

        if (isset($data['success']) && $data['success'] === false) {
            $errMsg = "Cloudflare D1 Error: ";
            if (!empty($data['errors'])) {
                $errMsg .= json_encode($data['errors']);
            } else {
                $errMsg .= $response;
            }
            throw new Exception($errMsg);
        }

        return $data;
    }
}

class CloudflareD1Statement {
    private CloudflareD1 $d1;
    private string $sql;
    private array $results = [];
    private int $cursor = 0;
    private int $rowCount = 0;

    public function __construct(CloudflareD1 $d1, string $sql) {
        $this->d1 = $d1;
        $this->sql = $sql;
    }

    public function execute(array $params = []): bool {
        // Mendukung named parameters (:param) dengan mengonversinya ke positional (?)
        $parsedSql = $this->sql;
        $orderedParams = [];

        if (!empty($params) && !array_is_list($params)) {
            // Named parameters
            preg_match_all('/:([a-zA-Z0-9_]+)/', $this->sql, $matches);
            if (!empty($matches[1])) {
                foreach ($matches[1] as $name) {
                    $key = ":{$name}";
                    $val = $params[$key] ?? $params[$name] ?? null;
                    $orderedParams[] = $val;
                }
                $parsedSql = preg_replace('/:([a-zA-Z0-9_]+)/', '?', $this->sql);
            }
        } elseif (!empty($params)) {
            $orderedParams = array_values($params);
        }

        $response = $this->d1->sendD1Request($parsedSql, $orderedParams);

        if (!empty($response['result']) && is_array($response['result'])) {
            $firstResult = $response['result'][0];
            $this->results = $firstResult['results'] ?? [];
            $meta = $firstResult['meta'] ?? [];
            
            $this->rowCount = $meta['changes'] ?? count($this->results);
            if (isset($meta['last_row_id']) && $meta['last_row_id'] > 0) {
                $this->d1->setLastInsertId((int)$meta['last_row_id']);
            }
        } else {
            $this->results = [];
            $this->rowCount = 0;
        }

        $this->cursor = 0;
        return true;
    }

    public function fetch(?int $mode = null): mixed {
        if ($this->cursor < count($this->results)) {
            $row = $this->results[$this->cursor];
            $this->cursor++;
            return $row;
        }
        return false;
    }

    public function fetchAll(?int $mode = null): array {
        return $this->results;
    }

    public function fetchColumn(int $columnIndex = 0): mixed {
        $row = $this->fetch();
        if ($row !== false && is_array($row)) {
            $values = array_values($row);
            return $values[$columnIndex] ?? false;
        }
        return false;
    }

    public function rowCount(): int {
        return $this->rowCount;
    }
}
