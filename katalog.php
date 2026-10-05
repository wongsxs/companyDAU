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