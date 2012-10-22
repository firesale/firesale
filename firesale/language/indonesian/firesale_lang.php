<?php
	
	// General Titles
	$lang['firesale:title']				= 'FireSale';
	$lang['firesale:title:general']		= 'Umum';
	$lang['firesale:title:details']		= 'Detail Anda';
	$lang['firesale:title:address']		= 'Alamat Anda';
	$lang['firesale:title:bill']		= 'Detail Pembayaran';
	$lang['firesale:title:ship']		= 'Detail Pengiriman';

	// Sections
	$lang['firesale:sections:dashboard'] 	= 'Dasbor';
	$lang['firesale:sections:categories'] 	= 'Kategori';
	$lang['firesale:sections:products'] 	= 'Produk';
	$lang['firesale:sections:orders'] 		= 'Pesanan';
	$lang['firesale:sections:addresses'] 	= 'Alamat';
	$lang['firesale:sections:orders_items']	= 'Item Pesanan';
	$lang['firesale:sections:gateways']		= 'Gateway'; //
	$lang['firesale:sections:settings'] 	= 'Pengaturan';
	$lang['firesale:sections:routes']         = 'Routes'; # Translate
	$lang['firesale:shortcuts:create_routes'] = 'Add a New Route'; # Translate
	$lang['firesale:shortcuts:build_routes']  = 'Rebuild Routes'; # Translate

	// Tabs
	$lang['firesale:tabs:general']		= 'Opsi Umum';
	$lang['firesale:tabs:description'] 	= 'Deskripsi';
	$lang['firesale:tabs:shipping']		= 'Pengiriman';
	$lang['firesale:tabs:metadata']		= 'Metadata';
	$lang['firesale:tabs:attributes']	= 'Atribut';
	$lang['firesale:tabs:images']		= 'Gambar';
	
	// Shortcuts
	$lang['firesale:shortcuts:prod_create']		= 'Buat Produk';
	$lang['firesale:shortcuts:cat_create']		= 'Buat Kategori';
	$lang['firesale:shortcuts:install_gateway']	= 'Pasang Gateway';
	$lang['firesale:shortcuts:create_order']	= 'Buat Pesanan';

	// Dashboard
	$lang['firesale:dash_overview']			 	= 'Ulasan Singkat';
	$lang['firesale:dash_categorytrack']	 	= 'Penelusuran Kategori';
	$lang['firesale:elements:product_sales'] 	= 'Penjualan Produk';
	$lang['firesale:elements:low_stock']	 	= 'Peringatan Stok';
	$lang['firesale:dashboard:no_sales']	 	= 'Tidak ada penjualan dalam 12 bulan terakhir';
	$lang['firesale:dashboard:stock_low']	 	= '%s Produk hampir habis';
	$lang['firesale:dashboard:stock_out']	 	= '%s Produk habis';
	$lang['firesale:dashboard:no_stock_low']	= 'Tidak ada produk dengan ketersediaan rendah';
	$lang['firesale:dashboard:no_stock_out']	= 'Tidak ada produk yang habis';
	$lang['firesale:dashboard:view_more']		= 'Lihat selengkapnya...';
	$lang['firesale:dashbord:low_stock']		= 'Low Stock';	#Translate
	$lang['firesale:dashbord:out_of_stock']		= 'Out of Stock'; #Translate

	// Categories
	$lang['firesale:cats_title']			= 'Atur Kategori';
	$lang['firesale:cats_none']				= 'Tidak Ada Kategori';
	$lang['firesale:cats_new']				= 'Tambah Kategori Baru';
	$lang['firesale:cats_order']			= 'Urut Kategori';
	$lang['firesale:cats_draft_label']		= 'Draft';
	$lang['firesale:cats_live_label']		= 'Live';
	$lang['firesale:cats_edit']				= 'Edit Kategori';
	$lang['firesale:cats_edit_title']		= 'Edit "%s"';
	$lang['firesale:cats_delete']			= 'Hapus';
	$lang['firesale:cats_add_success'] 		= 'Kategori baru berhasil ditambahkan';
	$lang['firesale:cats_add_error'] 		= 'Ada masalah saat menyimpan kategori baru';
	$lang['firesale:cats_edit_success'] 	= 'Kategori berhasil diperbaharui';
	$lang['firesale:cats_edit_error'] 		= 'Ada masalah saat memperbaharui kategori';
	$lang['firesale:cats_delete_success'] 	= 'Kategori berhasil dihapus';
	$lang['firesale:cats_delete_error'] 	= 'Ada masalah saat menghapus kategori';
	$lang['firesale:cats_all_products']     = 'All Products'; # Translate
	
	// Products
	$lang['firesale:prod_none']				= 'Tidak Ada Produk';
	$lang['firesale:prod_create'] 			= 'Buat Produk';
	$lang['firesale:prod_header']			= 'Edit %t';
	$lang['firesale:prod_title']			= 'Atur Produk';
	$lang['firesale:prod_title_create'] 	= 'Buat Produk Baru';
	$lang['firesale:prod_title_edit'] 		= 'Edit Produk';
	$lang['firesale:prod_edit_success'] 	= 'Produk berhasil diperbaharui';
	$lang['firesale:prod_edit_error'] 	 	= 'Produk gagal diperbaharui';
	$lang['firesale:prod_add_success'] 		= 'Produk baru berhasil ditambahkan';
	$lang['firesale:prod_add_error'] 		= 'Ada masalah saat menambahkan produk baru';
	$lang['firesale:prod_delete_error'] 	= 'Ada masalah saat menghapus produk';
	$lang['firesale:prod_delete_success'] 	= 'Produk berhasil dihapus';
	$lang['firesale:prod_duplicate_error'] 	= 'Ada masalah saat menduplikasi produk';
	$lang['firesale:prod_duplicate_success']= 'Produk berhasil diduplikasi';
	$lang['firesale:prod_not_found'] 		= 'Produk yang dimaksud tidak ditemukan';
	$lang['firesale:prod_delimg_success']   = 'Image deleted successfully'; #Translate
	$lang['firesale:prod_delimg_error']     = 'There was an error removing the image specified'; #Translate
	$lang['firesale:prod_button_quick_edit']= 'Quick Edit'; #Translate	

	// Instructions
	$lang['firesale:inst_rrp']	 = 'Harga eceran sebelum dan sesudah dikenai pajak';
	$lang['firesale:inst_price'] = 'Harga jual saat ini sebelum dan sesudah dikenai pajak (apabila lebih rendah dari RRP, akan muncul sebagai harga jual)';

	// Labels
	$lang['firesale:label_draft']		= 'Draft';
	$lang['firesale:label_live'] 		= 'Live';
	$lang['firesale:label_id'] 			= 'Kode Produk';
	$lang['firesale:label_title'] 		= 'Judul';
	$lang['firesale:label_slug'] 		= 'Slug';
	$lang['firesale:label_status'] 		= 'Status';
	$lang['firesale:label_description']	= 'Deskripsi';
	$lang['firesale:label_category']	= 'Kategori';
	$lang['firesale:label_parent']		= 'Kategori Induk';
	$lang['firesale:label_filtercat']	= 'Saring Berdasarkan Kategori';
	$lang['firesale:label_filtersel']	= 'Pilih Kategori';
	$lang['firesale:label_rrp']			= 'Harga Ecer yang Dianjurkan';
	$lang['firesale:label_rrp_tax']		= 'Harga Ecer yang Dianjurkan (sebelum dikenai pajak)';
	$lang['firesale:label_rrp_short']	= 'RRP';
	$lang['firesale:label_price']		= 'Harga Saat Ini';
	$lang['firesale:label_price_tax']	= 'Harga Saat Ini (sebelum dikenai pajak)';
	$lang['firesale:label_stock']		= 'Level Stok Saat Ini';
	$lang['firesale:label_drop_images'] = 'Tarik dan Lepaskan Gambar Disini untuk Mengunggah';
	$lang['firesale:label_duplicate']   = 'Duplikasi';
	$lang['firesale:label_showfilter']  = 'Show Filters'; # Translate

	$lang['firesale:label_stock_short']		= 'Level Stok';
	$lang['firesale:label_stock_status']	= 'Status Stok';
	$lang['firesale:label_stock_in']		= 'Tersedia';
	$lang['firesale:label_stock_low']		= 'Hampir Habis';
	$lang['firesale:label_stock_out']		= 'Habis';
	$lang['firesale:label_stock_order']		= 'Dipesan tambahan stok';
	$lang['firesale:label_stock_ended']		= 'Tidak dilanjutkan';
	$lang['firesale:label_stock_unlimited']	= 'Unlimited'; #translate

	$lang['firesale:label_remove']		= 'Hapus';
	$lang['firesale:label_image']		= 'Gambar';
	$lang['firesale:label_images']		= 'Gambar';
	$lang['firesale:label_order']		= 'Pesanan';
	$lang['firesale:label_gateway']		= 'Metode Pembayaran';
	$lang['firesale:label_shipping']	= 'Metode Pengiriman';
	$lang['firesale:label_quantity']	= 'Kuantitas';
	$lang['firesale:label_price_total'] = 'Total Harga';
	$lang['firesale:label_price_ship']	= 'Biaya Pengiriman';
	$lang['firesale:label_price_sub']	= 'Sub-total';
	$lang['firesale:label_ship_to']		= 'Dikirim ke';
	$lang['firesale:label_bill_to']		= 'Tagihan ke';
	$lang['firesale:label_date']		= 'Tanggal';
	$lang['firesale:label_product']		= 'Produk';
	$lang['firesale:label_products']	= 'Produk';
	$lang['firesale:label_company']		= 'Nama Perusahaan';
	$lang['firesale:label_firstname']	= 'Nama Depan';
	$lang['firesale:label_lastname']	= 'Nama Belakang';
	$lang['firesale:label_phone']		= 'Telepon';
	$lang['firesale:label_email']		= 'Alamat Email';
	$lang['firesale:label_address1']	= 'Baris Alamat 1';
	$lang['firesale:label_address2']	= 'Baris Alamat 2';
	$lang['firesale:label_city']		= 'Kota';
	$lang['firesale:label_postcode']	= 'Kodepos';
	$lang['firesale:label_county']		= 'County';
	$lang['firesale:label_country']		= 'Negara';
	$lang['firesale:label_details'] 	= 'Alamat tagihan dan pengiriman sama';
	$lang['firesale:label_user_order']	= 'Pengguna';
	$lang['firesale:label_ip']			= 'Alamat IP';

	$lang['firesale:label_nameaz']		= 'Nama A - Z';
	$lang['firesale:label_nameza']		= 'Nama Z - A';
	$lang['firesale:label_pricelow']	= 'Harga Rendah &gt; Tinggi';
	$lang['firesale:label_pricehigh']	= 'Harga Tinggi &gt; Rendah';
	$lang['firesale:label_modelaz']		= 'Model A - Z';
	$lang['firesale:label_modelza']		= 'Model Z - A';

	$lang['firesale:label_time_now']	= 'Baru saha.';
	$lang['firesale:label_time_min']	= 'sekitar semenit yang lalu.';
	$lang['firesale:label_time_mins']	= 'sekitar %s menit yang lalu.';
	$lang['firesale:label_time_hour']	= 'sekitar sejam yang lalu.';
	$lang['firesale:label_time_hours']	= 'sekitar %s jam yang lalu.';
	$lang['firesale:label_time_day']	= '1 hari yang lalu.';
	$lang['firesale:label_time_days'] 	= '%s hari yang lalu.';

	$lang['firesale:label_map']         = 'Map'; # Translate
	$lang['firesale:label_route']       = 'Route'; # Translate
	$lang['firesale:label_translation'] = 'Translation'; # Translate
	$lang['firesale:label_table']       = 'Table'; # Translate

	// Orders
	$lang['firesale:orders:title']				= 'Pesanan';
	$lang['firesale:orders:no_orders']			= 'Tidak ada pesanan untuk saat ini';
	$lang['firesale:orders:my_orders']			= 'Pesanan saya';
	$lang['firesale:orders:view_order']			= 'Lihat pesanan #%s';
	$lang['firesale:orders:title_create'] 		= 'Buat Pesanan';
	$lang['firesale:orders:title_edit']	  		= 'Edit Pesanan #%s';
	$lang['firesale:orders:delete_success'] 	= 'Pesanan berhasil dihapus';
	$lang['firesale:orders:delete_error']		= 'Pesanan tidak terhapus dikarenakan beberapa hal';
	$lang['firesale:orders:save_first']			= 'Silakan simpan pesanan sebelum menambahkan produk';
	$lang['firesale:orders:delete']				= 'Hapus Pesanan';
	$lang['firesale:orders:mark_as']			= 'Tandai sebagai ';
	$lang['firesale:orders:status_unpaid'] 		= 'Belum Dibayar';
	$lang['firesale:orders:status_paid'] 		= 'Sudah Dibayar';
	$lang['firesale:orders:status_dispatched']	= 'Dikirim';
	$lang['firesale:orders:status_processing']	= 'Dalam Proses';
	$lang['firesale:orders:status_refunded']	= 'Dikembalikan';
	$lang['firesale:orders:status_cancelled']	= 'Dibatalkan';
	$lang['firesale:orders:status_failed']		= 'Gagal';
	$lang['firesale:orders:status_declined']	= 'Ditolak';
	$lang['firesale:orders:status_mismatch']	= 'Tidak Cocok';
	$lang['firesale:orders:failed_message'] 	= 'Terjadi kesalahan dalam proses pembayaran';
	$lang['firesale:orders:declined_message']	= 'Pembayaran Anda tertolak, silakan coba lagi.';
	$lang['firesale:orders:mismatch_message']	= 'PEmbayaran Anda tidak cocok dengan pesanan.';
	$lang['firesale:orders:logged_in']			= 'Anda harus masuk terlebih dahulu untuk melihat riwayat pesanan Anda.';
	$lang['firesale:orders:label_view_order']	= 'View Order'; # Translate
	$lang['firesale:orders:label_products']		= 'Products'; # Translate
	$lang['firesale:orders:label_view_order']	= 'View Order'; # Translate
	$lang['firesale:orders:label_customer']		= 'Customer'; # Translate
	$lang['firesale:orders:label_date_placed']	= 'Date Placed'; # Translate
	$lang['firesale:orders:label_order_id'] 	= "Order ID"; # Translate	
	$lang['firesale:orders:labe_shipping_address'] 	= 'Shipping Address'; # Translate
	$lang['firesale:orders:labe_payment_address'] 	= 'Payment Address'; # Translate
	$lang['firesale:orders:label_order_status']		= 'Order Status'; # Translate
	$lang['firesale:orders:label_message']			= 'Message'; # Translate

	// Gateways
	$lang['firesale:gateways:admin_title']					= 'Gateway Pembayaran';
	$lang['firesale:gateways:install_title']				= 'Pasang Gateway';
	$lang['firesale:gateways:edit_title']					= 'Edit Gateway';
	$lang['firesale:gateways:installed_title']				= 'Gateway Terpasang';
	$lang['firesale:gateways:no_gateways']					= 'Belum ada gateway pembayaran yang terpasang.';
	$lang['firesale:gateways:no_uninstalled_gateways']		= 'Semua gateway yang ada sudah terpasang.';
	$lang['firesale:gateways:errors:invalid_bool']			= 'Kolom %s harus bernilai boolean.';
	$lang['firesale:gateways:warning'] 						= 'Semua pengaturan gateway akan hilang dan toko Anda tidak akan dapat memproses pembayaran! Apakah Anda yakin akan mencopot gateway ini?';
	$lang['firesale:gateways:multiple_warning']             = 'All gateway settings will be lost and your store may be unable to take payments! Are you sure you want to uninstall the selected gateways?'; # Translate

	$lang['firesale:gateways:installed_success']			= 'Gateway berhasil dipasang';
	$lang['firesale:gateways:installed_fail']				= 'Gateway tidak dapat dipasang';

	$lang['firesale:gateways:uninstalled_success']			= 'Gateway berhasil dicopot';
	$lang['firesale:gateways:uninstalled_fail']				= 'Gateway tidak dapat dicopot';
	$lang['firesale:gateways:multiple_uninstalled_success']	= 'Gateway yang dipilih berhasil dicopot';
	$lang['firesale:gateways:multiple_uninstalled_fail']	= 'Gateway yang dipilih tidak dapat dicopot';

	$lang['firesale:gateways:multiple_enabled_success']		= 'Gateway yang dipilih sudah diaktifkan';
	$lang['firesale:gateways:multiple_enabled_fail']		= 'Gateway yang dipilih tidak dapat diaktifkan';
	$lang['firesale:gateways:enabled_success']				= 'Gateway berhasil diaktifkan';
	$lang['firesale:gateways:enabled_fail']					= 'Gateway tidak dapat diaktifkan';

	$lang['firesale:gateways:disabled_success']				= 'Gateway berhasil dinonaktifkan';
	$lang['firesale:gateways:disabled_fail']				= 'Gateway tidak dapat dinonaktifkan';
	$lang['firesale:gateways:multiple_disabled_success']	= 'Gateway yang dipilih berhasil dinonaktifkan';
	$lang['firesale:gateways:multiple_disabled_fail']		= 'Gateway yang dipilih tidak dapat dinonaktifkan';

	$lang['firesale:gateways:updated_success'] 				= 'Gateway berhasil diperbaharui';
	$lang['firesale:gateways:updated_fail'] 				= 'Gateway tidak dapat diperbaharui';

	// Checkout
	$lang['firesale:gateways:labels:name']			= 'Nama';
	$lang['firesale:gateways:labels:desc']			= 'Deskripsi';
	$lang['firesale:cart:title']					= 'Keranjang Belanja';
	$lang['firesale:cart:empty']					= 'Belum ada item di keranjang Anda';
	$lang['firesale:cart:login_required']			= 'You must be logged in before you can do that'; #translate
	$lang['firesale:cart:qty_too_low']				= 'Stock level is too low to add that quantity to your cart'; #translate
	$lang['firesale:checkout:title'] 				= 'Periksa';
	$lang['firesale:checkout:error_callback'] 		= 'Nampaknya terjadi kesalahan dengan pesanan Anda, silakan coba lagi, mungkin dengan metode pembayaran yang lain.';
	$lang['firesale:payment:title'] 				= 'Detail Konfirmasi';
	$lang['firesale:payment:title_success'] 		= 'Pembayaran Lengkap';
	$lang['firesale:checkout:title:ship_method']	= 'Metode Pengiriman';
	$lang['firesale:checkout:title:payment_method']	= 'Metode Pembayaran';

	// Routes
	$lang['firesale:routes:title']          = 'Routes'; # Translate
	$lang['firesale:routes:new']            = 'Add a new Route'; # Translate
	$lang['firesale:routes:add_success']    = 'New route added successfully'; # Translate
	$lang['firesale:routes:add_error']      = 'Error adding a new route'; # Translate
	$lang['firesale:routes:edit']           = 'Edit %s Route'; # Translate
	$lang['firesale:routes:edit_success']   = 'Route edited successfully'; # Translate
	$lang['firesale:routes:edit_error']     = 'Error editing the route'; # Translate
	$lang['firesale:routes:not_found']      = 'The selected route could not be found'; # Translate
	$lang['firesale:routes:none']           = 'No routes found'; # Translate
	$lang['firesale:routes:delete_success'] = 'Route removed successfully'; # Translate
	$lang['firesale:routes:delete_error']   = 'Error removing route'; # Translate
	$lang['firesale:routes:build_success']  = 'Successfully rebuilt the routes file'; # Translate
	$lang['firesale:routes:build_error']    = 'There was an error rebuilding the routes file'; # Translate

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
	$lang['firesale:label_cur_format_num']       = 'Number Formatting'; # translate
	$lang['firesale:currency:format_none']       = 'None'; # translate
	$lang['firesale:currency:format_00']         = 'Round up to next full number'; # translate
	$lang['firesale:currency:format_50']         = 'Round to closest .50'; # translate
	$lang['firesale:currency:format_99']         = 'Round up to closest .99'; # translate

	// Addresses
	$lang['firesale:addresses:title']        = 'Alamat Saya';
	$lang['firesale:addresses:edit_address'] = 'Edit Address'; # Translate
	$lang['firesale:addresses:new_address']  = 'Create new Address'; # Translate
	$lang['firesale:addresses:save']	     = 'Save'; # Translate
	$lang['firesale:addresses:cancel']       = 'Cancel'; # Translate
	$lang['firesale:addresses:no_user']      = 'You must be logged in to manage your address book'; # Translate
	$lang['firesale:addresses:add_success']  = 'Address created successfully'; # Translate
	$lang['firesale:addresses:add_error']    = 'Error creating address'; # Translate
	$lang['firesale:addresses:edit_success'] = 'Address edited successfully'; # Translate
	$lang['firesale:addresses:edit_error']   = 'Error editing address'; # Translate

	// Products Frontend
	$lang['firesale:product:label_availability'] = "Availability"; # Translate
	$lang['firesale:product:label_model'] = "Model"; # Translate
	$lang['firesale:product:label_product_code'] = "Product Code"; # Translate
	$lang['firesale:product:label_qty'] = "Qty"; # Translate
	$lang['firesale:product:label_add_to_cart'] = "Add to Cart"; # Translate
	
	// Cart Frontend
	$lang['firesale:cart:label_remove'] = "Remove"; # Translate
	$lang['firesale:cart:label_image'] = "Image"; # Translate
	$lang['firesale:cart:label_name'] = "Name"; # Translate
	$lang['firesale:cart:label_model'] = "Model"; # Translate
	$lang['firesale:cart:label_quantity'] = "Quantity"; # Translate
	$lang['firesale:cart:label_unit_price'] = "Unit Price"; # Translate
	$lang['firesale:cart:label_total'] = "Total"; # Translate
	$lang['firesale:cart:label_no_items_in_cart'] = "No items in your cart"; # Translate
	$lang['firesale:cart:button_update'] = "Update cart"; # Translate
	$lang['firesale:cart:button_goto_checkout'] = "Goto Checkout"; # Translate
	$lang['firesale:cart:label_sub_total'] = "Sub-Total";  # Translate
	$lang['firesale:cart:label_tax'] = "Tax"; # Translate
	$lang['firesale:cart:label_total'] = "Total"; # Translate
	
	//Categories Frontend
	$lang['firesale:categories:grid'] = 'Grid';	#Translate
	$lang['firesale:categories:list'] = 'List';	#Translate
	$lang['firesale:categories:add_to_basket'] = 'Add to Basket';	#Translate
	
	//Payment Frontend
	$lang['firesale:payment:cancelled'] = 'Order Cancelled'; #Translate
	$lang['firesale:payment:wait_redirect'] = 'Please wait while we redirect you to the payment page...'; #Translate
	$lang['firesale:payment:btn_continue'] = 'Continue'; #Translate
	
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

	// Install errors
	$lang['firesale:install:wrong_version'] = 'Unable to install the FireSale module, FireSale requires PyroCMS v2.1.4 or above'; #Translate
	$lang['firesale:install:missing_multiple'] = 'FireSale requires the Multiple Relationships field type to operate. You can download this from <a target="_blank" href="https://github.com/parse19/PyroStreams-Multiple-Relationships">here</a>'; #Translate
	$lang['firesale:install:not_installed'] = 'Please install the FireSale module before installing additional FireSale addons'; #Translate
	$lang['firesale:install:no_route_access']  = 'FireSale requires access to the system/cms/config/routes.php file. Please set the appropriate permissions and try again'; # Translate
	