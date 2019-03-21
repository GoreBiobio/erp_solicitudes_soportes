@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')

@section('contentheader_title')
	Solicitud
@endsection

<script type="text/javascript">
	function AsignarSolicitud(){
		var nombreFunc = $("#funcionario_inf option:selected").text();
		var x = function callback(){
        
			$('#asignaPro').submit();
        
    }
    confirmar('¿Esta Seguro de '+nombreFunc+'?',x);
	}
</script>

<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Antecedentes Funcionario</h3>
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <div class="box-body">
      <div class="row">
        <div class="col-xs-12 col-lg-6">
            <div class="form-group">
              <label class="col-sm-3 col-xs-12 " style="color:#3c8dbc;">Rut</label> 
              <label class="col-sm-9 col-xs-12">{{$detalle[0]->	rutFunc}}</label>
            </div>
          </div>
          <div class="col-xs-12 col-lg-6">
            <div class="form-group">
              <label class="col-sm-3 col-xs-12 " style="color:#3c8dbc;">Nombre</label> 
              <label class="col-sm-9 col-xs-12">{{$detalle[0]->nombresFunc}} {{$detalle[0]->paternoFunc}} {{$detalle[0]->	maternoFunc}}</label>
            </div>
          </div>
          <div class="clearfix "></div>
     <div class="col-xs-12 col-lg-6">
      <div class="form-group">
        <label class="col-sm-3 col-xs-12 " style="color:#3c8dbc;">Departamento</label> 
        <label class="col-sm-9 col-xs-12">{{$detalle[0]->departamento}}</label>
      </div>
    </div>
    <div class="col-xs-12 col-lg-6">
      <div class="form-group">
        <label class="col-sm-3 col-xs-12 " style="color:#3c8dbc;">Division</label> 
        <label class="col-sm-9 col-xs-12">{{$detalle[0]->division}}</label>
      </div>
    </div>
    <div class="clearfix "></div>
    <div class="col-xs-12 col-lg-6">
      <div class="form-group">
        <label class="col-sm-3 col-xs-12 " style="color:#3c8dbc;">Correo</label> 
        <label class="col-sm-9 col-xs-12">{{$detalle[0]->correoFunc}}</label>
      </div>
    </div>
    <div class="col-xs-12 col-lg-6">
      <div class="form-group">
        <label class="col-sm-3 col-xs-12 " style="color:#3c8dbc;">Anexo</label> 
        <label class="col-sm-9 col-xs-12">{{$detalle[0]->anexoFunc}}</label>
      </div>
    </div>
    <div class="clearfix "></div>
    </div>  
    </div>
        
</div>

<div class="box box-primary">
    <div class="box-header with-border">
      <h3 class="box-title">Antecedentes Solicitud</h3>
    </div>
    <div class="box-body">
 		<div class="row">
			<div class="col-xs-12 col-lg-6">
				<div class="form-group">
				  <label class="col-sm-3 col-xs-12 " style="color:#3c8dbc;">Fecha</label> 
				  <label class="col-sm-9 col-xs-12">{{ date('d-m-Y', strtotime($detalle[0]->fecCreaSop))}}</label>
				</div>
			</div>
			<div class="col-xs-12 col-lg-6">
				<div class="form-group">
				  <label class="col-sm-3 col-xs-12 " style="color:#3c8dbc;">Hora</label> 
				  <label class="col-sm-9 col-xs-12">{{ date('H:i', strtotime($detalle[0]->fecCreaSop)) }}</label>
				</div>
			</div>
			<div class="clearfix "></div>
		</div>   	
		<div class="row">
			<div class="col-xs-12 col-lg-6">
				<div class="form-group">
				  <label class="col-sm-3 col-xs-12 " style="color:#3c8dbc;">Hardhare</label> 
				  <label class="col-sm-9 col-xs-12">{{$detalle[0]->tipoHard}}</label>
				</div>
			</div>
			<div class="col-xs-12 col-lg-6">
				<div class="form-group">
				  <label class="col-sm-3 col-xs-12 " style="color:#3c8dbc;">Marca</label> 
				  <label class="col-sm-9 col-xs-12">{{$detalle[0]->marca}}</label>
				</div>
			</div>
			<div class="clearfix "></div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-lg-6">
				<div class="form-group">
				  <label class="col-sm-3 col-xs-12 " style="color:#3c8dbc;">Modelo:</label> 
				  <label class="col-sm-9 col-xs-12">{{$detalle[0]->modelo}}</label>
				</div>
			</div>
			<div class="col-xs-12 col-lg-6">
				<div class="form-group">
				  <label class="col-sm-3 col-xs-12 " style="color:#3c8dbc;">Motivo</label> 
				  <label class="col-sm-9 col-xs-12">{{$detalle[0]->solicitudSop}}</label>
				</div>
			</div>			
			<div class="clearfix "></div>
		</div>			
	</div>
</div>	

<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Asignar Profesional</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" action="enviaProfesional" name="asignaPro" id="asignaPro" method="post" >
            	{{ csrf_field() }}
              <input type="hidden" name="id_solicitud" value="{{$detalle[0]->idSolSop}}">		
              <div class="box-body">
                <div class="form-group">
                  <label  class="col-sm-3 control-label">Nombre</label>

                  <div class="col-sm-5">
                    <select class="form-control" name="funcionario_inf" id="funcionario_inf">
                    	@foreach ($personal_informatica as $indexKey => $personal_informatica)
                    	<option value="{{$personal_informatica->idFunc}}" @if($personal_informatica->idFunc == 3) selected="selected" @endif>{{$personal_informatica->nombresFunc}} {{$personal_informatica->paternoFunc}} {{$personal_informatica->maternoFunc}}</option>
                    	@endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-3 control-label">Observación</label>

                  <div class="col-sm-5">
                    <textarea class="form-control" name="observacion"></textarea>
                  </div>
                </div>                
              </div>
              </form>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right"  onclick="AsignarSolicitud()">Asignar</button>
              </div>
              <!-- /.box-footer -->
            
          </div>

@endsection