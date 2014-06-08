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
    $lang['firesale:title']         = 'FireSale';
    $lang['firesale:store']         = 'Tienda';
    $lang['firesale:title:general'] = 'General';
    $lang['firesale:title:details'] = 'Sus detalles';
    $lang['firesale:title:address'] = 'Su dirección';
    $lang['firesale:title:bill']    = 'Detalles de facturación';
    $lang['firesale:title:ship']    = 'Detalles de envío';

    // Sections
    $lang['firesale:sections:dashboard']    = 'Tablero';
    $lang['firesale:sections:categories']   = 'Categorías';
    $lang['firesale:sections:products']     = 'Productos';
    $lang['firesale:sections:orders']       = 'Pedidos';
    $lang['firesale:sections:addresses']    = 'Direcciones';
    $lang['firesale:sections:orders_items'] = 'Artículos pedidos';
    $lang['firesale:sections:gateways']     = 'Pasarelas de pago';
    $lang['firesale:sections:settings']     = 'Configuraciones';
    $lang['firesale:sections:routes']       = 'Rutas';
    $lang['firesale:sections:currency']     = 'Moneda';
    $lang['firesale:sections:taxes']        = 'Impuestos';

    // Global Search
    $lang['firesale:product']    = 'Producto';
    $lang['firesale:products']   = 'Productos';
    $lang['firesale:category']   = 'Categoría';
    $lang['firesale:categories'] = 'Categorías';

    // Tabs
    $lang['firesale:tabs:general']     = 'Opciones generales';
    $lang['firesale:tabs:description'] = 'Descripción';
    $lang['firesale:tabs:formatting']  = 'Formato';
    $lang['firesale:tabs:shipping']    = 'Envío';
    $lang['firesale:tabs:metadata']    = 'Metadatos';
    $lang['firesale:tabs:attributes']  = 'Atributos';
    $lang['firesale:tabs:modifiers']   = 'Modificadores';
    $lang['firesale:tabs:images']      = 'Imágenes';
    $lang['firesale:tabs:assignments'] = 'Asignaciones';

    // Shortcuts
    $lang['firesale:shortcuts:prod_create']     = 'Crear producto';
    $lang['firesale:shortcuts:cat_create']      = 'Crear categoría';
    $lang['firesale:shortcuts:install_gateway'] = 'Instalar pasarela de pago';
    $lang['firesale:shortcuts:create_order']    = 'Crear pedido';
    $lang['firesale:shortcuts:create_routes']   = 'Crear ruta';
    $lang['firesale:shortcuts:build_routes']    = 'Reconstruir rutas';
    $lang['firesale:shortcuts:add_tax_band']    = 'Crear impuesto';
    $lang['firesale:shortcuts:assign_taxes']    = 'Asignar impuestos';

    // Dashboard
    $lang['firesale:dash_overview']          = 'Vista rápida';
    $lang['firesale:dash_categorytrack']     = 'Seguimiento de categoría';
    $lang['firesale:elements:product_sales'] = 'Productos vendidos';
    $lang['firesale:elements:low_stock']     = 'Alerta de stock';
    $lang['firesale:dashboard:no_sales']     = 'No hay ventas en los últimos 12 meses';
    $lang['firesale:dashboard:stock_low']    = '%s Productos con bajo stock';
    $lang['firesale:dashboard:stock_out']    = '%s Productos sin stock';
    $lang['firesale:dashboard:no_stock_low'] = 'No hay productos con bajo stock';
    $lang['firesale:dashboard:no_stock_out'] = 'No hay productos agotados';
    $lang['firesale:dashboard:view_more']    = 'Ver más...';
    $lang['firesale:dashbord:low_stock']     = 'Stock bajo';
    $lang['firesale:dashbord:out_of_stock']  = 'Fuera de stock';
    $lang['firesale:dashboard:year']         = 'Año';
    $lang['firesale:dashboard:month']        = 'Mes';
    $lang['firesale:dashboard:week']         = 'Semana';
    $lang['firesale:dashboard:today']        = 'Hoy';
    $lang['firesale:dashboard:sales_in']     = 'en %s venta';

    // Categories
    $lang['firesale:cats_title']                         = 'Administrar categorías';
    $lang['firesale:cats_none']                          = 'No hay categorías';
    $lang['firesale:cats_new']                           = 'Crear categoría';
    $lang['firesale:cats_order']                         = 'Ordenar categorías';
    $lang['firesale:cats_draft_label']                   = 'Borrador';
    $lang['firesale:cats_live_label']                    = 'Publicado';
    $lang['firesale:cats_edit']                          = 'Editar categoría';
    $lang['firesale:cats_edit_title']                    = 'Editar "%s"';
    $lang['firesale:cats_delete']                        = 'Eliminar';
    $lang['firesale:cats_add_success']                   = 'La categoría fue agregada';
    $lang['firesale:cats_add_error']                     = 'Hubo un problema al crear la nueva categoría';
    $lang['firesale:cats_edit_success']                  = 'La categoría fue editada';
    $lang['firesale:cats_edit_error']                    = 'Hubo un problema al editar la categoría';
    $lang['firesale:cats_delete_success']                = 'La categoría fue eliminada';
    $lang['firesale:cats_delete_error']                  = 'Hubo un problema al eliminar la categoría';
    $lang['firesale:cats_all_products']                  = 'Todos los productos';
    $lang['firesale:category:uncategorised']             = 'Sin categoría';
    $lang['firesale:category:uncategorised_slug']        = 'sin-categoria';
    $lang['firesale:category:uncategorised_description'] = 'Ésta es su categoría inical, la cual no puede ser borrada; puede renombrarla si lo desea';

    // Products
    $lang['firesale:prod_none']              = 'No hay productos';
    $lang['firesale:prod_create']            = 'Crear producto';
    $lang['firesale:prod_header']            = 'Editar %t';
    $lang['firesale:prod_title']             = 'Administrar productos';
    $lang['firesale:prod_title_create']      = 'Crear nuevo producto';
    $lang['firesale:prod_title_edit']        = 'Editar producto';
    $lang['firesale:prod_edit_success']      = 'Producto editado';
    $lang['firesale:prod_edit_error']        = 'Falló la edición del producto';
    $lang['firesale:prod_add_success']       = 'Un nuevo producto ha sido agregado';
    $lang['firesale:prod_add_error']         = 'Hubo un problema al editar el nuevo producto';
    $lang['firesale:prod_delete_error']      = 'Hubo un problema al eliminar el producto';
    $lang['firesale:prod_delete_success']    = 'Producto eliminado';
    $lang['firesale:prod_duplicate_error']   = 'Hubo un problema al duplicar el producto';
    $lang['firesale:prod_duplicate_success'] = 'Producto duplicado';
    $lang['firesale:prod_not_found']         = 'El producto no pudo ser encontrado';
    $lang['firesale:prod_delimg_success']    = 'Imagen eliminada';
    $lang['firesale:prod_delimg_error']      = 'Hubo un problema al eliminar la imagen';
    $lang['firesale:prod_button_quick_edit'] = 'Edición rápida';

    // Product Modifiers & Variations
    $lang['firesale:mods:title']          = 'Modificadores';
    $lang['firesale:mods:create_success'] = 'Se ha creado un nuevo modificador';
    $lang['firesale:mods:edit_success']   = 'Modificador editado';
    $lang['firesale:mods:delete_success'] = 'Modificador eliminado';
    $lang['firesale:mods:create_error']   = 'Error al crear el modificador';
    $lang['firesale:mods:edit_error']     = 'Error al editar el modificador';
    $lang['firesale:mods:delete_error']   = 'Error al eliminar el modificador';
    $lang['firesale:mods:create']         = 'Agregar modificador';
    $lang['firesale:mods:edit']           = 'Editar modificador';
    $lang['firesale:mods:none']           = 'No hay modificadores';
    $lang['firesale:mods:nothere']        = 'Puede o no, agregar modificadores a una variante';
    $lang['firesale:vars:title']          = 'Variaciones';
    $lang['firesale:vars:show_set']       = 'Mostrar variaciones';
    $lang['firesale:vars:show_inst']      = '¿Desea mostrar variaciones en las listas y resulados de búsqueda?';
    $lang['firesale:vars:create_success'] = 'La variación fue creada';
    $lang['firesale:vars:edit_success']   = 'Variación editada';
    $lang['firesale:vars:delete_success'] = 'Variación eliminada';
    $lang['firesale:vars:create_error']   = 'Error al crear la variación';
    $lang['firesale:vars:edit_error']     = 'Error al editar la variación';
    $lang['firesale:vars:delete_error']   = 'Error al eliminar la variación';
    $lang['firesale:vars:none']           = 'No se encontraron variaciones';
    $lang['firesale:vars:create']         = 'Agregar variación';
    $lang['firesale:vars:stock_low']      = 'No hay suficiente stock de %s para comprar este elemento';
    $lang['firesale:vars:category']       = 'Construir desde categoría';

    // New Products
    $lang['firesale:new:title']    = 'Nuevos productos';
    $lang['firesale:new:in:title'] = 'Nuevos productos en %s';

    // Instructions
    $lang['firesale:inst_rrp']   = 'Precio de venta antes y después de impuestos';
    $lang['firesale:inst_price'] = 'Precio de venta actual, antes y después de impuestos (Si es menor que PVR, se mostrará el precio de venta)';

    // Labels
    $lang['firesale:label_draft']          = 'Borrador';
    $lang['firesale:label_live']           = 'Publicado';
    $lang['firesale:label_id']             = 'Código de producto';
    $lang['firesale:label_title']          = 'Título';
    $lang['firesale:label_slug']           = 'Slug';
    $lang['firesale:label_status']         = 'Estado';
    $lang['firesale:label_type']           = 'Tipo';
    $lang['firesale:label_description']    = 'Descripción';
    $lang['firesale:label_inst']           = 'Instrucciones';
    $lang['firesale:label_category']       = 'Categoría';
    $lang['firesale:label_parent']         = 'Categoría padre';
    $lang['firesale:label_options']        = 'Opciones';
    $lang['firesale:label_filtercat']      = 'Filtrar por categoría';
    $lang['firesale:label_filtersel']      = 'Seleccionar categoría';
    $lang['firesale:label_filterprod']     = 'Seleccionar producto';
    $lang['firesale:label_filterstatus']   = 'Seleccionar estado de producto ';
    $lang['firesale:label_filtersstatus']  = 'Seleccionar estado de stock';
    $lang['firesale:label_order_status']   = 'Seleccionar estado de pedido';
    $lang['firesale:label_rrp']            = 'Precio de venta recomendado';
    $lang['firesale:label_rrp_tax']        = 'Precio de venta recomendado (antes de impuesto)';
    $lang['firesale:label_rrp_short']      = 'PVR';
    $lang['firesale:label_price']          = 'Precio actual';
    $lang['firesale:label_price_tax']      = 'Precio actual (antes de impuesto)';
    $lang['firesale:label_stock']          = 'Nivel actual de stock';
    $lang['firesale:label_drop_images']    = 'Arrastre imágenes aquí o haga clic para agregar';
    $lang['firesale:label_duplicate']      = 'Duplicar';
    $lang['firesale:label_showfilter']     = 'Mostrar filtros';
    $lang['firesale:label_mod_variant']    = 'Variaciones';
    $lang['firesale:label_mod_input']      = 'Entrada';
    $lang['firesale:label_mod_single']     = 'Producto';
    $lang['firesale:label_mod_price']      = 'Modificador de precio';
    $lang['firesale:label_mod_price_inst'] = 'Algunas instrucciones';
    $lang['firesale:label_buy_now_for']    = 'Comprar ahora por %s';

    $lang['firesale:label_stock_short']     = 'Nivel de stock';
    $lang['firesale:label_stock_status']    = 'Estado de stock';
    $lang['firesale:label_stock_in']        = 'Disponible (en stock)';
    $lang['firesale:label_stock_low']       = 'Últimas unidades';
    $lang['firesale:label_stock_out']       = 'Agotado';
    $lang['firesale:label_stock_order']     = 'En reposición';
    $lang['firesale:label_stock_ended']     = 'Descatalogado';
    $lang['firesale:label_stock_unlimited'] = 'Ilimitado';

    $lang['firesale:label_remove']        = 'Eliminar';
    $lang['firesale:label_image']         = 'Imagen';
    $lang['firesale:label_images']        = 'Imágenes';
    $lang['firesale:label_order']         = 'Orden';
    $lang['firesale:label_gateway']       = 'Método de pago';
    $lang['firesale:label_shipping']      = 'Forma de envío';
    $lang['firesale:label_quantity']      = 'Cantidad';
    $lang['firesale:label_price_total']   = 'Total';
    $lang['firesale:label_price_ship']    = 'Gastos de envío';
    $lang['firesale:label_price_sub']     = 'Sub-total';
    $lang['firesale:label_ship_to']       = 'Enviar a';
    $lang['firesale:label_bill_to']       = 'Facturar a';
    $lang['firesale:label_date']          = 'Fecha';
    $lang['firesale:label_product']       = 'Producto';
    $lang['firesale:label_products']      = 'Productos';
    $lang['firesale:label_company']       = 'Empresa';
    $lang['firesale:label_firstname']     = 'Nombre';
    $lang['firesale:label_lastname']      = 'Apellido';
    $lang['firesale:label_phone']         = 'Teléfono';
    $lang['firesale:label_email']         = 'Correo electrónico';
    $lang['firesale:label_address1']      = 'Dirección 1';
    $lang['firesale:label_address2']      = 'Dirección 2';
    $lang['firesale:label_city']          = 'Ciudad';
    $lang['firesale:label_postcode']      = 'CP';
    $lang['firesale:label_county']        = 'Estado';
    $lang['firesale:label_country']       = 'País';
    $lang['firesale:label_details']       = 'La dirección de envio es igual a la de facturación';
    $lang['firesale:label_user_order']    = 'usuario';
    $lang['firesale:label_ip']            = 'IP Address';
    $lang['firesale:label_ship_req']      = 'Requiere envío';
    $lang['firesale:label_address_title'] = 'Guardar dirección como';

    $lang['firesale:label_nameaz']     = 'Nombre A - Z';
    $lang['firesale:label_nameza']     = 'Nombre Z - A';
    $lang['firesale:label_pricelow']   = 'Precio bajo &gt; alto';
    $lang['firesale:label_pricehigh']  = 'Precio alto &gt; bajo';
    $lang['firesale:label_modelaz']    = 'Modelo A - Z';
    $lang['firesale:label_modelza']    = 'Modelo Z - A';
    $lang['firesale:label_creatednew'] = 'Nuevo - Antiguo';
    $lang['firesale:label_createdold'] = 'Antiguo - Nuevo';

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
    $lang['firesale:label_https']       = 'HTTPS';
    $lang['firesale:label_use_https']   = 'Habilitar HTTPS';

    $lang['firesale:label_cur_code']        = 'Código de moneda';
    $lang['firesale:label_cur_code_inst']   = 'Formato ISO-4217';
    $lang['firesale:label_cur_tax']         = 'Tipo de impuesto';
    $lang['firesale:label_cur_mod']         = 'Modificador actual';
    $lang['firesale:label_cur_mod_inst']    = 'Es posible que desee modificar el tipo de cambio ligeramente para cubrir los costes adicionales asociados con esta región';
    $lang['firesale:label_exch_rate']       = 'Tipo de cambio';
    $lang['firesale:label_exch_rate_inst']  = 'Esto se actualiza automáticamente cada hora y se puede dejar en blanco, ya que será actualizado al guardar';
    $lang['firesale:label_cur_flag']        = 'Imagen relacionada';
    $lang['firesale:label_enabled']         = 'Activado';
    $lang['firesale:label_disabled']        = 'Desactivado';
    $lang['firesale:label_cur_format']      = 'Formato actual';
    $lang['firesale:label_cur_format_inst'] = 'Formato incluyendo símbolo de la moneda, con "{{price}}" donde el valor se muestra, eg: £{{ price }}';
    $lang['firesale:label_cur_format_dec']  = 'Símbolo decimal';
    $lang['firesale:label_cur_format_sep']  = 'Símbolo separador de miles';
    $lang['firesale:label_cur_format_num']  = 'Formato de número';

    $lang['firesale:label_tax_band'] = 'Impuesto';

    // Orders
    $lang['firesale:orders:title']                  = 'Pedidos';
    $lang['firesale:orders:no_orders']              = 'Actualmente no hay pedidos';
    $lang['firesale:orders:my_orders']              = 'Mis pedidos';
    $lang['firesale:orders:view_order']             = 'Ver pedido #%s';
    $lang['firesale:orders:title_create']           = 'Crear pedido';
    $lang['firesale:orders:title_edit']             = 'Editar pedido #%s';
    $lang['firesale:orders:delete_success']         = 'Pedido elimiado';
    $lang['firesale:orders:delete_error']           = 'El pedido no ha sido eliminado debido a un problema';
    $lang['firesale:orders:save_first']             = 'Por favor, guarde el pedido antes de agregar productos';
    $lang['firesale:orders:delete']                 = 'Eliminar pedidos';
    $lang['firesale:orders:mark_as']                = 'Marcar como';
    $lang['firesale:orders:status_unpaid']          = 'No pagado';
    $lang['firesale:orders:status_paid']            = 'Pagado';
    $lang['firesale:orders:status_dispatched']      = 'enviado';
    $lang['firesale:orders:status_processing']      = 'En proceso';
    $lang['firesale:orders:status_refunded']        = 'Reintegrado';
    $lang['firesale:orders:status_cancelled']       = 'Cancelado';
    $lang['firesale:orders:status_failed']          = 'Fallo';
    $lang['firesale:orders:status_declined']        = 'Rechazado';
    $lang['firesale:orders:status_mismatch']        = 'Desajuste';
    $lang['firesale:orders:status_prefunded']       = 'parcialmente reembolsado';
    $lang['firesale:orders:failed_message']         = 'Se ha producido un error al procesar su pago.';
    $lang['firesale:orders:declined_message']       = 'Su pago se ha rechazado, por favor, inténtelo de nuevo.';
    $lang['firesale:orders:mismatch_message']       = 'El pago no corresponde con el pedido.';
    $lang['firesale:orders:logged_in']              = 'Debes identificarte para ver tu historial de pedidos.';
    $lang['firesale:orders:label_view_order']       = 'Ver pedido';
    $lang['firesale:orders:label_products']         = 'Productos';
    $lang['firesale:orders:label_view_order']       = 'Ver pedido';
    $lang['firesale:orders:label_customer']         = 'Cliente';
    $lang['firesale:orders:label_date_placed']      = 'Fecha realización del pedido';
    $lang['firesale:orders:label_order_id']         = "Pedido ID";
    $lang['firesale:orders:label_shipping_address'] = 'Dirección de envío';
    $lang['firesale:orders:label_payment_address']  = 'Dirección de facturación';
    $lang['firesale:orders:label_order_status']     = 'Estado del pedido';
    $lang['firesale:orders:label_message']          = 'Mensaje';

    // Gateways
    $lang['firesale:gateways:admin_title']                  = 'Proveedores de pago';
    $lang['firesale:gateways:install_title']                = 'Instalar proveedor';
    $lang['firesale:gateways:edit_title']                   = 'Editar proveedor';
    $lang['firesale:gateways:installed_title']              = 'Proveedores instalados';
    $lang['firesale:gateways:no_gateways']                  = 'Actualmente no hay proveedores de pago instalados.';
    $lang['firesale:gateways:no_uninstalled_gateways']      = 'Todos los proveedores disponibles están instalados.';
    $lang['firesale:gateways:errors:invalid_bool']          = 'El campo %s debe ser un valor booleano.';
    $lang['firesale:gateways:warning']                      = '¡Todos los ajustes de proveedores se perderán y su tienda puede ser incapaz de recibir pagos! ¿Está seguro que desea desinstalar el proveedor?';
    $lang['firesale:gateways:multiple_warning']             = '¡Todos los ajustes de proveedores podrían perderse y su tienda puede ser incapaz de recibir pagos! ¿Está seguro que desea desinstalar el proveedor?';

    $lang['firesale:gateways:installed_success']            = 'Proveedor de pago instalado';
    $lang['firesale:gateways:installed_fail']               = 'El proveedor de pago no pudo ser instalado';

    $lang['firesale:gateways:uninstalled_success']          = 'El proveedor de pago ha sido desinstalado';
    $lang['firesale:gateways:uninstalled_fail']             = 'El proveedor de pago no se pudo desinstalar';
    $lang['firesale:gateways:multiple_uninstalled_success'] = 'Los proveedores de pago seleccionados se han desinstalado';
    $lang['firesale:gateways:multiple_uninstalled_fail']    = 'Los proveedores de pago seleccionado no pudieron ser instalados';

    $lang['firesale:gateways:multiple_enabled_success']     = 'Los proveedores seleccionados han sido activados';
    $lang['firesale:gateways:multiple_enabled_fail']        = 'Los proveedores seleccionados no pudieron ser activados';
    $lang['firesale:gateways:enabled_success']              = 'El proveedor de pago ha sido activado';
    $lang['firesale:gateways:enabled_fail']                 = 'El proveedor de pago no pudo ser activado';

    $lang['firesale:gateways:disabled_success']             = 'El proveedor de pago ha sido desactivado';
    $lang['firesale:gateways:disabled_fail']                = 'El proveedor de pago no pudo ser desactivado';
    $lang['firesale:gateways:multiple_disabled_success']    = 'Los proveedores seleccionados han sido desactivados';
    $lang['firesale:gateways:multiple_disabled_fail']       = 'Los proveedores seleccionados no pudieron ser desactivados';

    $lang['firesale:gateways:updated_success']              = 'Proveedor de pago actualizado';
    $lang['firesale:gateways:updated_fail']                 = 'El proveedor de pago no pudo ser actualizado';

    // Checkout
    $lang['firesale:gateways:labels:name']            = 'Nombre';
    $lang['firesale:gateways:labels:desc']            = 'Descripción';
    $lang['firesale:cart:title']                      = 'Carrito de la compra';
    $lang['firesale:cart:empty']                      = 'Carrito vacío';
    $lang['firesale:cart:login_required']             = 'Debes estar identificado para poder hacer eso';
    $lang['firesale:cart:qty_too_low']                = 'El nivel de stock es demasiado bajo para añadir esa cantidad a su carrito';
    $lang['firesale:cart:price_changed']              = 'El precio de algunos artículos en su carro ha cambiado, por favor revíselos antes de continuar';
    $lang['firesale:checkout:title']                  = 'Pagar';
    $lang['firesale:checkout:error_callback']         = 'Parece que ha habido un problema con su pedido, por favor, inténtelo de nuevo, posiblemente usando otro método de pago.';
    $lang['firesale:payment:title']                   = 'confirmar los detalles';
    $lang['firesale:payment:title_success']           = 'Pago completo';
    $lang['firesale:checkout:title:ship_method']      = 'Método de envío';
    $lang['firesale:checkout:title:payment_method']   = 'Forma de pago';
    $lang['firesale:checkout:next']                   = 'Siguiente';
    $lang['firesale:checkout:previous']               = 'Anterior';
    $lang['firesale:checkout:select_shipping_method'] = 'Por favor, seleccione su método de envío preferido antes de continuar';
    $lang['firesale:checkout:select_payment_method']  = 'Por favor, seleccione su forma de pago preferida abajo antes de continuar';
    $lang['firesale:checkout:submit_and_pay']         = 'Enviar y pagar';
    $lang['firesale:checkout:shipping_min_price']     = 'El valor total de su compra no alcanza el mínimo necesario para el método de envío seleccionado';
    $lang['firesale:checkout:shipping_max_price']     = 'El valor total de tu compra supera el máximo permitido para el método de envío seleccionado';
    $lang['firesale:checkout:shipping_min_weight']    = 'El peso total de los artículos del carrito no alcanza el mínimo necesario para el método de envío seleccionado';
    $lang['firesale:checkout:shipping_max_weight']    = 'El peso total de los artículos del carrito supera el máximo permitido para el método de envío seleccionado';
    $lang['firesale:checkout:shipping_invalid']       = 'El método de envío seleccionado no es válido';
    $lang['firesale:checkout:address_invalid']        = 'La dirección de envío seleccionada no es válida';
    $lang['firesale:checkout:gateway_invalid']        = 'La forma de pago seleccionada no es válida';

    // Routes
    $lang['firesale:routes:title']          = 'Rutas';
    $lang['firesale:routes:new']            = 'Agregar ruta';
    $lang['firesale:routes:add_success']    = 'Ruta agregada';
    $lang['firesale:routes:add_error']      = 'Error al agregar la ruta';
    $lang['firesale:routes:edit']           = 'Editar ruta %s';
    $lang['firesale:routes:edit_success']   = 'Ruta editada';
    $lang['firesale:routes:edit_error']     = 'Error al editar la ruta';
    $lang['firesale:routes:not_found']      = 'La ruta seleccionada no se encuentra';
    $lang['firesale:routes:none']           = 'No hay rutas';
    $lang['firesale:routes:delete_success'] = 'Ruta eliminada';
    $lang['firesale:routes:delete_error']   = 'Error al eliminar la ruta';
    $lang['firesale:routes:build_success']  = 'El archivo de rutas se ha reconstruído';
    $lang['firesale:routes:build_error']    = 'Hubo un error al reconstruir el archivo de rutas';
    $lang['firesale:routes:write_error']    = 'Acceso denegado: asegúrese que en config/routes.php tenga permisos de escritura e intentelo de nuevo';

    // Route Labels
    $lang['firesale:routes:category_custom'] = 'Personalizar categoría';
    $lang['firesale:routes:category']        = 'Categoría';
    $lang['firesale:routes:product']         = 'Producto';
    $lang['firesale:routes:cart']            = 'Carrito';
    $lang['firesale:routes:order_single']    = 'Pedido';
    $lang['firesale:routes:orders']          = 'Pedidos de usuarios';
    $lang['firesale:routes:addresses']       = 'Dirección de usuarios';
    $lang['firesale:routes:currency']        = 'Moneda';
    $lang['firesale:routes:new_products']    = 'Nuevos productos';

    // Currency
    $lang['firesale:shortcuts:install_currency'] = 'Instalar nueva moneda';
    $lang['firesale:currency:enable']            = 'Activar';
    $lang['firesale:currency:disable']           = 'Desactivar';
    $lang['firesale:currency:disable_warn']      = 'Deshabilitar esto puede causar problemas para los clientes y los pedidos anteriores';
    $lang['firesale:currency:delete']            = 'Eliminar';
    $lang['firesale:currency:delete_warn']       = 'Eliminar esto puede causar problemas para los clientes y los pedidos anteriores';
    $lang['firesale:currency:create']            = 'Crear nueva moneda';
    $lang['firesale:currency:edit']              = 'Editar moneda';
    $lang['firesale:currency:not_found']         = 'La moneda seleccionada no fue encontrada';
    $lang['firesale:currency:add_success']       = 'Moneda agregada';
    $lang['firesale:currency:add_error']         = 'Hubo  un error al agregar la moneda';
    $lang['firesale:currency:edit_success']      = 'Moneda actualizada';
    $lang['firesale:currency:edit_error']        = 'Hubo  un error al actualizar la moneda';
    $lang['firesale:currency:delete_success']    = 'Moneda eliminada';
    $lang['firesale:currency:delete_error']      = 'Hubo  un error al eliminar la moneda';
    $lang['firesale:currency:format_none']       = 'Ninguno';
    $lang['firesale:currency:format_00']         = 'Redondear al siguiente número completo';
    $lang['firesale:currency:format_50']         = 'Redondear cercano a .50';
    $lang['firesale:currency:format_99']         = 'Redondear al más cercano .99';

    // Taxes
    $lang['firesale:taxes:none']                = 'Aún no hay configuración de impuestos';
    $lang['firesale:taxes:new']                 = 'Agregar impuesto';
    $lang['firesale:taxes:edit']                = 'Editar impuesto';
    $lang['firesale:taxes:add_success']         = 'Impuesto creado';
    $lang['firesale:taxes:add_error']           = 'Hubo un error al crear el impuesto';
    $lang['firesale:taxes:edit_success']        = 'Impuesto editado';
    $lang['firesale:taxes:edit_error']          = 'Hubo un error al editar el impuesto';
    $lang['firesale:taxes:assignments_updated'] = 'Asignación de impuesto actualizado';
    $lang['firesale:taxes:add_tax_band']        = 'Crear impuesto';

    // Addresses
    $lang['firesale:addresses:title']        = 'Mi dirección';
    $lang['firesale:addresses:edit_address'] = 'Editar dirección';
    $lang['firesale:addresses:new_address']  = 'Crear nueva dirección';
    $lang['firesale:addresses:save']         = 'Guardar';
    $lang['firesale:addresses:cancel']       = 'Cancelar';
    $lang['firesale:addresses:no_user']      = 'Debes estar registrado para gestionar la libreta de direcciones';
    $lang['firesale:addresses:add_success']  = 'Dirección creada';
    $lang['firesale:addresses:add_error']    = 'Error al crear la dirección';
    $lang['firesale:addresses:edit_success'] = 'Dirección editada';
    $lang['firesale:addresses:edit_error']   = 'Error al editar la dirección';

    // Products Frontend
    $lang['firesale:product:label_availability'] = "Disponibilidad";
    $lang['firesale:product:label_model']        = "Modelo";
    $lang['firesale:product:label_product_code'] = "Código de producto";
    $lang['firesale:product:label_qty']          = "Cant.";
    $lang['firesale:product:label_add_to_cart']  = "Agregar al Carrito";

    // Cart Frontend
    $lang['firesale:cart:label_remove']           = "Eliminar";
    $lang['firesale:cart:label_image']            = "Imagen";
    $lang['firesale:cart:label_name']             = "Nombre";
    $lang['firesale:cart:label_model']            = "Modelo";
    $lang['firesale:cart:label_quantity']         = "Cantidad";
    $lang['firesale:cart:label_unit_price']       = "Precio unitario";
    $lang['firesale:cart:label_total']            = "Total";
    $lang['firesale:cart:label_no_items_in_cart'] = "Carrito vacío";
    $lang['firesale:cart:button_update']          = "Actualizar carrito";
    $lang['firesale:cart:button_goto_checkout']   = "Pagar";
    $lang['firesale:cart:label_sub_total']        = "Sub-Total";
    $lang['firesale:cart:label_tax']              = "Impuestos";
    $lang['firesale:cart:label_total']            = "Total";

    // Categories Frontend
    $lang['firesale:categories:grid']          = 'Cuadrícula';
    $lang['firesale:categories:list']          = 'Lista';
    $lang['firesale:categories:add_to_basket'] = 'Eliminar';

    // Payment Frontend
    $lang['firesale:payment:cancelled']     = 'Pedido cancelado';
    $lang['firesale:payment:wait_redirect'] = 'Por favor, espere mientras se redirige a la página de pago...';
    $lang['firesale:payment:btn_continue']  = 'Continuar';

    // Settings
    $lang['firesale:settings_tax']                   = 'IVA';
    $lang['firesale:settings_tax_inst']              = 'El IVA aplicado al producto';
    $lang['firesale:settings_currency']              = 'Código de moneda por defecto';
    $lang['firesale:settings_currency_inst']         = 'Moneda aceptada (formato ISO-4217)';
    $lang['firesale:settings_currency_key']          = 'Moneda API Key';
    $lang['firesale:settings_currency_key_inst']     = 'API Key desde <a target="_blank" href="https://openexchangerates.org/signup/free">Open Exchange Rates</a>';
    $lang['firesale:settings_current_currency']      = 'Moneda actual';
    $lang['firesale:settings_current_currency_inst'] = 'La moneda actual en uso, que se utiliza para actualizar los valores existentes, si se cambia la moneda por defecto';
    $lang['firesale:settings_currency_updated']      = 'Fecha de la última actualización';
    $lang['firesale:settings_currency_updated_inst'] = 'La última vez que la moneda se ha actualizado. La API se actualiza cada hora';
    $lang['firesale:settings_perpage']               = 'Productos por página';
    $lang['firesale:settings_perpage_inst']          = 'El número de productos que se mostrarán en las páginas de resultados, de búsqueda y de categoría' ;
    $lang['firesale:settings_image_square']          = 'Hacer imágenes cuadradas';
    $lang['firesale:settings_image_square_inst']     = 'Algunos temas pueden requerir imágenes cuadradas para mantener diseños consistentes';
    $lang['firesale:settings_image_background']      = 'Color de fondo de imagen';
    $lang['firesale:settings_image_background_inst'] = 'Color (sin #) hexadecimal';
    $lang['firesale:settings_login']                 = 'Requerir sesión para comprar';
    $lang['firesale:settings_login_inst']            = 'Asegura que un usuario inicie sesión para comprar productos';
    $lang['firesale:settings_dashboard']             = 'Reemplazar panel predeterminado';
    $lang['firesale:settings_dashboard_inst']        = 'Muestra el panel de FireSale en vez del predeterminado';
    $lang['firesale:settings_low']                   = 'Nivel de stock bajo';
    $lang['firesale:settings_low_inst']              = 'El número de productos restantes antes de que el stock se considere bajo';
    $lang['firesale:settings_new']                   = 'Tiempo de producto nuevo';
    $lang['firesale:settings_new_inst']              = 'El tiempo en segundos que un producto es considerado nuevo';
    $lang['firesale:settings_basic']                 = 'Vista de compra mínima';
    $lang['firesale:settings_basic_inst']            = 'Diseño de compra/pago mínima, requiere una plantilla minimal.html en tu tema';
    $lang['firesale:settings_disabled']              = 'Deshabilitar venta de productos';
    $lang['firesale:settings_disabled_inst']         = 'Todo se muestra normalmente pero no se puede agregar nada al carrito de la compra o realizar pagos';
    $lang['firesale:settings_disabled_msg']          = 'Mensaje de deshabilitado';
    $lang['firesale:settings_disabled_msg_inst']     = 'Un error flashdata mostradoa a los usuarios cuando intentan agregar un artículo a su carro de la compra';
    $lang['firesale:settings_assets']                = 'Usar assets de FireSale';
    $lang['firesale:settings_assets_inst']           = 'Incluir los CSS y JS de FireSale en el tema frontal';
    $lang['firesale:settings_api']                   = 'Habilitar la API de FireSale';
    $lang['firesale:settings_api_inst']              = 'Nuestra API está disponible en la mayoría de las páginas del core, simplemente agrega .json o .xml';
    $lang['firesale:settings_api_key']               = 'Clave API de FireSale';
    $lang['firesale:settings_api_key_inst']          = 'La API es public si se deja en blanck, una vez establecida, agrega ?key=<TU CLAVE> para acceder de forma privada';
    $lang['firesale:settings_css_js']                = 'CSS y JS';
    $lang['firesale:settings_css_js_inst']           = 'Usar los archivos CSS y JS de FireSale';

    // Install errors
    $lang['firesale:install:wrong_version']    = 'No se puede instalar el módulo FireSale, FireSale requiere PyroCMS v2.1.5 o superior';
    $lang['firesale:install:missing_multiple'] = 'FireSale requiere: el tipo de campo Multiple Relationships para funcionar. Obtenerlo <a href="https://github.com/adamfairholm/PyroStreams-Multiple-Relationships/zipball/2.0/develop">aquí.</a>';
    $lang['firesale:install:not_installed']    = 'Instale primero el módulo de Firesale antes que los plugins.';
    $lang['firesale:install:no_route_access']  = 'FireSale requiere acceso al archivo: system/cms/config/routes.php. Asegúrese de tener permisos de escritura e inténtelo de nuevo.';
    $lang['firesale:install:old_multiple']     = 'La versión del tipo de campo Multiple Relationships esta desactualizada, actualícela o bórrela antes de continuar con FireSale.';
