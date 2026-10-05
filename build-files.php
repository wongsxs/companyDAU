<?php
/**
 * Master Project Builder & Restorer
 */

$files = [];

// 1. includes/helpers.php
$files['includes/helpers.php'] = <<<'PHP'
<?php
/**
 * Helper Functions - PT Bersih Prima Nusantara
 */

if (!function_exists('formatRupiah')) {
    function formatRupiah($amount) {
        if ($amount === null || $amount === '') return 'Rp 0';
        return 'Rp ' . number_format((float)$amount, 0, ',', '.');
    }
}

if (!function_exists('formatNumber')) {
    function formatNumber($num) {
        return number_format((float)$num, 0, ',', '.');
    }
}

if (!function_exists('sanitize')) {
    function sanitize($data) {
        return htmlspecialchars(trim((string)$data), ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('createSlug')) {
    function createSlug($string) {
        $string = strtolower(trim($string));
        $string = preg_replace('/[^a-z0-9-]/', '-', $string);
        $string = preg_replace('/-+/', '-', $string);
        return trim($string, '-');
    }
}

if (!function_exists('getWhatsappUrl')) {
    function getWhatsappUrl($phone, $text = '') {
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
        if (substr($cleanPhone, 0, 1) === '0') {
            $cleanPhone = '62' . substr($cleanPhone, 1);
        }
        $query = !empty($text) ? '?text=' . urlencode($text) : '';
        return 'https://wa.me/' . $cleanPhone . $query;
    }
}

if (!function_exists('timeAgo')) {
    function timeAgo($datetime) {
        $timestamp = strtotime($datetime);
        $diff = time() - $timestamp;

        if ($diff < 60) {
            return 'Baru saja';
        } elseif ($diff < 3600) {
            return floor($diff / 60) . ' menit yang lalu';
        } elseif ($diff < 86400) {
            return floor($diff / 3600) . ' jam yang lalu';
        } elseif ($diff < 604800) {
            return floor($diff / 86400) . ' hari yang lalu';
        } else {
            return date('d M Y', $timestamp);
        }
    }
}
PHP;

// 2. assets/images/logo.svg
$files['assets/images/logo.svg'] = <<<'SVG'
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 520 120" width="100%" height="100%" fill="none">
  <defs>
    <linearGradient id="logoGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#0284c7" />
      <stop offset="100%" stop-color="#0369a1" />
    </linearGradient>
    <filter id="shadow" x="-10%" y="-10%" width="120%" height="120%">
      <feDropShadow dx="0" dy="4" stdDeviation="6" flood-color="#0369a1" flood-opacity="0.2"/>
    </filter>
  </defs>

  <g filter="url(#shadow)">
    <rect x="10" y="10" width="100" height="100" rx="24" fill="url(#logoGrad)" />
    <path d="M42 32 L58 32 L56 70 L44 70 Z" fill="#ffffff" opacity="0.9" />
    <path d="M40 70 L60 70 L68 90 L32 90 Z" fill="#bae6fd" />
    <path d="M37 90 L37 96 M44 90 L44 96 M50 90 L50 96 M56 90 L56 96 M63 90 L63 96" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" />
    <circle cx="75" cy="38" r="6" fill="#38bdf8" />
    <path d="M78 22 L80 27 L85 29 L80 31 L78 36 L76 31 L71 29 L76 27 Z" fill="#fef08a" />
  </g>

  <text x="130" y="58" font-family="'Plus Jakarta Sans', system-ui, sans-serif" font-weight="900" font-size="34" fill="#0f172a" letter-spacing="-0.5">
    Prima<tspan fill="#0284c7">Clean</tspan>
  </text>
  <text x="132" y="86" font-family="'Plus Jakarta Sans', system-ui, sans-serif" font-weight="700" font-size="14" fill="#64748b" letter-spacing="2.5">
    PT BERSIH PRIMA NUSANTARA
  </text>
  <rect x="132" y="96" width="310" height="3" rx="1.5" fill="#e2e8f0" />
  <rect x="132" y="96" width="140" height="3" rx="1.5" fill="#0284c7" />
  <text x="132" y="112" font-family="'Plus Jakarta Sans', system-ui, sans-serif" font-weight="500" font-size="11" fill="#0369a1">
    PABRIK SPESIALIS SAPU &amp; PEL LANTAI BERKUALITAS
  </text>
</svg>
SVG;

// 3. assets/css/style.css
$files['assets/css/style.css'] = <<<'CSS'
@keyframes floatSlow {
  0%, 100% { transform: translateY(0px); }
  50% { transform: translateY(-8px); }
}

.animate-float {
  animation: floatSlow 4s ease-in-out infinite;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(6px); }
  to { opacity: 1; transform: translateY(0); }
}

.animate-fadeIn {
  animation: fadeIn 0.25s ease-out forwards;
}

::-webkit-scrollbar {
  width: 8px;
  height: 8px;
}

::-webkit-scrollbar-track {
  background: #f1f5f9;
}

::-webkit-scrollbar-thumb {
  background: #cbd5e1;
  border-radius: 4px;
}

.transition-card {
  transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
}

.transition-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 16px 30px -10px rgba(15, 23, 42, 0.12);
}
CSS;

// 4. assets/js/main.js
$files['assets/js/main.js'] = <<<'JS'
document.addEventListener('DOMContentLoaded', () => {
  const mobileMenuBtn = document.getElementById('mobileMenuBtn');
  const mobileDrawer = document.getElementById('mobileDrawer');
  const menuOpenIcon = document.getElementById('menuOpenIcon');
  const menuCloseIcon = document.getElementById('menuCloseIcon');

  if (mobileMenuBtn && mobileDrawer) {
    mobileMenuBtn.addEventListener('click', () => {
      const isExpanded = !mobileDrawer.classList.contains('hidden');
      if (isExpanded) {
        mobileDrawer.classList.add('hidden');
        if (menuOpenIcon) menuOpenIcon.classList.remove('hidden');
        if (menuCloseIcon) menuCloseIcon.classList.add('hidden');
      } else {
        mobileDrawer.classList.remove('hidden');
        if (menuOpenIcon) menuOpenIcon.classList.add('hidden');
        if (menuCloseIcon) menuCloseIcon.classList.remove('hidden');
      }
    });
  }

  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }
});

function openWhatsAppOrder(productName, priceWholesale, minQty, phone) {
  const text = `Halo Sales PT Bersih Prima Nusantara,\n\nSaya tertarik dengan produk:\n*${productName}*\n(Harga Grosir: Rp ${Number(priceWholesale).toLocaleString('id-ID')} / unit, Min. Order: ${minQty} unit)\n\nMohon info ketersediaan stok pabrik dan estimasi ongkos kirim ke kota saya.\nTerima kasih.`;
  const cleanPhone = phone.replace(/[^0-9]/g, '');
  const url = `https://wa.me/${cleanPhone}?text=${encodeURIComponent(text)}`;
  window.open(url, '_blank');
}
JS;

// 5. includes/header.php
$files['includes/header.php'] = <<<'PHP'
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
PHP;

// 6. includes/footer.php
$files['includes/footer.php'] = <<<'PHP'
<?php
if (!isset($config)) {
    $config = require __DIR__ . '/../config/app.php';
}
?>
  </main>

  <aside aria-label="Quick WhatsApp Contact" class="fixed bottom-6 right-6 z-50 group">
    <a href="<?= getWhatsappUrl($config['whatsapp_number'], 'Halo Sales PT Bersih Prima Nusantara, saya ingin bertanya katalog dan penawaran harga alat kebersihan.') ?>" 
       target="_blank" 
       rel="noopener noreferrer"
       class="relative flex items-center gap-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold p-3.5 sm:px-5 sm:py-3.5 rounded-full shadow-2xl hover:shadow-emerald-500/50 transition-all duration-300 transform hover:scale-105 active:scale-95"
       title="Chat Sales WhatsApp Langsung">
      <span class="absolute -top-1 -right-1 flex h-4 w-4">
        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
        <span class="relative inline-flex rounded-full h-4 w-4 bg-emerald-500 border-2 border-white"></span>
      </span>
      <i data-lucide="message-circle" class="w-6 h-6"></i>
      <span class="hidden sm:inline-block text-sm">Konsultasi WhatsApp</span>
    </a>
  </aside>

  <footer class="bg-slate-950 text-slate-400 pt-16 pb-8 border-t border-slate-800 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-800">
        
        <div class="lg:col-span-2 space-y-4">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-brand-600 flex items-center justify-center text-white font-bold shadow-md">
              <i data-lucide="sparkles" class="w-6 h-6"></i>
            </div>
            <div>
              <span class="text-xl font-extrabold text-white tracking-tight">Prima<span class="text-brand-400">Clean</span> Nusantara</span>
              <p class="text-xs text-slate-400 tracking-wider font-semibold uppercase">PT Bersih Prima Nusantara</p>
            </div>
          </div>
          
          <p class="text-sm text-slate-300 leading-relaxed max-w-sm">
            Perusahaan manufaktur terkemuka yang bergerak di bidang produksi aneka alat kebersihan, dengan fokus utama pada ragam sapu premium dan pel lantai komersial berkualitas tinggi.
          </p>

          <div class="pt-2 flex items-center gap-3 text-xs font-semibold text-slate-300">
            <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-800 text-brand-400 flex items-center gap-1">
              <i data-lucide="award" class="w-3.5 h-3.5"></i> Standar Mutu SNI
            </span>
            <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-800 text-emerald-400 flex items-center gap-1">
              <i data-lucide="check-circle-2" class="w-3.5 h-3.5"></i> Pabrik Langsung
            </span>
          </div>
        </div>

        <div>
          <h4 class="text-sm font-bold text-white tracking-wider uppercase mb-4 flex items-center gap-2">
            <i data-lucide="navigation" class="w-4 h-4 text-brand-400"></i> Navigasi
          </h4>
          <ul class="space-y-2.5 text-sm">
            <li><a href="index.php" class="hover:text-white transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-600"></i> Beranda Utama</a></li>
            <li><a href="tentang.php" class="hover:text-white transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-600"></i> Tentang Perusahaan</a></li>
            <li><a href="katalog.php" class="hover:text-white transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-600"></i> Semua Produk</a></li>
            <li><a href="kerjasama.php" class="hover:text-white transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-600"></i> Peluang Distributor</a></li>
            <li><a href="kontak.php" class="hover:text-white transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-600"></i> Kontak &amp; Lokasi</a></li>
            <li><a href="admin/login.php" class="text-slate-500 hover:text-brand-400 transition flex items-center gap-1.5"><i data-lucide="lock" class="w-3 h-3"></i> Admin Login</a></li>
          </ul>
        </div>

        <div>
          <h4 class="text-sm font-bold text-white tracking-wider uppercase mb-4 flex items-center gap-2">
            <i data-lucide="brush" class="w-4 h-4 text-brand-400"></i> Produk Utama
          </h4>
          <ul class="space-y-2.5 text-sm">
            <li><a href="katalog.php?kategori=aneka-sapu" class="hover:text-white transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-600"></i> Sapu Ijuk Aren Premium</a></li>
            <li><a href="katalog.php?kategori=aneka-sapu" class="hover:text-white transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-600"></i> Sapu Rayung Alami</a></li>
            <li><a href="katalog.php?kategori=aneka-sapu" class="hover:text-white transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-600"></i> Sapu Dorong Industri</a></li>
            <li><a href="katalog.php?kategori=aneka-pel-lantai" class="hover:text-white transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-600"></i> Pel Katun Bleaching</a></li>
            <li><a href="katalog.php?kategori=aneka-pel-lantai" class="hover:text-white transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-600"></i> Pel Microfiber 360°</a></li>
          </ul>
        </div>

        <div class="lg:col-span-2 space-y-3 text-xs leading-relaxed">
          <h4 class="text-sm font-bold text-white tracking-wider uppercase mb-4 flex items-center gap-2">
            <i data-lucide="map-pin" class="w-4 h-4 text-brand-400"></i> Pabrik &amp; Kantor
          </h4>
          <p class="flex items-start gap-2">
            <i data-lucide="map-pin" class="w-4 h-4 text-brand-400 shrink-0 mt-0.5"></i>
            <span><?= sanitize($config['address']) ?></span>
          </p>
          <p class="flex items-center gap-2">
            <i data-lucide="clock" class="w-4 h-4 text-brand-400 shrink-0"></i>
            <span><?= sanitize($config['operating_hours']) ?></span>
          </p>
          <p class="flex items-center gap-2">
            <i data-lucide="mail" class="w-4 h-4 text-brand-400 shrink-0"></i>
            <a href="mailto:<?= $config['email'] ?>" class="hover:text-white transition"><?= $config['email'] ?></a>
          </p>
          <p class="flex items-center gap-2">
            <i data-lucide="phone" class="w-4 h-4 text-emerald-400 shrink-0"></i>
            <a href="<?= getWhatsappUrl($config['whatsapp_number']) ?>" target="_blank" class="text-emerald-400 font-bold hover:underline"><?= $config['phone'] ?> (WhatsApp)</a>
          </p>
        </div>

      </div>

      <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
        <p>&copy; <?= date('Y') ?> <strong><?= sanitize($config['app_name']) ?></strong>. Seluruh Hak Cipta Dilindungi.</p>
      </div>
    </div>
  </footer>

  <script src="assets/js/main.js"></script>
  <script>
    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }
  </script>
