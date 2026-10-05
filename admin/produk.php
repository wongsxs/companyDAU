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