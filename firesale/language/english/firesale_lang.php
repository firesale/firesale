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
    $lang['firesale:store']                                 = 'Store';
    $lang['firesale:title:general']                         = 'General';
    $lang['firesale:title:details']                         = 'Your Details';
    $lang['firesale:title:address']                         = 'Your Address';
    $lang['firesale:title:bill']                            = 'Billing Details';
    $lang['firesale:title:ship']                            = 'Shipping Details';

    // Sections
    $lang['firesale:sections:dashboard']                    = 'Dashboard';
    $lang['firesale:sections:categories']                   = 'Categories';
    $lang['firesale:sections:products']                     = 'Products';
    $lang['firesale:sections:orders']                       = 'Orders';
    $lang['firesale:sections:addresses']                    = 'Addresses';
    $lang['firesale:sections:orders_items']                 = 'Order Items';
    $lang['firesale:sections:gateways']                     = 'Gateways';
    $lang['firesale:sections:settings']                     = 'Settings';
    $lang['firesale:sections:routes']                       = 'Routes';
    $lang['firesale:sections:currency']                     = 'Currency';
    $lang['firesale:sections:taxes']                        = 'Taxes';
    $lang['firesale:sections:customers']                    = 'Customers';

    // Global Search
    $lang['firesale:product']                               = 'Product';
    $lang['firesale:products']                              = 'Products';
    $lang['firesale:category']                              = 'Category';
    $lang['firesale:categories']                            = 'Categories';

    // Tabs
    $lang['firesale:tabs:general']                          = 'General Options';
    $lang['firesale:tabs:description']                      = 'Description';
    $lang['firesale:tabs:formatting']                       = 'Formatting';
    $lang['firesale:tabs:shipping']                         = 'Shipping';
    $lang['firesale:tabs:metadata']                         = 'Metadata';
    $lang['firesale:tabs:attributes']                       = 'Attributes';
    $lang['firesale:tabs:modifiers']                        = 'Modifiers';
    $lang['firesale:tabs:images']                           = 'Images';
    $lang['firesale:tabs:assignments']                      = 'Assignments';

    // Shortcuts
    $lang['firesale:shortcuts:prod_create']                 = 'Create Product';
    $lang['firesale:shortcuts:cat_create']                  = 'Create Category';
    $lang['firesale:shortcuts:install_gateway']             = 'Install Gateway';
    $lang['firesale:shortcuts:create_order']                = 'Create Order';
    $lang['firesale:shortcuts:create_routes']               = 'Create Route';
    $lang['firesale:shortcuts:build_routes']                = 'Rebuild Routes';
    $lang['firesale:shortcuts:add_tax_band']                = 'Create Tax Band';
    $lang['firesale:shortcuts:assign_taxes']                = 'Assign Taxes';

    // Dashboard
    $lang['firesale:dash_overview']                         = 'Quick Overview';
    $lang['firesale:dash_categorytrack']                    = 'Category Tracking';
    $lang['firesale:elements:product_sales']                = 'Product Sales';
    $lang['firesale:elements:low_stock']                    = 'Stock Alerts';
    $lang['firesale:dashboard:no_sales']                    = 'No sales found in the last 12 months';
    $lang['firesale:dashboard:stock_low']                   = '%s Products with low stock';
    $lang['firesale:dashboard:stock_out']                   = '%s Products with no stock';
    $lang['firesale:dashboard:no_stock_low']                = 'No low stock products';
    $lang['firesale:dashboard:no_stock_out']                = 'No out of stock products';
    $lang['firesale:dashboard:view_more']                   = 'View more...';
    $lang['firesale:dashbord:low_stock']                    = 'Low Stock';
    $lang['firesale:dashbord:out_of_stock']                 = 'Out of Stock';
    $lang['firesale:dashboard:year']                        = 'Year';
    $lang['firesale:dashboard:month']                       = 'Month';
    $lang['firesale:dashboard:week']                        = 'Week';
    $lang['firesale:dashboard:today']                       = 'Today';
    $lang['firesale:dashboard:sales_in']                    = 'in %s sales';

    // Categories
    $lang['firesale:cats_title']                            = 'Manage Categories';
    $lang['firesale:cats_none']                             = 'No Categories Found';
    $lang['firesale:cats_new']                              = 'Create Category';
    $lang['firesale:cats_order']                            = 'Order categories';
    $lang['firesale:cats_draft_label']                      = 'Draft';
    $lang['firesale:cats_live_label']                       = 'Live';
    $lang['firesale:cats_edit']                             = 'Edit Category';
    $lang['firesale:cats_edit_title']                       = 'Edit "%s"';
    $lang['firesale:cats_delete']                           = 'Delete';
    $lang['firesale:cats_add_success']                      = 'New category was added successfully';
    $lang['firesale:cats_add_error']                        = 'There was a problem adding the new category';
    $lang['firesale:cats_edit_success']                     = 'Category was edited successfully';
    $lang['firesale:cats_edit_error']                       = 'There was a problem editing the category';
    $lang['firesale:cats_delete_success']                   = 'Category was deleted successfully';
    $lang['firesale:cats_delete_error']                     = 'There was a problem deleting that category';
    $lang['firesale:cats_all_products']                     = 'All Products';
    $lang['firesale:category:uncategorised']                = 'Uncategorised';
    $lang['firesale:category:uncategorised_slug']           = 'uncategorised';
    $lang['firesale:category:uncategorised_description']    = 'This is your initial product category, which can\'t be deleted; however you can rename it if you wish.';

    // Products
    $lang['firesale:prod_none']                             = 'No Products Found';
    $lang['firesale:prod_create']                           = 'Create Product';
    $lang['firesale:prod_header']                           = 'Edit %t';
    $lang['firesale:prod_title']                            = 'Manage Products';
    $lang['firesale:prod_title_create']                     = 'Create New Product';
    $lang['firesale:prod_title_edit']                       = 'Edit Product';
    $lang['firesale:prod_edit_success']                     = 'Product edited successfully';
    $lang['firesale:prod_edit_error']                       = 'Product edit failed';
    $lang['firesale:prod_add_success']                      = 'A new product was added successfully';
    $lang['firesale:prod_add_error']                        = 'There was a problem adding a new product';
    $lang['firesale:prod_delete_error']                     = 'There was a problem deleting that product';
    $lang['firesale:prod_delete_success']                   = 'Product deleted successfully';
    $lang['firesale:prod_duplicate_error']                  = 'There was a problem duplicating that product';
    $lang['firesale:prod_duplicate_success']                = 'Product duplicated successfully';
    $lang['firesale:prod_not_found']                        = 'That product cannot be found';
    $lang['firesale:prod_delimg_success']                   = 'Image deleted successfully';
    $lang['firesale:prod_delimg_error']                     = 'There was an error removing the image specified';
    $lang['firesale:prod_button_quick_edit']                = 'Quick Edit';

    // Product Modifiers & Variations
    $lang['firesale:mods:title']                            = 'Modifiers';
    $lang['firesale:mods:create_success']                   = 'New modifier created successfully';
    $lang['firesale:mods:edit_success']                     = 'Modifier edited successfully';
    $lang['firesale:mods:delete_success']                   = 'Modifier deleted successfully';
    $lang['firesale:mods:create_error']                     = 'Error creating new modifier';
    $lang['firesale:mods:edit_error']                       = 'Error editing the modifier';
    $lang['firesale:mods:delete_error']                     = 'Error deleting the modifier';
    $lang['firesale:mods:create']                           = 'Add a Modifier';
    $lang['firesale:mods:edit']                             = 'Edit Modifier';
    $lang['firesale:mods:none']                             = 'No Modifiers Found';
    $lang['firesale:mods:nothere']                          = 'You can\'t add modifiers to a variant';
    $lang['firesale:vars:title']                            = 'Variations';
    $lang['firesale:vars:show_set']                         = 'Show Variations';
    $lang['firesale:vars:show_inst']                        = 'Do you want to show variations on listings and search results?';
    $lang['firesale:vars:create_success']                   = 'New variation created successfully';
    $lang['firesale:vars:edit_success']                     = 'Variation edited successfully';
    $lang['firesale:vars:delete_success']                   = 'Variation deleted successfully';
    $lang['firesale:vars:create_error']                     = 'Error creating new variation';
    $lang['firesale:vars:edit_error']                       = 'Error editing the variation';
    $lang['firesale:vars:delete_error']                     = 'Error deleting the variation';
    $lang['firesale:vars:none']                             = 'No Variations Found';
    $lang['firesale:vars:create']                           = 'Add a Variation';
    $lang['firesale:vars:stock_low']                        = 'Not enough stock of %s to buy this item';
    $lang['firesale:vars:category']                         = 'Build from Category';

    // New Products
    $lang['firesale:new:title']                             = 'New Products';
    $lang['firesale:new:in:title']                          = 'New Products in %s';

    // Customers
    $lang['firesale:cust:title']                            = 'Customers';
    $lang['firesale:cust:all:title']                        = 'All Customers';
    $lang['firesale:cust:char:title']                       = 'Surnames beginning with "%s"';

    // Instructions
    $lang['firesale:inst_rrp']                              = 'Retail price before and after tax';
    $lang['firesale:inst_price']                            = 'Current selling price before and after tax (if lower than RRP, seen as sale price)';

    // Labels
    $lang['firesale:label_draft']                           = 'Draft';
    $lang['firesale:label_live']                            = 'Live';
    $lang['firesale:label_id']                              = 'Product Code';
    $lang['firesale:label_title']                           = 'Title';
    $lang['firesale:label_slug']                            = 'Slug';
    $lang['firesale:label_status']                          = 'Status';
    $lang['firesale:label_type']                            = 'Type';
    $lang['firesale:label_description']                     = 'Description';
    $lang['firesale:label_inst']                            = 'Instructions';
    $lang['firesale:label_category']                        = 'Category';
    $lang['firesale:label_parent']                          = 'Parent Category';
    $lang['firesale:label_options']                         = 'Options';
    $lang['firesale:label_filtercat']                       = 'Filter by Category';
    $lang['firesale:label_filtersel']                       = 'Select a Category';
    $lang['firesale:label_filterprod']                      = 'Select a Product';
    $lang['firesale:label_filterstatus']                    = 'Select a Product Status';
    $lang['firesale:label_filtersstatus']                   = 'Select a Stock Status';
    $lang['firesale:label_order_status']                    = 'Select an Order Status';
    $lang['firesale:label_rrp']                             = 'Recommended Retail Price';
    $lang['firesale:label_rrp_tax']                         = 'Recommended Retail Price (before tax)';
    $lang['firesale:label_rrp_short']                       = 'RRP';
    $lang['firesale:label_price']                           = 'Current Price';
    $lang['firesale:label_price_tax']                       = 'Current Price (before tax)';
    $lang['firesale:label_stock']                           = 'Current Stock Level';
    $lang['firesale:label_drop_images']                     = 'Drop images here or click to upload';
    $lang['firesale:label_duplicate']                       = 'Duplicate';
    $lang['firesale:label_showfilter']                      = 'Show Filters';
    $lang['firesale:label_mod_variant']                     = 'Variation';
    $lang['firesale:label_mod_input']                       = 'Input';
    $lang['firesale:label_mod_single']                      = 'Single Product';
    $lang['firesale:label_mod_price']                       = 'Price Modifier';
    $lang['firesale:label_mod_price_inst']                  = 'Some instructions';

    $lang['firesale:label_stock_short']                     = 'Stock Level';
    $lang['firesale:label_stock_status']                    = 'Stock Status';
    $lang['firesale:label_stock_in']                        = 'In Stock';
    $lang['firesale:label_stock_low']                       = 'Low Stock';
    $lang['firesale:label_stock_out']                       = 'Out of Stock';
    $lang['firesale:label_stock_order']                     = 'More stock ordered';
    $lang['firesale:label_stock_ended']                     = 'Discontinued';
    $lang['firesale:label_stock_unlimited']                 = 'Unlimited';

    $lang['firesale:label_remove']                          = 'Remove';
    $lang['firesale:label_image']                           = 'Image';
    $lang['firesale:label_images']                          = 'Images';
    $lang['firesale:label_order']                           = 'Order';
    $lang['firesale:label_gateway']                         = 'Payment Method';
    $lang['firesale:label_shipping']                        = 'Shipping Method';
    $lang['firesale:label_quantity']                        = 'Quantity';
    $lang['firesale:label_price_total']                     = 'Total Price';
    $lang['firesale:label_price_ship']                      = 'Shipping Cost';
    $lang['firesale:label_price_sub']                       = 'Sub-total';
    $lang['firesale:label_ship_to']                         = 'Shipped to';
    $lang['firesale:label_bill_to']                         = 'Billed to';
    $lang['firesale:label_date']                            = 'Date';
    $lang['firesale:label_product']                         = 'Product';
    $lang['firesale:label_products']                        = 'Products';
    $lang['firesale:label_company']                         = 'Company Name';
    $lang['firesale:label_firstname']                       = 'First Name';
    $lang['firesale:label_lastname']                        = 'Last Name';
    $lang['firesale:label_phone']                           = 'Phone';
    $lang['firesale:label_email']                           = 'Email Address';
    $lang['firesale:label_address1']                        = 'Address Line 1';
    $lang['firesale:label_address2']                        = 'Address Line 2';
    $lang['firesale:label_city']                            = 'City';
    $lang['firesale:label_postcode']                        = 'Postcode';
    $lang['firesale:label_county']                          = 'County';
    $lang['firesale:label_country']                         = 'Country';
    $lang['firesale:label_details']                         = 'My Billing and Shipping addresses are the same';
    $lang['firesale:label_user_order']                      = 'User';
    $lang['firesale:label_ip']                              = 'IP Address';
    $lang['firesale:label_ship_req']                        = 'Requires Shipping';
    $lang['firesale:label_address_title']                   = 'Save Address as';

    $lang['firesale:label_nameaz']                          = 'Name A - Z';
    $lang['firesale:label_nameza']                          = 'Name Z - A';
    $lang['firesale:label_pricelow']                        = 'Price Low &gt; High';
    $lang['firesale:label_pricehigh']                       = 'Price High &gt; Low';
    $lang['firesale:label_modelaz']                         = 'Model A - Z';
    $lang['firesale:label_modelza']                         = 'Model Z - A';
    $lang['firesale:label_creatednew']                      = 'Newest - Oldest';
    $lang['firesale:label_createdold']                      = 'Oldest - Newest';

    $lang['firesale:label_time_now']                        = 'less than a minute ago.';
    $lang['firesale:label_time_min']                        = 'about a minute ago.';
    $lang['firesale:label_time_mins']                       = 'about %s minutes ago.';
    $lang['firesale:label_time_hour']                       = 'about an hour ago.';
    $lang['firesale:label_time_hours']                      = 'about %s hours ago.';
    $lang['firesale:label_time_day']                        = '1 day ago.';
    $lang['firesale:label_time_days']                       = '%s days ago.';

    $lang['firesale:label_map']                             = 'Map';
    $lang['firesale:label_route']                           = 'Route';
    $lang['firesale:label_translation']                     = 'Translation';
    $lang['firesale:label_table']                           = 'Table';
    $lang['firesale:label_https']                           = 'HTTPS';
    $lang['firesale:label_use_https']                       = 'Enable HTTPS';

    $lang['firesale:label_cur_code']                        = 'Currency Code';
    $lang['firesale:label_cur_code_inst']                   = 'ISO-4217 Format';
    $lang['firesale:label_cur_tax']                         = 'Tax Rate';
    $lang['firesale:label_cur_mod']                         = 'Currency Modifier';
    $lang['firesale:label_cur_mod_inst']                    = 'You may wish to modify the exchange rate slightly to cover additional costs associated with this region';
    $lang['firesale:label_exch_rate']                       = 'Exchange Rate';
    $lang['firesale:label_exch_rate_inst']                  = 'This will be automatically updated every hour and can be left blank as it will be updated on save';
    $lang['firesale:label_cur_flag']                        = 'Related Image';
    $lang['firesale:label_enabled']                         = 'Enabled';
    $lang['firesale:label_disabled']                        = 'Disabled';
    $lang['firesale:label_cur_format']                      = 'Currency Format';
    $lang['firesale:label_cur_format_inst']                 = 'Formatting including currency symbol, with "{{ price }}" where the value is shown, eg: £{{ price }}';
    $lang['firesale:label_cur_format_dec']                  = 'Decimal Place Symbol';
    $lang['firesale:label_cur_format_sep']                  = 'Thousand Separator Symbol';
    $lang['firesale:label_cur_format_num']                  = 'Number Formatting';

    $lang['firesale:label_tax_band']                        = 'Tax Band';

    // Orders
    $lang['firesale:orders:title']                          = 'Orders';
    $lang['firesale:orders:no_orders']                      = 'There are currently no orders';
    $lang['firesale:orders:my_orders']                      = 'My Orders';
    $lang['firesale:orders:view_order']                     = 'View Order #%s';
    $lang['firesale:orders:title_create']                   = 'Create Order';
    $lang['firesale:orders:title_edit']                     = 'Edit Order #%s';
    $lang['firesale:orders:delete_success']                 = 'Order deleted successfully';
    $lang['firesale:orders:delete_error']                   = 'Order was not deleted due to an issue';
    $lang['firesale:orders:save_first']                     = 'Please save the order before adding products';
    $lang['firesale:orders:delete']                         = 'Delete Orders';
    $lang['firesale:orders:mark_as']                        = 'Mark as ';
    $lang['firesale:orders:status_unpaid']                  = 'Unpaid';
    $lang['firesale:orders:status_paid']                    = 'Paid';
    $lang['firesale:orders:status_dispatched']              = 'Dispatched';
    $lang['firesale:orders:status_processing']              = 'Processing';
    $lang['firesale:orders:status_refunded']                = 'Refunded';
    $lang['firesale:orders:status_cancelled']               = 'Canceled';
    $lang['firesale:orders:status_failed']                  = 'Failed';
    $lang['firesale:orders:status_declined']                = 'Declined';
    $lang['firesale:orders:status_mismatch']                = 'Mismatch';
    $lang['firesale:orders:status_prefunded']               = 'Partially Refunded';
    $lang['firesale:orders:failed_message']                 = 'There was an error processing your payment';
    $lang['firesale:orders:declined_message']               = 'Your payment was declined, please try again.';
    $lang['firesale:orders:mismatch_message']               = 'Your payment did not match the order.';
    $lang['firesale:orders:logged_in']                      = 'You must be logged in to view your order history.';
    $lang['firesale:orders:label_view_order']               = 'View Order';
    $lang['firesale:orders:label_products']                 = 'Products';
    $lang['firesale:orders:label_view_order']               = 'View Order';
    $lang['firesale:orders:label_customer']                 = 'Customer';
    $lang['firesale:orders:label_date_placed']              = 'Date Placed';
    $lang['firesale:orders:label_order_id']                 = "Order ID";
    $lang['firesale:orders:labe_shipping_address']          = 'Shipping Address';
    $lang['firesale:orders:labe_payment_address']           = 'Payment Address';
    $lang['firesale:orders:label_order_status']             = 'Order Status';
    $lang['firesale:orders:label_message']                  = 'Message';

    // Gateways
    $lang['firesale:gateways:admin_title']                  = 'Payment Gateways';
    $lang['firesale:gateways:install_title']                = 'Install a Gateway';
    $lang['firesale:gateways:edit_title']                   = 'Edit Gateway';
    $lang['firesale:gateways:installed_title']              = 'Installed Gateways';
    $lang['firesale:gateways:no_gateways']                  = 'There are currently no payment gateways installed.';
    $lang['firesale:gateways:no_uninstalled_gateways']      = 'All available gateways are currently installed.';
    $lang['firesale:gateways:errors:invalid_bool']          = 'The %s field must be a boolean value.';
    $lang['firesale:gateways:warning']                      = 'All gateway settings will be lost and your store may be unable to take payments! Are you sure you want to uninstall this gateway?';
    $lang['firesale:gateways:multiple_warning']             = 'All gateway settings will be lost and your store may be unable to take payments! Are you sure you want to uninstall the selected gateways?';

    $lang['firesale:gateways:installed_success']            = 'Gateway successfully installed';
    $lang['firesale:gateways:installed_fail']               = 'The gateway could not be installed';

    $lang['firesale:gateways:uninstalled_success']          = 'Gateway uninstalled successfully';
    $lang['firesale:gateways:uninstalled_fail']             = 'The gateway could not be uninstalled';
    $lang['firesale:gateways:multiple_uninstalled_success'] = 'The selected gateways were successfully uninstalled';
    $lang['firesale:gateways:multiple_uninstalled_fail']    = 'The selected gateways could not be uninstalled';

    $lang['firesale:gateways:multiple_enabled_success']     = 'The selected gateways have been enabled';
    $lang['firesale:gateways:multiple_enabled_fail']        = 'The selected gateways could not be enabled';
    $lang['firesale:gateways:enabled_success']              = 'The gateway has been enabled';
    $lang['firesale:gateways:enabled_fail']                 = 'The gateway could not be enabled';

    $lang['firesale:gateways:disabled_success']             = 'The gateway has been disabled';
    $lang['firesale:gateways:disabled_fail']                = 'The gateway could not be disabled';
    $lang['firesale:gateways:multiple_disabled_success']    = 'The selected gateways were successfully disabled';
    $lang['firesale:gateways:multiple_disabled_fail']       = 'The selected gateways could not be disabled';

    $lang['firesale:gateways:updated_success']              = 'Gateway successfully updated';
    $lang['firesale:gateways:updated_fail']                 = 'The gateway could not be updated';

    // Checkout
    $lang['firesale:gateways:labels:name']                  = 'Name';
    $lang['firesale:gateways:labels:desc']                  = 'Description';
    $lang['firesale:cart:title']                            = 'Shopping Cart';
    $lang['firesale:cart:empty']                            = 'There are currently no items in your cart';
    $lang['firesale:cart:login_required']                   = 'You must be logged in before you can do that';
    $lang['firesale:cart:qty_too_low']                      = 'Stock level is too low to add that quantity to your cart';
    $lang['firesale:cart:price_changed']                    = 'The price of some items in your cart has changed, please check them before continuing';
    $lang['firesale:checkout:title']                        = 'Checkout';
    $lang['firesale:checkout:error_callback']               = 'There seems to have been a problem with your order, please try again, possibly using another payment method.';
    $lang['firesale:payment:title']                         = 'Confirm Details';
    $lang['firesale:payment:title_success']                 = 'Payment Complete';
    $lang['firesale:checkout:title:ship_method']            = 'Shipping Method';
    $lang['firesale:checkout:title:payment_method']         = 'Payment Method';
    $lang['firesale:checkout:next']                         = 'Next';
    $lang['firesale:checkout:previous']                     = 'Previous';
    $lang['firesale:checkout:select_shipping_method']       = 'Please select your preferred shipping method below before continuing';
    $lang['firesale:checkout:select_payment_method']        = 'Please select your preferred payment method below before continuing';
    $lang['firesale:checkout:submit_and_pay']               = 'Submit &amp; Pay';
    $lang['firesale:checkout:shipping_min_price']           = 'The total value of your cart items does not meet the minimum for the selected shipping method';
    $lang['firesale:checkout:shipping_max_price']           = 'The total value of your cart items exceeds the maximum for the selected shipping method';
    $lang['firesale:checkout:shipping_min_weight']          = 'The total weight of your cart items does not meet the minimum for the selected shipping method';
    $lang['firesale:checkout:shipping_max_weight']          = 'The total weight of your cart items exceeds the maximum for the selected shipping method';
    $lang['firesale:checkout:shipping_invalid']             = 'The shipping method you selected is not valid';
    $lang['firesale:checkout:gateway_invalid']              = 'The payment gateway you selected is not valid';

    // Routes
    $lang['firesale:routes:title']                          = 'Routes';
    $lang['firesale:routes:new']                            = 'Add a new Route';
    $lang['firesale:routes:add_success']                    = 'New route added successfully';
    $lang['firesale:routes:add_error']                      = 'Error adding a new route';
    $lang['firesale:routes:edit']                           = 'Edit %s Route';
    $lang['firesale:routes:edit_success']                   = 'Route edited successfully';
    $lang['firesale:routes:edit_error']                     = 'Error editing the route';
    $lang['firesale:routes:not_found']                      = 'The selected route could not be found';
    $lang['firesale:routes:none']                           = 'No routes found';
    $lang['firesale:routes:delete_success']                 = 'Route removed successfully';
    $lang['firesale:routes:delete_error']                   = 'Error removing route';
    $lang['firesale:routes:build_success']                  = 'Successfully rebuilt the routes file';
    $lang['firesale:routes:build_error']                    = 'There was an error rebuilding the routes file';
    $lang['firesale:routes:write_error']                    = 'Access Denied: Please ensure config/routes.php is writable and try again';

    // Route Labels
    $lang['firesale:routes:category_custom']                = 'Category Customisation';
    $lang['firesale:routes:category']                       = 'Category';
    $lang['firesale:routes:product']                        = 'Product';
    $lang['firesale:routes:cart']                           = 'Cart';
    $lang['firesale:routes:order_single']                   = 'Single Order';
    $lang['firesale:routes:orders']                         = 'User Orders';
    $lang['firesale:routes:addresses']                      = 'User Addresses';
    $lang['firesale:routes:currency']                       = 'Currency Switcher';
    $lang['firesale:routes:new_products']                   = 'New Products';

    // Currency
    $lang['firesale:shortcuts:install_currency']            = 'Install new Currency';
    $lang['firesale:currency:enable']                       = 'Enable';
    $lang['firesale:currency:disable']                      = 'Disable';
    $lang['firesale:currency:disable_warn']                 = 'Disabling this may cause issues for customers and previous orders';
    $lang['firesale:currency:delete']                       = 'Delete';
    $lang['firesale:currency:delete_warn']                  = 'Deleting this may cause issues for customers and previous orders';
    $lang['firesale:currency:create']                       = 'Create New Currency';
    $lang['firesale:currency:edit']                         = 'Edit Currency';
    $lang['firesale:currency:not_found']                    = 'Selected currency not found';
    $lang['firesale:currency:add_success']                  = 'New currency added successfully';
    $lang['firesale:currency:add_error']                    = 'There was an error adding the new currency';
    $lang['firesale:currency:edit_success']                 = 'Currency updated successfully';
    $lang['firesale:currency:edit_error']                   = 'There was an error updating that currency';
    $lang['firesale:currency:delete_success']               = 'Currency was deleted successfully';
    $lang['firesale:currency:delete_error']                 = 'There was an error deleting the currency';
    $lang['firesale:currency:format_none']                  = 'None';
    $lang['firesale:currency:format_00']                    = 'Round up to next full number';
    $lang['firesale:currency:format_50']                    = 'Round to closest .50';
    $lang['firesale:currency:format_99']                    = 'Round up to closest .99';

    // Taxes
    $lang['firesale:taxes:none']                            = 'There are currently no tax bands setup';
    $lang['firesale:taxes:new']                             = 'Add tax band';
    $lang['firesale:taxes:edit']                            = 'Edit tax band';
    $lang['firesale:taxes:add_success']                     = 'Tax band created successfully';
    $lang['firesale:taxes:add_error']                       = 'There was an error whilst creating the tax band';
    $lang['firesale:taxes:edit_success']                    = 'Tax band edited successfully';
    $lang['firesale:taxes:edit_error']                      = 'There was an error whilst editing the tax band';
    $lang['firesale:taxes:assignments_updated']             = 'Tax band assignments were updated successfully';
    $lang['firesale:taxes:add_tax_band']                    = 'Create Tax Band';

    // Addresses
    $lang['firesale:addresses:title']                       = 'My Addresses';
    $lang['firesale:addresses:edit_address']                = 'Edit Address';
    $lang['firesale:addresses:new_address']                 = 'Create new Address';
    $lang['firesale:addresses:save']                        = 'Save';
    $lang['firesale:addresses:cancel']                      = 'Cancel';
    $lang['firesale:addresses:no_user']                     = 'You must be logged in to manage your address book';
    $lang['firesale:addresses:add_success']                 = 'Address created successfully';
    $lang['firesale:addresses:add_error']                   = 'Error creating address';
    $lang['firesale:addresses:edit_success']                = 'Address edited successfully';
    $lang['firesale:addresses:edit_error']                  = 'Error editing address';

    // Products Frontend
    $lang['firesale:product:label_availability']            = "Availability";
    $lang['firesale:product:label_model']                   = "Model";
    $lang['firesale:product:label_product_code']            = "Product Code";
    $lang['firesale:product:label_qty']                     = "Qty";
    $lang['firesale:product:label_add_to_cart']             = "Add to Cart";

    // Cart Frontend
    $lang['firesale:cart:label_remove']                     = "Remove";
    $lang['firesale:cart:label_image']                      = "Image";
    $lang['firesale:cart:label_name']                       = "Name";
    $lang['firesale:cart:label_model']                      = "Model";
    $lang['firesale:cart:label_quantity']                   = "Quantity";
    $lang['firesale:cart:label_unit_price']                 = "Unit Price";
    $lang['firesale:cart:label_total']                      = "Total";
    $lang['firesale:cart:label_no_items_in_cart']           = "No items in your cart";
    $lang['firesale:cart:button_update']                    = "Update cart";
    $lang['firesale:cart:button_goto_checkout']             = "Goto Checkout";
    $lang['firesale:cart:label_sub_total']                  = "Sub-Total";
    $lang['firesale:cart:label_tax']                        = "Tax";
    $lang['firesale:cart:label_total']                      = "Total";

    // Categories Frontend
    $lang['firesale:categories:grid']                       = 'Grid';
    $lang['firesale:categories:list']                       = 'List';
    $lang['firesale:categories:add_to_basket']              = 'Add to Basket';

    // Payment Frontend
    $lang['firesale:payment:cancelled']                     = 'Order Canceled';
    $lang['firesale:payment:wait_redirect']                 = 'Please wait while we redirect you to the payment page...';
    $lang['firesale:payment:btn_continue']                  = 'Continue';

    // Settings
    $lang['firesale:settings_tax']                          = 'Tax Percentage';
    $lang['firesale:settings_tax_inst']                     = 'The percentage of tax to be applied to the products';
    $lang['firesale:settings_currency']                     = 'Default Currency Code';
    $lang['firesale:settings_currency_inst']                = 'The currency you accept (ISO-4217 format)';
    $lang['firesale:settings_currency_key']                 = 'Currency API Key';
    $lang['firesale:settings_currency_key_inst']            = 'API Key from <a target="_blank" href="https://openexchangerates.org/signup/free">Open Exchange Rates</a>';
    $lang['firesale:settings_current_currency']             = 'Current Currency';
    $lang['firesale:settings_current_currency_inst']        = 'The current currency in use, used to update existing values if default currency is changed';
    $lang['firesale:settings_currency_updated']             = 'Currency last update time';
    $lang['firesale:settings_currency_updated_inst']        = 'The last time the currency was updated, api is updated every hour and to keep to rate limits we only check after that';
    $lang['firesale:settings_perpage']                      = 'Products per Page';
    $lang['firesale:settings_perpage_inst']                 = 'The number of products to be displayed on category and search result pages';
    $lang['firesale:settings_image_square']                 = 'Make Images Square';
    $lang['firesale:settings_image_square_inst']            = 'Some themes may require square images to keep layouts consistent';
    $lang['firesale:settings_image_background']             = 'Image Background Colour';
    $lang['firesale:settings_image_background_inst']        = 'Hexcode (without #) colour you wish resized image backgrounds to be';
    $lang['firesale:settings_login']                        = 'Require login to purchase';
    $lang['firesale:settings_login_inst']                   = 'Ensure a user is logged in before allowing them to buy products';
    $lang['firesale:settings_dashboard']                    = 'Override Default Dashboard';
    $lang['firesale:settings_dashboard_inst']               = 'Show the FireSale dashboard instead of the default';
    $lang['firesale:settings_low']                          = 'Low Stock Level';
    $lang['firesale:settings_low_inst']                     = 'The number of products remaining before stock is considered low';
    $lang['firesale:settings_new']                          = 'New Product Time';
    $lang['firesale:settings_new_inst']                     = 'The time in seconds that a product is considered new';
    $lang['firesale:settings_basic']                        = 'Basic Checkout View';
    $lang['firesale:settings_basic_inst']                   = 'Minimal checkout layout, requires a minimal.html layout in your theme';
    $lang['firesale:settings_disabled']                     = 'Disable Product Sales';
    $lang['firesale:settings_disabled_inst']                = 'Everything looks normal but nothing can be added to cart or paid for';
    $lang['firesale:settings_disabled_msg']                 = 'Disabled Message';
    $lang['firesale:settings_disabled_msg_inst']            = 'A flashdata error shown to users after they attempt to add an item to their cart';

    // Install errors
    $lang['firesale:install:wrong_version']                 = 'Unable to install the FireSale module, FireSale requires PyroCMS v2.1.5 or above';
    $lang['firesale:install:missing_multiple']              = 'FireSale requires the Multiple Relationships field type to operate. You can download this from <a href="https://github.com/adamfairholm/PyroStreams-Multiple-Relationships/zipball/2.0/develop">here</a>';
    $lang['firesale:install:not_installed']                 = 'Please install the FireSale module before installing additional FireSale add-ons';
    $lang['firesale:install:no_route_access']               = 'FireSale requires access to the system/cms/config/routes.php file. Please set the appropriate permissions and try again';
    $lang['firesale:install:old_multiple']                  = 'Your currently installed version of the Multiple field type is out of date, please delete or upgrade it before attempting to use FireSale';
