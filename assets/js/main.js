document.addEventListener('DOMContentLoaded', () => {
  const mobileMenuBtn = document.getElementById('mobileMenuBtn');
  const mobileDrawer = document.getElementById('mobileDrawer');
  const menuOpenIcon = document.getElementById('menuOpenIcon');
  const menuCloseIcon = document.getElementById('menuCloseIcon');

  if (mobileMenuBtn && mobileDrawer) {
    mobileMenuBtn.addEventListener('click', () => {
      const isExpanded = !mobileDrawer.classList.contains('hidden');
      if (isExpanded) {
        mobileDrawer.classList.add('hidden');
        if (menuOpenIcon) menuOpenIcon.classList.remove('hidden');
        if (menuCloseIcon) menuCloseIcon.classList.add('hidden');
      } else {
        mobileDrawer.classList.remove('hidden');
        if (menuOpenIcon) menuOpenIcon.classList.add('hidden');
        if (menuCloseIcon) menuCloseIcon.classList.remove('hidden');
      }
    });
  }

  if (typeof lucide !== 'undefined') {
    lucide.createIcons();
  }
});

function openWhatsAppOrder(productName, priceWholesale, minQty, phone) {
  const text = `Halo Sales PT Bersih Prima Nusantara,\n\nSaya tertarik dengan produk:\n*${productName}*\n(Harga Grosir: Rp ${Number(priceWholesale).toLocaleString('id-ID')} / unit, Min. Order: ${minQty} unit)\n\nMohon info ketersediaan stok pabrik dan estimasi ongkos kirim ke kota saya.\nTerima kasih.`;
  const cleanPhone = phone.replace(/[^0-9]/g, '');
  const url = `https://wa.me/${cleanPhone}?text=${encodeURIComponent(text)}`;
  window.open(url, '_blank');
}