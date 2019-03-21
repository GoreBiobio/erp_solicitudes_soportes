<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class inicio extends Controller
{
    public function recibirRut(Request $request)
    {	
    	$rut = $request->input("rut");
	    $datos = DB::table('funcionarios')
	     ->select('*')
	     ->where('rutFunc', '=', $rut)
	     ->get();

	     if(count($datos) == 0){
	     	 $rutinvalido = 1;
            return view('vistasSolicitudesSoporte.ingresar',
                ['rutIngresado' =>$rut,
                 'rutinvalido' => $rutinvalido
            ]);
	     }else{
			    session_start();
		    	$_SESSION["rut"]=$rut;
		    	$numero_solicitudes = cargar_datos($rut);
    			return view('inicio',[
    		'soportes' => $numero_solicitudes[1],
    		'id'=>$numero_solicitudes[0],
    		'soportes_terminados'=> $numero_solicitudes[2],
    		'soportes_pendientes'=> $numero_solicitudes[3]
    	]);
	     }
    }

    public function volver_inicio(Request $request)
    {	

    	session_start();
        $rut = $_SESSION['rut'];
    	$numero_solicitudes = cargar_datos($rut);
    	return view('inicio',[
    		'soportes' => $numero_solicitudes[1],
    		'id'=>$numero_solicitudes[0],
    		'soportes_terminados'=> $numero_solicitudes[2],
    		'soportes_pendientes'=> $numero_solicitudes[3]
    	]);
    }

     public function mostrar_pedidos_soportes(Request $request)
    {	
    	
    	$id = $request->input("id");
    	$pedidos = DB::table('solicitudsoportes')
            ->select('*')
            ->join('hardwares', 'hardwares.idHard', '=', 'solicitudsoportes.hardSop')
            ->join('modelos', 'modelos.idModelo', '=', 'hardwares.modelos_idModelo')
            ->join('marcas', 'marcas.idMarca', '=', 'modelos.marcas_idMarca')
            ->join('funcionarios', 'funcionarios.idFunc', '=', 'solicitudsoportes.funcSolicSop')
            ->where([
                ['idFunc','=',$id ],
                ['estadoSop','!=','Evaluado']
            ])
          ->get();
    	
          return view('mostrar_pedidos_soporte',[
          	'datosSolicitudes'=>$pedidos
          ]);


    }

    public function verDetalleSoporte(Request $request){
    	$mostrar_recepcion = 0;
    	$idFunc = $request->input("idFunc");
    	$idSop = $request->input("idSop");
    	 $pedidos = DB::table('solicitudsoportes')
            ->select('idSolSop','fecCreaSop','solicitudSop','numSerieHard','modelo','marca')
            ->join('hardwares', 'hardwares.idHard', '=', 'solicitudsoportes.hardSop')
            ->join('modelos', 'modelos.idModelo', '=', 'hardwares.modelos_idModelo')
            ->join('marcas', 'marcas.idMarca', '=', 'modelos.marcas_idMarca')
            ->join('funcionarios', 'funcionarios.idFunc', '=', 'solicitudsoportes.funcSolicSop')
            ->where([
                ['idFunc','=',$idFunc ],
                ['idSolSop','=',$idSop]
            ])
          ->get(); 
         return view('mostrar_pedidos_soporte_detalle',[
          	'infoSoli'=>$pedidos,
          	'mostrar_recepcion'=>$mostrar_recepcion
          ]);


    }
        public function verDetalleSoporteTerminado(Request $request){

    	$idFunc = $request->input("idFunc");
    	$idSop = $request->input("idSop");
    	 $pedidos = DB::table('solicitudsoportes')
            ->select('solicitudsoportes.idSolSop','fecCreaSop','solicitudSop','numSerieHard','modelo','marca','nombreTev','obsEval','obsSoftSop')
            ->join('hardwares', 'hardwares.idHard', '=', 'solicitudsoportes.hardSop')
            ->join('modelos', 'modelos.idModelo', '=', 'hardwares.modelos_idModelo')
            ->join('marcas', 'marcas.idMarca', '=', 'modelos.marcas_idMarca')
            ->join('funcionarios', 'funcionarios.idFunc', '=', 'solicitudsoportes.funcSolicSop')
            ->join('evaluaciones_soportes', 'evaluaciones_soportes.idSolSop', '=' ,'solicitudsoportes.idSolSop')
            ->join('tipos_evaluacion', 'tipos_evaluacion.idTev', '=' ,'evaluaciones_soportes.calificacionEval')
            ->where([
                ['solicitudsoportes.funcSolicSop','=',$idFunc],
                ['solicitudsoportes.idSolSop','=',$idSop]
            ])
          ->get(); 
         return view('mostrar_soportes_terminados_detalle',[
          	'infoSoli'=>$pedidos
          ]);


    }

    public function mostrar_soportes_terminados(Request $request)
    {	
    	$id = $request->input('id');
    	$evaluados = DB::table('solicitudsoportes')
            ->select('*')
            ->join('hardwares', 'hardwares.idHard', '=', 'solicitudsoportes.hardSop')
            ->join('modelos', 'modelos.idModelo', '=', 'hardwares.modelos_idModelo')
            ->join('marcas', 'marcas.idMarca', '=', 'modelos.marcas_idMarca')
            ->join('funcionarios', 'funcionarios.idFunc', '=', 'solicitudsoportes.funcSolicSop')
            ->where([
                ['idFunc','=',$id ],
                ['estadoSop','=','Evaluado']
            ])
          ->get();
         
         return view('mostrar_soportes_terminados',[
          	'datosSolicitudes'=>$evaluados
          ]);
    }
}

     function cargar_datos($rut){
     	$arrayDatos = array();
     	$datos = DB::table('funcionarios')
	     ->select('idFunc')
	     ->where('rutFunc', '=', $rut)
	     ->get();
    	$user = DB::table('funcionarios')->where('rutFunc', $rut)->first();
    	$idFunc = $user->idFunc;
    	$solicitudes = DB::table('solicitudsoportes')->where([['funcSolicSop', $idFunc],['estadoSop',1]])->count();
    	$solicitudes_terminadas = DB::table('solicitudsoportes')->where([['funcSolicSop', $idFunc],['estadoSop','Evaluado']])->count();
    	$solicitudes_pendientes = DB::table('solicitudsoportes')->where([['funcSolicSop', $idFunc],['estadoSop','!=','Evaluado'],['estadoSop','!=','3']])->count();
    	array_push($arrayDatos,$idFunc,$solicitudes,$solicitudes_terminadas,$solicitudes_pendientes);
    	return $arrayDatos;
    }


    function cargar_datos_pedidos($id){

    	$pedidos = DB::table('solicitudsoportes')
            ->select('*')
            ->join('hardwares', 'hardwares.idHard', '=', 'solicitudsoportes.hardSop')
            ->join('modelos', 'modelos.idModelo', '=', 'hardwares.modelos_idModelo')
            ->join('marcas', 'marcas.idMarca', '=', 'modelos.marcas_idMarca')
            ->join('funcionarios', 'funcionarios.idFunc', '=', 'solicitudsoportes.funcSolicSop')
            ->where([
                ['idFunc','=',$id ]
            ])
          ->get();
        return $pedidos; 	

    
}