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

        <div class="bg-emerald-50 rounded-2xl p-6 border border-emerald-200 space-y-4">
          <div class="flex items-center justify-between">
            <h3 class="text-sm font-bold text-slate-900">Pesan Satuan (Pcs) / Grosir &amp; Hitung Ongkir</h3>
            <span class="text-[11px] font-mono text-emerald-800 bg-emerald-100 px-2 py-0.5 rounded font-bold">Kirim Seluruh RI</span>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 items-center">
            <div>
              <label class="text-xs font-bold text-slate-700">Jumlah Pesanan (Pcs):</label>
              <input type="number" id="orderQtyInput" value="1" min="1" class="w-full px-3 py-2 bg-white rounded-xl border border-emerald-300 font-bold text-slate-900 text-sm">
            </div>
            <div>
              <label class="text-xs font-bold text-slate-700">Estimasi Subtotal:</label>
              <div id="estimatedTotalDisplay" class="px-3 py-2 bg-white rounded-xl border border-emerald-300 font-black text-emerald-800 text-sm">
                <?= formatRupiah($product['price_retail']) ?>
              </div>
            </div>
            <div class="pt-2 sm:pt-0">
              <a id="btnGoCheckout" href="checkout.html?id=<?= $product['id'] ?>&qty=1" class="w-full py-2.5 px-4 bg-teal-700 hover:bg-teal-800 text-white font-bold text-xs rounded-xl flex items-center justify-center gap-1.5 shadow">
                <i data-lucide="truck" class="w-4 h-4"></i> Cek Ongkir &amp; Order
              </a>
            </div>
          </div>

          <div id="priceTierNotice" class="text-xs text-slate-600 bg-white/80 p-2.5 rounded-xl border border-emerald-200/60 flex flex-col sm:flex-row sm:items-center justify-between gap-1">
            <span id="tierLabel">Harga Eceran: <strong><?= formatRupiah($product['price_retail']) ?></strong>/pcs</span>
            <span class="text-[11px] text-teal-800 font-semibold">Min. Grosir: <?= $product['min_wholesale_qty'] ?> pcs (<?= formatRupiah($product['price_wholesale']) ?>)</span>
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
  const priceRetail = <?= (int)$product['price_retail'] ?>;
  const priceWholesale = <?= (int)$product['price_wholesale'] ?>;
  const minWholesaleQty = <?= (int)$product['min_wholesale_qty'] ?>;
  const productId = <?= (int)$product['id'] ?>;
  const productName = <?= json_encode($product['name']) ?>;
  const whatsappNumber = <?= json_encode($config['whatsapp_number']) ?>;
  const qtyInput = document.getElementById('orderQtyInput');
  const displayTotal = document.getElementById('estimatedTotalDisplay');
  const btnGoCheckout = document.getElementById('btnGoCheckout');
  const tierLabel = document.getElementById('tierLabel');

  function recalculate() {
    let qty = parseInt(qtyInput.value) || 1;
    if (qty < 1) qty = 1;
    const isWholesale = qty >= minWholesaleQty;
    const unitPrice = isWholesale ? priceWholesale : priceRetail;
    const total = qty * unitPrice;
    
    if (displayTotal) {
      displayTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');
    }
    if (tierLabel) {
      tierLabel.innerHTML = isWholesale 
        ? `🎉 <strong class="text-emerald-700">Harga Grosir Pabrik!</strong> (Rp ${priceWholesale.toLocaleString('id-ID')}/pcs)`
        : `Harga Eceran: <strong>Rp ${priceRetail.toLocaleString('id-ID')}</strong>/pcs (Beli ${minWholesaleQty - qty} lagi untuk grosir)`;
    }
    if (btnGoCheckout) {
      btnGoCheckout.href = `checkout.html?id=${productId}&qty=${qty}`;
    }
  }

  if (qtyInput) {
    qtyInput.addEventListener('input', recalculate);
    recalculate();
  }
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>