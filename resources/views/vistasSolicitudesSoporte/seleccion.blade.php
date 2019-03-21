
@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')


<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Horizontal Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Marca</label>
                  <div class="col-sm-6">
                    <select class="form-control select2" name="marca" style="width: 100%;" tabindex="-1" aria-hidden="true" onchange="cargar(this.value);">
                    	<option value="">Seleccione..</option>
                    	@foreach($marcas as $marcas)
                    	<option value="{{$marcas->idMarca}}">{{$marcas->marca}}</option>
                    	@endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Modelo</label>
                  <div class="col-sm-6">
                   <select class="form-control" id="id_prueba" name="modelo">
                    	@foreach($modelos as $modelos)
                    	<option value="{{$modelos->idModelo}}">{{$modelos->modelo}}</option>
                    	@endforeach
                    </select>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-default" id="boton_cancelar">Cancel</button>
                <button type="button" class="btn btn-info pull-right" onclick="cargar_datos_modal('Ejemplo Modal','ventana','si','pruebamodal');">Abrir Modal</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>


      <div class="modal in printable" id="modal" >
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="modal-title"></h4>
					</div>
					<div class="modal-body" id = "modal-body">
					</div>
					<div class="modal-footer">	        
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->	

@endsection