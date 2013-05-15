<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
* This file is part of FireSale, a PHP based eCommerce system built for
* PyroCMS.
*
* Copyright (c) 2013 Moltin Ltd.
* http://github.com/firesale/firesale
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*
* @package firesale/core
* @author FireSale <support@getfiresale.org>
* @copyright 2013 Moltin Ltd.
* @version master
* @link http://github.com/firesale/firesale
*
*/

$lang = array(
    // payment gateways
    'merchant_2checkout'					=> '2Checkout',
    'merchant_authorize_net'				=> 'Authorize.Net AIM',
    'merchant_authorize_net_sim'			=> 'Authorize.Net SIM',
    'merchant_cardsave'						=> 'Cardsave',
    'merchant_dps_pxpay'					=> 'DPS PaymentExpress PxPay',
    'merchant_dps_pxpost'					=> 'DPS PaymentExpress PxPost',
    'merchant_dummy'						=> 'Mannequin',
    'merchant_eway'							=> 'eWay Hosted',
    'merchant_eway_shared'					=> 'eWay Shared',
    'merchant_ideal'						=> 'iDEAL',
    'merchant_inipay'						=> 'INIpay',
    'merchant_gocardless'					=> 'GoCardless',
    'merchant_manual'						=> 'Manuel',
    'merchant_netaxept'						=> 'Nets Netaxept',
    'merchant_ogone_directlink'				=> 'Ogone DirectLink',
    'merchant_payflow_pro'					=> 'Payflow Pro',
    'merchant_paypal'						=> 'PayPal Standard (Déprécié)',
    'merchant_paypal_express'				=> 'PayPal Express',
    'merchant_paypal_pro'					=> 'PayPal Pro',
    'merchant_rabo_omnikassa'				=> 'Rabo OmniKassa',
    'merchant_sagepay_direct'				=> 'Sagepay Direct',
    'merchant_sagepay_server'				=> 'Sagepay Server',
    'merchant_stripe'						=> 'Stripe',
    'merchant_worldpay'						=> 'WorldPay',

    // payment gateway settings
    'merchant_api_login_id'					=> 'Identifiant de l\'API',
    'merchant_transaction_key'				=> 'Clé de transaction',
    'merchant_test_mode'					=> 'Mode de test',
    'merchant_developer_mode'				=> 'Mode de développement',
    'merchant_simulator_mode'				=> 'Mode de simulation',
    'merchant_user_id'						=> 'Identifiant utilisateur',
    'merchant_app_id'						=> 'Identifiant application',
    'merchant_psp_id'						=> 'Identifiant PSP',
    'merchant_api_key'						=> 'Clé API',
    'merchant_key'							=> 'Clé',
    'merchant_key_version'					=> 'Version de la clé',
    'merchant_username'						=> 'Nom d\'utilisateur',
    'merchant_vendor'						=> 'Vendeur',
    'merchant_password'						=> 'Mot de passe',
    'merchant_signature'					=> 'Signature',
    'merchant_customer_id'					=> 'Identifiant client',
    'merchant_merchant_id'					=> 'Identifiant marchand',
    'merchant_account_no'					=> 'Numéro de compte',
    'merchant_installation_id'				=> 'Identifiant de l\'installation',
    'merchant_secret_word'					=> 'Mot secret',
    'merchant_secret'						=> 'Secret',
    'merchant_app_secret'					=> 'Application secret',
    'merchant_secret_key'					=> 'Clé secrète',
    'merchant_token'						=> 'Jeton',
    'merchant_access_token'					=> 'Jeton d\'accès',
    'merchant_payment_response_password'	=> 'Mot de passe de la réponse du paiement',
    'merchant_company_name'					=> 'Nom de la compagnie',
    'merchant_company_logo'					=> 'Logo de la compagnie',
    'merchant_page_title'					=> 'Titre de la page',
    'merchant_page_banner'					=> 'Bannière de la page',
    'merchant_page_description'				=> 'Description de la page',
    'merchant_page_footer'					=> 'Texte supplémentaire de la page',
    'merchant_enable_token_billing'			=> 'Stocker les détails de la carte pour le jeton de facturation',
    'merchant_paypal_email'					=> 'Adresse email du compte PayPal',
    'merchant_acquirer_url'					=> 'URL acquéreur',
    'merchant_public_key_path'				=> 'Chemin de la clé publique sur le serveur',
    'merchant_private_key_path'				=> 'Chemin de la clé privée sur le serveur',
    'merchant_private_key_password'			=> 'Mot de passe de la clé privée',
    'merchant_solution_type'				=> 'Compte PayPal requis',
    'merchant_landing_page'					=> 'Onglet de paiement sélectionné',
    'merchant_solution_type_mark'			=> 'Compte PayPal requis',
    'merchant_solution_type_sole'			=> 'Compte PayPal optionnel',
    'merchant_landing_page_billing'			=> 'Paiement invité / Créer un compte',
    'merchant_landing_page_login'			=> 'Connexion au compte PayPal',

    // payment gateway fields
    'merchant_card_type'					=> 'Type de carte',
    'merchant_card_no'						=> 'Numéro de la carte',
    'merchant_name'							=> 'Nom',
    'merchant_first_name'					=> 'Prénom',
    'merchant_last_name'					=> 'Nom',
    'merchant_card_issue'					=> 'Numéro de carte',
    'merchant_exp_month'					=> 'Mois d\'expiration',
    'merchant_exp_year'						=> 'Année d\'expiration',
    'merchant_start_month'					=> 'Mois de départ',
    'merchant_start_year'					=> 'Année de départ',
    'merchant_csc'							=> 'Cryptogramme',
    'merchant_issuer'						=> 'Emetteur',

    // status/error messages
    'merchant_insecure_connection'			=> 'Les informations de la carte doivent être envoyés via une connexion sécurisée.',
    'merchant_required'						=> 'Le champs %s est requis.',
    'merchant_invalid_card_no'				=> 'Le numéro de la carte est invalide.',
    'merchant_card_expired'					=> 'La carte a expirée.',
    'merchant_invalid_status'				=> 'Statut de paiement invalide.',
    'merchant_invalid_method'				=> 'Méthode de paiement non supportée par la plateforme de paiement.',
    'merchant_invalid_response'				=> 'Réponse invalide de la plateforme de paiement.',
    'merchant_payment_failed'				=> 'Paiement échoué. Merci de réessayer.',
    'merchant_payment_redirect'				=> 'Merci de patienter pendant que nous vous redirigeons vers la page de paiement...',
    'merchant_3dauth_redirect'				=> 'Merci de patienter pendant que nous vous redirigeons vers la page d\'authentification de votre émetteur...'
);

/* End of file ./language/english/merchant_lang.php */
