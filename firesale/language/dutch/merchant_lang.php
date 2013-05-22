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
    'merchant_transaction_key'				=> 'Transactie Sleutel',
    'merchant_test_mode'					=> 'Test Mode',
    'merchant_developer_mode'				=> 'Ontwikkelaars Mode',
    'merchant_simulator_mode'				=> 'Simulator Mode',
    'merchant_user_id'						=> 'Gebruikers ID',
    'merchant_app_id'						=> 'App ID',
    'merchant_psp_id'						=> 'PSP ID',
    'merchant_api_key'						=> 'API Sleutel',
    'merchant_key'							=> 'Sleutel',
    'merchant_key_version'					=> 'Sleutel Versie',
    'merchant_username'						=> 'Gebruikersnaam',
    'merchant_vendor'						=> 'Verkoper',
    'merchant_password'						=> 'Wachtwoord',
    'merchant_signature'					=> 'Handtekening',
    'merchant_customer_id'					=> 'Klant ID',
    'merchant_merchant_id'					=> 'Handelaars ID',
    'merchant_account_no'					=> 'Account Nummer',
    'merchant_installation_id'				=> 'Installatie ID',
    'merchant_secret_word'					=> 'Geheim Woord',
    'merchant_secret'						=> 'Geheim',
    'merchant_app_secret'					=> 'App Geheim',
    'merchant_secret_key'					=> 'Geheim Key',
    'merchant_token'						=> 'Token',
    'merchant_access_token'					=> 'Toegangs Token',
    'merchant_payment_response_password'	=> 'Betalings Antwoord Wachtwoord',
    'merchant_company_name'					=> 'Bedrijfsnaam',
    'merchant_company_logo'					=> 'Bedrijfslogo',
    'merchant_page_title'					=> 'Pagina Titel',
    'merchant_page_banner'					=> 'Pagina Banner',
    'merchant_page_description'				=> 'Pagina Omschrijving',
    'merchant_page_footer'					=> 'Pagina Footer',
    'merchant_enable_token_billing'			=> 'Winkel kaart details voor token rekeningen',
    'merchant_paypal_email'					=> 'PayPal Account Email',
    'merchant_acquirer_url'					=> 'Verkrijger URL',
    'merchant_public_key_path'				=> 'Publieke Key Server Locatie',
    'merchant_private_key_path'				=> 'Privé Key Server Locatie',
    'merchant_private_key_password'			=> 'Privé Key wachtwoord',
    'merchant_solution_type'				=> 'PayPal Account Vereist',
    'merchant_landing_page'					=> 'Geselecteerd Betalings Tab',
    'merchant_solution_type_mark'			=> 'PayPal Account Vereist',
    'merchant_solution_type_sole'			=> 'PayPal Account Optioneel',
    'merchant_landing_page_billing'			=> 'Gast Checkout / Maak een Account',
    'merchant_landing_page_login'			=> 'PayPal Account Login',

    // payment gateway fields
    'merchant_card_type'					=> 'Kaart Type',
    'merchant_card_no'						=> 'Kaart Nummer',
    'merchant_name'							=> 'Naam',
    'merchant_first_name'					=> 'Voornaam',
    'merchant_last_name'					=> 'Achternaam',
    'merchant_card_issue'					=> 'Pas Nummer',
    'merchant_exp_month'					=> 'Verloop Maand',
    'merchant_exp_year'						=> 'Verloop Jaar',
    'merchant_start_month'					=> 'Start Maand',
    'merchant_start_year'					=> 'Start Jaar',
    'merchant_csc'							=> 'CSC',
    'merchant_issuer'						=> 'Uitgever',

    // status/error messages
    'merchant_insecure_connection'			=> 'Kaart details moeten over een beveiligde verbinding worden aangeleverd.',
    'merchant_required'						=> 'Het %s veld is verplicht.',
    'merchant_invalid_card_no'				=> 'Kaart nummer is ongeldig.',
    'merchant_card_expired'					=> 'Kaart is verlopen.',
    'merchant_invalid_status'				=> 'Ongeldige betaal status',
    'merchant_invalid_method'				=> 'Deze methode wordt niet ondersteund door deze betalingspoort.',
    'merchant_invalid_response'				=> 'Ongeldig antwoord van de betalingspoort.',
    'merchant_payment_failed'				=> 'Betaling is mislukt. probeert het later nog eens.',
    'merchant_payment_redirect'				=> 'Een ogenblik geduld terwijl we je doorsturen naar de betalingspoort...',
    'merchant_3dauth_redirect'				=> 'Een ogenblik geduld erwijl we je doorsturen naar je kaart uitgever voor authentication...'
);

/* End of file ./language/dutch/merchant_lang.php */
