<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
class solicitud_servicio extends Controller
{
    public function solicitaServicio(Request $request){
    $id_func = $request->input("id_func");	
    $id_serv = $request->input("id_serv");


      $criticidad= DB::table('servicio')
            ->select('ind_critico')
            ->where([
                ['idServ','=',$id_serv]
            ])
          ->get();

    $indicador_criticico = $criticidad[0]->ind_critico; 
    $dato_funcionario = DB::table('funcionarios')
    ->select('jefatura')
    ->where([['idFunc', '=',$id_func]])
    ->get();  

       return view('vistasSolicitudesSoporte.ingresaServicio',[
       	'id_func'=>$id_func,
        'id_serv'=>$id_serv,
        'indicador_criticico'=>$indicador_criticico,
        'indicador_jefatura'=>$dato_funcionario[0]->jefatura]);
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
                 'pedidoServicios'=>$pedidoServicios
            ]);
    }

    public function validarPin(Request $request){

      $id_usuario = $request->input('id_usuario');
      $pin_ingresado = sha1($request->input('pin'));

      $obtener = DB::select(DB::raw("
        select pin from pin_funcionarios
        where idFunc = $id_usuario
        order by fecha_ingreso_pin desc 
        limit 1"

      ));

      $pin_registrado = $obtener[0]->pin;
      
      if($pin_registrado == $pin_ingresado){
        echo "1"; 
      }else{
        echo "0";
      }


    }

}
