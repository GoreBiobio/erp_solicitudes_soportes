@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')

@section('contentheader_title')
	Solicitudes	
@endsection

@section('contentheader_description')
	administrar
@endsection

<script type="text/javascript">

	function buscarSolicitudes(){
		fecha_desde = $('#fec0').val();
		fecha_hasta = $('#fec1').val();
		if (fecha_hasta != '' && fecha_desde > fecha_hasta) {
			$.notify("la fecha Desde debe ser mayor a la fecha hasta","warn");
		}else{
			$('#form_buscar').attr('action', 'buscarSolicitud');
			$('#form_buscar').submit();
		}
	}

	function administraSolicitud(id_solicud){
		$('#id_solicud').val(id_solicud);
		$('#form_buscar').attr('action', 'admSolicitud');
		$('#form_buscar').submit();
	}
	
</script>


<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Buscar Solicitudes</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" id="form_buscar" name="form_buscar">
            	{{ csrf_field() }}
              <input type="hidden" name="id_solicud" id="id_solicud">	
              <div class="box-body">
                <div class="form-group">
                  <label  class="col-sm-4 control-label">Nombre</label>

                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="nombre" name="nombre" value="{{$nombre}}">
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-4 control-label">Apellido Paterno</label>

                  <div class="col-sm-5">
                    <input type="text" class="form-control" id="apellidoPaterno" value="{{$apellidoPaterno}}" name="apellidoPaterno">
                  </div>
                </div>
                <div class="form-group">
                  <label  class="col-sm-4 control-label">Criticidad</label>

                  <div class="col-sm-5">
                    <select class="form-control" name="criticidad" id="criticidad">
                    	<option value="" @if($criticidad == '') selected="selected" @endif>Todas</option>
                    	<option value="3" @if($criticidad == '3') selected="selected" @endif>Alta</option>
                    	<option value="2" @if($criticidad == '2') selected="selected" @endif>Media</option>
                    	<option value="1" @if($criticidad == '1') selected="selected" @endif>Baja</option>
                    </select>
                  </div>
                </div>                
           		<div class="form-group">		
					<label class="col-xs-12 col-sm-4 control-label no-padding-right" for="form-field-1-1"> Fecha Desde/Hasta: </label>
					<div class="col-xs-12 col-sm-5">
						<div class="col-xs-12  input-group">
							<input type="date" name="fec0" id="fec0" value="{{$fec0}}" class="input-sm form-control input-mask-date" id="fecha_ini" data-rel="tooltip">
							<span class="input-group-addon">
								<i class="fa fa-exchange"></i>
							</span>
							<input type="date" name="fec1" id="fec1" value="{{$fec1}}" class="input-sm input-mask-date form-control" id="fecha_ter">
							
						</div>
						</div>		
				</div><!--form-group-->
              </div>
              <!-- /.box-body -->
              </form>
              <div class="box-footer">
                <center>
                	<button onclick="buscarSolicitudes()" class="btn btn-info" >Buscar</button>
                </center>
                
              </div>
              <!-- /.box-footer -->
            
          </div>
          @if(isset ($datosSolicitudes))
          <div class="box">
          	<div class="box-header">
          		<h3 class="box-title">Solicitudes</h3>
          	</div>
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin tabladinamica" id="tablaSoportes">
                  <thead>
                  <tr>
                    <th>Ticket</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Criticidad</th>
                    <th>Nombre Usuario</th>
                    <th>Tipo</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>ver</th>
                    <th>Estado</th>
                    <th style="text-align: center;">Acciones</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach ($datosSolicitudes as $indexKey => $datosSolicitudes)
                  <tr>
                    <td>{{$datosSolicitudes->idSolSop}}</td>
                    <td>{{ date('d-m-Y', strtotime($datosSolicitudes->fecCreaSop)) }}</td>
                    <td>{{ date('H:i', strtotime($datosSolicitudes->fecCreaSop)) }}</td>
                    <td>
                	   @if($datosSolicitudes->estadoCritSop == 1)
                          baja
                       @elseif($datosSolicitudes->estadoCritSop == 2)
                          media
                       @elseif($datosSolicitudes->estadoCritSop == 3)
                          alta
                       @endif
                    </td>
                    <td>{{$datosSolicitudes->nombresFunc}} {{$datosSolicitudes->paternoFunc}} {{$datosSolicitudes->maternoFunc}}</td>
                    <td>{{$datosSolicitudes->tipoHard}}</td>
                    <td>{{$datosSolicitudes->marca}}</td>
                    <td>{{$datosSolicitudes->modelo}}</td>
                    <td>    
                      <span type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#myModalsop{{$indexKey}}">
                       <i class="blue ace icon fa fa-expand"></i>
                      </span>
                    </td>
                   <td>
                    @if ($datosSolicitudes->estadoSop == 1)
                      enviado
                    @elseif ($datosSolicitudes->estadoSop == 2) 
                      Asignado a profesional informatica
                    @endif
                    </td>
                    <td style="text-align: center;">
                      <a type="button"  alt="administrar" onclick="administraSolicitud({{$datosSolicitudes->idSolSop}})" class="btn btn-info" >Administrar</a>
                    </td>
                  </tr>
                  <div class="modal fade" id="myModalsop{{$indexKey}}" tabindex="-1" role="dialog" aria-labelledby="myModalsop{{$indexKey}}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h4 class="modal-title" id="exampleModalLongTitle">Motivo Solicitud para {{$datosSolicitudes->marca}} {{$datosSolicitudes->modelo}}</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <div class="form-group">
                              <div class="col-sm-12">
                              <label class="col-sm-2 col-xs-12 " style="color:#3c8dbc;">Solicitud</label> 
                              <label class="col-sm-10 col-xs-12">
                              <p>{{$datosSolicitudes->solicitudSop}}</p>
                              </label>
                              </div> 
                              <div class="col-sm-12">
                              <label class="col-sm-2 col-xs-12 " style="color:#3c8dbc;">Criticidad</label> 
                              <label class="col-sm-10 col-xs-12">
                              @if($datosSolicitudes->estadoCritSop == 1)
                              baja
                              @elseif($datosSolicitudes->estadoCritSop == 2)
                              media
                              @elseif($datosSolicitudes->estadoCritSop == 3)
                              alta
                              @endif
                              </label>
                              </div>   
                            </div>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                          </div>
                        </div>
                      </div> 
                 
                  @endforeach 
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            </div>
            @endif
@endsection