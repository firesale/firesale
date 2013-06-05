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
    $lang['firesale:title:general'] = 'Ogólne';
    $lang['firesale:title:details'] = 'Twoje informacje';
    $lang['firesale:title:address'] = 'Twój adres';
    $lang['firesale:title:bill']    = 'Płatność';
    $lang['firesale:title:ship']    = 'Wysyłka';

    // Sections
    $lang['firesale:sections:dashboard']    = 'Sklep start';
    $lang['firesale:sections:categories']   = 'Kategorie';
    $lang['firesale:sections:products']     = 'Produkty';
    $lang['firesale:sections:orders']       = 'Zamówienia';
    $lang['firesale:sections:addresses']    = 'Adresy';
    $lang['firesale:sections:orders_items'] = 'Order Items';
    $lang['firesale:sections:gateways']     = 'Bramki płatności';
    $lang['firesale:sections:settings']     = 'Ustawienia';
    $lang['firesale:sections:routes']       = 'Trasowania';
    $lang['firesale:sections:currency']     = 'Waluty';
    $lang['firesale:sections:taxes']        = 'Podatki';

    // Global Search
    $lang['firesale:product']    = 'Product'; # Translate
    $lang['firesale:products']   = 'Products'; # Translate
    $lang['firesale:category']   = 'Category'; # Translate
    $lang['firesale:categories'] = 'Categories'; # Translate

    // Tabs
    $lang['firesale:tabs:general']     = 'Opcje ogólne';
    $lang['firesale:tabs:description'] = 'Opis';
    $lang['firesale:tabs:formatting']  = 'Formatowanie';
    $lang['firesale:tabs:shipping']    = 'Wysyłka';
    $lang['firesale:tabs:metadata']    = 'Metadata';
    $lang['firesale:tabs:attributes']  = 'Atrybuty';
    $lang['firesale:tabs:modifiers']   = 'Modifiers'; # translate
    $lang['firesale:tabs:images']      = 'Zdjęcia';
    $lang['firesale:tabs:assignments'] = 'Przypisania';

    // Shortcuts
    $lang['firesale:shortcuts:prod_create']     = 'Dodaj produkt';
    $lang['firesale:shortcuts:cat_create']      = 'Dodaj kategorię';
    $lang['firesale:shortcuts:install_gateway'] = 'Instaluj bramkę płatności';
    $lang['firesale:shortcuts:create_order']    = 'Utwórz zamówienie';
    $lang['firesale:shortcuts:create_routes']   = 'Dodaj nowe trasowanie';
    $lang['firesale:shortcuts:build_routes']    = 'Przebuduj trasowania';
    $lang['firesale:shortcuts:add_tax_band']    = 'Dodaj nową stawkę podatkową';
    $lang['firesale:shortcuts:assign_taxes']    = 'Przypisz podatki';

    // Dashboard
    $lang['firesale:dash_overview']          = 'Szybki przegląd';
    $lang['firesale:dash_categorytrack']     = 'Śledzenie kategorii';
    $lang['firesale:elements:product_sales'] = 'Sprzedaż produktu';
    $lang['firesale:elements:low_stock']     = 'Alerty magazynu';
    $lang['firesale:dashboard:no_sales']     = 'Brak sprzedaży w ciągu ostatnich 12 miesięcy';
    $lang['firesale:dashboard:stock_low']    = '%s produktów z niskim stanem magazynowym';
    $lang['firesale:dashboard:stock_out']    = '%s produków z brakiem w magazynie';
    $lang['firesale:dashboard:no_stock_low'] = 'Brak produktów z niskim stanem magazynowym';
    $lang['firesale:dashboard:no_stock_out'] = 'Brak produktów z brakiem w magazynie';
    $lang['firesale:dashboard:view_more']    = 'Zobacz więcej...';
    $lang['firesale:dashbord:low_stock']     = 'Niski stan magazynowy';
    $lang['firesale:dashbord:out_of_stock']  = 'Niedostępny';
    $lang['firesale:dashboard:year']         = 'Year'; # Translate
    $lang['firesale:dashboard:month']        = 'Month'; # Translate
    $lang['firesale:dashboard:week']         = 'Week'; # Translate
    $lang['firesale:dashboard:today']        = 'Today'; # Translate
    $lang['firesale:dashboard:sales_in']     = 'in %s sales'; # Translate

    // Categories
    $lang['firesale:cats_title']                         = 'Zarządaj kategoriami';
    $lang['firesale:cats_none']                          = 'Nie znaleziono żadnych kategorii';
    $lang['firesale:cats_new']                           = 'Dodaj nową kategorię';
    $lang['firesale:cats_order']                         = 'Kategorie zamówień';
    $lang['firesale:cats_draft_label']                   = 'Robocze';
    $lang['firesale:cats_live_label']                    = 'Opublikowane';
    $lang['firesale:cats_edit']                          = 'Edytuj kategorię';
    $lang['firesale:cats_edit_title']                    = 'Edycja "%s"';
    $lang['firesale:cats_delete']                        = 'Usuń';
    $lang['firesale:cats_add_success']                   = 'Nowa kategoria dodana pomyślnie';
    $lang['firesale:cats_add_error']                     = 'Podczas dodawania kategorii wystąpił błąd';
    $lang['firesale:cats_edit_success']                  = 'Kategoria wyedytowana prawidłowo';
    $lang['firesale:cats_edit_error']                    = 'Podczas edycji kategorii wystąpił błąd';
    $lang['firesale:cats_delete_success']                = 'Kategoria usunięta prawidłowo';
    $lang['firesale:cats_delete_error']                  = 'Podczas usuwania kategorii wystąpił błąd';
    $lang['firesale:cats_all_products']                  = 'Wszystkie produkty';
    $lang['firesale:category:uncategorised']             = 'Uncategorised'; #Translate
    $lang['firesale:category:uncategorised_slug']        = 'uncategorised'; #Translate
    $lang['firesale:category:uncategorised_description'] = 'This is your initial product category, which can\'t be deleted; however you can rename it if you wish.';# Translate

    // Products
    $lang['firesale:prod_none']              = 'Nie znaleziono produktów';
    $lang['firesale:prod_create']            = 'Dodaj produkt';
    $lang['firesale:prod_header']            = 'Edycja %t';
    $lang['firesale:prod_title']             = 'Zarządzaj produktami';
    $lang['firesale:prod_title_create']      = 'Dodaj nowy produkt';
    $lang['firesale:prod_title_edit']        = 'Edytuj produkt';
    $lang['firesale:prod_edit_success']      = 'Edycja produktu zakończona pomyślnie';
    $lang['firesale:prod_edit_error']        = 'Edycja produktu nie udana';
    $lang['firesale:prod_add_success']       = 'Dodano pomyślnie nowy produkt';
    $lang['firesale:prod_add_error']         = 'Podczas dodawania produktów wystąpił błąd';
    $lang['firesale:prod_delete_error']      = 'Podczas usuwania produktu wystąpił błąd';
    $lang['firesale:prod_delete_success']    = 'Produkt usunięty prawidłowo';
    $lang['firesale:prod_duplicate_error']   = 'Błąd duplikowania produktu';
    $lang['firesale:prod_duplicate_success'] = 'Produkt zduplikowany prawidłowo';
    $lang['firesale:prod_not_found']         = 'Nie można znaleźć tego produktu';
    $lang['firesale:prod_delimg_success']    = 'Zdjęcie usunięte prawidłowo';
    $lang['firesale:prod_delimg_error']      = 'Błąd podczas usuwania wskazanego zdjęcia';
    $lang['firesale:prod_button_quick_edit'] = 'Szybka edycja';

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
    $lang['firesale:inst_rrp']   = 'Sugerowana cena detaliczna (Recommended Retail Price, RRP) przed i po podatku';
    $lang['firesale:inst_price'] = 'Aktualna cena sprzedaży przed i po podatku (jeśli mniejsze niż RRP, wtedy widoczne jako cena)';

    // Labels
    $lang['firesale:label_draft']          = 'Robocze';
    $lang['firesale:label_live']           = 'Opublikowane';
    $lang['firesale:label_id']             = 'Kod Produktu';
    $lang['firesale:label_title']          = 'Nazwa';
    $lang['firesale:label_slug']           = 'Slug';
    $lang['firesale:label_status']         = 'Status';
    $lang['firesale:label_type']           = 'Type'; # translate
    $lang['firesale:label_description']    = 'Opis';
    $lang['firesale:label_inst']           = 'Instructions'; # translate
    $lang['firesale:label_category']       = 'Kategoria';
    $lang['firesale:label_parent']         = 'Kategoria Wyższa';
    $lang['firesale:label_options']        = 'Options'; # translate
    $lang['firesale:label_filtercat']      = 'Filtrowanie wg kategorii';
    $lang['firesale:label_filtersel']      = 'Wybierz kategorię';
    $lang['firesale:label_filterprod']     = 'Wybierz produkt';
    $lang['firesale:label_filterstatus']   = 'Wybierz status produktu';
    $lang['firesale:label_filtersstatus']  = 'Wybierz status stanu magazynowego';
    $lang['firesale:label_order_status']   = 'Wybierz status zamówienia';
    $lang['firesale:label_rrp']            = 'Rekomendowana Cena Detaliczna (RRP)';
    $lang['firesale:label_rrp_tax']        = 'Rekomendowana Cena Detaliczna (przed podatkiem)';
    $lang['firesale:label_rrp_short']      = 'RRP';
    $lang['firesale:label_price']          = 'Aktualna cena';
    $lang['firesale:label_price_tax']      = 'Aktualna cena (przed podatkiem)';
    $lang['firesale:label_stock']          = 'Aktualny stan magazynowy';
    $lang['firesale:label_drop_images']    = 'Przeciagnij tu zdjęcia do uploadu';
    $lang['firesale:label_duplicate']      = 'Duplikuj';
    $lang['firesale:label_showfilter']     = 'Pokaż filtry';
    $lang['firesale:label_mod_variant']    = 'Variant'; # translate
    $lang['firesale:label_mod_input']      = 'Input'; # translate
    $lang['firesale:label_mod_single']     = 'Single Product'; # translate
    $lang['firesale:label_mod_price']      = 'Price Modifier'; # translate
    $lang['firesale:label_mod_price_inst'] = 'Some instructions'; # translate

    $lang['firesale:label_stock_short']     = 'Stan magazynowy';
    $lang['firesale:label_stock_status']    = 'Status stanu magazynowego';
    $lang['firesale:label_stock_in']        = 'Na stanie';
    $lang['firesale:label_stock_low']       = 'Niski stan magazynowy';
    $lang['firesale:label_stock_out']       = 'Brak na stanie magazynowym';
    $lang['firesale:label_stock_order']     = 'Zamówiona dostawa';
    $lang['firesale:label_stock_ended']     = 'Zaniechana dalsza sprzedaż';
    $lang['firesale:label_stock_unlimited'] = 'Nieograniczony';

    $lang['firesale:label_remove']        = 'Usuń';
    $lang['firesale:label_image']         = 'Zdjęcie';
    $lang['firesale:label_images']        = 'Zdjęcia';
    $lang['firesale:label_order']         = 'Zamówienie';
    $lang['firesale:label_gateway']       = 'Metoda płatności';
    $lang['firesale:label_shipping']      = 'Metoda wysyłki';
    $lang['firesale:label_quantity']      = 'Ilość';
    $lang['firesale:label_price_total']   = 'Cena całkowita';
    $lang['firesale:label_price_ship']    = 'Koszt wysyłki';
    $lang['firesale:label_price_sub']     = 'Sub-total';
    $lang['firesale:label_ship_to']       = 'Wysyłane do';
    $lang['firesale:label_bill_to']       = 'Opłata wnoszona przez';
    $lang['firesale:label_date']          = 'Data';
    $lang['firesale:label_product']       = 'Produkt';
    $lang['firesale:label_products']      = 'Produkty';
    $lang['firesale:label_company']       = 'Nazwa firmy';
    $lang['firesale:label_firstname']     = 'Imię';
    $lang['firesale:label_lastname']      = 'Nazwisko';
    $lang['firesale:label_phone']         = 'Telefon';
    $lang['firesale:label_email']         = 'Email';
    $lang['firesale:label_address1']      = 'Adres cz. 1';
    $lang['firesale:label_address2']      = 'Adres cz. 2';
    $lang['firesale:label_city']          = 'Miasto';
    $lang['firesale:label_postcode']      = 'Kod pocztowy';
    $lang['firesale:label_county']        = 'Województwo';
    $lang['firesale:label_country']       = 'Kraj';
    $lang['firesale:label_details']       = 'Mój adres płatności i wysyłki jest taki sam';
    $lang['firesale:label_user_order']    = 'Użytkownik';
    $lang['firesale:label_ip']            = 'Adres IP';
    $lang['firesale:label_ship_req']      = 'Wymaga wysyłki';
    $lang['firesale:label_address_title'] = 'Save Address as'; # Translate

    $lang['firesale:label_nameaz']     = 'Nazwa A - Z';
    $lang['firesale:label_nameza']     = 'Nazwa Z - A';
    $lang['firesale:label_pricelow']   = 'Cena Niska &gt; Wysoka';
    $lang['firesale:label_pricehigh']  = 'Cena Wysoka &gt; Niska';
    $lang['firesale:label_modelaz']    = 'Model A - Z';
    $lang['firesale:label_modelza']    = 'Model Z - A';
    $lang['firesale:label_creatednew'] = 'Newest - Oldest'; # translate
    $lang['firesale:label_createdold'] = 'Oldest - Newest'; # translate

    $lang['firesale:label_time_now']   = 'Przed minutą';
    $lang['firesale:label_time_min']   = 'około minuty temu.';
    $lang['firesale:label_time_mins']  = 'około %s minut temu.';
    $lang['firesale:label_time_hour']  = 'około godziny temu.';
    $lang['firesale:label_time_hours'] = 'około %s godzin temu.';
    $lang['firesale:label_time_day']   = '1 dzień temu.';
    $lang['firesale:label_time_days']  = '%s dni temu.';

    $lang['firesale:label_map']         = 'Mapa';
    $lang['firesale:label_route']       = 'Trasowanie';
    $lang['firesale:label_translation'] = 'Tłumaczenie';
    $lang['firesale:label_table']       = 'Tablica';
    $lang['firesale:label_https']       = 'HTTPS'; # translate
    $lang['firesale:label_use_https']   = 'Enable HTTPS'; # translate

    $lang['firesale:label_cur_code']        = 'Kod waluty';
    $lang['firesale:label_cur_code_inst']   = 'format ISO-4217 ';
    $lang['firesale:label_cur_tax']         = 'Stawka podatkowa';
    $lang['firesale:label_cur_mod']         = 'Modyfikator waluty';
    $lang['firesale:label_cur_mod_inst']    = 'Możesz nieco zmodyfikować kurs wymiany, aby pokryć dodatkowe koszty w tym regionie';
    $lang['firesale:label_exch_rate']       = 'Kurs wymiany';
    $lang['firesale:label_exch_rate_inst']  = 'Będzie aktualizowany co godzinę, można pozostawić pusty.';
    $lang['firesale:label_cur_flag']        = 'Powiązane zdjęcie';
    $lang['firesale:label_enabled']         = 'Włączony';
    $lang['firesale:label_disabled']        = 'Wyłączony';
    $lang['firesale:label_cur_format']      = 'Format waluty';
    $lang['firesale:label_cur_format_inst'] = 'Formatowanie, włącznie z symbolem waluty. "{{ price }}" pokazuje miejsce wstawienia ceny, np: {{ price }} zł';
    $lang['firesale:label_cur_format_dec']  = 'Symbol miejsca dziesiętnego';
    $lang['firesale:label_cur_format_sep']  = 'Symbol rozdzielania tysięcy';
    $lang['firesale:label_cur_format_num']  = 'Formatowanie liczb';

    $lang['firesale:label_tax_band'] = 'Stawka podatkowa';

    // Orders
    $lang['firesale:orders:title']                 = 'Zamówienia';
    $lang['firesale:orders:no_orders']             = 'Nie ma żadnych zamówień.';
    $lang['firesale:orders:my_orders']             = 'Moje zamówienia';
    $lang['firesale:orders:view_order']            = 'Zobacz zamówienie #%s';
    $lang['firesale:orders:title_create']          = 'Utwórz zamówienie';
    $lang['firesale:orders:title_edit']            = 'Edytuj zamówienie #%s';
    $lang['firesale:orders:delete_success']        = 'Zamówienie usunięte prawidłowo';
    $lang['firesale:orders:delete_error']          = 'Zamówienie nie zostało usunięte';
    $lang['firesale:orders:save_first']            = 'Zapisz zamówienie przed dodawaniem produktów';
    $lang['firesale:orders:delete']                = 'Usuń zamówienia';
    $lang['firesale:orders:mark_as']               = 'Oznacz jako ';
    $lang['firesale:orders:status_unpaid']         = 'Nieopłacone';
    $lang['firesale:orders:status_paid']           = 'Opłacone';
    $lang['firesale:orders:status_dispatched']     = 'Wysłane';
    $lang['firesale:orders:status_processing']     = 'Przetwarzane';
    $lang['firesale:orders:status_refunded']       = 'Zrefundowane';
    $lang['firesale:orders:status_cancelled']      = 'Anulowane';
    $lang['firesale:orders:status_failed']         = 'Błędne';
    $lang['firesale:orders:status_declined']       = 'Odrzucone';
    $lang['firesale:orders:status_mismatch']       = 'Niezgodne';
    $lang['firesale:orders:status_prefunded']      = 'Partially Refunded'; # Translate
    $lang['firesale:orders:failed_message']        = 'Podczas przetwarzania płatności wystąpił błąd';
    $lang['firesale:orders:declined_message']      = 'Twoja płatność nie została zaakceptowana, spróbuj jeszcze raz.';
    $lang['firesale:orders:mismatch_message']      = 'Twoja płatność nie odpowiada zamówieniu.';
    $lang['firesale:orders:logged_in']             = 'Aby obejrzeć historię zamówień musisz się zalogować';
    $lang['firesale:orders:label_view_order']      = 'Zobacz zamówienie';
    $lang['firesale:orders:label_products']        = 'Produkty';
    $lang['firesale:orders:label_view_order']      = 'Zobacz zamówienie';
    $lang['firesale:orders:label_customer']        = 'Klient';
    $lang['firesale:orders:label_date_placed']     = 'Data złożenia';
    $lang['firesale:orders:label_order_id']        = "ID zamówienia";
    $lang['firesale:orders:labe_shipping_address'] = 'Adres wysyłki';
    $lang['firesale:orders:labe_payment_address']  = 'Adres płatności';
    $lang['firesale:orders:label_order_status']    = 'Status zamówienia';
    $lang['firesale:orders:label_message']         = 'Wiadomość';

    // Gateways
    $lang['firesale:gateways:admin_title']             = 'Bramki płatności';
    $lang['firesale:gateways:install_title']           = 'Instaluj bramkę';
    $lang['firesale:gateways:edit_title']              = 'Edytuj bramkę';
    $lang['firesale:gateways:installed_title']         = 'Zainstalowane bramki';
    $lang['firesale:gateways:no_gateways']             = 'Nie ma zainstalowanych bramek';
    $lang['firesale:gateways:no_uninstalled_gateways'] = 'Wszystkie dostępne bramki są zainstalowane';
    $lang['firesale:gateways:errors:invalid_bool']     = 'Pole %s musi mieć wartość boolean (prawda/fałsz).';
    $lang['firesale:gateways:warning']                 = 'Wszystkie ustawienia bramki będą utracone i twój sklep może nie być w stanie obsługiwać płatności. Chcesz kontynuować odinstalowywanie bramki?';
    $lang['firesale:gateways:multiple_warning']        = 'Wszystkie ustawienia bramek będą utracone i twój sklep może nie być w stanie obsługiwać płatności. Chcesz kontynuować odinstalowywanie bramek?';

    $lang['firesale:gateways:installed_success'] = 'Bramka zainstalowana pomyślnie';
    $lang['firesale:gateways:installed_fail']    = 'Bramka nie mogła być zainstalowana';

    $lang['firesale:gateways:uninstalled_success']          = 'Bramka odinstalowana pomyślnie';
    $lang['firesale:gateways:uninstalled_fail']             = 'Bramka nie mogła zostać odinstalowana';
    $lang['firesale:gateways:multiple_uninstalled_success'] = 'Wybrane bramki zostały pomyślnie odinstalowane';
    $lang['firesale:gateways:multiple_uninstalled_fail']    = 'Wybrane bramki nie mogły zostać odinstalowane';

    $lang['firesale:gateways:multiple_enabled_success'] = 'Wybrane bramki zostały aktywowane';
    $lang['firesale:gateways:multiple_enabled_fail']    = 'Wybrane bramki nie mogły zostać aktywowane';
    $lang['firesale:gateways:enabled_success']          = 'Bramka aktywowana';
    $lang['firesale:gateways:enabled_fail']             = 'Bramka nie mogła zostać aktywowana';

    $lang['firesale:gateways:disabled_success']          = 'Bramka wyłączona';
    $lang['firesale:gateways:disabled_fail']             = 'Bramka nie mogła zostać wyłączona';
    $lang['firesale:gateways:multiple_disabled_success'] = 'Wybrane bramki zostały wyłączone';
    $lang['firesale:gateways:multiple_disabled_fail']    = 'Wybrane bramki nie mogły być wyłączone';

    $lang['firesale:gateways:updated_success'] = 'Bramka pomyślnie zaktualizowana';
    $lang['firesale:gateways:updated_fail']    = 'Bramka nie mogła zostać zaktualizowana';

    // Checkout
    $lang['firesale:gateways:labels:name']            = 'Nazwa';
    $lang['firesale:gateways:labels:desc']            = 'Opis';
    $lang['firesale:cart:title']                      = 'Koszyk';
    $lang['firesale:cart:empty']                      = 'W Twoim koszyku nie ma przedmiotów';
    $lang['firesale:cart:login_required']             = 'Musisz się zalogować nim to zrobisz.';
    $lang['firesale:cart:qty_too_low']                = 'Stan magazynowy jest za niski by dodać taką ilość przedmiotów do Twojego koszyka.';
    $lang['firesale:cart:price_changed']              = 'The price of some items in your cart has changed, please check them before continuing'; # Translate
    $lang['firesale:checkout:title']                  = 'Płatność finalna';
    $lang['firesale:checkout:error_callback']         = 'Przetwarzanie Twojego zamówienia napotkało problemy. Spróbuj jeszcze raz z inną metodą płatności.';
    $lang['firesale:payment:title']                   = 'Potwierdź szczegóły';
    $lang['firesale:payment:title_success']           = 'Płatność zakończona';
    $lang['firesale:checkout:title:ship_method']      = 'Forma wysyłki';
    $lang['firesale:checkout:title:payment_method']   = 'Metoda płatności';
    $lang['firesale:checkout:next']                   = 'Następne';
    $lang['firesale:checkout:previous']               = 'Poprzednie';
    $lang['firesale:checkout:select_shipping_method'] = 'Proszę wybrać metodę wysyłki przed kontynuowaniem.';
    $lang['firesale:checkout:select_payment_method']  = 'Proszę wybrać metodę płatności przed kontynuowaniem';
    $lang['firesale:checkout:submit_and_pay']         = 'Wyślij i Zapłać';
    $lang['firesale:checkout:shipping_min_price']     = 'The total value of your cart items does not meet the minimum for the selected shipping method';#Translate
    $lang['firesale:checkout:shipping_max_price']     = 'The total value of your cart items exceeds the maximum for the selected shipping method';#Translate
    $lang['firesale:checkout:shipping_min_weight']    = 'The total weight of your cart items does not meet the minimum for the selected shipping method';#Translate
    $lang['firesale:checkout:shipping_max_weight']    = 'The total weight of your cart items exceeds the maximum for the selected shipping method';#Translate
    $lang['firesale:checkout:shipping_invalid']       = 'The shipping method you selected is not valid';#Translate
    $lang['firesale:checkout:gateway_invalid']        = 'The payment gateway you selected is not valid';#Translate

    // Routes
    $lang['firesale:routes:title']          = 'Trasowanie';
    $lang['firesale:routes:new']            = 'Dodaj nowe trasowanie';
    $lang['firesale:routes:add_success']    = 'Nowe trasowanie dodane prawidłowo';
    $lang['firesale:routes:add_error']      = 'Błąd przy dodawaniu trasowania';
    $lang['firesale:routes:edit']           = 'Edytuj trasowanie %s ';
    $lang['firesale:routes:edit_success']   = 'Edycja trasowania zakończona prawidłowo';
    $lang['firesale:routes:edit_error']     = 'Błąd podczas edycji trasowania';
    $lang['firesale:routes:not_found']      = 'Wybrane trasowanie nie odnalezione';
    $lang['firesale:routes:none']           = 'Nie odnaleziono żadnych trasowań';
    $lang['firesale:routes:delete_success'] = 'Trasowanie usunięte prawidłowo';
    $lang['firesale:routes:delete_error']   = 'Błąd usuwania trasowania';
    $lang['firesale:routes:build_success']  = 'Prawidłowo przebudowano plik trasowań';
    $lang['firesale:routes:build_error']    = 'Błąd podczas przebudowania pliku trasowań';
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
    $lang['firesale:shortcuts:install_currency'] = 'Dodaj nową walutę';
    $lang['firesale:currency:enable']            = 'Włącz';
    $lang['firesale:currency:disable']           = 'Wyłącz';
    $lang['firesale:currency:disable_warn']      = 'Wyłączenie może spowodować kłopoty dla klientów i poprzednich zleceń';
    $lang['firesale:currency:delete']            = 'Usuń';
    $lang['firesale:currency:delete_warn']       = 'Usunięcie może spowodować kłopoty dla klientów i poprzednich zleceń';
    $lang['firesale:currency:create']            = 'Dodaj nową walutę';
    $lang['firesale:currency:edit']              = 'Edytuj walutę';
    $lang['firesale:currency:not_found']         = 'Wybrana waluta nie znaleziona';
    $lang['firesale:currency:add_success']       = 'Nowa waluta dodana prawidłowo';
    $lang['firesale:currency:add_error']         = 'Błąd podczas dodawania nowej waluty';
    $lang['firesale:currency:edit_success']      = 'Waluta pomyślnie wyedytowana';
    $lang['firesale:currency:edit_error']        = 'Błąd edycji waluty';
    $lang['firesale:currency:delete_success']    = 'Waluta usunięta pomyślnie';
    $lang['firesale:currency:delete_error']      = 'Błąd usuwania waluty';
    $lang['firesale:currency:format_none']       = 'Żaden';
    $lang['firesale:currency:format_00']         = 'Zaokrąglać do następnej pełnej liczby';
    $lang['firesale:currency:format_50']         = 'Zaokrąglać do najbliższej .50';
    $lang['firesale:currency:format_99']         = 'Zaokrąglać do najbliższej .99';

    // Taxes
    $lang['firesale:taxes:none']                = 'Brak zdefiniowanych stawek podatkowych';
    $lang['firesale:taxes:new']                 = 'Dodaj stawkę podatkową';
    $lang['firesale:taxes:edit']                = 'Edytuj stawkę podatkową';
    $lang['firesale:taxes:add_success']         = 'Stawka podatkowa wyedytowana prawidłowo';
    $lang['firesale:taxes:add_error']           = 'Błąd podczas tworzenia stawki podatkowej';
    $lang['firesale:taxes:edit_success']        = 'Stawka podatkowa wyedytowana prawidłowo';
    $lang['firesale:taxes:edit_error']          = 'Błąd edycji stawki podatkowej';
    $lang['firesale:taxes:assignments_updated'] = 'Przypisanie stawek podatkowych dokonane prawidłowo';
    $lang['firesale:taxes:add_tax_band']        = 'Create Tax Band'; # Translate

    // Addresses
    $lang['firesale:addresses:title']        = 'Mój adres';
    $lang['firesale:addresses:edit_address'] = 'Edytuj adres';
    $lang['firesale:addresses:new_address']  = 'Dodaj nowy adres';
    $lang['firesale:addresses:save']         = 'Zapisz';
    $lang['firesale:addresses:cancel']       = 'Anuluj';
    $lang['firesale:addresses:no_user']      = 'Zaloguj się by zarządzać książką adresową';
    $lang['firesale:addresses:add_success']  = 'Adres utworzony pomyślnie';
    $lang['firesale:addresses:add_error']    = 'Błąd podczas tworzenia adresu';
    $lang['firesale:addresses:edit_success'] = 'Adres wyedytowany pomyślnie';
    $lang['firesale:addresses:edit_error']   = 'Błąd podczas edycji adresu';

    // Products Frontend
    $lang['firesale:product:label_availability'] = "Dostępność";
    $lang['firesale:product:label_model']        = "Model";
    $lang['firesale:product:label_product_code'] = "Kod produktu";
    $lang['firesale:product:label_qty']          = "Ilość";
    $lang['firesale:product:label_add_to_cart']  = "Dodaj do koszyka";

    // Cart Frontend
    $lang['firesale:cart:label_remove']           = "Usuń";
    $lang['firesale:cart:label_image']            = "Obrazek";
    $lang['firesale:cart:label_name']             = "Nazwa";
    $lang['firesale:cart:label_model']            = "Model";
    $lang['firesale:cart:label_quantity']         = "Ilość";
    $lang['firesale:cart:label_unit_price']       = "Cena jedn.";
    $lang['firesale:cart:label_total']            = "Suma";
    $lang['firesale:cart:label_no_items_in_cart'] = "W koszyku nie ma przedmiotów";
    $lang['firesale:cart:button_update']          = "Odśwież koszyk";
    $lang['firesale:cart:button_goto_checkout']   = "Przejdź do podsumowania";
    $lang['firesale:cart:label_sub_total']        = "Podsuma";
    $lang['firesale:cart:label_tax']              = "Podatek";
    $lang['firesale:cart:label_total']            = "Suma";

    // Categories Frontend
    $lang['firesale:categories:grid']          = 'Siatka';
    $lang['firesale:categories:list']          = 'Lista';
    $lang['firesale:categories:add_to_basket'] = 'Dodaj do koszyka';

    // Payment Frontend
    $lang['firesale:payment:cancelled']     = 'Zamówienie anulowane';
    $lang['firesale:payment:wait_redirect'] = 'Proszę czekać. Trwa przekierowanie na stronę płatności...';
    $lang['firesale:payment:btn_continue']  = 'Kontynuuj';

    // Settings
    $lang['firesale:settings_tax']                   = 'Podatek';
    $lang['firesale:settings_tax_inst']              = 'Procent podatku, jaki ma być dodawany do produktów';
    $lang['firesale:settings_currency']              = 'Podstawowy kod waluty';
    $lang['firesale:settings_currency_inst']         = 'Akceptowane waluty (format ISO-4217)';
    $lang['firesale:settings_currency_key']          = 'Currency API Key';
    $lang['firesale:settings_currency_key_inst']     = 'Klucz API z <a target="_blank" href="https://openexchangerates.org/signup/free">Open Exchange Rates</a>';
    $lang['firesale:settings_current_currency']      = 'Aktualna waluta';
    $lang['firesale:settings_current_currency_inst'] = 'The current currency in use, used to update existing values if default currency is changed';
    $lang['firesale:settings_currency_updated']      = 'Ostatnia aktualizacja waluty';
    $lang['firesale:settings_currency_updated_inst'] = 'The last time the currency was updated, api is updated every hour and to keep to rate limits we only check after that';
    $lang['firesale:settings_perpage']               = 'Produktów na stronę';
    $lang['firesale:settings_perpage_inst']          = 'The number of products to be displayed on category and search result pages';
    $lang['firesale:settings_image_square']          = 'Kwadratowe obrazki';
    $lang['firesale:settings_image_square_inst']     = 'Niektóre tematy wymagają kwadratowych obrazków dla spójności wyglądu';
    $lang['firesale:settings_image_background']      = 'Kolor tła obrazków';
    $lang['firesale:settings_image_background_inst'] = 'Hexcode (bez #) koloru dla tła obrazków ze zmienioną wielkością';
    $lang['firesale:settings_login']                 = 'Wymagaj zalogowania do zakupów';
    $lang['firesale:settings_login_inst']            = 'Użytkownik musi być zalogowany, aby dokonywać zakupów';
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
    $lang['firesale:install:wrong_version']    = 'Nie można zainstalować modułu FireSale; FireSale wymaga PyroCMS v2.1.5 lub wyżej';
    $lang['firesale:install:missing_multiple'] = 'FireSale wymaga the Multiple Relationships field type do działania. Możesz to pobrać <a href="https://github.com/adamfairholm/PyroStreams-Multiple-Relationships/zipball/2.0/develop">stąd</a>';
    $lang['firesale:install:not_installed']    = 'Proszę zainstalować moduł FireSale przed instalacją dodatków FireSale';
    $lang['firesale:install:no_route_access']  = 'FireSale wymaga dostępu do  system/cms/config/routes.php file. Ustaw prawa dostępu i spróbuj ponownie';
    $lang['firesale:install:old_multiple']     = 'Your currently installed version of the Multiple field type is out of date, please delete or upgrade it before attempting to use FireSale'; # Translate
