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
    'merchant_transaction_key'				=> 'Transaction Key',
    'merchant_test_mode'					=> 'Test Mode',
    'merchant_developer_mode'				=> 'Developer Mode',
    'merchant_simulator_mode'				=> 'Simulator Mode',
    'merchant_user_id'						=> 'User ID',
    'merchant_app_id'						=> 'App ID',
    'merchant_psp_id'						=> 'PSP ID',
    'merchant_api_key'						=> 'API Key',
    'merchant_key'							=> 'Key',
    'merchant_key_version'					=> 'Key Version',
    'merchant_username'						=> 'Username',
    'merchant_vendor'						=> 'Vendor',
    'merchant_password'						=> 'Password',
    'merchant_signature'					=> 'Signature',
    'merchant_customer_id'					=> 'Customer ID',
    'merchant_merchant_id'					=> 'Merchant ID',
    'merchant_account_no'					=> 'Account No',
    'merchant_installation_id'				=> 'Installation ID',
    'merchant_secret_word'					=> 'Secret Word',
    'merchant_secret'						=> 'Secret',
    'merchant_app_secret'					=> 'App Secret',
    'merchant_secret_key'					=> 'Secret Key',
    'merchant_token'						=> 'Token',
    'merchant_access_token'					=> 'Access Token',
    'merchant_payment_response_password'	=> 'Payment Response Password',
    'merchant_company_name'					=> 'Company Name',
    'merchant_company_logo'					=> 'Company Logo',
    'merchant_page_title'					=> 'Page Title',
    'merchant_page_banner'					=> 'Page Banner',
    'merchant_page_description'				=> 'Page Description',
    'merchant_page_footer'					=> 'Page Footer',
    'merchant_enable_token_billing'			=> 'Store card details for token billing',
    'merchant_paypal_email'					=> 'PayPal Account Email',
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
    'merchant_card_type'					=> 'Tipo de Tarjeta',
    'merchant_card_no'						=> 'Numero de Tarjeta',
    'merchant_name'							=> 'Nombre',
    'merchant_first_name'					=> 'Apellido Paterno',
    'merchant_last_name'					=> 'Apellido Materno',
    'merchant_card_issue'					=> 'Card Issue Number',
    'merchant_exp_month'					=> 'Mes de Expiración',
    'merchant_exp_year'						=> 'Año de Expiración',
    'merchant_start_month'					=> 'Mes de Incio',
    'merchant_start_year'					=> 'Año de Inicio',
    'merchant_csc'							=> 'CSC',
    'merchant_issuer'						=> 'Emisor',

    // status/error messages
    'merchant_insecure_connection'			=> 'Card details must be submitted over a secure connection.',
    'merchant_required'						=> 'El %s campo es requerido.',
    'merchant_invalid_card_no'				=> 'El numero de tarjeta es invalido.',
    'merchant_card_expired'					=> 'La tarjeta ha espirado.',
    'merchant_invalid_status'				=> 'Estado de pago válido',
    'merchant_invalid_method'				=> 'Método no soportado.',
    'merchant_invalid_response'				=> 'Respuesta no válida por el proveedor de pago.',
    'merchant_payment_failed'				=> 'Fallo el pago. Por favor, inténtalo de nuevo.',
    'merchant_payment_redirect'				=> 'Por favor, espere mientras se redirige a la página de pago...',
    'merchant_3dauth_redirect'				=> 'Por favor, espere mientras se redirige al emisor de su tarjeta para la autenticación...'
);

/* End of file ./language/english/merchant_lang.php */
