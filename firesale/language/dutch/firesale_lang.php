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
    $lang['firesale:title']                                 = 'FireSale';
    $lang['firesale:store']                                 = 'Store'; # translate
    $lang['firesale:title:general']                         = 'Algemeen';
    $lang['firesale:title:details']                         = 'Uw Details';
    $lang['firesale:title:address']                         = 'UW Adres';
    $lang['firesale:title:bill']                            = 'Factuur';
    $lang['firesale:title:ship']                            = 'Verzending';

    // Sections
    $lang['firesale:sections:dashboard']                    = 'Dashboard';
    $lang['firesale:sections:categories']                   = 'Categorieën';
    $lang['firesale:sections:products']                     = 'Producten';
    $lang['firesale:sections:orders']                       = 'Bestellingen';
    $lang['firesale:sections:addresses']                    = 'Adressen';
    $lang['firesale:sections:orders_items']                 = 'Order Items';
    $lang['firesale:sections:gateways']                     = 'Betalingspoorten';
    $lang['firesale:sections:settings']                     = 'Instellingen';
    $lang['firesale:sections:routes']                       = 'Routes';
    $lang['firesale:sections:currency']                     = 'Valuta';
    $lang['firesale:sections:taxes']                        = 'BTW Tarieven';

    // Global Search
    $lang['firesale:product']                               = 'Product';
    $lang['firesale:products']                              = 'Producten';
    $lang['firesale:category']                              = 'Categorie';
    $lang['firesale:categories']                            = 'Categorieën';

    // Tabs
    $lang['firesale:tabs:general']                          = 'Algemeen';
    $lang['firesale:tabs:description']                      = 'Omschrijving';
    $lang['firesale:tabs:formatting']                       = 'Opmaak';
    $lang['firesale:tabs:shipping']                         = 'Verzending';
    $lang['firesale:tabs:metadata']                         = 'Metadata';
    $lang['firesale:tabs:attributes']                       = 'Attributen';
    $lang['firesale:tabs:modifiers']                        = 'Keuzes';
    $lang['firesale:tabs:images']                           = 'Afbeeldingen';
    $lang['firesale:tabs:assignments']                      = 'Toewijzingen';

    // Shortcuts
    $lang['firesale:shortcuts:prod_create']                 = 'Product Aanmaken';
    $lang['firesale:shortcuts:cat_create']                  = 'Categorie Aanmaken';
    $lang['firesale:shortcuts:install_gateway']             = 'Installeren van een betalingspoort';
    $lang['firesale:shortcuts:create_order']                = 'Order Aanmaken';
    $lang['firesale:shortcuts:create_routes']               = 'Route Aanmaken';
    $lang['firesale:shortcuts:build_routes']                = 'Routes Herbouwen';
    $lang['firesale:shortcuts:add_tax_band']                = 'BTW Tarief Aanmaken';
    $lang['firesale:shortcuts:assign_taxes']                = 'BTW Tarief Toewijzen';

    // Dashboard
    $lang['firesale:dash_overview']                         = 'Snel Overzicht';
    $lang['firesale:dash_categorytrack']                    = 'Categorie Tracking';
    $lang['firesale:elements:product_sales']                = 'Product Verkoop';
    $lang['firesale:elements:low_stock']                    = 'Voorraad Alarm';
    $lang['firesale:dashboard:no_sales']                    = 'Geen verkoop data gevonden van de afgelopen 12 maanden';
    $lang['firesale:dashboard:stock_low']                   = '%s Producten met lage voorraad';
    $lang['firesale:dashboard:stock_out']                   = '%s Producten met geen voorraad';
    $lang['firesale:dashboard:no_stock_low']                = 'Geen lage voorraad producten';
    $lang['firesale:dashboard:no_stock_out']                = 'Geen niet op voorraad producten';
    $lang['firesale:dashboard:view_more']                   = 'Zie meer...';
    $lang['firesale:dashbord:low_stock']                    = 'Lage Voorraad';
    $lang['firesale:dashbord:out_of_stock']                 = 'Niet op Voorraad';
    $lang['firesale:dashboard:year']                        = 'Jaar';
    $lang['firesale:dashboard:month']                       = 'Maand';
    $lang['firesale:dashboard:week']                        = 'Week';
    $lang['firesale:dashboard:today']                       = 'Vandaag';
    $lang['firesale:dashboard:sales_in']                    = 'in %s verkoop';

    // Categories
    $lang['firesale:cats_title']                            = 'Beheer Categorieën';
    $lang['firesale:cats_none']                             = 'Geen Categorieën Gevonden';
    $lang['firesale:cats_new']                              = 'Categorie Aanmaken';
    $lang['firesale:cats_order']                            = 'Soteer categorieën';
    $lang['firesale:cats_draft_label']                      = 'Concept';
    $lang['firesale:cats_live_label']                       = 'Live';
    $lang['firesale:cats_edit']                             = 'Categorie Bewerken';
    $lang['firesale:cats_edit_title']                       = 'Bewerk "%s"';
    $lang['firesale:cats_delete']                           = 'Verwijderen';
    $lang['firesale:cats_add_success']                      = 'Nieuwe categorie was met success aangemaakt';
    $lang['firesale:cats_add_error']                        = 'Er was een probleem met het toevoegen van een nieuwe categorie';
    $lang['firesale:cats_edit_success']                     = 'Categorie was met success bewerkt';
    $lang['firesale:cats_edit_error']                       = 'Er was een probleem met het bewerken van een category';
    $lang['firesale:cats_delete_success']                   = 'Categorie was met success verwijderd';
    $lang['firesale:cats_delete_error']                     = 'Er was een probleem met het verwijderen van een category';
    $lang['firesale:cats_all_products']                     = 'Alle Producten';
    $lang['firesale:category:uncategorised']                = 'Ongecategoriseerd';
    $lang['firesale:category:uncategorised_slug']           = 'ongecategoriseerd';
    $lang['firesale:category:uncategorised_description']    = 'Dit is uw standaard product categorie, deze kan niet worden verwijderd; u kunt de naam wel aanpassen.';

    // Products
    $lang['firesale:prod_none']                             = 'Geen producten gevonden';
    $lang['firesale:prod_create']                           = 'Product aanmaken';
    $lang['firesale:prod_header']                           = '%t Bewerken';
    $lang['firesale:prod_title']                            = 'Beheer producten';
    $lang['firesale:prod_title_create']                     = 'Maak een nieuw product';
    $lang['firesale:prod_title_edit']                       = 'Product bewerken';
    $lang['firesale:prod_edit_success']                     = 'Product succesvol bewerkt';
    $lang['firesale:prod_edit_error']                       = 'Product bewerking mislukt';
    $lang['firesale:prod_add_success']                      = 'Een nieuw product was succesvol';
    $lang['firesale:prod_add_error']                        = 'Er was een probleem met het aanmaken van een nieuw product';
    $lang['firesale:prod_delete_error']                     = 'Er was een probleem met het bewerken van een product';
    $lang['firesale:prod_delete_success']                   = 'Product succesvol verwijderd';
    $lang['firesale:prod_duplicate_error']                  = 'Er was een probleem met het kopieëren';
    $lang['firesale:prod_duplicate_success']                = 'Product succesvol gekopieërd';
    $lang['firesale:prod_not_found']                        = 'Dit product can niet worden gevonden';
    $lang['firesale:prod_delimg_success']                   = 'Afbeelding succesvol verwijderd';
    $lang['firesale:prod_delimg_error']                     = 'Er was een probleem met het verwijderen van het geselecteerde bericht';
    $lang['firesale:prod_button_quick_edit']                = 'Snel Bewerken';

    // Product Modifiers & Variations
    $lang['firesale:mods:title']                            = 'Keuzes';
    $lang['firesale:mods:create_success']                   = 'Nieuwe Keuze succesvol aangemaakt';
    $lang['firesale:mods:edit_success']                     = 'Keuze succesvol bewerkt';
    $lang['firesale:mods:delete_success']                   = 'Keuze succesvol verwijderd';
    $lang['firesale:mods:create_error']                     = 'Fout bij het aanmaken van een nieuwe keuze';
    $lang['firesale:mods:edit_error']                       = 'Fout bij het bewerken van een keuze';
    $lang['firesale:mods:delete_error']                     = 'Fout bij het verwijderen van een keuze';
    $lang['firesale:mods:create']                           = 'Keuze Aanmaken';
    $lang['firesale:mods:edit']                             = 'Keuze Bewerken';
    $lang['firesale:mods:none']                             = 'Geen Keuze Gevonden';
    $lang['firesale:mods:nothere']                          = 'U kunt geen keuze toevoegen aan eeen variant';
    $lang['firesale:vars:title']                            = 'Variaties';
    $lang['firesale:vars:show_set']                         = 'Toon Variaties';
    $lang['firesale:vars:show_inst']                        = 'Wilt u de variaties tonen bij de catalogus en de zoek resultaten?';
    $lang['firesale:vars:create_success']                   = 'Nieuwe variatie succesvol aangemaakt';
    $lang['firesale:vars:edit_success']                     = 'Variatie succesvol bewerkt';
    $lang['firesale:vars:delete_success']                   = 'Variatie succesvol verwijderd';
    $lang['firesale:vars:create_error']                     = 'Fout bij het aanmaken van een nieuwe variatie';
    $lang['firesale:vars:edit_error']                       = 'Fout bij het bewerken van een variatie';
    $lang['firesale:vars:delete_error']                     = 'Fout bij het verwijderen van een variatie';
    $lang['firesale:vars:none']                             = 'Geen variatie gevonden';
    $lang['firesale:vars:create']                           = 'Variatie Aanmaken';
    $lang['firesale:vars:stock_low']      					= 'Er is niet voldoende voorraad van %s om dit product te kopen';
    $lang['firesale:vars:category']       					= 'Opgebouwd van Categorie';

    // New Products
    $lang['firesale:new:title']                             = 'New Products'; # translate
    $lang['firesale:new:in:title']                          = 'New Products in %s'; # translate

    // Instructions
    $lang['firesale:inst_rrp']                              = 'Aanbevolen Verkoop Prijs voor en naar BTW';
    $lang['firesale:inst_price']                            = 'Huidige Verkoop Prijs voor en naar BTW (als deze lager is dan de Aanbevolen Verkoop Prijs, and wordt deze getoon als een product die in uitverkoop is';

    // Labels
    $lang['firesale:label_draft']                           = 'Concept';
    $lang['firesale:label_live']                            = 'Live';
    $lang['firesale:label_id']                              = 'Product Code';
    $lang['firesale:label_title']                           = 'Titel';
    $lang['firesale:label_slug']                            = 'Slug';
    $lang['firesale:label_status']                          = 'Status';
    $lang['firesale:label_type']                            = 'Type';
    $lang['firesale:label_description']                     = 'Omschrijving';
    $lang['firesale:label_inst']                            = 'Instructies';
    $lang['firesale:label_category']                        = 'Categorie';
    $lang['firesale:label_parent']                          = 'Hoofd Categorie';
    $lang['firesale:label_options']                         = 'Opties';
    $lang['firesale:label_filtercat']                       = 'Filter per Categorie';
    $lang['firesale:label_filtersel']                       = 'Selecteer een Categorie';
    $lang['firesale:label_filterprod']                      = 'Selecteer een Product';
    $lang['firesale:label_filterstatus']                    = 'Selecteer een Product Status';
    $lang['firesale:label_filtersstatus']                   = 'Selecteer een Voorraad Status';
    $lang['firesale:label_order_status']                    = 'Selecteer een Order Status';
    $lang['firesale:label_rrp']                             = 'Aanbevolen Verkoop Prijs';
    $lang['firesale:label_rrp_tax']                         = 'Aanbevolen Verkoop Prijs (voor BTW)';
    $lang['firesale:label_rrp_short']                       = 'AVP';
    $lang['firesale:label_price']                           = 'Huidige Prijs';
    $lang['firesale:label_price_tax']                       = 'Huidige Prijs (voor BTW)';
    $lang['firesale:label_stock']                           = 'Huidige Voorraad';
    $lang['firesale:label_drop_images']                     = 'Laat een afbeelding hier los of klik hier op een foto te uploaden';
    $lang['firesale:label_duplicate']                       = 'Kopieer';
    $lang['firesale:label_showfilter']                      = 'Toon Filters';
    $lang['firesale:label_mod_variant']                     = 'Variatie';
    $lang['firesale:label_mod_input']                       = 'Invoer';
    $lang['firesale:label_mod_single']                      = 'Enkel Product';
    $lang['firesale:label_mod_price']                       = 'Prijs Variatie';
    $lang['firesale:label_mod_price_inst']                  = 'Enkele instructies';

    $lang['firesale:label_stock_short']                     = 'Voorraad';
    $lang['firesale:label_stock_status']                    = 'Voorraad Status';
    $lang['firesale:label_stock_in']                        = 'Op Voorraad';
    $lang['firesale:label_stock_low']                       = 'Lage Voorraad';
    $lang['firesale:label_stock_out']                       = 'Niet op Voorrraad';
    $lang['firesale:label_stock_order']                     = 'Voorraad Wordt Aangevult';
    $lang['firesale:label_stock_ended']                     = 'Niet meer leverbaar';
    $lang['firesale:label_stock_unlimited']                 = 'Oneindig';

    $lang['firesale:label_remove']                          = 'Verwijder';
    $lang['firesale:label_image']                           = 'Afbeelding';
    $lang['firesale:label_images']                          = 'Afbeeldingen';
    $lang['firesale:label_order']                           = 'Bestel';
    $lang['firesale:label_gateway']                         = 'Betaal Methode';
    $lang['firesale:label_shipping']                        = 'Verzend Methode';
    $lang['firesale:label_quantity']                        = 'Aantal';
    $lang['firesale:label_price_total']                     = 'Totaal Prijs';
    $lang['firesale:label_price_ship']                      = 'Verzendkosten';
    $lang['firesale:label_price_sub']                       = 'Sub-totaal';
    $lang['firesale:label_ship_to']                         = 'Verstuur naar';
    $lang['firesale:label_bill_to']                         = 'Factuur naar';
    $lang['firesale:label_date']                            = 'Datum';
    $lang['firesale:label_product']                         = 'Product';
    $lang['firesale:label_products']                        = 'Producten';
    $lang['firesale:label_company']                         = 'Bedrijfsnaam';
    $lang['firesale:label_firstname']                       = 'Voornaam';
    $lang['firesale:label_lastname']                        = 'Achternaam';
    $lang['firesale:label_phone']                           = 'Telefoon';
    $lang['firesale:label_email']                           = 'Emailadres';
    $lang['firesale:label_address1']                        = 'Adres';
    $lang['firesale:label_address2']                        = 'Adres Toevoegsels';
    $lang['firesale:label_city']                            = 'Woonplaats';
    $lang['firesale:label_postcode']                        = 'Postcode';
    $lang['firesale:label_county']                          = 'Provincie';
    $lang['firesale:label_country']                         = 'Land';
    $lang['firesale:label_details']                         = 'Mijn Aflever en Factuur adres zijn het zelfde';
    $lang['firesale:label_user_order']                      = 'Gebruiker';
    $lang['firesale:label_ip']                              = 'IP Adres';
    $lang['firesale:label_ship_req']                        = 'Versturen Vereist';
    $lang['firesale:label_address_title']                   = 'Opslaan Als';

    $lang['firesale:label_nameaz']                          = 'Naam A - Z';
    $lang['firesale:label_nameza']                          = 'Naam Z - A';
    $lang['firesale:label_pricelow']                        = 'Prijs Laag &gt; Hoog';
    $lang['firesale:label_pricehigh']                       = 'Prijs Hoog &gt; Laag';
    $lang['firesale:label_modelaz']                         = 'Model A - Z';
    $lang['firesale:label_modelza']                         = 'Model Z - A';
    $lang['firesale:label_creatednew']                      = 'Newest - Oldest'; # translate
    $lang['firesale:label_createdold']                      = 'Oldest - Newest'; # translate

    $lang['firesale:label_time_now']                        = 'minder dan een minuut geleden.';
    $lang['firesale:label_time_min']                        = 'ongeveer een minuut geleden.';
    $lang['firesale:label_time_mins']                       = 'ongeveer %s minuten geleden.';
    $lang['firesale:label_time_hour']                       = 'ongeveer een uur geleden.';
    $lang['firesale:label_time_hours']                      = 'ongeveer %s uur geleden.';
    $lang['firesale:label_time_day']                        = '1 dag geleden.';
    $lang['firesale:label_time_days']                       = '%s dagen geleden.';

    $lang['firesale:label_map']                             = 'Kaart';
    $lang['firesale:label_route']                           = 'Route';
    $lang['firesale:label_translation']                     = 'Vertaling';
    $lang['firesale:label_table']                           = 'Tabel';
    $lang['firesale:label_https']       					= 'HTTPS';
    $lang['firesale:label_use_https']   					= 'HTTPS Inschakelen';

    $lang['firesale:label_cur_code']                        = 'Valuta Code';
    $lang['firesale:label_cur_code_inst']                   = 'ISO-4217 Format';
    $lang['firesale:label_cur_tax']                         = 'BTW Tarief';
    $lang['firesale:label_cur_mod']                         = 'Currency Variatie';
    $lang['firesale:label_cur_mod_inst']                    = 'U wilt mogelijk de uitwisselings ratio iets hoger aanpassen om extra kosten te dekken';
    $lang['firesale:label_exch_rate']                       = 'Uitwisselings Ratio';
    $lang['firesale:label_exch_rate_inst']                  = 'Dit wordt ieder uur bijgewerkt als u dit leeg laat wordt het met opslaan bijgewerkt';
    $lang['firesale:label_cur_flag']                        = 'Relateerde Afbeelding';
    $lang['firesale:label_enabled']                         = 'Ingeschakeld';
    $lang['firesale:label_disabled']                        = 'Uitgeschakeld';
    $lang['firesale:label_cur_format']                      = 'Valuta Formaat';
    $lang['firesale:label_cur_format_inst']                 = 'Format van de valuta zoals bijvoorbeeld "€ {{ price }}"';
    $lang['firesale:label_cur_format_dec']                  = 'Decimaal symbool plaats';
    $lang['firesale:label_cur_format_sep']                  = 'Duizend scheidingsteken';
    $lang['firesale:label_cur_format_num']                  = 'Nummer Format';

    $lang['firesale:label_tax_band']                        = 'BTW Tarief';

    // Orders
    $lang['firesale:orders:title']                          = 'Bestellingen';
    $lang['firesale:orders:no_orders']                      = 'Er zijn momenteel geen bestellingen';
    $lang['firesale:orders:my_orders']                      = 'Mijn Bestellingen';
    $lang['firesale:orders:view_order']                     = 'Bekijk Bestelling #%s';
    $lang['firesale:orders:title_create']                   = 'Bestelling Aanmaken';
    $lang['firesale:orders:title_edit']                     = 'Bestelling #%s Bewerken';
    $lang['firesale:orders:delete_success']                 = 'Bestelling succesvol verwijderd';
    $lang['firesale:orders:delete_error']                   = 'Fout bij het verwijderen van een bestelling';
    $lang['firesale:orders:save_first']                     = 'Sla uw order eerst op voor u een bestelling plaatst';
    $lang['firesale:orders:delete']                         = 'Verwijder Bestellingen';
    $lang['firesale:orders:mark_as']                        = 'Markeer Als ';
    $lang['firesale:orders:status_unpaid']                  = 'Onbetaald';
    $lang['firesale:orders:status_paid']                    = 'Bestaald';
    $lang['firesale:orders:status_dispatched']              = 'Verzonden';
    $lang['firesale:orders:status_processing']              = 'Verwerken';
    $lang['firesale:orders:status_refunded']                = 'Terug gestort';
    $lang['firesale:orders:status_cancelled']               = 'Geannuleerd';
    $lang['firesale:orders:status_failed']                  = 'Mislukt';
    $lang['firesale:orders:status_declined']                = 'Geweigerd';
    $lang['firesale:orders:status_mismatch']                = 'Komt niet overeen';
    $lang['firesale:orders:status_prefunded']               = 'Gedeeltelijk terug gestort';
    $lang['firesale:orders:failed_message']                 = 'Fout bij het verwerken van uw betaling';
    $lang['firesale:orders:declined_message']               = 'Uw betaling is geweigerd. Probeer het later nog eens';
    $lang['firesale:orders:mismatch_message']               = 'Uw betaling komt niet overeen met de bestelling.';
    $lang['firesale:orders:logged_in']                      = 'U moet ingelogd zijn om uw Bestel Historie te kunnen bekijken.';
    $lang['firesale:orders:label_view_order']               = 'Bekijk Bestelling';
    $lang['firesale:orders:label_products']                 = 'Producten';
    $lang['firesale:orders:label_view_order']               = 'Bekijk Bestelling';
    $lang['firesale:orders:label_customer']                 = 'Klant';
    $lang['firesale:orders:label_date_placed']              = 'Datum Geplaatst';
    $lang['firesale:orders:label_order_id']                 = "Bestellings ID";
    $lang['firesale:orders:labe_shipping_address']          = 'Verzend Adres';
    $lang['firesale:orders:labe_payment_address']           = 'Factuur Adres';
    $lang['firesale:orders:label_order_status']             = 'Bestelling Status';
    $lang['firesale:orders:label_message']                  = 'Bericht';

    // Gateways
    $lang['firesale:gateways:admin_title']                  = 'Betalingsmethodes';
    $lang['firesale:gateways:install_title']                = 'Installeer een Betalingsmethode';
    $lang['firesale:gateways:edit_title']                   = 'Bewerk een Betalingsmethode';
    $lang['firesale:gateways:installed_title']              = 'Geinstalleerde Betalingsmethodes';
    $lang['firesale:gateways:no_gateways']                  = 'Er zijn momenteel geen Betalingsmethodes geinstalleerd.';
    $lang['firesale:gateways:no_uninstalled_gateways']      = 'Alle Betalingsmethodes zijn geinstalleerd.';
    $lang['firesale:gateways:errors:invalid_bool']          = 'Het %s Veld met een Waar / Onwaar zijn.';
    $lang['firesale:gateways:warning']                      = 'Alle Betalingsmethode Instellingen zullen worden gewist, Het kan zijn dat u geen betaling meer kan accepteren! Weet u zeker dat u deze Betalingsmethode wilt Deinstalleren?';
    $lang['firesale:gateways:multiple_warning']             = 'Alle Betalingsmethode Instellingen zullen worden gewist, Het kan zijn dat u geen betaling meer kan accepteren! Weet u zeker dat u deze Betalingsmethode wilt Deinstalleren?';

    $lang['firesale:gateways:installed_success']            = 'De Betalingsmethode is succesvol geinstalleerd';
    $lang['firesale:gateways:installed_fail']               = 'De Betalingsmethode kon niet worden geinstaleed';

    $lang['firesale:gateways:uninstalled_success']          = 'De Betalingsmethode is succesvol gedeinstalleerd';
    $lang['firesale:gateways:uninstalled_fail']             = 'De Betalingsmethode installed';
    $lang['firesale:gateways:multiple_uninstalled_success'] = 'De geselecteerde Betalingsmethodes were successfully uninstalled';
    $lang['firesale:gateways:multiple_uninstalled_fail']    = 'De geselecteerde Betalingsmethodes could not be uninstalled';

    $lang['firesale:gateways:multiple_enabled_success']     = 'De geselecteerde Betalingsmethodes zijn ingeschakeld';
    $lang['firesale:gateways:multiple_enabled_fail']        = 'De geselecteerde Betalingsmethodes konden niet worden ingeschakeld';
    $lang['firesale:gateways:enabled_success']              = 'De Betalingsmethode is ingeschakeld';
    $lang['firesale:gateways:enabled_fail']                 = 'De Betalingsmethode kon niet worden ingeschakeld';

    $lang['firesale:gateways:disabled_success']             = 'De Betalingsmethode is uitgeschakeld';
    $lang['firesale:gateways:disabled_fail']                = 'De Betalingsmethode kon niet worden uitgeschakeld';
    $lang['firesale:gateways:multiple_disabled_success']    = 'De geselecteerde Betalingsmethodes zijn uitgeschakeld';
    $lang['firesale:gateways:multiple_disabled_fail']       = 'De geselecteerde Betalingsmethodes konden niet worden uitgeschakeld';

    $lang['firesale:gateways:updated_success']              = 'Betalingsmethode succesvol bijgewerkt';
    $lang['firesale:gateways:updated_fail']                 = 'De Betalingsmethode kon niet worden bijgewekt';

    // Checkout
    $lang['firesale:gateways:labels:name']                  = 'Naam';
    $lang['firesale:gateways:labels:desc']                  = 'Omschrijving';
    $lang['firesale:cart:title']                            = 'Winkelmand';
    $lang['firesale:cart:empty']                            = 'Er zijn momenteel geen Producten in uw winkelmand';
    $lang['firesale:cart:login_required']                   = 'U moet ingelogd zijn voor u dit kunt doen';
    $lang['firesale:cart:qty_too_low']                      = 'U kunt niet meer in uw winkelmand stoppen dan dat we op voorraad hebben';
    $lang['firesale:cart:price_changed']                    = 'De prijs van een aantal Producten zijn gewijzigd, controlleer deze a.u.b. eerst voor dat u verder gaat';
    $lang['firesale:checkout:title']                        = 'Kassa';
    $lang['firesale:checkout:error_callback']               = 'Er is een probleem met uw bestelling, probeer het nog eens, indien mogelijk met een andere Betalingsmethode.';
    $lang['firesale:payment:title']                         = 'Bevestig de Details';
    $lang['firesale:payment:title_success']                 = 'Betaling Voltooid';
    $lang['firesale:checkout:title:ship_method']            = 'Verzend Methode';
    $lang['firesale:checkout:title:payment_method']         = 'Betalingsmethode';
    $lang['firesale:checkout:next']                         = 'Volgende';
    $lang['firesale:checkout:previous']                     = 'Vorige';
    $lang['firesale:checkout:select_shipping_method']       = 'Kies eerst een Verzendmethode voor dat u verder gaat';
    $lang['firesale:checkout:select_payment_method']        = 'Kies eerst een Betalingsmethode voor dat u verder gaat';
    $lang['firesale:checkout:submit_and_pay']               = 'Bevestig &amp; Betaal';
    $lang['firesale:checkout:shipping_min_price']     		= 'De totale waarde van uw winkelmand voldoet niet aan de minimum voor de gekozen verzendmethode';
    $lang['firesale:checkout:shipping_max_price']     		= 'De totale waarde van uw winkelmand overschrijdt het maximum voor de gekozen verzendmethode';
    $lang['firesale:checkout:shipping_min_weight']    		= 'Het totale gewicht van uw winkelmand voldoet niet aan de minimum voor de gekozen verzendmethode';
    $lang['firesale:checkout:shipping_max_weight']    		= 'Het totale gewicht van uw winkelmand overschrijdt het maximum voor de gekozen verzendmethode';
    $lang['firesale:checkout:shipping_invalid']       		= 'De verzendmethode die u hebt geselecteerd is niet geldig';
    $lang['firesale:checkout:gateway_invalid']        		= 'De betaalmethode die u hebt geselecteerd is niet geldig';

    // Routes
    $lang['firesale:routes:title']                          = 'Routes';
    $lang['firesale:routes:new']                            = 'Nieuwe Route Aanmaken';
    $lang['firesale:routes:add_success']                    = 'Nieuwe Route succesvol aangemaakt';
    $lang['firesale:routes:add_error']                      = 'Fout bij het aanmaken van de nieuwe Route';
    $lang['firesale:routes:edit']                           = 'Bewerk Route %s';
    $lang['firesale:routes:edit_success']                   = 'Route succesvol bewerkt';
    $lang['firesale:routes:edit_error']                     = 'Fout bij het bewerken van de route';
    $lang['firesale:routes:not_found']                      = 'De geselecteerde Route kon niet worden gevonden';
    $lang['firesale:routes:none']                           = 'Geen Routes gevonden';
    $lang['firesale:routes:delete_success']                 = 'Route succesvol verwijderd';
    $lang['firesale:routes:delete_error']                   = 'Fout bij het verwijderen van de Route';
    $lang['firesale:routes:build_success']                  = 'De Routes Bestand is succesvol bijgewerkt';
    $lang['firesale:routes:build_error']                    = 'Er was een fout tijdens het bewerken van het Routes Bestand';
    $lang['firesale:routes:write_error']                    = 'Toegang Geweigerd: Controleer of config/routes.php beschrijfbaar is en probeer het opnieuw';

    // Route Labels
    $lang['firesale:routes:category_custom']                = 'Categorie Aanpassen';
    $lang['firesale:routes:category']                       = 'Categorie';
    $lang['firesale:routes:product']                        = 'Product';
    $lang['firesale:routes:cart']                           = 'Winkelmand';
    $lang['firesale:routes:order_single']                   = 'Enkel Bestelling';
    $lang['firesale:routes:orders']                         = 'Gebruikers Bestelling';
    $lang['firesale:routes:addresses']                      = 'Gebruikers Adres';
    $lang['firesale:routes:currency']                       = 'Valuta Wisselaar';
    $lang['firesale:routes:new_products']                   = 'New Products'; # translate

    // Currency
    $lang['firesale:shortcuts:install_currency']            = 'Installeer een valuta';
    $lang['firesale:currency:enable']                       = 'Inschakelen';
    $lang['firesale:currency:disable']                      = 'Uitschakelen';
    $lang['firesale:currency:disable_warn']                 = 'Het uitschakelen kan storing geven met eerdere bestellingen';
    $lang['firesale:currency:delete']                       = 'Verwijder';
    $lang['firesale:currency:delete_warn']                  = 'Het verwijderen kan storing geven met eerdere bestellingen';
    $lang['firesale:currency:create']                       = 'Nieuwe Valuta aanmaken';
    $lang['firesale:currency:edit']                         = 'Valuta Bewerken';
    $lang['firesale:currency:not_found']                    = 'Geselecteerde valuta niet gevonden';
    $lang['firesale:currency:add_success']                  = 'Nieuwe valuta succesvol aangemaakt';
    $lang['firesale:currency:add_error']                    = 'Fout bij het aanmaken van een valuta';
    $lang['firesale:currency:edit_success']                 = 'Valuta succesvol bewerkt';
    $lang['firesale:currency:edit_error']                   = 'Fout bij het bewerken van een valuta';
    $lang['firesale:currency:delete_success']               = 'Valuta succesvol verwijderd';
    $lang['firesale:currency:delete_error']                 = 'Fout bij het verwijderen van een valuta';
    $lang['firesale:currency:format_none']                  = 'Geen';
    $lang['firesale:currency:format_00']                    = 'Afronden tot het volgende hele getal';
    $lang['firesale:currency:format_50']                    = 'Afronden tot de dichtbijzijnde .50 cent';
    $lang['firesale:currency:format_99']                    = 'Afronden tot de dichtbijzijnde .99 cent';

    // Taxes
    $lang['firesale:taxes:none']                            = 'Er zijn momenteel geen Belastingstarieven ingesteld';
    $lang['firesale:taxes:new']                             = 'Een Belastingstarief Aanmaken';
    $lang['firesale:taxes:edit']                            = 'Een Belastingstarief Bewerken';
    $lang['firesale:taxes:add_success']                     = 'Belastinstarief succesvol aangemaakt';
    $lang['firesale:taxes:add_error']                       = 'Fout bij het aanmaken van een Belastingstarief';
    $lang['firesale:taxes:edit_success']                    = 'Belastingstarief succesvol bewerkt';
    $lang['firesale:taxes:edit_error']                      = 'Fout bij het bewerken van een Belastingstarief';
    $lang['firesale:taxes:assignments_updated']             = 'Belastingstarieven succesvol toegepast';
    $lang['firesale:taxes:add_tax_band']                    = 'Belastingstarief Aanmaken';

    // Addresses
    $lang['firesale:addresses:title']                       = 'Mijn Adressen';
    $lang['firesale:addresses:edit_address']                = 'Bewerk Adres';
    $lang['firesale:addresses:new_address']                 = 'Adres Aanmaken';
    $lang['firesale:addresses:save']                        = 'Opslaan';
    $lang['firesale:addresses:cancel']                      = 'Annuleren';
    $lang['firesale:addresses:no_user']                     = 'U moet ingelogd zijn om uw adres boek in te kunnen zien';
    $lang['firesale:addresses:add_success']                 = 'Adres succesvol aangemaakt';
    $lang['firesale:addresses:add_error']                   = 'Fout bij het aanmaken van het adres';
    $lang['firesale:addresses:edit_success']                = 'Adres succesvol bewerkt';
    $lang['firesale:addresses:edit_error']                  = 'Fout bij het bewerken van het adres';

    // Products Frontend
    $lang['firesale:product:label_availability']            = "Beschikbaarheid";
    $lang['firesale:product:label_model']                   = "Model";
    $lang['firesale:product:label_product_code']            = "Artikel nummer";
    $lang['firesale:product:label_qty']                     = "Aantal";
    $lang['firesale:product:label_add_to_cart']             = "Bestellen";

    // Cart Frontend
    $lang['firesale:cart:label_remove']                     = "Verwijderen";
    $lang['firesale:cart:label_image']                      = "Afbeelding";
    $lang['firesale:cart:label_name']                       = "Naam";
    $lang['firesale:cart:label_model']                      = "Model";
    $lang['firesale:cart:label_quantity']                   = "Aantal";
    $lang['firesale:cart:label_unit_price']                 = "Prijs Per Stuk";
    $lang['firesale:cart:label_total']                      = "Totaal";
    $lang['firesale:cart:label_no_items_in_cart']           = "Geen artikelen in uw winkelmand";
    $lang['firesale:cart:button_update']                    = "Winkelmand Bijwerken";
    $lang['firesale:cart:button_goto_checkout']             = "Ga naar kassa";
    $lang['firesale:cart:label_sub_total']                  = "Sub-Totaal";
    $lang['firesale:cart:label_tax']                        = "BTW";
    $lang['firesale:cart:label_total']                      = "Totaal";

    // Categories Frontend
    $lang['firesale:categories:grid']                       = 'Raster';
    $lang['firesale:categories:list']                       = 'Lijst';
    $lang['firesale:categories:add_to_basket']              = 'Bestel';

    // Payment Frontend
    $lang['firesale:payment:cancelled']                     = 'Bestelling Geannuleerd';
    $lang['firesale:payment:wait_redirect']                 = 'Een ogenblik geduld A.U.B. terwijl we u doorsturen naar uw bestalingsmethode...';
    $lang['firesale:payment:btn_continue']                  = 'Volgende';

    // Settings
    $lang['firesale:settings_tax']                          = 'BTW Percentage';
    $lang['firesale:settings_tax_inst']                     = 'Het BTW Percentage dat van toepassing is op de producten';
    $lang['firesale:settings_currency']                     = 'Standaard Valuta';
    $lang['firesale:settings_currency_inst']                = 'Het Valuta dat u ondersteund (ISO-4217 format)';
    $lang['firesale:settings_currency_key']                 = 'Valuta API Sleutel';
    $lang['firesale:settings_currency_key_inst']            = 'API Sleutel van <a target="_blank" href="https://openexchangerates.org/signup/free">Open Exchange Rates</a>';
    $lang['firesale:settings_current_currency']             = 'Huidige Valuta';
    $lang['firesale:settings_current_currency_inst']        = 'Het huidig gebruikte valuta, Gebruikt om de valuta waardes bij te werken als u deze veranderd';
    $lang['firesale:settings_currency_updated']             = 'Laatste Valuta Wijziging';
    $lang['firesale:settings_currency_updated_inst']        = 'De Laaste keer dat het valuta is bijgewekt, api is ieder uur bijgewerkt en je moet het beperken tot die tijd';
    $lang['firesale:settings_perpage']                      = 'Producten per Pagina';
    $lang['firesale:settings_perpage_inst']                 = 'Het maximum aantal producten die getoond worden bij de categorieën en bij de zoekresultaten';
    $lang['firesale:settings_image_square']                 = 'Maak afbeeldingen vierkant';
    $lang['firesale:settings_image_square_inst']            = 'Somige Thema\'s hebben vierkante afbeeldingen nodig om de layout gelijk te houden';
    $lang['firesale:settings_image_background']             = 'Afbeelding Achtergrond Kleur';
    $lang['firesale:settings_image_background_inst']        = 'Hexcode (Zonder #) de achtergrondskleur voor bij gesneden afbeeldingen';
    $lang['firesale:settings_login']                        = 'Inloggen vereist voor u kunt bestellen';
    $lang['firesale:settings_login_inst']                   = 'Controlleer of een gebruiker is ingelogd voor dat de gebruiker een bestelling kan plaatsen';
    $lang['firesale:settings_dashboard']             		= 'Overschrijf het standaard Dashboard';
    $lang['firesale:settings_dashboard_inst']        		= 'Toon het FireSale dashboard inplaats van de standaard';
    $lang['firesale:settings_low']                   		= 'Lage voorraad';
    $lang['firesale:settings_low_inst']              		= 'Het aantal producten dat er overzijn voordat het als lage voorraad wordt aanschouwd';
    $lang['firesale:settings_new']                   		= 'Nieuw Product Tijd';
    $lang['firesale:settings_new_inst']              		= 'De tijd in seconden dat een product als nieuw wordt aanschouwd';
    $lang['firesale:settings_basic']                        = 'Basic Checkout View'; # translate
    $lang['firesale:settings_basic_inst']                   = 'Minimal checkout layout, requires a minimal.html layout in your theme'; # translate
    $lang['firesale:settings_disabled']                     = 'Disable Product Sales'; # translate
    $lang['firesale:settings_disabled_inst']                = 'Everything looks normal but nothing can be added to cart or paid for'; # translate
    $lang['firesale:settings_disabled_msg']                 = 'Disabled Message'; # translate
    $lang['firesale:settings_disabled_msg_inst']            = 'A flashdata error shown to users after they attempt to add an item to their cart'; # translate

    // Install errors
    $lang['firesale:install:wrong_version']                 = 'Kan de FireSale module niet installeren, FireSale heeft PyroCMS v2.1.5 of hoger nodig';
    $lang['firesale:install:missing_multiple']              = 'FireSale heeft de Multiple Relationships veld type om te werken. U kunt deze downloaden van <a href="https://github.com/adamfairholm/PyroStreams-Multiple-Relationships/zipball/2.0/develop">Hier</a>';
    $lang['firesale:install:not_installed']                 = 'Installeer eerst de FireSale module voor dat u de overige modules installeerd';
    $lang['firesale:install:no_route_access']               = 'FireSale heeft toegang tot system/cms/config/routes.php bestand nodig. Controlleer of het bestand beschrijfbaar is en probeer het opnieuw';
    $lang['firesale:install:old_multiple']     				= 'Uw huidig geïnstalleerde versie van het Mutli Veldtype is verouderd, verwijder of upgrade deze voordat u Firesale Installeerd';
