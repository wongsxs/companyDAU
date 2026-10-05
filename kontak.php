<?php
$pageTitle = 'Kontak Kami & Permintaan Penawaran Harga';
$metaDesc = 'Hubungi tim sales dan representatif pabrik PT Bersih Prima Nusantara untuk penawaran harga grosir alat kebersihan, kerjasama distributor, atau survei fasilitas pabrik.';

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/includes/helpers.php';
$config = require __DIR__ . '/config/app.php';

$pdo = getDbConnection();

$successMsg = '';
$errorMsg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitize($_POST['name'] ?? '');
    $company = sanitize($_POST['company_name'] ?? '');
    $email = sanitize($_POST['email'] ?? '');
    $phone = sanitize($_POST['phone'] ?? '');
    $type = sanitize($_POST['type'] ?? 'Pertanyaan Umum');
    $message = sanitize($_POST['message'] ?? '');

    if (empty($name) || empty($phone) || empty($message)) {
        $errorMsg = 'Harap lengkapi nama, nomor telepon/WhatsApp, dan pesan.';
    } else {
        try {
            $stmt = $pdo->prepare("INSERT INTO messages (name, company_name, email, phone, type, message, status) VALUES (?, ?, ?, ?, ?, ?, 'unread')");
            $stmt->execute([$name, $company, $email, $phone, $type, $message]);
            $successMsg = 'Pesan Anda berhasil dikirimkan ke database pabrik. Tim sales kami akan segera menghubungi Anda.';
        } catch (PDOException $e) {
            $errorMsg = 'Gagal menyimpan pesan: ' . $e->getMessage();
        }
    }
}

require_once __DIR__ . '/includes/header.php';
?>

<div class="bg-gradient-to-r from-slate-900 via-brand-950 to-slate-900 text-white py-16 border-b border-slate-800">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center sm:text-left">
    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-500/20 text-brand-300 text-xs font-semibold mb-4 border border-brand-500/30">
      <i data-lucide="map-pin" class="w-4 h-4"></i>
      <span>Pusat Layanan Pelanggan &amp; Pabrik</span>
    </div>
    <h1 class="text-3xl sm:text-4xl md:text-5xl font-black tracking-tight text-white">Hubungi Pabrik Kami</h1>
    <p class="text-slate-300 text-sm sm:text-base mt-3 max-w-3xl leading-relaxed">
      Dapatkan penawaran harga grosir resmi atau jadwalkan survei ke lokasi fasilitas pabrik kami.
    </p>
  </div>
</div>

<section class="py-16 bg-white">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
      
      <div class="lg:col-span-7 bg-slate-50 p-8 sm:p-10 rounded-3xl border border-slate-200">
        <h2 class="text-2xl font-black text-slate-900 mb-6">Kirim Formulir Permintaan Penawaran</h2>

        <?php if ($successMsg): ?>
          <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-300 text-emerald-800 text-xs sm:text-sm">
            <p class="font-bold">✓ <?= $successMsg ?></p>
            <div class="mt-2">
              <a href="<?= getWhatsappUrl($config['whatsapp_number'], 'Halo, saya sudah kirim formulir di website. Mohon responnya.') ?>" target="_blank" class="px-3 py-1.5 bg-emerald-600 text-white rounded-lg text-xs font-bold inline-block">Lanjut Chat ke WhatsApp</a>
            </div>
          </div>
        <?php endif; ?>

        <?php if ($errorMsg): ?>
          <div class="mb-6 p-4 rounded-xl bg-red-50 border border-red-300 text-red-800 text-xs"><?= $errorMsg ?></div>
        <?php endif; ?>

        <form method="POST" action="kontak.php" class="space-y-4">
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="text-xs font-bold text-slate-700">Nama Lengkap *</label>
              <input type="text" name="name" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-xs">
            </div>
            <div>
              <label class="text-xs font-bold text-slate-700">Nama Usaha / Toko</label>
              <input type="text" name="company_name" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-xs">
            </div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
              <label class="text-xs font-bold text-slate-700">Nomor WhatsApp *</label>
              <input type="tel" name="phone" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-xs">
            </div>
            <div>
              <label class="text-xs font-bold text-slate-700">Email (Opsional)</label>
              <input type="email" name="email" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-xs">
            </div>
          </div>

          <div>
            <label class="text-xs font-bold text-slate-700">Jenis Kebutuhan *</label>
            <select name="type" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-xs font-semibold">
              <option value="Pemesanan Grosir Sapu & Pel">Pemesanan Grosir Aneka Sapu &amp; Pel</option>
              <option value="Pendaftaran Agen Distributor">Pendaftaran Agen Distributor Daerah</option>
              <option value="Pengadaan Cleaning Service">Pengadaan Kantor / Cleaning Service</option>
              <option value="Maklon / Private Label">Maklon / Private Label Merk Sendiri</option>
              <option value="Pertanyaan Umum">Pertanyaan Umum Lainnya</option>
            </select>
          </div>

          <div>
            <label class="text-xs font-bold text-slate-700">Pesan / Rincian Kebutuhan *</label>
            <textarea name="message" rows="4" required class="w-full px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-xs"></textarea>
          </div>

          <button type="submit" class="w-full py-3.5 bg-brand-600 hover:bg-brand-700 text-white font-bold text-xs rounded-xl transition">
            Kirimkan Formulir Penawaran
          </button>
        </form>
      </div>

      <div class="lg:col-span-5 space-y-6">
        <div class="bg-slate-900 text-white p-8 rounded-3xl space-y-4">
          <h3 class="text-xl font-bold border-b border-slate-800 pb-3">Informasi Pabrik</h3>
          <p class="text-xs text-slate-300"><strong>Alamat:</strong> <?= sanitize($config['address']) ?></p>
          <p class="text-xs text-slate-300"><strong>Jam Operasional:</strong> <?= sanitize($config['operating_hours']) ?></p>
          <p class="text-xs text-slate-300"><strong>Email:</strong> <?= $config['email'] ?></p>
          <p class="text-xs text-emerald-400 font-bold"><strong>WhatsApp:</strong> <?= $config['phone'] ?></p>
          <div class="pt-4 border-t border-slate-800">
            <a href="<?= getWhatsappUrl($config['whatsapp_number']) ?>" target="_blank" class="w-full py-2.5 bg-emerald-600 text-white rounded-xl font-bold text-xs block text-center">Chat WhatsApp Langsung</a>
          </div>
        </div>

        <div class="rounded-3xl overflow-hidden border border-slate-200 h-64">
          <iframe src="<?= htmlspecialchars($config['maps_embed_url']) ?>" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
      </div>

    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>