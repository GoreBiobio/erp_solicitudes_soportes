<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
use DB;

class solicitudSoporte extends Controller
{
    public function ingresaSolicitud(Request $request)
    {

    	$indice = $request->input("indice");

    	$fecha = new DateTime;

    	$soporte = $request->input("soporte".$indice);
    	$criticidad = $request->input("criticidad".$indice);
    	$id_hard = $request->input("idHard".$indice);
    	$id_func = $request->input("idFunc");
    	$algo = "1";
    	$estadoSop = "1";

    	        DB::table('solicitudsoportes')->insert([
                'fecCreaSop' => $fecha,
                'solicitudSop' => $soporte,
                'hardSop' => $id_hard,
                'tipoSopD' => $algo,
                'estadoCritSop' => $criticidad,
                'estadoSop' => $estadoSop,
                'funcSolicSop'=>$id_func
            ]);

       session()->put('success','Se ha ingresado su solicitud con exito.');
       return back();      
        $id_func = $id_func;
        $datos = datosFuncionariosId($id_func);
        $datosHard = datosHard($id_func);
        $pedidos = retornaSolicitudes($id_func);
        $tiposServ = retornaTiposServicios();
        $pedidoServicios = buscarSolicitudesServicios($id_func);

          return view('vistasSolicitudesSoporte.listadoHard',
            ['datosUsuario'=> $datos,
             'datosHard'=>$datosHard,
             'datosSolicitudes'=>$pedidos,
             'tiposServicios'=>$tiposServ,
             'pedidoServicios'=>$pedidoServicios,
             'id_usuario'=>$id_func
        ]);
    }
    public function anularSolicitud(Request $request)
    {
        $id_anula = $request->input("id_anula");
        $id_func = $request->input("idFunc");
        $estado=3;
          DB::table('solicitudsoportes')
          ->where('idSolSop', '=',$id_anula)
          ->update(['estadoSop' => $estado]);
        session()->put('success','Se ha anulado la solicitud.');
        return back();

        $datos = datosFuncionariosId($id_func);
        $datosHard = datosHard($id_func);
        $pedidos = retornaSolicitudes($id_func);
        $tiposServ = retornaTiposServicios();
        $pedidoServicios = buscarSolicitudesServicios($id_func);   
        session()->put('success','Se ha anulado la solicitud.');
              return view('vistasSolicitudesSoporte.listadoHard',
                ['datosUsuario'=> $datos,
                 'datosHard'=>$datosHard,
                 'datosSolicitudes'=>$pedidos,
                 'tiposServicios'=>$tiposServ,
                 'pedidoServicios'=>$pedidoServicios,
                 'id_usuario'=>$id_func
            ]);  

    }

    public function enviaSolicitudServicio_antigua(Request $request)
    {
          //dd($_POST);
          $indice = $request->input("indice");
          $fecha = new DateTime;

          $servicio = $request->input("servicio".$indice);
          $criticidad = $request->input("criticidadServ".$indice);
          $id_serv = $request->input("idserv".$indice);
          $id_func = $request->input("idFunc");
          $estadoSolServ = "1";
          DB::table('solicitud_Servicio')->insert([
                'fecCreaSolServ' => $fecha,
                'solicitudServ' => $servicio,
                'idServ' => $id_serv,
                'estadoCritSolServ' => $criticidad,
                'estadoSolServ' => $estadoSolServ,
                'funcSolServ'=>$id_func
            ]);


        $id_func = $id_func;
        $datos = datosFuncionariosId($id_func);
        $datosHard = datosHard($id_func);
        $pedidos = retornaSolicitudes($id_func);
        $tiposServ = retornaTiposServicios();
        $pedidoServicios = buscarSolicitudesServicios($id_func);
        session()->put('success','Se ha ingresado su solicitud con exito.');
              return view('vistasSolicitudesSoporte.listadoHard',
                ['datosUsuario'=> $datos,
                 'datosHard'=>$datosHard,
                 'datosSolicitudes'=>$pedidos,
                 'tiposServicios'=>$tiposServ,
                 'pedidoServicios'=>$pedidoServicios,
                 'id_usuario'=>$id_func
            ]);


    }

    public function enviaSolicitudServicio(Request $request)
    {

          $fecha = new DateTime;

          $servicio = $request->input("motivo_solicitud_servicio");
          $criticidad = $request->input("criticidad");
          $id_serv = $request->input("id_servicio");
          $id_func = $request->input("id_usuario");
          $estadoSolServ = "1";
          DB::table('solicitud_Servicio')->insert([
                'fecCreaSolServ' => $fecha,
                'solicitudServ' => $servicio,
                'idServ' => $id_serv,
                'estadoCritSolServ' => $criticidad,
                'estadoSolServ' => $estadoSolServ,
                'funcSolServ'=>$id_func
            ]);
        session()->put('success','Se ha ingresado su solicitud con exito.');
        return back(); 
        $id_func = $id_func;
        $datos = datosFuncionariosId($id_func);
        $datosHard = datosHard($id_func);
        $pedidos = retornaSolicitudes($id_func);
        $tiposServ = retornaTiposServicios();
        $pedidoServicios = buscarSolicitudesServicios($id_func);
        session()->put('success','Se ha ingresado su solicitud de servicio con exito.');
              return view('vistasSolicitudesSoporte.listadoHard',
                ['datosUsuario'=> $datos,
                 'datosHard'=>$datosHard,
                 'datosSolicitudes'=>$pedidos,
                 'tiposServicios'=>$tiposServ,
                 'pedidoServicios'=>$pedidoServicios,
                 'id_usuario'=>$id_func
            ]);
    }

