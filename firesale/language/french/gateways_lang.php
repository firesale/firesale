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
$lang['firesale:gateways:2checkout:desc'] = '2Checkout.com est un service de traitement des paiements en ligne qui accepte les principales cartes de crédit, cartes de paiement à débit immédiat, PayPal et d\'autres.';

// Authorize.Net SIM
$lang['firesale:gateways:authorize_net_sim:name'] = 'Authorize.Net SIM';
$lang['firesale:gateways:authorize_net_sim:desc'] = 'L\API Server Integration Method (SIM) API utilise une empreinte de transaction de paiement via un formulaire de paiement en ligne et un encryptage 128-bit SSL.'; 
// to check

// Authorize.Net
$lang['firesale:gateways:authorize_net:name'] = 'Authorize.Net';
$lang['firesale:gateways:authorize_net:desc'] = 'Plateforme de paiement qui permet aux boutiques en ligne d\'accepter les paiements en ligne par cartes de crédit et e-chèques.';

// DPS (PX Pay)
$lang['firesale:gateways:dps_pxpay:name'] = 'DPS (PX Pay)';
$lang['firesale:gateways:dps_pxpay:desc'] = 'Intégration de la plateforme DPS PX Pay pour l\'Australie et la Nouvelle-Zélande.';

// DPS (PX Post)
$lang['firesale:gateways:dps_pxpost:name'] = 'DPS (PX Post)';
$lang['firesale:gateways:dps_pxpost:desc'] = 'PX POST est conçu pour gérer les transactions en utilisant une requête Post en HTTPS Post.';

// Dummy
$lang['firesale:gateways:dummy:name'] = 'FireSALE Dummy';
$lang['firesale:gateways:dummy:desc'] = 'La plateforme FireSALE de test. Gère des process de paiement tests (autorisation avec le numéro de carte de crédit test uniquement).';

// eWAY Shared
$lang['firesale:gateways:eway_shared:name'] = 'eWAY Shared Payments';
$lang['firesale:gateways:eway_shared:desc'] = 'Shared Payments permet à vos clients d\'être redirigés via un formulaire POST HTTP FORM vers une page de paiement hébergée et sécurisée par eWAY.';

// eWAY
$lang['firesale:gateways:eway:name'] = 'eWAY';
$lang['firesale:gateways:eway:desc'] = 'Acceptez des cartes de crédit sur votre site avec la première plateforme de paiement de Grande-Bretagne UK payment gateway pour connecter directement votre site à votre banque et traiter les paiements par carte de crédit de vos clients.';

// PayPal Pro
$lang['firesale:gateways:paypal_pro:name'] = 'PayPal Payments Pro';
$lang['firesale:gateways:paypal_pro:desc'] = 'PayPal Payments Pro est une solution de traitement de paiement en ligne bon marché pour les entreprises avec 100+ commandes/mois.';

// PayPal
$lang['firesale:gateways:paypal:name'] = 'PayPal Payments Standard';
$lang['firesale:gateways:paypal:desc'] = 'Traitement des cartes de crédit en ligne et paiements en ligne sont simples avec PayPal Payments Standard.';

// Sage Pay Direct
$lang['firesale:gateways:sagepay_direct:name'] = 'Sage Pay Direct';
$lang['firesale:gateways:sagepay_direct:desc'] = 'Sage Pay Go avec intégration Direct integration vous donne un contrôle complet de l\'apparence de vos pages de paiement et vous aide à gérer tout le paiement.';

// Stripe
$lang['firesale:gateways:stripe:name'] = 'Stripe';
$lang['firesale:gateways:stripe:desc'] = 'Stripe facilite l\'acceptation des cartes de crédits sur le Web pour les développeurs.';

// WorldPay
$lang['firesale:gateways:worldpay:name'] = 'WorldPay';
$lang['firesale:gateways:worldpay:desc'] = 'Plateforme de paiement en ligen, comptes marchands en ligne et produits de gestion de risque pour développer votre business en ligne.';
