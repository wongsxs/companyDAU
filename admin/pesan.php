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