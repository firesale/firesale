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
$lang['firesale:gateways:2checkout:desc'] = '2Checkout.com è un servizio di pagamenti online che ti consente di accettare tutte le maggiori carte di credito, di debito, carte prepagate, PayPal e molto altro.';

// Authorize.Net SIM
$lang['firesale:gateways:authorize_net_sim:name'] = 'Authorize.Net SIM';
$lang['firesale:gateways:authorize_net_sim:desc'] = 'Server Integration Method (SIM) API uses a transaction payment fingerprint via a hosted payment form and 128-bit SSL encryption.';

// Authorize.Net
$lang['firesale:gateways:authorize_net:name'] = 'Authorize.Net';
$lang['firesale:gateways:authorize_net:desc'] = 'Permette ai venditori online di accettare pagamenti tramite carte di credito e e-check.';

// DPS (PX Pay)
$lang['firesale:gateways:dps_pxpay:name'] = 'DPS (PX Pay)';
$lang['firesale:gateways:dps_pxpay:desc'] = 'Integrazione DPS PX Pay Gateway per Australia e Nuova Zelanda.';

// DPS (PX Post)
$lang['firesale:gateways:dps_pxpost:name'] = 'DPS (PX Post)';
$lang['firesale:gateways:dps_pxpost:desc'] = 'PX POST è disegnato per gestire transazioni utilizzando HTTPS Post Request.';

// Dummy
$lang['firesale:gateways:dummy:name'] = 'FireSALE Dummy';
$lang['firesale:gateways:dummy:desc'] = 'Un semplice tipo di pagamento da utilizzarsi SOLO per i test, autorizza il pagamento verificando un numero di carta fittizio.';

// eWAY Shared
$lang['firesale:gateways:eway_shared:name'] = 'eWAY Shared Payments';
$lang['firesale:gateways:eway_shared:desc'] = 'Shared Payments permette ai tuoi clienti di pagare attraverso un sito sicuro mantenuto da eWay reindirizzando l\'utente attraverso una connessione HTTP FORM POST.';

// eWAY
$lang['firesale:gateways:eway:name'] = 'eWAY';
$lang['firesale:gateways:eway:desc'] = 'Accetta carte di credito sul tuo sito web con il principale gateway di pagamento in UK per collegare il sito web direttamente alla tua banca per elaborare le carte di credito dei clienti.';

// PayPal Express Checkout
$lang['firesale:gateways:paypal_express:name'] = 'PayPal Express Checkout';
$lang['firesale:gateways:paypal_express:desc'] = 'Veloce. I clienti non hanno bisogno di inserire le loro informazioni di pagamento quando fanno un acquisto. PayPal ha già tutte le informazioni che servono.';

// PayPal Pro
$lang['firesale:gateways:paypal_pro:name'] = 'PayPal Pagamenti Pro';
$lang['firesale:gateways:paypal_pro:desc'] = 'PayPal Pagamenti Pro è un affidabile servizio per negozi che hanno 100+ ordini/mese.';

// PayPal
$lang['firesale:gateways:paypal:name'] = 'PayPal Payments Standard';
$lang['firesale:gateways:paypal:desc'] = 'I pagamenti online sono semplici con PayPal Payments Standard.';

// Sage Pay Server
$lang['firesale:gateways:sagepay_server:name'] = 'Sage Pay Server'; 
$lang['firesale:gateways:sagepay_server:desc'] = 'Sage Pay Go con integrazione Server è una combinazione vincente di flessibilità e facilità di integrazione. Hai la sicurezza dei pagamenti esterni al sito con la possibilità di gestire le transazioni e i resoconti dal tuo server.';

// Sage Pay Direct
$lang['firesale:gateways:sagepay_direct:name'] = 'Sage Pay Direct';
$lang['firesale:gateways:sagepay_direct:desc'] = 'Sage Pay Go con integrazione diretta ti dà il completo controllo sul disign della pagina di pagamento e ti aiuta a gestire l\'intero processo di pagamento.';

// Stripe
$lang['firesale:gateways:stripe:name'] = 'Stripe';
$lang['firesale:gateways:stripe:desc'] = 'Stripe permette agli sviluppatori di accettare facilmente le carte di credito sul web.';

// WorldPay
$lang['firesale:gateways:worldpay:name'] = 'WorldPay';
$lang['firesale:gateways:worldpay:desc'] = 'Pagamento online, account venditore online e gestore di rischi dei prodotti per far crescere il tuo business online.';

// Netaxept
$lang['firesale:gateways:netaxept:name'] = 'Netaxept'; 
$lang['firesale:gateways:netaxept:desc'] = 'Metodo di pagamento Norvegese.';

// Gocardless
$lang['firesale:gateways:gocardless:name'] = 'GoCardless'; 
$lang['firesale:gateways:gocardless:desc'] = 'GoCardless rende facile ed economico accettare pagamenti online. Nessun account venditore. Nessun costo per carta di credito. Nessun problema.';

// Cardsave
$lang['firesale:gateways:netaxept:name'] = 'CardSave'; 
$lang['firesale:gateways:netaxept:desc'] = 'CardSave rende facile il processo delel carte di credito con una gamma di soluzioni convenienti.';

// Rabo OmniKassa
$lang['firesale:gateways:netaxept:name'] = 'Rabo OmniKassa';
$lang['firesale:gateways:netaxept:desc'] = 'Metodo di pagamento tedesco.';