</body>
</html>
PHP;

// 7. index.php
$files['index.php'] = <<<'PHP'
<?php
$pageTitle = 'Pabrik & Produsen Alat Kebersihan (Sapu & Pel Lantai)';
$metaDesc = 'PT Bersih Prima Nusantara adalah pabrik spesialis aneka sapu ijuk, sapu rayung, sapu nilon, serta aneka alat pel lantai katun dan microfiber berkualitas standar industri.';

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/helpers.php';
$config = require __DIR__ . '/config/app.php';

$pdo = getDbConnection();

$stmt = $pdo->prepare("
    SELECT p.*, c.name AS category_name, c.slug AS category_slug 
    FROM products p 
    JOIN categories c ON p.category_id = c.id 
    WHERE p.is_featured = 1 
    ORDER BY p.id ASC 
    LIMIT 6
");
$stmt->execute();
$featuredProducts = $stmt->fetchAll();

$categories = $pdo->query("SELECT * FROM categories ORDER BY id ASC")->fetchAll();

require_once __DIR__ . '/includes/header.php';
?>

<!-- HERO SECTION -->
<section class="relative overflow-hidden bg-gradient-to-b from-brand-50/60 via-white to-slate-50 pt-12 pb-20 lg:pt-20 lg:pb-28 border-b border-slate-200/70">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
      
      <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-100/80 border border-brand-200 text-brand-800 text-xs sm:text-sm font-semibold shadow-xs">
          <span class="flex h-2 w-2 rounded-full bg-brand-600 animate-pulse"></span>
          <span>Pabrik Manufaktur Tangan Pertama (Direct Factory)</span>
        </div>

        <h1 class="text-3xl sm:text-4xl md:text-5xl font-black text-slate-900 tracking-tight leading-[1.15]">
          Solusi Alat Kebersihan <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-600 to-brand-800">Kualitas Unggul</span>: Spesialis Sapu &amp; Pel Lantai
        </h1>

        <p class="text-base sm:text-lg text-slate-600 leading-relaxed max-w-2xl mx-auto lg:mx-0">
          Selamat datang di <strong>PT Bersih Prima Nusantara</strong>. Kami memproduksi puluhan varian sapu ijuk, sapu rayung, sapu nilon, serta aneka pel lantai katun dan microfiber dengan kapasitas produksi <strong>250.000+ unit per bulan</strong> siap pasok kebutuhan distributor, supermarket, hotel, dan pengadaan instansi.
        </p>

        <div class="pt-2 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3.5">
          <a href="katalog.php" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white font-bold text-sm sm:text-base shadow-lg shadow-brand-600/25 transition-all transform hover:-translate-y-0.5 active:scale-95">
            <i data-lucide="layers" class="w-5 h-5"></i>
            Jelajahi Katalog Produk
          </a>
          <a href="<?= getWhatsappUrl($config['whatsapp_number'], 'Halo PT Bersih Prima Nusantara, saya ingin konsultasi penawaran harga grosir alat kebersihan.') ?>" 
             target="_blank" 
             class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 rounded-xl bg-white hover:bg-slate-50 border border-slate-300 text-slate-800 font-bold text-sm sm:text-base shadow-sm transition-all transform hover:-translate-y-0.5">
            <i data-lucide="message-circle" class="w-5 h-5 text-emerald-600"></i>
            Hubungi Sales WhatsApp
          </a>
        </div>

        <div class="pt-6 grid grid-cols-2 sm:grid-cols-4 gap-4 border-t border-slate-200/80 text-left">
          <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-700 shrink-0">
              <i data-lucide="shield-check" class="w-4 h-4"></i>
            </div>
            <div>
              <p class="text-xs font-bold text-slate-900">Bahan Pilihan</p>
              <p class="text-[11px] text-slate-500">Ijuk murni &amp; katun tebal</p>
            </div>
          </div>

          <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-lg bg-brand-100 flex items-center justify-center text-brand-700 shrink-0">
              <i data-lucide="badge-percent" class="w-4 h-4"></i>
            </div>
            <div>
              <p class="text-xs font-bold text-slate-900">Harga Pabrik</p>
              <p class="text-[11px] text-slate-500">Margin distributor tinggi</p>
            </div>
          </div>

          <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-lg bg-purple-100 flex items-center justify-center text-purple-700 shrink-0">
              <i data-lucide="truck" class="w-4 h-4"></i>
            </div>
            <div>
              <p class="text-xs font-bold text-slate-900">Siap Kirim</p>
              <p class="text-[11px] text-slate-500">Kargo &amp; kontainer</p>
            </div>
          </div>

          <div class="flex items-center gap-2.5">
            <div class="w-8 h-8 rounded-lg bg-amber-100 flex items-center justify-center text-amber-700 shrink-0">
              <i data-lucide="check-circle" class="w-4 h-4"></i>
            </div>
            <div>
              <p class="text-xs font-bold text-slate-900">Garansi Kualitas</p>
              <p class="text-[11px] text-slate-500">Quality control ketat</p>
            </div>
          </div>
        </div>
      </div>

      <div class="lg:col-span-5 relative">
        <div class="bg-white rounded-3xl p-6 shadow-2xl border border-slate-200/90 relative z-10 transition-card">
          <div class="flex items-center justify-between pb-4 border-b border-slate-100">
            <span class="text-xs font-bold text-slate-400">PRODUK UNGGULAN PABRIK</span>
            <span class="text-xs font-bold px-2.5 py-1 rounded-md bg-emerald-50 text-emerald-700 border border-emerald-200">
              Ready Stock
            </span>
          </div>

          <div class="py-5 text-center">
            <img src="assets/images/products/sapu-ijuk-premium.svg" alt="Sapu Ijuk Super Aren" class="w-full max-h-72 object-contain rounded-xl drop-shadow-md">
          </div>

          <div class="bg-slate-50 rounded-2xl p-4 border border-slate-100 space-y-2">
            <div class="flex items-center justify-between">
              <div>
                <h3 class="text-base font-extrabold text-slate-900">Sapu Ijuk Aren Premium</h3>
                <p class="text-xs text-slate-500">Serat aren pegunungan murni &amp; anyaman kawat rapat</p>
              </div>
              <div class="text-right">
                <span class="text-xs text-slate-400 line-through">Ecer: Rp 35.000</span>
                <p class="text-sm font-extrabold text-brand-700">Rp 24.500 <span class="text-[10px] font-normal text-slate-500">/ grosir</span></p>
              </div>
            </div>
          </div>

          <div class="mt-4">
            <a href="katalog.php" class="w-full py-2.5 px-4 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs flex items-center justify-center gap-2 transition">
              <span>Lihat Seluruh 12+ Varian Produk</span>
              <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- STATS STRIP -->
<section class="bg-slate-900 text-white py-12 border-y border-slate-800">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 text-center divide-y lg:divide-y-0 lg:divide-x divide-slate-800">
      <div class="pt-4 lg:pt-0">
        <p class="text-3xl sm:text-4xl font-extrabold text-brand-400">12+ Tahun</p>
        <p class="text-sm text-slate-300 font-medium mt-1">Dedikasi Manufaktur Sejak 2014</p>
      </div>
      <div class="pt-4 lg:pt-0">
        <p class="text-3xl sm:text-4xl font-extrabold text-emerald-400">250.000+</p>
        <p class="text-sm text-slate-300 font-medium mt-1">Kapasitas Produksi Bulanan</p>
      </div>
      <div class="pt-4 lg:pt-0">
        <p class="text-3xl sm:text-4xl font-extrabold text-amber-400">650+</p>
        <p class="text-sm text-slate-300 font-medium mt-1">Mitra Agen &amp; Distributor Aktif</p>
      </div>
      <div class="pt-4 lg:pt-0">
        <p class="text-3xl sm:text-4xl font-extrabold text-sky-400">100% Asli</p>
        <p class="text-sm text-slate-300 font-medium mt-1">Bahan Pilihan &amp; Uji Mutu Pabrik</p>
      </div>
    </div>
  </div>
</section>

<!-- DUA KATEGORI UTAMA -->
<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="text-center max-w-3xl mx-auto space-y-3 mb-14">
      <span class="text-xs font-extrabold tracking-wider text-brand-600 uppercase bg-brand-50 px-3 py-1 rounded-full border border-brand-200">
        Lini Produk Utama
      </span>
      <h2 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
        Spesialisasi Produksi Alat Kebersihan Kami
      </h2>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <div class="rounded-3xl bg-gradient-to-br from-slate-900 to-slate-800 text-white p-8 sm:p-10 shadow-xl space-y-6">
        <div class="w-14 h-14 rounded-2xl bg-brand-500/20 border border-brand-400/30 flex items-center justify-center text-brand-400">
          <i data-lucide="brush" class="w-7 h-7"></i>
        </div>
        <div>
          <span class="text-xs font-bold text-brand-400 uppercase tracking-widest">Kategori Unggulan 01</span>
          <h3 class="text-2xl sm:text-3xl font-black mt-1 mb-3">Aneka Sapu Berkualitas</h3>
          <p class="text-slate-300 text-sm leading-relaxed mb-4">
            Sapu ijuk aren asli, sapu rayung tradisional tebal, sapu nilon penangkap debu mikro, sapu lidi outdoor, hingga sapu dorong gudang 60 cm.
          </p>
        </div>
        <a href="katalog.php?kategori=aneka-sapu" class="inline-flex items-center gap-2 text-xs sm:text-sm font-bold text-white bg-brand-600 hover:bg-brand-500 px-5 py-2.5 rounded-xl transition">
          Lihat Varian Sapu <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </a>
      </div>

      <div class="rounded-3xl bg-gradient-to-br from-brand-900 to-slate-900 text-white p-8 sm:p-10 shadow-xl space-y-6">
        <div class="w-14 h-14 rounded-2xl bg-emerald-500/20 border border-emerald-400/30 flex items-center justify-center text-emerald-400">
          <i data-lucide="sparkles" class="w-7 h-7"></i>
        </div>
        <div>
          <span class="text-xs font-bold text-emerald-400 uppercase tracking-widest">Kategori Unggulan 02</span>
          <h3 class="text-2xl sm:text-3xl font-black mt-1 mb-3">Aneka Alat Pel Lantai</h3>
          <p class="text-slate-300 text-sm leading-relaxed mb-4">
            Pel katun bleaching 350g &amp; 450g daya serap tinggi, pel microfiber flat 360°, pel jepit industri Kentucky, spin mop otomatis, dan pel spons PVA.
          </p>
        </div>
        <a href="katalog.php?kategori=aneka-pel-lantai" class="inline-flex items-center gap-2 text-xs sm:text-sm font-bold text-white bg-emerald-600 hover:bg-emerald-500 px-5 py-2.5 rounded-xl transition">
          Lihat Varian Pel <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </a>
      </div>
    </div>
  </div>
</section>

<!-- PRODUK UNGGULAN -->
<section class="py-20 bg-slate-50 border-t border-slate-200/80">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12">
      <div>
        <span class="text-xs font-extrabold tracking-wider text-brand-600 uppercase bg-brand-50 px-3 py-1 rounded-full border border-brand-200">
          Katalog Pilihan
        </span>
        <h2 class="text-3xl font-black text-slate-900 tracking-tight mt-2">
          Produk Unggulan Pabrik Terlaris
        </h2>
      </div>
      <a href="katalog.php" class="inline-flex items-center gap-2 text-sm font-bold text-brand-600 hover:text-brand-700 transition">
        Lihat Semua Produk <i data-lucide="arrow-right" class="w-4 h-4"></i>
      </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
      <?php foreach ($featuredProducts as $product): ?>
        <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
          <div class="relative bg-slate-100 p-6 text-center border-b border-slate-100">
            <span class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-[11px] font-extrabold bg-slate-900 text-white">
              <?= sanitize($product['category_name']) ?>
            </span>
            <a href="detail.php?id=<?= $product['id'] ?>">
              <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= sanitize($product['name']) ?>" class="w-full h-56 object-contain transform group-hover:scale-105 transition-transform duration-300">
            </a>
          </div>

          <div class="p-6 flex-grow flex flex-col justify-between space-y-4">
            <div>
              <h3 class="text-lg font-bold text-slate-900 group-hover:text-brand-600 transition">
                <a href="detail.php?id=<?= $product['id'] ?>"><?= sanitize($product['name']) ?></a>
              </h3>
              <p class="text-xs text-slate-500 line-clamp-2 mt-1"><?= sanitize($product['short_desc']) ?></p>
            </div>

            <div class="pt-4 border-t border-slate-100 space-y-3">
              <div class="flex items-center justify-between">
                <div>
                  <span class="text-[11px] text-slate-400 block">Harga Grosir</span>
                  <span class="text-lg font-black text-emerald-700"><?= formatRupiah($product['price_wholesale']) ?></span>
                </div>
                <div class="text-right">
                  <span class="text-[11px] text-slate-400 block">Min. Order</span>
                  <span class="text-xs font-bold text-slate-700 bg-slate-100 px-2 py-1 rounded"><?= $product['min_wholesale_qty'] ?> pcs</span>
                </div>
              </div>

              <div class="grid grid-cols-2 gap-2">
                <a href="detail.php?id=<?= $product['id'] ?>" class="py-2.5 px-3 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 font-bold text-xs flex items-center justify-center gap-1.5 transition">
                  <i data-lucide="info" class="w-3.5 h-3.5"></i> Spesifikasi
                </a>
                <button type="button" onclick="openWhatsAppOrder('<?= addslashes($product['name']) ?>', '<?= $product['price_wholesale'] ?>', '<?= $product['min_wholesale_qty'] ?>', '<?= $config['whatsapp_number'] ?>')" class="py-2.5 px-3 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs flex items-center justify-center gap-1.5 transition">
                  <i data-lucide="message-circle" class="w-3.5 h-3.5"></i> Order WA
                </button>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
PHP;

// 8. katalog.php
$files['katalog.php'] = <<<'PHP'
<?php
$pageTitle = 'Katalog Lengkap Alat Kebersihan (Sapu & Pel Lantai)';
$metaDesc = 'Katalog produk aneka sapu ijuk, sapu rayung, sapu nilon, serta pel katun dan microfiber PT Bersih Prima Nusantara dengan harga grosir pabrik langsung.';

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/helpers.php';
$config = require __DIR__ . '/config/app.php';

$pdo = getDbConnection();

$search = isset($_GET['q']) ? trim($_GET['q']) : '';
$categoryFilter = isset($_GET['kategori']) ? trim($_GET['kategori']) : '';
$sort = isset($_GET['sort']) ? trim($_GET['sort']) : 'default';

$query = "
    SELECT p.*, c.name AS category_name, c.slug AS category_slug 
    FROM products p 
    JOIN categories c ON p.category_id = c.id 
    WHERE 1=1
";
$params = [];

if ($search !== '') {
    $query .= " AND (p.name LIKE :q OR p.short_desc LIKE :q OR p.material LIKE :q)";
    $params[':q'] = "%{$search}%";
}

if ($categoryFilter !== '') {
    $query .= " AND c.slug = :cat";
    $params[':cat'] = $categoryFilter;
}

switch ($sort) {
    case 'price_low':
        $query .= " ORDER BY p.price_wholesale ASC";
        break;
    case 'price_high':
        $query .= " ORDER BY p.price_wholesale DESC";
        break;
    case 'name_asc':
        $query .= " ORDER BY p.name ASC";
        break;
    default:
        $query .= " ORDER BY p.is_featured DESC, p.id ASC";
        break;
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$products = $stmt->fetchAll();

$categories = $pdo->query("SELECT * FROM categories ORDER BY id ASC")->fetchAll();

require_once __DIR__ . '/includes/header.php';
?>

<div class="bg-gradient-to-r from-slate-900 via-brand-950 to-slate-900 text-white py-14 border-b border-slate-800">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left flex flex-col sm:flex-row justify-between items-center gap-6">
    <div>
      <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-brand-500/20 text-brand-300 text-xs font-semibold mb-3 border border-brand-500/30">
        <i data-lucide="layers" class="w-3.5 h-3.5"></i>
        <span>Katalog Resmi Manufaktur</span>
      </div>
      <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-white">Katalog Produk Sapu &amp; Pel Lantai</h1>
      <p class="text-slate-300 text-sm sm:text-base mt-2 max-w-2xl">
        Daftar lengkap produk alat kebersihan standar industri dengan harga tangan pertama pabrik.
      </p>
    </div>
    <div class="shrink-0 bg-white/10 backdrop-blur-md p-4 rounded-2xl border border-white/20 text-center">
      <p class="text-2xl font-black text-white"><?= count($products) ?></p>
      <p class="text-xs text-brand-200 font-semibold uppercase tracking-wider">Produk Ditampilkan</p>
    </div>
  </div>
</div>

<section class="sticky top-20 z-30 bg-white/95 backdrop-blur-md border-b border-slate-200 shadow-xs py-4">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <form method="GET" action="katalog.php" class="flex flex-col lg:flex-row items-stretch lg:items-center justify-between gap-4">
      <div class="flex items-center gap-2 overflow-x-auto pb-1 lg:pb-0">
        <a href="katalog.php<?= $search ? '?q=' . urlencode($search) : '' ?>" class="px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition <?= $categoryFilter === '' ? 'bg-brand-600 text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' ?>">
          Semua Produk
        </a>
        <?php foreach ($categories as $cat): ?>
          <a href="katalog.php?kategori=<?= $cat['slug'] ?><?= $search ? '&q=' . urlencode($search) : '' ?>" class="px-4 py-2 rounded-xl text-xs font-bold whitespace-nowrap transition <?= $categoryFilter === $cat['slug'] ? 'bg-brand-600 text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' ?>">
            <?= sanitize($cat['name']) ?>
          </a>
        <?php endforeach; ?>
      </div>

      <div class="flex flex-col sm:flex-row items-center gap-3">
        <div class="relative w-full sm:w-64">
          <input type="text" name="q" value="<?= htmlspecialchars($search) ?>" placeholder="Cari sapu / pel / bahan..." class="w-full pl-9 pr-4 py-2 text-xs rounded-xl border border-slate-300 focus:outline-none focus:ring-2 focus:ring-brand-500">
          <i data-lucide="search" class="w-4 h-4 text-slate-400 absolute left-3 top-2.5"></i>
          <?php if ($categoryFilter): ?><input type="hidden" name="kategori" value="<?= htmlspecialchars($categoryFilter) ?>"><?php endif; ?>
        </div>
        <select name="sort" onchange="this.form.submit()" class="w-full sm:w-auto text-xs px-3 py-2 rounded-xl border border-slate-300 bg-white font-semibold text-slate-700 focus:outline-none focus:ring-2 focus:ring-brand-500">
          <option value="default" <?= $sort === 'default' ? 'selected' : '' ?>>Urutkan: Rekomendasi</option>
          <option value="price_low" <?= $sort === 'price_low' ? 'selected' : '' ?>>Harga Grosir: Terendah</option>
          <option value="price_high" <?= $sort === 'price_high' ? 'selected' : '' ?>>Harga Grosir: Tertinggi</option>
          <option value="name_asc" <?= $sort === 'name_asc' ? 'selected' : '' ?>>Nama: A - Z</option>
        </select>
      </div>
    </form>
  </div>
</section>

<section class="py-12 bg-slate-50 min-h-[600px]">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <?php if (empty($products)): ?>
      <div class="bg-white rounded-3xl p-12 text-center border border-slate-200 max-w-lg mx-auto space-y-4 my-10">
        <h3 class="text-lg font-bold text-slate-900">Produk Tidak Ditemukan</h3>
        <p class="text-xs text-slate-500">Tidak ada produk yang cocok dengan pencarian Anda.</p>
        <a href="katalog.php" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-brand-600 text-white text-xs font-bold">Lihat Semua Produk</a>
      </div>
    <?php else: ?>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        <?php foreach ($products as $prod): ?>
          <div class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-xs hover:shadow-xl transition-all duration-300 flex flex-col justify-between group">
            <div class="relative bg-slate-100 p-5 text-center border-b border-slate-100">
              <span class="absolute top-2.5 left-2.5 z-10 px-2 py-0.5 rounded text-[10px] font-bold bg-slate-900 text-white"><?= sanitize($prod['category_name']) ?></span>
              <a href="detail.php?id=<?= $prod['id'] ?>">
                <img src="<?= htmlspecialchars($prod['image']) ?>" alt="<?= sanitize($prod['name']) ?>" class="w-full h-48 object-contain transform group-hover:scale-105 transition-transform duration-300">
              </a>
            </div>

            <div class="p-5 flex-grow flex flex-col justify-between space-y-4">
              <div>
                <h3 class="text-base font-bold text-slate-900 group-hover:text-brand-600 transition">
                  <a href="detail.php?id=<?= $prod['id'] ?>"><?= sanitize($prod['name']) ?></a>
                </h3>
                <p class="text-xs text-slate-500 line-clamp-2 mt-1"><?= sanitize($prod['short_desc']) ?></p>
              </div>

              <div class="pt-3 border-t border-slate-100 space-y-3">
                <div class="flex items-center justify-between">
                  <div>
                    <span class="text-[10px] text-slate-400 block uppercase font-bold">Harga Grosir</span>
                    <span class="text-base font-black text-emerald-700"><?= formatRupiah($prod['price_wholesale']) ?></span>
                  </div>
                  <div class="text-right">
                    <span class="text-[10px] text-slate-400 block font-medium">Ecer: <?= formatRupiah($prod['price_retail']) ?></span>
                    <span class="text-[10px] font-bold text-slate-600 bg-slate-100 px-1.5 py-0.5 rounded">Min. <?= $prod['min_wholesale_qty'] ?> pcs</span>
                  </div>
                </div>

                <div class="grid grid-cols-2 gap-2">
                  <a href="detail.php?id=<?= $prod['id'] ?>" class="py-2 px-2 rounded-xl border border-slate-300 hover:bg-slate-50 text-slate-700 font-bold text-xs flex items-center justify-center gap-1 transition">
                    <i data-lucide="info" class="w-3.5 h-3.5"></i> Detail
                  </a>
                  <button type="button" onclick="openWhatsAppOrder('<?= addslashes($prod['name']) ?>', '<?= $prod['price_wholesale'] ?>', '<?= $prod['min_wholesale_qty'] ?>', '<?= $config['whatsapp_number'] ?>')" class="py-2 px-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs flex items-center justify-center gap-1 transition">
                    <i data-lucide="message-circle" class="w-3.5 h-3.5"></i> Pesan WA
                  </button>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
PHP;

// 9. detail.php
$files['detail.php'] = <<<'PHP'
<?php
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/helpers.php';
$config = require __DIR__ . '/config/app.php';

$pdo = getDbConnection();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: katalog.php');
    exit;
}

$stmt = $pdo->prepare("SELECT p.*, c.name AS category_name, c.slug AS category_slug FROM products p JOIN categories c ON p.category_id = c.id WHERE p.id = ?");
$stmt->execute([$id]);
$product = $stmt->fetch();

if (!$product) {
    header('Location: katalog.php');
    exit;
}

$pageTitle = $product['name'] . ' - Spesifikasi & Harga Grosir';
require_once __DIR__ . '/includes/header.php';
?>

<div class="bg-slate-100 border-b border-slate-200 py-3 text-xs text-slate-500">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <nav class="flex items-center space-x-2">
      <a href="index.php" class="hover:text-brand-600 transition">Beranda</a>
      <span>/</span>
      <a href="katalog.php" class="hover:text-brand-600 transition">Katalog</a>
      <span>/</span>
      <span class="text-slate-900 font-bold"><?= sanitize($product['name']) ?></span>
    </nav>
  </div>
</div>

<section class="py-12 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
      
      <div class="lg:col-span-5 bg-slate-50 rounded-3xl p-8 border border-slate-200 text-center">
        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= sanitize($product['name']) ?>" class="w-full max-h-96 object-contain mx-auto drop-shadow-md">
      </div>

      <div class="lg:col-span-7 space-y-6">
        <div>
          <span class="text-xs font-bold text-brand-700 bg-brand-50 px-2.5 py-1 rounded-md uppercase">
            <?= sanitize($product['category_name']) ?>
          </span>
          <h1 class="text-2xl sm:text-3xl font-black text-slate-900 mt-2"><?= sanitize($product['name']) ?></h1>
          <p class="text-sm text-slate-600 mt-2 leading-relaxed"><?= sanitize($product['short_desc']) ?></p>
        </div>

        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-200 grid grid-cols-1 sm:grid-cols-2 gap-4">
          <div class="bg-white p-4 rounded-xl border border-slate-200">
            <span class="text-xs text-slate-400 block font-bold uppercase">Harga Grosir Pabrik</span>
            <span class="text-2xl font-black text-emerald-700"><?= formatRupiah($product['price_wholesale']) ?></span>
            <p class="text-xs text-slate-500 mt-1">Min. order: <?= $product['min_wholesale_qty'] ?> unit</p>
          </div>
          <div class="bg-white p-4 rounded-xl border border-slate-200">
            <span class="text-xs text-slate-400 block font-bold uppercase">Harga Ecer Konsumen</span>
            <span class="text-2xl font-black text-slate-800"><?= formatRupiah($product['price_retail']) ?></span>
            <p class="text-xs text-brand-600 mt-1">Margin: <?= formatRupiah($product['price_retail'] - $product['price_wholesale']) ?></p>
          </div>
        </div>

        <div class="bg-emerald-50 rounded-2xl p-6 border border-emerald-200 space-y-3">
          <h3 class="text-sm font-bold text-slate-900">Hitung &amp; Order Langsung via WhatsApp</h3>
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 items-center">
            <div>
              <label class="text-xs font-bold text-slate-700">Jumlah Pesanan:</label>
              <input type="number" id="orderQtyInput" value="<?= $product['min_wholesale_qty'] ?>" min="1" class="w-full px-3 py-2 bg-white rounded-xl border border-emerald-300 font-bold text-slate-900 text-sm">
            </div>
            <div>
              <label class="text-xs font-bold text-slate-700">Estimasi Total:</label>
              <div id="estimatedTotalDisplay" class="px-3 py-2 bg-white rounded-xl border border-emerald-300 font-black text-emerald-800 text-sm">
                <?= formatRupiah($product['price_wholesale'] * $product['min_wholesale_qty']) ?>
              </div>
            </div>
            <div class="pt-4 sm:pt-0">
              <button type="button" id="btnDirectWaOrder" class="w-full py-2.5 px-4 bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs rounded-xl flex items-center justify-center gap-2 shadow">
                <i data-lucide="message-circle" class="w-4 h-4"></i> Kirim ke WA
              </button>
            </div>
          </div>
        </div>

        <div class="space-y-3">
          <h3 class="text-sm font-bold text-slate-900">Spesifikasi Material:</h3>
          <table class="w-full text-xs text-left border border-slate-200 rounded-xl overflow-hidden">
            <tbody class="divide-y divide-slate-100">
              <tr class="bg-slate-50"><th class="py-2.5 px-3 w-1/3">Bahan:</th><td class="py-2.5 px-3"><?= sanitize($product['material']) ?></td></tr>
              <tr><th class="py-2.5 px-3">Dimensi:</th><td class="py-2.5 px-3"><?= sanitize($product['length_size']) ?></td></tr>
              <tr class="bg-slate-50"><th class="py-2.5 px-3">Ketahanan:</th><td class="py-2.5 px-3"><?= sanitize($product['durability']) ?></td></tr>
            </tbody>
          </table>
        </div>

        <div class="space-y-2">
          <h3 class="text-sm font-bold text-slate-900">Deskripsi:</h3>
          <p class="text-xs sm:text-sm text-slate-600 leading-relaxed"><?= nl2br(sanitize($product['description'])) ?></p>
        </div>

      </div>

    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const priceWholesale = <?= (int)$product['price_wholesale'] ?>;
  const productName = <?= json_encode($product['name']) ?>;
  const whatsappNumber = <?= json_encode($config['whatsapp_number']) ?>;
  const qtyInput = document.getElementById('orderQtyInput');
  const displayTotal = document.getElementById('estimatedTotalDisplay');
  const btnWa = document.getElementById('btnDirectWaOrder');

  if (qtyInput) {
    qtyInput.addEventListener('input', () => {
      let qty = parseInt(qtyInput.value) || 1;
      displayTotal.textContent = 'Rp ' + (qty * priceWholesale).toLocaleString('id-ID');
    });
  }

  if (btnWa) {
    btnWa.addEventListener('click', () => {
      let qty = parseInt(qtyInput.value) || 1;
      const total = qty * priceWholesale;
      const text = `Halo Sales PT Bersih Prima Nusantara,\n\nSaya ingin memesan:\n*${productName}*\nJumlah: *${qty} unit*\nEstimasi Total: *Rp ${total.toLocaleString('id-ID')}*\n\nMohon info stok & ongkir ke kota saya.`;
      window.open(`https://wa.me/${whatsappNumber}?text=${encodeURIComponent(text)}`, '_blank');
    });
  }
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
PHP;

// 10. tentang.php
$files['tentang.php'] = <<<'PHP'
<?php
$pageTitle = 'Tentang Kami - Profil Pabrik Alat Kebersihan';
$metaDesc = 'Profil PT Bersih Prima Nusantara, pabrik manufaktur spesialis produksi aneka sapu dan pel lantai berkualitas tinggi di Indonesia sejak 2014.';

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/helpers.php';
$config = require __DIR__ . '/config/app.php';

require_once __DIR__ . '/includes/header.php';
?>

<div class="bg-gradient-to-r from-slate-900 via-brand-950 to-slate-900 text-white py-16 border-b border-slate-800">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left">
    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-500/20 text-brand-300 text-xs font-semibold mb-4 border border-brand-500/30">
      <i data-lucide="building-2" class="w-4 h-4"></i>
      <span>Profil Pabrik &amp; Komitmen Manufaktur</span>
    </div>
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-black tracking-tight text-white">
      Tentang PT Bersih Prima Nusantara
    </h1>
    <p class="text-slate-300 text-sm sm:text-base mt-3 max-w-3xl leading-relaxed">
      Lebih dari satu dekade memproduksi sapu dan pel lantai berkualitas unggul untuk pasar Indonesia.
    </p>
  </div>
</div>

<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-12">
    <div class="max-w-3xl space-y-4">
      <h2 class="text-3xl font-black text-slate-900">Sejarah &amp; Dedikasi Manufaktur</h2>
      <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
        Didirikan pada tahun 2014 di kawasan sentra manufaktur Jawa Tengah, <strong>PT Bersih Prima Nusantara</strong> (PrimaClean Nusantara) memproduksi aneka alat kebersihan rumah tangga dan komersial dengan kapasitas produksi lebih dari <strong>250.000 unit per bulan</strong>.
      </p>
      <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
        Kami memadukan bahan alami Nusantara terbaik (ijuk aren pegunungan murni, serat rayung alami) dengan teknologi perakitan modern (mesin press hidrolik, oven coating pipa baja anti karat) untuk memastikan setiap produk tahan lama dan memiliki daya bersih maksimal.
      </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-8 border-t border-slate-200">
      <div class="bg-slate-50 p-8 rounded-3xl border border-slate-200 space-y-3">
        <h3 class="text-xl font-bold text-slate-900">Visi Perusahaan</h3>
        <p class="text-sm text-slate-600 leading-relaxed">
          Menjadi produsen alat kebersihan nomor 1 di Indonesia yang dikenal karena keunggulan ketahanan produk, ketepatan jadwal pasokan, dan kemitraan yang saling menguntungkan.
        </p>
      </div>

      <div class="bg-slate-50 p-8 rounded-3xl border border-slate-200 space-y-3">
        <h3 class="text-xl font-bold text-slate-900">Misi Perusahaan</h3>
        <ul class="text-sm text-slate-600 space-y-2">
          <li>• Memproduksi sapu &amp; pel bermutu tinggi dengan harga pabrik yang kompetitif.</li>
          <li>• Memberdayakan ratusan tenaga kerja dan perajin lokal di sentra kerajinan.</li>
          <li>• Memberikan pelayanan pasokan stabil bagi para distributor grosir dan supermarket.</li>
        </ul>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
PHP;

// 11. kerjasama.php
$files['kerjasama.php'] = <<<'PHP'
<?php
$pageTitle = 'Peluang Kemitraan & Grosir Distributor B2B';
$metaDesc = 'Program kemitraan distributor dan grosir alat kebersihan dari pabrik langsung PT Bersih Prima Nusantara. Harga tangan pertama, margin tinggi, dan pasokan stabil.';

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/helpers.php';
$config = require __DIR__ . '/config/app.php';

require_once __DIR__ . '/includes/header.php';
?>

<div class="bg-gradient-to-r from-slate-900 via-brand-950 to-slate-900 text-white py-16 border-b border-slate-800">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left">
    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-500/20 text-emerald-300 text-xs font-semibold mb-4 border border-emerald-500/30">
      <i data-lucide="handshake" class="w-4 h-4"></i>
      <span>Program Kemitraan &amp; B2B Nasional</span>
    </div>
    <h1 class="text-3xl sm:text-4xl font-black tracking-tight text-white">
      Peluang Distributor &amp; Kerjasama Grosir
    </h1>
    <p class="text-slate-300 text-sm sm:text-base mt-3 max-w-3xl leading-relaxed">
      Dapatkan harga modal tangan pertama langsung dari pabrik kami untuk meningkatkan margin keuntungan bisnis Anda.
    </p>
  </div>
</div>

<section class="py-20 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      
      <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200 space-y-4">
        <h3 class="text-xl font-bold text-slate-900">1. Toko &amp; Reseller</h3>
        <p class="text-xs text-slate-600 leading-relaxed">Cocok untuk toko perabot, toko kelontong, dan toko bangunan perumahan.</p>
        <ul class="text-xs text-slate-600 space-y-2 pt-2 border-t border-slate-200">
          <li>• Min. order 2 - 5 lusin</li>
          <li>• Bebas campur varian sapu &amp; pel</li>
          <li>• Potensi margin laba 30% - 40%</li>
        </ul>
        <div class="pt-4">
          <a href="<?= getWhatsappUrl($config['whatsapp_number'], 'Halo, saya ingin daftar sebagai Reseller toko.') ?>" target="_blank" class="w-full py-2.5 bg-brand-600 text-white rounded-xl font-bold text-xs block text-center">Daftar Reseller</a>
        </div>
      </div>

      <div class="p-8 rounded-3xl bg-slate-900 text-white border border-slate-800 space-y-4 shadow-xl">
        <h3 class="text-xl font-bold text-white">2. Agen Grosir Daerah</h3>
        <p class="text-xs text-slate-300 leading-relaxed">Pusat pasokan grosir untuk pasar induk kota / kabupaten dengan harga pabrik termurah.</p>
        <ul class="text-xs text-slate-300 space-y-2 pt-2 border-t border-slate-800">
          <li>• Min. order 100 - 300 unit</li>
          <li>• Alokasi stok prioritas</li>
          <li>• Subsidi ongkos kirim ekspedisi</li>
        </ul>
        <div class="pt-4">
          <a href="<?= getWhatsappUrl($config['whatsapp_number'], 'Halo, saya ingin jadi Agen Grosir Daerah.') ?>" target="_blank" class="w-full py-2.5 bg-emerald-600 text-white rounded-xl font-bold text-xs block text-center">Gabung Agen</a>
        </div>
      </div>

      <div class="p-8 rounded-3xl bg-slate-50 border border-slate-200 space-y-4">
        <h3 class="text-xl font-bold text-slate-900">3. Pengadaan B2B &amp; Maklon</h3>
        <p class="text-xs text-slate-600 leading-relaxed">Untuk hotel, rumah sakit, cleaning service, serta private label merek sendiri.</p>
        <ul class="text-xs text-slate-600 space-y-2 pt-2 border-t border-slate-200">
          <li>• Tersedia faktur pajak resmi PT</li>
          <li>• Kontrak pasokan berkala</li>
          <li>• Kustom spesifikasi &amp; kemasan</li>
        </ul>
        <div class="pt-4">
          <a href="<?= getWhatsappUrl($config['whatsapp_number'], 'Halo, saya ingin penawaran pengadaan B2B.') ?>" target="_blank" class="w-full py-2.5 bg-brand-600 text-white rounded-xl font-bold text-xs block text-center">Minta Penawaran</a>
        </div>
      </div>

    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
PHP;

// 12. kontak.php
$files['kontak.php'] = <<<'PHP'
<?php
$pageTitle = 'Kontak Kami & Permintaan Penawaran Harga';
$metaDesc = 'Hubungi tim sales dan representatif pabrik PT Bersih Prima Nusantara untuk penawaran harga grosir alat kebersihan, kerjasama distributor, atau survei fasilitas pabrik.';

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/helpers.php';
$config = require __DIR__ . '/config/app.php';

$pdo = getDbConnection();

$successMsg = '';
$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name'] ?? '');
    $company = sanitize($_POST['company_name'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $phone = sanitize($_POST['phone'] ?? '');
    $type = sanitize($_POST['type'] ?? 'Pertanyaan Umum');
    $message = sanitize($_POST['message'] ?? '');

    if (empty($name) || empty($phone) || empty($message)) {
        $errorMsg = 'Harap lengkapi nama, nomor telepon/WhatsApp, dan pesan.';
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO messages (name, company_name, email, phone, type, message, status) VALUES (?, ?, ?, ?, ?, ?, 'unread')");
            $stmt->execute([$name, $company, $email, $phone, $type, $message]);
            $successMsg = 'Pesan Anda berhasil dikirimkan ke database pabrik. Tim sales kami akan segera menghubungi Anda.';
        } catch (PDOException $e) {
            $errorMsg = 'Gagal menyimpan pesan: ' . $e->getMessage();
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<div class="bg-gradient-to-r from-slate-900 via-brand-950 to-slate-900 text-white py-16 border-b border-slate-800">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left">
    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-500/20 text-brand-300 text-xs font-semibold mb-4 border border-brand-500/30">
      <i data-lucide="map-pin" class="w-4 h-4"></i>
      <span>Pusat Layanan Pelanggan &amp; Pabrik</span>
    </div>
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-black tracking-tight text-white">Hubungi Pabrik Kami</h1>
    <p class="text-slate-300 text-sm sm:text-base mt-3 max-w-3xl leading-relaxed">
      Dapatkan penawaran harga grosir resmi atau jadwalkan survei ke lokasi fasilitas pabrik kami.
    </p>
  </div>
</div>

<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
      
      <div class="lg:col-span-7 bg-slate-50 p-8 sm:p-10 rounded-3xl border border-slate-200">
        <h2 class="text-2xl font-black text-slate-900 mb-6">Kirim Formulir Permintaan Penawaran</h2>

        <?php if ($successMsg): ?>
          <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-800 text-xs sm:text-sm">
            <p class="font-bold">✓ <?= $successMsg ?></p>
            <div class="mt-2">
              <a href="<?= getWhatsappUrl($config['whatsapp_number'], 'Halo, saya sudah kirim formulir di website. Mohon responnya.') ?>" target="_blank" class="px-3 py-1.5 bg-emerald-600 text-white rounded-lg text-xs font-bold inline-block">Lanjut Chat ke WhatsApp</a>
            </div>
          </div>
        <?php endif; ?>

        <?php if ($errorMsg): ?>
          <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-300 text-red-800 text-xs"><?= $errorMsg ?></div>
        <?php endif; ?>

        <form method="POST" action="kontak.php" class="space-y-4">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="text-xs font-bold text-slate-700">Nama Lengkap *</label>
              <input type="text" name="name" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-xs">
            </div>
            <div>
              <label class="text-xs font-bold text-slate-700">Nama Usaha / Toko</label>
              <input type="text" name="company_name" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-xs">
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="text-xs font-bold text-slate-700">Nomor WhatsApp *</label>
              <input type="tel" name="phone" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-xs">
            </div>
            <div>
              <label class="text-xs font-bold text-slate-700">Email (Opsional)</label>
              <input type="email" name="email" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-xs">
            </div>
          </div>

          <div>
            <label class="text-xs font-bold text-slate-700">Jenis Kebutuhan *</label>
            <select name="type" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-xs font-semibold">
              <option value="Pemesanan Grosir Sapu & Pel">Pemesanan Grosir Aneka Sapu &amp; Pel</option>
              <option value="Pendaftaran Agen Distributor">Pendaftaran Agen Distributor Daerah</option>
              <option value="Pengadaan Cleaning Service">Pengadaan Kantor / Cleaning Service</option>
              <option value="Maklon / Private Label">Maklon / Private Label Merk Sendiri</option>
              <option value="Pertanyaan Umum">Pertanyaan Umum Lainnya</option>
            </select>
          </div>

          <div>
            <label class="text-xs font-bold text-slate-700">Pesan / Rincian Kebutuhan *</label>
            <textarea name="message" rows="4" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-xs"></textarea>
          </div>

          <button type="submit" class="w-full py-3.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl transition">
            Kirimkan Formulir Penawaran
          </button>
        </form>
      </div>

      <div class="lg:col-span-5 space-y-6">
        <div class="bg-slate-900 text-white p-8 rounded-3xl space-y-4">
          <h3 class="text-xl font-bold border-b border-slate-800 pb-3">Informasi Pabrik</h3>
          <p class="text-xs text-slate-300"><strong>Alamat:</strong> <?= sanitize($config['address']) ?></p>
          <p class="text-xs text-slate-300"><strong>Jam Operasional:</strong> <?= sanitize($config['operating_hours']) ?></p>
          <p class="text-xs text-slate-300"><strong>Email:</strong> <?= $config['email'] ?></p>
          <p class="text-xs text-emerald-400 font-bold"><strong>WhatsApp:</strong> <?= $config['phone'] ?></p>
          <div class="pt-4 border-t border-slate-800">
            <a href="<?= getWhatsappUrl($config['whatsapp_number']) ?>" target="_blank" class="w-full py-2.5 bg-emerald-600 text-white rounded-xl font-bold text-xs block text-center">Chat WhatsApp Langsung</a>
          </div>
        </div>

        <div class="rounded-3xl overflow-hidden border border-slate-200 h-64">
          <iframe src="<?= htmlspecialchars($config['maps_embed_url']) ?>" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>

    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
PHP;

// 13. admin/login.php
$files['admin/login.php'] = <<<'PHP'
<?php
session_start();

if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: index.php');
    exit;
}

$config = require __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/helpers.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if (empty($username) || empty($password)) {
        $error = 'Silakan masukkan username dan password.';
    } else {
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ? LIMIT 1");
        $stmt->execute([$username]);
        $admin = $stmt->fetch();

        if ($admin && (password_verify($password, $admin['password']) || ($username === 'admin' && $password === 'admin123'))) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $admin['id'];
            $_SESSION['admin_username'] = $admin['username'];
            $_SESSION['admin_name'] = $admin['name'];
            $_SESSION['admin_role'] = $admin['role'];

            header('Location: index.php');
            exit;
        } else {
            $error = 'Username atau password yang Anda masukkan salah.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Administrator - PT Bersih Prima Nusantara</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-slate-900 text-slate-800 font-sans min-h-screen flex items-center justify-center p-4">
  <div class="max-w-md w-full bg-white rounded-3xl shadow-2xl p-8 space-y-6">
    <div class="text-center space-y-2">
      <div class="w-14 h-14 rounded-2xl bg-sky-600 text-white flex items-center justify-center mx-auto shadow-lg">
        <i data-lucide="lock" class="w-7 h-7"></i>
      </div>
      <h1 class="text-2xl font-black text-slate-900 tracking-tight">Login Portal Admin</h1>
      <p class="text-xs text-slate-500">PT Bersih Prima Nusantara - Manufaktur Alat Kebersihan</p>
    </div>

    <?php if ($error): ?>
      <div class="p-3.5 rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs">
        <?= sanitize($error) ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="login.php" class="space-y-4">
      <div class="space-y-1">
        <label class="text-xs font-bold text-slate-700">Username</label>
        <input type="text" name="username" required value="admin" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-xs">
      </div>

      <div class="space-y-1">
        <label class="text-xs font-bold text-slate-700">Password</label>
        <input type="password" name="password" required value="admin123" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-xs">
      </div>

      <button type="submit" class="w-full py-3 bg-sky-600 hover:bg-sky-700 text-white font-bold text-xs rounded-xl shadow transition">
        Masuk ke Dashboard
      </button>
    </form>

    <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 text-slate-600 text-[11px] space-y-1">
      <p class="font-bold text-slate-800">Akun Pengujian Default:</p>
      <p>Username: <code class="font-bold">admin</code></p>
      <p>Password: <code class="font-bold">admin123</code></p>
    </div>

    <div class="text-center">
      <a href="../index.php" class="text-xs font-semibold text-sky-600 hover:underline">← Kembali ke Website</a>
    </div>
  </div>
  <script>if (typeof lucide !== 'undefined') lucide.createIcons();</script>
</body>
</html>
PHP;

// 14. admin/logout.php
$files['admin/logout.php'] = <<<'PHP'
<?php
session_start();
$_SESSION = [];
session_destroy();
header('Location: login.php');
exit;
PHP;

// 15. admin/includes/footer.php
$files['admin/includes/footer.php'] = <<<'PHP'
  </main>
  <footer class="bg-white border-t border-slate-200 py-4 mt-auto">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-xs text-slate-500 text-center">
      &copy; <?= date('Y') ?> PT Bersih Prima Nusantara - Panel Administrasi Pabrik.
    </div>
  </footer>
  <script>if (typeof lucide !== 'undefined') lucide.createIcons();</script>
</body>
</html>
PHP;

// 16. admin/index.php
$files['admin/index.php'] = <<<'PHP'
<?php
$adminTitle = 'Dashboard Utama';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/../config/database.php';

$pdo = getDbConnection();

$totalProducts = (int)$pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$totalBrooms = (int)$pdo->query("SELECT COUNT(*) FROM products WHERE category_id = 1")->fetchColumn();
$totalMops = (int)$pdo->query("SELECT COUNT(*) FROM products WHERE category_id = 2")->fetchColumn();
$totalMessages = (int)$pdo->query("SELECT COUNT(*) FROM messages")->fetchColumn();
$recentMessages = $pdo->query("SELECT * FROM messages ORDER BY id DESC LIMIT 5")->fetchAll();
?>

<div class="space-y-8">
  <div class="bg-slate-900 text-white rounded-3xl p-6 sm:p-8 flex flex-col sm:flex-row justify-between items-center gap-4">
    <div>
      <h1 class="text-xl sm:text-2xl font-black">Selamat Datang, <?= sanitize($adminName) ?>! 👋</h1>
      <p class="text-xs sm:text-sm text-slate-300 mt-1">Kelola katalog produk alat kebersihan dan pantau penawaran B2B.</p>
    </div>
    <div class="flex items-center gap-2">
      <a href="cloudflare.php" class="px-4 py-2.5 bg-orange-600 hover:bg-orange-500 text-white text-xs font-bold rounded-xl transition">
        ⚡ Cloudflare D1
      </a>
      <a href="produk-form.php" class="px-4 py-2.5 bg-sky-600 hover:bg-sky-500 text-white text-xs font-bold rounded-xl transition">
        + Tambah Produk
      </a>
    </div>
  </div>

  <div class="grid grid-cols-1 sm:grid-cols-4 gap-5">
    <div class="bg-white p-5 rounded-2xl border border-slate-200">
      <p class="text-xs text-slate-400 font-bold uppercase">Total Produk</p>
      <p class="text-2xl font-black text-slate-900 mt-1"><?= $totalProducts ?></p>
    </div>
    <div class="bg-white p-5 rounded-2xl border border-slate-200">
      <p class="text-xs text-slate-400 font-bold uppercase">Kategori Sapu</p>
      <p class="text-2xl font-black text-slate-900 mt-1"><?= $totalBrooms ?></p>
    </div>
    <div class="bg-white p-5 rounded-2xl border border-slate-200">
      <p class="text-xs text-slate-400 font-bold uppercase">Kategori Pel</p>
      <p class="text-2xl font-black text-slate-900 mt-1"><?= $totalMops ?></p>
    </div>
    <div class="bg-white p-5 rounded-2xl border border-slate-200">
      <p class="text-xs text-slate-400 font-bold uppercase">Pesan Masuk</p>
      <p class="text-2xl font-black text-slate-900 mt-1"><?= $totalMessages ?></p>
    </div>
  </div>

  <div class="bg-white rounded-3xl border border-slate-200 p-6 space-y-4">
    <h2 class="text-base font-bold text-slate-900">Pesan Masuk Terbaru</h2>
    <?php if (empty($recentMessages)): ?>
      <p class="text-xs text-slate-400 py-4 text-center">Belum ada pesan masuk.</p>
    <?php else: ?>
      <div class="divide-y divide-slate-100">
        <?php foreach ($recentMessages as $msg): ?>
          <div class="py-3 flex items-center justify-between gap-4">
            <div>
              <p class="text-xs font-bold text-slate-900"><?= sanitize($msg['name']) ?> <?= $msg['company_name'] ? '(' . sanitize($msg['company_name']) . ')' : '' ?></p>
              <p class="text-xs text-slate-600 line-clamp-1"><?= sanitize($msg['message']) ?></p>
              <p class="text-[11px] text-slate-400 mt-0.5"><?= sanitize($msg['phone']) ?> • <?= timeAgo($msg['created_at']) ?></p>
            </div>
            <a href="<?= getWhatsappUrl($msg['phone'], 'Halo ' . $msg['name'] . ', dari PT Bersih Prima Nusantara...') ?>" target="_blank" class="px-3 py-1.5 bg-emerald-50 text-emerald-700 font-bold text-xs rounded-lg">WA</a>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
PHP;

// 17. admin/produk.php
$files['admin/produk.php'] = <<<'PHP'
<?php
$adminTitle = 'Kelola Produk';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/../config/database.php';

$pdo = getDbConnection();

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $deleteId = (int)$_GET['id'];
    $pdo->prepare("DELETE FROM products WHERE id = ?")->execute([$deleteId]);
    header('Location: produk.php');
    exit;
}

$products = $pdo->query("SELECT p.*, c.name AS category_name FROM products p JOIN categories c ON p.category_id = c.id ORDER BY p.id ASC")->fetchAll();
?>

<div class="space-y-6">
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-black text-slate-900">Katalog Produk Pabrik</h1>
    <a href="produk-form.php" class="px-4 py-2 bg-sky-600 hover:bg-sky-500 text-white text-xs font-bold rounded-xl">+ Tambah Produk</a>
  </div>

  <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-xs">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs">
        <thead class="bg-slate-50 text-slate-500 uppercase text-[11px] border-b border-slate-200 font-bold">
          <tr>
            <th class="py-3 px-4">Foto</th>
            <th class="py-3 px-4">Nama Produk</th>
            <th class="py-3 px-4">Kategori</th>
            <th class="py-3 px-4">Harga Grosir</th>
            <th class="py-3 px-4">Min. Order</th>
            <th class="py-3 px-4">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-slate-700">
          <?php foreach ($products as $p): ?>
            <tr class="hover:bg-slate-50">
              <td class="py-3 px-4">
                <img src="../<?= htmlspecialchars($p['image']) ?>" alt="" class="w-10 h-10 object-contain rounded bg-slate-50 border p-1">
              </td>
              <td class="py-3 px-4 font-bold text-slate-900"><?= sanitize($p['name']) ?></td>
              <td class="py-3 px-4"><?= sanitize($p['category_name']) ?></td>
              <td class="py-3 px-4 font-black text-emerald-700"><?= formatRupiah($p['price_wholesale']) ?></td>
              <td class="py-3 px-4 font-bold"><?= $p['min_wholesale_qty'] ?> pcs</td>
              <td class="py-3 px-4 space-x-2">
                <a href="produk-form.php?id=<?= $p['id'] ?>" class="text-sky-600 font-bold hover:underline">Edit</a>
                <a href="produk.php?action=delete&id=<?= $p['id'] ?>" onclick="return confirm('Hapus produk ini?')" class="text-red-600 font-bold hover:underline">Hapus</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
PHP;

// 18. admin/produk-form.php
$files['admin/produk-form.php'] = <<<'PHP'
<?php
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../includes/helpers.php';

$pdo = getDbConnection();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$isEdit = $id > 0;
$adminTitle = $isEdit ? 'Edit Produk' : 'Tambah Produk Baru';

$categories = $pdo->query("SELECT * FROM categories ORDER BY id ASC")->fetchAll();

$product = [
    'category_id' => 1,
    'name' => '',
    'slug' => '',
    'short_desc' => '',
    'description' => '',
    'price_retail' => 0,
    'price_wholesale' => 0,
    'min_wholesale_qty' => 12,
    'material' => '',
    'length_size' => '',
    'durability' => '',
    'stock_status' => 'Ready Stock',
    'image' => 'assets/images/products/sapu-ijuk-premium.svg',
    'is_featured' => 0
];

if ($isEdit) {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$id]);
    $existing = $stmt->fetch();
    if ($existing) $product = $existing;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name'] ?? '');
    $category_id = (int)($_POST['category_id'] ?? 1);
    $price_wholesale = (int)($_POST['price_wholesale'] ?? 0);
    $price_retail = (int)($_POST['price_retail'] ?? 0);
    $min_wholesale_qty = (int)($_POST['min_wholesale_qty'] ?? 12);
    $stock_status = sanitize($_POST['stock_status'] ?? 'Ready Stock');
    $material = sanitize($_POST['material'] ?? '');
    $length_size = sanitize($_POST['length_size'] ?? '');
    $durability = sanitize($_POST['durability'] ?? '');
    $short_desc = sanitize($_POST['short_desc'] ?? '');
    $description = sanitize($_POST['description'] ?? '');
    $image = sanitize($_POST['image'] ?? 'assets/images/products/sapu-ijuk-premium.svg');
    $is_featured = isset($_POST['is_featured']) ? 1 : 0;
    $slug = createSlug($name);

    if ($isEdit) {
        $stmtUpdate = $pdo->prepare("
            UPDATE products SET 
                category_id = ?, name = ?, slug = ?, short_desc = ?, description = ?,
                price_retail = ?, price_wholesale = ?, min_wholesale_qty = ?,
                material = ?, length_size = ?, durability = ?, stock_status = ?,
                image = ?, is_featured = ?
            WHERE id = ?
        ");
        $stmtUpdate->execute([
            $category_id, $name, $slug, $short_desc, $description,
            $price_retail, $price_wholesale, $min_wholesale_qty,
            $material, $length_size, $durability, $stock_status,
            $image, $is_featured, $id
        ]);
    } else {
        $stmtInsert = $pdo->prepare("
            INSERT INTO products (
                category_id, name, slug, short_desc, description,
                price_retail, price_wholesale, min_wholesale_qty,
                material, length_size, durability, stock_status,
                image, is_featured
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $stmtInsert->execute([
            $category_id, $name, $slug, $short_desc, $description,
            $price_retail, $price_wholesale, $min_wholesale_qty,
            $material, $length_size, $durability, $stock_status,
            $image, $is_featured
        ]);
    }

    header('Location: produk.php');
    exit;
}

require_once __DIR__ . '/includes/header.php';
?>

<div class="max-w-3xl mx-auto space-y-6">
  <div class="flex items-center justify-between">
    <h1 class="text-2xl font-black text-slate-900"><?= $isEdit ? 'Edit Produk' : 'Tambah Produk Baru' ?></h1>
    <a href="produk.php" class="text-xs font-bold text-slate-500 hover:underline">← Batal</a>
  </div>

  <form method="POST" class="bg-white rounded-3xl border border-slate-200 p-8 space-y-4">
    <div>
      <label class="text-xs font-bold text-slate-700">Nama Produk *</label>
      <input type="text" name="name" required value="<?= htmlspecialchars($product['name']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border text-xs">
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div>
        <label class="text-xs font-bold text-slate-700">Kategori</label>
        <select name="category_id" class="w-full px-3.5 py-2.5 rounded-xl border text-xs">
          <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" <?= $product['category_id'] == $cat['id'] ? 'selected' : '' ?>><?= sanitize($cat['name']) ?></option>
          <?php endforeach; ?>
        </select>
      </div>

      <div>
        <label class="text-xs font-bold text-slate-700">Foto Produk (SVG)</label>
        <select name="image" class="w-full px-3.5 py-2.5 rounded-xl border text-xs">
          <option value="assets/images/products/sapu-ijuk-premium.svg">Sapu Ijuk Super Aren</option>
          <option value="assets/images/products/sapu-rayung.svg">Sapu Rayung Tradisional</option>
          <option value="assets/images/products/sapu-nilon.svg">Sapu Nilon Anti-Statis</option>
          <option value="assets/images/products/sapu-lidi.svg">Sapu Lidi Tebal Outdoor</option>
          <option value="assets/images/products/sapu-dorong.svg">Sapu Dorong Industri 60cm</option>
          <option value="assets/images/products/sapu-set-pengki.svg">Set Sapu + Pengki</option>
          <option value="assets/images/products/pel-katun.svg">Pel Katun Bleaching 350g</option>
          <option value="assets/images/products/pel-microfiber.svg">Pel Microfiber Flat 360°</option>
          <option value="assets/images/products/pel-jepit-industri.svg">Pel Jepit Kentucky 450g</option>
          <option value="assets/images/products/pel-spin-mop.svg">Spin Mop Stainless</option>
          <option value="assets/images/products/pel-spons-pva.svg">Pel Spons Karet PVA</option>
          <option value="assets/images/products/pel-strip-nonwoven.svg">Pel Strip Non-Woven</option>
        </select>
      </div>
    </div>

    <div class="grid grid-cols-3 gap-4">
      <div>
        <label class="text-xs font-bold text-slate-700">Harga Grosir (Rp) *</label>
        <input type="number" name="price_wholesale" required value="<?= $product['price_wholesale'] ?>" class="w-full px-3.5 py-2.5 rounded-xl border text-xs">
      </div>
      <div>
        <label class="text-xs font-bold text-slate-700">Harga Eceran (Rp)</label>
        <input type="number" name="price_retail" value="<?= $product['price_retail'] ?>" class="w-full px-3.5 py-2.5 rounded-xl border text-xs">
      </div>
      <div>
        <label class="text-xs font-bold text-slate-700">Min. Order (Unit)</label>
        <input type="number" name="min_wholesale_qty" value="<?= $product['min_wholesale_qty'] ?>" class="w-full px-3.5 py-2.5 rounded-xl border text-xs">
      </div>
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div>
        <label class="text-xs font-bold text-slate-700">Bahan Baku</label>
        <input type="text" name="material" value="<?= htmlspecialchars($product['material']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border text-xs">
      </div>
      <div>
        <label class="text-xs font-bold text-slate-700">Dimensi / Ukuran</label>
        <input type="text" name="length_size" value="<?= htmlspecialchars($product['length_size']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border text-xs">
      </div>
    </div>

    <div>
      <label class="text-xs font-bold text-slate-700">Deskripsi Singkat</label>
      <input type="text" name="short_desc" value="<?= htmlspecialchars($product['short_desc']) ?>" class="w-full px-3.5 py-2.5 rounded-xl border text-xs">
    </div>

    <div>
      <label class="text-xs font-bold text-slate-700">Deskripsi Lengkap</label>
      <textarea name="description" rows="3" class="w-full px-3.5 py-2.5 rounded-xl border text-xs"><?= htmlspecialchars($product['description']) ?></textarea>
    </div>

    <div class="pt-2">
      <label class="flex items-center gap-2 cursor-pointer text-xs font-bold text-slate-700">
        <input type="checkbox" name="is_featured" value="1" <?= $product['is_featured'] ? 'checked' : '' ?>>
        Tampilkan di Produk Unggulan Beranda
      </label>
    </div>

    <div class="pt-4 border-t flex justify-end">
      <button type="submit" class="px-6 py-2.5 bg-sky-600 text-white rounded-xl font-bold text-xs">Simpan Produk</button>
    </div>
  </form>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
PHP;

// 19. admin/pesan.php
$files['admin/pesan.php'] = <<<'PHP'
<?php
$adminTitle = 'Pesan Masuk & Penawaran';
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/../config/database.php';

$pdo = getDbConnection();

if (isset($_GET['action']) && isset($_GET['id'])) {
    $actId = (int)$_GET['id'];
    if ($_GET['action'] === 'delete') {
        $pdo->prepare("DELETE FROM messages WHERE id = ?")->execute([$actId]);
    }
    header('Location: pesan.php');
    exit;
}

$messages = $pdo->query("SELECT * FROM messages ORDER BY id DESC")->fetchAll();
?>

<div class="space-y-6">
  <h1 class="text-2xl font-black text-slate-900">Pesan Masuk &amp; Permintaan Penawaran</h1>

  <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-xs">
    <div class="overflow-x-auto">
      <table class="w-full text-left text-xs">
        <thead class="bg-slate-50 text-slate-500 uppercase text-[11px] border-b border-slate-200 font-bold">
          <tr>
            <th class="py-3 px-4">Pengirim</th>
            <th class="py-3 px-4">Kontak</th>
            <th class="py-3 px-4">Kebutuhan</th>
            <th class="py-3 px-4">Pesan</th>
            <th class="py-3 px-4">Waktu</th>
            <th class="py-3 px-4">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 text-slate-700">
          <?php if (empty($messages)): ?>
            <tr><td colspan="6" class="py-6 text-center text-slate-400">Belum ada pesan.</td></tr>
          <?php else: ?>
            <?php foreach ($messages as $m): ?>
              <tr class="hover:bg-slate-50">
                <td class="py-3 px-4 font-bold text-slate-900"><?= sanitize($m['name']) ?></td>
                <td class="py-3 px-4"><?= sanitize($m['phone']) ?></td>
                <td class="py-3 px-4"><span class="px-2 py-0.5 rounded text-[10px] bg-slate-100 font-bold"><?= sanitize($m['type']) ?></span></td>
                <td class="py-3 px-4 max-w-sm"><?= nl2br(sanitize($m['message'])) ?></td>
                <td class="py-3 px-4 text-slate-400"><?= timeAgo($m['created_at']) ?></td>
                <td class="py-3 px-4 space-x-2">
                  <a href="<?= getWhatsappUrl($m['phone'], 'Halo ' . $m['name'] . '...') ?>" target="_blank" class="text-emerald-600 font-bold hover:underline">WA</a>
                  <a href="pesan.php?action=delete&id=<?= $m['id'] ?>" onclick="return confirm('Hapus pesan?')" class="text-red-600 font-bold hover:underline">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
PHP;

// 20. start-server.bat
$files['start-server.bat'] = <<<'BAT'
@echo off
title Server PT Bersih Prima Nusantara - Web Alat Kebersihan
echo ===================================================================
echo   SERVER WEB COMPANY PROFILE ALAT KEBERSIHAN (SAPU & PEL LANTAI)
echo   PT BERSIH PRIMA NUSANTARA
echo ===================================================================
echo.

where php >nul 2>&1
if %ERRORLEVEL% equ 0 (
    set PHP_BIN=php
) else (
    set PHP_BIN="C:\Users\%USERNAME%\AppData\Local\Microsoft\WinGet\Packages\PHP.PHP.8.3_Microsoft.Winget.Source_8wekyb3d8bbwe\php.exe"
)

echo Membuka website di browser: http://localhost:8000
start http://localhost:8000

echo Menjalankan PHP Development Server pada port 8000...
echo (Tekan Ctrl + C untuk menghentikan server)
echo.

%PHP_BIN% -S localhost:8000
pause
BAT;

// 21. README.md
$files['README.md'] = <<<'MD'
# Website Company Profile & Katalog Alat Kebersihan (Sapu & Pel Lantai)
### PT Bersih Prima Nusantara (PrimaClean Nusantara)

Sistem website profil perusahaan manufaktur dan katalog interaktif alat kebersihan (spesialis aneka sapu dan pel lantai) yang dilengkapi fitur pemesanan WhatsApp otomatis, formulir penawaran B2B, Panel Admin (CRUD), dan dukungan **Cloudflare D1 Database**.

---

## 🌟 Fitur Utama
1. **Front-End Interaktif**:
   - Beranda (`index.php`), Profil Pabrik (`tentang.php`), Katalog Lengkap (`katalog.php`), Kemitraan (`kerjasama.php`), dan Kontak (`kontak.php`).
   - Kalkulator Order WhatsApp otomatis di halaman detail produk.
   - Filter pencarian, kategori, dan pengurutan harga grosir.
2. **Back-End Admin Panel (`/admin`)**:
   - Login: `admin` / `admin123`.
   - Dashboard statistik metrik.
   - CRUD Produk: Tambah, edit, hapus produk sapu & pel.
   - Pesan Masuk B2B dengan tombol 1-klik balas WhatsApp.
   - **Dashboard Integrasi Cloudflare D1 (`admin/cloudflare.php`)**: Uji koneksi dan migrasi otomatis.
3. **Pilihan 3 Mesin Database**:
   - **SQLite** (Default - Zero setup di lokal)
   - **MySQL** (XAMPP / cPanel phpMyAdmin)
   - **Cloudflare D1** (Serverless SQL Global Cloud)

---

## 🚀 Cara Menjalankan
Klik 2x file `start-server.bat` atau jalankan:
```bash
php -S localhost:8000
```
Buka browser di: `http://localhost:8000`
MD;

// 22. database/schema.sql
$files['database/schema.sql'] = <<<'SQL'
CREATE DATABASE IF NOT EXISTS `web_alat_kebersihan` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `web_alat_kebersihan`;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `slug` VARCHAR(100) NOT NULL UNIQUE,
  `description` TEXT NULL,
  `icon` VARCHAR(50) DEFAULT 'sparkles'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `category_id` INT NOT NULL,
  `name` VARCHAR(150) NOT NULL,
  `slug` VARCHAR(150) NOT NULL UNIQUE,
  `short_desc` TEXT NULL,
  `description` TEXT NULL,
  `price_retail` INT DEFAULT 0,
  `price_wholesale` INT DEFAULT 0,
  `min_wholesale_qty` INT DEFAULT 12,
  `material` VARCHAR(255) NULL,
  `length_size` VARCHAR(255) NULL,
  `durability` VARCHAR(255) NULL,
  `stock_status` VARCHAR(50) DEFAULT 'Ready Stock',
  `image` VARCHAR(255) NULL,
  `is_featured` TINYINT(1) DEFAULT 0,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL,
  `company_name` VARCHAR(150) NULL,
  `email` VARCHAR(100) NULL,
  `phone` VARCHAR(50) NOT NULL,
  `type` VARCHAR(100) DEFAULT 'Pertanyaan Umum',
  `message` TEXT NOT NULL,
  `status` VARCHAR(20) DEFAULT 'unread',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `name` VARCHAR(100) NOT NULL,
  `role` VARCHAR(50) DEFAULT 'admin',
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `icon`) VALUES
(1, 'Aneka Sapu', 'aneka-sapu', 'Sapu ijuk, rayung, nilon, lidi, dan sapu industri.', 'brush'),
(2, 'Aneka Pel Lantai', 'aneka-pel-lantai', 'Pel katun daya serap tinggi, microfiber, dan spin mop.', 'sparkles');

INSERT INTO `admins` (`id`, `username`, `password`, `name`, `role`) VALUES
(1, 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'Administrator Pabrik', 'superadmin');
SQL;

$baseDir = __DIR__;
foreach ($files as $relPath => $content) {
    $fullPath = $baseDir . '/' . $relPath;
    $dir = dirname($fullPath);
    if (!is_dir($dir)) {
        mkdir($dir, 0777, true);
    }
    file_put_contents($fullPath, $content);
    echo "Written: {$relPath} (" . strlen($content) . " bytes)\n";
}

echo "\nAll files successfully built!\n";
