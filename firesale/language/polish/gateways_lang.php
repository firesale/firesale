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
$lang['firesale:gateways:dummy:desc'] = 'Bramka testowa FireSALE . Przetwarza proste płatności (autoryzacja przy użyciu tylko testowej karty kredytowej).';

// eWAY Shared
$lang['firesale:gateways:eway_shared:name'] = 'eWAY Shared Payments';
$lang['firesale:gateways:eway_shared:desc'] = 'Shared Payments allows your customers to be redirected via HTTP FORM POST to a payment page which is hosted and secured by eWAY.';

// eWAY
$lang['firesale:gateways:eway:name'] = 'eWAY';
$lang['firesale:gateways:eway:desc'] = 'Accept credit cards on your website with the leading UK payment gateway to connect your website directly to your bank to process your customers\' online credit card payments.';

// PayPal Pro
$lang['firesale:gateways:paypal_pro:name'] = 'PayPal Payments Pro';
$lang['firesale:gateways:paypal_pro:desc'] = 'PayPal Payments Pro is an affordable website payment processing solution for businesses with 100+ orders/month.';

// PayPal Express Checkout
$lang['firesale:gateways:paypal_express:name'] = 'PayPal Express Checkout';
$lang['firesale:gateways:paypal_express:desc'] = 'Quick. Customers don’t need to enter their postage and billing information when making a purchase - PayPal already has the information stored.';

// PayPal
$lang['firesale:gateways:paypal:name'] = 'PayPal Payments Standard';
$lang['firesale:gateways:paypal:desc'] = 'Online credit card processing & website payments are simple with PayPal Payments Standard.';

// Payflow Pro
$lang['firesale:gateways:payflow_pro:name'] = 'PayFlow';
$lang['firesale:gateways:payflow_pro:desc'] = 'A payment gateway links your website to your processing network and merchant account. Like most gateways, Payflow payment gateway handles all major credit cards.';

// Sage Pay Server
$lang['firesale:gateways:sagepay_server:name'] = 'Sage Pay Server';
$lang['firesale:gateways:sagepay_server:desc'] = 'Sage Pay Go with Server integration is a winning combination of flexibility and ease of integration. You get the security of outsourcing your payments with the ability to manage transactions and reporting on your own servers.';

// Sage Pay Direct
$lang['firesale:gateways:sagepay_direct:name'] = 'Sage Pay Direct';
$lang['firesale:gateways:sagepay_direct:desc'] = 'Sage Pay Go with Direct integration gives you complete control over the look and feel of your payment pages, and helps you manage the entire payment.';

// Stripe
$lang['firesale:gateways:stripe:name'] = 'Stripe';
$lang['firesale:gateways:stripe:desc'] = 'Stripe makes it easy for developers to accept credit cards on the web.';

// WorldPay
$lang['firesale:gateways:worldpay:name'] = 'WorldPay';
$lang['firesale:gateways:worldpay:desc'] = 'Online payment gateways, online merchant accounts and risk management products to grow your business online.';

// Netaxept
$lang['firesale:gateways:netaxept:name'] = 'Netaxept';
$lang['firesale:gateways:netaxept:desc'] = 'Norwegian payment gateway.';

// Gocardless
$lang['firesale:gateways:gocardless:name'] = 'GoCardless';
$lang['firesale:gateways:gocardless:desc'] = 'GoCardless makes it simple and cheap to take payments online. No merchant account. No credit card fees. No hassle.';

// Cardsave
$lang['firesale:gateways:cardsave:name'] = 'CardSave';
$lang['firesale:gateways:cardsave:desc'] = 'CardSave makes card processing easy with a wide range of cost effective solutions.';

// Rabo OmniKassa
$lang['firesale:gateways:rabo_omnikassa:name'] = 'Rabo OmniKassa';
$lang['firesale:gateways:rabo_omnikassa:desc'] = 'Duch payment gateway.';
