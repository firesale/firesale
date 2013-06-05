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
    $lang['firesale:store']         = 'Tienda';
    $lang['firesale:title:general'] = 'General';
    $lang['firesale:title:details'] = 'Sus Detalles';
    $lang['firesale:title:address'] = 'Su Dirección';
    $lang['firesale:title:bill']    = 'Billing Details';
    $lang['firesale:title:ship']    = 'Shipping Details';

    // Sections
    $lang['firesale:sections:dashboard']    = 'Dashboard';
    $lang['firesale:sections:categories']   = 'Categorias';
    $lang['firesale:sections:products']     = 'Productos';
    $lang['firesale:sections:orders']       = 'Pedidos';
    $lang['firesale:sections:addresses']    = 'Direcciones';
    $lang['firesale:sections:orders_items'] = 'Articulos ordenados';
    $lang['firesale:sections:gateways']     = 'Gateways';
    $lang['firesale:sections:settings']     = 'Configuraciones';
    $lang['firesale:sections:routes']       = 'Rutas';
    $lang['firesale:sections:currency']     = 'Moneda';
    $lang['firesale:sections:taxes']        = 'Impuestos';

    // Global Search
    $lang['firesale:product']    = 'Producto';
    $lang['firesale:products']   = 'Productos';
    $lang['firesale:category']   = 'Categoría';
    $lang['firesale:categories'] = 'Categorias';

    // Tabs
    $lang['firesale:tabs:general']     = 'Opciones Generales';
    $lang['firesale:tabs:description'] = 'Descripción';
    $lang['firesale:tabs:formatting']  = 'Formato';
    $lang['firesale:tabs:shipping']    = 'Envio';
    $lang['firesale:tabs:metadata']    = 'Metadata';
    $lang['firesale:tabs:attributes']  = 'Atributos';
    $lang['firesale:tabs:modifiers']   = 'Modificadores';
    $lang['firesale:tabs:images']      = 'Imagenes';
    $lang['firesale:tabs:assignments'] = 'Asignaciones';

    // Shortcuts
    $lang['firesale:shortcuts:prod_create']     = 'Crear Producto';
    $lang['firesale:shortcuts:cat_create']      = 'Crear Categoría';
    $lang['firesale:shortcuts:install_gateway'] = 'Instalar Gateway';
    $lang['firesale:shortcuts:create_order']    = 'Crear Pedido';
    $lang['firesale:shortcuts:create_routes']   = 'Crear Ruta';
    $lang['firesale:shortcuts:build_routes']    = 'Reconstruir Rutas';
    $lang['firesale:shortcuts:add_tax_band']    = 'Create Impuesto';
    $lang['firesale:shortcuts:assign_taxes']    = 'Asignar Impuestos';

    // Dashboard
    $lang['firesale:dash_overview']          = 'Vista rapida';
    $lang['firesale:dash_categorytrack']     = 'Seguimiento de Categoría';
    $lang['firesale:elements:product_sales'] = 'Productos Vendidos';
    $lang['firesale:elements:low_stock']     = 'Alerta de Stock';
    $lang['firesale:dashboard:no_sales']     = 'No hay ventas en los últimos 12 meses';
    $lang['firesale:dashboard:stock_low']    = '%s Productos con bajo stock';
    $lang['firesale:dashboard:stock_out']    = '%s Productos sin stock';
    $lang['firesale:dashboard:no_stock_low'] = 'No hay productos con bajo stock';
    $lang['firesale:dashboard:no_stock_out'] = 'No hay productos agotados';
    $lang['firesale:dashboard:view_more']    = 'Ver más...';
    $lang['firesale:dashbord:low_stock']     = 'Stock Bajo';
    $lang['firesale:dashbord:out_of_stock']  = 'Fuera de Stock';
    $lang['firesale:dashboard:year']         = 'Año';
    $lang['firesale:dashboard:month']        = 'Mes';
    $lang['firesale:dashboard:week']         = 'Semana';
    $lang['firesale:dashboard:today']        = 'Hoy';
    $lang['firesale:dashboard:sales_in']     = 'en %s venta';

    // Categories
    $lang['firesale:cats_title']                         = 'Administrar Categorias';
    $lang['firesale:cats_none']                          = 'No hay Categorias';
    $lang['firesale:cats_new']                           = 'Crear Categoría';
    $lang['firesale:cats_order']                         = 'Ordenar categorias';
    $lang['firesale:cats_draft_label']                   = 'Borrador';
    $lang['firesale:cats_live_label']                    = 'En Vivo';
    $lang['firesale:cats_edit']                          = 'Editar Categoría';
    $lang['firesale:cats_edit_title']                    = 'Editar "%s"';
    $lang['firesale:cats_delete']                        = 'Eliminar';
    $lang['firesale:cats_add_success']                   = 'La categoría fue agregada';
    $lang['firesale:cats_add_error']                     = 'Hubo un problema al crear la nueva categoría';
    $lang['firesale:cats_edit_success']                  = 'La Categoría fue editada';
    $lang['firesale:cats_edit_error']                    = 'Hubo un problema al editar la categoría';
    $lang['firesale:cats_delete_success']                = 'La Categorí fue eliminada';
    $lang['firesale:cats_delete_error']                  = 'Hubo un problema al eliminar la categoría';
    $lang['firesale:cats_all_products']                  = 'Todos Los Productos';
    $lang['firesale:category:uncategorised']             = 'Sin categoría';
    $lang['firesale:category:uncategorised_slug']        = 'sin-categoria';
    $lang['firesale:category:uncategorised_description'] = 'Este es su categoría inical, la cual no puede ser borrada; Puede renombrarla si lo desea';

    // Products
    $lang['firesale:prod_none']              = 'No hay Productos';
    $lang['firesale:prod_create']            = 'Crear Producto';
    $lang['firesale:prod_header']            = 'Editar %t';
    $lang['firesale:prod_title']             = 'Administrar Productos';
    $lang['firesale:prod_title_create']      = 'Crear Nuevo Producto';
    $lang['firesale:prod_title_edit']        = 'Editar Producto';
    $lang['firesale:prod_edit_success']      = 'Producto editado';
    $lang['firesale:prod_edit_error']        = 'Fallo la Edición del Producto';
    $lang['firesale:prod_add_success']       = 'Un nuevo producto ha sido agregado';
    $lang['firesale:prod_add_error']         = 'Hubo un problema al editar el nuevo producto';
    $lang['firesale:prod_delete_error']      = 'Hubo un problema al eliminar el producto';
    $lang['firesale:prod_delete_success']    = 'Producto eliminado';
    $lang['firesale:prod_duplicate_error']   = 'Hubo un problema al duplicar el producto';
    $lang['firesale:prod_duplicate_success'] = 'Producto duplicado';
    $lang['firesale:prod_not_found']         = 'El producto no pudo ser encontrado';
    $lang['firesale:prod_delimg_success']    = 'Imagen eliminada';
    $lang['firesale:prod_delimg_error']      = 'Hubo un problema al remover la imagen';
    $lang['firesale:prod_button_quick_edit'] = 'Edición Rapida';

    // Product Modifiers & Variations
    $lang['firesale:mods:title']          = 'Modificadores';
    $lang['firesale:mods:create_success'] = 'Se ha creado un nuevo modificador';
    $lang['firesale:mods:edit_success']   = 'Modificador editado';
    $lang['firesale:mods:delete_success'] = 'Modificador eliminado';
    $lang['firesale:mods:create_error']   = 'Error al crear el modificador';
    $lang['firesale:mods:edit_error']     = 'Error al editar el modificador';
    $lang['firesale:mods:delete_error']   = 'Error al eliminar el modificador';
    $lang['firesale:mods:create']         = 'Agregar Modificador';
    $lang['firesale:mods:edit']           = 'Editar Modificador';
    $lang['firesale:mods:none']           = 'No hay Modificadores';
    $lang['firesale:mods:nothere']        = 'Puede\ o no, agregar modificadores a una variante';
    $lang['firesale:vars:title']          = 'Variaciones';
    $lang['firesale:vars:show_set']       = 'Mostrar Variaciones';
    $lang['firesale:vars:show_inst']      = 'Desea mostrar variaciones en las listas y resulados de busqueda?';
    $lang['firesale:vars:create_success'] = 'La variación fue creada';
    $lang['firesale:vars:edit_success']   = 'Variación editada';
    $lang['firesale:vars:delete_success'] = 'Variación eliminada';
    $lang['firesale:vars:create_error']   = 'Error al crear la variación';
    $lang['firesale:vars:edit_error']     = 'Error al editar la variación';
    $lang['firesale:vars:delete_error']   = 'Error al eliminar la variación';
    $lang['firesale:vars:none']           = 'No se encontraron variación';
    $lang['firesale:vars:create']         = 'Agreag Variación';
    $lang['firesale:vars:stock_low']      = 'Not enough stock of %s to buy this item'; # translate
    $lang['firesale:vars:category']       = 'Build from Category'; # translate

    // New Products
    $lang['firesale:new:title']    = 'New Products'; # translate
    $lang['firesale:new:in:title'] = 'New Products in %s'; # translate

    // Instructions
    $lang['firesale:inst_rrp']   = 'Precio de venta antes y después de impuestos';
    $lang['firesale:inst_price'] = 'Precio de venta actual, antes y después de impuestos (Si es menor que RRP, se mostrará el precio de venta)';

    // Labels
    $lang['firesale:label_draft']          = 'Borrador';
    $lang['firesale:label_live']           = 'En vivo';
    $lang['firesale:label_id']             = 'Código de Producto';
    $lang['firesale:label_title']          = 'Titulo';
    $lang['firesale:label_slug']           = 'Slug';
    $lang['firesale:label_status']         = 'Status';
    $lang['firesale:label_type']           = 'Tipo';
    $lang['firesale:label_description']    = 'Descripción';
    $lang['firesale:label_inst']           = 'Instrucciones';
    $lang['firesale:label_category']       = 'Categoría';
    $lang['firesale:label_parent']         = 'Categoría Padre';
    $lang['firesale:label_options']        = 'Opciones';
    $lang['firesale:label_filtercat']      = 'Filtrar por Categoría';
    $lang['firesale:label_filtersel']      = 'Seleccionar Categoría';
    $lang['firesale:label_filterprod']     = 'Seleccionar Producto';
    $lang['firesale:label_filterstatus']   = 'Seleccionar Status de Producto ';
    $lang['firesale:label_filtersstatus']  = 'Seleccionar Status de Stock';
    $lang['firesale:label_order_status']   = 'Seleccionar Status de Pedido';
    $lang['firesale:label_rrp']            = 'Precio de venta recomendado';
    $lang['firesale:label_rrp_tax']        = 'Precio de venta recomendado (antes de impuesto)';
    $lang['firesale:label_rrp_short']      = 'RRP';
    $lang['firesale:label_price']          = 'Precio Actual';
    $lang['firesale:label_price_tax']      = 'Precio Actual (antes de impuesto)';
    $lang['firesale:label_stock']          = 'Nivel Actual de Stock';
    $lang['firesale:label_drop_images']    = 'Arrastre imaganes aquí o haga clic para agregar';
    $lang['firesale:label_duplicate']      = 'Duplicar';
    $lang['firesale:label_showfilter']     = 'Mostrar Filtros';
    $lang['firesale:label_mod_variant']    = 'Variaciones';
    $lang['firesale:label_mod_input']      = 'Entrada';
    $lang['firesale:label_mod_single']     = 'Producto';
    $lang['firesale:label_mod_price']      = 'Modificador de Precio';
    $lang['firesale:label_mod_price_inst'] = 'Algunas instrucciones';

    $lang['firesale:label_stock_short']     = 'Nivel de Stock';
    $lang['firesale:label_stock_status']    = 'Status de Stock';
    $lang['firesale:label_stock_in']        = 'En Stock';
    $lang['firesale:label_stock_low']       = 'Stock Bajo';
    $lang['firesale:label_stock_out']       = 'Fuera de Stock';
    $lang['firesale:label_stock_order']     = 'Más stock ordenado';
    $lang['firesale:label_stock_ended']     = 'Descontinuado';
    $lang['firesale:label_stock_unlimited'] = 'Ilimitado';

    $lang['firesale:label_remove']        = 'Remover';
    $lang['firesale:label_image']         = 'Imagen';
    $lang['firesale:label_images']        = 'Imagenes';
    $lang['firesale:label_order']         = 'Orden';
    $lang['firesale:label_gateway']       = 'Metodo de Pago';
    $lang['firesale:label_shipping']      = 'Metodo de Envio';
    $lang['firesale:label_quantity']      = 'Cantidad';
    $lang['firesale:label_price_total']   = 'Total';
    $lang['firesale:label_price_ship']    = 'Costo de Envio';
    $lang['firesale:label_price_sub']     = 'Sub-total';
    $lang['firesale:label_ship_to']       = 'Enviar a';
    $lang['firesale:label_bill_to']       = 'Facturar a';
    $lang['firesale:label_date']          = 'Fecha';
    $lang['firesale:label_product']       = 'Producot';
    $lang['firesale:label_products']      = 'Productos';
    $lang['firesale:label_company']       = 'Empresa';
    $lang['firesale:label_firstname']     = 'Nombre';
    $lang['firesale:label_lastname']      = 'Apellido';
    $lang['firesale:label_phone']         = 'Teléfono';
    $lang['firesale:label_email']         = 'Email';
    $lang['firesale:label_address1']      = 'Dirección 1';
    $lang['firesale:label_address2']      = 'Dirección 2';
    $lang['firesale:label_city']          = 'Ciudad';
    $lang['firesale:label_postcode']      = 'CP';
    $lang['firesale:label_county']        = 'Estado';
    $lang['firesale:label_country']       = 'País';
    $lang['firesale:label_details']       = 'Mi dirección de envio es igual a la de facturación';
    $lang['firesale:label_user_order']    = 'usuario';
    $lang['firesale:label_ip']            = 'IP Address';
    $lang['firesale:label_ship_req']      = 'Requiere Envio';
    $lang['firesale:label_address_title'] = 'Guardr Dirección como';

    $lang['firesale:label_nameaz']     = 'Nombre A - Z';
    $lang['firesale:label_nameza']     = 'Nombre Z - A';
    $lang['firesale:label_pricelow']   = 'Pricio Bajo &gt; Alto';
    $lang['firesale:label_pricehigh']  = 'Price Alto &gt; Bajo';
    $lang['firesale:label_modelaz']    = 'Modelo A - Z';
    $lang['firesale:label_modelza']    = 'Modelo Z - A';
    $lang['firesale:label_creatednew'] = 'Newest - Oldest'; # translate
    $lang['firesale:label_createdold'] = 'Oldest - Newest'; # translate

    $lang['firesale:label_time_now']   = 'menos de un minuto.';
    $lang['firesale:label_time_min']   = 'cerca de un  minuto.';
    $lang['firesale:label_time_mins']  = 'cerca de %s minutos.';
    $lang['firesale:label_time_hour']  = 'cerca de una hora.';
    $lang['firesale:label_time_hours'] = 'cerca de %s horas.';
    $lang['firesale:label_time_day']   = '1 día.';
    $lang['firesale:label_time_days']  = '%s dias.';

    $lang['firesale:label_map']         = 'Mapa';
    $lang['firesale:label_route']       = 'Ruta';
    $lang['firesale:label_translation'] = 'Traslado';
    $lang['firesale:label_table']       = 'Tabla';
    $lang['firesale:label_https']       = 'HTTPS'; # translate
    $lang['firesale:label_use_https']   = 'Enable HTTPS'; # translate

    $lang['firesale:label_cur_code']        = 'Código de moneda';
    $lang['firesale:label_cur_code_inst']   = 'ISO-4217 Format';
    $lang['firesale:label_cur_tax']         = 'Tipo de Impuesto';
    $lang['firesale:label_cur_mod']         = 'Modificador Actual';
    $lang['firesale:label_cur_mod_inst']    = 'Es posible que desee modificar el tipo de cambio ligeramente para cubrir los costos adicionales asociados con esta región';
    $lang['firesale:label_exch_rate']       = 'Tipo de cambio';
    $lang['firesale:label_exch_rate_inst']  = 'Esto se actualiza automáticamente cada hora y se puede dejar en blanco, ya que será actualizado al guardar';
    $lang['firesale:label_cur_flag']        = 'Imagen relacionada';
    $lang['firesale:label_enabled']         = 'Activado';
    $lang['firesale:label_disabled']        = 'Desactivado';
    $lang['firesale:label_cur_format']      = 'Formato Actual';
    $lang['firesale:label_cur_format_inst'] = 'Formateo incluyendo símbolo de la moneda, con "{{price}}" donde el valor se muestra, eg: £{{ price }}';
    $lang['firesale:label_cur_format_dec']  = 'Símbolo decimal';
    $lang['firesale:label_cur_format_sep']  = 'Símbolo separador de miles';
    $lang['firesale:label_cur_format_num']  = 'Formato de Numero';

    $lang['firesale:label_tax_band'] = 'Impuesto';

    // Orders
    $lang['firesale:orders:title']                 = 'Pedidos';
    $lang['firesale:orders:no_orders']             = 'Actualmente no hay pedidos';
    $lang['firesale:orders:my_orders']             = 'Mis Pedidos';
    $lang['firesale:orders:view_order']            = 'Ver Pedido #%s';
    $lang['firesale:orders:title_create']          = 'Crear Pedido';
    $lang['firesale:orders:title_edit']            = 'Editar Pedido #%s';
    $lang['firesale:orders:delete_success']        = 'Pedido elimiado';
    $lang['firesale:orders:delete_error']          = 'El pedido no ha sido eliminada debido a un problema';
    $lang['firesale:orders:save_first']            = 'Por favor, guarde el pedido antes de agregar productos';
    $lang['firesale:orders:delete']                = 'Eliminar Pedidos';
    $lang['firesale:orders:mark_as']               = 'Marcar como';
    $lang['firesale:orders:status_unpaid']         = 'No Pagado';
    $lang['firesale:orders:status_paid']           = 'Pagado';
    $lang['firesale:orders:status_dispatched']     = 'enviado';
    $lang['firesale:orders:status_processing']     = 'En proceso';
    $lang['firesale:orders:status_refunded']       = 'Reintegrado';
    $lang['firesale:orders:status_cancelled']      = 'Cancelado';
    $lang['firesale:orders:status_failed']         = 'Fllo';
    $lang['firesale:orders:status_declined']       = 'Declinado';
    $lang['firesale:orders:status_mismatch']       = 'Desajuste';
    $lang['firesale:orders:status_prefunded']      = 'parcialmente reembolsado';
    $lang['firesale:orders:failed_message']        = 'Se ha producido un error al procesar su pago.';
    $lang['firesale:orders:declined_message']      = 'Su pago se ha rechazado, por favor, inténtelo de nuevo.';
    $lang['firesale:orders:mismatch_message']      = 'El pago no corresponde con el Pedido.';
    $lang['firesale:orders:logged_in']             = 'Debes estar registrado para ver su historial de pedidos.';
    $lang['firesale:orders:label_view_order']      = 'Ver Pedido';
    $lang['firesale:orders:label_products']        = 'Productos';
    $lang['firesale:orders:label_view_order']      = 'Ver Pedido';
    $lang['firesale:orders:label_customer']        = 'Cliente';
    $lang['firesale:orders:label_date_placed']     = 'Fecha Colocada';
    $lang['firesale:orders:label_order_id']        = "Pedido ID";
    $lang['firesale:orders:labe_shipping_address'] = 'Dirección de Envio';
    $lang['firesale:orders:labe_payment_address']  = 'Dirección de Facturación';
    $lang['firesale:orders:label_order_status']    = 'Status de Pedido';
    $lang['firesale:orders:label_message']         = 'Mensaje';

    // Gateways
    $lang['firesale:gateways:admin_title']                  = 'Proveedores de Pago';
    $lang['firesale:gateways:install_title']                = 'Instalar Proveedor';
    $lang['firesale:gateways:edit_title']                   = 'Editar Proveedor';
    $lang['firesale:gateways:installed_title']              = 'Proveedores Instalados';
    $lang['firesale:gateways:no_gateways']                  = 'Actualamnte no ha proveedores de pago instalados.';
    $lang['firesale:gateways:no_uninstalled_gateways']      = 'Todos los proveedores disponibles estan instalados.';
    $lang['firesale:gateways:errors:invalid_bool']          = 'El %s campo debe ser un valor booleano.';
    $lang['firesale:gateways:warning']                      = 'Todos los ajustes de proveedores se perderan y su tienda puede ser incapaz de tomar pagos! Esta seguro que desea desinstalar el proveedor?';
    $lang['firesale:gateways:multiple_warning']             = 'Todos los ajustes de proveedores podrian perderse y su tienda puede ser incapaz de tomar pagos! Esta seguro que desea desinstalar el proveedor? ';

    $lang['firesale:gateways:installed_success']            = 'Proveedor de Pago instalado';
    $lang['firesale:gateways:installed_fail']               = 'El Proveedor de pago no pudo ser instalado';

    $lang['firesale:gateways:uninstalled_success']          = 'El Proveedor de pago ha sido desinstalado';
    $lang['firesale:gateways:uninstalled_fail']             = 'El Proveedor no se pudo desinstalar';
    $lang['firesale:gateways:multiple_uninstalled_success'] = 'Los Proveedores de pago seleccionados se han desinstalado';
    $lang['firesale:gateways:multiple_uninstalled_fail']    = 'Los Proveedores de pago seleccionado no pudo ser instalado';

    $lang['firesale:gateways:multiple_enabled_success']     = 'Los Proveedores selecionados han sido activados';
    $lang['firesale:gateways:multiple_enabled_fail']        = 'Los Proveedores selecionados no pudieron ser activados';
    $lang['firesale:gateways:enabled_success']              = 'El Proveedor de pago ha sido activado';
    $lang['firesale:gateways:enabled_fail']                 = 'El Proveedor de pago no pudo ser activado';

    $lang['firesale:gateways:disabled_success']             = 'El Proveedor de pago ha sido desactivado';
    $lang['firesale:gateways:disabled_fail']                = 'El Proveedor de pago no pudo ser desactivado';
    $lang['firesale:gateways:multiple_disabled_success']    = 'Los Proveedores selecionados han sido desactivados';
    $lang['firesale:gateways:multiple_disabled_fail']       = 'Los Proveedores selecionados no pudo ser desactivados';

    $lang['firesale:gateways:updated_success']              = 'Proveedor de pago actualizado';
    $lang['firesale:gateways:updated_fail']                 = 'El Proveedor de pago no pudo ser actualizado';

    // Checkout
    $lang['firesale:gateways:labels:name']            = 'Nombre';
    $lang['firesale:gateways:labels:desc']            = 'Descripción';
    $lang['firesale:cart:title']                      = 'Carrito de Compras';
    $lang['firesale:cart:empty']                      = 'Carrito vacio';
    $lang['firesale:cart:login_required']             = 'Debe estar registrado para poder hacer eso';
    $lang['firesale:cart:qty_too_low']                = 'El nivel de Stock es demasiado baja para añadir esa cantidad a su carrito';
    $lang['firesale:cart:price_changed']              = 'El precio de algunos artículos en su carro ha cambiado, por favor revíselos antes de continuar';
    $lang['firesale:checkout:title']                  = 'Pagar';
    $lang['firesale:checkout:error_callback']         = 'Parece que ha habido un problema con su pedido, por favor, inténtelo de nuevo, posiblemente usando otro método de pago.';
    $lang['firesale:payment:title']                   = 'confirmar los detalles';
    $lang['firesale:payment:title_success']           = 'Pago completo';
    $lang['firesale:checkout:title:ship_method']      = 'Metodo de Envio';
    $lang['firesale:checkout:title:payment_method']   = 'Metodo de Pago';
    $lang['firesale:checkout:next']                   = 'Siguiente';
    $lang['firesale:checkout:previous']               = 'Anterior';
    $lang['firesale:checkout:select_shipping_method'] = 'Por favor seleccione su método de envío preferido antes de continuar';
    $lang['firesale:checkout:select_payment_method']  = 'Por favor, seleccione su forma de pago preferida abajo antes de continuar';
    $lang['firesale:checkout:submit_and_pay']         = 'Enviar y Pagar';
    $lang['firesale:checkout:shipping_min_price']     = 'The total value of your cart items does not meet the minimum for the selected shipping method';#Translate
    $lang['firesale:checkout:shipping_max_price']     = 'The total value of your cart items exceeds the maximum for the selected shipping method';#Translate
    $lang['firesale:checkout:shipping_min_weight']    = 'The total weight of your cart items does not meet the minimum for the selected shipping method';#Translate
    $lang['firesale:checkout:shipping_max_weight']    = 'The total weight of your cart items exceeds the maximum for the selected shipping method';#Translate
    $lang['firesale:checkout:shipping_invalid']       = 'The shipping method you selected is not valid';#Translate
    $lang['firesale:checkout:gateway_invalid']        = 'The payment gateway you selected is not valid';#Translate

    // Routes
    $lang['firesale:routes:title']          = 'Rutas';
    $lang['firesale:routes:new']            = 'Agregar Ruta';
    $lang['firesale:routes:add_success']    = 'Ruta agregada';
    $lang['firesale:routes:add_error']      = 'Error al agregar la ruta';
    $lang['firesale:routes:edit']           = 'Editar %s Ruta';
    $lang['firesale:routes:edit_success']   = 'Ruta editada';
    $lang['firesale:routes:edit_error']     = 'Error al editar la ruta';
    $lang['firesale:routes:not_found']      = 'La rura selecsionada no se encuentra';
    $lang['firesale:routes:none']           = 'No hay rutas';
    $lang['firesale:routes:delete_success'] = 'Routa removida';
    $lang['firesale:routes:delete_error']   = 'Error al remover la ruta';
    $lang['firesale:routes:build_success']  = 'El archivo rutas se ha reconstruido';
    $lang['firesale:routes:build_error']    = 'Hubo un error al reconstruir el archivo de rutas';
    $lang['firesale:routes:write_error']    = 'Acceso denegado: Asegurese que en: config/routes.php tenga permisos de escritura e intentelo de nuevo';

    // Route Labels
    $lang['firesale:routes:category_custom'] = 'Personalizar Categoría';
    $lang['firesale:routes:category']        = 'Categoría';
    $lang['firesale:routes:product']         = 'Producto';
    $lang['firesale:routes:cart']            = 'Carrito';
    $lang['firesale:routes:order_single']    = 'Pedido';
    $lang['firesale:routes:orders']          = 'Pedidos de usuarios';
    $lang['firesale:routes:addresses']       = 'Dirección de usuarios';
    $lang['firesale:routes:currency']        = 'Moneda';
    $lang['firesale:routes:new_products']    = 'New Products'; # translate

    // Currency
    $lang['firesale:shortcuts:install_currency'] = 'Instalar nueva Moneda';
    $lang['firesale:currency:enable']            = 'Activar';
    $lang['firesale:currency:disable']           = 'Desactivar';
    $lang['firesale:currency:disable_warn']      = 'Deshabilitar esto puede causar problemas para los clientes y los pedidos anteriores';
    $lang['firesale:currency:delete']            = 'Eliminar';
    $lang['firesale:currency:delete_warn']       = 'Eliminar esto puede causar problemas para los clientes y los pedidos anteriores';
    $lang['firesale:currency:create']            = 'Crear Nueva Moneda';
    $lang['firesale:currency:edit']              = 'Editar Moneda';
    $lang['firesale:currency:not_found']         = 'La moneda seleccionada no fue encontrada';
    $lang['firesale:currency:add_success']       = 'Moneda agregada';
    $lang['firesale:currency:add_error']         = 'Hubo  un error al agregar la moneda';
    $lang['firesale:currency:edit_success']      = 'Moneda Actualizada';
    $lang['firesale:currency:edit_error']        = 'Hubo  un error al actualizar la moneda';
    $lang['firesale:currency:delete_success']    = 'Moneda eliminada';
    $lang['firesale:currency:delete_error']      = 'Hubo  un error al eliminar la moneda';
    $lang['firesale:currency:format_none']       = 'Ninguno';
    $lang['firesale:currency:format_00']         = 'Redondear al siguiente número completo';
    $lang['firesale:currency:format_50']         = 'Redondear cercano a .50';
    $lang['firesale:currency:format_99']         = 'Redondear al más cercano .99';

    // Taxes
    $lang['firesale:taxes:none']                = 'Aun no hay configuración de impuestos';
    $lang['firesale:taxes:new']                 = 'Agregar impuesto';
    $lang['firesale:taxes:edit']                = 'Editar impuesto';
    $lang['firesale:taxes:add_success']         = 'Impuesto creado';
    $lang['firesale:taxes:add_error']           = 'Hubo un error al crear el impuesto';
    $lang['firesale:taxes:edit_success']        = 'Impuesto editado';
    $lang['firesale:taxes:edit_error']          = 'Hubo un error al editar el impuesto';
    $lang['firesale:taxes:assignments_updated'] = 'Asignación de impuesto actualizado';
    $lang['firesale:taxes:add_tax_band']        = 'Crear Impuesto';

    // Addresses
    $lang['firesale:addresses:title']        = 'Mi Dirección';
    $lang['firesale:addresses:edit_address'] = 'Editar Dirección';
    $lang['firesale:addresses:new_address']  = 'Crear Nueva Dirección';
    $lang['firesale:addresses:save']         = 'Guardar';
    $lang['firesale:addresses:cancel']       = 'Cancelar';
    $lang['firesale:addresses:no_user']      = 'Debes estar registrado para gestionar la libreta de direcciones';
    $lang['firesale:addresses:add_success']  = 'Dirección creada';
    $lang['firesale:addresses:add_error']    = 'Error al crear la Dirección';
    $lang['firesale:addresses:edit_success'] = 'Dirección editada';
    $lang['firesale:addresses:edit_error']   = 'Error al editar la Dirección';

    // Products Frontend
    $lang['firesale:product:label_availability'] = "Disponibilidad";
    $lang['firesale:product:label_model']        = "Modelo";
    $lang['firesale:product:label_product_code'] = "Código de Producto";
    $lang['firesale:product:label_qty']          = "Cant";
    $lang['firesale:product:label_add_to_cart']  = "Agregar al Carrito";

    // Cart Frontend
    $lang['firesale:cart:label_remove']           = "Remover";
    $lang['firesale:cart:label_image']            = "Imagen";
    $lang['firesale:cart:label_name']             = "Nombre";
    $lang['firesale:cart:label_model']            = "Modelo";
    $lang['firesale:cart:label_quantity']         = "Cantidad";
    $lang['firesale:cart:label_unit_price']       = "Precio unitario";
    $lang['firesale:cart:label_total']            = "Total";
    $lang['firesale:cart:label_no_items_in_cart'] = "Carrito vacio";
    $lang['firesale:cart:button_update']          = "Actualizar carrito";
    $lang['firesale:cart:button_goto_checkout']   = "Pagar";
    $lang['firesale:cart:label_sub_total']        = "Sub-Total";
    $lang['firesale:cart:label_tax']              = "Impuesto";
    $lang['firesale:cart:label_total']            = "Total";

    // Categories Frontend
    $lang['firesale:categories:grid']          = 'Grid';
    $lang['firesale:categories:list']          = 'Lista';
    $lang['firesale:categories:add_to_basket'] = 'Eliminar';

    // Payment Frontend
    $lang['firesale:payment:cancelled']                  = 'Pedido Cancelado';
    $lang['firesale:payment:wait_redirect'] = 'Por favor, espere mientras se redirige a la página de pago...';
    $lang['firesale:payment:btn_continue']  = 'Continuar';

    // Settings
    $lang['firesale:settings_tax']                   = 'Iva';
    $lang['firesale:settings_tax_inst']              = 'El iva aplicado al producto';
    $lang['firesale:settings_currency']              = 'Código de Moneda por Defecto';
    $lang['firesale:settings_currency_inst']         = 'La moneda acepta (ISO-4217 format)';
    $lang['firesale:settings_currency_key']          = 'Moneda API Key';
    $lang['firesale:settings_currency_key_inst']     = 'API Key desde <a target="_blank" href="https://openexchangerates.org/signup/free">Open Exchange Rates</a>';
    $lang['firesale:settings_current_currency']      = 'Moneda Actual';
    $lang['firesale:settings_current_currency_inst'] = 'La moneda actual en uso, que se utiliza para actualizar los valores existentes, si se cambia la moneda por defecto';
    $lang['firesale:settings_currency_updated']      = 'Fecha de la última actualización';
    $lang['firesale:settings_currency_updated_inst'] = 'La última vez que la moneda se ha actualizado, api se actualiza cada hora';
    $lang['firesale:settings_perpage']               = 'Productos por Página';
    $lang['firesale:settings_perpage_inst']          = 'El número de productos que se mostrarán en las páginas de resultados, de búsqueda y de categoría' ;
    $lang['firesale:settings_image_square']          = 'Hacer imagenes cuadradas';
    $lang['firesale:settings_image_square_inst']     = 'Algunos temas pueden requerir imágenes cuadradas para mantener diseños consistentes';
    $lang['firesale:settings_image_background']      = 'Color de fondo de imagen';
    $lang['firesale:settings_image_background_inst'] = 'Color (sin #) Hezadecimal';
    $lang['firesale:settings_login']                 = 'Requerir sesión para comprar';
    $lang['firesale:settings_login_inst']            = 'Asegura que un usuario inicie sesión para comprar productos';
    $lang['firesale:settings_dashboard']             = 'Reemplazar panel predeterminado';
    $lang['firesale:settings_dashboard_inst']        = 'Muestra el Panel de FireSale en vez del predeterminado';
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
    $lang['firesale:install:wrong_version']    = 'No se puede instalar el módulo firesale, FireSale requiere PyroCMS v2.1.5 or superior';
    $lang['firesale:install:missing_multiple'] = 'FireSale requiere: Multiple Relationships field type para funcionar. Obtenerlo <a href="https://github.com/adamfairholm/PyroStreams-Multiple-Relationships/zipball/2.0/develop">aquí.</a>';
    $lang['firesale:install:not_installed']    = 'Installe primero el Modulo de Firesale antes que los plugins.';
    $lang['firesale:install:no_route_access']  = 'FireSale requiere acceso al archivo: system/cms/config/routes.php. Asegurese de tener permisos de escritura y trate de nuevo.';
    $lang['firesale:install:old_multiple']     = 'La versión de Multiple field type esta desactualizada, actualicela o borrela antes de continuar con firesale.';
