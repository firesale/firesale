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
    $lang['firesale:title:general'] = 'Generale';
    $lang['firesale:title:details'] = 'Tuoi dettagli';
    $lang['firesale:title:address'] = 'Tuoi indirizzi';
    $lang['firesale:title:bill']    = 'Dettagli fatturazione';
    $lang['firesale:title:ship']    = 'Dettagli spedizioni';

    // Sections
    $lang['firesale:sections:dashboard']    = 'Dashboard';
    $lang['firesale:sections:categories']   = 'Categorie';
    $lang['firesale:sections:products']     = 'Prodotti';
    $lang['firesale:sections:orders']       = 'Ordini';
    $lang['firesale:sections:addresses']    = 'Indirizzi';
    $lang['firesale:sections:orders_items'] = 'Oggetti Ordinati';
    $lang['firesale:sections:gateways']     = 'Metodi di pagamento';
    $lang['firesale:sections:settings']     = 'Impostazioni';
    $lang['firesale:sections:routes']       = 'Reindirizzamenti';
    $lang['firesale:sections:currency']     = 'Valuta';
    $lang['firesale:sections:taxes']        = 'Tasse';

    // Global Search
    $lang['firesale:product']    = 'Product'; # Translate
    $lang['firesale:products']   = 'Products'; # Translate
    $lang['firesale:category']   = 'Category'; # Translate
    $lang['firesale:categories'] = 'Categories'; # Translate

    // Tabs
    $lang['firesale:tabs:general']     = 'Opzioni generali';
    $lang['firesale:tabs:description'] = 'Descrizione';
    $lang['firesale:tabs:formatting']  = 'Farmattazione';
    $lang['firesale:tabs:shipping']    = 'Spedizione';
    $lang['firesale:tabs:metadata']    = 'Metadata';
    $lang['firesale:tabs:attributes']  = 'Attributi';
    $lang['firesale:tabs:modifiers']   = 'Opzioni prodotto';
    $lang['firesale:tabs:images']      = 'Immagini';
    $lang['firesale:tabs:assignments'] = 'Assegnamenti';

    // Shortcuts
    $lang['firesale:shortcuts:prod_create']     = 'Aggiungi Prodotto';
    $lang['firesale:shortcuts:cat_create']      = 'Aggiungi Categoria';
    $lang['firesale:shortcuts:install_gateway'] = 'Installa Gateway';
    $lang['firesale:shortcuts:create_order']    = 'Crea Ordine';
    $lang['firesale:shortcuts:create_routes']   = 'Aggiungi un nuovo Reindirizzamento';
    $lang['firesale:shortcuts:build_routes']    = 'Ricrea Reindirizzamenti';
    $lang['firesale:shortcuts:add_tax_band']    = 'Add Tax Band'; #Translate
    $lang['firesale:shortcuts:assign_taxes']    = 'Assign Taxes'; #Translate

    // Dashboard
    $lang['firesale:dash_overview']          = 'Veloce anteprima';
    $lang['firesale:dash_categorytrack']     = 'Tracciamento categoria';
    $lang['firesale:elements:product_sales'] = 'Prodotti venduti';
    $lang['firesale:elements:low_stock']     = 'Allarme scorte';
    $lang['firesale:dashboard:no_sales']     = 'Non sono state trovate vendite negli ultimi 12 mesi';
    $lang['firesale:dashboard:stock_low']    = '%s prodotti con poche scorte';
    $lang['firesale:dashboard:stock_out']    = '%s prodotti senza scorte';
    $lang['firesale:dashboard:no_stock_low'] = 'Tutti i prodotti hanno delle scorte sufficienti';
    $lang['firesale:dashboard:no_stock_out'] = 'Tutti i prodotti hanno delle scorte';
    $lang['firesale:dashboard:view_more']    = 'Vedi altro…';
    $lang['firesale:dashbord:low_stock']     = 'Poche scorte';
    $lang['firesale:dashbord:out_of_stock']  = 'Senza scorte';
    $lang['firesale:dashboard:year']         = 'Year'; # Translate
    $lang['firesale:dashboard:month']        = 'Month'; # Translate
    $lang['firesale:dashboard:week']         = 'Week'; # Translate
    $lang['firesale:dashboard:today']        = 'Today'; # Translate
    $lang['firesale:dashboard:sales_in']     = 'in %s sales'; # Translate

    // Categories
    $lang['firesale:cats_title']                         = 'Gestisci categorie';
    $lang['firesale:cats_none']                          = 'Non ci sono categoria';
    $lang['firesale:cats_new']                           = 'Aggiungi una nuova categoria';
    $lang['firesale:cats_order']                         = 'Ordina categorie';
    $lang['firesale:cats_draft_label']                   = 'Bozze';
    $lang['firesale:cats_live_label']                    = 'Pubblicate';
    $lang['firesale:cats_edit']                          = 'Modifica Categoria';
    $lang['firesale:cats_edit_title']                    = 'Modifica "%s"';
    $lang['firesale:cats_delete']                        = 'Cancella';
    $lang['firesale:cats_add_success']                   = '[PH] Categoria aggiunta con successo';
    $lang['firesale:cats_add_error']                     = '[PH] Impossibile aggiungere categoria';
    $lang['firesale:cats_edit_success']                  = 'La categoria è stata modificata con successo';
    $lang['firesale:cats_edit_error']                    = 'Si è verificato un problema nel modificare la categoria';
    $lang['firesale:cats_delete_success']                = 'Categoria cancellata con successo';
    $lang['firesale:cats_delete_error']                  = 'Impossibile cancellare la categoria';
    $lang['firesale:cats_all_products']                  = 'Tutti i prodotti';
    $lang['firesale:category:uncategorised']             = 'Senza categoria';
    $lang['firesale:category:uncategorised_slug']        = 'senza-categoria';
    $lang['firesale:category:uncategorised_description'] = 'Questa è la categoria di partenza, non può essere eliminata ma puoi rinominarla come preferisci.';

    // Products
    $lang['firesale:prod_none']              = 'Non sono stati trovati Prodotti';
    $lang['firesale:prod_create']            = 'Crea prodotto';
    $lang['firesale:prod_header']            = 'Modifica %t';
    $lang['firesale:prod_title']             = 'Gestisci Prodotti';
    $lang['firesale:prod_title_create']      = 'Crea un nuovo Prodotto';
    $lang['firesale:prod_title_edit']        = 'Modifica Prodotto';
    $lang['firesale:prod_edit_success']      = 'Prodotto modificato con successo';
    $lang['firesale:prod_edit_error']        = 'Errore nel modificare il prodotto';
    $lang['firesale:prod_add_success']       = 'Il nuovo prodotto è stato aggiunto con successo';
    $lang['firesale:prod_add_error']         = 'Si è verificato un problema nell\'aggiungere il nuovo Prodotto';
    $lang['firesale:prod_delete_error']      = 'Si è verificato un errore nel cancellare il Prodotto';
    $lang['firesale:prod_delete_success']    = 'Prodotto cancellato con successo';
    $lang['firesale:prod_duplicate_error']   = 'Si è verificato un problema nel duplicare il prodotto';
    $lang['firesale:prod_duplicate_success'] = 'Prodotto duplicato con successo';
    $lang['firesale:prod_not_found']         = 'Non è possibile trovare il prodotto specificato';
    $lang['firesale:prod_delimg_success']    = 'Immagine cancellata con successo';
    $lang['firesale:prod_delimg_error']      = 'Si è verificato un errore nel rimuovere l\'immagine selezionata';
    $lang['firesale:prod_button_quick_edit'] = 'Modifica Veloce';

    // Product Modifiers & Variations
    $lang['firesale:mods:title']          = 'Opzioni prodotto';
    $lang['firesale:mods:create_success'] = 'Nuova opzione creata con successo';
    $lang['firesale:mods:edit_success']   = 'Opzione modificata con successo';
    $lang['firesale:mods:delete_success'] = 'Opzione cancellata con successo';
    $lang['firesale:mods:create_error']   = 'Si è verificato un errore nel creare l\'opzione';
    $lang['firesale:mods:edit_error']     = 'Si è verificato un errore nel modificare l\'opzione';
    $lang['firesale:mods:delete_error']   = 'Si è verificato un errore nel cancellare l\'opzione';
    $lang['firesale:mods:create']         = 'Aggiungi opzione';
    $lang['firesale:mods:edit']           = 'Modifica variante';
    $lang['firesale:mods:none']           = 'Non sono state trovate opzioni per il prodotto.';
    $lang['firesale:mods:nothere']        = 'Non puoi aggiungere una opzione alla variante';
    $lang['firesale:vars:title']          = 'Varianti';
    $lang['firesale:vars:show_set']       = 'Mostra Varianti';
    $lang['firesale:vars:show_inst']      = 'Do you want to show variations on listings and search results?'; # translate
    $lang['firesale:vars:create_success'] = 'Nuova variante creata con successo';
    $lang['firesale:vars:edit_success']   = 'Variazione modificata con successo';
    $lang['firesale:vars:delete_success'] = 'Variazione cancellata con successo';
    $lang['firesale:vars:create_error']   = 'Si è verificato un errore nel creare la variazione';
    $lang['firesale:vars:edit_error']     = 'Si è verificato un errore nel modificare la variazione';
    $lang['firesale:vars:delete_error']   = 'Si è verificato un errore nel cancelalre la variazione';
    $lang['firesale:vars:none']           = 'Non ci sono varianti';
    $lang['firesale:vars:create']         = 'Aggiungi variante';
    $lang['firesale:vars:stock_low']      = 'Not enough stock of %s to buy this item'; # translate
    $lang['firesale:vars:category']       = 'Build from Category'; # translate

    // New Products
    $lang['firesale:new:title']    = 'New Products'; # translate
    $lang['firesale:new:in:title'] = 'New Products in %s'; # translate

    // Instructions
    $lang['firesale:inst_rrp']   = 'Prezzo di vendita prima e dopo le tasse';
    $lang['firesale:inst_price'] = 'Prezzo di vendita corrente prima e dopo le tasse (Se è più basso del prezzo di vendita utilizzare il campo come prezzo del prodotto)';

    // Labels
    $lang['firesale:label_draft']          = 'Bozza';
    $lang['firesale:label_live']           = 'Pubblicati';
    $lang['firesale:label_id']             = 'Codice prodotto';
    $lang['firesale:label_title']          = 'Titolo';
    $lang['firesale:label_slug']           = 'Link';
    $lang['firesale:label_status']         = 'Stato';
    $lang['firesale:label_type']           = 'Tipo';
    $lang['firesale:label_description']    = 'Descrizione';
    $lang['firesale:label_inst']           = 'Istruzioni';
    $lang['firesale:label_category']       = 'Categoria';
    $lang['firesale:label_parent']         = 'Categoria padre';
    $lang['firesale:label_options']        = 'Opzioni';
    $lang['firesale:label_filtercat']      = 'Filtra per categoria';
    $lang['firesale:label_filtersel']      = 'Seleziona una categoria';
    $lang['firesale:label_filterprod']     = 'Seleziona un prodotto';
    $lang['firesale:label_filterstatus']   = 'Seleziona lo stato di un prodotto';
    $lang['firesale:label_filtersstatus']  = 'Seleziona uno stato di scorte';
    $lang['firesale:label_order_status']   = 'Seleziona uno stato di Ordine';
    $lang['firesale:label_rrp']            = 'Prezzo di vendita raccomandato';
    $lang['firesale:label_rrp_tax']        = 'Prezzo di vendita raccomandato (tasse escluse)';
    $lang['firesale:label_rrp_short']      = 'RRP';
    $lang['firesale:label_price']          = 'Prezzo di vendita';
    $lang['firesale:label_price_tax']      = 'Prezzo di vendita (tasse escluse)';
    $lang['firesale:label_stock']          = 'Quantità in magazzino';
    $lang['firesale:label_drop_images']    = 'Trascina qui le immagini da caricare';
    $lang['firesale:label_duplicate']      = 'Duplica';
    $lang['firesale:label_showfilter']     = 'Mostra filtri';
    $lang['firesale:label_mod_variant']    = 'Variante';
    $lang['firesale:label_mod_input']      = 'Input';
    $lang['firesale:label_mod_single']     = 'Singolo Prodotto';
    $lang['firesale:label_mod_price']      = 'Incremento prezzo di';
    $lang['firesale:label_mod_price_inst'] = 'Alcune istruzioni';

    $lang['firesale:label_stock_short']     = 'Livello scorte';
    $lang['firesale:label_stock_status']    = 'Stato delle scorte';
    $lang['firesale:label_stock_in']        = 'Disponibili';
    $lang['firesale:label_stock_low']       = 'Pochi pezzi';
    $lang['firesale:label_stock_out']       = 'Finito';
    $lang['firesale:label_stock_order']     = 'Scorte in ordine';
    $lang['firesale:label_stock_ended']     = 'Discontinuo';
    $lang['firesale:label_stock_unlimited'] = 'Senza limiti';

    $lang['firesale:label_remove']        = 'Rimuovi';
    $lang['firesale:label_image']         = 'Immagine';
    $lang['firesale:label_images']        = 'Immagini';
    $lang['firesale:label_order']         = 'Ordini';
    $lang['firesale:label_gateway']       = 'Metodi di pagamento';
    $lang['firesale:label_shipping']      = 'Metodi di spedizione';
    $lang['firesale:label_quantity']      = 'Quantità';
    $lang['firesale:label_price_total']   = 'Prezzo totale';
    $lang['firesale:label_price_ship']    = 'Costi di spedizione';
    $lang['firesale:label_price_sub']     = 'Sub-totale';
    $lang['firesale:label_ship_to']       = 'Spedito a';
    $lang['firesale:label_bill_to']       = 'Fatturato a';
    $lang['firesale:label_date']          = 'Data';
    $lang['firesale:label_product']       = 'Prodotto';
    $lang['firesale:label_products']      = 'Prodotto';
    $lang['firesale:label_company']       = 'Società';
    $lang['firesale:label_firstname']     = 'Nome';
    $lang['firesale:label_lastname']      = 'Cognome';
    $lang['firesale:label_phone']         = 'Telefono';
    $lang['firesale:label_email']         = 'Indirizzo email';
    $lang['firesale:label_address1']      = 'Indirizzo 1';
    $lang['firesale:label_address2']      = 'Indirizzo 2';
    $lang['firesale:label_city']          = 'Città';
    $lang['firesale:label_postcode']      = 'C.A.P.';
    $lang['firesale:label_county']        = 'Provincia';
    $lang['firesale:label_country']       = 'Stato';
    $lang['firesale:label_details']       = 'L\'indirizzo di fatturazione e di spedizione coincidono.';
    $lang['firesale:label_user_order']    = 'Utente';
    $lang['firesale:label_ip']            = 'Indirizzo IP';
    $lang['firesale:label_ship_req']      = 'Richiede spedizione';
    $lang['firesale:label_address_title'] = 'Save Address as'; # Translate

    $lang['firesale:label_nameaz']     = 'Nome A - Z';
    $lang['firesale:label_nameza']     = 'Nome Z - A';
    $lang['firesale:label_pricelow']   = 'Prezzo Basso &gt; Alto';
    $lang['firesale:label_pricehigh']  = 'Prezzo Alto &gt; Basso';
    $lang['firesale:label_modelaz']    = 'Modello A - Z';
    $lang['firesale:label_modelza']    = 'Modello Z - A';
    $lang['firesale:label_creatednew'] = 'Newest - Oldest'; # translate
    $lang['firesale:label_createdold'] = 'Oldest - Newest'; # translate

    $lang['firesale:label_time_now']   = 'meno di un minuto fa.';
    $lang['firesale:label_time_min']   = 'circa un minuto fa.';
    $lang['firesale:label_time_mins']  = 'circa %s minuti fa.';
    $lang['firesale:label_time_hour']  = 'circa 1 ora fa.';
    $lang['firesale:label_time_hours'] = 'circa %s ore fa.';
    $lang['firesale:label_time_day']   = '1 giorno da.';
    $lang['firesale:label_time_days']  = '%s giorni fa.';

    $lang['firesale:label_map']         = 'Mappa';
    $lang['firesale:label_route']       = 'Reindirizzamento';
    $lang['firesale:label_translation'] = 'Traduzione';
    $lang['firesale:label_table']       = 'Tabella';
    $lang['firesale:label_https']       = 'HTTPS'; # translate
    $lang['firesale:label_use_https']   = 'Enable HTTPS'; # translate

    $lang['firesale:label_cur_code']        = 'Codice Valuta';
    $lang['firesale:label_cur_code_inst']   = 'Formato ISO-4217';
    $lang['firesale:label_cur_tax']         = 'Tax Rate'; # translate
    $lang['firesale:label_cur_mod']         = 'Modificatore di valuta';
    $lang['firesale:label_cur_mod_inst']    = 'You may wish to modify the exchange rate slightly to cover additional costs associated with this region'; # translate
    $lang['firesale:label_exch_rate']       = 'Exchange Rate'; # translate
    $lang['firesale:label_exch_rate_inst']  = 'Questo sarà automaticamente aggiornato ogni ora, se lasciato bianco sarò aggiornato al momento del salvataggio';
    $lang['firesale:label_cur_flag']        = 'Related Image'; # translate
    $lang['firesale:label_enabled']         = 'Abilita';
    $lang['firesale:label_disabled']        = 'Disabilita';
    $lang['firesale:label_cur_format']      = 'Formato Valuta';
    $lang['firesale:label_cur_format_inst'] = 'Formattazione numerica che include il simbolo di valuta con "{{ price }}" che verrà sostituito dal prezzo da mostrare, es: £{{ price }}';
    $lang['firesale:label_cur_format_dec']  = 'Simbolo per i decimali';
    $lang['firesale:label_cur_format_sep']  = 'Simbolo separazione migliaia';
    $lang['firesale:label_cur_format_num']  = 'Formattazione numerica';

    $lang['firesale:label_tax_band'] = 'Tax Band';

    // Orders
    $lang['firesale:orders:title']                 = 'Ordini';
    $lang['firesale:orders:no_orders']             = 'NOn ci sono ordini al momento';
    $lang['firesale:orders:my_orders']             = 'Miei ordini';
    $lang['firesale:orders:view_order']            = 'Vedi ordine #%s';
    $lang['firesale:orders:title_create']          = 'Crea ordine';
    $lang['firesale:orders:title_edit']            = 'Modifica ordine #%s';
    $lang['firesale:orders:delete_success']        = 'Ordine cancellato con successo';
    $lang['firesale:orders:delete_error']          = 'Non è stato possibile cancellare l\'ordine a causa di un errore';
    $lang['firesale:orders:save_first']            = 'Devi salvare l\'ordine prima di aggiungere prodotti';
    $lang['firesale:orders:delete']                = 'Cancella ordini';
    $lang['firesale:orders:mark_as']               = 'Marca come ';
    $lang['firesale:orders:status_unpaid']         = 'Non pagato';
    $lang['firesale:orders:status_paid']           = 'Pagato';
    $lang['firesale:orders:status_dispatched']     = 'Dispatched';
    $lang['firesale:orders:status_processing']     = 'Processando';
    $lang['firesale:orders:status_refunded']       = 'Rimborsato';
    $lang['firesale:orders:status_cancelled']      = 'Cancelalto';
    $lang['firesale:orders:status_failed']         = 'Fallito';
    $lang['firesale:orders:status_declined']       = 'Rifiutato';
    $lang['firesale:orders:status_mismatch']       = 'Non combacia';
    $lang['firesale:orders:status_prefunded']      = 'Partially Refunded'; # Translate
    $lang['firesale:orders:failed_message']        = 'Si è verificato un errore nel processare il pagamento';
    $lang['firesale:orders:declined_message']      = 'Il tuo pagamento è stato rifiutato, per favore riprova.';
    $lang['firesale:orders:mismatch_message']      = 'Il pagamento non corrisponde all\'ordine.';
    $lang['firesale:orders:logged_in']             = 'Devi effettuare il login per vedere i tuoi ordini passati.';
    $lang['firesale:orders:label_view_order']      = 'Vedi ordine';
    $lang['firesale:orders:label_products']        = 'Prodotti';
    $lang['firesale:orders:label_view_order']      = 'Vedi ordine';
    $lang['firesale:orders:label_customer']        = 'Cliente';
    $lang['firesale:orders:label_date_placed']     = 'Data acquisto';
    $lang['firesale:orders:label_order_id']        = "ID ordine";
    $lang['firesale:orders:labe_shipping_address'] = 'Indirizzo di spedizione';
    $lang['firesale:orders:labe_payment_address']  = 'Indirizzo di fatturazione';
    $lang['firesale:orders:label_order_status']    = 'Stato dell\'ordine';
    $lang['firesale:orders:label_message']         = 'Messaggio';

    // Gateways
    $lang['firesale:gateways:admin_title']             = 'Metodi di pagamento';
    $lang['firesale:gateways:install_title']           = 'Installa un metodo di pagamento';
    $lang['firesale:gateways:edit_title']              = 'Modifica metodi di pagamento';
    $lang['firesale:gateways:installed_title']         = 'Metodi di pagamento installati';
    $lang['firesale:gateways:no_gateways']             = 'Attualmente non ci sono metodi di pagamento installati.';
    $lang['firesale:gateways:no_uninstalled_gateways'] = 'Tutti i metodi di pagamento disponibili sono attualmente installati.';
    $lang['firesale:gateways:errors:invalid_bool']     = 'The %s field must be a boolean value.';
    $lang['firesale:gateways:warning']                 = 'Tutte le impostazioni del pagamento andranno perse e il negozio potrebbe non essere più in grado di ricevere i pagamenti! Sicuro di voler rimuovere questo tipo di pagamento?';
    $lang['firesale:gateways:multiple_warning']        = 'Tutte le impostazioni dei pagamenti andranno perse e il negozio potrebbe non essere più in grado di ricevere i pagamenti! Sicuro di voler rimuovere questi tipi di pagamento?';

    $lang['firesale:gateways:installed_success'] = 'Metodo di Pagamento installato con successo';
    $lang['firesale:gateways:installed_fail']    = 'Il Metodo di Pagamento non può essere installato';

    $lang['firesale:gateways:uninstalled_success']          = 'Metodo di Pagamento disinstallato con successo';
    $lang['firesale:gateways:uninstalled_fail']             = 'Il Metodo di Pagamento non può essere disinstallato';
    $lang['firesale:gateways:multiple_uninstalled_success'] = 'Il Metodo di Pagamento selezionato è stato disinstallato con successo';
    $lang['firesale:gateways:multiple_uninstalled_fail']    = 'Il Metodo di Pagamento selezionato non è stato disinstallato';

    $lang['firesale:gateways:multiple_enabled_success'] = 'Il Metodo di Pagamento selezionato è stato abilitato';
    $lang['firesale:gateways:multiple_enabled_fail']    = 'Il Metodo di Pagamento selezionato non può essere abilitato';
    $lang['firesale:gateways:enabled_success']          = 'Il Metodo di Pagamento è stato abilitato';
    $lang['firesale:gateways:enabled_fail']             = 'Il Metodo di Pagamento non è stato abilitato';

    $lang['firesale:gateways:disabled_success']          = 'Il Metodo di Pagamento è stato disabilitato';
    $lang['firesale:gateways:disabled_fail']             = 'Il Metodo di Pagamento non può essere disabilitato';
    $lang['firesale:gateways:multiple_disabled_success'] = 'Il Metodo di Pagamento selezionato è stato disabilitato con successo';
    $lang['firesale:gateways:multiple_disabled_fail']    = 'Il Metodo di Pagamento selezionato non può essere disabilitato';

    $lang['firesale:gateways:updated_success'] = 'Metodo di Pagamento aggiornato con successo';
    $lang['firesale:gateways:updated_fail']    = 'Il Metodo di Pagamento non può essere aggiornato';

    // Checkout
    $lang['firesale:gateways:labels:name']            = 'Nome';
    $lang['firesale:gateways:labels:desc']            = 'Descrizione';
    $lang['firesale:cart:title']                      = 'Carrello';
    $lang['firesale:cart:empty']                      = 'Non ci sono oggetti nel tuo carrello';
    $lang['firesale:cart:login_required']             = 'Devi effettuare il login prima di procedere';
    $lang['firesale:cart:qty_too_low']                = 'Non abbiamo sufficienti scorte per soddisfare la tua richiesta';
    $lang['firesale:cart:price_changed']              = 'The price of some items in your cart has changed, please check them before continuing'; # Translate
    $lang['firesale:checkout:title']                  = 'Pagamento';
    $lang['firesale:checkout:error_callback']         = 'Sembra esserci un problema con il tuo ordine, prova ancora, possibilmente utilizza un altro metodo di pagamento.';
    $lang['firesale:payment:title']                   = 'Conferma dettagli';
    $lang['firesale:payment:title_success']           = 'Pagamento completato';
    $lang['firesale:checkout:title:ship_method']      = 'Modalità di spedizione';
    $lang['firesale:checkout:title:payment_method']   = 'Metodo di pagamento';
    $lang['firesale:checkout:next']                   = 'Avanti';
    $lang['firesale:checkout:previous']               = 'Indietro';
    $lang['firesale:checkout:select_shipping_method'] = 'Per favore seleziona il metodo di spedizione che preferisci prima di proseguire';
    $lang['firesale:checkout:select_payment_method']  = 'Per favore seleziona il metodo di pagamento che preferisci prima di proseguire';
    $lang['firesale:checkout:submit_and_pay']         = 'Conferma e Paga';
    $lang['firesale:checkout:shipping_min_price']     = 'The total value of your cart items does not meet the minimum for the selected shipping method';#Translate
    $lang['firesale:checkout:shipping_max_price']     = 'The total value of your cart items exceeds the maximum for the selected shipping method';#Translate
    $lang['firesale:checkout:shipping_min_weight']    = 'The total weight of your cart items does not meet the minimum for the selected shipping method';#Translate
    $lang['firesale:checkout:shipping_max_weight']    = 'The total weight of your cart items exceeds the maximum for the selected shipping method';#Translate
    $lang['firesale:checkout:shipping_invalid']       = 'The shipping method you selected is not valid';#Translate
    $lang['firesale:checkout:gateway_invalid']        = 'The payment gateway you selected is not valid';#Translate

    // Routes
    $lang['firesale:routes:title']          = 'Reindirizzamenti';
    $lang['firesale:routes:new']            = 'Aggiungi un nuovo reindirizzamento';
    $lang['firesale:routes:add_success']    = 'Nuovo reindirizzamento aggiunto con successo';
    $lang['firesale:routes:add_error']      = 'Si è verificato un errore nell\'aggiungere il Reindirizzamento';
    $lang['firesale:routes:edit']           = 'Modifica Reindirizzamento %s';
    $lang['firesale:routes:edit_success']   = 'Reindirizzamento modificato con successo';
    $lang['firesale:routes:edit_error']     = 'Si è verificato un errore nel modificare il Reindirizzamento';
    $lang['firesale:routes:not_found']      = 'Il Reindirizzamento selezionato non è stato trovato';
    $lang['firesale:routes:none']           = 'Non sono stati trovati Reindirizzamenti';
    $lang['firesale:routes:delete_success'] = 'Reindirizzamento rimosso con successo';
    $lang['firesale:routes:delete_error']   = 'Si è verificato un errore nel rimuovere il Reindirizzamento';
    $lang['firesale:routes:build_success']  = 'Il file dei Reindirizzamenti è stato ricorstruito con successo';
    $lang['firesale:routes:build_error']    = 'Si è verificato un errore nel ricostruire il file dei Reindirizzamenti';
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
    $lang['firesale:shortcuts:install_currency'] = 'Installa nuova Valuta';
    $lang['firesale:currency:enable']            = 'Abilita';
    $lang['firesale:currency:disable']           = 'Disabilita';
    $lang['firesale:currency:disable_warn']      = 'La disabilitazione potrebbe provocare problemi ai clienti e agli ordini già effettuati';
    $lang['firesale:currency:delete']            = 'Cancella';
    $lang['firesale:currency:delete_warn']       = 'La cancellazione potrebbe provocare problemi ai clienti e agli ordini già effettuati';
    $lang['firesale:currency:create']            = 'Crea una nuova Valuta';
    $lang['firesale:currency:edit']              = 'Modifica Valuta';
    $lang['firesale:currency:not_found']         = 'La valuta selezionata non è stata trovata';
    $lang['firesale:currency:add_success']       = 'La nuova Valuta è stata aggiunta con successo';
    $lang['firesale:currency:add_error']         = 'Si è verificato un errore nell\'aggiungere la nuova Valuta';
    $lang['firesale:currency:edit_success']      = 'Valuta aggiornata correttamente';
    $lang['firesale:currency:edit_error']        = 'Si è verificato un errore nell\'aggiornare la nuova Valuta';
    $lang['firesale:currency:delete_success']    = 'La valuta è stata cancellata con successo';
    $lang['firesale:currency:delete_error']      = 'Si è verificato un errore nel cancellare la valuta';
    $lang['firesale:currency:format_none']       = 'Nessuno';
    $lang['firesale:currency:format_00']         = 'Arrotonda al numero intero più vicino';
    $lang['firesale:currency:format_50']         = 'Arrotonda al più vicino .50';
    $lang['firesale:currency:format_99']         = 'Arrotonda al più vicino .99';

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
    $lang['firesale:addresses:title']        = 'Miei indirizzi';
    $lang['firesale:addresses:edit_address'] = 'Modifica indirizzo';
    $lang['firesale:addresses:new_address']  = 'Crea un nuovo indirizzo';
    $lang['firesale:addresses:save']         = 'Salva';
    $lang['firesale:addresses:cancel']       = 'Annulla';
    $lang['firesale:addresses:no_user']      = 'Devi effettuare il login per gestire l\'elenco dei tuooi indirizzi';
    $lang['firesale:addresses:add_success']  = 'Indirizzo creato con successo';
    $lang['firesale:addresses:add_error']    = 'Si è verificato un errore nel creare l\'indirizzo';
    $lang['firesale:addresses:edit_success'] = 'Indirizzo modificato con successo';
    $lang['firesale:addresses:edit_error']   = 'Si è verificato un errore nel modficare l\'indirizzo';

    // Products Frontend
    $lang['firesale:product:label_availability'] = "Disponibilità:";
    $lang['firesale:product:label_model']        = "Modello:";
    $lang['firesale:product:label_product_code'] = "Codice prodotto:";
    $lang['firesale:product:label_qty']          = "Quantità:";
    $lang['firesale:product:label_add_to_cart']  = "Aggiungi al Carrello";

    // Cart Frontend
    $lang['firesale:cart:label_remove']           = "Rimuovi";
    $lang['firesale:cart:label_image']            = "Immagine";
    $lang['firesale:cart:label_name']             = "Nome";
    $lang['firesale:cart:label_model']            = "Modello";
    $lang['firesale:cart:label_quantity']         = "Quantità";
    $lang['firesale:cart:label_unit_price']       = "Prezzo unitario";
    $lang['firesale:cart:label_total']            = "Totale";
    $lang['firesale:cart:label_no_items_in_cart'] = "Non ci sono prodotti nel carrello";
    $lang['firesale:cart:button_update']          = "Aggiorna carrello";
    $lang['firesale:cart:button_goto_checkout']   = "Vai al pagamento";
    $lang['firesale:cart:label_sub_total']        = "Sub-Totale";
    $lang['firesale:cart:label_tax']              = "Tasse";
    $lang['firesale:cart:label_total']            = "Totale";

    //Categories Frontend
    $lang['firesale:categories:grid']          = 'Griglia';
    $lang['firesale:categories:list']          = 'Lista';
    $lang['firesale:categories:add_to_basket'] = 'Aggiungi al carrello';

    //Payment Frontend
    $lang['firesale:payment:cancelled']     = 'Ordine cancellato';
    $lang['firesale:payment:wait_redirect'] = 'Per favore attendi il reindirizzamento alla pagina dei pagamenti...';
    $lang['firesale:payment:btn_continue']  = 'Continua';

    // Settings
    $lang['firesale:settings_tax']                   = 'Percentuale tasse';
    $lang['firesale:settings_tax_inst']              = 'La percentuale di tasse che verrà applicata ai prodotti';
    $lang['firesale:settings_currency']              = 'Codice della Valuta principale';
    $lang['firesale:settings_currency_inst']         = 'La valuta deve rispettare il formato (ISO-4217)';
    $lang['firesale:settings_currency_key']          = 'Valuta API Key';
    $lang['firesale:settings_currency_key_inst']     = 'API Key da <a target="_blank" href="https://openexchangerates.org/signup/free">Tassi di cambio aperti</a>';
    $lang['firesale:settings_current_currency']      = 'Valuta corrente';
    $lang['firesale:settings_current_currency_inst'] = 'The current currency in use, used to update existing values if default currency is changed'; # translate
    $lang['firesale:settings_currency_updated']      = 'Currency last update time'; # translate
    $lang['firesale:settings_currency_updated_inst'] = 'The last time the currency was updated, api is updated every hour and to keep to rate limits we only check after that'; # translate
    $lang['firesale:settings_perpage']               = 'Prodotti per pagina';
    $lang['firesale:settings_perpage_inst']          = 'Numero di prodotti da mostrare nella pagina della categoria e della ricerca';
    $lang['firesale:settings_image_square']          = 'Rendi le immagini quadrate';
    $lang['firesale:settings_image_square_inst']     = 'Alcuni temi richiedono le immagini quadrate per mantenere un layout consistente';
    $lang['firesale:settings_image_background']      = 'Colore di sfondo Immagine';
    $lang['firesale:settings_image_background_inst'] = 'Colore esadecimale (senza #) per il background delle immagini ridimensionate';
    $lang['firesale:settings_login']                 = 'Per l\'acquisto è richiesto il login';
    $lang['firesale:settings_login_inst']            = 'Assicurarsi che l\'utente sia loggato prima di permettere l\'acquisto dei prodotti';
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
    $lang['firesale:install:wrong_version']    = 'Non è possibile installare il modulo FireSale, FireSale richiede PyroCMS v2.1.4 o superiore';
    $lang['firesale:install:missing_multiple'] = 'FireSale richiede Multiple Relationships field type per funzionare. Puoi scaricarlo da <a target="_blank" href="https://github.com/adamfairholm/PyroStreams-Multiple-Relationships/zipball/2.0/develop">qui</a>';
    $lang['firesale:install:not_installed']    = 'Per favore installa prima il modulo FireSale e poi i suoi addons';
    $lang['firesale:install:no_route_access']  = 'FireSale richiede l\'accesso al file system/cms/config/routes.php. Per favore imposta i permessi appropriati e riprova';
    $lang['firesale:install:old_multiple']     = 'Your currently installed version of the Multiple field type is out of date, please delete or upgrade it before attempting to use FireSale'; # Translate
