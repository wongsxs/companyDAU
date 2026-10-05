<?php
/**
 * Helper Functions - PT Bersih Prima Nusantara
 */

if (!function_exists('formatRupiah')) {
    function formatRupiah($amount) {
        if ($amount === null || $amount === '') return 'Rp 0';
        return 'Rp ' . number_format((float)$amount, 0, ',', '.');
    }
}

if (!function_exists('formatNumber')) {
    function formatNumber($num) {
        return number_format((float)$num, 0, ',', '.');
    }
}

if (!function_exists('sanitize')) {
    function sanitize($data) {
        return htmlspecialchars(trim((string)$data), ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('createSlug')) {
    function createSlug($string) {
        $string = strtolower(trim($string));
        $string = preg_replace('/[^a-z0-9-]/', '-', $string);
        $string = preg_replace('/-+/', '-', $string);
        return trim($string, '-');
    }
}

if (!function_exists('getWhatsappUrl')) {
    function getWhatsappUrl($phone, $text = '') {
        $cleanPhone = preg_replace('/[^0-9]/', '', $phone);
        if (substr($cleanPhone, 0, 1) === '0') {
            $cleanPhone = '62' . substr($cleanPhone, 1);
        }
        $query = !empty($text) ? '?text=' . urlencode($text) : '';
        return 'https://wa.me/' . $cleanPhone . $query;
    }
}

if (!function_exists('timeAgo')) {
    function timeAgo($datetime) {
        $timestamp = strtotime($datetime);
        $diff = time() - $timestamp;

        if ($diff < 60) {
            return 'Baru saja';
        } elseif ($diff < 3600) {
            return floor($diff / 60) . ' menit yang lalu';
        } elseif ($diff < 86400) {
            return floor($diff / 3600) . ' jam yang lalu';
        } elseif ($diff < 604800) {
            return floor($diff / 86400) . ' hari yang lalu';
        } else {
            return date('d M Y', $timestamp);
        }
    }
}