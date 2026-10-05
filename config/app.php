<?php
/**
 * Konfigurasi Aplikasi & Profil Perusahaan
 * PT Bersih Prima Nusantara - Produsen Alat Kebersihan (Sapu & Pel Lantai)
 */

return [
    'app_name' => 'PT Bersih Prima Nusantara',
    'brand_name' => 'PrimaClean Nusantara',
    'tagline' => 'Produsen & Pabrik Alat Kebersihan Terpercaya di Indonesia',
    'sub_tagline' => 'Spesialis Produksi Aneka Sapu & Pel Lantai Kualitas Unggul Langsung dari Pabrik Tangan Pertama.',
    
    // Kontak & Pemesanan
    'phone' => '+62 812-3456-7890',
    'whatsapp_number' => '6281234567890',
    'email' => 'sales@bersihprimanusantara.co.id',
    'alt_email' => 'info@bersihprimanusantara.co.id',
    
    // Alamat & Operasional
    'address' => 'Kawasan Industri Sentra Kerajinan & Manufaktur, Jl. Raya Industri No. 88, Solo - Sukoharjo, Jawa Tengah 57552',
    'city' => 'Sukoharjo, Jawa Tengah',
    'country' => 'Indonesia',
    'operating_hours' => 'Senin - Sabtu: 08.00 - 17.00 WIB (Minggu & Libur Nasional Tutup)',
    'maps_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126497.64376176395!2d110.74866657805128!3d-7.601725737525301!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a16627b0c79ab%3A0x3027a76e352bb40!2sSukoharjo%2C%20Kabupaten%20Sukoharjo%2C%20Jawa%20Tengah!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid',
    
    // Statistik Manufaktur
    'stats' => [
        'experience_years' => '12+',
        'monthly_capacity' => '250.000+',
        'active_distributors' => '650+',
        'product_variants' => '30+'
    ],
    
    // ==========================================
    // PENGATURAN DATABASE ENGINE
    // Opsi: 'sqlite' (Lokal bawaan), 'mysql' (XAMPP), atau 'cloudflare_d1' (Cloudflare Cloud)
    // ==========================================
    'db_driver' => 'sqlite',
    
    // 1. Cloudflare D1 Serverless Database (Cloud)
    'cloudflare_d1' => [
        'account_id' => '',   // Contoh: 'a1b2c3d4e5f6g7h8i9j0k1l2m3n4o5p6'
        'database_id' => '',  // Contoh: '12345678-abcd-ef01-2345-6789abcdef01'
        'api_token' => ''     // Token dari Cloudflare API Tokens (Permission: D1 Edit)
    ],

    // 2. MySQL / MariaDB (XAMPP / cPanel)
    'mysql' => [
        'host' => 'localhost',
        'database' => 'web_alat_kebersihan',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8mb4'
    ]
];
