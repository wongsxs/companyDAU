<?php
$adminTitle = 'Integrasi Cloudflare D1';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/CloudflareD1.php';

$appConfigFile = __DIR__ . '/../config/app.php';
$config = require $appConfigFile;
$d1 = $config['cloudflare_d1'] ?? [];

$statusMsg = '';
$statusType = 'info';

// Proses Aksi
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // 1. Simpan Kredensial
    if ($action === 'save_credentials') {
        $accId = trim($_POST['account_id'] ?? '');
        $dbId = trim($_POST['database_id'] ?? '');
        $token = trim($_POST['api_token'] ?? '');
        $driverChoice = trim($_POST['db_driver'] ?? 'sqlite');

        $content = file_get_contents($appConfigFile);
        $content = preg_replace("/'account_id'\s*=>\s*'.*?'/", "'account_id' => '{$accId}'", $content);
        $content = preg_replace("/'database_id'\s*=>\s*'.*?'/", "'database_id' => '{$dbId}'", $content);
        $content = preg_replace("/'api_token'\s*=>\s*'.*?'/", "'api_token' => '{$token}'", $content);
        $content = preg_replace("/'db_driver'\s*=>\s*'.*?'/", "'db_driver' => '{$driverChoice}'", $content);
        file_put_contents($appConfigFile, $content);

        $statusMsg = 'Konfigurasi Cloudflare D1 berhasil disimpan!';
        $statusType = 'success';
        $config = require $appConfigFile;
        $d1 = $config['cloudflare_d1'] ?? [];
    }

    // 2. Test Koneksi
    if ($action === 'test_connection') {
        try {
            $client = new CloudflareD1($d1['account_id'] ?? '', $d1['database_id'] ?? '', $d1['api_token'] ?? '');
            $res = $client->sendD1Request("SELECT datetime('now') AS cloud_time;");
            $cloudTime = $res['result'][0]['results'][0]['cloud_time'] ?? '-';
            $statusMsg = "Koneksi ke Cloudflare D1 SUKSES! Waktu server Cloudflare Edge: {$cloudTime}";
            $statusType = 'success';
        } catch (Exception $e) {
            $statusMsg = "Koneksi Gagal: " . $e->getMessage();
            $statusType = 'error';
        }
    }

    // 3. Migrasi & Seeding Data ke Cloudflare D1
    if ($action === 'migrate_seed') {
        try {
            $client = new CloudflareD1($d1['account_id'] ?? '', $d1['database_id'] ?? '', $d1['api_token'] ?? '');

            // Buat Tabel
            $client->sendD1Request("CREATE TABLE IF NOT EXISTS categories (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                slug TEXT NOT NULL UNIQUE,
                description TEXT,
                icon TEXT DEFAULT 'sparkles'
            );");

            $client->sendD1Request("CREATE TABLE IF NOT EXISTS products (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                category_id INTEGER NOT NULL,
                name TEXT NOT NULL,
                slug TEXT NOT NULL UNIQUE,
                short_desc TEXT,
                description TEXT,
                price_retail INTEGER DEFAULT 0,
                price_wholesale INTEGER DEFAULT 0,
                min_wholesale_qty INTEGER DEFAULT 12,
                material TEXT,
                length_size TEXT,
                durability TEXT,
                stock_status TEXT DEFAULT 'Ready Stock',
                image TEXT,
                is_featured INTEGER DEFAULT 0,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            );");

            $client->sendD1Request("CREATE TABLE IF NOT EXISTS messages (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                company_name TEXT,
                email TEXT,
                phone TEXT NOT NULL,
                type TEXT DEFAULT 'Pertanyaan Umum',
                message TEXT NOT NULL,
                status TEXT DEFAULT 'unread',
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            );");

            $client->sendD1Request("CREATE TABLE IF NOT EXISTS admins (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                username TEXT NOT NULL UNIQUE,
                password TEXT NOT NULL,
                name TEXT NOT NULL,
                role TEXT DEFAULT 'admin',
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP
            );");

            // Seed Kategori
            $client->sendD1Request("INSERT OR IGNORE INTO categories (id, name, slug, description, icon) VALUES (?, ?, ?, ?, ?)", [
                1, 'Aneka Sapu', 'aneka-sapu', 'Sapu ijuk, rayung, nilon, lidi, dan sapu industri.', 'brush'
            ]);
            $client->sendD1Request("INSERT OR IGNORE INTO categories (id, name, slug, description, icon) VALUES (?, ?, ?, ?, ?)", [
                2, 'Aneka Pel Lantai', 'aneka-pel-lantai', 'Pel katun daya serap tinggi, microfiber, dan spin mop.', 'sparkles'
            ]);

            // Seed Admin
            $hash = password_hash('admin123', PASSWORD_DEFAULT);
            $client->sendD1Request("INSERT OR IGNORE INTO admins (username, password, name, role) VALUES (?, ?, ?, ?)", [
                'admin', $hash, 'Administrator Pabrik', 'superadmin'
            ]);

            // Copy data dari SQLite lokal jika ada
            $localDbPath = __DIR__ . '/../../database/database.sqlite';
            if (file_exists($localDbPath)) {
                $localPdo = new PDO("sqlite:" . $localDbPath);
                $localProducts = $localPdo->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($localProducts as $p) {
                    $client->sendD1Request("INSERT OR REPLACE INTO products (
                        id, category_id, name, slug, short_desc, description,
                        price_retail, price_wholesale, min_wholesale_qty,
                        material, length_size, durability, stock_status,
                        image, is_featured
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", [
                        $p['id'], $p['category_id'], $p['name'], $p['slug'], $p['short_desc'], $p['description'],
                        $p['price_retail'], $p['price_wholesale'], $p['min_wholesale_qty'],
                        $p['material'], $p['length_size'], $p['durability'], $p['stock_status'],
                        $p['image'], $p['is_featured']
                    ]);
                }
            }

            $statusMsg = "Migrasi & Pengisian 12 Produk ke Cloudflare D1 Berhasil! Semua data kini telah tersimpan di cloud Cloudflare.";
            $statusType = 'success';
        } catch (Exception $e) {
            $statusMsg = "Migrasi Gagal: " . $e->getMessage();
            $statusType = 'error';
        }
    }
}
?>

