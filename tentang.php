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