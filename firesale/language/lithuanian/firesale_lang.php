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

    // General Titles
    $lang['firesale:title']         = 'FireSale';
    $lang['firesale:store']         = 'Store'; # Translate
    $lang['firesale:title:general'] = 'Bendrai';
    $lang['firesale:title:details'] = 'Jūsų duomenys';
    $lang['firesale:title:address'] = 'Jūsų adresas';
    $lang['firesale:title:bill']    = 'Sąskaitos duomenys';
    $lang['firesale:title:ship']    = 'Pristatymo duomenys';

    // Sections
    $lang['firesale:sections:dashboard']    = 'Įrankių skydas';
    $lang['firesale:sections:categories']   = 'Kategorijos';
    $lang['firesale:sections:products']     = 'Prekės';
    $lang['firesale:sections:orders']       = 'Užsakymai';
    $lang['firesale:sections:addresses']    = 'Adresai';
    $lang['firesale:sections:orders_items'] = 'Užsakytos prekės';
    $lang['firesale:sections:gateways']     = 'Mokėjimo būdai';
    $lang['firesale:sections:settings']     = 'Nustatymai';
    $lang['firesale:sections:routes']       = 'Maršrutai';
    $lang['firesale:sections:currency']     = 'Valiuta';
    $lang['firesale:sections:taxes']        = 'Mokesčiai';

    // Global Search
    $lang['firesale:product']    = 'Product'; # Translate
    $lang['firesale:products']   = 'Products'; # Translate
    $lang['firesale:category']   = 'Category'; # Translate
    $lang['firesale:categories'] = 'Categories'; # Translate

    // Tabs
    $lang['firesale:tabs:general']     = 'Bendri nustatymai';
    $lang['firesale:tabs:description'] = 'Aprašymas';
    $lang['firesale:tabs:formatting']  = 'Formatting'; # Translate
    $lang['firesale:tabs:shipping']    = 'Pristatymas';
    $lang['firesale:tabs:metadata']    = 'Metadata';
    $lang['firesale:tabs:attributes']  = 'Atributai';
    $lang['firesale:tabs:modifiers']   = 'Modifiers'; # translate
    $lang['firesale:tabs:images']      = 'Nuotraukos';
    $lang['firesale:tabs:assignments'] = 'Assignments'; #Translate

    // Shortcuts
    $lang['firesale:shortcuts:prod_create']     = 'Sukurti prekę';
    $lang['firesale:shortcuts:cat_create']      = 'Sukurti kategoriją';
    $lang['firesale:shortcuts:install_gateway'] = 'Įdiengti mokėjimo būdą';
    $lang['firesale:shortcuts:create_order']    = 'Sukurti užsakymą';
    $lang['firesale:shortcuts:create_routes']   = 'Pridėti naują maršrutą';
    $lang['firesale:shortcuts:build_routes']    = 'Perkurti maršrutus';
    $lang['firesale:shortcuts:add_tax_band']    = 'Add Tax Band'; #Translate
    $lang['firesale:shortcuts:assign_taxes']    = 'Assign Taxes'; #Translate

    // Dashboard
    $lang['firesale:dash_overview']          = 'Bendras vaizdas';
    $lang['firesale:dash_categorytrack']     = 'Kategorijų stebėjimas';
    $lang['firesale:elements:product_sales'] = 'Prekių pardavimai';
    $lang['firesale:elements:low_stock']     = 'Atsargų įspėjimai';
    $lang['firesale:dashboard:no_sales']     = 'Nerasta pardavimų per praėjusius 12 mėn.';
    $lang['firesale:dashboard:stock_low']    = '%s Prekė(-ės) su minimaliomis atsargomis';
    $lang['firesale:dashboard:stock_out']    = '%s Prekė(-ės) be atsargų';
    $lang['firesale:dashboard:no_stock_low'] = 'Nėra prekių be minimalių atsargų';
    $lang['firesale:dashboard:no_stock_out'] = 'Nėra prekių be atsargų';
    $lang['firesale:dashboard:view_more']    = 'Peržiūrėti daugiau...';
    $lang['firesale:dashbord:low_stock']     = 'Sandėlyje mažas kiekis';
    $lang['firesale:dashbord:out_of_stock']  = 'Išparduota';
    $lang['firesale:dashboard:year']         = 'Year'; # Translate
    $lang['firesale:dashboard:month']        = 'Month'; # Translate
    $lang['firesale:dashboard:week']         = 'Week'; # Translate
    $lang['firesale:dashboard:today']        = 'Today'; # Translate
    $lang['firesale:dashboard:sales_in']     = 'in %s sales'; # Translate

    // Categories
    $lang['firesale:cats_title']                         = 'Tvarkyti kategorijas';
    $lang['firesale:cats_none']                          = 'Kategorijų nerasta';
    $lang['firesale:cats_new']                           = 'Pridėti naują kategoriją';
    $lang['firesale:cats_order']                         = 'Rūšiuoti kategorijas';
    $lang['firesale:cats_draft_label']                   = 'Projektas';
    $lang['firesale:cats_live_label']                    = 'Gyvai';
    $lang['firesale:cats_edit']                          = 'Redaguoti kategoriją';
    $lang['firesale:cats_edit_title']                    = 'Redaguoti "%s"';
    $lang['firesale:cats_delete']                        = 'Ištrinti';
    $lang['firesale:cats_add_success']                   = 'Nauja kategorija sukurta sėkmingai';
    $lang['firesale:cats_add_error']                     = 'Įvyko klaida kuriant kategoriją';
    $lang['firesale:cats_edit_success']                  = 'Kategorija sėkmingai redaguota';
    $lang['firesale:cats_edit_error']                    = 'Įvyko klaida redaguojant kategoriją';
    $lang['firesale:cats_delete_success']                = 'Kategorija sėkmingai ištrinta';
    $lang['firesale:cats_delete_error']                  = 'Įvyko klaida trinant kategoriją';
    $lang['firesale:cats_all_products']                  = 'Visos prekės';
    $lang['firesale:category:uncategorised']             = 'Uncategorised'; #Translate
    $lang['firesale:category:uncategorised_slug']        = 'uncategorised'; #Translate
    $lang['firesale:category:uncategorised_description'] = 'This is your initial product category, which can\'t be deleted; however you can rename it if you wish.';# Translate

    // Products
    $lang['firesale:prod_none']              = 'Prekių nerasta';
    $lang['firesale:prod_create']            = 'Sukurti prekę';
    $lang['firesale:prod_header']            = 'Redaguoti %t';
    $lang['firesale:prod_title']             = 'Tvarkyti prekes';
    $lang['firesale:prod_title_create']      = 'Sukurti naują prekę';
    $lang['firesale:prod_title_edit']        = 'Redaguoti prekę';
    $lang['firesale:prod_edit_success']      = 'Prekė sėkmingai redaguota';
    $lang['firesale:prod_edit_error']        = 'Prekės nepavyko redaguoti';
    $lang['firesale:prod_add_success']       = 'Nauja prekė sėkmingai sukurta';
    $lang['firesale:prod_add_error']         = 'Įvyko klaida kuriant prekę';
    $lang['firesale:prod_delete_error']      = 'Įvyko klaida trinant prekę';
    $lang['firesale:prod_delete_success']    = 'Prekė sėkmingai ištrinta';
    $lang['firesale:prod_duplicate_error']   = 'Įvyko klaida kopijuojant prekę';
    $lang['firesale:prod_duplicate_success'] = 'Prekė sėkminkai nukopijuota';
    $lang['firesale:prod_not_found']         = 'Prekė nerasta';
    $lang['firesale:prod_delimg_success']    = 'Paveikslėlis pašalintas sėkmingai';
    $lang['firesale:prod_delimg_error']      = 'Įvyko klaida šalinant paveiksliuką';
    $lang['firesale:prod_button_quick_edit'] = 'Greitas redagavimas';

    // Product Modifiers & Variations
    $lang['firesale:mods:title']          = 'Modifiers'; # translate
    $lang['firesale:mods:create_success'] = 'New modifier created successfully'; # translate
    $lang['firesale:mods:edit_success']   = 'Modifier edited successfully'; # translate
    $lang['firesale:mods:delete_success'] = 'Modifier deleted successfully'; # translate
    $lang['firesale:mods:create_error']   = 'Error creating new modifier'; # translate
    $lang['firesale:mods:edit_error']     = 'Error editing the modifier'; # translate
    $lang['firesale:mods:delete_error']   = 'Error deleting the modifier'; # translate
    $lang['firesale:mods:create']         = 'Add a Modifier'; # translate
    $lang['firesale:mods:edit']           = 'Edit Modifier'; # translate
    $lang['firesale:mods:none']           = 'No Modifiers Found'; # translate
    $lang['firesale:mods:nothere']        = 'You can\'t add modifiers to a variant'; # translate
    $lang['firesale:vars:title']          = 'Variations'; # translate
    $lang['firesale:vars:show_set']       = 'Show Variations'; # translate
    $lang['firesale:vars:show_inst']      = 'Do you want to show variations on listings and search results?'; # translate
    $lang['firesale:vars:create_success'] = 'New variation created successfully'; # translate
    $lang['firesale:vars:edit_success']   = 'Variation edited successfully'; # translate
    $lang['firesale:vars:delete_success'] = 'Variation deleted successfully'; # translate
    $lang['firesale:vars:create_error']   = 'Error creating new variation'; # translate
    $lang['firesale:vars:edit_error']     = 'Error editing the variation'; # translate
    $lang['firesale:vars:delete_error']   = 'Error deleting the variation'; # translate
    $lang['firesale:vars:none']           = 'No Variations Found'; # translate
    $lang['firesale:vars:create']         = 'Add a Variation'; # translate
    $lang['firesale:vars:stock_low']      = 'Not enough stock of %s to buy this item'; # translate
    $lang['firesale:vars:category']       = 'Build from Category'; # translate

    // New Products
    $lang['firesale:new:title']    = 'New Products'; # translate
    $lang['firesale:new:in:title'] = 'New Products in %s'; # translate

    // Instructions
    $lang['firesale:inst_rrp']	 = 'Mažmeninė kaina prieš ir po PVM';
    $lang['firesale:inst_price'] = 'Dabartinė pardavimo kaina prieš ir po PVM (jei mažesnė nei RMK, matoma kaip pardavimo kaina)';

    // Labels
    $lang['firesale:label_draft']          = 'Projektas';
    $lang['firesale:label_live']           = 'Gyvai';
    $lang['firesale:label_id']             = 'Prekės kodas';
    $lang['firesale:label_title']          = 'Pavadinimas';
    $lang['firesale:label_slug']           = 'URL';
    $lang['firesale:label_status']         = 'Būsena';
    $lang['firesale:label_type']           = 'Type'; # translate
    $lang['firesale:label_description']    = 'Aprašymas';
    $lang['firesale:label_inst']           = 'Instructions'; # translate
    $lang['firesale:label_category']       = 'Kategorija';
    $lang['firesale:label_parent']         = 'Tėvinė kategorija';
    $lang['firesale:label_options']        = 'Options'; # translate
    $lang['firesale:label_filtercat']      = 'Filtruoti pagal kategoriją';
    $lang['firesale:label_filtersel']      = 'Pasirinkti kategoriją';
    $lang['firesale:label_filterprod']     = 'Pasirinkti prekę';
    $lang['firesale:label_filterstatus']   = 'Pasirinkti prekės būseną';
    $lang['firesale:label_filtersstatus']  = 'Pasirinkti prekės būseną sandėlyje';
    $lang['firesale:label_order_status']   = 'Select an Order Status'; # translate
    $lang['firesale:label_rrp']            = 'Rekomenduojama mažmeninė kaina';
    $lang['firesale:label_rrp_tax']        = 'Rekomenduojama mažmeninė kaina (prieš mokesčius)';
    $lang['firesale:label_rrp_short']      = 'RMK';
    $lang['firesale:label_price']          = 'Dabartinė kaina';
    $lang['firesale:label_price_tax']      = 'Dabartinė kaina (prieš mokesčius)';
    $lang['firesale:label_stock']          = 'Dabartinė atsargų būsena';
    $lang['firesale:label_drop_images']    = 'Užtempkite nuotraukas įkėlimui';
    $lang['firesale:label_duplicate']      = 'Kopijuoti';
    $lang['firesale:label_showfilter']     = 'Rodyti filtrus';
    $lang['firesale:label_mod_variant']    = 'Variant'; # translate
    $lang['firesale:label_mod_input']      = 'Input'; # translate
    $lang['firesale:label_mod_single']     = 'Single Product'; # translate
    $lang['firesale:label_mod_price']      = 'Price Modifier'; # translate
    $lang['firesale:label_mod_price_inst'] = 'Some instructions'; # translate

    $lang['firesale:label_stock_short']     = 'Atsargų kiekis';
    $lang['firesale:label_stock_status']    = 'Atsagų kiekis';
    $lang['firesale:label_stock_in']        = 'Yra';
    $lang['firesale:label_stock_low']       = 'Mažas kiekis';
    $lang['firesale:label_stock_out']       = 'Nėra';
    $lang['firesale:label_stock_order']     = 'Užsakytas papildymas';
    $lang['firesale:label_stock_ended']     = 'Neparduodama';
    $lang['firesale:label_stock_unlimited'] = 'Neribota';

    $lang['firesale:label_remove']        = 'Pašalinti';
    $lang['firesale:label_image']         = 'Paveiksliukas';
    $lang['firesale:label_images']        = 'Paveiksliukai';
    $lang['firesale:label_order']         = 'Užsakyta';
    $lang['firesale:label_gateway']       = 'Mokėjimo būdas';
    $lang['firesale:label_shipping']      = 'Pristatymo būdas';
    $lang['firesale:label_quantity']      = 'Kiekis';
    $lang['firesale:label_price_total']   = 'Galutinė kaina';
    $lang['firesale:label_price_ship']    = 'Pristatymo kaina';
    $lang['firesale:label_price_sub']     = 'Pradinė kaina';
    $lang['firesale:label_ship_to']       = 'Pristatytį adresu';
    $lang['firesale:label_bill_to']       = 'Užsakymo adresas';
    $lang['firesale:label_date']          = 'Data';
    $lang['firesale:label_product']       = 'Prekė';
    $lang['firesale:label_products']      = 'Prekės';
    $lang['firesale:label_company']       = 'Įmonės pavadinimas';
    $lang['firesale:label_firstname']     = 'Vardas';
    $lang['firesale:label_lastname']      = 'Pavardė';
    $lang['firesale:label_phone']         = 'Telefonas';
    $lang['firesale:label_email']         = 'Elektroninis paštas';
    $lang['firesale:label_address1']      = 'Adresas eilutė 1';
    $lang['firesale:label_address2']      = 'Adresas eilutė 2';
    $lang['firesale:label_city']          = 'Miestas';
    $lang['firesale:label_postcode']      = 'Pašto kodas';
    $lang['firesale:label_county']        = 'Rajonas';
    $lang['firesale:label_country']       = 'Miestas';
    $lang['firesale:label_details']       = 'Mano užsakymo ir pristatymo adresai vienodi';
    $lang['firesale:label_user_order']    = 'Vartotojas';
    $lang['firesale:label_ip']            = 'IP adresas';
    $lang['firesale:label_ship_req']      = 'Siuntimas privalomas';
    $lang['firesale:label_address_title'] = 'Save Address as'; # Translate

    $lang['firesale:label_nameaz']     = 'Vardas A - Z';
    $lang['firesale:label_nameza']     = 'Vardas Z - A';
    $lang['firesale:label_pricelow']   = 'Kaina mažesnė &gt; didesnė';
    $lang['firesale:label_pricehigh']  = 'kaina didesnė &gt; mažesnė';
    $lang['firesale:label_modelaz']    = 'Modelis A - Z';
    $lang['firesale:label_modelza']    = 'Modelis Z - A';
    $lang['firesale:label_creatednew'] = 'Newest - Oldest'; # translate
    $lang['firesale:label_createdold'] = 'Oldest - Newest'; # translate

    $lang['firesale:label_time_now']   = 'mažiau nei prieš minutę.';
    $lang['firesale:label_time_min']   = 'prieš minutę.';
    $lang['firesale:label_time_mins']  = 'prieš beveik %s minutes.';
    $lang['firesale:label_time_hour']  = 'prieš beveik valandą.';
    $lang['firesale:label_time_hours'] = 'prieš beveik %s valandas.';
    $lang['firesale:label_time_day']   = 'prieš 1 dieną.';
    $lang['firesale:label_time_days']  = 'prieš %s dienas.';

    $lang['firesale:label_map']         = 'Žemėlapis';
    $lang['firesale:label_route']       = 'Maršrutas';
    $lang['firesale:label_translation'] = 'Vertimas';
    $lang['firesale:label_table']       = 'Lentelė';
    $lang['firesale:label_https']       = 'HTTPS'; # translate
    $lang['firesale:label_use_https']   = 'Enable HTTPS'; # translate

    $lang['firesale:label_cur_code']        = 'Valiutos kodas';
    $lang['firesale:label_cur_code_inst']   = 'ISO-4217 Formatas';
    $lang['firesale:label_cur_tax']         = 'Tax Rate'; # translate
    $lang['firesale:label_cur_mod']         = 'Currency Modifier'; # translate
    $lang['firesale:label_cur_mod_inst']    = 'You may wish to modify the exchange rate slightly to cover additional costs associated with this region'; # translate
    $lang['firesale:label_exch_rate']       = 'Exchange Rate'; # translate
    $lang['firesale:label_exch_rate_inst']  = 'This will be automatically updated every hour and can be left blank as it will be updated on save'; # translate
    $lang['firesale:label_cur_flag']        = 'Related Image'; # translate
    $lang['firesale:label_enabled']         = 'Enabled'; # translate
    $lang['firesale:label_disabled']        = 'Disabled'; # translate
    $lang['firesale:label_cur_format']      = 'Currency Format'; # translate
    $lang['firesale:label_cur_format_inst'] = 'Formatting including currency symbol, with "{{ price }}" where the value is shown, eg: £{{ price }}'; # translate
    $lang['firesale:label_cur_format_dec']  = 'Decimal Place Symbol'; # translate
    $lang['firesale:label_cur_format_sep']  = 'Thousand Seperator Symbol'; # translate
    $lang['firesale:label_cur_format_num']  = 'Number Formatting'; # translate

    $lang['firesale:label_tax_band'] = 'Tax Band'; #Translate

    // Orders
    $lang['firesale:orders:title']                 = 'Užsakymai';
    $lang['firesale:orders:no_orders']             = 'Nėra užsakymų';
    $lang['firesale:orders:my_orders']             = 'Mano užsakymai';
    $lang['firesale:orders:view_order']            = 'Peržiūrėti užsakymą #%s';
    $lang['firesale:orders:title_create']          = 'Sukurti užsakymą';
    $lang['firesale:orders:title_edit']            = 'Redaguoti užsakymą #%s';
    $lang['firesale:orders:delete_success']        = 'Užsakymas ištrintas sėkmingai';
    $lang['firesale:orders:delete_error']          = 'Užsakymas neištrintas';
    $lang['firesale:orders:save_first']            = 'Išsaugokite užsakymą prieš pridedant prekes';
    $lang['firesale:orders:delete']                = 'Ištrinti užsakymus';
    $lang['firesale:orders:mark_as']               = 'Pažymėti ';
    $lang['firesale:orders:status_unpaid']         = 'Neapmokėtas';
    $lang['firesale:orders:status_paid']           = 'Apmokėtas';
    $lang['firesale:orders:status_dispatched']     = 'Išsiųstas';
    $lang['firesale:orders:status_processing']     = 'Vykdomas';
    $lang['firesale:orders:status_refunded']       = 'Grąžintas';
    $lang['firesale:orders:status_cancelled']      = 'Nutrauktas';
    $lang['firesale:orders:status_failed']         = 'Nepavykės';
    $lang['firesale:orders:status_declined']       = 'Atmestas';
    $lang['firesale:orders:status_mismatch']       = 'Nesutampantis';
    $lang['firesale:orders:status_prefunded']      = 'Partially Refunded'; # Translate
    $lang['firesale:orders:failed_message']        = 'Įvyko klaida vykdant jūsų apmokėjimą';
    $lang['firesale:orders:declined_message']      = 'Jūsų apmokėjimas atmestas, pamėginkite dar kartą.';
    $lang['firesale:orders:mismatch_message']      = 'Jūsų apmokįjimas nesutampa su užsakymu.';
    $lang['firesale:orders:logged_in']             = 'Prisijunkite, kad matytumėte užsakymų istoriją.';
    $lang['firesale:orders:label_view_order']      = 'Peržiūrėti užsakymą';
    $lang['firesale:orders:label_products']        = 'Prekės';
    $lang['firesale:orders:label_view_order']      = 'Peržiūrėti užsakymą';
    $lang['firesale:orders:label_customer']        = 'Pirkėjas';
    $lang['firesale:orders:label_date_placed']     = 'Pirkimo data';
    $lang['firesale:orders:label_order_id']        = "Užsakymo Nr";
    $lang['firesale:orders:labe_shipping_address'] = 'Pristatymo adresas';
    $lang['firesale:orders:labe_payment_address']  = 'Sąskaitos adresas';
    $lang['firesale:orders:label_order_status']    = 'Užsakymo adresas';
    $lang['firesale:orders:label_message']         = 'Žinutė';

    // Gateways
    $lang['firesale:gateways:admin_title']             = 'Mokėjimo būdai';
    $lang['firesale:gateways:install_title']           = 'Įdiegti mokėjimo būdą';
    $lang['firesale:gateways:edit_title']              = 'Readaguoti mokėjimo būdą';
    $lang['firesale:gateways:installed_title']         = 'Įdiegti mokėjimo būdai';
    $lang['firesale:gateways:no_gateways']             = 'Nėra įdiegtų mokėjimo būdų.';
    $lang['firesale:gateways:no_uninstalled_gateways'] = 'Visi galimi apmokėjimo būdai įdiengti.';
    $lang['firesale:gateways:errors:invalid_bool']     = 'Laukas %s turi būti taip/ne tipo.';
    $lang['firesale:gateways:warning']                 = 'Visi mokėjimo būdo nustatymai bus prarasti! Parduotuvė negalės priimti mokėjimų! Ar tikrai norite išdiegti šį mokėjimo būdą?';
    $lang['firesale:gateways:multiple_warning']        = 'All gateway settings will be lost and your store may be unable to take payments! Are you sure you want to uninstall the selected gateways?'; # Translate

    $lang['firesale:gateways:installed_success'] = 'Mokėjimo būdas sėkmingai įdiegtas';
    $lang['firesale:gateways:installed_fail']    = 'Mokėjimo būdas nebuvo įdiegtas';

    $lang['firesale:gateways:uninstalled_success']          = 'Mokėjimo būdas sėkmingai išdiegtas';
    $lang['firesale:gateways:uninstalled_fail']             = 'Mokėjimo būdas nebuvo išdiegtas';
    $lang['firesale:gateways:multiple_uninstalled_success'] = 'Pasirinkti mokėjimo būdai sėkmingai išdiegti';
    $lang['firesale:gateways:multiple_uninstalled_fail']    = 'Pasirinkti mokėjimo būdai nebuvo išdiegti';

    $lang['firesale:gateways:multiple_enabled_success'] = 'Pasirinkti mokėjimo būdai sėkmingai įjungti';
    $lang['firesale:gateways:multiple_enabled_fail']    = 'Pasirinktų mokėjimo būdų nepavyko įjungti';
    $lang['firesale:gateways:enabled_success']          = 'Mokejimo būdas sėkmingai įjungtas';
    $lang['firesale:gateways:enabled_fail']             = 'Mokejimo būdo nepavyko įjungti';

    $lang['firesale:gateways:disabled_success']          = 'Mokejimo būdas sėkmingai išjungtas';
    $lang['firesale:gateways:disabled_fail']             = 'Mokejimo būdo nepavyko išjungti';
    $lang['firesale:gateways:multiple_disabled_success'] = 'Pasirinkti mokėjimo būdai sėkmingai išjungti';
    $lang['firesale:gateways:multiple_disabled_fail']    = 'Pasirinktų mokėjimo būdų nepavyko išjungti';

    $lang['firesale:gateways:updated_success'] = 'Mokėjimo būdai sėkmingai atnaujinti';
    $lang['firesale:gateways:updated_fail']    = 'Mokėjimo būdų nepavyko atnaujinti';

    // Checkout
    $lang['firesale:gateways:labels:name']            = 'Pavadinimas';
    $lang['firesale:gateways:labels:desc']            = 'Aprašymas';
    $lang['firesale:cart:title']                      = 'Krepšelis';
    $lang['firesale:cart:empty']                      = 'Nėra krepšelyje prekių';
    $lang['firesale:cart:login_required']             = 'Turite būti prisijungęs, jei norite atlikti šį veiksmą';
    $lang['firesale:cart:qty_too_low']                = 'Neužtenka prekių sandėlyje, kad įtrauktumėte į krepšelį tokį kiekį';
    $lang['firesale:cart:price_changed']              = 'The price of some items in your cart has changed, please check them before continuing'; # Translate
    $lang['firesale:checkout:title']                  = 'Apmokėti';
    $lang['firesale:checkout:error_callback']         = 'Įvyko užsakymo klaida. Pamėginkite dar kartą, naudodami kitą mokėjimo būdą.';
    $lang['firesale:payment:title']                   = 'Patvirtinti duomenis';
    $lang['firesale:payment:title_success']           = 'Mokėjimas baigtas';
    $lang['firesale:checkout:title:ship_method']      = 'Pristatymo būdas';
    $lang['firesale:checkout:title:payment_method']   = 'Mokėjimo būdas';
    $lang['firesale:checkout:next']                   = 'Next'; #Translate
    $lang['firesale:checkout:previous']               = 'Previous';#Translate
    $lang['firesale:checkout:select_shipping_method'] = 'Please select your preferred shipping method below before continuing';#Translate
    $lang['firesale:checkout:select_payment_method']  = 'Please select your preferred payment method below before continuing';#Translate
    $lang['firesale:checkout:submit_and_pay']         = 'Submit &amp; Pay';#Translate
    $lang['firesale:checkout:shipping_min_price']     = 'The total value of your cart items does not meet the minimum for the selected shipping method';#Translate
    $lang['firesale:checkout:shipping_max_price']     = 'The total value of your cart items exceeds the maximum for the selected shipping method';#Translate
    $lang['firesale:checkout:shipping_min_weight']    = 'The total weight of your cart items does not meet the minimum for the selected shipping method';#Translate
    $lang['firesale:checkout:shipping_max_weight']    = 'The total weight of your cart items exceeds the maximum for the selected shipping method';#Translate
    $lang['firesale:checkout:shipping_invalid']       = 'The shipping method you selected is not valid';#Translate
    $lang['firesale:checkout:gateway_invalid']        = 'The payment gateway you selected is not valid';#Translate

    // Routes
    $lang['firesale:routes:title']          = 'Maršrutai';
    $lang['firesale:routes:new']            = 'Pridėti naują maršrutą';
    $lang['firesale:routes:add_success']    = 'Naujas maršrutas pridėtas sėkmingai';
    $lang['firesale:routes:add_error']      = 'Klaida, pridedant maršrutą';
    $lang['firesale:routes:edit']           = 'Redaguoti %s maršrutą';
    $lang['firesale:routes:edit_success']   = 'Maršrutas pridėtas sėkmingai';
    $lang['firesale:routes:edit_error']     = 'Klaida, redaguojant maršrutą';
    $lang['firesale:routes:not_found']      = 'Pasirinktas maršrutas nerastas';
    $lang['firesale:routes:none']           = 'Maršrutų nerasta';
    $lang['firesale:routes:delete_success'] = 'Maršrutas pašalintas sėkmingai';
    $lang['firesale:routes:delete_error']   = 'Klaida, perkeliant maršrutą';
    $lang['firesale:routes:build_success']  = 'Sėkmingai perkurtas maršrutų failas';
    $lang['firesale:routes:build_error']    = 'Klaida, perkuriant maršrutų failą';
    $lang['firesale:routes:write_error']    = 'Access Denied: Please ensure config/routes.php is writable and try again'; # Translate

    // Route Labels
    $lang['firesale:routes:category_custom'] = 'Category Customisation'; # translate
    $lang['firesale:routes:category']        = 'Category'; # translate
    $lang['firesale:routes:product']         = 'Product'; # translate
    $lang['firesale:routes:cart']            = 'Cart'; # translate
    $lang['firesale:routes:order_single']    = 'Single Order'; # translate
    $lang['firesale:routes:orders']          = 'User Orders'; # translate
    $lang['firesale:routes:addresses']       = 'User Addresses'; # translate
    $lang['firesale:routes:currency']        = 'Currency Switcher'; # translate
    $lang['firesale:routes:new_products']    = 'New Products'; # translate

    // Currency
    $lang['firesale:shortcuts:install_currency'] = 'Install new Currency'; # translate
    $lang['firesale:currency:enable']            = 'Enable'; # translate
    $lang['firesale:currency:disable']           = 'Disable'; # translate
    $lang['firesale:currency:disable_warn']      = 'Disabling this may cause issues for customers and previous orders'; # translate
    $lang['firesale:currency:delete']            = 'Delete'; # translate
    $lang['firesale:currency:delete_warn']       = 'Deleting this may cause issues for customers and previous orders'; # translate
    $lang['firesale:currency:create']            = 'Create New Currency'; # translate
    $lang['firesale:currency:edit']              = 'Edit Currency'; # translate
    $lang['firesale:currency:not_found']         = 'Selected currency not found'; # translate
    $lang['firesale:currency:add_success']       = 'New currency added successfully'; # translate
    $lang['firesale:currency:add_error']         = 'There was an error adding the new currency'; # translate
    $lang['firesale:currency:edit_success']      = 'Currency updated successfully'; # translate
    $lang['firesale:currency:edit_error']        = 'There was an error updating that currency'; # translate
    $lang['firesale:currency:delete_success']    = 'Currency was deleted successfully'; # translate
    $lang['firesale:currency:delete_error']      = 'There was an error deleting the currency'; # translate
    $lang['firesale:label_cur_format_num']       = 'Number Formatting'; # translate
    $lang['firesale:currency:format_none']       = 'None'; # translate
    $lang['firesale:currency:format_00']         = 'Round up to next full number'; # translate
    $lang['firesale:currency:format_50']         = 'Round to closest .50'; # translate
    $lang['firesale:currency:format_99']         = 'Round up to closest .99'; # translate

    // Taxes
    $lang['firesale:taxes:none']                = 'There are currently no tax bands setup'; # Translate
    $lang['firesale:taxes:new']                 = 'Add tax band'; # Translate
    $lang['firesale:taxes:edit']                = 'Edit tax band'; # Translate
    $lang['firesale:taxes:add_success']         = 'Tax band created successfully'; # Translate
    $lang['firesale:taxes:add_error']           = 'There was an error whilst creating the tax band'; # Translate
    $lang['firesale:taxes:edit_success']        = 'Tax band edited successfully'; # Translate
    $lang['firesale:taxes:edit_error']          = 'There was an error whilst editing the tax band'; # Translate
    $lang['firesale:taxes:assignments_updated'] = 'Tax band assignments were updated successfully'; # Translate
    $lang['firesale:taxes:add_tax_band']        = 'Create Tax Band'; # Translate

    // Addresses
    $lang['firesale:addresses:title']        = 'Mano adresai';
    $lang['firesale:addresses:edit_address'] = 'Redaguoti adresą';
    $lang['firesale:addresses:new_address']  = 'Sukurti naują adresą';
    $lang['firesale:addresses:save']         = 'Išsaugoti';
    $lang['firesale:addresses:cancel']       = 'Nutraukti';
    $lang['firesale:addresses:no_user']      = 'Prisijunkite, norėdami redaguoti savo adresus';
    $lang['firesale:addresses:add_success']  = 'Adresas sukurtas sėkmingai';
    $lang['firesale:addresses:add_error']    = 'Klaida, sukuriant adresą';
    $lang['firesale:addresses:edit_success'] = 'Adresas redaguotas sėkmingai';
    $lang['firesale:addresses:edit_error']   = 'Klaida, redaguojant adresą';

    // Products Frontend
    $lang['firesale:product:label_availability'] = "Kiekis";
    $lang['firesale:product:label_model']        = "Modelis";
    $lang['firesale:product:label_product_code'] = "Prekės kodas";
    $lang['firesale:product:label_qty']          = "Kiekis";
    $lang['firesale:product:label_add_to_cart']  = "Į krepšelį";

    // Cart Frontend
    $lang['firesale:cart:label_remove']           = "Pašalinti";
    $lang['firesale:cart:label_image']            = "Nuotrauka";
    $lang['firesale:cart:label_name']             = "Pavadinimas";
    $lang['firesale:cart:label_model']            = "Modelis";
    $lang['firesale:cart:label_quantity']         = "Kiekis";
    $lang['firesale:cart:label_unit_price']       = "Vieneto kaina";
    $lang['firesale:cart:label_total']            = "Viso";
    $lang['firesale:cart:label_no_items_in_cart'] = "Nėra prekių krepšelyje";
    $lang['firesale:cart:button_update']          = "Atnaujinti krepšelį";
    $lang['firesale:cart:button_goto_checkout']   = "Tęsti užsakymą";
    $lang['firesale:cart:label_sub_total']        = "Prekių kaina";
    $lang['firesale:cart:label_tax']              = "Mokesčiai";
    $lang['firesale:cart:label_total']            = "Kaina";

    //Categories Frontend
    $lang['firesale:categories:grid']          = 'Tinklelis';
    $lang['firesale:categories:list']          = 'Sąrašas';
    $lang['firesale:categories:add_to_basket'] = 'Į krepšelį';

    //Payment Frontend
    $lang['firesale:payment:cancelled']     = 'Užsakymas nutrauktas';
    $lang['firesale:payment:wait_redirect'] = 'Palaukite, kol nukreipsime į atsiskaitymo langą';
    $lang['firesale:payment:btn_continue']  = 'Tęsti';

    // Settings
    $lang['firesale:settings_tax']                   = 'Tax Percentage'; # translate
    $lang['firesale:settings_tax_inst']              = 'The percentage of tax to be applied to the products'; # translate
    $lang['firesale:settings_currency']              = 'Default Currency Code'; # translate
    $lang['firesale:settings_currency_inst']         = 'The currency you accept (ISO-4217 format)'; # translate
    $lang['firesale:settings_currency_key']          = 'Currency API Key'; # translate
    $lang['firesale:settings_currency_key_inst']     = 'API Key from <a target="_blank" href="https://openexchangerates.org/signup/free">Open Exchange Rates</a>'; # translate
    $lang['firesale:settings_current_currency']      = 'Current Currency'; # translate
    $lang['firesale:settings_current_currency_inst'] = 'The current currency in use, used to update existing values if default currency is changed'; # translate
    $lang['firesale:settings_currency_updated']      = 'Currency last update time'; # translate
    $lang['firesale:settings_currency_updated_inst'] = 'The last time the currency was updated, api is updated every hour and to keep to rate limits we only check after that'; # translate
    $lang['firesale:settings_perpage']               = 'Products per Page'; # translate
    $lang['firesale:settings_perpage_inst']          = 'The number of products to be displayed on category and search result pages'; # translate
    $lang['firesale:settings_image_square']          = 'Make Images Square'; # translate
    $lang['firesale:settings_image_square_inst']     = 'Some themes may require square images to keep layouts consistent'; # translate
    $lang['firesale:settings_image_background']      = 'Image Background Colour'; # translate
    $lang['firesale:settings_image_background_inst'] = 'Hexcode (without #) colour you wish resized image backgrounds to be'; # translate
    $lang['firesale:settings_login']                 = 'Require login to purchase'; # translate
    $lang['firesale:settings_login_inst']            = 'Ensure a user is logged in before allowing them to buy products'; # translate
    $lang['firesale:settings_dashboard']             = 'Override Default Dashboard'; # translate
    $lang['firesale:settings_dashboard_inst']        = 'Show the FireSale dashboard instead of the default'; # translate
    $lang['firesale:settings_low']                   = 'Low Stock Level'; # translate
    $lang['firesale:settings_low_inst']              = 'The number of products remaining before stock is considered low'; # translate
    $lang['firesale:settings_new']                   = 'New Product Time'; # translate
    $lang['firesale:settings_new_inst']              = 'The time in seconds that a product is considered new'; # translate
    $lang['firesale:settings_basic']                 = 'Basic Checkout View'; # translate
    $lang['firesale:settings_basic_inst']            = 'Minimal checkout layout, requires a minimal.html layout in your theme'; # translate
    $lang['firesale:settings_disabled']              = 'Disable Product Sales'; # translate
    $lang['firesale:settings_disabled_inst']         = 'Everything looks normal but nothing can be added to cart or paid for'; # translate
    $lang['firesale:settings_disabled_msg']          = 'Disabled Message'; # translate
    $lang['firesale:settings_disabled_msg_inst']     = 'A flashdata error shown to users after they attempt to add an item to their cart'; # translate

    // Install errors
    $lang['firesale:install:wrong_version']    = 'Unable to install the FireSale module, FireSale requires PyroCMS v2.1.4 or above'; #Translate
    $lang['firesale:install:missing_multiple'] = 'FireSale requires the Multiple Relationships field type to operate. You can download this from <a target="_blank" href="https://github.com/adamfairholm/PyroStreams-Multiple-Relationships/zipball/2.0/develop">here</a>'; #Translate
    $lang['firesale:install:not_installed']    = 'Please install the FireSale module before installing additional FireSale addons'; #Translate
    $lang['firesale:install:no_route_access']  = 'FireSale requires access to the system/cms/config/routes.php file. Please set the appropriate permissions and try again'; # Translate
    $lang['firesale:install:old_multiple']     = 'Your currently installed version of the Multiple field type is out of date, please delete or upgrade it before attempting to use FireSale'; # Translate
