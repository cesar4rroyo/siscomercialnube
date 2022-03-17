<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Validator;
use App\Http\Requests;
use App\Person;
use App\Rol;
use App\Rolpersona;
use App\Librerias\Libreria;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class PersonaController extends Controller
{
    protected $folderview      = 'app.persona';
    protected $tituloAdmin     = 'Persona';
    protected $tituloRegistrar = 'Registrar persona';
    protected $tituloModificar = 'Modificar persona';
    protected $tituloEliminar  = 'Eliminar persona';
    protected $rutas           = array(
        'create' => 'persona.create',
        'edit'   => 'persona.edit',
        'delete' => 'persona.eliminar',
        'search' => 'persona.buscar',
        'index'  => 'persona.index',
    );


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Mostrar el resultado de búsquedas
     * 
     * @return Response 
     */
    public function buscar(Request $request)
    {
        $pagina           = $request->input('page');
        $filas            = $request->input('filas');
        $entidad          = 'Persona';
        $nombre             = Libreria::getParam($request->input('nombre'));
        $resultado        = Person::where(DB::raw('concat(person.apellidopaterno,\' \',person.apellidomaterno,\' \',person.nombres)'), 'LIKE', '%' . strtoupper($nombre) . '%')
            ->orderBy('person.apellidopaterno', 'ASC');
        $lista            = $resultado->get();
        $cabecera         = array();
        $cabecera[]       = array('valor' => '#', 'numero' => '1');
        $cabecera[]       = array('valor' => 'Apellidos y Nombres', 'numero' => '1');
        $cabecera[]       = array('valor' => 'DNI', 'numero' => '1');
        $cabecera[]       = array('valor' => 'Direccion', 'numero' => '1');
        $cabecera[]       = array('valor' => 'Telefono', 'numero' => '1');
        $cabecera[]       = array('valor' => 'Correo', 'numero' => '1');
        $cabecera[]       = array('valor' => 'Operaciones', 'numero' => '2');

        $titulo_modificar = $this->tituloModificar;
        $titulo_eliminar  = $this->tituloEliminar;
        $ruta             = $this->rutas;
        if (count($lista) > 0) {
            $clsLibreria     = new Libreria();
            $paramPaginacion = $clsLibreria->generarPaginacion($lista, $pagina, $filas, $entidad);
            $paginacion      = $paramPaginacion['cadenapaginacion'];
            $inicio          = $paramPaginacion['inicio'];
            $fin             = $paramPaginacion['fin'];
            $paginaactual    = $paramPaginacion['nuevapagina'];
            $lista           = $resultado->paginate($filas);
            $request->replace(array('page' => $paginaactual));
            return view($this->folderview . '.list')->with(compact('lista', 'paginacion', 'inicio', 'fin', 'entidad', 'cabecera', 'titulo_modificar', 'titulo_eliminar', 'ruta'));
        }
        return view($this->folderview . '.list')->with(compact('lista', 'entidad'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $entidad          = 'Persona';
        $title            = $this->tituloAdmin;
        $titulo_registrar = $this->tituloRegistrar;
        $ruta             = $this->rutas;
        return view($this->folderview . '.admin')->with(compact('entidad', 'title', 'titulo_registrar', 'ruta'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $listar   = Libreria::getParam($request->input('listar'), 'NO');
        $entidad  = 'Persona';
        $persona = null;
        $formData = array('persona.store');
        $cboRol = array();
        $cboRp = array();
        $rol = Rol::orderBy('nombre', 'asc')->get();
        foreach ($rol as $k => $v) {
            $cboRol = $cboRol + array($v->id => $v->nombre);
        }
        $formData = array('route' => $formData, 'class' => 'form-horizontal', 'id' => 'formMantenimiento' . $entidad, 'autocomplete' => 'off');
        $boton    = 'Registrar';
        return view($this->folderview . '.mant')->with(compact('persona', 'formData', 'entidad', 'boton', 'listar', 'cboRol', 'cboRp'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $listar     = Libreria::getParam($request->input('listar'), 'NO');
        $reglas     = array(
            'nombres' => 'required|max:50',
            'roles' => 'required'
        );
        $mensajes = array(
            'nombre.required'         => 'Debe ingresar un nombre',
            'roles.required'         => 'Debe seleccionar al menos un Rol'
        );
        $validacion = Validator::make($request->all(), $reglas, $mensajes);
        if ($validacion->fails()) {
            return $validacion->messages()->toJson();
        }
        $error = DB::transaction(function () use ($request) {
            $person = new Person();
            $person->apellidopaterno = strtoupper($request->input('apellidopaterno'));
            $person->apellidomaterno = strtoupper($request->input('apellidomaterno'));
            $person->nombres = strtoupper($request->input('nombres'));
            $person->dni = strtoupper($request->input('dni'));
            $person->ruc = strtoupper($request->input('ruc'));
            $person->direccion = strtoupper($request->input('direccion'));
            $person->email = strtoupper($request->input('email'));
            $person->telefono = strtoupper($request->input('telefono'));
            $person->save();
            $roles = explode(",", $request->input('roles'));
            for ($c = 0; $c < count($roles); $c++) {
                $rolpersona = new Rolpersona();
                $rolpersona->person_id = $person->id;
                $rolpersona->rol_id = $roles[$c];
                $rolpersona->save();
            }
        });
        return is_null($error) ? "OK" : $error;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $existe = Libreria::verificarExistencia($id, 'person');
        if ($existe !== true) {
            return $existe;
        }
        $listar   = Libreria::getParam($request->input('listar'), 'NO');
        $persona = Person::find($id);
        $cboRol = array();
        $rol = Rol::orderBy('nombre', 'asc')->get();
        foreach ($rol as $k => $v) {
            $cboRol = $cboRol + array($v->id => $v->nombre);
        }
        $rolpersona = Rolpersona::where('person_id', '=', $id)->get();
        $cboRp = array();
        foreach ($rolpersona as $key => $value) {
            $cboRp = $cboRp + array($value->rol_id => $value->rol_id);
        }
        $entidad  = 'Persona';
        $formData = array('persona.update', $id);
        $formData = array('route' => $formData, 'method' => 'PUT', 'class' => 'form-horizontal', 'id' => 'formMantenimiento' . $entidad, 'autocomplete' => 'off');
        $boton    = 'Modificar';
        return view($this->folderview . '.mant')->with(compact('persona', 'formData', 'entidad', 'boton', 'listar', 'cboRol', 'cboRp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existe = Libreria::verificarExistencia($id, 'person');
        if ($existe !== true) {
            return $existe;
        }
        $reglas     = array(
            'nombres' => 'required|max:50',
            'roles' => 'required'
        );
        $mensajes = array(
            'nombre.required'         => 'Debe ingresar un nombre',
            'roles.required'         => 'Debe seleccionar al menos un Rol'
        );
        $validacion = Validator::make($request->all(), $reglas, $mensajes);
        if ($validacion->fails()) {
            return $validacion->messages()->toJson();
        }
        $error = DB::transaction(function () use ($request, $id) {
            $person = Person::find($id);
            $person->apellidopaterno = strtoupper($request->input('apellidopaterno'));
            $person->apellidomaterno = strtoupper($request->input('apellidomaterno'));
            $person->nombres = strtoupper($request->input('nombres'));
            $person->dni = strtoupper($request->input('dni'));
            $person->ruc = strtoupper($request->input('ruc'));
            $person->direccion = strtoupper($request->input('direccion'));
            $person->email = strtoupper($request->input('email'));
            $person->telefono = strtoupper($request->input('telefono'));
            $person->save();
            $dat = Rolpersona::where('person_id', '=', $person->id)->get();
            foreach ($dat as $key => $value) {
                $value->delete();
            }
            $roles = explode(",", $request->input('roles'));
            for ($c = 0; $c < count($roles); $c++) {
                $rolpersona = new Rolpersona();
                $rolpersona->person_id = $person->id;
                $rolpersona->rol_id = $roles[$c];
                $rolpersona->save();
            }
        });
        return is_null($error) ? "OK" : $error;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existe = Libreria::verificarExistencia($id, 'person');
        if ($existe !== true) {
            return $existe;
        }
        $error = DB::transaction(function () use ($id) {
            $person = Person::find($id);
            $person->delete();
        });
        return is_null($error) ? "OK" : $error;
    }

    public function eliminar($id, $listarLuego)
    {
        $existe = Libreria::verificarExistencia($id, 'person');
        if ($existe !== true) {
            return $existe;
        }
        $listar = "NO";
        if (!is_null(Libreria::obtenerParametro($listarLuego))) {
            $listar = $listarLuego;
        }
        $modelo   = Person::find($id);
        $entidad  = 'Person';
        $formData = array('route' => array('persona.destroy', $id), 'method' => 'DELETE', 'class' => 'form-horizontal', 'id' => 'formMantenimiento' . $entidad, 'autocomplete' => 'off');
        $boton    = 'Eliminar';
        return view('app.confirmarEliminar')->with(compact('modelo', 'formData', 'entidad', 'boton', 'listar'));
    }

    public function buscarDNI(Request $request)
    {
        $respuesta = array();
        $dni = $request->input('dni');
        $client = new Client();
        $res = $client->get('http://facturae-garzasoft.com/facturacion/buscaCliente/BuscaCliente2.php?' . 'dni=' . $dni . '&fe=N&token=qusEj_w7aHEpX');
        if ($res->getStatusCode() == 200) { // 200 OK
            $response_data = $res->getBody()->getContents();
            $respuesta = json_decode($response_data);
        }
        return json_encode($respuesta);
    }

    public function buscarRUC(Request $request)
    {
        $respuesta = array();
        $ruc = $request->input('ruc');
        $client = new Client();
        $res = $client->get('http://comprobante-e.com/facturacion/buscaCliente/BuscaClienteRuc.php?&fe=N&token=qusEj_w7aHEpX&' . 'ruc=' . $ruc);
        if ($res->getStatusCode() == 200) { // 200 OK
            $response_data = $res->getBody()->getContents();
            $respuesta = json_decode($response_data);
        }
        return json_encode($respuesta);
    }
}
