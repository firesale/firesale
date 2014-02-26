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
* @version dev
* @link http://github.com/firesale/firesale
*
*/

    // General Titles
    $lang['firesale:title']                                 = 'FireSale';
    $lang['firesale:store']                                 = 'Negozio';
    $lang['firesale:title:general']                         = 'Generale';
    $lang['firesale:title:details']                         = 'Tuoi dettagli';
    $lang['firesale:title:address']                         = 'Tuoi indirizzi';
    $lang['firesale:title:bill']                            = 'Dettagli fatturazione';
    $lang['firesale:title:ship']                            = 'Dettagli spedizioni';

    // Sections
    $lang['firesale:sections:dashboard']                    = 'Dashboard';
    $lang['firesale:sections:categories']                   = 'Categorie';
    $lang['firesale:sections:products']                     = 'Prodotti';
    $lang['firesale:sections:orders']                       = 'Ordini';
    $lang['firesale:sections:addresses']                    = 'Indirizzi';
    $lang['firesale:sections:orders_items']                 = 'Prodotti in ordine';
    $lang['firesale:sections:gateways']                     = 'Metodi di pagamento';
    $lang['firesale:sections:settings']                     = 'Impostazioni';
    $lang['firesale:sections:routes']                       = 'Reindirizzamenti';
    $lang['firesale:sections:currency']                     = 'Valuta';
    $lang['firesale:sections:taxes']                        = 'Tasse';
    $lang['firesale:sections:customers']                    = 'Clienti';

    // Global Search
    $lang['firesale:search']                                = 'Trova';
    $lang['firesale:product']                               = 'Prodotto';
    $lang['firesale:products']                              = 'Prodotti';
    $lang['firesale:category']                              = 'Categoria';
    $lang['firesale:categories']                            = 'Categorie';

    // Tabs
    $lang['firesale:tabs:general']                          = 'Opzioni generali';
    $lang['firesale:tabs:description']                      = 'Descrizione';
    $lang['firesale:tabs:formatting']                       = 'Farmattazione';
    $lang['firesale:tabs:shipping']                         = 'Spedizione';
    $lang['firesale:tabs:metadata']                         = 'Metadata';
    $lang['firesale:tabs:attributes']                       = 'Attributi';
    $lang['firesale:tabs:modifiers']                        = 'Opzioni prodotto';
    $lang['firesale:tabs:images']                           = 'Immagini';
    $lang['firesale:tabs:assignments']                      = 'Assegnamenti';

    // Shortcuts
    $lang['firesale:shortcuts:prod_create']                 = 'Aggiungi Prodotto';
    $lang['firesale:shortcuts:cat_create']                  = 'Aggiungi Categoria';
    $lang['firesale:shortcuts:install_gateway']             = 'Installa Gateway';
    $lang['firesale:shortcuts:create_order']                = 'Crea Ordine';
    $lang['firesale:shortcuts:create_routes']               = 'Aggiungi un nuovo Reindirizzamento';
    $lang['firesale:shortcuts:build_routes']                = 'Ricrea Reindirizzamenti';
    $lang['firesale:shortcuts:add_tax_band']                = 'Aggiungi scaglione di imposta';
    $lang['firesale:shortcuts:assign_taxes']                = 'Assegna tasse';

    // Dashboard
    $lang['firesale:dash_overview']                         = 'Veloce anteprima';
    $lang['firesale:dash_categorytrack']                    = 'Tracciamento categoria';
    $lang['firesale:elements:product_sales']                = 'Prodotti venduti';
    $lang['firesale:elements:low_stock']                    = 'Allarme scorte';
    $lang['firesale:dashboard:no_sales']                    = 'Non sono state trovate vendite negli ultimi 12 mesi';
    $lang['firesale:dashboard:stock_low']                   = '%s prodotti con poche scorte';
    $lang['firesale:dashboard:stock_out']                   = '%s prodotti senza scorte';
    $lang['firesale:dashboard:no_stock_low']                = 'Tutti i prodotti hanno delle scorte sufficienti';
    $lang['firesale:dashboard:no_stock_out']                = 'Tutti i prodotti hanno delle scorte';
    $lang['firesale:dashboard:view_more']                   = 'Vedi altro…';
    $lang['firesale:dashbord:low_stock']                    = 'Poche scorte';
    $lang['firesale:dashbord:out_of_stock']                 = 'Senza scorte';
    $lang['firesale:dashboard:year']                        = 'Anno';
    $lang['firesale:dashboard:month']                       = 'Mese';
    $lang['firesale:dashboard:week']                        = 'Settimana';
    $lang['firesale:dashboard:today']                       = 'Oggi';
    $lang['firesale:dashboard:sales_in']                    = 'in %s sales'; # Translate

    // Categories
    $lang['firesale:cats_title']                            = 'Gestisci categorie';
    $lang['firesale:cats_none']                             = 'Non ci sono categoria';
    $lang['firesale:cats_new']                              = 'Aggiungi una nuova categoria';
    $lang['firesale:cats_order']                            = 'Ordina categorie';
    $lang['firesale:cats_draft_label']                      = 'Bozze';
    $lang['firesale:cats_live_label']                       = 'Pubblicate';
    $lang['firesale:cats_edit']                             = 'Modifica Categoria';
    $lang['firesale:cats_edit_title']                       = 'Modifica "%s"';
    $lang['firesale:cats_delete']                           = 'Cancella';
    $lang['firesale:cats_add_success']                      = '[PH] Categoria aggiunta con successo';
    $lang['firesale:cats_add_error']                        = '[PH] Impossibile aggiungere categoria';
    $lang['firesale:cats_edit_success']                     = 'La categoria è stata modificata con successo';
    $lang['firesale:cats_edit_error']                       = 'Si è verificato un problema nel modificare la categoria';
    $lang['firesale:cats_delete_success']                   = 'Categoria cancellata con successo';
    $lang['firesale:cats_delete_error']                     = 'Impossibile cancellare la categoria';
    $lang['firesale:cats_all_products']                     = 'Tutti i prodotti';
    $lang['firesale:category:uncategorised']                = 'Senza categoria';
    $lang['firesale:category:uncategorised_slug']           = 'senza-categoria';
    $lang['firesale:category:uncategorised_description']    = 'Questa è la categoria di partenza, non può essere eliminata ma puoi rinominarla come preferisci.';

    // Products
    $lang['firesale:prod_none']                             = 'Non sono stati trovati Prodotti';
    $lang['firesale:prod_create']                           = 'Crea prodotto';
    $lang['firesale:prod_header']                           = 'Modifica %t';
    $lang['firesale:prod_title']                            = 'Gestisci Prodotti';
    $lang['firesale:prod_title_create']                     = 'Crea un nuovo Prodotto';
    $lang['firesale:prod_title_edit']                       = 'Modifica Prodotto';
    $lang['firesale:prod_edit_success']                     = 'Prodotto modificato con successo';
    $lang['firesale:prod_edit_error']                       = 'Errore nel modificare il prodotto';
    $lang['firesale:prod_add_success']                      = 'Il nuovo prodotto è stato aggiunto con successo';
    $lang['firesale:prod_add_error']                        = 'Si è verificato un problema nell\'aggiungere il nuovo Prodotto';
    $lang['firesale:prod_delete_error']                     = 'Si è verificato un errore nel cancellare il Prodotto';
    $lang['firesale:prod_delete_success']                   = 'Prodotto cancellato con successo';
    $lang['firesale:prod_duplicate_error']                  = 'Si è verificato un problema nel duplicare il prodotto';
    $lang['firesale:prod_duplicate_success']                = 'Prodotto duplicato con successo';
    $lang['firesale:prod_not_found']                        = 'Non è possibile trovare il prodotto specificato';
    $lang['firesale:prod_delimg_success']                   = 'Immagine cancellata con successo';
    $lang['firesale:prod_delimg_error']                     = 'Si è verificato un errore nel rimuovere l\'immagine selezionata';
    $lang['firesale:prod_button_quick_edit']                = 'Modifica Veloce';

    // Product Modifiers & Variations
    $lang['firesale:mods:title']                            = 'Opzioni prodotto';
    $lang['firesale:mods:create_success']                   = 'Nuova opzione creata con successo';
    $lang['firesale:mods:edit_success']                     = 'Opzione modificata con successo';
    $lang['firesale:mods:delete_success']                   = 'Opzione cancellata con successo';
    $lang['firesale:mods:create_error']                     = 'Si è verificato un errore nel creare l\'opzione';
    $lang['firesale:mods:edit_error']                       = 'Si è verificato un errore nel modificare l\'opzione';
    $lang['firesale:mods:delete_error']                     = 'Si è verificato un errore nel cancellare l\'opzione';
    $lang['firesale:mods:create']                           = 'Aggiungi opzione';
    $lang['firesale:mods:edit']                             = 'Modifica variante';
    $lang['firesale:mods:none']                             = 'Non sono state trovate opzioni per il prodotto.';
    $lang['firesale:mods:nothere']                          = 'Non puoi aggiungere una opzione alla variante';
    $lang['firesale:vars:title']                            = 'Varianti';
    $lang['firesale:vars:show_set']                         = 'Mostra Varianti';
    $lang['firesale:vars:show_inst']                        = 'Vuoi mostrare le variazioni negli elenchi e nei risultati di ricerca?';
    $lang['firesale:vars:create_success']                   = 'Nuova variante creata con successo';
    $lang['firesale:vars:edit_success']                     = 'Variazione modificata con successo';
    $lang['firesale:vars:delete_success']                   = 'Variazione cancellata con successo';
    $lang['firesale:vars:create_error']                     = 'Si è verificato un errore nel creare la variazione';
    $lang['firesale:vars:edit_error']                       = 'Si è verificato un errore nel modificare la variazione';
    $lang['firesale:vars:delete_error']                     = 'Si è verificato un errore nel cancelalre la variazione';
    $lang['firesale:vars:none']                             = 'Non ci sono varianti';
    $lang['firesale:vars:create']                           = 'Aggiungi variante';
    $lang['firesale:vars:stock_low']                        = 'La quantitá a magazzino di %s non é sufficiente per acquistarlo';
    $lang['firesale:vars:category']                         = 'Build from Category'; # translate

    // New Products
    $lang['firesale:new:title']                             = 'Nuovi prodotti';
    $lang['firesale:new:in:title']                          = 'Nuovi prodotti in %s';

    // Customers
    $lang['firesale:cust:title']                            = 'Clienti';
    $lang['firesale:cust:all:title']                        = 'Tutti i clienti';
    $lang['firesale:cust:char:title']                       = 'Cognomi che iniziano con "%s"';

    // Instructions
    $lang['firesale:inst_rrp']                              = 'Prezzo di vendita prima e dopo le tasse';
    $lang['firesale:inst_price']                            = 'Prezzo di vendita corrente prima e dopo le tasse (Se è più basso del prezzo di vendita utilizzare il campo come prezzo del prodotto)';

    // Labels
    $lang['firesale:label_draft']                           = 'Bozza';
    $lang['firesale:label_live']                            = 'Pubblicati';
    $lang['firesale:label_id']                              = 'Codice prodotto';
    $lang['firesale:label_title']                           = 'Titolo';
    $lang['firesale:label_slug']                            = 'Link';
    $lang['firesale:label_status']                          = 'Stato';
    $lang['firesale:label_type']                            = 'Tipo';
    $lang['firesale:label_description']                     = 'Descrizione';
    $lang['firesale:label_inst']                            = 'Istruzioni';
    $lang['firesale:label_category']                        = 'Categoria';
    $lang['firesale:label_parent']                          = 'Categoria padre';
    $lang['firesale:label_options']                         = 'Opzioni';
    $lang['firesale:label_filtercat']                       = 'Filtra per categoria';
    $lang['firesale:label_filtersel']                       = 'Seleziona una categoria';
    $lang['firesale:label_filterprod']                      = 'Seleziona un prodotto';
    $lang['firesale:label_filterstatus']                    = 'Seleziona lo stato di un prodotto';
    $lang['firesale:label_filtersstatus']                   = 'Seleziona uno stato di scorte';
    $lang['firesale:label_order_status']                    = 'Seleziona uno stato di Ordine';
    $lang['firesale:label_rrp']                             = 'Prezzo raccomandato';
    $lang['firesale:label_rrp_tax']                         = 'Prezzo raccomandato (tasse escluse)';
    $lang['firesale:label_rrp_short']                       = 'RRP';
    $lang['firesale:label_price']                           = 'Prezzo di vendita';
    $lang['firesale:label_price_tax']                       = 'Prezzo di vendita (tasse escluse)';
    $lang['firesale:label_stock']                           = 'Quantità in magazzino';
    $lang['firesale:label_drop_images']                     = 'Trascina qui le immagini da caricare';
    $lang['firesale:label_duplicate']                       = 'Duplica';
    $lang['firesale:label_showfilter']                      = 'Mostra filtri';
    $lang['firesale:label_mod_variant']                     = 'Variante';
    $lang['firesale:label_mod_input']                       = 'Input';
    $lang['firesale:label_mod_single']                      = 'Singolo Prodotto';
    $lang['firesale:label_mod_price']                       = 'Incremento prezzo di';
    $lang['firesale:label_mod_price_inst']                  = 'Alcune istruzioni';
    $lang['firesale:label_buy_now_for']                     = 'Acquista ora per %s';

    $lang['firesale:label_stock_short']                     = 'Livello scorte';
    $lang['firesale:label_stock_status']                    = 'Stato delle scorte';
    $lang['firesale:label_stock_in']                        = 'Disponibili';
    $lang['firesale:label_stock_low']                       = 'Pochi pezzi';
    $lang['firesale:label_stock_out']                       = 'Finito';
    $lang['firesale:label_stock_order']                     = 'Scorte in ordine';
    $lang['firesale:label_stock_ended']                     = 'Discontinuo';
    $lang['firesale:label_stock_unlimited']                 = 'Senza limiti';

    $lang['firesale:label_remove']                          = 'Rimuovi';
    $lang['firesale:label_image']                           = 'Immagine';
    $lang['firesale:label_images']                          = 'Immagini';
    $lang['firesale:label_order']                           = 'Ordini';
    $lang['firesale:label_gateway']                         = 'Metodi di pagamento';
    $lang['firesale:label_shipping']                        = 'Metodi di spedizione';
    $lang['firesale:label_quantity']                        = 'Quantità';
    $lang['firesale:label_price_total']                     = 'Prezzo totale';
    $lang['firesale:label_price_ship']                      = 'Costi di spedizione';
    $lang['firesale:label_price_sub']                       = 'Parziale';
    $lang['firesale:label_products_total']                  = 'Totale prodotti';
    $lang['firesale:label_ship_to']                         = 'Spedito a';
    $lang['firesale:label_bill_to']                         = 'Fatturato a';
    $lang['firesale:label_date']                            = 'Data';
    $lang['firesale:label_product']                         = 'Prodotto';
    $lang['firesale:label_products']                        = 'Prodotto';
    $lang['firesale:label_company']                         = 'Società';
    $lang['firesale:label_firstname']                       = 'Nome';
    $lang['firesale:label_lastname']                        = 'Cognome';
    $lang['firesale:label_phone']                           = 'Telefono';
    $lang['firesale:label_email']                           = 'Indirizzo email';
    $lang['firesale:label_address1']                        = 'Indirizzo 1';
    $lang['firesale:label_address2']                        = 'Indirizzo 2';
    $lang['firesale:label_city']                            = 'Città';
    $lang['firesale:label_postcode']                        = 'C.A.P.';
    $lang['firesale:label_county']                          = 'Provincia';
    $lang['firesale:label_country']                         = 'Stato';
    $lang['firesale:label_details']                         = 'L\'indirizzo di fatturazione e di spedizione coincidono.';
    $lang['firesale:label_user_order']                      = 'Utente';
    $lang['firesale:label_ip']                              = 'Indirizzo IP';
    $lang['firesale:label_ship_req']                        = 'Richiede spedizione';
    $lang['firesale:label_address_title']                   = 'Salva indirizzo come';

    $lang['firesale:label_nameaz']                          = 'Nome A - Z';
    $lang['firesale:label_nameza']                          = 'Nome Z - A';
    $lang['firesale:label_pricelow']                        = 'Prezzo Basso &gt; Alto';
    $lang['firesale:label_pricehigh']                       = 'Prezzo Alto &gt; Basso';
    $lang['firesale:label_modelaz']                         = 'Modello A - Z';
    $lang['firesale:label_modelza']                         = 'Modello Z - A';
    $lang['firesale:label_creatednew']                      = 'Piú recenti - Piú vecchi';
    $lang['firesale:label_createdold']                      = 'Piú vecchi - Piú recenti';

    $lang['firesale:label_time_now']                        = 'meno di un minuto fa.';
    $lang['firesale:label_time_min']                        = 'circa un minuto fa.';
    $lang['firesale:label_time_mins']                       = 'circa %s minuti fa.';
    $lang['firesale:label_time_hour']                       = 'circa 1 ora fa.';
    $lang['firesale:label_time_hours']                      = 'circa %s ore fa.';
    $lang['firesale:label_time_day']                        = '1 giorno da.';
    $lang['firesale:label_time_days']                       = '%s giorni fa.';

    $lang['firesale:label_map']                             = 'Mappa';
    $lang['firesale:label_route']                           = 'Reindirizzamento';
    $lang['firesale:label_translation']                     = 'Traduzione';
    $lang['firesale:label_table']                           = 'Tabella';
    $lang['firesale:label_https']                           = 'HTTPS';
    $lang['firesale:label_use_https']                       = 'Abilita HTTPS';

    $lang['firesale:label_cur_code']                        = 'Codice Valuta';
    $lang['firesale:label_cur_code_inst']                   = 'Formato ISO-4217';
    $lang['firesale:label_cur_tax']                         = 'Percentuale tassa';
    $lang['firesale:label_cur_mod']                         = 'Modificatore di valuta';
    $lang['firesale:label_cur_mod_inst']                    = 'Potresti voler ritoccare leggermente il tasso di cambio per coprire i costi addizionali associati a questa area geografica';
    $lang['firesale:label_exch_rate']                       = 'Tasso di cambio';
    $lang['firesale:label_exch_rate_inst']                  = 'Questo sarà automaticamente aggiornato ogni ora, se lasciato bianco sarò aggiornato al momento del salvataggio';
    $lang['firesale:label_cur_flag']                        = 'Immagine correlata';
    $lang['firesale:label_enabled']                         = 'Abilita';
    $lang['firesale:label_disabled']                        = 'Disabilita';
    $lang['firesale:label_cur_format']                      = 'Formato valuta';
    $lang['firesale:label_cur_format_inst']                 = 'Formattazione numerica che include il simbolo di valuta con "{{ price }}" che verrà sostituito dal prezzo da mostrare, es: £{{ price }}';
    $lang['firesale:label_cur_format_dec']                  = 'Simbolo per i decimali';
    $lang['firesale:label_cur_format_sep']                  = 'Simbolo separazione migliaia';
    $lang['firesale:label_cur_format_num']                  = 'Formattazione numerica';
    $lang['firesale:label_tax_band']                        = 'Scaglione di imposta';

    // Orders
    $lang['firesale:orders:title']                          = 'Ordini';
    $lang['firesale:orders:no_orders']                      = 'NOn ci sono ordini al momento';
    $lang['firesale:orders:my_orders']                      = 'Miei ordini';
    $lang['firesale:orders:view_order']                     = 'Vedi ordine #%s';
    $lang['firesale:orders:title_create']                   = 'Crea ordine';
    $lang['firesale:orders:title_edit']                     = 'Modifica ordine #%s';
    $lang['firesale:orders:delete_success']                 = 'Ordine cancellato con successo';
    $lang['firesale:orders:delete_error']                   = 'Non è stato possibile cancellare l\'ordine a causa di un errore';
    $lang['firesale:orders:save_first']                     = 'Devi salvare l\'ordine prima di aggiungere prodotti';
    $lang['firesale:orders:delete']                         = 'Cancella ordini';
    $lang['firesale:orders:mark_as']                        = 'Marca come ';
    $lang['firesale:orders:status_unpaid']                  = 'Non pagato';
    $lang['firesale:orders:status_paid']                    = 'Pagato';
    $lang['firesale:orders:status_dispatched']              = 'Spedito';
    $lang['firesale:orders:status_processing']              = 'Processando';
    $lang['firesale:orders:status_refunded']                = 'Rimborsato';
    $lang['firesale:orders:status_cancelled']               = 'Cancelalto';
    $lang['firesale:orders:status_failed']                  = 'Fallito';
    $lang['firesale:orders:status_declined']                = 'Rifiutato';
    $lang['firesale:orders:status_mismatch']                = 'Non combacia';
    $lang['firesale:orders:status_prefunded']               = 'Parzialmente rimborsato';
    $lang['firesale:orders:failed_message']                 = 'Si è verificato un errore nel processare il pagamento';
    $lang['firesale:orders:declined_message']               = 'Il tuo pagamento è stato rifiutato, per favore riprova.';
    $lang['firesale:orders:mismatch_message']               = 'Il pagamento non corrisponde all\'ordine.';
    $lang['firesale:orders:logged_in']                      = 'Devi effettuare il login per vedere i tuoi ordini passati.';
    $lang['firesale:orders:label_view_order']               = 'Vedi ordine';
    $lang['firesale:orders:label_products']                 = 'Prodotti';
    $lang['firesale:orders:label_view_order']               = 'Vedi ordine';
    $lang['firesale:orders:label_customer']                 = 'Cliente';
    $lang['firesale:orders:label_date_placed']              = 'Data acquisto';
    $lang['firesale:orders:label_order_id']                 = "ID ordine";
    $lang['firesale:orders:label_shipping_address']         = 'Indirizzo di spedizione';
    $lang['firesale:orders:label_payment_address']          = 'Indirizzo di fatturazione';
    $lang['firesale:orders:label_order_status']             = 'Stato dell\'ordine';
    $lang['firesale:orders:label_message']                  = 'Messaggio';
    $lang['firesale:orders:confirm_title']                  = 'Conferma dettagli ordine';

    // Gateways
    $lang['firesale:gateways:admin_title']                  = 'Metodi di pagamento';
    $lang['firesale:gateways:install_title']                = 'Installa un metodo di pagamento';
    $lang['firesale:gateways:edit_title']                   = 'Modifica metodi di pagamento';
    $lang['firesale:gateways:installed_title']              = 'Metodi di pagamento installati';
    $lang['firesale:gateways:no_gateways']                  = 'Attualmente non ci sono metodi di pagamento installati.';
    $lang['firesale:gateways:no_uninstalled_gateways']      = 'Tutti i metodi di pagamento disponibili sono attualmente installati.';
    $lang['firesale:gateways:errors:invalid_bool']          = 'The %s field must be a boolean value.';
    $lang['firesale:gateways:warning']                      = 'Tutte le impostazioni del pagamento andranno perse e il negozio potrebbe non essere più in grado di ricevere i pagamenti! Sicuro di voler rimuovere questo tipo di pagamento?';
    $lang['firesale:gateways:multiple_warning']             = 'Tutte le impostazioni dei pagamenti andranno perse e il negozio potrebbe non essere più in grado di ricevere i pagamenti! Sicuro di voler rimuovere questi tipi di pagamento?';

    $lang['firesale:gateways:installed_success']            = 'Metodo di Pagamento installato con successo';
    $lang['firesale:gateways:installed_fail']               = 'Il Metodo di Pagamento non può essere installato';

    $lang['firesale:gateways:uninstalled_success']          = 'Metodo di Pagamento disinstallato con successo';
    $lang['firesale:gateways:uninstalled_fail']             = 'Il Metodo di Pagamento non può essere disinstallato';
    $lang['firesale:gateways:multiple_uninstalled_success'] = 'Il Metodo di Pagamento selezionato è stato disinstallato con successo';
    $lang['firesale:gateways:multiple_uninstalled_fail']    = 'Il Metodo di Pagamento selezionato non è stato disinstallato';

    $lang['firesale:gateways:multiple_enabled_success']     = 'Il Metodo di Pagamento selezionato è stato abilitato';
    $lang['firesale:gateways:multiple_enabled_fail']        = 'Il Metodo di Pagamento selezionato non può essere abilitato';
    $lang['firesale:gateways:enabled_success']              = 'Il Metodo di Pagamento è stato abilitato';
    $lang['firesale:gateways:enabled_fail']                 = 'Il Metodo di Pagamento non è stato abilitato';

    $lang['firesale:gateways:disabled_success']             = 'Il Metodo di Pagamento è stato disabilitato';
    $lang['firesale:gateways:disabled_fail']                = 'Il Metodo di Pagamento non può essere disabilitato';
    $lang['firesale:gateways:multiple_disabled_success']    = 'Il Metodo di Pagamento selezionato è stato disabilitato con successo';
    $lang['firesale:gateways:multiple_disabled_fail']       = 'Il Metodo di Pagamento selezionato non può essere disabilitato';

    $lang['firesale:gateways:updated_success']              = 'Metodo di Pagamento aggiornato con successo';
    $lang['firesale:gateways:updated_fail']                 = 'Il Metodo di Pagamento non può essere aggiornato';

    // Checkout
    $lang['firesale:gateways:labels:name']                  = 'Nome';
    $lang['firesale:gateways:labels:desc']                  = 'Descrizione';
    $lang['firesale:cart:title']                            = 'Carrello';
    $lang['firesale:cart:empty']                            = 'Non ci sono oggetti nel tuo carrello';
    $lang['firesale:cart:login_required']                   = 'Devi effettuare il login prima di procedere';
    $lang['firesale:cart:qty_too_low']                      = 'Non abbiamo sufficienti scorte per soddisfare la tua richiesta';
    $lang['firesale:cart:price_changed']                    = 'Il prezzo di alcuni prodotti che hai nel carrello é cambiato. Controlla prima di continuare.';
    $lang['firesale:checkout:title']                        = 'Pagamento';
    $lang['firesale:checkout:error_callback']               = 'Sembra esserci un problema con il tuo ordine, prova ancora, possibilmente utilizza un altro metodo di pagamento.';
    $lang['firesale:payment:title']                         = 'Conferma dettagli';
    $lang['firesale:payment:title_success']                 = 'Pagamento completato';
    $lang['firesale:checkout:title:ship_method']            = 'Modalità di spedizione';
    $lang['firesale:checkout:title:payment_method']         = 'Metodo di pagamento';
    $lang['firesale:checkout:next']                         = 'Avanti';
    $lang['firesale:checkout:previous']                     = 'Indietro';
    $lang['firesale:checkout:select_shipping_method']       = 'Per favore seleziona il metodo di spedizione che preferisci prima di proseguire';
    $lang['firesale:checkout:select_payment_method']        = 'Per favore seleziona il metodo di pagamento che preferisci prima di proseguire';
    $lang['firesale:checkout:submit_and_pay']               = 'Conferma e Paga';
    $lang['firesale:checkout:shipping_min_price']           = 'Il valore totale del tuo carrello non raggiunge il minimo previsto dal tipo di consegna scelta';
    $lang['firesale:checkout:shipping_max_price']           = 'Il valore totale del tuo carrello supera il massimo previsto dal tipo di consegna scelta';
    $lang['firesale:checkout:shipping_min_weight']          = 'Il peso totale dei prodotti presenti nel tuo carrello non raggiunge il minimo previsto dal tipo di consegna scelta';
    $lang['firesale:checkout:shipping_max_weight']          = 'Il peso totale dei prodotti presenti nel tuo carrello eccede il massimo previsto dal tipo di consegna scelta';
    $lang['firesale:checkout:shipping_invalid']             = 'Il metodo di consegna selezionato non é valido';
    $lang['firesale:checkout:address_invalid']              = 'L\'indirizzo selezionato non é valido';
    $lang['firesale:checkout:gateway_invalid']              = 'Il canale di pagamento selezionato non é valido';
    $lang['firesale:checkout:paypal_expr:before_checkout']  = 'Il processo di pagamento viene ultimato attraverso il sito di Paypal perció, se sei soddisfatto dei tuoi acquisti, puoi completare il tuo ordine cliccando il bottone';
    $lang['firelase:checkout:paypal_expr:checkout']         = 'Paga con Paypal Express';
    $lang['firesale:checkout:paypal:before_checkout']       = 'Il processo di pagamento viene ultimato attraverso il sito di Paypal perció, se sei soddisfatto dei tuoi acquisti, puoi completare il tuo ordine cliccando il bottone';
    $lang['firelase:checkout:paypal:checkout']              = 'Paga con Paypal';

    // Routes
    $lang['firesale:routes:title']                          = 'Reindirizzamenti';
    $lang['firesale:routes:new']                            = 'Aggiungi un nuovo reindirizzamento';
    $lang['firesale:routes:add_success']                    = 'Nuovo reindirizzamento aggiunto con successo';
    $lang['firesale:routes:add_error']                      = 'Si è verificato un errore nell\'aggiungere il Reindirizzamento';
    $lang['firesale:routes:edit']                           = 'Modifica Reindirizzamento %s';
    $lang['firesale:routes:edit_success']                   = 'Reindirizzamento modificato con successo';
    $lang['firesale:routes:edit_error']                     = 'Si è verificato un errore nel modificare il Reindirizzamento';
    $lang['firesale:routes:not_found']                      = 'Il Reindirizzamento selezionato non è stato trovato';
    $lang['firesale:routes:none']                           = 'Non sono stati trovati Reindirizzamenti';
    $lang['firesale:routes:delete_success']                 = 'Reindirizzamento rimosso con successo';
    $lang['firesale:routes:delete_error']                   = 'Si è verificato un errore nel rimuovere il Reindirizzamento';
    $lang['firesale:routes:build_success']                  = 'Il file dei Reindirizzamenti è stato ricorstruito con successo';
    $lang['firesale:routes:build_error']                    = 'Si è verificato un errore nel ricostruire il file dei Reindirizzamenti';
    $lang['firesale:routes:write_error']                    = 'Accesso Negato: assicurati che config/routes.php sia scrivibile e riprova';

    // Route Labels
    $lang['firesale:routes:category_custom']                = 'Personalizzazione della categoria';
    $lang['firesale:routes:category']                       = 'Categoria';
    $lang['firesale:routes:product']                        = 'Prodotto';
    $lang['firesale:routes:cart']                           = 'Carrello';
    $lang['firesale:routes:order_single']                   = 'Ordine singolo';
    $lang['firesale:routes:orders']                         = 'Ordine dell\'utente';
    $lang['firesale:routes:addresses']                      = 'Indirizzo utente';
    $lang['firesale:routes:currency']                       = 'Convertitore di valuta';
    $lang['firesale:routes:new_products']                   = 'Nuovi prodotti';

    // Currency
    $lang['firesale:shortcuts:install_currency']            = 'Installa nuova Valuta';
    $lang['firesale:currency:enable']                       = 'Abilita';
    $lang['firesale:currency:disable']                      = 'Disabilita';
    $lang['firesale:currency:disable_warn']                 = 'La disabilitazione potrebbe provocare problemi ai clienti e agli ordini già effettuati';
    $lang['firesale:currency:delete']                       = 'Cancella';
    $lang['firesale:currency:delete_warn']                  = 'La cancellazione potrebbe provocare problemi ai clienti e agli ordini già effettuati';
    $lang['firesale:currency:create']                       = 'Crea una nuova Valuta';
    $lang['firesale:currency:edit']                         = 'Modifica Valuta';
    $lang['firesale:currency:not_found']                    = 'La valuta selezionata non è stata trovata';
    $lang['firesale:currency:add_success']                  = 'La nuova Valuta è stata aggiunta con successo';
    $lang['firesale:currency:add_error']                    = 'Si è verificato un errore nell\'aggiungere la nuova Valuta';
    $lang['firesale:currency:edit_success']                 = 'Valuta aggiornata correttamente';
    $lang['firesale:currency:edit_error']                   = 'Si è verificato un errore nell\'aggiornare la nuova Valuta';
    $lang['firesale:currency:delete_success']               = 'La valuta è stata cancellata con successo';
    $lang['firesale:currency:delete_error']                 = 'Si è verificato un errore nel cancellare la valuta';
    $lang['firesale:currency:format_none']                  = 'Nessuno';
    $lang['firesale:currency:format_00']                    = 'Arrotonda al numero intero più vicino';
    $lang['firesale:currency:format_50']                    = 'Arrotonda al più vicino .50';
    $lang['firesale:currency:format_99']                    = 'Arrotonda al più vicino .99';

    // Taxes
    $lang['firesale:taxes:none']                            = 'Non sono ancora stati specificati degli scaglioni di imposta';
    $lang['firesale:taxes:new']                             = 'Aggiungi scaglione di imposta';
    $lang['firesale:taxes:edit']                            = 'Modifica scaglione di imposta';
    $lang['firesale:taxes:add_success']                     = 'Lo scaglione di imposta é stato creato';
    $lang['firesale:taxes:add_error']                       = 'Errore durante la creazione dello scaglione di imposta';
    $lang['firesale:taxes:edit_success']                    = 'Lo scaglione di imposta é stato modificato';
    $lang['firesale:taxes:edit_error']                      = 'Errore durante la modifica dello scaglione di imposta';
    $lang['firesale:taxes:assignments_updated']             = 'Le assegnazioni degli scaglioni di imposta sono state aggiornate';
    $lang['firesale:taxes:add_tax_band']                    = 'Crea scaglione di imposta';

    // Addresses
    $lang['firesale:addresses:title']                       = 'Miei indirizzi';
    $lang['firesale:addresses:edit_address']                = 'Modifica indirizzo';
    $lang['firesale:addresses:new_address']                 = 'Crea un nuovo indirizzo';
    $lang['firesale:addresses:save']                        = 'Salva';
    $lang['firesale:addresses:cancel']                      = 'Annulla';
    $lang['firesale:addresses:no_user']                     = 'Devi effettuare il login per gestire l\'elenco dei tuooi indirizzi';
    $lang['firesale:addresses:add_success']                 = 'Indirizzo creato con successo';
    $lang['firesale:addresses:add_error']                   = 'Si è verificato un errore nel creare l\'indirizzo';
    $lang['firesale:addresses:edit_success']                = 'Indirizzo modificato con successo';
    $lang['firesale:addresses:edit_error']                  = 'Si è verificato un errore nel modficare l\'indirizzo';

    // Products Frontend
    $lang['firesale:product:label_availability']            = 'Disponibilità:';
    $lang['firesale:product:label_model']                   = 'Modello:';
    $lang['firesale:product:label_product_code']            = 'Codice prodotto:';
    $lang['firesale:product:label_qty']                     = 'Quantità:';
    $lang['firesale:product:label_add_to_cart']             = 'Aggiungi al Carrello';
    $lang['firesale:product:our_price']                     = 'Nostro prezzo';
    $lang['firesale:product:related_products']              = 'Prodotti correlati';
    $lang['firesale:product:share_on']                      = 'Condividi su';
    $lang['firesale:product:latest_products']               = 'Prodotti recenti';

    // Cart Frontend
    $lang['firesale:cart:label_remove']                     = "Rimuovi";
    $lang['firesale:cart:label_image']                      = "Immagine";
    $lang['firesale:cart:label_name']                       = "Nome";
    $lang['firesale:cart:label_model']                      = "Modello";
    $lang['firesale:cart:label_quantity']                   = "Quantità";
    $lang['firesale:cart:label_unit_price']                 = "Prezzo unitario";
    $lang['firesale:cart:label_total']                      = "Totale";
    $lang['firesale:cart:label_no_items_in_cart']           = "Non ci sono prodotti nel carrello";
    $lang['firesale:cart:button_update']                    = "Aggiorna carrello";
    $lang['firesale:cart:button_goto_checkout']             = "Vai al pagamento";
    $lang['firesale:cart:label_sub_total']                  = "Parziale";
    $lang['firesale:cart:label_tax']                        = "Tasse";
    $lang['firesale:cart:label_total']                      = "Totale";
    $lang['firesale:cart:your_chart']                       = "Il tuo carrello";
    $lang['firesale:cart:items_in_your_chart']              = "Prodotti nel tuo carrello";
    $lang['firesale:cart:label_original_price']             = "Prezzo originale";
    $lang['firesale:cart:label_discounted_price']           = "Prezzo scontato";
    $lang['firesale:cart:continue_shopping']                = "Continua gli acquisti";
    $lang['firesale:cart:checkout']                         = "Paga";
    $lang['firesale:cart:discount_code']           			= "Buono sconto";
    $lang['firesale:cart:enter_discount_code']           	= "Inserisci il codice del buono sconto";
    $lang['firesale:cart:remove_discount_code']           	= "Rimuovi buono sconto";
    $lang['firesale:cart:add2wishlist']           			= "Aggiungi alla tua lista dei desideri";
    $lang['firesale:cart:returning_customers']           	= "Giá cliente";
    $lang['firesale:cart:fields_marked']                     = "I campi contraddistinti da";
    $lang['firesale:cart:are_required']                     = "sono obbligatori";
    $lang['firesale:cart:same_as_billing']                  = "Uguale all'indirizzo di fatturazione";
    $lang['firesale:cart:new_address']	                    = "Nuovo indirizzo";
    $lang['firesale:cart:remember_password']	            = "Ricorda password";
    $lang['firesale:cart:Apply']							= 'Applica';
    $lang['firesale:cart:empty_chart']						= 'Sembra che tu non abbia ancora alcun prodotto nel carrello';
    $lang['firesale:cart:payment_details']					= 'Dettagli pagamento';
    $lang['firesale:cart:my_cart']                          = 'Carrello';
    $lang['firesale:cart:review']                           = 'Controlla il carrello';

    // Categories Frontend
    $lang['firesale:categories:grid']                       = 'Griglia';
    $lang['firesale:categories:list']                       = 'Lista';
    $lang['firesale:categories:add_to_basket']              = 'Aggiungi al carrello';

    // Payment Frontend
    $lang['firesale:payment:cancelled']                     = 'Ordine cancellato';
    $lang['firesale:payment:wait_redirect']                 = 'Per favore attendi il reindirizzamento alla pagina dei pagamenti...';
    $lang['firesale:payment:btn_continue']                  = 'Continua';

    // Settings
    $lang['firesale:settings_tax']                          = 'Percentuale tasse';
    $lang['firesale:settings_tax_inst']                     = 'La percentuale di tasse che verrà applicata ai prodotti';
    $lang['firesale:settings_currency']                     = 'Codice della Valuta principale';
    $lang['firesale:settings_currency_inst']                = 'La valuta deve rispettare il formato (ISO-4217)';
    $lang['firesale:settings_currency_key']                 = 'Valuta API Key';
    $lang['firesale:settings_currency_key_inst']            = 'API Key da <a target="_blank" href="https://openexchangerates.org/signup/free">Tassi di cambio aperti</a>';
    $lang['firesale:settings_current_currency']             = 'Valuta corrente';
    $lang['firesale:settings_current_currency_inst']        = 'La valuta correntemente in uso, usata per aggionare i valori esistenti quando la valuta predefinita viene modificata';
    $lang['firesale:settings_currency_updated']             = 'Data ultimo aggioramento valuta';
    $lang['firesale:settings_currency_updated_inst']        = 'The last time the currency was updated, api is updated every hour and to keep to rate limits we only check after that'; # translate  I can not clearly understand this sentence
    $lang['firesale:settings_perpage']                      = 'Prodotti per pagina';
    $lang['firesale:settings_perpage_inst']                 = 'Numero di prodotti da mostrare nella pagina della categoria e della ricerca';
    $lang['firesale:settings_image_square']                 = 'Rendi le immagini quadrate';
    $lang['firesale:settings_image_square_inst']            = 'Alcuni temi richiedono le immagini quadrate per mantenere un layout consistente';
    $lang['firesale:settings_image_background']             = 'Colore di sfondo Immagine';
    $lang['firesale:settings_image_background_inst']        = 'Colore esadecimale (senza #) per il background delle immagini ridimensionate';
    $lang['firesale:settings_login']                        = 'Per l\'acquisto è richiesto il login';
    $lang['firesale:settings_login_inst']                   = 'Assicurarsi che l\'utente sia loggato prima di permettere l\'acquisto dei prodotti';
    $lang['firesale:settings_dashboard']                    = 'Sovrascrivi il cruscotto predefinito';
    $lang['firesale:settings_dashboard_inst']               = 'Mostra il cruscotto di Firesale al posto di quello predefinito';
    $lang['firesale:settings_low']                          = 'Quantità a magazzino bassa';

    $lang['firesale:settings_low_inst']                     = 'Il numero minimo di prodotti rimanenti a magazzino prima che vengano considerati pochi';
    $lang['firesale:settings_new']                          = 'Tempo di Nuovo prodotto';
    $lang['firesale:settings_new_inst']                     = 'Tempo in secondi durante i quali un prodotto viene considerato come nuovo';
    $lang['firesale:settings_basic']                        = 'Vista semplice della cassa';
    $lang['firesale:settings_basic_inst']                   = 'Impaginazione minimale della cassa. Richiede la presenza di minimal.html nel tuo tema';
    $lang['firesale:settings_disabled']                     = 'Disabilita la vendita di prodotti';
    $lang['firesale:settings_disabled_inst']                = 'Tutto sembra normale ma non sará possibile aggiungere prodotti al carrello o acquistare';
    $lang['firesale:settings_disabled_msg']                 = 'Disabled Message'; # translate
    $lang['firesale:settings_disabled_msg_inst']            = 'A flashdata error shown to users after they attempt to add an item to their cart'; # translate
    $lang['firesale:settings_assets']                       = 'Usa gli stili di FireSale';
    $lang['firesale:settings_assets_inst']                  = 'Include nel tema i css e i javascript di FireSale';
    $lang['firesale:settings_api']                          = 'Abilita le API di FireSale';
    $lang['firesale:settings_api_inst']                     = 'La nostra API é disponibile nella maggiorparte delle pagine principali, semplicemente aggiungendo .json o .xml';
    $lang['firesale:settings_api_key']                      = 'Chiave API di FireSale';
    $lang['firesale:settings_api_key_inst']                 = 'La API é pubblica se questo campo viene lasciato vuoto. Se invece lo riempi devi aggiunge ?key=<TUA CHIAVE> per ottenere un accesso privato';

    // Install errors
    $lang['firesale:install:wrong_version']                 = 'Non è possibile installare il modulo FireSale, FireSale richiede PyroCMS v2.1.4 o superiore';
    $lang['firesale:install:missing_multiple']              = 'FireSale richiede Multiple Relationships field type per funzionare. Puoi scaricarlo da <a target="_blank" href="https://github.com/adamfairholm/PyroStreams-Multiple-Relationships/zipball/2.0/develop">qui</a>';
    $lang['firesale:install:not_installed']                 = 'Per favore installa prima il modulo FireSale e poi i suoi addons';
    $lang['firesale:install:no_route_access']               = 'FireSale richiede l\'accesso al file system/cms/config/routes.php. Per favore imposta i permessi appropriati e riprova';
    $lang['firesale:install:old_multiple']                  = 'La versione di Multiple field (campo multiplo) correntemente installata é antiquata. Elimanala o aggiornala prima di usare FireSale';

    // Registration
    $lang['firesale:register:register_label']               = 'Registrati';
    $lang['firesale:register:register_new_label']           = 'Registra nuovo account';
    $lang['firesale:register:account_registration']         = 'Registrazione Account';
    $lang['firesale:register:text1']                        = 'Registrati ora per ottenere immediatamente i seguenti benefici';
    $lang['firesale:register:li1']                          = 'Visualizzare la cronologia dei tuoi ordini';
    $lang['firesale:register:li2']                          = 'Salvare e gestire i tuoi indirizzi';
    $lang['firesale:register:li3']                          = 'Gestire le tue liste dei desideri';
    $lang['firesale:register:li4']                          = 'Ottenere sconti personalizzati';
    $lang['firesale:register:li5']                          = 'Salvare e visualizzare la cronologia del tuo carrello';
    $lang['firesale:register:text2']                        = 'Cosa stai aspettando?';
    $lang['firesale:register:text3']                        = 'Completa il form a destra e comincia oggi stesso!';
    $lang['firesale:register:text4']                        = 'Hai giá un account con noi?';
    $lang['firesale:register:text5']                        = 'Allora vai alla <a href="{{ url:site uri="users/login" }}">pagina di accesso</a>';
    $lang['firesale:register:label_email_sent']             = 'Ti é stata inviata un\'email contenente il codice di attivazione per la registrazione';

    // Login
    $lang['firesale:login:click_here']                       = 'Clicca qui per accedere';
    $lang['firesale:login:login2account']                    = 'Accedi';
    $lang['firesale:login:welcome_back']                     = 'Ben tornato';
    $lang['firesale:login:great2see']                        = 'É bello vederti di nuovo';
    $lang['firesale:login:text1']                            = 'Sei ad un passo dall\'accedere al ';
    $lang['firesale:login:text2']                            = 'Se non sei ancora registrato, allora vai alla';
    $lang['firesale:login:text3']                            = '<a href="{{ url:site uri="users/register" }}">pagina di registrazione</a>';
    $lang['firesale:login:text4']                            = 'e crea un nuovo account';
    $lang['firesale:login:text5']                            = 'Se hai problemi a registrarti o qualsiasi altra domanda';
    $lang['firesale:login:text6']                            = '<a href="{{ url:site uri="contact" }}">contattaci</a>!';

    // Account navigation
    $lang['firesale:nav:your_account']                       = 'Il tuo profilo';
    $lang['firesale:nav:edit_profile']                       = 'Modifica profilo';
    $lang['firesale:nav:saved_addresses']                    = 'Indirizzi salvati';
    $lang['firesale:nav:wishlists']                          = 'Liste dei desideri';
    $lang['firesale:nav:order_history']                      = 'Cronologia ordini';

    // Edit profile
    $lang['firesale:profile:login_details']                  = 'Dettagli di accesso';
    $lang['firesale:profile:account_details']                = 'Dettagli del profilo';
    $lang['firesale:profile:my_saved_addresses']             = 'Indirizzi salvati';
    $lang['firesale:profile:no_address_found']               = 'Nessun indirizzo trovato';
    $lang['firesale:profile:no_orders_found']                = 'Nessun ordine trovato';

    // Footer
    $lang['firesale:footer:rights']                          = 'tutti i diritti sono riservati';

    // Orders
    $lang['firesale:orders:billing_address']                 = 'Indirizzo contabile';
    $lang['firesale:orders:summary']                         = 'Distinta d\'ordine';

    // Dummy payment
    $lang['firesale:dummy:card_name']                        = 'Nome titolare';
    $lang['firesale:dummy:card_type']                        = 'Tipo Carta';
    $lang['firesale:dummy:card_no']                          = 'Numero Carta';
    $lang['firesale:dummy:card_expiration']                  = 'Scadenza';
    $lang['firesale:dummy:csc']                              = 'CSC';
    $lang['firesale:dummy:submit']                           = 'Effettua pagamento fittizio';
