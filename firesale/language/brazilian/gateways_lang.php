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
$lang['firesale:gateways:2checkout:desc'] = '2Checkout.com � um servi�o de pagamento online que ajuda voc� a aceiar todos os maiores cart�es de cr�dito, d�bito, PayPal and mais.';

// Authorize.Net SIM
$lang['firesale:gateways:authorize_net_sim:name'] = 'Authorize.Net SIM';
$lang['firesale:gateways:authorize_net_sim:desc'] = 'M�todo de Integra��o do Servido (SIM) API utilizando um pagamento de transa�oes atrav�s de sua digital do dedo atrav�s de um formul�rio hospedado e encripta��o 128-bit SSL.';

// Authorize.Net
$lang['firesale:gateways:authorize_net:name'] = 'Authorize.Net';
$lang['firesale:gateways:authorize_net:desc'] = 'Meio de Pagamento que habilita comerciantes a receber pagamentos com cart�o de cr�dito atrav�s da internet e cheque eletr�nico.';

// DPS (PX Pay)
$lang['firesale:gateways:dps_pxpay:name'] = 'DPS (PX Pay)';
$lang['firesale:gateways:dps_pxpay:desc'] = 'Integra��o para DPS PX Pay Gateway para Australia e Nova Zelandia.';

// DPS (PX Post)
$lang['firesale:gateways:dps_pxpost:name'] = 'DPS (PX Post)';
$lang['firesale:gateways:dps_pxpost:desc'] = 'PX POST � designado para manejar transa��es utilizando HTTPS Post Request.';

// Dummy
$lang['firesale:gateways:dummy:name'] = 'FireSALE Simulado';
$lang['firesale:gateways:dummy:desc'] = 'The FireSALE - M�todo de Pagamento Simulado. Para manejar testes de pagamento utilizando um cartao de cr�dito teste somente.';

// eWAY Shared
$lang['firesale:gateways:eway_shared:name'] = 'eWAY Shared Payments';
$lang['firesale:gateways:eway_shared:desc'] = 'Pagamento Compartilhado permite seus clientes serem redirecionados via HTTP FORM POST para a p�gina de pagamento hospedada e com total seguran�a da eWAY.';

// eWAY
$lang['firesale:gateways:eway:name'] = 'eWAY';
$lang['firesale:gateways:eway:desc'] = 'Aceitar cart�es de cr�dito com a UK l�der de meios de pagamento, conectando o seu website diretamente com seu banco para processar seus pagamentos.';

// PayPal Pro
$lang['firesale:gateways:paypal_pro:name'] = 'PayPal Payments Pro';
$lang['firesale:gateways:paypal_pro:desc'] = 'PayPal Payments Pro o mais acess�vel website para pagamento para empresas com mais de 100 pedidos por m�s.';

// PayPal
$lang['firesale:gateways:paypal:name'] = 'PayPal Payments Standard';
$lang['firesale:gateways:paypal:desc'] = 'Processamento Online de pagamentos com cart�o de cr�dito - Simples solu��o para pagamentos utilizando PayPal Payments Standard.';

// Sage Pay Direct
$lang['firesale:gateways:sagepay_direct:name'] = 'Sage Pay Direct';
$lang['firesale:gateways:sagepay_direct:desc'] = 'Sage Pay Go com integra��o direta d� a voc� o controle completo da maneira de pagamento para sua loja.';

// Stripe
$lang['firesale:gateways:stripe:name'] = 'Stripe';
$lang['firesale:gateways:stripe:desc'] = 'Stripe - deixa as coisas simples para desenvolvedores utilizarem pagamento com cart�o de cr�dito atrav�s da web.';

// WorldPay
$lang['firesale:gateways:worldpay:name'] = 'WorldPay';
$lang['firesale:gateways:worldpay:desc'] = 'Online meios de pagamento, online contas de comerciante e gerenciamento de risco para ajudar a expandir seu neg�cio na web.';
