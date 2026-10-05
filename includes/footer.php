<?php
if (!isset($config)) {
    $config = require __DIR__ . '/../config/app.php';
}
?>
  </main>

  <aside aria-label="Quick WhatsApp Contact" class="fixed bottom-6 right-6 z-50 group">
    <a href="<?= getWhatsappUrl($config['whatsapp_number'], 'Halo Sales PT Bersih Prima Nusantara, saya ingin bertanya katalog dan penawaran harga alat kebersihan.') ?>" 
       target="_blank" 
       rel="noopener noreferrer"
       class="relative flex items-center gap-3 bg-emerald-500 hover:bg-emerald-600 text-white font-bold p-3.5 sm:px-5 sm:py-3.5 rounded-full shadow-2xl hover:shadow-emerald-500/50 transition-all duration-300 transform hover:scale-105 active:scale-95"
       title="Chat Sales WhatsApp Langsung">
      <span class="absolute -top-1 -right-1 flex h-4 w-4">
        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
        <span class="relative inline-flex rounded-full h-4 w-4 bg-emerald-500 border-2 border-white"></span>
      </span>
      <i data-lucide="message-circle" class="w-6 h-6"></i>
      <span class="hidden sm:inline-block text-sm">Konsultasi WhatsApp</span>
    </a>
  </aside>

  <footer class="bg-slate-950 text-slate-400 pt-16 pb-8 border-t border-slate-800 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10 pb-12 border-b border-slate-800">
        
        <div class="lg:col-span-2 space-y-4">
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-brand-600 flex items-center justify-center text-white font-bold shadow-md">
              <i data-lucide="sparkles" class="w-6 h-6"></i>
            </div>
            <div>
              <span class="text-xl font-extrabold text-white tracking-tight">Prima<span class="text-brand-400">Clean</span> Nusantara</span>
              <p class="text-xs text-slate-400 tracking-wider font-semibold uppercase">PT Bersih Prima Nusantara</p>
            </div>
          </div>
          
          <p class="text-sm text-slate-300 leading-relaxed max-w-sm">
            Perusahaan manufaktur terkemuka yang bergerak di bidang produksi aneka alat kebersihan, dengan fokus utama pada ragam sapu premium dan pel lantai komersial berkualitas tinggi.
          </p>

          <div class="pt-2 flex items-center gap-3 text-xs font-semibold text-slate-300">
            <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-800 text-brand-400 flex items-center gap-1">
              <i data-lucide="award" class="w-3.5 h-3.5"></i> Standar Mutu SNI
            </span>
            <span class="px-2.5 py-1 rounded bg-slate-900 border border-slate-800 text-emerald-400 flex items-center gap-1">
              <i data-lucide="check-circle-2" class="w-3.5 h-3.5"></i> Pabrik Langsung
            </span>
          </div>
        </div>

        <div>
          <h4 class="text-sm font-bold text-white tracking-wider uppercase mb-4 flex items-center gap-2">
            <i data-lucide="navigation" class="w-4 h-4 text-brand-400"></i> Navigasi
          </h4>
          <ul class="space-y-2.5 text-sm">
            <li><a href="index.php" class="hover:text-white transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-600"></i> Beranda Utama</a></li>
            <li><a href="tentang.php" class="hover:text-white transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-600"></i> Tentang Perusahaan</a></li>
            <li><a href="katalog.php" class="hover:text-white transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-600"></i> Semua Produk</a></li>
            <li><a href="kerjasama.php" class="hover:text-white transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-600"></i> Peluang Distributor</a></li>
            <li><a href="kontak.php" class="hover:text-white transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-600"></i> Kontak &amp; Lokasi</a></li>
            <li><a href="admin/login.php" class="text-slate-500 hover:text-brand-400 transition flex items-center gap-1.5"><i data-lucide="lock" class="w-3 h-3"></i> Admin Login</a></li>
          </ul>
        </div>

        <div>
          <h4 class="text-sm font-bold text-white tracking-wider uppercase mb-4 flex items-center gap-2">
            <i data-lucide="brush" class="w-4 h-4 text-brand-400"></i> Produk Utama
          </h4>
          <ul class="space-y-2.5 text-sm">
            <li><a href="katalog.php?kategori=aneka-sapu" class="hover:text-white transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-600"></i> Sapu Ijuk Aren Premium</a></li>
            <li><a href="katalog.php?kategori=aneka-sapu" class="hover:text-white transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-600"></i> Sapu Rayung Alami</a></li>
            <li><a href="katalog.php?kategori=aneka-sapu" class="hover:text-white transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-600"></i> Sapu Dorong Industri</a></li>
            <li><a href="katalog.php?kategori=aneka-pel-lantai" class="hover:text-white transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-600"></i> Pel Katun Bleaching</a></li>
            <li><a href="katalog.php?kategori=aneka-pel-lantai" class="hover:text-white transition flex items-center gap-1.5"><i data-lucide="chevron-right" class="w-3.5 h-3.5 text-slate-600"></i> Pel Microfiber 360°</a></li>
          </ul>
        </div>

        <div class="lg:col-span-2 space-y-3 text-xs leading-relaxed">
          <h4 class="text-sm font-bold text-white tracking-wider uppercase mb-4 flex items-center gap-2">
            <i data-lucide="map-pin" class="w-4 h-4 text-brand-400"></i> Pabrik &amp; Kantor
          </h4>
          <p class="flex items-start gap-2">
            <i data-lucide="map-pin" class="w-4 h-4 text-brand-400 shrink-0 mt-0.5"></i>
            <span><?= sanitize($config['address']) ?></span>
          </p>
          <p class="flex items-center gap-2">
            <i data-lucide="clock" class="w-4 h-4 text-brand-400 shrink-0"></i>
            <span><?= sanitize($config['operating_hours']) ?></span>
          </p>
          <p class="flex items-center gap-2">
            <i data-lucide="mail" class="w-4 h-4 text-brand-400 shrink-0"></i>
            <a href="mailto:<?= $config['email'] ?>" class="hover:text-white transition"><?= $config['email'] ?></a>
          </p>
          <p class="flex items-center gap-2">
            <i data-lucide="phone" class="w-4 h-4 text-emerald-400 shrink-0"></i>
            <a href="<?= getWhatsappUrl($config['whatsapp_number']) ?>" target="_blank" class="text-emerald-400 font-bold hover:underline"><?= $config['phone'] ?> (WhatsApp)</a>
          </p>
        </div>

      </div>

      <div class="pt-8 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
        <p>&copy; <?= date('Y') ?> <strong><?= sanitize($config['app_name']) ?></strong>. Seluruh Hak Cipta Dilindungi.</p>
      </div>
    </div>
  </footer>

  <script src="assets/js/main.js"></script>
  <script>
    if (typeof lucide !== 'undefined') {
      lucide.createIcons();
    }
  </script>
</body>
</html>