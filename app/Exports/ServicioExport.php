<?php

namespace App\Exports;

use App\solicitud_servicio;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use DB;
class ServicioExport implements FromQuery

{	

	use Exportable;

    public function __construct(int $id)
    {
        $this->id = $id;

    }

    public function query()
    {
        
             $datos = DB::table('funcionarios')
             ->select('*')
             ->join('departamentos','departamentos.idDepto','=','funcionarios.departamentos_idDepto')
             ->join('divisiones','divisiones.idDiv','=','departamentos.divisiones_idDiv')
             ->where('idFunc', '=', $this->id)
             ->get()->toArray();
             return $datos;
        //return $datos;

    }

}