  public function anularSolicitudServicio(Request $request)
    {

        $id_anula = $request->input("id_anula_servicio");
        $id_func = $request->input("idFunc");
        $estado=3;
          DB::table('solicitud_Servicio')
          ->where('idSolServ', '=',$id_anula)
          ->update(['estadoSolServ' => $estado]);
        session()->put('success','Se ha anulado su solicitud con exito.');
        return back();
        $datos = datosFuncionariosId($id_func);
        $datosHard = datosHard($id_func);
        $pedidos = retornaSolicitudes($id_func);
        $tiposServ = retornaTiposServicios();
        $pedidoServicios = buscarSolicitudesServicios($id_func);  

              return view('vistasSolicitudesSoporte.listadoHard',
                ['datosUsuario'=> $datos,
                 'datosHard'=>$datosHard,
                 'datosSolicitudes'=>$pedidos,
                 'tiposServicios'=>$tiposServ,
                 'pedidoServicios'=>$pedidoServicios,
                 'id_usuario'=>$id_func
            ]); 

    }

    public function recepcionaSolicitud(Request $request){

      $idFunc = $request->input("id_funcionario");
      $idSop = $request->input("id_solicitud");
      $mostrar_recepcion = 1;
       $pedidos = DB::table('solicitudsoportes')
            ->select('idSolSop','fecCreaSop','solicitudSop','numSerieHard','modelo','marca')
            ->join('hardwares', 'hardwares.idHard', '=', 'solicitudsoportes.hardSop')
            ->join('modelos', 'modelos.idModelo', '=', 'hardwares.modelos_idModelo')
            ->join('marcas', 'marcas.idMarca', '=', 'modelos.marcas_idMarca')
            ->join('funcionarios', 'funcionarios.idFunc', '=', 'solicitudsoportes.funcSolicSop')
            ->where([
                ['idFunc','=',$idFunc],
                ['idSolSop','=',$idSop]
            ])
          ->get();
        $tipos_evaluacion = DB::table('tipos_evaluacion')
        ->get();

         return view('mostrar_pedidos_soporte_detalle',[
            'infoSoli'=>$pedidos,
            'mostrar_recepcion'=>$mostrar_recepcion,
            'tipos_evaluacion'=>$tipos_evaluacion
          ]);

    }

    public function enviaCalificacion(Request $request){
      $fecha = new DateTime;
      $idSop = $request->input("id");
      $tipo_evaluacion = $request->input("tipo_evaluacion");
      $obs = $request->input("obs");
      DB::table('solicitudsoportes')
      ->where('idSolSop', '=',$idSop)
      ->update(['estadoSop' => 'Evaluado']);

      DB::table('evaluaciones_soportes')->insert([
        'calificacionEval' => $tipo_evaluacion,
        'obsEval' => $obs,
        'fechaEval' => $fecha,
        'idSolSop' => $idSop
      ]);
      session()->put('success','Se ha evaluado su solicitud con exito.');
      return back();   

    }
    
  }

  function datosFuncionariosId ($id_func){

  $datos = DB::table('funcionarios')
             ->select('*')
             ->join('departamentos','departamentos.idDepto','=','funcionarios.departamentos_idDepto')
             ->join('divisiones','divisiones.idDiv','=','departamentos.divisiones_idDiv')
             ->where('idFunc', '=', $id_func)
             ->get();
  return $datos;          

}

function datosHard($id_func){

  $datosHard = DB::table('funcionarios')
  ->join('comodatos', 'funcionarios.idFunc', '=', 'comodatos.funcRecibeComod')
  ->join('hardwares', 'hardwares.idHard', '=', 'comodatos.hardwares_idHard')
  ->join('modelos','modelos.idModelo','=','hardwares.modelos_idModelo')
  ->join('marcas','marcas.idMarca','=','modelos.marcas_idMarca')
  ->where([
      ['idFunc','=',$id_func],
      ['estadoComod','Activo']
  ])
->get();
return $datosHard;
}

function retornaSolicitudes($id_func){
  $pedidos = DB::table('solicitudsoportes')
            ->select('*')
            ->join('hardwares', 'hardwares.idHard', '=', 'solicitudsoportes.hardSop')
            ->join('modelos', 'modelos.idModelo', '=', 'hardwares.modelos_idModelo')
            ->join('marcas', 'marcas.idMarca', '=', 'modelos.marcas_idMarca')
            ->where([
                ['funcSolicSop','=',$id_func]
            ])
          ->get();
  return $pedidos;

}
function retornaTiposServicios(){

  $tiposServicios= DB::table('servicio')
            ->select('idServ','servicio')
          ->get();
  return $tiposServicios;        
}

function buscarSolicitudesServicios($id_func){

    $soliServicios = DB::table('solicitud_Servicio')
            ->select('*')
            ->join('servicio', 'servicio.idServ', '=', 'solicitud_Servicio.idServ')
            ->where([
                ['funcSolServ','=',$id_func]
            ])
          ->get();  
      
  return $soliServicios;        
}



