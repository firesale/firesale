<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * This file stores the names and descriptions of the
 * default FireSALE payment gateways.
 * 
 * The syntax is:
 * 		firesale:gateways:{slug}:name
 * 		firesale:gateways:{slug}:desc
 * 
 * The slug comes from the name of the gateway file.
 * 		e.g. merchant_paypal.php = paypal
 */

// 2checkout
$lang['firesale:gateways:2checkout:name'] = '2Checkout';
$lang['firesale:gateways:2checkout:desc'] = '2Checkout.com adalah layanan proses pembayaran online yang dapat menerima semua katu kredit utama, kartu kredit, PayPal dan sebagainya.';

// Authorize.Net SIM
$lang['firesale:gateways:authorize_net_sim:name'] = 'Authorize.Net SIM';
$lang['firesale:gateways:authorize_net_sim:desc'] = 'Server Integration Method (SIM) API menggunakan sidik jari transaksi pembayaran melalui host formulir pembayaran dan ekripsi SSL 128-bit.';

// Authorize.Net
$lang['firesale:gateways:authorize_net:name'] = 'Authorize.Net';
$lang['firesale:gateways:authorize_net:desc'] = 'Gateway pembayaran yang memungkinkan merchant online untuk dapat menerima pembayaran online melalui kartu kredit dan e-check.';

// DPS (PX Pay)
$lang['firesale:gateways:dps_pxpay:name'] = 'DPS (PX Pay)';
$lang['firesale:gateways:dps_pxpay:desc'] = 'Integrasi DPS PX Pay Gateway untuk Australia dan New Zealand.';

// DPS (PX Post)
$lang['firesale:gateways:dps_pxpost:name'] = 'DPS (PX Post)';
$lang['firesale:gateways:dps_pxpost:desc'] = 'PX POST dirancang untuk menangani transaksi menggunakan HTTPS Post Request.';

// Dummy
$lang['firesale:gateways:dummy:name'] = 'FireSALE Dummy';
$lang['firesale:gateways:dummy:desc'] = 'Contoh gateway untuk FireSALE. Menangani contoh proses pembayaran (authorisasi saat menggunakan tes nomor kartu kredit saja).';

// eWAY Shared
$lang['firesale:gateways:eway_shared:name'] = 'eWAY Shared Payments';
$lang['firesale:gateways:eway_shared:desc'] = 'Shared Payment memungkinkan pelanggan Anda untuk dialihkan melalui HTTP FORM POST ke host halaman pembayaran dan aman oleh eWAY.';

// eWAY
$lang['firesale:gateways:eway:name'] = 'eWAY';
$lang['firesale:gateways:eway:desc'] = 'Menerima kartu kredit di website Anda dengan gateway pembayaran UK yang terdepan untuk terhubung dengan website secara langsing ke bank Anda untuk memproses pembayaran kartu kredit pelanggan Anda.';

// PayPal Pro
$lang['firesale:gateways:paypal_pro:name'] = 'PayPal Payments Pro';
$lang['firesale:gateways:paypal_pro:desc'] = 'PayPal Payments Pro adalah solusi pemrosesan pembayaran website yang terjangkau untuk bisnis dengan pemesanan lebih dari 100 pesanan per bulan.';

// PayPal
$lang['firesale:gateways:paypal:name'] = 'PayPal Payments Standard';
$lang['firesale:gateways:paypal:desc'] = 'Pemrosesan kartu kredit online & pembayaran melalui website lebih mudah dengan PayPal Payments Standard.';

// Sage Pay Direct
$lang['firesale:gateways:sagepay_direct:name'] = 'Sage Pay Direct';
$lang['firesale:gateways:sagepay_direct:desc'] = 'Sage Pay hadir dengan integrasi langsung yang memberikan kontrol lengkap sesuai dengan halaman pembayaran yang Anda inginkan, dan membantu Anda mengatur sejumlah pembayaran.';

// Stripe
$lang['firesale:gateways:stripe:name'] = 'Stripe';
$lang['firesale:gateways:stripe:desc'] = 'Stripe memudahkan pengembang aplikasi untuk menerima kartu kredit di web.';

// WorldPay
$lang['firesale:gateways:worldpay:name'] = 'WorldPay';
$lang['firesale:gateways:worldpay:desc'] = 'Gateway pembayaran online, akun merchant online dan pengaturan resiko produk untuk menumbuhkembangkan bisnis online Anda.';
