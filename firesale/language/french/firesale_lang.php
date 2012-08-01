<?php
	
	// General Titles
	$lang['firesale:title']				= 'FireSALE';
	$lang['firesale:title:general']		= 'Général';
	$lang['firesale:title:details']		= 'Vos infos';
	$lang['firesale:title:address']		= 'Votre adresse';
	$lang['firesale:title:bill']		= 'Informations de facturation';
	$lang['firesale:title:ship']		= 'Information d\'envoi';

	// Sections
	$lang['firesale:sections:dashboard'] 	= 'Tableau de bord';
	$lang['firesale:sections:categories'] 	= 'Catégories';
	$lang['firesale:sections:products'] 	= 'Produits';
	$lang['firesale:sections:orders'] 		= 'Commandes';
	$lang['firesale:sections:addresses'] 	= 'Adresses';
	$lang['firesale:sections:orders_items']	= 'Eléments de la commande';
	$lang['firesale:sections:gateways']		= 'Gateways';
	$lang['firesale:sections:settings'] 	= 'Paramètres';
	
	// Shortcuts
	$lang['firesale:shortcuts:prod_create']		= 'Créer un produit';
	$lang['firesale:shortcuts:cat_create']		= 'Créer une catégorie';
	$lang['firesale:shortcuts:install_gateway']	= 'Installer la plateforme';
	$lang['firesale:shortcuts:create_order']	= 'Créer commande';

	// Dashboard
	$lang['firesale:dash_overview']			= 'Vue d\'ensemble';
	$lang['firesale:dash_categorytrack']	= 'Category Tracking'; // To check.
	
	// Elements - Dashboard
	$lang['firesale:elements:product_sales'] = 'Meilleures ventes';
	$lang['firesale:elements:low_stock']	 = 'Produits en stock limité ou rupture de stock';

	// Categories
	$lang['firesale:shortcuts:cat_create'] 	= 'Créer une catégorie';
	$lang['firesale:cats_title']			= 'Gérer les catégories';
	$lang['firesale:cats_none']				= 'Aucune catégorie trouvée';
	$lang['firesale:cats_new']				= 'Ajouter une nouvelle catégorie';
	$lang['firesale:cats_order']			= 'Ranger les catégories';
	$lang['firesale:cats_draft_label']		= 'Brouillon';
	$lang['firesale:cats_live_label']		= 'En ligne';
	$lang['firesale:cats_add_success'] 		= '[PH] Ajout de catégorie réussi';
	$lang['firesale:cats_add_error'] 		= '[PH] Ajout de catégorie : échec';
	$lang['firesale:cats_delete_success'] 	= '[PH] Suppression de catégorie réussie';
	$lang['firesale:cats_delete_error'] 	= '[PH] Suppression de catégorie : échec';
	
	// Products
	$lang['firesale:prod_none']				= 'Aucun produit trouvé';
	$lang['firesale:prod_create'] 			= 'Créer un produit';
	$lang['firesale:prod_header']			= 'Editer %t';
	$lang['firesale:prod_title']			= 'Gérer les produits';
	$lang['firesale:prod_title_create'] 	= 'Créer un nouveau produit';
	$lang['firesale:prod_title_edit'] 		= 'Editer le produit';
	$lang['firesale:prod_edit_success'] 	= '[PH] Edition du produit réussie';
	$lang['firesale:prod_add_success'] 		= '[PH] Ajout du produit réussie';
	$lang['firesale:prod_add_error'] 		= '[PH] Ajout du produit : erreur';
	$lang['firesale:prod_temp_error'] 		= '[PH] Vous ne pouvez pas éditer ce produit';
	$lang['firesale:prod_delete_error'] 	= '[PH] Suppression de produit : échec';
	$lang['firesale:prod_delete_success'] 	= '[PH] Suppression de produit réussie';
	$lang['firesale:prod_not_found'] 		= '[PH] Produit introuvable';

	// Labels
	$lang['firesale:label_draft']		= 'Brouillon';
	$lang['firesale:label_live'] 		= 'En ligne';
	$lang['firesale:label_id'] 			= 'Code du produit';
	$lang['firesale:label_title'] 		= 'Tite';
	$lang['firesale:label_slug'] 		= 'Slug';
	$lang['firesale:label_status'] 		= 'Statut';
	$lang['firesale:label_description']	= 'Descriptif';
	$lang['firesale:label_category']	= 'Catégorie';
	$lang['firesale:label_parent']		= 'Catégorie parente';
	$lang['firesale:label_filtercat']	= 'Filtre par catégorie';
	$lang['firesale:label_filtersel']	= 'Sélectionnez une catégorie';
	$lang['firesale:label_rrp']			= 'Prix de détail recommandé';
	$lang['firesale:label_rrp_tax']		= 'Prix de détail recommandé (avant taxe)';
	$lang['firesale:label_rrp_short']	= 'PDR';
	$lang['firesale:label_price']		= 'Prix courant';
	$lang['firesale:label_price_tax']	= 'Prix courant (avant taxe)'; // to check
	$lang['firesale:label_stock']		= 'Niveau actuel du stock';

	$lang['firesale:label_stock_short']	= 'Niveau du stock';
	$lang['firesale:label_stock_status']= 'Statut du stock';
	$lang['firesale:label_stock_in']	= 'En stock';
	$lang['firesale:label_stock_low']	= 'Stock bas';
	$lang['firesale:label_stock_out']	= 'Rupture de stock';
	$lang['firesale:label_stock_order']	= 'Stock en réapprovisionnement';
	$lang['firesale:label_stock_ended']	= 'Abandonné';

	$lang['firesale:label_order']		= 'Commande';
	$lang['firesale:label_gateway']		= 'Mode de paiement';
	$lang['firesale:label_shipping']	= 'Mode d\'envoi';
	$lang['firesale:label_quantity']	= 'Quantité';
	$lang['firesale:label_price_total'] = 'Prix total';
	$lang['firesale:label_price_ship']	= 'Frais de port';
	$lang['firesale:label_price_sub']	= 'Sous-total';
	$lang['firesale:label_ship_to']		= 'Envoyé à';
	$lang['firesale:label_bill_to']		= 'Facturé à';
	$lang['firesale:label_date']		= 'Date';
	$lang['firesale:label_product']		= 'Produit';
	$lang['firesale:label_products']	= 'Produits';
	$lang['firesale:label_company']		= 'Nom de la société';
	$lang['firesale:label_firstname']	= 'Prénom';
	$lang['firesale:label_lastname']	= 'Nom';
	$lang['firesale:label_phone']		= 'Téléphone';
	$lang['firesale:label_email']		= 'Adresse électronique';
	$lang['firesale:label_address1']	= 'Adresse ligne 1';
	$lang['firesale:label_address2']	= 'Adresse ligne 2';
	$lang['firesale:label_city']		= 'Ville';
	$lang['firesale:label_postcode']	= 'Code postal';
	$lang['firesale:label_county']		= 'Région';
	$lang['firesale:label_country']		= 'Pays';
	$lang['firesale:label_details'] 	= 'Mes adresses de livraison et de facturation sont les mêmes.';
	$lang['firesale:label_user_order']	= 'Utilisateur';
	$lang['firesale:label_ip']			= 'Adresse IP';

	$lang['firesale:label_nameaz']		= 'Nom A - Z';
	$lang['firesale:label_nameza']		= 'Nom Z - A';
	$lang['firesale:label_pricelow']	= 'Prix Bas &gt; Haut';
	$lang['firesale:label_pricehigh']	= 'Prix Haut &gt; Bas';
	$lang['firesale:label_modelaz']		= 'Modèle A - Z';
	$lang['firesale:label_modelza']		= 'Modèle Z - A';

	$lang['firesale:label_time_now']	= 'il y a moins d\'une minute.';
	$lang['firesale:label_time_min']	= 'il y a une minute.';
	$lang['firesale:label_time_mins']	= 'il y a %s minutes.';
	$lang['firesale:label_time_hour']	= 'il y a une heure environ.';
	$lang['firesale:label_time_hours']	= 'il y a %s heures environ.';
	$lang['firesale:label_time_day']	= 'il y a 1 jour.';
	$lang['firesale:label_time_days'] 	= 'il y a %s jours.';

	// Orders
	$lang['firesale:orders:title']			= 'Commandes';
	$lang['firesale:orders:no_orders']		= 'Il n\'y a aucune commande en cours';
	$lang['firesale:orders:my_orders']		= 'Mes commandes';
	$lang['firesale:orders:view_order']		= 'Consulter la commande #%s';
	$lang['firesale:orders:title_create'] 	= 'Créer une commande';
	$lang['firesale:orders:title_edit']	  	= 'Editer la commande #%s';
	$lang['firesale:orders:delete_success'] = 'La commande a bien été supprimée';
	$lang['firesale:orders:delete_error']	= 'La commande n\'a pas pu être supprimée - erreur';
	$lang['firesale:orders:save_first']		= 'Merci d\'enregistrer votre commande avant d\'ajouter des produits';
	
	// Gateways
	$lang['firesale:gateways:admin_title']				= 'Plateforme de paiement';
	$lang['firesale:gateways:install_title']			= 'Installer une plateforme';
	$lang['firesale:gateways:installed_title']			= 'Plateforme installée';
	$lang['firesale:gateways:no_gateways']				= 'Il n\'y a aucune plateforme installée pour l\'instant.';
	$lang['firesale:gateways:no_uninstalled_gateways']	= 'Toutes les plateformes disponibles sont déjà installées.';
	$lang['firesale:gateways:errors:invalid_bool']		= 'Le champ %s doit être une valeur booléenne.';
	
	// Gateway labels
	$lang['firesale:gateways:labels:name']	= 'Nom';
	$lang['firesale:gateways:labels:desc']	= 'Descriptif';

	// Cart
	$lang['firesale:cart:title']	= 'Panier d\'achat';
	$lang['firesale:cart:empty']	= 'Il n\'y a aucun produit dans votre panier';

	// Checkout
	$lang['firesale:checkout:title'] = 'Finaliser la commande';
	$lang['firesale:checkout:error_callback'] = 'Il semblerait qu\'il y ait un problème avec votre commande. Merci d\'essayer à nouveau, notamment en sélectionnant un autre mode de paiement.';

	// Payments
	$lang['firesale:payment:title'] 		= 'Confirmez les informations';
	$lang['firesale:payment:title_success'] = 'Paiement effectué';
	
	// Orders
	$lang['firesale:orders:status_unpaid'] 		= 'Non payé';
	$lang['firesale:orders:status_paid'] 		= 'Payé';
	$lang['firesale:orders:status_dispatched']	= 'Envoyé';
	$lang['firesale:orders:status_processing']	= 'En cours';
	$lang['firesale:orders:status_refunded']	= 'Remboursé';
	$lang['firesale:orders:status_cancelled']	= 'Annulé';

	// Addresses
	$lang['firesale:addresses:title'] = 'Mes adresses';

	// Checkout (Shipping Method)
	$lang['firesale:checkout:title:ship_method']	= 'Mode d\'envoi';
	
	// Checkout (Payment Method)
	$lang['firesale:checkout:title:payment_method']	= 'Mode de paiement';
