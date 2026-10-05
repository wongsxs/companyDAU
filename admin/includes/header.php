<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$config = require __DIR__ . '/../../config/app.php';
require_once __DIR__ . '/../../includes/helpers.php';

$currentAdminPage = basename($_SERVER['PHP_SELF']);
$adminName = $_SESSION['admin_name'] ?? 'Admin Pabrik';
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($adminTitle) ? $adminTitle . ' - Panel Admin' : 'Panel Admin' ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-slate-100 text-slate-800 font-sans antialiased min-h-screen flex flex-col">

  <header class="bg-slate-900 text-white border-b border-slate-800 sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <a href="index.php" class="flex items-center gap-2">
          <span class="font-extrabold text-white text-sm">Prima<span class="text-sky-400">Clean</span> Admin</span>
        </a>

        <nav class="hidden md:flex items-center space-x-2 text-xs font-semibold">
          <a href="index.php" class="px-3 py-2 rounded-lg <?= $currentAdminPage === 'index.php' ? 'bg-slate-800 text-sky-400' : 'text-slate-300 hover:text-white' ?>">Dashboard</a>
          <a href="produk.php" class="px-3 py-2 rounded-lg <?= ($currentAdminPage === 'produk.php' || $currentAdminPage === 'produk-form.php') ? 'bg-slate-800 text-sky-400' : 'text-slate-300 hover:text-white' ?>">Produk</a>
          <a href="pesan.php" class="px-3 py-2 rounded-lg <?= $currentAdminPage === 'pesan.php' ? 'bg-slate-800 text-sky-400' : 'text-slate-300 hover:text-white' ?>">Pesan</a>
          <a href="cloudflare.php" class="px-3 py-2 rounded-lg flex items-center gap-1.5 <?= $currentAdminPage === 'cloudflare.php' ? 'bg-orange-500/20 text-orange-400 border border-orange-500/30' : 'text-orange-400 hover:bg-slate-800' ?>">
            <span>⚡ Cloudflare D1</span>
          </a>
          <a href="../index.php" target="_blank" class="px-3 py-2 rounded-lg text-slate-400 hover:text-white">Lihat Web ↗</a>
        </nav>

        <div class="flex items-center gap-3 text-xs">
          <span class="text-slate-300 font-semibold"><?= sanitize($adminName) ?></span>
          <a href="logout.php" class="px-3 py-1.5 rounded-lg bg-red-600/20 text-red-400 hover:bg-red-600 hover:text-white transition font-bold">Keluar</a>
        </div>
      </div>
    </div>
  </header>

  <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
