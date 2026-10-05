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