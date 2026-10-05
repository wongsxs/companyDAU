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