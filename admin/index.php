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