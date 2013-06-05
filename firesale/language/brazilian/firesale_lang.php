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
    $lang['firesale:title:general']                         = 'Geral';
    $lang['firesale:title:details']                         = 'Seus Detalhes';
    $lang['firesale:title:address']                         = 'Seu endereço';
    $lang['firesale:title:bill']                            = 'Detalhes para Cobrança';
    $lang['firesale:title:ship']                            = 'Detalhes para Entrega';

    // Sections
    $lang['firesale:sections:dashboard']                    = 'Painel de Controle';
    $lang['firesale:sections:categories']                   = 'Categorias';
    $lang['firesale:sections:products']                     = 'Produtos';
    $lang['firesale:sections:orders']                       = 'Pedidos';
    $lang['firesale:sections:addresses']                    = 'Endereços';
    $lang['firesale:sections:orders_items']                 = 'Items adquiridos';
    $lang['firesale:sections:gateways']                     = 'Meios de Pagamento';
    $lang['firesale:sections:settings']                     = 'Configurações';
    $lang['firesale:sections:routes']                       = 'Routes'; # Translate
    $lang['firesale:sections:currency']                     = 'Currency'; # translate
    $lang['firesale:sections:taxes']                        = 'Taxes'; #Translate

    // Global Search
    $lang['firesale:product']                               = 'Product'; # Translate
    $lang['firesale:products']                              = 'Products'; # Translate
    $lang['firesale:category']                              = 'Category'; # Translate
    $lang['firesale:categories']                            = 'Categories'; # Translate

    // Tabs
    $lang['firesale:tabs:general']                          = 'Opções Gerais';
    $lang['firesale:tabs:description']                      = 'Descrições';
    $lang['firesale:tabs:formatting']                       = 'Formatting'; # translate
    $lang['firesale:tabs:shipping']                         = 'Envio';
    $lang['firesale:tabs:metadata']                         = 'Metadata';
    $lang['firesale:tabs:attributes']                       = 'Atributos';
    $lang['firesale:tabs:modifiers']                        = 'Modifiers'; # translate
    $lang['firesale:tabs:images']                           = 'Imagens';
    $lang['firesale:tabs:assignments']                      = 'Assignments'; #Translate

    // Shortcuts
    $lang['firesale:shortcuts:prod_create']                 = 'Criar Produto';
    $lang['firesale:shortcuts:cat_create']                  = 'Criar Categoria';
    $lang['firesale:shortcuts:install_gateway']             = 'Instalar Meio de Pagamento';
    $lang['firesale:shortcuts:create_order']                = 'Criar Pedido';
    $lang['firesale:shortcuts:create_routes']               = 'Add a New Route'; # Translate
    $lang['firesale:shortcuts:build_routes']                = 'Rebuild Routes'; # Translate
    $lang['firesale:shortcuts:add_tax_band']                = 'Add Tax Band';  # Translate
    $lang['firesale:shortcuts:assign_taxes']                = 'Assign Taxes'; # Translate

    // Dashboard
    $lang['firesale:dash_overview']                         = 'Visualização Rápida';
    $lang['firesale:dash_categorytrack']                    = 'Monitorar Categoria';
    $lang['firesale:elements:product_sales']                = 'Vendas de Produtos';
    $lang['firesale:elements:low_stock']                    = 'Alerta de Estoque';
    $lang['firesale:dashboard:no_sales']                    = 'Nenhuma venda encontrada nos últimos 12 meses';
    $lang['firesale:dashboard:stock_low']                   = '%s Produtos listados no estoque mínimo';
    $lang['firesale:dashboard:stock_out']                   = '%s Produtos sem estoque';
    $lang['firesale:dashboard:no_stock_low']                = 'Produtos sem estoque mínimo';
    $lang['firesale:dashboard:no_stock_out']                = 'Nenhum produto sem estoque';
    $lang['firesale:dashboard:view_more']                   = 'Ver mais...';
    $lang['firesale:dashbord:low_stock']                    = 'Baixo estoque';
    $lang['firesale:dashbord:out_of_stock']                 = 'Sem estoque';
    $lang['firesale:dashboard:year']                        = 'Year'; # Translate
    $lang['firesale:dashboard:month']                       = 'Month'; # Translate
    $lang['firesale:dashboard:week']                        = 'Week'; # Translate
    $lang['firesale:dashboard:today']                       = 'Today'; # Translate
    $lang['firesale:dashboard:sales_in']                    = 'in %s sales'; # Translate

    // Categories
    $lang['firesale:cats_title']                            = 'Gerenciar Categorias';
    $lang['firesale:cats_none']                             = 'Categorias não encontradas';
    $lang['firesale:cats_new']                              = 'Adicionar nova categoria';
    $lang['firesale:cats_order']                            = 'Categorias - ordem';
    $lang['firesale:cats_draft_label']                      = 'Rascunho';
    $lang['firesale:cats_live_label']                       = 'Publicado';
    $lang['firesale:cats_edit']                             = 'Editar Categoria';
    $lang['firesale:cats_edit_title']                       = 'Editar "%s"';
    $lang['firesale:cats_delete']                           = 'Remover';
    $lang['firesale:cats_add_success']                      = 'Nova categoria incluída com sucesso';
    $lang['firesale:cats_add_error']                        = 'Ocorreu um erro ao adicionar sua nova categoria';
    $lang['firesale:cats_edit_success']                     = 'Categoria alterada com sucesso';
    $lang['firesale:cats_edit_error']                       = 'Ocorreu um erro ao editar sua categoria';
    $lang['firesale:cats_delete_success']                   = 'Categoria excluída com sucesso';
    $lang['firesale:cats_delete_error']                     = 'Ocorreu um erro ao excluir esta categoria';
    $lang['firesale:cats_all_products']                     = 'All Products'; # Translate
    $lang['firesale:category:uncategorised']                = 'Uncategorised';# Translate
    $lang['firesale:category:uncategorised_slug']           = 'uncategorised';# Translate
    $lang['firesale:category:uncategorised_description']    = 'This is your initial product category, which can\'t be deleted; however you can rename it if you wish.';# Translate

    // Products
    $lang['firesale:prod_none']                             = 'Produtos não encontrados';
    $lang['firesale:prod_create']                           = 'Criar produto';
    $lang['firesale:prod_header']                           = 'Editar %t';
    $lang['firesale:prod_title']                            = 'Gerenciar Produtos';
    $lang['firesale:prod_title_create']                     = 'Criar Novo Produto';
    $lang['firesale:prod_title_edit']                       = 'Editar Produto';
    $lang['firesale:prod_edit_success']                     = 'Produto Editado com sucesso';
    $lang['firesale:prod_edit_error']                       = 'Falha ao editar produto';
    $lang['firesale:prod_add_success']                      = 'Novo produto incluído com sucesso';
    $lang['firesale:prod_add_error']                        = 'Ocorreu um erro ao adicionar o novo produto';
    $lang['firesale:prod_delete_error']                     = 'Ocorreu um erro ao excluir este produto';
    $lang['firesale:prod_delete_success']                   = 'Produto excluído com sucesso';
    $lang['firesale:prod_duplicate_error']                  = 'Ocorreu um erro ao duplicar este produto';
    $lang['firesale:prod_duplicate_success']                = 'Produto duplicado com sucesso';
    $lang['firesale:prod_not_found']                        = 'Este produto nao pode ser encontrado';
    $lang['firesale:prod_delimg_success']                   = 'Imagem removida com sucesso';
    $lang['firesale:prod_delimg_error']                     = 'Ocorreu um erro ao remover a imagem selecionada';
    $lang['firesale:prod_button_quick_edit']                = 'Edição Rápida';

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
    $lang['firesale:new:title']                             = 'New Products';
    $lang['firesale:new:in:title']                          = 'New Products in %s'; # translate

    // Instructions
    $lang['firesale:inst_rrp']                              = 'Preço de venda antes e após impostos';
    $lang['firesale:inst_price']                            = 'Preço de venda antes e após taxas. (Se abaixo do preço do fornecedor, será exibido como preço de venda)';

    // Labels
    $lang['firesale:label_draft']                           = 'Rascunho';
    $lang['firesale:label_live']                            = 'Ativo';
    $lang['firesale:label_id']                              = 'Códito do Produto';
    $lang['firesale:label_title']                           = 'Título';
    $lang['firesale:label_slug']                            = 'Abreviatura';
    $lang['firesale:label_status']                          = 'Situação';
    $lang['firesale:label_type']                            = 'Type'; # translate
    $lang['firesale:label_description']                     = 'Descrição';
    $lang['firesale:label_inst']                            = 'Instructions'; # translate
    $lang['firesale:label_category']                        = 'Categoria';
    $lang['firesale:label_parent']                          = 'Categoria Pai';
    $lang['firesale:label_options']                         = 'Options'; # translate
    $lang['firesale:label_filtercat']                       = 'Filtrar por Categoria';
    $lang['firesale:label_filtersel']                       = 'Selecionar Categoria';
    $lang['firesale:label_filterprod']                      = 'Select a Product'; # translate
    $lang['firesale:label_filterstatus']                    = 'Select a Product Status'; # translate
    $lang['firesale:label_filtersstatus']                   = 'Select a Stock Status'; # translate
    $lang['firesale:label_order_status']                    = 'Select an Order Status'; # translate
    $lang['firesale:label_rrp']                             = 'Preço de Venda Recomendado';
    $lang['firesale:label_rrp_tax']                         = 'Preço de Venda Recomendado (sem impostos)';
    $lang['firesale:label_rrp_short']                       = 'PVR';
    $lang['firesale:label_price']                           = 'Preço Atual';
    $lang['firesale:label_price_tax']                       = 'Preço Atual (sem impostos)';
    $lang['firesale:label_stock']                           = 'Quantidade em Estoque';
    $lang['firesale:label_drop_images']                     = 'Solte suas imagens aqui para realizar o upload';
    $lang['firesale:label_duplicate']                       = 'Duplicado';
    $lang['firesale:label_showfilter']                      = 'Show Filters'; # Translate
    $lang['firesale:label_mod_variant']                     = 'Variant'; # translate
    $lang['firesale:label_mod_input']                       = 'Input'; # translate
    $lang['firesale:label_mod_single']                      = 'Single Product'; # translate
    $lang['firesale:label_mod_price']                       = 'Price Modifier'; # translate
    $lang['firesale:label_mod_price_inst']                  = 'Some instructions'; # translate

    $lang['firesale:label_stock_short']                     = 'Estoque';
    $lang['firesale:label_stock_status']                    = 'Situaçao do Estoque';
    $lang['firesale:label_stock_in']                        = 'Em estoque';
    $lang['firesale:label_stock_low']                       = 'Estoque baixo';
    $lang['firesale:label_stock_out']                       = 'Sem estoque';
    $lang['firesale:label_stock_order']                     = 'Estoque solicitado';
    $lang['firesale:label_stock_ended']                     = 'Descontinuado';
    $lang['firesale:label_stock_unlimited']                 = 'Ilimitado';

    $lang['firesale:label_remove']                          = 'Remover';
    $lang['firesale:label_image']                           = 'Imagem';
    $lang['firesale:label_images']                          = 'Imagens';
    $lang['firesale:label_order']                           = 'Pedidos';
    $lang['firesale:label_gateway']                         = 'Método de Pagamento';
    $lang['firesale:label_shipping']                        = 'Método de Entrega';
    $lang['firesale:label_quantity']                        = 'Quantidade';
    $lang['firesale:label_price_total']                     = 'Preço Total';
    $lang['firesale:label_price_ship']                      = 'Custo do frete';
    $lang['firesale:label_price_sub']                       = 'Sub-total';
    $lang['firesale:label_ship_to']                         = 'Enviado para';
    $lang['firesale:label_bill_to']                         = 'Cobrado de';
    $lang['firesale:label_date']                            = 'Data';
    $lang['firesale:label_product']                         = 'Produto';
    $lang['firesale:label_products']                        = 'Produtos';
    $lang['firesale:label_company']                         = 'Nome da Companhia';
    $lang['firesale:label_firstname']                       = 'Primeiro Nome';
    $lang['firesale:label_lastname']                        = 'Último Nome';
    $lang['firesale:label_phone']                           = 'Telefone';
    $lang['firesale:label_email']                           = 'Endereço de Email';
    $lang['firesale:label_address1']                        = 'Endereço - Linha 1';
    $lang['firesale:label_address2']                        = 'Endereço - Linha 2';
    $lang['firesale:label_city']                            = 'Cidade';
    $lang['firesale:label_postcode']                        = 'Código Postal';
    $lang['firesale:label_county']                          = 'País';
    $lang['firesale:label_country']                         = 'País';
    $lang['firesale:label_details']                         = 'Meu Endereço de Cobrança e Entrega são os mesmos';
    $lang['firesale:label_user_order']                      = 'Usuário';
    $lang['firesale:label_ip']                              = 'Endereço IP';
    $lang['firesale:label_ship_req']                        = 'Requires Shipping'; # Translate
    $lang['firesale:label_address_title']                   = 'Save Address as'; # Translate

    $lang['firesale:label_nameaz']                          = 'Nome A - Z';
    $lang['firesale:label_nameza']                          = 'Nome Z - A';
    $lang['firesale:label_pricelow']                        = 'Preço Menor &gt; Maior';
    $lang['firesale:label_pricehigh']                       = 'Preço Maior &gt; Menor';
    $lang['firesale:label_modelaz']                         = 'Modelo A - Z';
    $lang['firesale:label_modelza']                         = 'Modelo Z - A';
    $lang['firesale:label_creatednew']                      = 'Newest - Oldest'; # translate
    $lang['firesale:label_createdold']                      = 'Oldest - Newest'; # translate

    $lang['firesale:label_time_now']                        = 'Menos de um minuto atrás.';
    $lang['firesale:label_time_min']                        = 'Por volta de um minuto atrás.';
    $lang['firesale:label_time_mins']                       = 'Por volta de %s minutos atrás.';
    $lang['firesale:label_time_hour']                       = 'Por volta de 1 hora atrás.';
    $lang['firesale:label_time_hours']                      = 'Por volta de %s horas atrás.';
    $lang['firesale:label_time_day']                        = '1 dia atrás.';
    $lang['firesale:label_time_days']                       = '%s dias atrás.';

    $lang['firesale:label_map']                             = 'Map'; # Translate
    $lang['firesale:label_route']                           = 'Route'; # Translate
    $lang['firesale:label_translation']                     = 'Translation'; # Translate
    $lang['firesale:label_table']                           = 'Table'; # Translate
    $lang['firesale:label_https']                           = 'HTTPS'; # Translate
    $lang['firesale:label_use_https']                       = 'Enable HTTPS'; # Translate
    
    $lang['firesale:label_cur_code']                        = 'Currency Code'; # translate
    $lang['firesale:label_cur_code_inst']                   = 'ISO-4217 Format'; # translate
    $lang['firesale:label_cur_tax']                         = 'Tax Rate'; # translate
    $lang['firesale:label_cur_mod']                         = 'Currency Modifier'; # translate
    $lang['firesale:label_cur_mod_inst']                    = 'You may wish to modify the exchange rate slightly to cover additional costs associated with this region'; # translate
    $lang['firesale:label_exch_rate']                       = 'Exchange Rate'; # translate
    $lang['firesale:label_exch_rate_inst']                  = 'This will be automatically updated every hour and can be left blank as it will be updated on save'; # translate
    $lang['firesale:label_cur_flag']                        = 'Related Image'; # translate
    $lang['firesale:label_enabled']                         = 'Enabled'; # translate
    $lang['firesale:label_disabled']                        = 'Disabled'; # translate
    $lang['firesale:label_cur_format']                      = 'Currency Format'; # translate
    $lang['firesale:label_cur_format_inst']                 = 'Formatting including currency symbol, with "{{ price }}" where the value is shown, eg: £{{ price }}'; # translate
    $lang['firesale:label_cur_format_dec']                  = 'Decimal Place Symbol'; # translate
    $lang['firesale:label_cur_format_sep']                  = 'Thousand Seperator Symbol'; # translate
    $lang['firesale:label_cur_format_num']                  = 'Number Formatting'; # translate

    $lang['firesale:label_tax_band']                        = 'Tax Band'; #Translate

    // Orders
    $lang['firesale:orders:title']                          = 'Pedidos';
    $lang['firesale:orders:no_orders']                      = 'Sem pedidos no momento';
    $lang['firesale:orders:my_orders']                      = 'Meus Pedidos';
    $lang['firesale:orders:view_order']                     = 'Visualizar pedidos #%s';
    $lang['firesale:orders:title_create']                   = 'Criar Pedido';
    $lang['firesale:orders:title_edit']                     = 'Editar Pedido #%s';
    $lang['firesale:orders:delete_success']                 = 'Pedido excluído com sucesso';
    $lang['firesale:orders:delete_error']                   = 'Pedido não excluído devido a um erro';
    $lang['firesale:orders:save_first']                     = 'Por favor, salve o pedido antes de incluir produtos.';
    $lang['firesale:orders:delete']                         = 'Excluir Pedidos';
    $lang['firesale:orders:mark_as']                        = 'Marcar como ';
    $lang['firesale:orders:status_unpaid']                  = 'Não Pago';
    $lang['firesale:orders:status_paid']                    = 'Pago';
    $lang['firesale:orders:status_dispatched']              = 'Enviado';
    $lang['firesale:orders:status_processing']              = 'Processando';
    $lang['firesale:orders:status_refunded']                = 'Reembolsado';
    $lang['firesale:orders:status_cancelled']               = 'Cancelado';
    $lang['firesale:orders:status_failed']                  = 'Falha no Processamento';
    $lang['firesale:orders:status_declined']                = 'Rejeitado';
    $lang['firesale:orders:status_mismatch']                = 'Incompatível';
    $lang['firesale:orders:status_prefunded']               = 'Partially Refunded'; # Translate
    $lang['firesale:orders:failed_message']                 = 'Ocorreu um erro no seu pagamento';
    $lang['firesale:orders:declined_message']               = 'Seu pagamento foi rejeitado, por favor tente novamente.';
    $lang['firesale:orders:mismatch_message']               = 'Seu pagamento não pertence a este pedido.';
    $lang['firesale:orders:logged_in']                      = 'Você deve estar logado no sistema para visualizar seu histórico de compra.';
    $lang['firesale:orders:label_view_order']               = 'Visualizar Pedido';
    $lang['firesale:orders:label_products']                 = 'Produtos';
    $lang['firesale:orders:label_view_order']               = 'Visualizar Pedido';
    $lang['firesale:orders:label_customer']                 = 'Cliente';
    $lang['firesale:orders:label_date_placed']              = 'Data da compra';
    $lang['firesale:orders:label_order_id']                 = 'Pedido ID';
    $lang['firesale:orders:labe_shipping_address']          = 'Endereço de Entrega';
    $lang['firesale:orders:labe_payment_address']           = 'Endereço de Pagamento';
    $lang['firesale:orders:label_order_status']             = 'Status do Pedido';
    $lang['firesale:orders:label_message']                  = 'Mensage';

    // Gateways
    $lang['firesale:gateways:admin_title']                  = 'Meios de Pagamento';
    $lang['firesale:gateways:install_title']                = 'Instalar Meio de Pagamento';
    $lang['firesale:gateways:edit_title']                   = 'Editar Meio de Pagamento';
    $lang['firesale:gateways:installed_title']              = 'Meio de Pagamento Instalado';
    $lang['firesale:gateways:no_gateways']                  = 'Não existem meios de pagamento instalados no momento.';
    $lang['firesale:gateways:no_uninstalled_gateways']      = 'Todos os meios de pagamento disponíveis estão instalados no momento.';
    $lang['firesale:gateways:errors:invalid_bool']          = 'O %s campo deve ser ter um valor do tipo verdadeiro/falso.';
    $lang['firesale:gateways:warning']                      = 'Todos as configurações para os meios de pagamento serão perdidas e sua loja pode ser incapaz de receber pagamentos! Tem certeza que deseja desinstalar este meio de pagamento?';
    $lang['firesale:gateways:multiple_warning']             = 'All gateway settings will be lost and your store may be unable to take payments! Are you sure you want to uninstall the selected gateways?'; # Translate

    $lang['firesale:gateways:installed_success']            = 'Meio de Pagamento instalado com sucesso';
    $lang['firesale:gateways:installed_fail']               = 'O meio de pagamento não pode ser instalado';

    $lang['firesale:gateways:uninstalled_success']          = 'Meio de Pagamento desinstalado com sucesso.';
    $lang['firesale:gateways:uninstalled_fail']             = 'Meio de Pagamento não pode ser desinstalado.';
    $lang['firesale:gateways:multiple_uninstalled_success'] = 'Meios de Pagamento selecionados foram desinstalados com sucesso.';
    $lang['firesale:gateways:multiple_uninstalled_fail']    = 'Meios de Pagamento selecionados não puderam ser desinstalados.';

    $lang['firesale:gateways:multiple_enabled_success']     = 'Meio de Pagamento selecionado foi ativado.';
    $lang['firesale:gateways:multiple_enabled_fail']        = 'Meio de Pagamento selecionado não pode ser ativado.';
    $lang['firesale:gateways:enabled_success']              = 'Meio de Pagamento foi ativado.';
    $lang['firesale:gateways:enabled_fail']                 = 'Meio de Pagamento não foi ativado.';

    $lang['firesale:gateways:disabled_success']             = 'Meio de Pagamento foi desativado.';
    $lang['firesale:gateways:disabled_fail']                = 'Meio de Pagamento não foi desativado.';
    $lang['firesale:gateways:multiple_disabled_success']    = 'Meio de Pagamento selecionado foi desativado.';
    $lang['firesale:gateways:multiple_disabled_fail']       = 'Meio de Pagamento selecionado não foi desativado.';

    $lang['firesale:gateways:updated_success']              = 'Meio de Pagamento foi alterado.';
    $lang['firesale:gateways:updated_fail']                 = 'Meio de Pagamento não foi alterado.';

    // Checkout
    $lang['firesale:gateways:labels:name']                  = 'Nome';
    $lang['firesale:gateways:labels:desc']                  = 'Descrição';
    $lang['firesale:cart:title']                            = 'Cesta de Compras';
    $lang['firesale:cart:empty']                            = 'Você não possui nenhum item em sua cesta.';
    $lang['firesale:cart:login_required']                   = 'Você deve estar logado antes de realizar isto.';
    $lang['firesale:cart:qty_too_low']                      = 'Nosso nível de estoque é muito baixo para você incluir está quantidade.';
    $lang['firesale:cart:price_changed']                    = 'The price of some items in your cart has changed, please check them before continuing'; # Translate
    $lang['firesale:checkout:title']                        = 'Finalizar Compra';
    $lang['firesale:checkout:error_callback']               = 'Parece existir um erro em seu pedido, por favor tente novamente, possivelmente utilizando outro meio de pagamento.';
    $lang['firesale:payment:title']                         = 'Confirmar Detalhes';
    $lang['firesale:payment:title_success']                 = 'Pagamento Completado';
    $lang['firesale:checkout:title:ship_method']            = 'Método de Entrega';
    $lang['firesale:checkout:title:payment_method']         = 'Método de Pagamento';
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
    $lang['firesale:routes:title']                          = 'Routes'; # Translate
    $lang['firesale:routes:new']                            = 'Add a new Route'; # Translate
    $lang['firesale:routes:add_success']                    = 'New route added successfully'; # Translate
    $lang['firesale:routes:add_error']                      = 'Error adding a new route'; # Translate
    $lang['firesale:routes:edit']                           = 'Edit %s Route'; # Translate
    $lang['firesale:routes:edit_success']                   = 'Route edited successfully'; # Translate
    $lang['firesale:routes:edit_error']                     = 'Error editing the route'; # Translate
    $lang['firesale:routes:not_found']                      = 'The selected route could not be found'; # Translate
    $lang['firesale:routes:none']                           = 'No routes found'; # Translate
    $lang['firesale:routes:delete_success']                 = 'Route removed successfully'; # Translate
    $lang['firesale:routes:delete_error']                   = 'Error removing route'; # Translate
    $lang['firesale:routes:build_success']                  = 'Successfully rebuilt the routes file'; # Translate
    $lang['firesale:routes:build_error']                    = 'There was an error rebuilding the routes file'; # Translate
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
    $lang['firesale:shortcuts:install_currency']            = 'Install new Currency'; # translate
    $lang['firesale:currency:enable']                       = 'Enable'; # translate
    $lang['firesale:currency:disable']                      = 'Disable'; # translate
    $lang['firesale:currency:disable_warn']                 = 'Disabling this may cause issues for customers and previous orders'; # translate
    $lang['firesale:currency:delete']                       = 'Delete'; # translate
    $lang['firesale:currency:delete_warn']                  = 'Deleting this may cause issues for customers and previous orders'; # translate
    $lang['firesale:currency:create']                       = 'Create New Currency'; # translate
    $lang['firesale:currency:edit']                         = 'Edit Currency'; # translate
    $lang['firesale:currency:not_found']                    = 'Selected currency not found'; # translate
    $lang['firesale:currency:add_success']                  = 'New currency added successfully'; # translate
    $lang['firesale:currency:add_error']                    = 'There was an error adding the new currency'; # translate
    $lang['firesale:currency:edit_success']                 = 'Currency updated successfully'; # translate
    $lang['firesale:currency:edit_error']                   = 'There was an error updating that currency'; # translate
    $lang['firesale:currency:delete_success']               = 'Currency was deleted successfully'; # translate
    $lang['firesale:currency:delete_error']                 = 'There was an error deleting the currency'; # translate
    $lang['firesale:label_cur_format_num']                  = 'Number Formatting'; # translate
    $lang['firesale:currency:format_none']                  = 'None'; # translate
    $lang['firesale:currency:format_00']                    = 'Round up to next full number'; # translate
    $lang['firesale:currency:format_50']                    = 'Round to closest .50'; # translate
    $lang['firesale:currency:format_99']                    = 'Round up to closest .99'; # translate

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
    $lang['firesale:addresses:title']                       = 'Meu Endereço';
    $lang['firesale:addresses:edit_address']                = 'Editar Endereço';
    $lang['firesale:addresses:new_address']                 = 'Adicionar novo endereço';
    $lang['firesale:addresses:save']                        = 'Salvar';
    $lang['firesale:addresses:cancel']                      = 'Cancelar';
    $lang['firesale:addresses:no_user']                     = 'Você deve estar logado no sistema para gerenciar seus endereços.';
    $lang['firesale:addresses:add_success']                 = 'Address created successfully'; # Translate
    $lang['firesale:addresses:add_error']                   = 'Error creating address'; # Translate
    $lang['firesale:addresses:edit_success']                = 'Address edited successfully'; # Translate
    $lang['firesale:addresses:edit_error']                  = 'Error editing address'; # Translate

    // Products Frontend
    $lang['firesale:product:label_availability']            = 'Disponibilidade';
    $lang['firesale:product:label_model']                   = 'Modelo';
    $lang['firesale:product:label_product_code']            = 'Código do produto';
    $lang['firesale:product:label_qty']                     = 'Qtd';
    $lang['firesale:product:label_add_to_cart']             = 'Adicionar a cesta';

    // Cart Frontend
    $lang['firesale:cart:label_remove']                     = 'Remover';
    $lang['firesale:cart:label_image']                      = 'Imagem';
    $lang['firesale:cart:label_name']                       = 'Name';
    $lang['firesale:cart:label_model']                      = 'Modelo';
    $lang['firesale:cart:label_quantity']                   = 'Quantidade';
    $lang['firesale:cart:label_unit_price']                 = 'Preço Unitário';
    $lang['firesale:cart:label_total']                      = 'Total';
    $lang['firesale:cart:label_no_items_in_cart']           = 'Não existem produtos em sua cesta';
    $lang['firesale:cart:button_update']                    = 'Atualizar cesta';
    $lang['firesale:cart:button_goto_checkout']             = 'Efetuar pagamento';
    $lang['firesale:cart:label_sub_total']                  = 'Sub-total';
    $lang['firesale:cart:label_tax']                        = 'Impostos';
    $lang['firesale:cart:label_total']                      = 'Total';

    // Categories Frontend
    $lang['firesale:categories:list']                       = 'Lista';
    $lang['firesale:categories:grid']                       = 'Gride';
    $lang['firesale:categories:add_to_basket']              = 'Adicionar a cesta de compras';

    // Payment Frontend
    $lang['firesale:payment:cancelled']                     = 'Pedido Cancelado';
    $lang['firesale:payment:wait_redirect']                 = 'Por favor aguarde enquanto o direcionamos para realizar o pagamento...';
    $lang['firesale:payment:btn_continue']                  = 'Continuar';

    // Settings
    $lang['firesale:settings_tax']                          = 'Tax Percentage'; # translate
    $lang['firesale:settings_tax_inst']                     = 'The percentage of tax to be applied to the products'; # translate
    $lang['firesale:settings_currency']                     = 'Default Currency Code'; # translate
    $lang['firesale:settings_currency_inst']                = 'The currency you accept (ISO-4217 format)'; # translate
    $lang['firesale:settings_currency_key']                 = 'Currency API Key'; # translate
    $lang['firesale:settings_currency_key_inst']            = 'API Key from <a target="_blank" href="https://openexchangerates.org/signup/free">Open Exchange Rates</a>'; # translate
    $lang['firesale:settings_current_currency']             = 'Current Currency'; # translate
    $lang['firesale:settings_current_currency_inst']        = 'The current currency in use, used to update existing values if default currency is changed'; # translate
    $lang['firesale:settings_currency_updated']             = 'Currency last update time'; # translate
    $lang['firesale:settings_currency_updated_inst']        = 'The last time the currency was updated, api is updated every hour and to keep to rate limits we only check after that'; # translate
    $lang['firesale:settings_perpage']                      = 'Products per Page'; # translate
    $lang['firesale:settings_perpage_inst']                 = 'The number of products to be displayed on category and search result pages'; # translate
    $lang['firesale:settings_image_square']                 = 'Make Images Square'; # translate
    $lang['firesale:settings_image_square_inst']            = 'Some themes may require square images to keep layouts consistent'; # translate
    $lang['firesale:settings_image_background']             = 'Image Background Colour'; # translate
    $lang['firesale:settings_image_background_inst']        = 'Hexcode (without #) colour you wish resized image backgrounds to be'; # translate
    $lang['firesale:settings_login']                        = 'Require login to purchase'; # translate
    $lang['firesale:settings_login_inst']                   = 'Ensure a user is logged in before allowing them to buy products'; # translate
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
    $lang['firesale:install:wrong_version']                 = 'Unable to install the FireSale module, FireSale requires PyroCMS v2.1.4 or above'; #Translate
    $lang['firesale:install:missing_multiple']              = 'FireSale requires the Multiple Relationships field type to operate. You can download this from <a target="_blank" href="https://github.com/adamfairholm/PyroStreams-Multiple-Relationships/zipball/2.0/develop">here</a>'; #Translate
    $lang['firesale:install:not_installed']                 = 'Please install the FireSale module before installing additional FireSale addons'; #Translate
    $lang['firesale:install:no_route_access']               = 'FireSale requires access to the system/cms/config/routes.php file. Please set the appropriate permissions and try again'; # Translate
    $lang['firesale:install:old_multiple']                  = 'Your currently installed version of the Multiple field type is out of date, please delete or upgrade it before attempting to use FireSale'; # Translate
