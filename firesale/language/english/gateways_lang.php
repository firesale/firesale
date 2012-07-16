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
$lang['firesale:gateways:2checkout:desc'] = '2Checkout.com is an online payment processing service that helps you accept all major credit cards, debit cards, PayPal and more.';

// Authorize.Net SIM
$lang['firesale:gateways:authorize_net_sim:name'] = 'Authorize.Net SIM';
$lang['firesale:gateways:authorize_net_sim:desc'] = 'Server Integration Method (SIM) API uses a transaction payment fingerprint via a hosted payment form and 128-bit SSL encryption.';

// Authorize.Net
$lang['firesale:gateways:authorize_net:name'] = 'Authorize.Net';
$lang['firesale:gateways:authorize_net:desc'] = 'Payment gateway enables internet merchants to accept online payments via credit card and e-check.';

// DPS (PX Pay)
$lang['firesale:gateways:dps_pxpay:name'] = 'DPS (PX Pay)';
$lang['firesale:gateways:dps_pxpay:desc'] = 'Integration for DPS PX Pay Gateway for Australia and New Zealand.';

// DPS (PX Post)
$lang['firesale:gateways:dps_pxpost:name'] = 'DPS (PX Post)';
$lang['firesale:gateways:dps_pxpost:desc'] = 'PX POST is designed to handle transactions using a HTTPS Post Request.';

// Dummy
$lang['firesale:gateways:dummy:name'] = 'FireSALE Dummy';
$lang['firesale:gateways:dummy:desc'] = 'The FireSALE dummy gateway. Handles sample payment processing (authorizes when using the test credit card number only).';

// eWAY Shared
$lang['firesale:gateways:eway_shared:name'] = 'eWAY Shared Payments';
$lang['firesale:gateways:eway_shared:desc'] = 'Shared Payments allows your customers to be redirected via HTTP FORM POST to a payment page which is hosted and secured by eWAY.';

// eWAY
$lang['firesale:gateways:eway:name'] = 'eWAY';
$lang['firesale:gateways:eway:desc'] = 'Accept credit cards on your website with the leading UK payment gateway to connect your website directly to your bank to process your customers\' online credit card payments.';

// PayPal Pro
$lang['firesale:gateways:paypal_pro:name'] = 'PayPal Payments Pro';
$lang['firesale:gateways:paypal_pro:desc'] = 'PayPal Payments Pro is an affordable website payment processing solution for businesses with 100+ orders/month.';

// PayPal
$lang['firesale:gateways:paypal:name'] = 'PayPal Payments Standard';
$lang['firesale:gateways:paypal:desc'] = 'Online credit card processing & website payments are simple with PayPal Payments Standard.';

// Sage Pay Direct
$lang['firesale:gateways:sagepay_direct:name'] = 'Sage Pay Direct';
$lang['firesale:gateways:sagepay_direct:desc'] = 'Sage Pay Go with Direct integration gives you complete control over the look and feel of your payment pages, and helps you manage the entire payment.';

// Stripe
$lang['firesale:gateways:stripe:name'] = 'Stripe';
$lang['firesale:gateways:stripe:desc'] = 'Stripe makes it easy for developers to accept credit cards on the web.';

// WorldPay
$lang['firesale:gateways:worldpay:name'] = 'WorldPay';
$lang['firesale:gateways:worldpay:desc'] = 'Online payment gateways, online merchant accounts and risk management products to grow your business online.';