<div class="space-y-8 max-w-4xl mx-auto">
  
  <div>
    <h1 class="text-2xl font-black text-slate-900 flex items-center gap-2">
      <span class="w-8 h-8 rounded-lg bg-orange-500 text-white flex items-center justify-center text-sm font-bold shadow">
        ⚡
      </span>
      Integrasi Cloudflare D1 (Serverless SQL Database)
    </h1>
    <p class="text-xs text-slate-500 mt-1">
      Hubungkan website Company Profile ini ke database cloud terdistribusi global dari Cloudflare.
    </p>
  </div>

  <?php if ($statusMsg): ?>
    <div class="p-4 rounded-2xl text-xs sm:text-sm font-medium flex items-center gap-3 <?= $statusType === 'success' ? 'bg-emerald-50 text-emerald-800 border border-emerald-300' : ($statusType === 'error' ? 'bg-red-50 text-red-800 border border-red-300' : 'bg-sky-50 text-sky-800 border border-sky-300') ?>">
      <span><?= $statusType === 'success' ? '✓' : 'ℹ' ?></span>
      <p><?= sanitize($statusMsg) ?></p>
    </div>
  <?php endif; ?>

  <!-- Card Status Driver Aktif -->
  <div class="bg-white rounded-3xl border border-slate-200 p-6 shadow-xs flex flex-col sm:flex-row items-center justify-between gap-4">
    <div>
      <span class="text-xs text-slate-400 font-bold uppercase tracking-wider">Driver Database Aktif Saat Ini:</span>
      <div class="flex items-center gap-2 mt-1">
        <span class="text-lg font-black text-slate-900 uppercase">
          <?= htmlspecialchars($config['db_driver'] ?? 'sqlite') ?>
        </span>
        <?php if (($config['db_driver'] ?? '') === 'cloudflare_d1'): ?>
          <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-orange-100 text-orange-800 border border-orange-200">
            Terhubung ke Cloudflare Cloud
          </span>
        <?php elseif (($config['db_driver'] ?? '') === 'mysql'): ?>
          <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-100 text-blue-800">
            MySQL / XAMPP
          </span>
        <?php else: ?>
          <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-700">
            SQLite Lokal (Default)
          </span>
        <?php endif; ?>
      </div>
    </div>

    <!-- Quick Action Buttons -->
    <div class="flex items-center gap-2">
      <form method="POST">
        <input type="hidden" name="action" value="test_connection">
        <button type="submit" class="px-4 py-2.5 bg-slate-900 hover:bg-slate-800 text-white rounded-xl text-xs font-bold shadow transition">
          Uji Tes Koneksi
        </button>
      </form>

      <form method="POST" onsubmit="return confirm('Apakah Anda ingin memigrasi tabel & data produk ke database Cloudflare D1 sekarang?')">
        <input type="hidden" name="action" value="migrate_seed">
        <button type="submit" class="px-4 py-2.5 bg-orange-600 hover:bg-orange-500 text-white rounded-xl text-xs font-bold shadow transition">
          Migrasi &amp; Isi Data ke D1
        </button>
      </form>
    </div>
  </div>

  <!-- Form Pengaturan Kredensial -->
  <div class="bg-white rounded-3xl border border-slate-200 p-8 shadow-xs space-y-6">
    <h2 class="text-base font-black text-slate-900 border-b border-slate-100 pb-3">
      Pengaturan API Cloudflare D1
    </h2>

    <form method="POST" class="space-y-4">
      <input type="hidden" name="action" value="save_credentials">

      <div class="space-y-1">
        <label class="text-xs font-bold text-slate-700">Pilihan Driver Database Utama</label>
        <select name="db_driver" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-300 text-xs font-bold bg-slate-50">
          <option value="cloudflare_d1" <?= ($config['db_driver'] ?? '') === 'cloudflare_d1' ? 'selected' : '' ?>>Cloudflare D1 (Serverless Cloud Database)</option>
          <option value="sqlite" <?= ($config['db_driver'] ?? '') === 'sqlite' ? 'selected' : '' ?>>SQLite Lokal (database/database.sqlite)</option>
          <option value="mysql" <?= ($config['db_driver'] ?? '') === 'mysql' ? 'selected' : '' ?>>MySQL (XAMPP / localhost)</option>
        </select>
      </div>

      <div class="space-y-1">
        <label class="text-xs font-bold text-slate-700">Cloudflare Account ID *</label>
        <input type="text" name="account_id" value="<?= htmlspecialchars($d1['account_id'] ?? '') ?>" placeholder="Contoh: a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6" class="w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono">
      </div>

      <div class="space-y-1">
        <label class="text-xs font-bold text-slate-700">Cloudflare D1 Database ID *</label>
        <input type="text" name="database_id" value="<?= htmlspecialchars($d1['database_id'] ?? '') ?>" placeholder="Contoh: 12345678-abcd-ef01-2345-6789abcdef01" class="w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono">
      </div>

      <div class="space-y-1">
        <label class="text-xs font-bold text-slate-700">Cloudflare API Token (Permission: D1 Edit) *</label>
        <input type="password" name="api_token" value="<?= htmlspecialchars($d1['api_token'] ?? '') ?>" placeholder="Token rahasia Cloudflare API Anda" class="w-full px-3.5 py-2.5 rounded-xl border text-xs font-mono">
      </div>

      <div class="pt-4 border-t border-slate-100 flex justify-end">
        <button type="submit" class="px-6 py-2.5 bg-sky-600 hover:bg-sky-500 text-white rounded-xl text-xs font-bold shadow transition">
          Simpan Konfigurasi
        </button>
      </div>
    </form>
  </div>

  <!-- Panduan Cara Mendapatkan Kredensial -->
  <div class="bg-slate-50 rounded-3xl border border-slate-200 p-8 space-y-4">
    <h3 class="text-sm font-black text-slate-900 uppercase tracking-wider">
      Cara Mendapatkan Account ID, Database ID &amp; API Token di Cloudflare:
    </h3>
    <ol class="text-xs text-slate-600 space-y-3 leading-relaxed list-decimal pl-4">
      <li>
        <strong>Login ke Cloudflare:</strong> Buka <a href="https://dash.cloudflare.com" target="_blank" class="text-sky-600 font-bold hover:underline">dash.cloudflare.com</a>.
      </li>
      <li>
        <strong>Buat Database D1:</strong> Di sidebar kiri, buka menu <strong>Storage &amp; Databases</strong> ➔ <strong>D1</strong>. Klik tombol <strong>Create Database</strong>, beri nama misalnya <code class="bg-slate-200 px-1 py-0.5 rounded text-slate-900">web-alat-kebersihan</code>.
      </li>
      <li>
        <strong>Salin Database ID &amp; Account ID:</strong>
        Setelah database terbuat, Anda akan melihat <strong>Database ID</strong> (format UUID) dan <strong>Account ID</strong> di panel kanan dashboard. Salin keduanya ke form di atas.
      </li>
      <li>
        <strong>Buat API Token:</strong> Klik profil Anda di pojok kanan atas ➔ <strong>My Profile</strong> ➔ <strong>API Tokens</strong> ➔ Klik <strong>Create Token</strong> ➔ Pilih template <strong>Custom Token</strong> atau beri izin <em>Account: D1 (Edit)</em>. Klik <em>Continue to summary</em> dan <em>Create Token</em>. Salin token tersebut ke form di atas.
      </li>
      <li>
        <strong>Klik "Migrasi &amp; Isi Data ke D1":</strong> Sistem akan otomatis membuat tabel dan mengunggah ke-12 produk serta akun admin langsung ke Cloudflare!
      </li>
    </ol>
  </div>

</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
