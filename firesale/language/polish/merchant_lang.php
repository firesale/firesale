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
    'merchant_dummy'						=> 'Dummy',
    'merchant_eway'							=> 'eWay Hosted',
    'merchant_eway_shared'					=> 'eWay Shared',
    'merchant_ideal'						=> 'iDEAL',
    'merchant_inipay'						=> 'INIpay',
    'merchant_gocardless'					=> 'GoCardless',
    'merchant_manual'						=> 'Manual',
    'merchant_netaxept'						=> 'Nets Netaxept',
    'merchant_ogone_directlink'				=> 'Ogone DirectLink',
    'merchant_payflow_pro'					=> 'Payflow Pro',
    'merchant_paypal'						=> 'PayPal Standard (Deprecated)',
    'merchant_paypal_express'				=> 'PayPal Express',
    'merchant_paypal_pro'					=> 'PayPal Pro',
    'merchant_rabo_omnikassa'				=> 'Rabo OmniKassa',
    'merchant_sagepay_direct'				=> 'Sagepay Direct',
    'merchant_sagepay_server'				=> 'Sagepay Server',
    'merchant_stripe'						=> 'Stripe',
    'merchant_worldpay'						=> 'WorldPay',

    // payment gateway settings
    'merchant_api_login_id'					=> 'API Login ID',
    'merchant_transaction_key'				=> 'Klucz tranzakcji',
    'merchant_test_mode'					=> 'Tryb testowy',
    'merchant_developer_mode'				=> 'Tryb developerski',
    'merchant_simulator_mode'				=> 'Tryb symulacji',
    'merchant_user_id'						=> 'User ID',
    'merchant_app_id'						=> 'App ID',
    'merchant_psp_id'						=> 'PSP ID',
    'merchant_api_key'						=> 'API Key',
    'merchant_key'							=> 'Klucz',
    'merchant_key_version'					=> 'Wersja klucza',
    'merchant_username'						=> 'Username',
    'merchant_vendor'						=> 'Sprzedawca',
    'merchant_password'						=> 'Hasło',
    'merchant_signature'					=> 'Sygnatura (podpis)',
    'merchant_customer_id'					=> 'ID Klienta',
    'merchant_merchant_id'					=> 'ID Kupca',
    'merchant_account_no'					=> 'Numer konta',
    'merchant_installation_id'				=> 'ID instalacji',
    'merchant_secret_word'					=> 'Sekretne słowo',
    'merchant_secret'						=> 'Sekret',
    'merchant_app_secret'					=> 'App Secret',
    'merchant_secret_key'					=> 'Sekretny klucz',
    'merchant_token'						=> 'Token',
    'merchant_access_token'					=> 'Token dostępu',
    'merchant_payment_response_password'	=> 'Hasło odpowiedzi płatności',
    'merchant_company_name'					=> 'Nazwa firmy',
    'merchant_company_logo'					=> 'Logo firmy',
    'merchant_page_title'					=> 'Tytuł strony',
    'merchant_page_banner'					=> 'Baner strony',
    'merchant_page_description'				=> 'Opis strony',
    'merchant_page_footer'					=> 'Stopka stronu',
    'merchant_enable_token_billing'			=> 'Store card details for token billing',
    'merchant_paypal_email'					=> 'Email konta PayPal',
    'merchant_acquirer_url'					=> 'Acquirer URL',
    'merchant_public_key_path'				=> 'Public Key Server Path',
    'merchant_private_key_path'				=> 'Private Key Server Path',
    'merchant_private_key_password'			=> 'Private Key Password',
    'merchant_solution_type'				=> 'PayPal Account Required',
    'merchant_landing_page'					=> 'Selected Payment Tab',
    'merchant_solution_type_mark'			=> 'PayPal Account Required',
    'merchant_solution_type_sole'			=> 'PayPal Account Optional',
    'merchant_landing_page_billing'			=> 'Guest Checkout / Create Account',
    'merchant_landing_page_login'			=> 'PayPal Account Login',

    // payment gateway fields
    'merchant_card_type'					=> 'Rodzaj Karty',
    'merchant_card_no'						=> 'Numer karty',
    'merchant_name'							=> 'Nazwa',
    'merchant_first_name'					=> 'Imię',
    'merchant_last_name'					=> 'Nazwisko',
    'merchant_card_issue'					=> 'Card Issue Number',
    'merchant_exp_month'					=> 'Ważna do - miesiąc',
    'merchant_exp_year'						=> 'Ważna do - rok',
    'merchant_start_month'					=> 'Start - miesiąc',
    'merchant_start_year'					=> 'Start - rok',
    'merchant_csc'							=> 'CSC',
    'merchant_issuer'						=> 'Wydawca karty',

    // status/error messages
    'merchant_insecure_connection'			=> 'Dane karty muszą być przesłane przez bezpieczne połączenie',
    'merchant_required'						=> 'Pole %s wymagane',
    'merchant_invalid_card_no'				=> 'Numer karty jest nieprawidłowy.',
    'merchant_card_expired'					=> 'Karta straciła ważność.',
    'merchant_invalid_status'				=> 'Nieprawidłowy status płatności',
    'merchant_invalid_method'				=> 'Metoda nie obsługiwana przez tą bramkę.',
    'merchant_invalid_response'				=> 'Nieprawidłowa odpowiedź z bramki płatności',
    'merchant_payment_failed'				=> 'Płatność nieudana. Spróbuj jeszcze raz',
    'merchant_payment_redirect'				=> 'Proszę czekać. Trwa przekierowanie na stronę płatności...',
    'merchant_3dauth_redirect'				=> 'Proszę czekać. Przekierowujemy Cię do wydawcy karty celem autentykacji....'
);

/* End of file ./language/english/merchant_lang.php */
