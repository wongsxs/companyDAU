<?php
if (!isset($config)) {
    $config = require __DIR__ . '/../config/app.php';
}
require_once __DIR__ . '/helpers.php';

$currentPage = basename($_SERVER['PHP_SELF']);
$pageTitle = isset($pageTitle) ? $pageTitle . ' - ' . $config['brand_name'] : $config['brand_name'] . ' | ' . $config['tagline'];
$metaDesc = isset($metaDesc) ? $metaDesc : $config['sub_tagline'];
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= sanitize($pageTitle) ?></title>
  <meta name="description" content="<?= sanitize($metaDesc) ?>">
  <meta name="keywords" content="pabrik sapu, produsen pel lantai, sapu ijuk, sapu rayung, pel katun, alat kebersihan, grosir sapu, B2B cleaning tools">
  <meta name="author" content="<?= sanitize($config['app_name']) ?>">

  <link rel="icon" type="image/svg+xml" href="assets/images/logo.svg">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['"Plus Jakarta Sans"', 'system-ui', 'sans-serif'],
          },
          colors: {
            brand: {
              50: '#f0f9ff',
              100: '#e0f2fe',
              200: '#bae6fd',
              300: '#7dd3fc',
              400: '#38bdf8',
              500: '#0ea5e9',
              600: '#0284c7',
              700: '#0369a1',
              800: '#075985',
              900: '#0c4a6e',
              950: '#082f49',
            }
          }
        }
      }
    }
  </script>
  <script src="https://unpkg.com/lucide@latest"></script>
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-slate-50 text-slate-800 font-sans antialiased flex flex-col min-h-screen">

  <div class="bg-slate-900 text-slate-300 text-xs py-2 px-4 border-b border-slate-800">
    <div class="max-w-7xl mx-auto flex flex-col sm:flex-row justify-between items-center gap-2">
      <div class="flex items-center gap-4 flex-wrap justify-center sm:justify-start">
        <span class="inline-flex items-center gap-1.5 text-brand-400 font-medium">
          <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
          Pabrik Tangan Pertama (Direct Factory)
        </span>
        <span class="hidden md:inline-block text-slate-600">•</span>
        <span class="hidden md:inline-flex items-center gap-1 text-slate-300">
          <i data-lucide="truck" class="w-3.5 h-3.5 text-emerald-400"></i>
          Melayani Pengiriman Skala Kontainer &amp; Truk ke Seluruh Nusantara
        </span>
      </div>
      <div class="flex items-center gap-4 text-xs">
        <a href="tel:<?= preg_replace('/[^0-9]/', '', $config['phone']) ?>" class="hover:text-white transition flex items-center gap-1">
          <i data-lucide="phone" class="w-3 h-3 text-brand-400"></i>
          <?= $config['phone'] ?>
        </a>
        <span class="text-slate-600">|</span>
        <a href="admin/login.php" class="hover:text-brand-400 transition flex items-center gap-1 font-semibold text-slate-400">
          <i data-lucide="lock" class="w-3 h-3"></i>
          Portal Admin
        </a>
      </div>
    </div>
  </div>

  <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20">
        
        <a href="index.php" class="flex items-center gap-3 group focus:outline-none focus:ring-2 focus:ring-brand-500 rounded-lg p-1">
          <img src="assets/images/logo.svg" alt="<?= sanitize($config['app_name']) ?>" class="h-12 w-auto transition-transform duration-300 group-hover:scale-105">
        </a>

        <nav class="hidden lg:flex items-center space-x-1 font-medium text-sm text-slate-700">
          <a href="index.php" class="px-3.5 py-2 rounded-lg transition <?= $currentPage === 'index.php' ? 'text-brand-600 bg-brand-50 font-semibold' : 'hover:text-brand-600 hover:bg-slate-100/80' ?>">
            Beranda
          </a>
          <a href="tentang.php" class="px-3.5 py-2 rounded-lg transition <?= $currentPage === 'tentang.php' ? 'text-brand-600 bg-brand-50 font-semibold' : 'hover:text-brand-600 hover:bg-slate-100/80' ?>">
            Profil Pabrik
          </a>
          <a href="katalog.php" class="px-3.5 py-2 rounded-lg transition <?= ($currentPage === 'katalog.php' || $currentPage === 'detail.php') ? 'text-brand-600 bg-brand-50 font-semibold' : 'hover:text-brand-600 hover:bg-slate-100/80' ?>">
            Katalog Produk
          </a>
          <a href="kerjasama.php" class="px-3.5 py-2 rounded-lg transition <?= $currentPage === 'kerjasama.php' ? 'text-brand-600 bg-brand-50 font-semibold' : 'hover:text-brand-600 hover:bg-slate-100/80' ?>">
            Kemitraan &amp; B2B
          </a>
          <a href="kontak.php" class="px-3.5 py-2 rounded-lg transition <?= $currentPage === 'kontak.php' ? 'text-brand-600 bg-brand-50 font-semibold' : 'hover:text-brand-600 hover:bg-slate-100/80' ?>">
            Kontak &amp; Lokasi
          </a>
        </nav>

        <div class="hidden sm:flex items-center gap-3">
          <a href="katalog.php" class="inline-flex items-center gap-1.5 text-xs font-semibold px-4 py-2.5 rounded-lg border border-slate-300 text-slate-700 hover:bg-slate-100 transition shadow-xs">
            <i data-lucide="layers" class="w-4 h-4 text-slate-500"></i>
            Lihat Produk
          </a>
          <a href="<?= getWhatsappUrl($config['whatsapp_number'], 'Halo PT Bersih Prima Nusantara, saya ingin konsultasi pemesanan grosir alat kebersihan (sapu & pel).') ?>" 
             target="_blank" 
             rel="noopener noreferrer"
             class="inline-flex items-center gap-2 text-xs font-bold px-4 py-2.5 rounded-lg bg-emerald-600 hover:bg-emerald-700 text-white transition shadow-sm hover:shadow-md transform active:scale-95">
            <i data-lucide="message-circle" class="w-4 h-4"></i>
            WhatsApp Sales
          </a>
        </div>

        <div class="flex items-center gap-2 lg:hidden">
          <button id="mobileMenuBtn" type="button" aria-label="Buka Menu" class="p-2.5 rounded-lg text-slate-700 hover:text-brand-600 hover:bg-slate-100">
            <i data-lucide="menu" id="menuOpenIcon" class="w-6 h-6"></i>
            <i data-lucide="x" id="menuCloseIcon" class="w-6 h-6 hidden"></i>
          </button>
        </div>

      </div>
    </div>

    <div id="mobileDrawer" class="hidden lg:hidden border-t border-slate-200 bg-white px-4 pt-3 pb-6 shadow-xl animate-fadeIn">
      <div class="space-y-1.5 font-medium text-slate-700">
        <a href="index.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= $currentPage === 'index.php' ? 'text-brand-600 bg-brand-50 font-bold' : 'hover:bg-slate-100' ?>">
          <i data-lucide="home" class="w-4 h-4 text-brand-500"></i> Beranda
        </a>
        <a href="tentang.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= $currentPage === 'tentang.php' ? 'text-brand-600 bg-brand-50 font-bold' : 'hover:bg-slate-100' ?>">
          <i data-lucide="building-2" class="w-4 h-4 text-brand-500"></i> Profil Pabrik
        </a>
        <a href="katalog.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= ($currentPage === 'katalog.php' || $currentPage === 'detail.php') ? 'text-brand-600 bg-brand-50 font-bold' : 'hover:bg-slate-100' ?>">
          <i data-lucide="grid" class="w-4 h-4 text-brand-500"></i> Katalog Produk
        </a>
        <a href="kerjasama.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= $currentPage === 'kerjasama.php' ? 'text-brand-600 bg-brand-50 font-bold' : 'hover:bg-slate-100' ?>">
          <i data-lucide="briefcase" class="w-4 h-4 text-brand-500"></i> Kemitraan &amp; B2B
        </a>
        <a href="kontak.php" class="flex items-center gap-3 px-3 py-2.5 rounded-lg <?= $currentPage === 'kontak.php' ? 'text-brand-600 bg-brand-50 font-bold' : 'hover:bg-slate-100' ?>">
          <i data-lucide="map-pin" class="w-4 h-4 text-brand-500"></i> Kontak &amp; Lokasi
        </a>
      </div>

      <div class="mt-4 pt-4 border-t border-slate-200">
        <a href="<?= getWhatsappUrl($config['whatsapp_number'], 'Halo PT Bersih Prima Nusantara, saya ingin bertanya produk.') ?>" 
           target="_blank" 
           class="flex items-center justify-center gap-2 w-full py-3 bg-emerald-600 text-white font-bold rounded-lg text-sm shadow">
          <i data-lucide="message-circle" class="w-4 h-4"></i> Hubungi WhatsApp Sales
        </a>
      </div>
    </div>
  </header>

  <main class="flex-grow">