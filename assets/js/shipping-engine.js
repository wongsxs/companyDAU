/**
 * Shipping & Order Calculation Engine
 * PT Bersih Prima Nusantara / Jaya Wijaya
 * Mendukung perhitungan order per pcs / grosir, tarif ongkir multi-kurir seluruh Indonesia,
 * dan formatur pesan WhatsApp otomatis.
 */

const SHIPPING_ENGINE = (function() {
  // 1. Data Katalog Produk Lengkap (dengan Berat Gram, Harga Eceran, dan Grosir)
  const PRODUCTS = [
    {
      id: 1,
      sku: 'ART: SP-IJK-01',
      slug: 'sapu-ijuk-super-aren-premium',
      name: 'Sapu Ijuk Super Tebal Gagang Kayu',
      category: 'Sapu Serat Alami',
      priceRetail: 35000,
      priceWholesale: 24500,
      minWholesaleQty: 24,
      weightGram: 450,
      image: 'assets/images/products/sapu-ijuk-premium.svg',
      material: 'Ijuk aren grade A pilihan, serat rapat'
    },
    {
      id: 2,
      sku: 'ART: PL-KTN-01',
      slug: 'pel-katun-bleaching-super-absorbent',
      name: 'Kain Pel Lantai Katun Standar 350g',
      category: 'Pel Lantai',
      priceRetail: 38000,
      priceWholesale: 26000,
      minWholesaleQty: 24,
      weightGram: 550,
      image: 'assets/images/products/pel-katun.svg',
      material: 'Benang katun asli 350g daya serap tinggi'
    },
    {
      id: 3,
      sku: 'ART: SP-RYG-01',
      slug: 'sapu-rayung-tradisional-exclusive',
      name: 'Sapu Rayung Tradisional Gagang Bambu',
      category: 'Sapu Serat Alami',
      priceRetail: 32000,
      priceWholesale: 22000,
      minWholesaleQty: 24,
      weightGram: 400,
      image: 'assets/images/products/sapu-rayung.svg',
      material: 'Bunga gelagah rayung gunung super'
    },
    {
      id: 4,
      sku: 'ART: PL-MCF-01',
      slug: 'pel-microfiber-flat-mop-360-rotasi',
      name: 'Pel Microfiber Datar (Flat Mop 360°)',
      category: 'Pel Lantai',
      priceRetail: 58000,
      priceWholesale: 41000,
      minWholesaleQty: 20,
      weightGram: 600,
      image: 'assets/images/products/pel-microfiber.svg',
      material: 'Pad microfiber densitas tinggi electro-static'
    },
    {
      id: 5,
      sku: 'ART: SP-NLN-01',
      slug: 'sapu-nilon-sintetis-anti-statis',
      name: 'Sapu Nilon Sintetis Anti-Kusut',
      category: 'Sapu Sintetis',
      priceRetail: 28000,
      priceWholesale: 19500,
      minWholesaleQty: 36,
      weightGram: 420,
      image: 'assets/images/products/sapu-nilon.svg',
      material: 'Bulu sintetis PP gelombang anti rontok'
    },
    {
      id: 6,
      sku: 'ART: PL-JPT-01',
      slug: 'pel-jepit-industri-kentucky-mop',
      name: 'Pel Jepit Plat Besi Heavy Duty',
      category: 'Pel Lantai',
      priceRetail: 85000,
      priceWholesale: 64000,
      minWholesaleQty: 12,
      weightGram: 850,
      image: 'assets/images/products/pel-jepit-industri.svg',
      material: 'Benang katun industri 450g ekstra tebal'
    },
    {
      id: 7,
      sku: 'ART: SP-DRG-01',
      slug: 'sapu-dorong-industri-60cm',
      name: 'Sapu Dorong Lapangan / Gudang 60cm',
      category: 'Sapu Industri',
      priceRetail: 95000,
      priceWholesale: 72000,
      minWholesaleQty: 10,
      weightGram: 1200,
      image: 'assets/images/products/sapu-dorong.svg',
      material: 'Serabut nilon/ijuk kaku untuk kotoran kasar'
    },
    {
      id: 8,
      sku: 'ART: PL-SPN-01',
      slug: 'spin-mop-otomatis-double-drive',
      name: 'Pel Putar Otomatis (Spin Mop 360°)',
      category: 'Pel Lantai',
      priceRetail: 145000,
      priceWholesale: 110000,
      minWholesaleQty: 6,
      weightGram: 2100,
      image: 'assets/images/products/pel-spin-mop.svg',
      material: 'Ember stainless steel pemeras cepat + 2 refill'
    },
    {
      id: 9,
      sku: 'ART: SP-PKG-01',
      slug: 'set-sapu-sudut-ergonomis-pengki',
      name: 'Sapu Kamar + Pengki Lipat Tertutup',
      category: 'Set Alat Kebersihan',
      priceRetail: 65000,
      priceWholesale: 46000,
      minWholesaleQty: 15,
      weightGram: 750,
      image: 'assets/images/products/sapu-set-pengki.svg',
      material: 'Pengki plastik bergigi & sapu sudut'
    },
    {
      id: 10,
      sku: 'ART: PL-PVA-01',
      slug: 'pel-spons-karet-pva-absorbent',
      name: 'Pel Spons Busa PVA Serap Air Cepat',
      category: 'Pel Lantai',
      priceRetail: 52000,
      priceWholesale: 37000,
      minWholesaleQty: 24,
      weightGram: 700,
      image: 'assets/images/products/pel-spons-pva.svg',
      material: 'Busa PVA sel terbuka hisap tinggi + tuas peras'
    },
    {
      id: 11,
      sku: 'ART: SP-LDI-01',
      slug: 'sapu-lidi-tebal-outdoor',
      name: 'Sapu Lidi Aren (Kasur & Halaman)',
      category: 'Sapu Serat Alami',
      priceRetail: 25000,
      priceWholesale: 16500,
      minWholesaleQty: 30,
      weightGram: 500,
      image: 'assets/images/products/sapu-lidi.svg',
      material: 'Lidi aren tua tebal, lentur & kokoh'
    },
    {
      id: 12,
      sku: 'ART: PL-STP-01',
      slug: 'pel-strip-non-woven-cepat-kering',
      name: 'Pel Strip Sintetis Non-Woven',
      category: 'Pel Lantai',
      priceRetail: 29000,
      priceWholesale: 19000,
      minWholesaleQty: 30,
      weightGram: 480,
      image: 'assets/images/products/pel-strip-nonwoven.svg',
      material: 'Kain sintetis strip higienis cepat kering'
    }
  ];

  // 2. Data Wilayah Indonesia (Provinsi & Kota/Kabupaten beserta Zona Tarif Ongkir dari Origin Kebumen, Jawa Tengah)
  // Zona Tarif:
  // 1: Jawa Tengah & DIY (Lokal)
  // 2: DKI Jakarta, Jawa Barat, Banten, Jawa Timur
  // 3: Bali, NTB, Lampung, Sumsel
  // 4: Sumatera (Pekanbaru, Medan, Padang, Batam), Kalimantan, Sulawesi
  // 5: Maluku, Papua, NTT
  const DESTINATIONS = [
    {
      province: 'Jawa Tengah',
      zone: 1,
      cities: [
        { name: 'Kab. Kebumen', postal: '54311', isOrigin: true },
        { name: 'Kab. Banyumas / Purwokerto', postal: '53111' },
        { name: 'Kab. Cilacap', postal: '53211' },
        { name: 'Kab. Purworejo', postal: '54111' },
        { name: 'Kab. Magelang', postal: '56111' },
        { name: 'Kota Magelang', postal: '56112' },
        { name: 'Kota Semarang', postal: '50131' },
        { name: 'Kab. Semarang / Ungaran', postal: '50511' },
        { name: 'Kota Surakarta / Solo', postal: '57111' },
        { name: 'Kab. Sukoharjo', postal: '57511' },
        { name: 'Kab. Klaten', postal: '57411' },
        { name: 'Kab. Wonogiri', postal: '57611' },
        { name: 'Kab. Karanganyar', postal: '57711' },
        { name: 'Kab. Boyolali', postal: '57311' },
        { name: 'Kab. Tegal', postal: '52411' },
        { name: 'Kota Tegal', postal: '52111' },
        { name: 'Kab. Pekalongan', postal: '51111' },
        { name: 'Kota Pekalongan', postal: '51112' },
        { name: 'Kab. Kudus', postal: '59311' },
        { name: 'Kab. Pati', postal: '59111' },
        { name: 'Kab. Jepara', postal: '59411' }
      ]
    },
    {
      province: 'DI Yogyakarta',
      zone: 1,
      cities: [
        { name: 'Kota Yogyakarta', postal: '55111' },
        { name: 'Kab. Sleman', postal: '55511' },
        { name: 'Kab. Bantul', postal: '55711' },
        { name: 'Kab. Kulon Progo / Wates', postal: '55611' },
        { name: 'Kab. Gunungkidul / Wonosari', postal: '55811' }
      ]
    },
    {
      province: 'DKI Jakarta',
      zone: 2,
      cities: [
        { name: 'Jakarta Pusat', postal: '10110' },
        { name: 'Jakarta Selatan', postal: '12110' },
        { name: 'Jakarta Barat', postal: '11110' },
        { name: 'Jakarta Timur', postal: '13110' },
        { name: 'Jakarta Utara', postal: '14110' }
      ]
    },
    {
      province: 'Jawa Barat',
      zone: 2,
      cities: [
        { name: 'Kota Bandung', postal: '40111' },
        { name: 'Kab. Bandung / Soreang', postal: '40911' },
        { name: 'Kota Bekasi', postal: '17111' },
        { name: 'Kab. Bekasi / Cikarang', postal: '17530' },
        { name: 'Kota Depok', postal: '16411' },
        { name: 'Kota Bogor', postal: '16111' },
        { name: 'Kab. Bogor / Cibinong', postal: '16911' },
        { name: 'Kota Cirebon', postal: '45111' },
        { name: 'Kab. Cirebon', postal: '45611' },
        { name: 'Kab. Karawang', postal: '41311' },
        { name: 'Kab. Purwakarta', postal: '41111' },
        { name: 'Kab. Tasikmalaya', postal: '46111' },
        { name: 'Kota Tasikmalaya', postal: '46112' },
        { name: 'Kab. Garut', postal: '44111' }
      ]
    },
    {
      province: 'Banten',
      zone: 2,
      cities: [
        { name: 'Kota Tangerang', postal: '15111' },
        { name: 'Kota Tangerang Selatan (Tangsel)', postal: '15310' },
        { name: 'Kab. Tangerang / Tigaraksa', postal: '15720' },
        { name: 'Kota Serang', postal: '42111' },
        { name: 'Kota Cilegon', postal: '42411' },
        { name: 'Kab. Lebak / Rangkasbitung', postal: '42311' }
      ]
    },
    {
      province: 'Jawa Timur',
      zone: 2,
      cities: [
        { name: 'Kota Surabaya', postal: '60111' },
        { name: 'Kab. Sidoarjo', postal: '61211' },
        { name: 'Kota Malang', postal: '65111' },
        { name: 'Kab. Malang', postal: '65163' },
        { name: 'Kab. Gresik', postal: '61111' },
        { name: 'Kab. Pasuruan', postal: '67111' },
        { name: 'Kab. Mojokerto', postal: '61311' },
        { name: 'Kab. Jombang', postal: '61411' },
        { name: 'Kab. Kediri', postal: '64111' },
        { name: 'Kota Kediri', postal: '64112' },
        { name: 'Kab. Jember', postal: '68111' },
        { name: 'Kab. Banyuwangi', postal: '68411' },
        { name: 'Kab. Madiun', postal: '63111' }
      ]
    },
    {
      province: 'Bali',
      zone: 3,
      cities: [
        { name: 'Kota Denpasar', postal: '80111' },
        { name: 'Kab. Badung', postal: '80351' },
        { name: 'Kab. Gianyar', postal: '80511' },
        { name: 'Kab. Tabanan', postal: '82111' },
        { name: 'Kab. Buleleng / Singaraja', postal: '81111' }
      ]
    },
    {
      province: 'Lampung',
      zone: 3,
      cities: [
        { name: 'Kota Bandar Lampung', postal: '35111' },
        { name: 'Kota Metro', postal: '34111' },
        { name: 'Kab. Lampung Selatan', postal: '35511' },
        { name: 'Kab. Lampung Tengah', postal: '34112' }
      ]
    },
    {
      province: 'Sumatera Selatan',
      zone: 3,
      cities: [
        { name: 'Kota Palembang', postal: '30111' },
        { name: 'Kota Prabumulih', postal: '31111' },
        { name: 'Kab. Ogan Ilir', postal: '30662' },
        { name: 'Kab. Banyuasin', postal: '30911' }
      ]
    },
    {
      province: 'Sumatera Utara',
      zone: 4,
      cities: [
        { name: 'Kota Medan', postal: '20111' },
        { name: 'Kab. Deli Serdang', postal: '20511' },
        { name: 'Kota Binjai', postal: '20711' },
        { name: 'Kota Pematangsiantar', postal: '21111' }
      ]
    },
    {
      province: 'Riau & Kepulauan Riau',
      zone: 4,
      cities: [
        { name: 'Kota Pekanbaru', postal: '28111' },
        { name: 'Kota Batam', postal: '29411' },
        { name: 'Kota Tanjung Pinang', postal: '29111' },
        { name: 'Kab. Kampar', postal: '28411' }
      ]
    },
    {
      province: 'Kalimantan Timur',
      zone: 4,
      cities: [
        { name: 'Kota Balikpapan', postal: '76111' },
        { name: 'Kota Samarinda', postal: '75111' },
        { name: 'Kab. Kutai Kartanegara', postal: '75511' }
      ]
    },
    {
      province: 'Kalimantan Selatan',
      zone: 4,
      cities: [
        { name: 'Kota Banjarmasin', postal: '70111' },
        { name: 'Kota Banjarbaru', postal: '70711' },
        { name: 'Kab. Banjar / Martapura', postal: '70611' }
      ]
    },
    {
      province: 'Sulawesi Selatan',
      zone: 4,
      cities: [
        { name: 'Kota Makassar', postal: '90111' },
        { name: 'Kab. Gowa', postal: '92111' },
        { name: 'Kab. Maros', postal: '90511' },
        { name: 'Kota Parepare', postal: '91111' }
      ]
    },
    {
      province: 'Sulawesi Utara',
      zone: 4,
      cities: [
        { name: 'Kota Manado', postal: '95111' },
        { name: 'Kota Bitung', postal: '95511' },
        { name: 'Kota Tomohon', postal: '95411' }
      ]
    },
    {
      province: 'Papua & Maluku',
      zone: 5,
      cities: [
        { name: 'Kota Jayapura', postal: '99111' },
        { name: 'Kota Sorong', postal: '98411' },
        { name: 'Kota Ambon', postal: '97111' },
        { name: 'Kota Kupang (NTT)', postal: '85111' }
      ]
    }
  ];

  // 3. Matriks Tarif Ekspedisi Berdasarkan Zona (per kg)
  // Formula: Biaya = Base Rate Zona + (WeightKg - 1) * NextKgRate
  const COURIER_RATES = {
    // Zona 1 (Jateng & DIY)
    1: [
      { id: 'jnt_ez', code: 'J&T', name: 'J&T Express', service: 'EZ (Reguler)', base: 10000, next: 8000, etd: '1 - 2 Hari', badge: 'Tercepat & Favorit', color: 'red' },
      { id: 'jne_reg', code: 'JNE', name: 'JNE Express', service: 'REG (Reguler)', base: 11000, next: 9000, etd: '1 - 2 Hari', badge: 'Standar', color: 'blue' },
      { id: 'sicepat_reg', code: 'SiCepat', name: 'SiCepat', service: 'REG (SiUntung)', base: 10000, next: 8500, etd: '1 - 2 Hari', badge: 'Hemat', color: 'amber' },
      { id: 'pos_kilat', code: 'POS', name: 'Pos Indonesia', service: 'Kilat Khusus', base: 9000, next: 7500, etd: '2 - 3 Hari', badge: 'Jangkauan Luas', color: 'orange' },
      { id: 'cargo_gokil', code: 'Kargo', name: 'SiCepat GOKIL', service: 'Kargo (Min. 10 kg)', base: 35000, next: 2500, etd: '2 - 4 Hari', isCargo: true, badge: 'Paling Murah Partai Besar', color: 'teal' }
    ],
    // Zona 2 (Jabodetabek, Jabar, Banten, Jatim)
    2: [
      { id: 'jnt_ez', code: 'J&T', name: 'J&T Express', service: 'EZ (Reguler)', base: 16000, next: 14000, etd: '2 - 3 Hari', badge: 'Rekomendasi', color: 'red' },
      { id: 'jne_reg', code: 'JNE', name: 'JNE Express', service: 'REG (Reguler)', base: 18000, next: 15000, etd: '2 - 3 Hari', badge: 'Standar', color: 'blue' },
      { id: 'jne_yes', code: 'JNE', name: 'JNE Express', service: 'YES (Yakin Esok Sampai)', base: 32000, next: 28000, etd: '1 Hari (Besok Sampai)', badge: 'Kilat', color: 'sky' },
      { id: 'sicepat_reg', code: 'SiCepat', name: 'SiCepat', service: 'REG (SiUntung)', base: 16500, next: 14000, etd: '2 - 3 Hari', badge: 'Ekonomis', color: 'amber' },
      { id: 'pos_kilat', code: 'POS', name: 'Pos Indonesia', service: 'Kilat Khusus', base: 15000, next: 13000, etd: '2 - 4 Hari', badge: 'Standar', color: 'orange' },
      { id: 'cargo_gokil', code: 'Kargo', name: 'SiCepat GOKIL', service: 'Kargo (Min. 10 kg)', base: 45000, next: 3500, etd: '3 - 5 Hari', isCargo: true, badge: 'Hemat Grosir', color: 'teal' }
    ],
    // Zona 3 (Bali, Lampung, Sumsel)
    3: [
      { id: 'jnt_ez', code: 'J&T', name: 'J&T Express', service: 'EZ (Reguler)', base: 26000, next: 22000, etd: '2 - 4 Hari', badge: 'Rekomendasi', color: 'red' },
      { id: 'jne_reg', code: 'JNE', name: 'JNE Express', service: 'REG (Reguler)', base: 28000, next: 24000, etd: '3 - 4 Hari', badge: 'Standar', color: 'blue' },
      { id: 'sicepat_reg', code: 'SiCepat', name: 'SiCepat', service: 'REG (SiUntung)', base: 25000, next: 21000, etd: '2 - 4 Hari', badge: 'Ekonomis', color: 'amber' },
      { id: 'pos_kilat', code: 'POS', name: 'Pos Indonesia', service: 'Kilat Khusus', base: 24000, next: 20000, etd: '3 - 5 Hari', badge: 'Standar', color: 'orange' },
      { id: 'cargo_gokil', code: 'Kargo', name: 'SiCepat GOKIL', service: 'Kargo (Min. 10 kg)', base: 65000, next: 5000, etd: '4 - 6 Hari', isCargo: true, badge: 'Hemat Grosir', color: 'teal' }
    ],
    // Zona 4 (Sumatera, Kalimantan, Sulawesi)
    4: [
      { id: 'jnt_ez', code: 'J&T', name: 'J&T Express', service: 'EZ (Reguler)', base: 38000, next: 34000, etd: '3 - 5 Hari', badge: 'Rekomendasi', color: 'red' },
      { id: 'jne_reg', code: 'JNE', name: 'JNE Express', service: 'REG (Reguler)', base: 42000, next: 38000, etd: '3 - 6 Hari', badge: 'Standar', color: 'blue' },
      { id: 'sicepat_reg', code: 'SiCepat', name: 'SiCepat', service: 'REG (SiUntung)', base: 39000, next: 35000, etd: '3 - 5 Hari', badge: 'Ekonomis', color: 'amber' },
      { id: 'pos_kilat', code: 'POS', name: 'Pos Indonesia', service: 'Kilat Khusus', base: 36000, next: 32000, etd: '4 - 7 Hari', badge: 'Standar', color: 'orange' },
      { id: 'cargo_gokil', code: 'Kargo', name: 'SiCepat GOKIL', service: 'Kargo (Min. 10 kg)', base: 95000, next: 8500, etd: '5 - 8 Hari', isCargo: true, badge: 'Hemat Grosir', color: 'teal' }
    ],
    // Zona 5 (Maluku, Papua, NTT)
    5: [
      { id: 'jnt_ez', code: 'J&T', name: 'J&T Express', service: 'EZ (Reguler)', base: 68000, next: 60000, etd: '4 - 7 Hari', badge: 'Rekomendasi', color: 'red' },
      { id: 'jne_reg', code: 'JNE', name: 'JNE Express', service: 'REG (Reguler)', base: 75000, next: 68000, etd: '5 - 8 Hari', badge: 'Standar', color: 'blue' },
      { id: 'pos_kilat', code: 'POS', name: 'Pos Indonesia', service: 'Kilat Khusus', base: 62000, next: 55000, etd: '5 - 10 Hari', badge: 'Jangkauan Luas', color: 'orange' }
    ]
  };

  // Helper format rupiah
  function formatRupiah(num) {
    if (num === null || num === undefined || isNaN(num)) return 'Rp 0';
    return 'Rp ' + Number(num).toLocaleString('id-ID');
  }

  // Cari produk berdasarkan ID atau SKU
  function getProduct(identifier) {
    if (!identifier) return PRODUCTS[0];
    return PRODUCTS.find(p => p.id == identifier || p.sku == identifier || p.slug == identifier) || PRODUCTS[0];
  }

  // Hitung Ongkos Kirim per kurir berdasarkan zona dan total berat gram
  function calculateShippingOptions(zone, totalWeightGram) {
    const list = COURIER_RATES[zone] || COURIER_RATES[2];
    const weightKg = Math.max(1, Math.ceil(totalWeightGram / 1000));

    return list.map(courier => {
      let cost = 0;
      if (courier.isCargo) {
        // Kargo minimum 10 kg
        const cargoWeight = Math.max(10, weightKg);
        cost = courier.base + (cargoWeight - 10) * courier.next;
      } else {
        cost = courier.base + (weightKg - 1) * courier.next;
      }

      return {
        ...courier,
        cost: cost,
        costFormatted: formatRupiah(cost),
        chargeableKg: courier.isCargo ? Math.max(10, weightKg) : weightKg
      };
    });
  }

  // Format Pesan WhatsApp Checkout Lengkap
  function buildWhatsappMessage(orderData) {
    const p = orderData.product;
    const isWholesale = orderData.qty >= p.minWholesaleQty;
    const invoiceNumber = 'INV/' + new Date().getFullYear() + ('0' + (new Date().getMonth() + 1)).slice(-2) + '/' + Math.floor(1000 + Math.random() * 9000);

    const message = [
      `*PESANAN BARU #${invoiceNumber}*`,
      `Pabrik Alat Kebersihan PT Bersih Prima Nusantara / Jaya Wijaya`,
      `----------------------------------------`,
      `📦 *DETAIL BARANG*`,
      `• Produk: *${p.name}*`,
      `• SKU: ${p.sku}`,
      `• Jumlah: *${orderData.qty} pcs* ${isWholesale ? '(Harga Grosir Pabrik)' : '(Harga Eceran)'}`,
      `• Harga Satuan: ${formatRupiah(orderData.unitPrice)} / pcs`,
      `• Berat Satuan: ${p.weightGram} gram`,
      `• Total Berat: *${orderData.totalWeightGram} gram* (dihitung ${orderData.chargeableKg} kg)`,
      `• Subtotal Barang: *${formatRupiah(orderData.subtotal)}*`,
      ``,
      `🚚 *JASA PENGIRIMAN*`,
      `• Ekspedisi: *${orderData.courier.name}* (${orderData.courier.service})`,
      `• Estimasi Waktu: ${orderData.courier.etd}`,
      `• Ongkos Kirim: *${formatRupiah(orderData.courier.cost)}*`,
      ``,
      `📍 *ALAMAT PENERIMA*`,
      `• Nama Penerima: *${orderData.customer.name}*`,
      `• No. WhatsApp/HP: *${orderData.customer.phone}*`,
      `• Alamat Lengkap: ${orderData.customer.address}`,
      `• Kota/Kabupaten: ${orderData.customer.city}`,
      `• Provinsi: ${orderData.customer.province}`,
      `• Kode Pos: ${orderData.customer.postal || '-'}`,
      orderData.customer.notes ? `• Catatan: ${orderData.customer.notes}` : '',
      `----------------------------------------`,
      `💰 *TOTAL AKHIR PEMBAYARAN: ${formatRupiah(orderData.finalTotal)}*`,
      `----------------------------------------`,
      `Halo Sales & Admin, saya sudah mengisi alamat dan memilih kurir. Mohon info nomor rekening / QRIS untuk transfer pembayaran. Terima kasih!`
    ].filter(line => line !== null && line !== undefined && line !== '').join('\n');

    return encodeURIComponent(message);
  }

  return {
    products: PRODUCTS,
    destinations: DESTINATIONS,
    getProduct: getProduct,
    formatRupiah: formatRupiah,
    calculateShippingOptions: calculateShippingOptions,
    buildWhatsappMessage: buildWhatsappMessage
  };
})();

// Ekspor ke window jika di browser, atau module.exports jika di Node
if (typeof window !== 'undefined') {
  window.SHIPPING_ENGINE = SHIPPING_ENGINE;
}
if (typeof module !== 'undefined' && module.exports) {
  module.exports = SHIPPING_ENGINE;
}
