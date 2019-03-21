<?php

//namespace App\Exports;

use Illuminate\Http\Request;
use DateTime;
use DB;
class ExportExcelController extends Controllers
{
    public function index()
    {
          $datos = DB::table('funcionarios')
             ->select('*')
             ->join('departamentos','departamentos.idDepto','=','funcionarios.departamentos_idDepto')
             ->join('divisiones','divisiones.idDiv','=','departamentos.divisiones_idDiv')
             ->get();
    }
}
