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