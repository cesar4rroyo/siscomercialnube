<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categoria;
use App\Category;
use App\Producto;
use App\Detallemovimiento;
use Illuminate\Support\Facades\DB;
use App\Librerias\Libreria;

class WebServicesController extends Controller
{
    public function cargarMegaMenu(){
        $categorias = Category::join("categoria","categoria.categoria_id","=","category.id")->whereNotNull("categoria.nombre")->whereNotNull("category.nombre")->whereNull("categoria.deleted_at")->orderBy("category.nombre","ASC")->select("category.*")->distinct("category.id")->get();
        foreach ($categorias as $key => $value) {
            $value->categorias = Categoria::join("producto","categoria.id","=","producto.categoria_id")->whereNotNull("categoria.nombre")->where("categoria.categoria_id","=",$value->id)->whereNull("producto.deleted_at")->select("categoria.*")->distinct("categoria.id")->get();
            foreach ($value->categorias as $key => $value2) {
                $value2->productos;
            }
        }
        return json_encode(array("categorias"=>$categorias));
    }

    public function principal(){
        $detalles = Detallemovimiento::join("movimiento","movimiento.id","=","detallemovimiento.movimiento_id")->join("producto","producto.id","=","detallemovimiento.producto_id")->whereNull("producto.deleted_at")->where("movimiento.tipomovimiento_id","=","2")->whereNotIn('movimiento.situacion',['A'])->groupBy("detallemovimiento.producto_id")->select("detallemovimiento.producto_id",DB::raw('sum(detallemovimiento.cantidad) as sumcantidad'))->orderBy("sumcantidad","DESC")->LIMIT(10)->get();
        foreach ($detalles as $key => $value) {
            $value->producto = Producto::find($value->producto_id);
            //$value->producto->marca;
            //$value->producto->unidad;
        }

        $detalles2 = Category::whereNotNull("orderweb")->orderBy("orderweb","ASC")->get();
        foreach ($detalles2 as $key => $value) {
         $value->categoria = Category::find($value->id);
        }
        //return json_encode($detalles2);
        return json_encode(array("productos"=>$detalles,"categorias"=>$detalles2));
    }

    public function catalogo(Request $request){
        $categorias = Category::join("categoria","categoria.categoria_id","=","category.id")->join("producto","categoria.id","=","producto.categoria_id")->whereNotNull("categoria.nombre")->whereNotNull("category.nombre")->whereNull("producto.deleted_at")->whereNull("categoria.deleted_at")->groupBy("category.id")->select("category.id", "category.nombre", DB::raw('count(category.id) as cantidad'))->orderBy("category.nombre","ASC")->get();
        foreach ($categorias as $key => $value) {
            $value->categorias =  Categoria::join("producto","categoria.id","=","producto.categoria_id")->whereNotNull("categoria.nombre")->where("categoria.categoria_id","=",$value->id)->whereNull("producto.deleted_at")->groupBy("categoria.id")->select("categoria.id", "categoria.nombre", DB::raw('count(categoria.id) as cantidad'))->orderBy("categoria.nombre","ASC")->get();
        }
        return json_encode(array("categorias"=>$categorias));
    }

    public function buscarProducto(Request $request){
        $categorias_id = explode(",", $request->input("categorias"));
        $pagina = $request->input("page");

        $resultado = Producto::orderBy("producto.nombre","ASC");
        if($request->input("categorias")!= null){
            $resultado = $resultado->whereIn("producto.categoria_id",$categorias_id);
        }
        $productos = $resultado->get();

        $filas = "12";

        $clsLibreria     = new Libreria();
        $paramPaginacion = $clsLibreria->generarPaginacion($productos, $pagina, $filas, "PRODUCTO");
        $paginacion      = $paramPaginacion['cadenapaginacion'];
        $paginaactual    = $paramPaginacion['nuevapagina'];
        $productos       = $resultado->paginate($filas);
        //$request->replace(array('page' => $paginaactual));

        // foreach ($productos as $value) {
        //     if($productos->archivo == 'imagen.png'){

        //     }
        // }

        return json_encode(array("productos"=>$productos,"paginacion"=>$paginacion,"paginaactual"=>$paginaactual));
    }

    public function productoautocompletar(Request $request)
    {
        $searching = $request->input("query");
        $resultado        = Producto::
            where(function ($sql) use ($searching) {
                $sql->where("producto.nombre", 'LIKE', '%' . strtoupper($searching) . '%');
            })
            ->whereNull('producto.deleted_at')->orderBy('nombre', 'ASC');
        $list = $resultado->select('producto.*')->get();
        $data = array();
        foreach ($list as $key => $value) {
            $data[] = array(
                'label' => trim($value->nombre),
                'id'    => $value->id,
                'name' => trim($value->nombre),
                'precio'   => number_format($value->precioventa,2),
                'descripcion'   => "",
                'imagen'   => $value->archivo,
            );
        }
        return json_encode($data);
    }

    public function producto(Request $request)
    {
        $producto_id = $request->input("producto_id");
        $producto = Producto::find($producto_id);
        $producto->marca;
        $producto->unidad;
        $producto->categoria;
        $producto->categoria->categoriapadre;
        $producto->precioventa = number_format($producto->precioventa,2);

        $productos = Producto::where("categoria_id","=",$producto->categoria_id)->where("id","<>",$producto_id)->orderBy("producto.nombre")->limit(10)->get();
        return json_encode(array("producto"=>$producto,"productos"=>$productos));
    }
}
