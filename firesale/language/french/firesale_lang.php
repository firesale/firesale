<?php
	
	// General Titles
	$lang['firesale:title']				= 'FireSale';
	$lang['firesale:title:general']		= 'Général';
	$lang['firesale:title:details']		= 'Vos infos';
	$lang['firesale:title:address']		= 'Votre adresse';
	$lang['firesale:title:bill']		= 'Informations de facturation';
	$lang['firesale:title:ship']		= 'Information d\'expédition';

	// Sections
	$lang['firesale:sections:dashboard'] 	  = 'Tableau de bord';
	$lang['firesale:sections:categories'] 	  = 'Catégories';
	$lang['firesale:sections:products'] 	  = 'Produits';
	$lang['firesale:sections:orders'] 		  = 'Commandes';
	$lang['firesale:sections:addresses'] 	  = 'Addresses';
	$lang['firesale:sections:orders_items']	  = 'Eléments de la commande';
	$lang['firesale:sections:gateways']		  = 'Paiements';
	$lang['firesale:sections:settings'] 	  = 'Paramètres';
	$lang['firesale:sections:routes']         = 'Routes';
	$lang['firesale:sections:currency']       = 'Currency'; # Translate
	$lang['firesale:sections:taxes']          = 'Taxes'; #Translate

	// Tabs
	$lang['firesale:tabs:general']		= 'Options générales';
	$lang['firesale:tabs:description'] 	= 'Description';
	$lang['firesale:tabs:formatting'] 	= 'Formatting'; # Translate
	$lang['firesale:tabs:shipping']		= 'Expédition';
	$lang['firesale:tabs:metadata']		= 'Méta-données';
	$lang['firesale:tabs:attributes']	= 'Attributs';
	$lang['firesale:tabs:images']		= 'Images';
	$lang['firesale:tabs:assignments']  = 'Assignments'; #Translate
	
	// Shortcuts
	$lang['firesale:shortcuts:prod_create']		= 'Créer un produit';
	$lang['firesale:shortcuts:cat_create']		= 'Créer une catégorie';
	$lang['firesale:shortcuts:install_gateway']	= 'Installer une plateforme de paiement';
	$lang['firesale:shortcuts:create_order']	= 'Créer une commande';
	$lang['firesale:shortcuts:create_routes']   = 'Ajouter une nouvelle route';
	$lang['firesale:shortcuts:build_routes']    = 'Reconstruire les routes';
	$lang['firesale:shortcuts:add_tax_band']    = 'Add Tax Band'; # Translate
	$lang['firesale:shortcuts:assign_taxes']    = 'Assign Taxes'; # Translate

	// Dashboard
	$lang['firesale:dash_overview']			 	= 'Vue d\'ensemble';
	$lang['firesale:dash_categorytrack']	 	= 'Suivi de catégorie';
	$lang['firesale:elements:product_sales'] 	= 'Ventes du produit';
	$lang['firesale:elements:low_stock']	 	= 'Stock faible';
	$lang['firesale:dashboard:no_sales']	 	= 'Aucune vente trouvé dans les 12 derniers mois';
	$lang['firesale:dashboard:stock_low']	 	= '%s produits avec un stock faible';
	$lang['firesale:dashboard:stock_out']	 	= '%s produits en rupture de stock';
	$lang['firesale:dashboard:no_stock_low']	= 'Aucun produit avec un stock faible';
	$lang['firesale:dashboard:no_stock_out']	= 'Aucun produit en rupture de stock';
	$lang['firesale:dashboard:view_more']		= 'Voir plus...';
	$lang['firesale:dashbord:low_stock']		= 'Stock faible';
	$lang['firesale:dashbord:out_of_stock']		= 'Rupture de stock';

	// Categories
	$lang['firesale:cats_title']			= 'Gèrer les catégories';
	$lang['firesale:cats_none']				= 'Aucune catégorie trouvée';
	$lang['firesale:cats_new']				= 'Créer une catégorie';
	$lang['firesale:cats_order']			= 'Ranger les catégories';
	$lang['firesale:cats_draft_label']		= 'Brouillon';
	$lang['firesale:cats_live_label']		= 'En ligne';
	$lang['firesale:cats_edit']				= 'Modifier catégorie';
	$lang['firesale:cats_edit_title']		= 'Modifier "%s"';
	$lang['firesale:cats_delete']			= 'Supprimer';
	$lang['firesale:cats_add_success'] 		= 'Nouvelle catégorie ajoutée';
	$lang['firesale:cats_add_error'] 		= 'Impossible d\'ajouter la catégorie';
	$lang['firesale:cats_edit_success'] 	= 'Catégorie modifiée';
	$lang['firesale:cats_edit_error'] 		= 'Impossible de modifier la catégorie';
	$lang['firesale:cats_delete_success'] 	= 'Catégorie supprimée';
	$lang['firesale:cats_delete_error'] 	= 'Impossible de supprimer la catégorie';
	$lang['firesale:cats_all_products']     = 'Tous les produits';
	
	// Products
	$lang['firesale:prod_none']				= 'Aucun produit trouvé';
	$lang['firesale:prod_create'] 			= 'Créer un produit';
	$lang['firesale:prod_header']			= 'Modifier %t';
	$lang['firesale:prod_title']			= 'Gérer les produits';
	$lang['firesale:prod_title_create'] 	= 'Créer un produit';
	$lang['firesale:prod_title_edit'] 		= 'Modifier un produit';
	$lang['firesale:prod_edit_success'] 	= 'Produit modifié';
	$lang['firesale:prod_edit_error'] 	 	= 'Impossible de modifier le produit';
	$lang['firesale:prod_add_success'] 		= 'Produit ajouté';
	$lang['firesale:prod_add_error'] 		= 'Impossible d\'ajouter le produit';
	$lang['firesale:prod_delete_error'] 	= 'Impossible de supprimer le produit';
	$lang['firesale:prod_delete_success'] 	= 'Produit supprimé';
	$lang['firesale:prod_duplicate_error'] 	= 'Impossible de dupliquer le produit';
	$lang['firesale:prod_duplicate_success']= 'Produit dupliqué';
	$lang['firesale:prod_not_found'] 		= 'Produit introuvable';
	$lang['firesale:prod_delimg_success']   = 'Image supprimée';
	$lang['firesale:prod_delimg_error']     = 'Impossible de supprimer l\'image';
	$lang['firesale:prod_button_quick_edit']= 'Modification rapide';

	// Instructions
	$lang['firesale:inst_rrp']	 = 'Prix de vente conseillé avant et après taxation';
	$lang['firesale:inst_price'] = 'Prix de vente avant et après taxation';

	// Labels
	$lang['firesale:label_draft']		  = 'Brouillon';
	$lang['firesale:label_live'] 		  = 'En ligne';
	$lang['firesale:label_id'] 			  = 'Code produit';
	$lang['firesale:label_title'] 		  = 'Titre';
	$lang['firesale:label_slug'] 		  = 'Slug';
	$lang['firesale:label_status'] 		  = 'Statut';
	$lang['firesale:label_description']	  = 'Description';
	$lang['firesale:label_category']	  = 'Catégorie';
	$lang['firesale:label_parent']		  = 'Catégorie parente';
	$lang['firesale:label_filtercat']	  = 'Filtrer par catégorie';
	$lang['firesale:label_filtersel']	  = 'Sélectionnez une catégorie';
	$lang['firesale:label_filterprod']    = 'Select a Product'; # translate
	$lang['firesale:label_filterstatus']  = 'Select a Product Status'; # translate
	$lang['firesale:label_filtersstatus'] = 'Select a Stock Status'; # translate
	$lang['firesale:label_order_status']  = 'Select an Order Status'; # translate
	$lang['firesale:label_rrp']			  = 'Prix de vente conseillé';
	$lang['firesale:label_rrp_tax']		  = 'Prix de vente conseillé (avant taxes)';
	$lang['firesale:label_rrp_short']	  = 'PVC';
	$lang['firesale:label_price']		  = 'Prix actuel';
	$lang['firesale:label_price_tax']	  = 'Prix actuel (avant taxes)';
	$lang['firesale:label_stock']		  = 'Niveau des stocks';
	$lang['firesale:label_drop_images']   = 'Glissez les images ici';
	$lang['firesale:label_duplicate']     = 'Dupliquer';
	$lang['firesale:label_showfilter']    = 'Voir les filtres';

	$lang['firesale:label_stock_short']		= 'Niveau des stocks';
	$lang['firesale:label_stock_status']	= 'Stocks';
	$lang['firesale:label_stock_in']		= 'En stock';
	$lang['firesale:label_stock_low']		= 'Stock faible';
	$lang['firesale:label_stock_out']		= 'Rupture de stock';
	$lang['firesale:label_stock_order']		= 'Stock en attente';
	$lang['firesale:label_stock_ended']		= 'Série terminée';
	$lang['firesale:label_stock_unlimited']	= 'Illimité';

	$lang['firesale:label_remove']		= 'Supprimer';
	$lang['firesale:label_image']		= 'Image';
	$lang['firesale:label_images']		= 'Images';
	$lang['firesale:label_order']		= 'Commande';
	$lang['firesale:label_gateway']		= 'Mode de paiement';
	$lang['firesale:label_shipping']	= 'Mode d\'expédition';
	$lang['firesale:label_quantity']	= 'Quantité';
	$lang['firesale:label_price_total'] = 'Prix total';
	$lang['firesale:label_price_ship']	= 'Frais de port';
	$lang['firesale:label_price_sub']	= 'Sous-total';
	$lang['firesale:label_ship_to']		= 'Expédié à';
	$lang['firesale:label_bill_to']		= 'Facturé à';
	$lang['firesale:label_date']		= 'Date';
	$lang['firesale:label_product']		= 'Produit';
	$lang['firesale:label_products']	= 'Produits';
	$lang['firesale:label_company']		= 'Nom de la société';
	$lang['firesale:label_firstname']	= 'Prénom';
	$lang['firesale:label_lastname']	= 'Nom';
	$lang['firesale:label_phone']		= 'Téléphone';
	$lang['firesale:label_email']		= 'Adresse e-mail';
	$lang['firesale:label_address1']	= 'Adresse';
	$lang['firesale:label_address2']	= 'Complément d\'adresse';
	$lang['firesale:label_city']		= 'Ville';
	$lang['firesale:label_postcode']	= 'Code postal';
	$lang['firesale:label_county']		= 'Région';
	$lang['firesale:label_country']		= 'Pays';
	$lang['firesale:label_details'] 	= 'Adresse de livraison et de facturation identiques';
	$lang['firesale:label_user_order']	= 'Utilisateur';
	$lang['firesale:label_ip']			= 'Adresse IP';
	$lang['firesale:label_ship_req']    = 'Requires Shipping'; # Translate

	$lang['firesale:label_nameaz']		= 'Nom A - Z';
	$lang['firesale:label_nameza']		= 'Nom Z - A';
	$lang['firesale:label_pricelow']	= 'Prix Bas &gt; Haut';
	$lang['firesale:label_pricehigh']	= 'Prix Haut &gt; Bas';
	$lang['firesale:label_modelaz']		= 'Modèle A - Z';
	$lang['firesale:label_modelza']		= 'Modèle Z - A';

	$lang['firesale:label_time_now']	= 'il y a moins d\'une minute.';
	$lang['firesale:label_time_min']	= 'il y a une minute.';
	$lang['firesale:label_time_mins']	= 'il y a %s minutes.';
	$lang['firesale:label_time_hour']	= 'il y a une heure.';
	$lang['firesale:label_time_hours']	= 'il y a %s heures.';
	$lang['firesale:label_time_day']	= 'il y a un jour.';
	$lang['firesale:label_time_days'] 	= 'il y a %s jours.';

	$lang['firesale:label_map']         = 'Carte';
	$lang['firesale:label_route']       = 'Route';
	$lang['firesale:label_translation'] = 'Traduction';
	$lang['firesale:label_table']       = 'Table';

	$lang['firesale:label_cur_code']        = 'Currency Code'; # translate
	$lang['firesale:label_cur_code_inst']   = 'ISO-4217 Format'; # translate
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

	$lang['firesale:label_tax_band']  = 'Tax Band';  # translate
	
	// Orders
	$lang['firesale:orders:title']				= 'Commandes';
	$lang['firesale:orders:no_orders']			= 'Il n\'y a actuellement aucune commande en cours';
	$lang['firesale:orders:my_orders']			= 'Mes commandes';
	$lang['firesale:orders:view_order']			= 'Consulter la commande #%s';
	$lang['firesale:orders:title_create'] 		= 'Créer une commande';
	$lang['firesale:orders:title_edit']	  		= 'Modifier la commande #%s';
	$lang['firesale:orders:delete_success'] 	= 'Commande annulée';
	$lang['firesale:orders:delete_error']		= 'Impossible d\'annuler la commande';
	$lang['firesale:orders:save_first']			= 'Merci d\'enregistrer votre commande avant d\'y ajouter des produits';
	$lang['firesale:orders:delete']				= 'Annuler commandes';
	$lang['firesale:orders:mark_as']			= 'Marquer comme ';
	$lang['firesale:orders:status_unpaid'] 		= 'Impayée';
	$lang['firesale:orders:status_paid'] 		= 'Payée';
	$lang['firesale:orders:status_dispatched']	= 'Envoyée';
	$lang['firesale:orders:status_processing']	= 'Traitée';
	$lang['firesale:orders:status_refunded']	= 'Remboursée';
	$lang['firesale:orders:status_cancelled']	= 'Annulée';
	$lang['firesale:orders:status_failed']		= 'Manquée';
	$lang['firesale:orders:status_declined']	= 'Refusée';
	$lang['firesale:orders:status_mismatch']	= 'Imcomplète';
	$lang['firesale:orders:failed_message'] 	= 'Il y a eu une erreur durant le traitement de votre paiement.';
	$lang['firesale:orders:declined_message']	= 'Votre paiement a été refusé.';
	$lang['firesale:orders:mismatch_message']	= 'Votre paiement ne correspond à votre commande.';
	$lang['firesale:orders:logged_in']			= 'Vous devez être connecté pour votre l\'historique de vos commandes.';
	$lang['firesale:orders:label_view_order']	= 'Consulter commande';
	$lang['firesale:orders:label_products']		= 'Produits';
	$lang['firesale:orders:label_view_order']	= 'Consulter commande';
	$lang['firesale:orders:label_customer']		= 'Client';
	$lang['firesale:orders:label_date_placed']	= 'Date';
	$lang['firesale:orders:label_order_id'] 	= "ID Commande";
	$lang['firesale:orders:labe_shipping_address'] 	= 'Adresse de livraison';
	$lang['firesale:orders:labe_payment_address'] 	= 'Adresse de facturation';
	$lang['firesale:orders:label_order_status']		= 'Statut de la commande';
	$lang['firesale:orders:label_message']			= 'Message';

	// Gateways
	$lang['firesale:gateways:admin_title']					= 'Plateformes de paiement';
	$lang['firesale:gateways:install_title']				= 'Installer une plateforme';
	$lang['firesale:gateways:edit_title']					= 'Modifier plateforme';
	$lang['firesale:gateways:installed_title']				= 'Plateformes installées';
	$lang['firesale:gateways:no_gateways']					= 'Il n\'y a actuellement aucune plateforme de paiement installée.';
	$lang['firesale:gateways:no_uninstalled_gateways']		= 'Toutes les plateformes de paiement sont installées.';
	$lang['firesale:gateways:errors:invalid_bool']			= 'Le champs %s doit contenir une valeur booléenne.';
	$lang['firesale:gateways:warning'] 						= 'Tous les paramètres de la plateforme seront perdus et votre système ne pourra plus recevoir de paiement ! Etes vous sûr de vouloir supprimer cette plateforme ?';
	$lang['firesale:gateways:multiple_warning'] 			= 'Tous les paramètres de la plateforme seront perdus et votre système ne pourra plus recevoir de paiement ! Etes vous sûr de vouloir supprimer les plateformes sélectionnées ?';
	
	$lang['firesale:gateways:installed_success']			= 'Plateforme installée';
	$lang['firesale:gateways:installed_fail']				= 'Impossible d\'installer la plateforme';

	$lang['firesale:gateways:uninstalled_success']			= 'Plateforme désinstallée';
	$lang['firesale:gateways:uninstalled_fail']				= 'Impossible de désinstaller la plateforme';
	$lang['firesale:gateways:multiple_uninstalled_success']	= 'Les plateformes sélectionnées ont été désinstallées';
	$lang['firesale:gateways:multiple_uninstalled_fail']	= 'Impossible de désinstaller les plateformes sélectionnées';

	$lang['firesale:gateways:multiple_enabled_success']		= 'Les plateformes sélectionnées ont été activées';
	$lang['firesale:gateways:multiple_enabled_fail']		= 'Impossible d\'activer les plateformes sélectionnées';
	$lang['firesale:gateways:enabled_success']				= 'La plateforme a été activée';
	$lang['firesale:gateways:enabled_fail']					= 'Impossible d\'activer la plateforme';

	$lang['firesale:gateways:disabled_success']				= 'La plateforme a été désactivée';
	$lang['firesale:gateways:disabled_fail']				= 'Impossible de désactiver la plateforme';
	$lang['firesale:gateways:multiple_disabled_success']	= 'Les plateformes sélectionnées ont été désactivées';
	$lang['firesale:gateways:multiple_disabled_fail']		= 'Impossible de désactiver les plateformes sélectionnées';

	$lang['firesale:gateways:updated_success'] 				= 'Plateforme mise à jour';
	$lang['firesale:gateways:updated_fail'] 				= 'Impossible de mettre à jour la plateforme';

	// Checkout
	$lang['firesale:gateways:labels:name']			= 'Nom';
	$lang['firesale:gateways:labels:desc']			= 'Description';
	$lang['firesale:cart:title']					= 'Panier';
	$lang['firesale:cart:empty']					= 'Votre panier est vide';
	$lang['firesale:cart:login_required']			= 'Vous devez être connecté pour effectuer cette action';
	$lang['firesale:cart:qty_too_low']				= 'Il n\'y a pas assez de stock pour ajouter la quantité demandée à votre panier';
	$lang['firesale:checkout:title'] 				= 'Vérification';
	$lang['firesale:checkout:error_callback'] 		= 'Une erreur s\'est produite dans le traitement de votre commande. Vous pouvez essayer avec un autre mode de paiement.';
	$lang['firesale:payment:title'] 				= 'Confirmation des informations';
	$lang['firesale:payment:title_success'] 		= 'Paiement effectué';
	$lang['firesale:checkout:title:ship_method']	= 'Mode d\'expédition';
	$lang['firesale:checkout:title:payment_method']	= 'Mode de paiement';
	$lang['firesale:checkout:next']					= 'Next'; #Translate
	$lang['firesale:checkout:previous']				= 'Previous';#Translate
	$lang['firesale:checkout:select_shipping_method'] = 'Please select your preferred shipping method below before continuing';#Translate
	$lang['firesale:checkout:select_payment_method'] = 'Please select your preferred payment method below before continuing';#Translate
	$lang['firesale:checkout:submit_and_pay']		= 'Submit &amp; Pay';#Translate

	// Routes
	$lang['firesale:routes:title']          = 'Routes';
	$lang['firesale:routes:new']            = 'Ajouter une nouvelle route';
	$lang['firesale:routes:add_success']    = 'Nouvelle route ajoutée';
	$lang['firesale:routes:add_error']      = 'Impossible d\'ajouter la nouvelle route';
	$lang['firesale:routes:edit']           = 'Modifier %s route';
	$lang['firesale:routes:edit_success']   = 'Route modifiée';
	$lang['firesale:routes:edit_error']     = 'Impossible de modifier la route';
	$lang['firesale:routes:not_found']      = 'La route sélectionnée est introuvable';
	$lang['firesale:routes:none']           = 'Aucune route trouvée';
	$lang['firesale:routes:delete_success'] = 'Route supprimée';
	$lang['firesale:routes:delete_error']   = 'Impossible de supprimer la route';
	$lang['firesale:routes:build_success']  = 'Routes reconstruites';
	$lang['firesale:routes:build_error']    = 'Impossible de reconstruire les routes';

	// Currency
	$lang['firesale:shortcuts:install_currency'] = 'Installer une monnaie';
	$lang['firesale:currency:enable']            = 'Activer';
	$lang['firesale:currency:disable']           = 'Désactiver';
	$lang['firesale:currency:disable_warn']      = 'Désactiver une monnaie peut causer des problèmes avec d\'éventuelles précédentes commandes';
	$lang['firesale:currency:delete']            = 'Supprimer';
	$lang['firesale:currency:delete_warn']       = 'Supprimer une monnaie peut causer des problèmes avec d\'éventuelles précédentes commandes';
	$lang['firesale:currency:create']            = 'Ajouter une nouvelle monnaie';
	$lang['firesale:currency:edit']              = 'Modifier monnaie';
	$lang['firesale:currency:not_found']         = 'Monnaie sélectionnée introuvable';
	$lang['firesale:currency:add_success']       = 'Nouvelle monnaie ajoutée';
	$lang['firesale:currency:add_error']         = 'Impossible d\'ajouter la nouvelle monnaie';
	$lang['firesale:currency:edit_success']      = 'Monnaie modifiée';
	$lang['firesale:currency:edit_error']        = 'Impossible de modifier la monnaie';
	$lang['firesale:currency:format_none']       = 'Aucun';
	$lang['firesale:currency:format_00']         = 'Arrondir à l\'entier supérieur';
	$lang['firesale:currency:format_50']         = 'Arrondir au format .50 le plus proche';
	$lang['firesale:currency:format_99']         = 'Arrondir au format .99 le plus proche';

	// Taxes
	$lang['firesale:taxes:none']                  = 'There are currently no tax bands setup'; # Translate
	$lang['firesale:taxes:new']                   = 'Add tax band'; # Translate
	$lang['firesale:taxes:edit']                  = 'Edit tax band'; # Translate
	$lang['firesale:taxes:add_success']           = 'Tax band created successfully'; # Translate
	$lang['firesale:taxes:add_error']             = 'There was an error whilst creating the tax band'; # Translate
	$lang['firesale:taxes:edit_success']          = 'Tax band edited successfully'; # Translate
	$lang['firesale:taxes:edit_error']            = 'There was an error whilst editing the tax band'; # Translate
	$lang['firesale:taxes:assignments_updated']   = 'Tax band assignments were updated successfully'; # Translate
	
	// Addresses
	$lang['firesale:addresses:title']        = 'Mes adresses';
	$lang['firesale:addresses:edit_address'] = 'Modifier adresse';
	$lang['firesale:addresses:new_address']  = 'Ajouter une adresse';
	$lang['firesale:addresses:save']	     = 'Sauvegarder';
	$lang['firesale:addresses:cancel']       = 'Annuler';
	$lang['firesale:addresses:no_user']      = 'Vous devez être connecté pour gèrer vos adresses';
	$lang['firesale:addresses:add_success']  = 'Adresse créée avec succès';
	$lang['firesale:addresses:add_error']    = 'Impossible de créer l\'adresse';
	$lang['firesale:addresses:edit_success'] = 'Adresse modifiée avec succès';
	$lang['firesale:addresses:edit_error']   = 'Impossible de modifier l\'adresse';
	
	// Products Frontend
	$lang['firesale:product:label_availability'] = "Disponibilité";
	$lang['firesale:product:label_model'] = "Modèle";
	$lang['firesale:product:label_product_code'] = "Code produit";
	$lang['firesale:product:label_qty'] = "Quantité";
	$lang['firesale:product:label_add_to_cart'] = "Ajouter au panier";
	
	// Cart Frontend
	$lang['firesale:cart:label_remove'] = "Supprimer";
	$lang['firesale:cart:label_image'] = "Image";
	$lang['firesale:cart:label_name'] = "Nom";
	$lang['firesale:cart:label_model'] = "Modèle";
	$lang['firesale:cart:label_quantity'] = "Quantité";
	$lang['firesale:cart:label_unit_price'] = "Prix à l'unité";
	$lang['firesale:cart:label_total'] = "Total";
	$lang['firesale:cart:label_no_items_in_cart'] = "Votre panier est vide";
	$lang['firesale:cart:button_update'] = "Actualiser le panier";
	$lang['firesale:cart:button_goto_checkout'] = "Procéder au paiement";
	$lang['firesale:cart:label_sub_total'] = "Sous-Total";
	$lang['firesale:cart:label_tax'] = "Taxe";
	$lang['firesale:cart:label_total'] = "Total";
	
	//Categories Frontend
	$lang['firesale:categories:grid'] = 'Grille';
	$lang['firesale:categories:list'] = 'Liste';
	$lang['firesale:categories:add_to_basket'] = 'Ajouter au panier';
	
	//Payment Frontend
	$lang['firesale:payment:cancelled'] = 'Paiement annulé';
	$lang['firesale:payment:wait_redirect'] = 'Merci de patienter le temps que nous vous redirigions vers la plateforme de paiement...';
	$lang['firesale:payment:btn_continue'] = 'Continuer';

	// Settings
	$lang['firesale:settings_tax']                   = 'Valeur de la taxe';
	$lang['firesale:settings_tax_inst']              = 'Le pourcentage de taxe à appliquer à chaque produit';
	$lang['firesale:settings_currency']              = 'Code monnaitaire par défaut';
	$lang['firesale:settings_currency_inst']         = 'Code de monnaie à appliquer (au format ISO-4217, ex : EUR, USD, GBP, ...)';
	$lang['firesale:settings_currency_key']          = 'Clé API de la monnaie';
	$lang['firesale:settings_currency_key_inst']     = 'Clé API obtenue depuis <a target="_blank" href="https://openexchangerates.org/signup/free">Open Exchange Rates.org</a> (Pour obtenir le taux de change officiel)';
	$lang['firesale:settings_current_currency']      = 'Monnaie courante';
	$lang['firesale:settings_current_currency_inst'] = 'La monnaie courante utilisée, utilisée pour mettre à jour les monnaies existantes si la devise par défaut est changée';
	$lang['firesale:settings_currency_updated']      = 'Dernière mise à jour';
	$lang['firesale:settings_currency_updated_inst'] = 'Dernière mise à jour de la monnaie, l\'API met à jour les devises une seule fois par heure';
	$lang['firesale:settings_perpage']               = 'Produits par page';
	$lang['firesale:settings_perpage_inst']          = 'Le nombre de produit affiché par page et dans les résultats d\'une recherche';
	$lang['firesale:settings_image_square']          = 'Adapter les images';
	$lang['firesale:settings_image_square_inst']     = 'Rendre les images des produits carrées pour préserver l\'homogénéité de l\'affichage';
	$lang['firesale:settings_image_background']      = 'Couleur de fond';
	$lang['firesale:settings_image_background_inst'] = 'Code héxadécimal de la couleur (sans le #) à appliquer en fond des images lors d\'un redimmensionnement';
	$lang['firesale:settings_login']                 = 'Connexion obligatoire';
	$lang['firesale:settings_login_inst']            = 'Permet de s\'assurer qu\'un utilisateur est connecté pour pouvoir commander';
	
	// Install errors
	$lang['firesale:install:wrong_version'] = 'Impossible d\'installer le module, FireSale requiert la version 2.1.4 (ou supérieur) du CMS';
	$lang['firesale:install:missing_multiple'] = 'FireSale requiert le type de champs "Relation multiple" pour fonctionner. Vous pouvez le télécharger <a target="_blank" href="https://github.com/parse19/PyroStreams-Multiple-Relationships">ici</a>';
	$lang['firesale:install:not_installed'] = 'Merci d\'installer le module FireSale avant d\'installer ses modules additionnels';
	$lang['firesale:install:no_route_access']  = 'Le module n\'a pas accès au fichier de routes (application/config/routes.php), merci d\'autoriser l\'écriture de ce fichier';
	