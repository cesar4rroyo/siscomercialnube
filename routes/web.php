<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
if (version_compare(PHP_VERSION, '7.2.0', '>=')) {
    // Ignores notices and reports all other kinds... and warnings
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
    error_reporting(E_ALL ^ E_WARNING); // Maybe this is enough
}

//Route::get('/colocarstockreal', 'MovimientostockController@colocarstockreal');


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/asd', function () {
    return view('auth.login');
});

Route::get('webservices/cargarMegaMenu', 'WebServicesController@cargarMegaMenu')->middleware('cors');
Route::get('webservices/principal', 'WebServicesController@principal')->middleware('cors');
Route::get('webservices/catalogo', 'WebServicesController@catalogo')->middleware('cors');
Route::get('webservices/buscarProducto', 'WebServicesController@buscarProducto')->middleware('cors');
Route::get('webservices/productoautocompletar', 'WebServicesController@productoautocompletar')->middleware('cors');
Route::get('webservices/producto', 'WebServicesController@producto')->middleware('cors');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/home', function () {
        return View::make('layouts.master');
    });
    Route::post('categoriaopcionmenu/buscar', 'CategoriaopcionmenuController@buscar')->name('categoriaopcionmenu.buscar');
    Route::get('categoriaopcionmenu/eliminar/{id}/{listarluego}', 'CategoriaopcionmenuController@eliminar')->name('categoriaopcionmenu.eliminar');
    Route::resource('categoriaopcionmenu', 'CategoriaopcionmenuController', array('except' => array('show')));

    Route::post('opcionmenu/buscar', 'OpcionmenuController@buscar')->name('opcionmenu.buscar');
    Route::get('opcionmenu/eliminar/{id}/{listarluego}', 'OpcionmenuController@eliminar')->name('opcionmenu.eliminar');
    Route::resource('opcionmenu', 'OpcionmenuController', array('except' => array('show')));

    Route::post('tipousuario/buscar', 'TipousuarioController@buscar')->name('tipousuario.buscar');
    Route::get('tipousuario/obtenerpermisos/{listar}/{id}', 'TipousuarioController@obtenerpermisos')->name('tipousuario.obtenerpermisos');
    Route::post('tipousuario/guardarpermisos/{id}', 'TipousuarioController@guardarpermisos')->name('tipousuario.guardarpermisos');
    Route::get('tipousuario/eliminar/{id}/{listarluego}', 'TipousuarioController@eliminar')->name('tipousuario.eliminar');
    Route::resource('tipousuario', 'TipousuarioController', array('except' => array('show')));

    Route::post('usuario/buscar', 'UsuarioController@buscar')->name('usuario.buscar');
    Route::get('usuario/eliminar/{id}/{listarluego}', 'UsuarioController@eliminar')->name('usuario.eliminar');
    Route::resource('usuario', 'UsuarioController', array('except' => array('show')));
    Route::get('usuario/personautocompletar/{searching}', 'UsuarioController@personautocompletar')->name('usuario.personautocompletar');
    Route::get('usuario/cambiarcaja', 'UsuarioController@cambiarcaja')->name('usuario.cambiarcaja');




    /* CATEGORIA */
    Route::post('categoria/buscar', 'CategoriaController@buscar')->name('categoria.buscar');
    Route::get('categoria/eliminar/{id}/{listarluego}', 'CategoriaController@eliminar')->name('categoria.eliminar');
    Route::resource('categoria', 'CategoriaController', array('except' => array('show')));

    /* UNIDAD */
    Route::post('unidad/buscar', 'UnidadController@buscar')->name('unidad.buscar');
    Route::get('unidad/eliminar/{id}/{listarluego}', 'UnidadController@eliminar')->name('unidad.eliminar');
    Route::resource('unidad', 'UnidadController', array('except' => array('show')));

    /* MARCA */
    Route::post('marca/buscar', 'MarcaController@buscar')->name('marca.buscar');
    Route::get('marca/eliminar/{id}/{listarluego}', 'MarcaController@eliminar')->name('marca.eliminar');
    Route::resource('marca', 'MarcaController', array('except' => array('show')));
    /* Category -> Categoria padre */
    Route::post('category/buscar', 'CategoryController@buscar')->name('category.buscar');
    Route::get('category/eliminar/{id}/{listarluego}', 'CategoryController@eliminar')->name('category.eliminar');
    Route::resource('category', 'CategoryController', array('except' => array('show')));

    /* SUCURSAL */
    Route::post('sucursal/buscar', 'sucursalController@buscar')->name('sucursal.buscar');
    Route::get('sucursal/eliminar/{id}/{listarluego}', 'sucursalController@eliminar')->name('sucursal.eliminar');
    Route::resource('sucursal', 'sucursalController', array('except' => array('show')));
    /* CAJA MANTENIMIENTO */
    Route::post('mantenimientocaja/buscar', 'mantenimientocajaController@buscar')->name('mantenimientocaja.buscar');
    Route::get('mantenimientocaja/eliminar/{id}/{listarluego}', 'mantenimientocajaController@eliminar')->name('mantenimientocaja.eliminar');
    Route::resource('mantenimientocaja', 'mantenimientocajaController', array('except' => array('show')));
    //Modal para asignar caja
    Route::get('mantenimientocaja/asignarcaja', 'mantenimientocajaController@asignarcaja')->name('mantenimientocaja.asignarcaja');
    Route::post('mantenimientocaja/guardarasignarcaja', 'mantenimientocajaController@guardarasignarcaja')->name('mantenimientocaja.guardarasignarcaja');
    /* MOTIVO */
    Route::post('motivo/buscar', 'MotivoController@buscar')->name('motivo.buscar');
    Route::get('motivo/eliminar/{id}/{listarluego}', 'MotivoController@eliminar')->name('motivo.eliminar');
    Route::resource('motivo', 'MotivoController', array('except' => array('show')));

    /* PERSONA */
    Route::post('persona/buscar', 'PersonaController@buscar')->name('persona.buscar');
    Route::get('persona/eliminar/{id}/{listarluego}', 'PersonaController@eliminar')->name('persona.eliminar');
    Route::resource('persona', 'PersonaController', array('except' => array('show')));
    Route::post('persona/buscarDNI', 'PersonaController@buscarDNI')->name('persona.buscarDNI');
    Route::post('persona/buscarRUC', 'PersonaController@buscarRUC')->name('persona.buscarRUC');
    Route::resource('persona', 'PersonaController', array('except' => array('show')));

    /* PRODUCTO */
    Route::post('producto/buscar', 'ProductoController@buscar')->name('producto.buscar');
    Route::get('producto/eliminar/{id}/{listarluego}', 'ProductoController@eliminar')->name('producto.eliminar');
    Route::post('producto/buscarproducto', 'ProductoController@buscarproducto')->name('producto.buscarproducto');
    Route::resource('producto', 'ProductoController', array('except' => array('show')));
    Route::get('producto/excel', 'ProductoController@excel')->name('producto.excel');
    Route::get('producto/presentacion/{id}/{listarluego}', 'ProductoController@presentacion')->name('producto.presentacion');
    Route::post('producto/presentaciones', 'ProductoController@presentaciones')->name('producto.presentaciones');
    Route::post('producto/archivos', 'ProductoController@archivos')->name('producto.archivos');
    Route::get('product/import', 'ProductoController@import')->name('producto.import');
    Route::get('producto/export', 'ProductoController@export');
    Route::post('product/saveimport', 'ProductoController@saveimport')->name('producto.saveimport');

    /* COMPRA */
    Route::post('compra/buscar', 'CompraController@buscar')->name('compra.buscar');
    Route::get('compra/eliminar/{id}/{listarluego}', 'CompraController@eliminar')->name('compra.eliminar');
    // Route::get('compra/buscarproducto', array('as' => 'compra.buscarproducto', 'uses' => 'CompraController@buscarproducto'));
    Route::get('compra/personautocompletar/{searching}', 'CompraController@personautocompletar')->name('compra.personautocompletar');
    Route::post('compra/buscarproducto', 'CompraController@buscarproducto')->name('compra.buscarproducto');
    Route::post('compra/buscarproductobarra', 'CompraController@buscarproductobarra')->name('compra.buscarproductobarra');
    Route::resource('compra', 'CompraController');

    /* MOVIMIENTO ALMACEN */
    Route::post('movimientoalmacen/buscar', 'MovimientoalmacenController@buscar')->name('movimientoalmacen.buscar');
    Route::get('movimientoalmacen/eliminar/{id}/{listarluego}', 'MovimientoalmacenController@eliminar')->name('movimientoalmacen.eliminar');
    // Route::get('movimientoalmacen/buscarproducto', array('as' => 'movimientoalmacen.buscarproducto', 'uses' => 'MovimientoalmacenController@buscarproducto'));
    Route::resource('movimientoalmacen', 'MovimientoalmacenController');
    Route::post('movimientoalmacen/buscarproducto', 'MovimientoalmacenController@buscarproducto')->name('movimientoalmacen.buscarproducto');
    Route::post('movimientoalmacen/buscarproductobarra', 'MovimientoalmacenController@buscarproductobarra')->name('movimientoalmacen.buscarproductobarra');
    Route::post('movimientoalmacen/generarNumero', 'MovimientoalmacenController@generarNumero')->name('movimientoalmacen.generarNumero');
    Route::post('movimientoalmacen/cambiarMotivo', 'MovimientoalmacenController@cambiarMotivo')->name('movimientoalmacen.cambiarMotivo');
    Route::post('movimientoalmacen/cambiarSucursalDestino', 'MovimientoalmacenController@cambiarSucursalDestino')->name('movimientoalmacen.cambiarSucursalDestino');
    Route::get('movimientoalmacen/import/id', 'MovimientoalmacenController@import')->name('movimientoalmacen.import');
    Route::post('movimientoalmacen/saveimport', 'MovimientoalmacenController@saveimport')->name('movimientoalmacen.saveimport');
    Route::get('movimientoalmacen/pdf/{id}', 'MovimientoalmacenController@pdf')->name('movimientoalmacen.pdf');

    /* REQUERIMIENTO */
    Route::post('requerimiento/buscar', 'RequerimientoController@buscar')->name('requerimiento.buscar');
    Route::get('requerimiento/eliminar/{id}/{listarluego}', 'RequerimientoController@eliminar')->name('requerimiento.eliminar');
    Route::resource('requerimiento', 'RequerimientoController');
    Route::post('requerimiento/buscarproducto', 'RequerimientoController@buscarproducto')->name('requerimiento.buscarproducto');
    Route::post('requerimiento/buscarproductobarra', 'RequerimientoController@buscarproductobarra')->name('requerimiento.buscarproductobarra');
    Route::post('requerimiento/generarNumero', 'RequerimientoController@generarNumero')->name('movimientoalmacen.generarNumero');
    Route::post('requerimiento/cambiarSucursalDestino', 'RequerimientoController@cambiarSucursalDestino')->name('requerimiento.cambiarSucursalDestino');

    /* DOC STOCK REAL */
    Route::post('movimientostock/buscar', 'MovimientostockController@buscar')->name('movimientostock.buscar');
    Route::get('movimientostock/eliminar/{id}/{listarluego}', 'MovimientostockController@eliminar')->name('movimientostock.eliminar');
    Route::resource('movimientostock', 'MovimientostockController');
    Route::post('movimientostock/buscarproducto', 'MovimientostockController@buscarproducto')->name('movimientostock.buscarproducto');
    Route::post('movimientostock/buscarproductobarra', 'MovimientostockController@buscarproductobarra')->name('movimientostock.buscarproductobarra');
    Route::post('movimientostock/generarNumero', 'MovimientostockController@generarNumero')->name('movimientostock.generarNumero');
    Route::post('movimientostock/cambiarSucursalDestino', 'MovimientostockController@cambiarSucursalDestino')->name('movimientostock.cambiarSucursalDestino');

    /* PROMOCION */
    Route::post('promocion/buscar', 'PromocionController@buscar')->name('promocion.buscar');
    Route::get('promocion/eliminar/{id}/{listarluego}', 'PromocionController@eliminar')->name('promocion.eliminar');
    Route::post('promocion/buscarpromocion', 'PromocionController@buscarproducto')->name('promocion.buscarproducto');
    Route::resource('promocion', 'PromocionController', array('except' => array('show')));
    Route::get('promocion/productoautocompletar/{searching}', 'PromocionController@productoautocompletar')->name('promocion.productoautocompletar');
    Route::get('promocion/productoautocompletar2/', 'PromocionController@productoautocompletar2')->name('promocion.productoautocompletar2');
    Route::get('promocion/categoriaautocompletar', 'PromocionController@categoriaautocompletar')->name('promocion.categoriaautocompletar');
    Route::get('promocion/subcategoriaautocompletar', 'PromocionController@subcategoriaautocompletar')->name('promocion.subcategoriaautocompletar');
    Route::get('promocion/categoriaautocompletar2', 'PromocionController@categoriaautocompletar2')->name('promocion.categoriaautocompletar2');
    Route::get('promocion/subcategoriaautocompletar2', 'PromocionController@subcategoriaautocompletar2')->name('promocion.subcategoriaautocompletar2');
    Route::get('promocion/sucursalautocompletar', 'PromocionController@sucursalautocompletar')->name('promocion.sucursalautocompletar');

    /* CONCEPTOPAGO */
    Route::post('concepto/buscar', 'ConceptoController@buscar')->name('concepto.buscar');
    Route::get('concepto/eliminar/{id}/{listarluego}', 'ConceptoController@eliminar')->name('concepto.eliminar');
    Route::resource('concepto', 'ConceptoController', array('except' => array('show')));

    /* CAJA */
    Route::post('caja/buscar', 'CajaController@buscar')->name('caja.buscar');
    Route::post('caja/buscarcontrol', 'CajaController@buscarControl')->name('caja.buscarcontrol');
    Route::get('caja/eliminar/{id}/{listarluego}', 'CajaController@eliminar')->name('caja.eliminar');
    Route::resource('caja', 'CajaController', array('except' => array('show')));
    Route::get('caja/apertura', 'CajaController@apertura')->name('caja.apertura');
    Route::post('caja/aperturar', 'CajaController@aperturar')->name('caja.aperturar');
    Route::get('caja/cierre', 'CajaController@cierre')->name('caja.cierre');
    Route::post('caja/cerrar', 'CajaController@cerrar')->name('caja.cerrar');
    Route::post('caja/generarConcepto', 'CajaController@generarConcepto')->name('caja.generarconcepto');
    Route::post('caja/generarNumero', 'CajaController@generarNumero')->name('caja.generarnumero');
    Route::get('caja/personautocompletar/{searching}', 'CajaController@personautocompletar')->name('caja.personautocompletar');
    Route::get('caja/pdfCierre', 'CajaController@pdfCierre')->name('caja.pdfCierre');
    Route::get('caja/pdfDetalleCierre', 'CajaController@pdfDetalleCierre')->name('caja.pdfDetalleCierre');
    Route::get('caja/pdfDetalleCierreF', 'CajaController@pdfDetalleCierreF')->name('caja.pdfDetalleCierreF');
    Route::get('caja/verpdfcierre/{caja_id}', 'CajaController@pdfCierreTicket')->name('caja.verpdfcierre');


    /* VENTA */
    Route::post('venta/buscar', 'VentaController@buscar')->name('venta.buscar');
    Route::get('venta/eliminar/{id}/{listarluego}', 'VentaController@eliminar')->name('venta.eliminar');
    Route::get('venta/generarPagar/{id}/{listarluego}', 'VentaController@generarPagar')->name('venta.generarPagar');
    Route::post('venta/pagar/{id}', 'VentaController@pagar')->name('venta.pagar');
    Route::resource('venta', 'VentaController');
    Route::post('venta/buscarproducto', 'VentaController@buscarproducto')->name('venta.buscarproducto');
    Route::post('venta/buscarproductobarra', 'VentaController@buscarproductobarra')->name('venta.buscarproductobarra');
    Route::post('venta/generarNumero', 'VentaController@generarNumero')->name('venta.generarNumero');
    Route::get('venta/personautocompletar/{searching}', 'VentaController@personautocompletar')->name('venta.personautocompletar');
    Route::post('venta/imprimirVenta', 'VentaController@imprimirVenta')->name('venta.imprimirVenta');
    Route::post('venta/declarar', 'VentaController@declarar')->name('venta.declarar');
    Route::get('venta/verpdf/{id}', 'VentaController@pdfTicket')->name('venta.verpdf');
    Route::get('venta/verpdf2/{id}', 'VentaController@pdfTicket2')->name('venta.verpdf2');
    Route::get('venta/viewCopiar/{id}/{listarluego}', 'VentaController@viewCopiar')->name('venta.viewCopiar');
    Route::get('venta/viewParcial/{id}/{listarluego}', 'VentaController@viewParcial')->name('venta.viewParcial');
    Route::post('venta/guardarParcial/{id}', 'VentaController@guardarParcial')->name('venta.guardarParcial');


    /* PEDIDO*/
    Route::post('pedido/buscar', 'PedidoController@buscar')->name('pedido.buscar');
    Route::get('pedido/eliminar/{id}/{listarluego}', 'PedidoController@eliminar')->name('pedido.eliminar');
    Route::get('pedido/siguienteEtapa/{id}/{listarluego}', 'PedidoController@siguienteEtapa')->name('pedido.siguienteEtapa');
    Route::get('pedido/viewUpdate/{id}/{listarluego}', 'PedidoController@viewUpdate')->name('pedido.viewUpdate');
    Route::get('pedido/aceptar/{id}', 'PedidoController@aceptar')->name('pedido.aceptar');
    Route::get('pedido/enviar/{id}', 'PedidoController@enviar')->name('pedido.enviar');
    Route::get('pedido/finalizar/{id}', 'PedidoController@finalizar')->name('pedido.finalizar');
    Route::get('pedido/enviaryfinalizar/{id}', 'PedidoController@enviaryfinalizar')->name('pedido.enviaryfinalizar');
    Route::resource('pedido', 'PedidoController');


    /* REPORTE CAJA*/
    Route::get('cajareporte/excelCaja', 'CajareporteController@excelCaja')->name('cajareporte.excelCaja');
    Route::resource('cajareporte', 'CajareporteController', array('except' => array('show')));

    /* REPORTE CATALOGO PRODUCTOS */
    Route::get('catalogoreporte/excelCatalogo', 'CatalogoreporteController@excelCatalogo')->name('catalogoreporte.excelCatalogo');
    Route::resource('catalogoreporte', 'CatalogoreporteController', array('except' => array('show')));

    /* REPORTE DETALLE*/
    Route::get('detallereporte/excelDetalle', 'DetallereporteController@excelDetalle')->name('detallereporte.excelDetalle');
    Route::resource('detallereporte', 'DetallereporteController', array('except' => array('show')));
    Route::get('detallereporte/cambiarcategoria', 'DetallereporteController@cambiarcategoria');
    Route::get('detallereporte/cambiarproducto/{id?}', 'DetallereporteController@cambiarproducto');

    /* REPORTE KARDEX*/
    Route::get('kardexreporte/excelKardex', 'KardexreporteController@excelKardex')->name('kardexreporte.excelKardex');
    Route::resource('kardexreporte', 'KardexreporteController', array('except' => array('show')));
});
