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
    $lang['firesale:store']                                 = 'Store'; # Translate
    $lang['firesale:title:general']                         = 'Umum';
    $lang['firesale:title:details']                         = 'Detail Anda';
    $lang['firesale:title:address']                         = 'Alamat Anda';
    $lang['firesale:title:bill']                            = 'Detail Pembayaran';
    $lang['firesale:title:ship']                            = 'Detail Pengiriman';

    // Sections
    $lang['firesale:sections:dashboard']                    = 'Dasbor';
    $lang['firesale:sections:categories']                   = 'Kategori';
    $lang['firesale:sections:products']                     = 'Produk';
    $lang['firesale:sections:orders']                       = 'Pesanan';
    $lang['firesale:sections:addresses']                    = 'Alamat';
    $lang['firesale:sections:orders_items']                 = 'Item Pesanan';
    $lang['firesale:sections:gateways']                     = 'Gateway';
    $lang['firesale:sections:settings']                     = 'Pengaturan';
    $lang['firesale:sections:routes']                       = 'Rute';
    $lang['firesale:sections:currency']                     = 'Mata Uang';
    $lang['firesale:sections:taxes']                        = 'Taxes'; #Translate

    // Global Search
    $lang['firesale:product']                               = 'Product'; # Translate
    $lang['firesale:products']                              = 'Products'; # Translate
    $lang['firesale:category']                              = 'Category'; # Translate
    $lang['firesale:categories']                            = 'Categories'; # Translate

    // Tabs
    $lang['firesale:tabs:general']                          = 'Opsi Umum';
    $lang['firesale:tabs:description']                      = 'Deskripsi';
    $lang['firesale:tabs:formatting']                       = 'Format';
    $lang['firesale:tabs:shipping']                         = 'Pengiriman';
    $lang['firesale:tabs:metadata']                         = 'Metadata';
    $lang['firesale:tabs:attributes']                       = 'Atribut';
    $lang['firesale:tabs:modifiers']                        = 'Modifiers'; # translate
    $lang['firesale:tabs:images']                           = 'Gambar';
    $lang['firesale:tabs:assignments']                      = 'Assignments'; #Translate

    // Shortcuts
    $lang['firesale:shortcuts:prod_create']                 = 'Buat Produk';
    $lang['firesale:shortcuts:cat_create']                  = 'Buat Kategori';
    $lang['firesale:shortcuts:install_gateway']             = 'Pasang Gateway';
    $lang['firesale:shortcuts:create_order']                = 'Buat Pesanan';
    $lang['firesale:shortcuts:create_routes']               = 'Tambah Route Baru';
    $lang['firesale:shortcuts:build_routes']                = 'Bangun Ulang Rute';
    $lang['firesale:shortcuts:add_tax_band']                = 'Add Tax Band'; #Translate
    $lang['firesale:shortcuts:assign_taxes']                = 'Assign Taxes'; #Translate

    // Dashboard
    $lang['firesale:dash_overview']                         = 'Ulasan Singkat';
    $lang['firesale:dash_categorytrack']                    = 'Penelusuran Kategori';
    $lang['firesale:elements:product_sales']                = 'Penjualan Produk';
    $lang['firesale:elements:low_stock']                    = 'Peringatan Stok';
    $lang['firesale:dashboard:no_sales']                    = 'Tidak ada penjualan dalam 12 bulan terakhir';
    $lang['firesale:dashboard:stock_low']                   = '%s Produk dengan stok menipis';
    $lang['firesale:dashboard:stock_out']                   = '%s Produk habis';
    $lang['firesale:dashboard:no_stock_low']                = 'Tidak ada produk dengan stok menipis';
    $lang['firesale:dashboard:no_stock_out']                = 'Tidak ada produk yang habis';
    $lang['firesale:dashboard:view_more']                   = 'Lihat selengkapnya...';
    $lang['firesale:dashbord:low_stock']                    = 'Stok Menipis';
    $lang['firesale:dashbord:out_of_stock']                 = 'Stok Habis';
    $lang['firesale:dashboard:year']                        = 'Year'; # Translate
    $lang['firesale:dashboard:month']                       = 'Month'; # Translate
    $lang['firesale:dashboard:week']                        = 'Week'; # Translate
    $lang['firesale:dashboard:today']                       = 'Today'; # Translate
    $lang['firesale:dashboard:sales_in']                    = 'in %s sales'; # Translate

    // Categories
    $lang['firesale:cats_title']                            = 'Atur Kategori';
    $lang['firesale:cats_none']                             = 'Tidak Ada Kategori';
    $lang['firesale:cats_new']                              = 'Tambah Kategori Baru';
    $lang['firesale:cats_order']                            = 'Urut Kategori';
    $lang['firesale:cats_draft_label']                      = 'Draft';
    $lang['firesale:cats_live_label']                       = 'Live';
    $lang['firesale:cats_edit']                             = 'Edit Kategori';
    $lang['firesale:cats_edit_title']                       = 'Edit "%s"';
    $lang['firesale:cats_delete']                           = 'Hapus';
    $lang['firesale:cats_add_success']                      = 'Kategori baru berhasil ditambahkan';
    $lang['firesale:cats_add_error']                        = 'Ada masalah saat menyimpan kategori baru';
    $lang['firesale:cats_edit_success']                     = 'Kategori berhasil diperbaharui';
    $lang['firesale:cats_edit_error']                       = 'Ada masalah saat memperbaharui kategori';
    $lang['firesale:cats_delete_success']                   = 'Kategori berhasil dihapus';
    $lang['firesale:cats_delete_error']                     = 'Ada masalah saat menghapus kategori';
    $lang['firesale:cats_all_products']                     = 'Semua Produk';
    $lang['firesale:category:uncategorised']                = 'Uncategorised'; #Translate
    $lang['firesale:category:uncategorised_slug']           = 'uncategorised'; #Translate
    $lang['firesale:category:uncategorised_description']    = 'This is your initial product category, which can\'t be deleted; however you can rename it if you wish.';# Translate

    // Products
    $lang['firesale:prod_none']                             = 'Tidak Ada Produk';
    $lang['firesale:prod_create']                           = 'Buat Produk';
    $lang['firesale:prod_header']                           = 'Edit %t';
    $lang['firesale:prod_title']                            = 'Atur Produk';
    $lang['firesale:prod_title_create']                     = 'Buat Produk Baru';
    $lang['firesale:prod_title_edit']                       = 'Edit Produk';
    $lang['firesale:prod_edit_success']                     = 'Produk berhasil diperbaharui';
    $lang['firesale:prod_edit_error']                       = 'Produk gagal diperbaharui';
    $lang['firesale:prod_add_success']                      = 'Produk baru berhasil ditambahkan';
    $lang['firesale:prod_add_error']                        = 'Ada masalah saat menambahkan produk baru';
    $lang['firesale:prod_delete_error']                     = 'Ada masalah saat menghapus produk';
    $lang['firesale:prod_delete_success']                   = 'Produk berhasil dihapus';
    $lang['firesale:prod_duplicate_error']                  = 'Ada masalah saat menduplikasi produk';
    $lang['firesale:prod_duplicate_success']                = 'Produk berhasil diduplikasi';
    $lang['firesale:prod_not_found']                        = 'Produk yang dimaksud tidak ditemukan';
    $lang['firesale:prod_delimg_success']                   = 'Gambar berhasil dihapus';
    $lang['firesale:prod_delimg_error']                     = 'Terjadi kesalahan saat menghapus gambar yang dimaksud';
    $lang['firesale:prod_button_quick_edit']                = 'Edit Cepat';

    // Product Modifiers & Variations
    $lang['firesale:mods:title']                            = 'Modifiers'; # translate
    $lang['firesale:mods:create_success']                   = 'New modifier created successfully'; # translate
    $lang['firesale:mods:edit_success']                     = 'Modifier edited successfully'; # translate
    $lang['firesale:mods:delete_success']                   = 'Modifier deleted successfully'; # translate
    $lang['firesale:mods:create_error']                     = 'Error creating new modifier'; # translate
    $lang['firesale:mods:edit_error']                       = 'Error editing the modifier'; # translate
    $lang['firesale:mods:delete_error']                     = 'Error deleting the modifier'; # translate
    $lang['firesale:mods:create']                           = 'Add a Modifier'; # translate
    $lang['firesale:mods:edit']                             = 'Edit Modifier'; # translate
    $lang['firesale:mods:none']                             = 'No Modifiers Found'; # translate
    $lang['firesale:mods:nothere']                          = 'You can\'t add modifiers to a variant'; # translate
    $lang['firesale:vars:title']                            = 'Variations'; # translate
    $lang['firesale:vars:show_set']                         = 'Show Variations'; # translate
    $lang['firesale:vars:show_inst']                        = 'Do you want to show variations on listings and search results?'; # translate
    $lang['firesale:vars:create_success']                   = 'New variation created successfully'; # translate
    $lang['firesale:vars:edit_success']                     = 'Variation edited successfully'; # translate
    $lang['firesale:vars:delete_success']                   = 'Variation deleted successfully'; # translate
    $lang['firesale:vars:create_error']                     = 'Error creating new variation'; # translate
    $lang['firesale:vars:edit_error']                       = 'Error editing the variation'; # translate
    $lang['firesale:vars:delete_error']                     = 'Error deleting the variation'; # translate
    $lang['firesale:vars:none']                             = 'No Variations Found'; # translate
    $lang['firesale:vars:create']                           = 'Add a Variation'; # translate
    $lang['firesale:vars:stock_low']                        = 'Not enough stock of %s to buy this item'; # translate
    $lang['firesale:vars:category']                         = 'Build from Category'; # translate

    // New Products
    $lang['firesale:new:title']                             = 'New Products'; # translate
    $lang['firesale:new:in:title']                          = 'New Products in %s'; # translate

    // Instructions
    $lang['firesale:inst_rrp']                              = 'Harga eceran sebelum dan sesudah dikenai pajak';
    $lang['firesale:inst_price']                            = 'Harga jual saat ini sebelum dan sesudah dikenai pajak (apabila lebih rendah dari RRP, akan muncul sebagai harga jual)';

    // Labels
    $lang['firesale:label_draft']                           = 'Draft';
    $lang['firesale:label_live']                            = 'Live';
    $lang['firesale:label_id']                              = 'Kode Produk';
    $lang['firesale:label_title']                           = 'Judul';
    $lang['firesale:label_slug']                            = 'Slug';
    $lang['firesale:label_status']                          = 'Status';
    $lang['firesale:label_type']                            = 'Type'; # translate
    $lang['firesale:label_description']                     = 'Deskripsi';
    $lang['firesale:label_inst']                            = 'Instructions'; # translate
    $lang['firesale:label_category']                        = 'Kategori';
    $lang['firesale:label_parent']                          = 'Kategori Induk';
    $lang['firesale:label_options']                         = 'Options'; # translate
    $lang['firesale:label_filtercat']                       = 'Saring Berdasarkan Kategori';
    $lang['firesale:label_filtersel']                       = 'Pilih Kategori';
    $lang['firesale:label_filterprod']                      = 'Pilih Produk';
    $lang['firesale:label_filterstatus']                    = 'Pilih Status Produk';
    $lang['firesale:label_filtersstatus']                   = 'Pilih Status Stok';
    $lang['firesale:label_order_status']                    = 'Select an Order Status'; # translate
    $lang['firesale:label_rrp']                             = 'Harga Ecer yang Dianjurkan';
    $lang['firesale:label_rrp_tax']                         = 'Harga Ecer yang Dianjurkan (sebelum dikenai pajak)';
    $lang['firesale:label_rrp_short']                       = 'RRP';
    $lang['firesale:label_price']                           = 'Harga Saat Ini';
    $lang['firesale:label_price_tax']                       = 'Harga Saat Ini (sebelum dikenai pajak)';
    $lang['firesale:label_stock']                           = 'Level Stok Saat Ini';
    $lang['firesale:label_drop_images']                     = 'Tarik dan Lepaskan Gambar Disini untuk Mengunggah';
    $lang['firesale:label_duplicate']                       = 'Duplikasi';
    $lang['firesale:label_showfilter']                      = 'Tampilkan Filter';
    $lang['firesale:label_mod_variant']                     = 'Variant'; # translate
    $lang['firesale:label_mod_input']                       = 'Input'; # translate
    $lang['firesale:label_mod_single']                      = 'Single Product'; # translate
    $lang['firesale:label_mod_price']                       = 'Price Modifier'; # translate
    $lang['firesale:label_mod_price_inst']                  = 'Some instructions'; # translate

    $lang['firesale:label_stock_short']                     = 'Level Stok';
    $lang['firesale:label_stock_status']                    = 'Status Stok';
    $lang['firesale:label_stock_in']                        = 'Tersedia';
    $lang['firesale:label_stock_low']                       = 'Stok Menipis';
    $lang['firesale:label_stock_out']                       = 'Habis';
    $lang['firesale:label_stock_order']                     = 'Dipesan tambahan stok';
    $lang['firesale:label_stock_ended']                     = 'Tidak dilanjutkan';
    $lang['firesale:label_stock_unlimited']                 = 'Tak Terbatas';

    $lang['firesale:label_remove']                          = 'Hapus';
    $lang['firesale:label_image']                           = 'Gambar';
    $lang['firesale:label_images']                          = 'Gambar';
    $lang['firesale:label_order']                           = 'Pesanan';
    $lang['firesale:label_gateway']                         = 'Metode Pembayaran';
    $lang['firesale:label_shipping']                        = 'Metode Pengiriman';
    $lang['firesale:label_quantity']                        = 'Kuantitas';
    $lang['firesale:label_price_total']                     = 'Total Harga';
    $lang['firesale:label_price_ship']                      = 'Biaya Pengiriman';
    $lang['firesale:label_price_sub']                       = 'Sub-total';
    $lang['firesale:label_ship_to']                         = 'Dikirim ke';
    $lang['firesale:label_bill_to']                         = 'Tagihan ke';
    $lang['firesale:label_date']                            = 'Tanggal';
    $lang['firesale:label_product']                         = 'Produk';
    $lang['firesale:label_products']                        = 'Produk';
    $lang['firesale:label_company']                         = 'Nama Perusahaan';
    $lang['firesale:label_firstname']                       = 'Nama Depan';
    $lang['firesale:label_lastname']                        = 'Nama Belakang';
    $lang['firesale:label_phone']                           = 'Telepon';
    $lang['firesale:label_email']                           = 'Alamat Email';
    $lang['firesale:label_address1']                        = 'Baris Alamat 1';
    $lang['firesale:label_address2']                        = 'Baris Alamat 2';
    $lang['firesale:label_city']                            = 'Kota';
    $lang['firesale:label_postcode']                        = 'Kodepos';
    $lang['firesale:label_county']                          = 'County';
    $lang['firesale:label_country']                         = 'Negara';
    $lang['firesale:label_details']                         = 'Alamat tagihan dan pengiriman sama';
    $lang['firesale:label_user_order']                      = 'Pengguna';
    $lang['firesale:label_ip']                              = 'Alamat IP';
    $lang['firesale:label_ship_req']                        = 'Requires Shipping'; # Translate
    $lang['firesale:label_address_title']                   = 'Save Address as'; # Translate

    $lang['firesale:label_nameaz']                          = 'Nama A - Z';
    $lang['firesale:label_nameza']                          = 'Nama Z - A';
    $lang['firesale:label_pricelow']                        = 'Harga Rendah &gt; Tinggi';
    $lang['firesale:label_pricehigh']                       = 'Harga Tinggi &gt; Rendah';
    $lang['firesale:label_modelaz']                         = 'Model A - Z';
    $lang['firesale:label_modelza']                         = 'Model Z - A';
    $lang['firesale:label_creatednew']                      = 'Newest - Oldest'; # translate
    $lang['firesale:label_createdold']                      = 'Oldest - Newest'; # translate

    $lang['firesale:label_time_now']                        = 'Baru saha.';
    $lang['firesale:label_time_min']                        = 'sekitar semenit yang lalu.';
    $lang['firesale:label_time_mins']                       = 'sekitar %s menit yang lalu.';
    $lang['firesale:label_time_hour']                       = 'sekitar sejam yang lalu.';
    $lang['firesale:label_time_hours']                      = 'sekitar %s jam yang lalu.';
    $lang['firesale:label_time_day']                        = '1 hari yang lalu.';
    $lang['firesale:label_time_days']                       = '%s hari yang lalu.';

    $lang['firesale:label_map']                             = 'Peta';
    $lang['firesale:label_route']                           = 'Rute';
    $lang['firesale:label_translation']                     = 'Terjemahan';
    $lang['firesale:label_table']                           = 'Tabel';
    $lang['firesale:label_https']                           = 'HTTPS'; # translate
    $lang['firesale:label_use_https']                       = 'Enable HTTPS'; # translate

    $lang['firesale:label_cur_code']                        = 'Kode Mata Uang';
    $lang['firesale:label_cur_code_inst']                   = 'Format ISO-4217';
    $lang['firesale:label_cur_tax']                         = 'Rate Pajak';
    $lang['firesale:label_cur_mod']                         = 'Pengubah Mata Uang';
    $lang['firesale:label_cur_mod_inst']                    = 'Anda boleh mengubah kurs sedikit untuk menutupi biaya tambahan terkait dengan wilayah tersebut';
    $lang['firesale:label_exch_rate']                       = 'Kurs';
    $lang['firesale:label_exch_rate_inst']                  = 'ini akan diperbaharui secara otomatis setiap jam dan dapat dikosongkan karena akan tetap diperbaharui setelah disimpan';
    $lang['firesale:label_cur_flag']                        = 'Gambar Terkait';
    $lang['firesale:label_enabled']                         = 'Nyalakan';
    $lang['firesale:label_disabled']                        = 'Matikan';
    $lang['firesale:label_cur_format']                      = 'Format Mata Uang';
    $lang['firesale:label_cur_format_inst']                 = 'Format termasuk simbol mata uang, dengan "{{ price }}" yang nilainya akan ditampilkan, mis: Rp {{ price }}';
    $lang['firesale:label_cur_format_dec']                  = 'Simbol Desimal';
    $lang['firesale:label_cur_format_sep']                  = 'Simbol Batas Ribuan';
    $lang['firesale:label_cur_format_num']                  = 'Number Formatting'; #Translate

    $lang['firesale:label_tax_band']                        = 'Tax Band'; #Translate

    // Orders
    $lang['firesale:orders:title']                          = 'Pesanan';
    $lang['firesale:orders:no_orders']                      = 'Tidak ada pesanan untuk saat ini';
    $lang['firesale:orders:my_orders']                      = 'Pesanan saya';
    $lang['firesale:orders:view_order']                     = 'Lihat pesanan #%s';
    $lang['firesale:orders:title_create']                   = 'Buat Pesanan';
    $lang['firesale:orders:title_edit']                     = 'Edit Pesanan #%s';
    $lang['firesale:orders:delete_success']                 = 'Pesanan berhasil dihapus';
    $lang['firesale:orders:delete_error']                   = 'Pesanan tidak terhapus dikarenakan beberapa hal';
    $lang['firesale:orders:save_first']                     = 'Silakan simpan pesanan sebelum menambahkan produk';
    $lang['firesale:orders:delete']                         = 'Hapus Pesanan';
    $lang['firesale:orders:mark_as']                        = 'Tandai sebagai ';
    $lang['firesale:orders:status_unpaid']                  = 'Belum Dibayar';
    $lang['firesale:orders:status_paid']                    = 'Sudah Dibayar';
    $lang['firesale:orders:status_dispatched']              = 'Dikirim';
    $lang['firesale:orders:status_processing']              = 'Dalam Proses';
    $lang['firesale:orders:status_refunded']                = 'Dikembalikan';
    $lang['firesale:orders:status_cancelled']               = 'Dibatalkan';
    $lang['firesale:orders:status_failed']                  = 'Gagal';
    $lang['firesale:orders:status_declined']                = 'Ditolak';
    $lang['firesale:orders:status_mismatch']                = 'Tidak Cocok';
    $lang['firesale:orders:status_prefunded']               = 'Partially Refunded'; # Translate
    $lang['firesale:orders:failed_message']                 = 'Terjadi kesalahan dalam proses pembayaran';
    $lang['firesale:orders:declined_message']               = 'Pembayaran Anda tertolak, silakan coba lagi.';
    $lang['firesale:orders:mismatch_message']               = 'PEmbayaran Anda tidak cocok dengan pesanan.';
    $lang['firesale:orders:logged_in']                      = 'Anda harus masuk terlebih dahulu untuk melihat riwayat pesanan Anda.';
    $lang['firesale:orders:label_view_order']               = 'Lihat Pesanan';
    $lang['firesale:orders:label_products']                 = 'Produk';
    $lang['firesale:orders:label_view_order']               = 'View Order'; #Translate
    $lang['firesale:orders:label_customer']                 = 'Pelanggan';
    $lang['firesale:orders:label_date_placed']              = 'Tanggal Ditempatkan';
    $lang['firesale:orders:label_order_id']                 = 'ID Pesanan';
    $lang['firesale:orders:labe_shipping_address']          = 'Alamat Kirim';
    $lang['firesale:orders:labe_payment_address']           = 'Alamat Tagihan';
    $lang['firesale:orders:label_order_status']             = 'Status Pengiriman';
    $lang['firesale:orders:label_message']                  = 'Pesan';

    // Gateways
    $lang['firesale:gateways:admin_title']                  = 'Gateway Pembayaran';
    $lang['firesale:gateways:install_title']                = 'Pasang Gateway';
    $lang['firesale:gateways:edit_title']                   = 'Edit Gateway';
    $lang['firesale:gateways:installed_title']              = 'Gateway Terpasang';
    $lang['firesale:gateways:no_gateways']                  = 'Belum ada gateway pembayaran yang terpasang.';
    $lang['firesale:gateways:no_uninstalled_gateways']      = 'Semua gateway yang ada sudah terpasang.';
    $lang['firesale:gateways:errors:invalid_bool']          = 'Kolom %s harus bernilai boolean.';
    $lang['firesale:gateways:warning']                      = 'Semua pengaturan gateway akan hilang dan toko Anda tidak akan dapat memproses pembayaran! Apakah Anda yakin akan mencopot gateway ini?';
    $lang['firesale:gateways:multiple_warning']             = 'All gateway settings will be lost and your store may be unable to take payments! Are you sure you want to uninstall the selected gateways?'; # Translate

    $lang['firesale:gateways:installed_success']            = 'Gateway berhasil dipasang';
    $lang['firesale:gateways:installed_fail']               = 'Gateway tidak dapat dipasang';

    $lang['firesale:gateways:uninstalled_success']          = 'Gateway berhasil dicopot';
    $lang['firesale:gateways:uninstalled_fail']             = 'Gateway tidak dapat dicopot';
    $lang['firesale:gateways:multiple_uninstalled_success'] = 'Gateway yang dipilih berhasil dicopot';
    $lang['firesale:gateways:multiple_uninstalled_fail']    = 'Gateway yang dipilih tidak dapat dicopot';

    $lang['firesale:gateways:multiple_enabled_success']     = 'Gateway yang dipilih sudah diaktifkan';
    $lang['firesale:gateways:multiple_enabled_fail']        = 'Gateway yang dipilih tidak dapat diaktifkan';
    $lang['firesale:gateways:enabled_success']              = 'Gateway berhasil diaktifkan';
    $lang['firesale:gateways:enabled_fail']                 = 'Gateway tidak dapat diaktifkan';

    $lang['firesale:gateways:disabled_success']             = 'Gateway berhasil dinonaktifkan';
    $lang['firesale:gateways:disabled_fail']                = 'Gateway tidak dapat dinonaktifkan';
    $lang['firesale:gateways:multiple_disabled_success']    = 'Gateway yang dipilih berhasil dinonaktifkan';
    $lang['firesale:gateways:multiple_disabled_fail']       = 'Gateway yang dipilih tidak dapat dinonaktifkan';

    $lang['firesale:gateways:updated_success']              = 'Gateway berhasil diperbaharui';
    $lang['firesale:gateways:updated_fail']                 = 'Gateway tidak dapat diperbaharui';

    // Checkout
    $lang['firesale:gateways:labels:name']                  = 'Nama';
    $lang['firesale:gateways:labels:desc']                  = 'Deskripsi';
    $lang['firesale:cart:title']                            = 'Keranjang Belanja';
    $lang['firesale:cart:empty']                            = 'Belum ada item di keranjang Anda';
    $lang['firesale:cart:login_required']                   = 'You must be logged in before you can do that'; #translate
    $lang['firesale:cart:qty_too_low']                      = 'Stock level is too low to add that quantity to your cart'; #translate
    $lang['firesale:cart:price_changed']                    = 'The price of some items in your cart has changed, please check them before continuing'; # Translate
    $lang['firesale:checkout:title']                        = 'Periksa';
    $lang['firesale:checkout:error_callback']               = 'Nampaknya terjadi kesalahan dengan pesanan Anda, silakan coba lagi, mungkin dengan metode pembayaran yang lain.';
    $lang['firesale:payment:title']                         = 'Detail Konfirmasi';
    $lang['firesale:payment:title_success']                 = 'Pembayaran Lengkap';
    $lang['firesale:checkout:title:ship_method']            = 'Metode Pengiriman';
    $lang['firesale:checkout:title:payment_method']         = 'Metode Pembayaran';
    $lang['firesale:checkout:next']                         = 'Next'; #Translate
    $lang['firesale:checkout:previous']                     = 'Previous';#Translate
    $lang['firesale:checkout:select_shipping_method']       = 'Please select your preferred shipping method below before continuing';#Translate
    $lang['firesale:checkout:select_payment_method']        = 'Please select your preferred payment method below before continuing';#Translate
    $lang['firesale:checkout:submit_and_pay']               = 'Submit &amp; Pay';#Translate
    $lang['firesale:checkout:shipping_min_price']           = 'The total value of your cart items does not meet the minimum for the selected shipping method';#Translate
    $lang['firesale:checkout:shipping_max_price']           = 'The total value of your cart items exceeds the maximum for the selected shipping method';#Translate
    $lang['firesale:checkout:shipping_min_weight']          = 'The total weight of your cart items does not meet the minimum for the selected shipping method';#Translate
    $lang['firesale:checkout:shipping_max_weight']          = 'The total weight of your cart items exceeds the maximum for the selected shipping method';#Translate
    $lang['firesale:checkout:shipping_invalid']             = 'The shipping method you selected is not valid';#Translate
    $lang['firesale:checkout:gateway_invalid']              = 'The payment gateway you selected is not valid';#Translate

    // Routes
    $lang['firesale:routes:title']                          = 'Rute';
    $lang['firesale:routes:new']                            = 'Tambah Rute Baru';
    $lang['firesale:routes:add_success']                    = 'Rute baru telah ditambahkan';
    $lang['firesale:routes:add_error']                      = 'Terjadi kesalahan saat menambahkan rute baru';
    $lang['firesale:routes:edit']                           = 'Edit %s Rute';
    $lang['firesale:routes:edit_success']                   = 'Rote telah diperbaharui';
    $lang['firesale:routes:edit_error']                     = 'Terjadi kesalahan saat memperbaharui rute';
    $lang['firesale:routes:not_found']                      = 'Rute yang dipilih tidak ditemukan';
    $lang['firesale:routes:none']                           = 'Rute tidak ditemukan';
    $lang['firesale:routes:delete_success']                 = 'Rute berhasil dihapus';
    $lang['firesale:routes:delete_error']                   = 'Terjadi kesalahan saat menghapus rute';
    $lang['firesale:routes:build_success']                  = 'Berhasil membangun ulang file routes';
    $lang['firesale:routes:build_error']                    = 'Terjadi kesalahan saat membangun ulang file routes';
    $lang['firesale:routes:write_error']                    = 'Access Denied: Please ensure config/routes.php is writable and try again'; # Translate

    // Route Labels
    $lang['firesale:routes:category_custom']                = 'Category Customisation'; # translate
    $lang['firesale:routes:category']                       = 'Category'; # translate
    $lang['firesale:routes:product']                        = 'Product'; # translate
    $lang['firesale:routes:cart']                           = 'Cart'; # translate
    $lang['firesale:routes:order_single']                   = 'Single Order'; # translate
    $lang['firesale:routes:orders']                         = 'User Orders'; # translate
    $lang['firesale:routes:addresses']                      = 'User Addresses'; # translate
    $lang['firesale:routes:currency']                       = 'Currency Switcher'; # translate
    $lang['firesale:routes:new_products']                   = 'New Products'; # translate

    // Currency
    $lang['firesale:shortcuts:install_currency']            = 'Pasang Mata Uang Baru';
    $lang['firesale:currency:enable']                       = 'Nyalakan';
    $lang['firesale:currency:disable']                      = 'Matikan';
    $lang['firesale:currency:disable_warn']                 = 'Mematikan ini berpotensi menimbulkan masalah untuk pelanggan dan pesanan sebelumnya';
    $lang['firesale:currency:delete']                       = 'Hapus';
    $lang['firesale:currency:delete_warn']                  = 'Menghapus ini berpotensi menimbulkan masalah untuk pelanggan dan pesanan sebelumnya';
    $lang['firesale:currency:create']                       = 'Buat Mata Uang Baru';
    $lang['firesale:currency:edit']                         = 'Edit Mata Uang';
    $lang['firesale:currency:not_found']                    = 'Mata uang yang dipilih tidak ditemukan';
    $lang['firesale:currency:add_success']                  = 'Mata uang baru telah ditambahkan';
    $lang['firesale:currency:add_error']                    = 'Terjadi kesalahan saat menambahkan mata uang baru';
    $lang['firesale:currency:edit_success']                 = 'Mata Uang telah diperbaharui';
    $lang['firesale:currency:edit_error']                   = 'Terjadi kesalahan saat memperbaharui mata uang';
    $lang['firesale:currency:delete_success']               = 'Currency was deleted successfully'; # translate
    $lang['firesale:currency:delete_error']                 = 'There was an error deleting the currency'; # translate
    $lang['firesale:label_cur_format_num']                  = 'Format Angka';
    $lang['firesale:currency:format_none']                  = 'Tidak ada';
    $lang['firesale:currency:format_00']                    = 'Bulatkan ke bilangan bulat selanjutnya';
    $lang['firesale:currency:format_50']                    = 'Bulatkan mendekati .50';
    $lang['firesale:currency:format_99']                    = 'Bulatkan mendekati .99';

    // Taxes
    $lang['firesale:taxes:none']                            = 'There are currently no tax bands setup'; # Translate
    $lang['firesale:taxes:new']                             = 'Add tax band'; # Translate
    $lang['firesale:taxes:edit']                            = 'Edit tax band'; # Translate
    $lang['firesale:taxes:add_success']                     = 'Tax band created successfully'; # Translate
    $lang['firesale:taxes:add_error']                       = 'There was an error whilst creating the tax band'; # Translate
    $lang['firesale:taxes:edit_success']                    = 'Tax band edited successfully'; # Translate
    $lang['firesale:taxes:edit_error']                      = 'There was an error whilst editing the tax band'; # Translate
    $lang['firesale:taxes:assignments_updated']             = 'Tax band assignments were updated successfully'; # Translate
    $lang['firesale:taxes:add_tax_band']                    = 'Create Tax Band'; # Translate

    // Addresses
    $lang['firesale:addresses:title']                       = 'Alamat Saya';
    $lang['firesale:addresses:edit_address']                = 'Edit Alamat';
    $lang['firesale:addresses:new_address']                 = 'Buat Alamat Baru';
    $lang['firesale:addresses:save']                        = 'Simpan';
    $lang['firesale:addresses:cancel']                      = 'Batal';
    $lang['firesale:addresses:no_user']                     = 'Anda harus login untuk dapat mengatur buku alamat';
    $lang['firesale:addresses:add_success']                 = 'Alamat telah dibuat';
    $lang['firesale:addresses:add_error']                   = 'Terjadi kesalahan saat membuat alamat baru';
    $lang['firesale:addresses:edit_success']                = 'Alamat telah diperbaharui';
    $lang['firesale:addresses:edit_error']                  = 'Terjadi kesalahan saat memperbaharui alamat baru';

    // Products Frontend
    $lang['firesale:product:label_availability']            = "Ketersediaan";
    $lang['firesale:product:label_model']                   = "Model";
    $lang['firesale:product:label_product_code']            = "Kode Produk";
    $lang['firesale:product:label_qty']                     = "Qty";
    $lang['firesale:product:label_add_to_cart']             = "Tambahkan ke keranjang";

    // Cart Frontend
    $lang['firesale:cart:label_remove']                     = "Singkirkan";
    $lang['firesale:cart:label_image']                      = "Gambar";
    $lang['firesale:cart:label_name']                       = "Nama";
    $lang['firesale:cart:label_model']                      = "Model"; # Translate
    $lang['firesale:cart:label_quantity']                   = "Quantitas";
    $lang['firesale:cart:label_unit_price']                 = "Harga Unit";
    $lang['firesale:cart:label_total']                      = "Total";
    $lang['firesale:cart:label_no_items_in_cart']           = "Tidak ada item di keranjang";
    $lang['firesale:cart:button_update']                    = "Perbaharui keranjang";
    $lang['firesale:cart:button_goto_checkout']             = "Periksa";
    $lang['firesale:cart:label_sub_total']                  = "Sub-Total";
    $lang['firesale:cart:label_tax']                        = "Pajak";
    $lang['firesale:cart:label_total']                      = "Total";

    //Categories Frontend
    $lang['firesale:categories:grid']                       = 'Grid';
    $lang['firesale:categories:list']                       = 'List';
    $lang['firesale:categories:add_to_basket']              = 'Tambahkan ke Keranjang';

    //Payment Frontend
    $lang['firesale:payment:cancelled']                     = 'Pesanan Dibatalkan';
    $lang['firesale:payment:wait_redirect']                 = 'Silakan tunggu sejenak, kami sedang mengalihkan Anda ke halaman pembayaran...';
    $lang['firesale:payment:btn_continue']                  = 'Lanjutkan';

    // Settings
    $lang['firesale:settings_tax']                          = 'Persentase Pajak';
    $lang['firesale:settings_tax_inst']                     = 'Persentase pajak yang dikenakan pada produk';
    $lang['firesale:settings_currency']                     = 'Kode Mata Uang Dasar';
    $lang['firesale:settings_currency_inst']                = 'Mata uang yang Anda terima (format ISO-4217)';
    $lang['firesale:settings_currency_key']                 = 'API Key Mata Uang';
    $lang['firesale:settings_currency_key_inst']            = 'API Key dari <a target="_blank" href="https://openexchangerates.org/signup/free">Open Exchange Rates</a>';
    $lang['firesale:settings_current_currency']             = 'Mata Uang Saat Ini';
    $lang['firesale:settings_current_currency_inst']        = 'Mata uang saat ini sedang digunakan untuk memperbaharui nilai yang ada bila mata uang dasar diubah';
    $lang['firesale:settings_currency_updated']             = 'Waktu terakhir pembaharuan mata uang';
    $lang['firesale:settings_currency_updated_inst']        = 'Terakhir kali mata uang diperbaharui, API diperbaharui setiap jam dan untuk menjaga batas kelajuan kami hanya mengecek setelah itu';
    $lang['firesale:settings_perpage']                      = 'Produk per Halaman';
    $lang['firesale:settings_perpage_inst']                 = 'Banyak produk yang ditampilkan dalam halaman kategori dan hasil pencarian';
    $lang['firesale:settings_image_square']                 = 'Buat Gambar menjadi Kotak';
    $lang['firesale:settings_image_square_inst']            = 'Beberapa tema tampilan memerlukan gambar kotak untuk menjaga konsistensi tampilan';
    $lang['firesale:settings_image_background']             = 'Warna Latar Gambar';
    $lang['firesale:settings_image_background_inst']        = 'Kode Warna Hexa (tanpa #) untuk gambar yang diubah ukurannya';
    $lang['firesale:settings_login']                        = 'Anda harus login untuk membeli';
    $lang['firesale:settings_login_inst']                   = 'Pastikan pengguna untuk login sebelum membolehkan mereka membeli produk';
    $lang['firesale:settings_dashboard']                    = 'Override Default Dashboard'; # translate
    $lang['firesale:settings_dashboard_inst']               = 'Show the FireSale dashboard instead of the default'; # translate
    $lang['firesale:settings_low']                          = 'Low Stock Level'; # translate
    $lang['firesale:settings_low_inst']                     = 'The number of products remaining before stock is considered low'; # translate
    $lang['firesale:settings_new']                          = 'New Product Time'; # translate
    $lang['firesale:settings_new_inst']                     = 'The time in seconds that a product is considered new'; # translate
    $lang['firesale:settings_basic']                        = 'Basic Checkout View'; # translate
    $lang['firesale:settings_basic_inst']                   = 'Minimal checkout layout, requires a minimal.html layout in your theme'; # translate
    $lang['firesale:settings_disabled']                     = 'Disable Product Sales'; # translate
    $lang['firesale:settings_disabled_inst']                = 'Everything looks normal but nothing can be added to cart or paid for'; # translate
    $lang['firesale:settings_disabled_msg']                 = 'Disabled Message'; # translate
    $lang['firesale:settings_disabled_msg_inst']            = 'A flashdata error shown to users after they attempt to add an item to their cart'; # translate

    // Install errors
    $lang['firesale:install:wrong_version']                 = 'Tidak dapat memasang modul FireSale, FireSale harus menggunakan PyroCMS versi 2.1.4 ke atas';
    $lang['firesale:install:missing_multiple']              = 'FireSale memerlukan tipe field Multiple Relationships untuk dapat berfungsi. Anda dapat mengunduhnya di <a target="_blank" href="https://github.com/adamfairholm/PyroStreams-Multiple-Relationships/zipball/2.0/develop">disini</a>';
    $lang['firesale:install:not_installed']                 = 'Silakan pasang modul FireSale sebelum memasang modul tambahan untuk FireSale';
    $lang['firesale:install:no_route_access']               = 'FireSale memerlukan akses ke file system/cms/config/routes.php. Silakan set permission yang dibutuhkan kemudian coba lagi';
    $lang['firesale:install:old_multiple']                  = 'Your currently installed version of the Multiple field type is out of date, please delete or upgrade it before attempting to use FireSale'; # Translate
