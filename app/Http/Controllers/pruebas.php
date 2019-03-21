<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;

class pruebas extends Controller
{
    
	public function ingresar(){

        $rut = '';
        $rutinvalido = '';
        return view('vistasSolicitudesSoporte.ingresar',
                ['rutIngresado' =>$rut,
                 'rutinvalido' => $rutinvalido
            ]);
    }


    public function excel()
    {
     $customer_data = DB::table('funcionarios')->get()->toArray();
     $customer_array[] = array('nombre', 'paterno', 'materno');
     foreach($customer_data as $customer)
     {
      $customer_array[] = array(
       'nombre'  => $customer->nombresFunc,
       'paterno'   => $customer->maternoFunc,
       'materno'    => $customer->paternoFunc
      );
     }
     Excel::create('Customer Data', function($excel) use ($customer_array){
      $excel->setTitle('Customer Data');
      $excel->sheet('Customer Data', function($sheet) use ($customer_array){
       $sheet->fromArray($customer_array, null, 'A1', false, false);
      });
     })->download('xlsx');
    }


    public function seleccion(){

        $marcas = DB::table('marcas')
             ->get();
        $modelos = DB::table('modelos')
             ->get();     
            
        return view('vistasSolicitudesSoporte.seleccion',
            ["marcas"=>$marcas,
             "modelos"=>$modelos
            ]);
    }

    public function dinamicos(){

        $id_marca =  $_GET["seleccionado"];
        $modelos = DB::table('modelos')
            ->where([
                ['marcas_idMarca','=',$id_marca]
            ])
            ->get();
        
        foreach ($modelos as $key => $value) {
                echo '<option value="'.$modelos[$key]->idModelo.'">'.$modelos[$key]->modelo.'</option>';       
            }   


    }

    public function hola(){
      $id_consulta = 8
      ;
       $lista = DB::select(DB::raw(
        "SELECT * FROM hardwares a JOIN modelos m on a.modelos_idModelo = m.idModelo JOIN marcas ma on ma.idMarca = m.marcas_idMarca WHERE a.idHard Not IN (SELECT id_hard FROM software_equipo WHERE idsoft = $id_consulta and  estado_seq = 1)"
       ));

      /* $resultado =DB::select(DB::raw("SELECT idSoft, 
            nombreSoft, 
            cantidadSoft as cantidad,
            (cantidadSoft - (SELECT COUNT(id_hard) FROM software_equipo e WHERE  e.idsoft = s.idSoft and estado_seq = 1)) as restantes,
            (SELECT COUNT(id_hard) FROM software_equipo e WHERE e.idsoft = s.idSoft ) as Instalados 
            from softwares s"));*/

       $resultado2 =DB::select(DB::raw(
        "SELECT idSoft,
        nombreSoft,
        tipoASoft,
        (SELECT nombreTipo FROM tipos t WHERE t.idTipo = s.tipoASoft) as nombreTipoA,
        tipoBSoft,
        (SELECT nombreTipo FROM tipos t WHERE t.idTipo = s.tipoBSoft) as nombreTipoB,
        tipoCSoft,
        (SELECT nombreTipo FROM tipos t WHERE t.idTipo = s.tipoCSoft) as nombreTipoC
        FROM softwares s"
        ));
         dd($resultado2);

    
    }


    public function mostrarAlgo(){
       return view('vistasSolicitudesSoporte.otravista');
    }
    public function algo(){

        dd($_GET);
        return view('vistasSolicitudesSoporte.vista_prueba');
    }
    public function validarExisteUsuario(Request $request)
    {   
        
        session_start();
        $rut = $_SESSION['rut'];
        $datos = DB::table('funcionarios')
             ->select('*')
             ->join('departamentos','departamentos.idDepto','=','funcionarios.departamentos_idDepto')
             ->join('divisiones','divisiones.idDiv','=','departamentos.divisiones_idDiv')
             ->where('rutFunc', '=', $rut)
             ->get();

        $datosHard = DB::table('funcionarios')
            ->join('comodatos', 'funcionarios.idFunc', '=', 'comodatos.funcRecibeComod')
            ->join('hardwares', 'hardwares.idHard', '=', 'comodatos.hardwares_idHard')
            ->join('modelos','modelos.idModelo','=','hardwares.modelos_idModelo')
            ->join('marcas','marcas.idMarca','=','modelos.marcas_idMarca')
            ->where([
                ['rutFunc','=',$rut],
                ['estadoComod','Activo']
            ])
            ->get();

        $pedidos = DB::table('solicitudsoportes')
            ->select('*')
            ->join('hardwares', 'hardwares.idHard', '=', 'solicitudsoportes.hardSop')
            ->join('modelos', 'modelos.idModelo', '=', 'hardwares.modelos_idModelo')
            ->join('marcas', 'marcas.idMarca', '=', 'modelos.marcas_idMarca')
            ->join('funcionarios', 'funcionarios.idFunc', '=', 'solicitudsoportes.funcSolicSop')
            ->where([
                ['rutFunc','=',$rut]
            ])
          ->get();


        $tiposServicios= DB::table('servicio')
            ->select('idServ','servicio')
          ->get();  

        $pedidoServicios = DB::table('solicitud_Servicio')
            ->select('*')
            ->join('servicio', 'servicio.idServ', '=', 'solicitud_Servicio.idServ')
            ->join('funcionarios','funcionarios.idFunc','=','solicitud_Servicio.funcSolServ')
            ->where([
                ['rutFunc','=',$rut]
            ])
          ->get();  
        $id_usuario = $datos[0]->idFunc;
        if(count($datos)> 0){
        	return view('vistasSolicitudesSoporte.listadoHard',
                ['datosUsuario'=> $datos,
                 'datosHard'=>$datosHard,
                 'datosSolicitudes'=>$pedidos,
                 'tiposServicios'=>$tiposServicios,
                 'pedidoServicios'=>$pedidoServicios,
                 'id_usuario'=>$id_usuario,
                 'rut'=>$rut
            ]);
        }
        else{
            $rutinvalido = 1;
            return view('vistasSolicitudesSoporte.ingresar',
                ['rutIngresado' =>$rut,
                 'rutinvalido' => $rutinvalido
            ]);
        }
    }
}
