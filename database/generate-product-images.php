 <?php
/**
 * Generator Gambar SVG Produk Berkualitas Tinggi
 */

$products = [
    'sapu-ijuk-premium.svg' => [
        'title' => 'Sapu Ijuk Super Aren',
        'subtitle' => 'Serat Aren Pegunungan Grade A',
        'badge' => 'SUPERIOR AREN',
        'theme' => ['#1e293b', '#0f172a', '#334155'], // Dark fiber color
        'type' => 'sapu-ijuk'
    ],
    'sapu-rayung.svg' => [
        'title' => 'Sapu Rayung Tradisional',
        'subtitle' => 'Bunga Rayung Alami Tebal',
        'badge' => 'NATURAL FIBER',
        'theme' => ['#d97706', '#b45309', '#f59e0b'], // Golden amber color
        'type' => 'sapu-rayung'
    ],
    'sapu-nilon.svg' => [
        'title' => 'Sapu Nilon Anti-Statis',
        'subtitle' => 'Flagged Bristles Magnet Debu',
        'badge' => 'DUST MAGNET',
        'theme' => ['#0284c7', '#0369a1', '#38bdf8'], // Clean blue
        'type' => 'sapu-nilon'
    ],
    'sapu-lidi.svg' => [
        'title' => 'Sapu Lidi Aren Outdoor',
        'subtitle' => 'Ulet, Tebal & Tahan Patah',
        'badge' => 'HEAVY DUTY OUTDOOR',
        'theme' => ['#78350f', '#451a03', '#92400e'], // Rich brown
        'type' => 'sapu-lidi'
    ],
    'sapu-dorong.svg' => [
        'title' => 'Sapu Dorong Industri 60cm',
        'subtitle' => 'Bulu Kaku Heavy Duty Gudang',
        'badge' => 'INDUSTRIAL GRADE',
        'theme' => ['#dc2626', '#991b1b', '#ef4444'], // Industrial red
        'type' => 'sapu-dorong'
    ],
    'sapu-set-pengki.svg' => [
        'title' => 'Set Sapu + Pengki Otomatis',
        'subtitle' => 'Sisir Pembersih & Miring 45°',
        'badge' => 'SMART COMBO',
        'theme' => ['#0d9488', '#0f766e', '#14b8a6'], // Modern teal
        'type' => 'sapu-set-pengki'
    ],
    'pel-katun.svg' => [
        'title' => 'Pel Katun Bleaching 350g',
        'subtitle' => 'Super Absorbent High Cotton',
        'badge' => 'SUPER ABSORBENT',
        'theme' => ['#2563eb', '#1d4ed8', '#60a5fa'], // Deep blue & white
        'type' => 'pel-katun'
    ],
    'pel-microfiber.svg' => [
        'title' => 'Pel Microfiber Flat 360°',
        'subtitle' => 'Rotasi Fleksibel & Dual Pad',
        'badge' => 'MICROFIBER 360°',
        'theme' => ['#7c3aed', '#6d28d9', '#a78bfa'], // Modern purple
        'type' => 'pel-microfiber'
    ],
    'pel-jepit-industri.svg' => [
        'title' => 'Pel Jepit Kentucky 450g',
        'subtitle' => 'Klem Standar Rumah Sakit & Mall',
        'badge' => 'COMMERCIAL B2B',
        'theme' => ['#059669', '#047857', '#34d399'], // Hospital green
        'type' => 'pel-jepit'
    ],
    'pel-spin-mop.svg' => [
        'title' => 'Spin Mop Stainless Steel',
        'subtitle' => 'Ember Beroda + Pemeras Otomatis',
        'badge' => 'DELUXE SYSTEM',
        'theme' => ['#ea580c', '#c2410c', '#fb923c'], // Orange dynamic
        'type' => 'pel-spin-mop'
    ],
    'pel-spons-pva.svg' => [
        'title' => 'Pel Spons Karet PVA Roll',
        'subtitle' => 'Tuas Pemeras 4-Rol Sekali Tarik',
        'badge' => 'PVA HIGH ABSORB',
        'theme' => ['#0284c7', '#0891b2', '#06b6d4'], // Cyan aqua
        'type' => 'pel-spons'
    ],
    'pel-strip-nonwoven.svg' => [
        'title' => 'Pel Strip Non-Woven Anti-Bau',
        'subtitle' => 'Cepat Kering & Ringan di Tangan',
        'badge' => 'QUICK DRY',
        'theme' => ['#4f46e5', '#4338ca', '#818cf8'], // Indigo
        'type' => 'pel-strip'
    ]
];

