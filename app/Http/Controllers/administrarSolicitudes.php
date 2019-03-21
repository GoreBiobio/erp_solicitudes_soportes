<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class administrarSolicitudes extends Controller
{
    public function inicio(){
    $nombre = '';
    $apellidoPaterno = '';
    $criticidad = '';
    $fec0 = '';
    $fec1='';	

    return view('vistasSolicitudesSoporte.buscarSolicitudes',[
    		'nombre'=>$nombre,
    		'apellidoPaterno'=>$apellidoPaterno,
    		'criticidad'=>$criticidad,
    		'fec0'=>$fec0,
    		'fec1'=>$fec1
    		]);  
    }

    public function buscaSolicitudes(Request $request){
    
   		$nombre = $request->input("nombre");
    	$apellido = $request->input("apellidoPaterno");
    	$fecha_inicio = $request->input("fec0");
    	$fecha_termino = $request->input("fec1");
    	$criticidad = $request->input("criticidad");
    	$datos  = DB::table('solicitudsoportes')
    	  ->select('*')
    	  ->join('hardwares', 'hardwares.idHard', '=', 'solicitudsoportes.hardSop')
          ->join('modelos', 'modelos.idModelo', '=', 'hardwares.modelos_idModelo')
          ->join('marcas', 'marcas.idMarca', '=', 'modelos.marcas_idMarca')
          ->join('funcionarios', 'funcionarios.idFunc', '=', 'solicitudsoportes.funcSolicSop')
	         ->where(function($query) use ($fecha_inicio)
	          { 
	          	if($fecha_inicio <> ''){
	          		$query->where('fecCreaSop', '>=',$fecha_inicio.' 00:00:01');
	          	}	
	          	
	          })
	      	 ->where(function($query) use ($fecha_termino)
	          { 
	          	if($fecha_termino <> ''){
	          		$query->where('fecCreaSop', '<=',$fecha_termino.' 23:59:00');
	          	}	
	          	
	          })  	      
	      ->where(function($query) use ($nombre)
	          { 
	          	if($nombre <> ''){
	          		$query->where('nombresFunc', 'like',$nombre.'%');
	          	}	
	          	
	          })  
	      ->where(function($query) use ($apellido)
	          { 
	          	if($apellido <> ''){
	          		$query->where('paternoFunc', 'like',$apellido.'%');
	          	}	
	          	
	          })
	      ->where(function($query) use ($criticidad)
	          { 
	          	if($criticidad <> ''){
	          		$query->where('estadoCritSop', '=',$criticidad);
	          	}	
	          	
	          })        
	              
        ->get();
       // ->toSql();
       //dd($datos); 
    return view('vistasSolicitudesSoporte.buscarSolicitudes',
                ['datosSolicitudes'=> $datos,
                'nombre'=>$nombre,
	    		'apellidoPaterno'=>$apellido,
	    		'criticidad'=>$criticidad,
	    		'fec0'=>$fecha_inicio,
	    		'fec1'=>$fecha_termino
            ]);        
    }

    public function administar(Request $request){

    	  $id = $request->input("id_solicud");	
    	  $detalle = DB::table('solicitudsoportes')
            ->select('*')
            ->join('hardwares', 'hardwares.idHard', '=', 'solicitudsoportes.hardSop')
            ->join('modelos', 'modelos.idModelo', '=', 'hardwares.modelos_idModelo')
            ->join('marcas', 'marcas.idMarca', '=', 'modelos.marcas_idMarca')
            ->join('funcionarios','funcionarios.idFunc','=','solicitudsoportes.funcSolicSop')
            ->join('departamentos','departamentos.idDepto','=','funcionarios.departamentos_idDepto')
            ->join('divisiones','divisiones.idDiv','=','departamentos.divisiones_idDiv')
            ->where([
                ['idSolSop','=',$id]
            ])
          ->get();

          $funcionarios_informatica = DB::table('funcionarios')
            ->select('*')
            ->join('departamentos','funcionarios.departamentos_idDepto','=','departamentos.idDepto') 
            ->where([
                ['departamentos.idDepto','=','6'],
                ['funcionarios.estadoFunc','=','1']
            ])
            ->get();
       	//dd($funcionarios_informatica);
    	return view('vistasSolicitudesSoporte.adminSolicitud',[
    		'detalle'=>$detalle,
    		'personal_informatica'=>$funcionarios_informatica

    	]);
    }

    public function asignarProdesional(Request $request){

    	echo "nada porque esta hecho";


    }
}
