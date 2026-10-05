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