$outputDir = __DIR__ . '/../assets/images/products';
if (!is_dir($outputDir)) {
    mkdir($outputDir, 0777, true);
}

foreach ($products as $filename => $info) {
    $t1 = $info['theme'][0];
    $t2 = $info['theme'][1];
    $t3 = $info['theme'][2];
    $title = htmlspecialchars($info['title']);
    $subtitle = htmlspecialchars($info['subtitle']);
    $badge = htmlspecialchars($info['badge']);

    $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 600 450" width="100%" height="100%" fill="none">
  <defs>
    <linearGradient id="bgGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="#f8fafc" />
      <stop offset="100%" stop-color="#e2e8f0" />
    </linearGradient>
    <linearGradient id="primaryGrad" x1="0%" y1="0%" x2="100%" y2="100%">
      <stop offset="0%" stop-color="{$t1}" />
      <stop offset="100%" stop-color="{$t2}" />
    </linearGradient>
    <filter id="cardShadow" x="-10%" y="-10%" width="120%" height="120%">
      <feDropShadow dx="0" dy="12" stdDeviation="16" flood-color="#0f172a" flood-opacity="0.12"/>
    </filter>
    <radialGradient id="haloGrad" cx="50%" cy="45%" r="45%">
      <stop offset="0%" stop-color="{$t3}" stop-opacity="0.25" />
      <stop offset="100%" stop-color="#ffffff" stop-opacity="0" />
    </radialGradient>
  </defs>

  <!-- Background -->
  <rect width="600" height="450" fill="url(#bgGrad)" rx="16"/>
  <circle cx="300" cy="190" r="160" fill="url(#haloGrad)"/>

  <!-- Grid Pattern Subdued -->
  <g opacity="0.15">
    <line x1="50" y1="0" x2="50" y2="450" stroke="#64748b" stroke-dasharray="4 4" />
    <line x1="150" y1="0" x2="150" y2="450" stroke="#64748b" stroke-dasharray="4 4" />
    <line x1="250" y1="0" x2="250" y2="450" stroke="#64748b" stroke-dasharray="4 4" />
    <line x1="350" y1="0" x2="350" y2="450" stroke="#64748b" stroke-dasharray="4 4" />
    <line x1="450" y1="0" x2="450" y2="450" stroke="#64748b" stroke-dasharray="4 4" />
    <line x1="550" y1="0" x2="550" y2="450" stroke="#64748b" stroke-dasharray="4 4" />
    <line x1="0" y1="100" x2="600" y2="100" stroke="#64748b" stroke-dasharray="4 4" />
    <line x1="0" y1="200" x2="600" y2="200" stroke="#64748b" stroke-dasharray="4 4" />
    <line x1="0" y1="300" x2="600" y2="300" stroke="#64748b" stroke-dasharray="4 4" />
  </g>

  <!-- Quality Badge -->
  <g transform="translate(40, 36)">
    <rect width="170" height="30" rx="15" fill="{$t1}" />
    <text x="85" y="20" font-family="'Plus Jakarta Sans', system-ui, sans-serif" font-weight="700" font-size="11" fill="#ffffff" text-anchor="middle" letter-spacing="1">★ {$badge}</text>
  </g>

  <!-- Factory Quality Seal -->
  <g transform="translate(470, 36)">
    <circle cx="36" cy="18" r="18" fill="#ffffff" stroke="{$t1}" stroke-width="2" />
    <text x="36" y="16" font-family="'Plus Jakarta Sans', system-ui, sans-serif" font-weight="800" font-size="8" fill="{$t1}" text-anchor="middle">QC PASS</text>
    <text x="36" y="25" font-family="'Plus Jakarta Sans', system-ui, sans-serif" font-weight="700" font-size="7" fill="#64748b" text-anchor="middle">PABRIK</text>
  </g>

  <!-- Illustration Object Group -->
  <g transform="translate(300, 195)" filter="url(#cardShadow)">
SVG;

    // Specific Object Illustrations
    if ($info['type'] === 'sapu-ijuk' || $info['type'] === 'sapu-rayung' || $info['type'] === 'sapu-nilon') {
        $bristleColor = ($info['type'] === 'sapu-ijuk') ? '#1e293b' : (($info['type'] === 'sapu-rayung') ? '#d97706' : '#0284c7');
        $capColor = ($info['type'] === 'sapu-ijuk') ? '#0284c7' : (($info['type'] === 'sapu-rayung') ? '#92400e' : '#0369a1');
        $svg .= <<<SVG
    <!-- Broom Handle -->
    <rect x="-8" y="-140" width="16" height="150" rx="8" fill="#94a3b8" stroke="#64748b" stroke-width="2"/>
    <rect x="-10" y="-150" width="20" height="20" rx="5" fill="{$t1}"/>
    <circle cx="0" cy="-140" r="4" fill="#ffffff"/>
    
    <!-- Broom Cap -->
    <path d="M-40 0 L40 0 L48 28 L-48 28 Z" fill="{$capColor}"/>
    <line x1="-48" y1="28" x2="48" y2="28" stroke="#ffffff" stroke-width="3"/>

    <!-- Bristles -->
    <path d="M-48 28 L-80 90 Q0 100 80 90 L48 28 Z" fill="{$bristleColor}"/>
    <!-- Bristle texture lines -->
    <line x1="-60" y1="30" x2="-70" y2="88" stroke="#ffffff" stroke-width="1.5" opacity="0.3"/>
    <line x1="-30" y1="30" x2="-35" y2="92" stroke="#ffffff" stroke-width="1.5" opacity="0.3"/>
    <line x1="0" y1="30" x2="0" y2="95" stroke="#ffffff" stroke-width="1.5" opacity="0.3"/>
    <line x1="30" y1="30" x2="35" y2="92" stroke="#ffffff" stroke-width="1.5" opacity="0.3"/>
    <line x1="60" y1="30" x2="70" y2="88" stroke="#ffffff" stroke-width="1.5" opacity="0.3"/>
    
    <!-- Sparkle particles -->
    <circle cx="85" cy="-20" r="6" fill="#38bdf8"/>
    <circle cx="-75" cy="40" r="4" fill="#facc15"/>
SVG;
    } elseif ($info['type'] === 'sapu-lidi') {
        $svg .= <<<SVG
    <!-- Broom Handle Solid Wood -->
    <rect x="-7" y="-140" width="14" height="130" rx="5" fill="#a16207" stroke="#78350f" stroke-width="2"/>
    <rect x="-9" y="-145" width="18" height="15" rx="3" fill="#451a03"/>
    
    <!-- Iron Binding Ring -->
    <rect x="-24" y="-12" width="48" height="24" rx="4" fill="#475569" stroke="#1e293b" stroke-width="2"/>
    <line x1="-22" y1="-2" x2="22" y2="-2" stroke="#cbd5e1" stroke-width="2"/>
    <line x1="-22" y1="6" x2="22" y2="6" stroke="#cbd5e1" stroke-width="2"/>

    <!-- Lidi Bundle -->
    <path d="M-22 12 L-45 105 Q0 115 45 105 L22 12 Z" fill="#78350f"/>
    <!-- Individual Stick lines -->
    <line x1="-35" y1="15" x2="-42" y2="103" stroke="#451a03" stroke-width="2"/>
    <line x1="-20" y1="15" x2="-22" y2="107" stroke="#451a03" stroke-width="2"/>
    <line x1="-5" y1="15" x2="-5" y2="110" stroke="#451a03" stroke-width="2"/>
    <line x1="10" y1="15" x2="12" y2="108" stroke="#451a03" stroke-width="2"/>
    <line x1="25" y1="15" x2="30" y2="105" stroke="#451a03" stroke-width="2"/>
    <line x1="38" y1="20" x2="42" y2="102" stroke="#451a03" stroke-width="2"/>
SVG;
    } elseif ($info['type'] === 'sapu-dorong') {
        $svg .= <<<SVG
    <!-- Heavy Duty Metal Handle -->
    <line x1="0" y1="-140" x2="0" y2="5" stroke="#475569" stroke-width="14" stroke-linecap="round"/>
    <!-- Metal Support Bracket -->
    <path d="M0 -30 L-40 10 L40 10 Z" fill="none" stroke="#dc2626" stroke-width="4"/>
    
    <!-- Wooden / Aluminum Block -->
    <rect x="-105" y="5" width="210" height="28" rx="6" fill="#1e293b" stroke="#0f172a" stroke-width="2"/>
    <rect x="-100" y="10" width="200" height="8" rx="2" fill="#ef4444"/>

    <!-- Heavy Bristles -->
    <rect x="-100" y="33" width="200" height="55" rx="3" fill="#dc2626"/>
    <line x1="-90" y1="33" x2="-90" y2="88" stroke="#991b1b" stroke-width="4"/>
    <line x1="-50" y1="33" x2="-50" y2="88" stroke="#991b1b" stroke-width="4"/>
    <line x1="0" y1="33" x2="0" y2="88" stroke="#991b1b" stroke-width="4"/>
    <line x1="50" y1="33" x2="50" y2="88" stroke="#991b1b" stroke-width="4"/>
    <line x1="90" y1="33" x2="90" y2="88" stroke="#991b1b" stroke-width="4"/>
SVG;
    } elseif ($info['type'] === 'sapu-set-pengki') {
        $svg .= <<<SVG
    <!-- Dustpan -->
    <g transform="translate(45, 10)">
      <line x1="0" y1="-130" x2="0" y2="0" stroke="#0d9488" stroke-width="10" stroke-linecap="round"/>
      <path d="M-55 0 L55 0 L65 55 L-65 55 Z" fill="#0f766e"/>
      <path d="M-65 55 L65 55 L65 62 L-65 62 Z" fill="#14b8a6"/>
      <!-- Comb teeth -->
      <line x1="-30" y1="0" x2="-30" y2="12" stroke="#ffffff" stroke-width="3"/>
      <line x1="-10" y1="0" x2="-10" y2="12" stroke="#ffffff" stroke-width="3"/>
      <line x1="10" y1="0" x2="10" y2="12" stroke="#ffffff" stroke-width="3"/>
      <line x1="30" y1="0" x2="30" y2="12" stroke="#ffffff" stroke-width="3"/>
    </g>
    <!-- Broom -->
    <g transform="translate(-45, -5) rotate(8)">
      <line x1="0" y1="-120" x2="0" y2="0" stroke="#64748b" stroke-width="8" stroke-linecap="round"/>
      <path d="M-28 0 L28 0 L32 20 L-32 20 Z" fill="#0d9488"/>
      <!-- Angled Bristles -->
      <path d="M-32 20 L-40 68 L32 50 L32 20 Z" fill="#14b8a6"/>
    </g>
SVG;
    } elseif ($info['type'] === 'pel-katun') {
        $svg .= <<<SVG
    <!-- Aluminum Pole -->
    <line x1="0" y1="-140" x2="0" y2="0" stroke="#94a3b8" stroke-width="12" stroke-linecap="round"/>
    <rect x="-8" y="-148" width="16" height="18" rx="4" fill="{$t1}"/>
    <!-- Screw Socket Plastic -->
    <path d="M-22 0 L22 0 L18 22 L-18 22 Z" fill="{$t1}"/>
    <rect x="-25" y="20" width="50" height="10" rx="3" fill="{$t2}"/>

    <!-- 100% Pure White Cotton Mop Threads -->
    <g fill="#f8fafc" stroke="#cbd5e1" stroke-width="1.5">
      <path d="M-24 30 C-40 60 -50 90 -45 110 C-35 115 -25 90 -18 60 Z"/>
      <path d="M-15 30 C-22 65 -25 95 -18 115 C-10 115 -8 90 -5 60 Z"/>
      <path d="M-5 30 C-4 65 -4 95 0 118 C8 118 6 90 5 60 Z"/>
      <path d="M5 30 C8 65 10 95 18 115 C25 115 22 90 15 60 Z"/>
      <path d="M18 30 C25 60 35 90 45 110 C50 115 40 90 24 30 Z"/>
    </g>
    <!-- Mop Band -->
    <rect x="-35" y="65" width="70" height="8" rx="2" fill="{$t1}" opacity="0.8"/>
SVG;
    } elseif ($info['type'] === 'pel-microfiber') {
        $svg .= <<<SVG
    <!-- Steel Pole -->
    <line x1="0" y1="-140" x2="0" y2="-5" stroke="#a78bfa" stroke-width="10" stroke-linecap="round"/>
    
    <!-- 360 Swivel Ball Joint -->
    <circle cx="0" cy="0" r="14" fill="#6d28d9"/>
    <rect x="-8" y="-12" width="16" height="14" fill="#7c3aed"/>

    <!-- Flat Mop Plate -->
    <rect x="-95" y="10" width="190" height="16" rx="4" fill="#4c1d95"/>
    <rect x="-105" y="24" width="210" height="20" rx="5" fill="#7c3aed"/>

    <!-- Microfiber Pad (Purple/White Striped) -->
    <rect x="-110" y="42" width="220" height="20" rx="6" fill="#f5f3ff" stroke="#a78bfa" stroke-width="2"/>
    <g stroke="#7c3aed" stroke-width="2" stroke-linecap="round">
      <line x1="-90" y1="46" x2="-90" y2="58"/>
      <line x1="-60" y1="46" x2="-60" y2="58"/>
      <line x1="-30" y1="46" x2="-30" y2="58"/>
      <line x1="0" y1="46" x2="0" y2="58"/>
      <line x1="30" y1="46" x2="30" y2="58"/>
      <line x1="60" y1="46" x2="60" y2="58"/>
      <line x1="90" y1="46" x2="90" y2="58"/>
    </g>
SVG;
    } elseif ($info['type'] === 'pel-jepit') {
        $svg .= <<<SVG
    <!-- Industrial Metal Pole -->
    <line x1="0" y1="-140" x2="0" y2="-10" stroke="#475569" stroke-width="12" stroke-linecap="round"/>
    <!-- Heavy Duty Clamp Mechanism -->
    <path d="M-30 -10 L30 -10 L38 25 L-38 25 Z" fill="#047857"/>
    <rect x="-42" y="18" width="84" height="16" rx="4" fill="#059669"/>
    <circle cx="-25" cy="26" r="4" fill="#ffffff"/>
    <circle cx="25" cy="26" r="4" fill="#ffffff"/>

    <!-- 450g Mop Cotton Strings -->
    <g fill="#ecfdf5" stroke="#a7f3d0" stroke-width="2">
      <path d="M-36 34 C-55 70 -60 100 -50 115 C-38 120 -30 95 -22 65 Z"/>
      <path d="M-18 34 C-25 75 -25 105 -15 120 C-5 120 -4 95 0 65 Z"/>
      <path d="M0 34 C4 75 5 105 15 120 C25 120 22 95 18 65 Z"/>
      <path d="M22 34 C30 70 38 95 50 115 C60 120 55 70 36 34 Z"/>
    </g>
    <!-- Tail Band -->
    <rect x="-48" y="75" width="96" height="10" rx="3" fill="#047857" opacity="0.85"/>
SVG;
    } elseif ($info['type'] === 'pel-spin-mop') {
        $svg .= <<<SVG
    <!-- Bucket -->
    <rect x="-85" y="-10" width="170" height="95" rx="16" fill="#ea580c"/>
    <rect x="-75" y="0" width="150" height="75" rx="10" fill="#ffffff"/>
    <!-- Stainless Spinner Basket -->
    <ellipse cx="25" cy="35" rx="38" ry="25" fill="#cbd5e1" stroke="#94a3b8" stroke-width="3"/>
    <line x1="25" y1="15" x2="25" y2="55" stroke="#64748b" stroke-width="2"/>
    <line x1="0" y1="35" x2="50" y2="35" stroke="#64748b" stroke-width="2"/>
    <!-- Bucket Wheels -->
    <circle cx="-65" cy="85" r="12" fill="#1e293b"/>
    <circle cx="-65" cy="85" r="5" fill="#e2e8f0"/>
    <circle cx="65" cy="85" r="12" fill="#1e293b"/>
    <circle cx="65" cy="85" r="5" fill="#e2e8f0"/>

    <!-- Spin Mop Pole & Round Head -->
    <g transform="translate(-18, -40)">
      <line x1="0" y1="-95" x2="0" y2="30" stroke="#f97316" stroke-width="8" stroke-linecap="round"/>
      <circle cx="0" cy="35" r="28" fill="#c2410c"/>
      <circle cx="0" cy="35" r="38" fill="none" stroke="#ffffff" stroke-width="6" stroke-dasharray="6 4"/>
    </g>
SVG;
    } elseif ($info['type'] === 'pel-spons') {
        $svg .= <<<SVG
    <!-- Stainless Pole -->
    <line x1="0" y1="-140" x2="0" y2="0" stroke="#cbd5e1" stroke-width="12" stroke-linecap="round"/>
    <!-- Squeeze Lever -->
    <path d="M-15 -60 L-35 -40 L-25 -25 L0 -45 Z" fill="#0284c7"/>
    <line x1="-35" y1="-40" x2="0" y2="-45" stroke="#0369a1" stroke-width="3"/>

    <!-- Roller Mechanism Frame -->
    <rect x="-65" y="0" width="130" height="30" rx="6" fill="#0369a1"/>
    <!-- 4 Rollers -->
    <circle cx="-45" cy="15" r="7" fill="#cbd5e1"/>
    <circle cx="-15" cy="15" r="7" fill="#cbd5e1"/>
    <circle cx="15" cy="15" r="7" fill="#cbd5e1"/>
    <circle cx="45" cy="15" r="7" fill="#cbd5e1"/>

    <!-- Yellow / Cyan PVA Sponge Head -->
    <rect x="-70" y="30" width="140" height="48" rx="8" fill="#38bdf8" stroke="#0284c7" stroke-width="2"/>
    <!-- PVA sponge ribs -->
    <line x1="-50" y1="30" x2="-50" y2="78" stroke="#0284c7" stroke-width="2"/>
    <line x1="-25" y1="30" x2="-25" y2="78" stroke="#0284c7" stroke-width="2"/>
    <line x1="0" y1="30" x2="0" y2="78" stroke="#0284c7" stroke-width="2"/>
    <line x1="25" y1="30" x2="25" y2="78" stroke="#0284c7" stroke-width="2"/>
    <line x1="50" y1="30" x2="50" y2="78" stroke="#0284c7" stroke-width="2"/>
SVG;
    } else {
        // pel-strip
        $svg .= <<<SVG
    <!-- Handle -->
    <line x1="0" y1="-140" x2="0" y2="0" stroke="#818cf8" stroke-width="10" stroke-linecap="round"/>
    <path d="M-22 0 L22 0 L16 22 L-16 22 Z" fill="#4338ca"/>
    
    <!-- Non-woven strips -->
    <g fill="#c7d2fe" stroke="#6366f1" stroke-width="1.5">
      <rect x="-35" y="22" width="12" height="95" rx="3"/>
      <rect x="-20" y="22" width="12" height="98" rx="3"/>
      <rect x="-6" y="22" width="12" height="102" rx="3"/>
      <rect x="8" y="22" width="12" height="98" rx="3"/>
      <rect x="23" y="22" width="12" height="95" rx="3"/>
    </g>
SVG;
    }

    $svg .= <<<SVG
  </g>

  <!-- Product Labels at Bottom -->
  <g transform="translate(50, 365)">
    <rect width="500" height="60" rx="12" fill="#ffffff" filter="url(#cardShadow)"/>
    <text x="25" y="26" font-family="'Plus Jakarta Sans', system-ui, sans-serif" font-weight="800" font-size="16" fill="#0f172a">{$title}</text>
    <text x="25" y="46" font-family="'Plus Jakarta Sans', system-ui, sans-serif" font-weight="500" font-size="12" fill="#64748b">{$subtitle}</text>
    
    <g transform="translate(410, 16)">
      <rect width="65" height="28" rx="6" fill="#f1f5f9"/>
      <text x="32" y="18" font-family="'Plus Jakarta Sans', system-ui, sans-serif" font-weight="700" font-size="10" fill="{$t1}" text-anchor="middle">ASLI PABRIK</text>
    </g>
  </g>
</svg>
SVG;

    file_put_contents($outputDir . '/' . $filename, $svg);
    echo "Generated: {$filename}\n";
}

echo "All 12 product SVGs created successfully!\n";
