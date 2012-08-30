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
$lang['firesale:gateways:2checkout:desc'] = '2Checkout.com щ um serviчo de pagamento online que ajuda vocъ a aceiar todos os maiores cartѕes de crщdito, dщbito, PayPal and mais.';

// Authorize.Net SIM
$lang['firesale:gateways:authorize_net_sim:name'] = 'Authorize.Net SIM';
$lang['firesale:gateways:authorize_net_sim:desc'] = 'Mщtodo de Integraчуo do Servido (SIM) API utilizando um pagamento de transaчoes atravщs de sua digital do dedo atravщs de um formulсrio hospedado e encriptaчуo 128-bit SSL.';

// Authorize.Net
$lang['firesale:gateways:authorize_net:name'] = 'Authorize.Net';
$lang['firesale:gateways:authorize_net:desc'] = 'Meio de Pagamento que habilita comerciantes a receber pagamentos com cartуo de crщdito atravщs da internet e cheque eletrєnico.';

// DPS (PX Pay)
$lang['firesale:gateways:dps_pxpay:name'] = 'DPS (PX Pay)';
$lang['firesale:gateways:dps_pxpay:desc'] = 'Integraчуo para DPS PX Pay Gateway para Australia e Nova Zelandia.';

// DPS (PX Post)
$lang['firesale:gateways:dps_pxpost:name'] = 'DPS (PX Post)';
$lang['firesale:gateways:dps_pxpost:desc'] = 'PX POST щ designado para manejar transaчѕes utilizando HTTPS Post Request.';

// Dummy
$lang['firesale:gateways:dummy:name'] = 'FireSALE Simulado';
$lang['firesale:gateways:dummy:desc'] = 'The FireSALE - Mщtodo de Pagamento Simulado. Para manejar testes de pagamento utilizando um cartao de crщdito teste somente.';

// eWAY Shared
$lang['firesale:gateways:eway_shared:name'] = 'eWAY Shared Payments';
$lang['firesale:gateways:eway_shared:desc'] = 'Pagamento Compartilhado permite seus clientes serem redirecionados via HTTP FORM POST para a pсgina de pagamento hospedada e com total seguranчa da eWAY.';

// eWAY
$lang['firesale:gateways:eway:name'] = 'eWAY';
$lang['firesale:gateways:eway:desc'] = 'Aceitar cartѕes de crщdito com a UK lэder de meios de pagamento, conectando o seu website diretamente com seu banco para processar seus pagamentos.';

// PayPal Pro
$lang['firesale:gateways:paypal_pro:name'] = 'PayPal Payments Pro';
$lang['firesale:gateways:paypal_pro:desc'] = 'PayPal Payments Pro o mais acessэvel website para pagamento para empresas com mais de 100 pedidos por mъs.';

// PayPal
$lang['firesale:gateways:paypal:name'] = 'PayPal Payments Standard';
$lang['firesale:gateways:paypal:desc'] = 'Processamento Online de pagamentos com cartуo de crщdito - Simples soluчуo para pagamentos utilizando PayPal Payments Standard.';

// Sage Pay Direct
$lang['firesale:gateways:sagepay_direct:name'] = 'Sage Pay Direct';
$lang['firesale:gateways:sagepay_direct:desc'] = 'Sage Pay Go com integraчуo direta dс a vocъ o controle completo da maneira de pagamento para sua loja.';

// Stripe
$lang['firesale:gateways:stripe:name'] = 'Stripe';
$lang['firesale:gateways:stripe:desc'] = 'Stripe - deixa as coisas simples para desenvolvedores utilizarem pagamento com cartуo de crщdito atravщs da web.';

// WorldPay
$lang['firesale:gateways:worldpay:name'] = 'WorldPay';
$lang['firesale:gateways:worldpay:desc'] = 'Online meios de pagamento, online contas de comerciante e gerenciamento de risco para ajudar a expandir seu negѓcio na web.';
