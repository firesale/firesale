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
$lang['firesale:gateways:2checkout:desc'] = '2Checkout.com й um serviзo de pagamento online que ajuda vocк a aceiar todos os maiores cartхes de crйdito, dйbito, PayPal and mais.';

// Authorize.Net SIM
$lang['firesale:gateways:authorize_net_sim:name'] = 'Authorize.Net SIM';
$lang['firesale:gateways:authorize_net_sim:desc'] = 'Mйtodo de Integraзгo do Servido (SIM) API utilizando um pagamento de transaзoes atravйs de sua digital do dedo atravйs de um formulбrio hospedado e encriptaзгo 128-bit SSL.';

// Authorize.Net
$lang['firesale:gateways:authorize_net:name'] = 'Authorize.Net';
$lang['firesale:gateways:authorize_net:desc'] = 'Meio de Pagamento que habilita comerciantes a receber pagamentos com cartгo de crйdito atravйs da internet e cheque eletrфnico.';

// DPS (PX Pay)
$lang['firesale:gateways:dps_pxpay:name'] = 'DPS (PX Pay)';
$lang['firesale:gateways:dps_pxpay:desc'] = 'Integraзгo para DPS PX Pay Gateway para Australia e Nova Zelandia.';

// DPS (PX Post)
$lang['firesale:gateways:dps_pxpost:name'] = 'DPS (PX Post)';
$lang['firesale:gateways:dps_pxpost:desc'] = 'PX POST й designado para manejar transaзхes utilizando HTTPS Post Request.';

// Dummy
$lang['firesale:gateways:dummy:name'] = 'FireSALE Simulado';
$lang['firesale:gateways:dummy:desc'] = 'The FireSALE - Mйtodo de Pagamento Simulado. Para manejar testes de pagamento utilizando um cartao de crйdito teste somente.';

// eWAY Shared
$lang['firesale:gateways:eway_shared:name'] = 'eWAY Shared Payments';
$lang['firesale:gateways:eway_shared:desc'] = 'Pagamento Compartilhado permite seus clientes serem redirecionados via HTTP FORM POST para a pбgina de pagamento hospedada e com total seguranзa da eWAY.';

// eWAY
$lang['firesale:gateways:eway:name'] = 'eWAY';
$lang['firesale:gateways:eway:desc'] = 'Aceitar cartхes de crйdito com a UK lнder de meios de pagamento, conectando o seu website diretamente com seu banco para processar seus pagamentos.';

// PayPal Express Checkout
$lang['firesale:gateways:paypal_express:name'] = 'PayPal Express Checkout'; #Translate
$lang['firesale:gateways:paypal_express:desc'] = 'Quick. Customers don’t need to enter their postage and billing information when making a purchase - PayPal already has the information stored.'; #Translate

// PayPal Pro
$lang['firesale:gateways:paypal_pro:name'] = 'PayPal Payments Pro';
$lang['firesale:gateways:paypal_pro:desc'] = 'PayPal Payments Pro o mais acessнvel website para pagamento para empresas com mais de 100 pedidos por mкs.';

// PayPal
$lang['firesale:gateways:paypal:name'] = 'PayPal Payments Standard';
$lang['firesale:gateways:paypal:desc'] = 'Processamento Online de pagamentos com cartгo de crйdito - Simples soluзгo para pagamentos utilizando PayPal Payments Standard.';

// Sage Pay Server
$lang['firesale:gateways:sagepay_server:name'] = 'Sage Pay Server'; #Translate
$lang['firesale:gateways:sagepay_server:desc'] = 'Sage Pay Go with Server integration is a winning combination of flexibility and ease of integration. You get the security of outsourcing your payments with the ability to manage transactions and reporting on your own servers.'; #Translate

// Sage Pay Direct
$lang['firesale:gateways:sagepay_direct:name'] = 'Sage Pay Direct';
$lang['firesale:gateways:sagepay_direct:desc'] = 'Sage Pay Go com integraзгo direta dб a vocк o controle completo da maneira de pagamento para sua loja.';

// Stripe
$lang['firesale:gateways:stripe:name'] = 'Stripe';
$lang['firesale:gateways:stripe:desc'] = 'Stripe - deixa as coisas simples para desenvolvedores utilizarem pagamento com cartгo de crйdito atravйs da web.';

// WorldPay
$lang['firesale:gateways:worldpay:name'] = 'WorldPay';
$lang['firesale:gateways:worldpay:desc'] = 'Online meios de pagamento, online contas de comerciante e gerenciamento de risco para ajudar a expandir seu negуcio na web.';

// Netaxept
$lang['firesale:gateways:netaxept:name'] = 'Netaxept'; #Translate
$lang['firesale:gateways:netaxept:desc'] = 'Norwegian payment gateway.'; #Translate

// Gocardless
$lang['firesale:gateways:gocardless:name'] = 'GoCardless'; #Translate
$lang['firesale:gateways:gocardless:desc'] = 'GoCardless makes it simple and cheap to take payments online. No merchant account. No credit card fees. No hassle.'; #Translate
