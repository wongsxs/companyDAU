<?php
/**
 * Database Connection & Auto-Migration
 * Mendukung:
 * 1. SQLite (Default, Zero-Setup Lokal)
 * 2. MySQL (XAMPP / Server Tradisional)
 * 3. Cloudflare D1 (Serverless Database Global Cloud)
 */

require_once __DIR__ . '/CloudflareD1.php';
$config = require __DIR__ . '/app.php';

function getDbConnection() {
    static $connection = null;
    
    if ($connection !== null) {
        return $connection;
    }
    
    $config = require __DIR__ . '/app.php';
    $driver = $config['db_driver'] ?? 'sqlite';
    
    try {
        if ($driver === 'cloudflare_d1') {
            // Mode 1: Cloudflare D1 REST API
            $d1Config = $config['cloudflare_d1'] ?? [];
            $connection = new CloudflareD1(
                $d1Config['account_id'] ?? '',
                $d1Config['database_id'] ?? '',
                $d1Config['api_token'] ?? ''
            );
            return $connection;

        } elseif ($driver === 'mysql') {
            // Mode 2: MySQL (XAMPP / cPanel)
            $mysql = $config['mysql'];
            $dsn = "mysql:host={$mysql['host']};dbname={$mysql['database']};charset={$mysql['charset']}";
            $pdo = new PDO($dsn, $mysql['username'], $mysql['password'], [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]);
            $connection = $pdo;
            return $connection;

        } else {
            // Mode 3: Default SQLite Lokal (database/database.sqlite)
            $dbPath = __DIR__ . '/../database/database.sqlite';
            $isNewDb = !file_exists($dbPath);
            
            $pdo = new PDO("sqlite:" . $dbPath);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->exec('PRAGMA foreign_keys = ON;');
            
            if ($isNewDb || filesize($dbPath) === 0) {
                initSqliteDatabase($pdo);
            }
            $connection = $pdo;
            return $connection;
        }

    } catch (Exception $e) {
        die("<div style='font-family: sans-serif; padding: 2rem; background: #fee2e2; border: 1px solid #ef4444; border-radius: 8px; margin: 2rem; color: #991b1b;'>
            <h3 style='margin-top:0'>Koneksi Database Gagal ({$driver})!</h3>
            <p>" . htmlspecialchars($e->getMessage()) . "</p>
            <p><strong>Panduan:</strong> Cek pengaturan driver database Anda di file <code>config/app.php</code>.</p>
        </div>");
    }
}

function initSqliteDatabase(PDO $pdo) {
    $pdo->exec("CREATE TABLE IF NOT EXISTS categories (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        slug TEXT NOT NULL UNIQUE,
        description TEXT,
        icon TEXT DEFAULT 'sparkles'
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS products (
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
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS messages (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        company_name TEXT,
        email TEXT,
        phone TEXT NOT NULL,
        type TEXT DEFAULT 'Pertanyaan Umum',
        message TEXT NOT NULL,
        status TEXT DEFAULT 'unread',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS admins (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL,
        name TEXT NOT NULL,
        role TEXT DEFAULT 'admin',
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    )");
}
