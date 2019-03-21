
@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')

<script type="text/javascript">
	
function cargar_detalle(opcion){

var id=$('#id').val();

switch (opcion) {
  case '1':
    var url = "consulta_soportes_pedidos?id=";
    break;
  case '2':
    var url = "consulta_soportes_terminados?id=";
    break;
  case '3':
    var url = "consulta_servicios_pedidos?id=";
    break;
  case '4':
    var url = "consulta_servicios_terminados?id=";
    break;
}	

$.ajax({
   url: url+id,
   dataType: "html",
   success: function(html) {
      $("#muestra_detalle").html(html);
   }
});
}
</script>
<input type="hidden" name="id" id="id" value="{{$id}}">
<div class="col-lg-3 col-xs-6 ">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$soportes_pendientes}}</h3>
              <p>Soportes Pendientes</p>
            </div>
            <div class="icon">
              <i class="fa fa-pencil-square-o"></i>
            </div>
            <a href="#" onclick="cargar_detalle('1');" class="small-box-footer">
              Más información <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$soportes_terminados}}</h3>
              <p>Soportes Terminados</p>
            </div>
            <div class="icon">
              <i class="fa fa-check-square-o"></i>
            </div>
            <a href="#" onclick="cargar_detalle('2');" class="small-box-footer">
              Más información <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div> 
<div class="col-lg-3 col-xs-6 ">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>
              <p>Solicitudes Servicios</p>
            </div>
            <div class="icon">
              <i class="fa fa-tasks"></i>
            </div>
            <a href="#" onclick="" class="small-box-footer">
              Más información <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div>
<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>53<sup style="font-size: 20px">%</sup></h3>
              <p>Servicios Terminados</p>
            </div>
            <div class="icon">
              <i class="fa fa-check-square-o"></i>
            </div>
            <a href="#" class="small-box-footer">
              Más información <i class="fa fa-arrow-circle-right"></i>
            </a>
          </div>
        </div> 

<div class="col-md-12" id="muestra_detalle">
	


</div>                       
@endsection