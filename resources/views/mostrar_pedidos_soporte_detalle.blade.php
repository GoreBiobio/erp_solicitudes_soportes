<script type="text/javascript">
		function enviarEvaluacion(){
			if($('#obs').val() ==''){

			 var x = function callback(){
			 	$('#formEvaluacion').submit();

			}
			confirmar('Esta Seguro de enviar la evaluación sin Observación?',x);

			}else{
			var x = function callback(){
				$('#formEvaluacion').submit();

			}
			confirmar('Esta Seguro de enviar la evaluación del Soporte?',x);

			}
			
  }


</script>


<div class="box">
<div class="box-body">	
    <div class="row">
    <div class="col-xs-12 col-lg-6">
        <div class="form-group">
          <label class="col-sm-3 col-xs-12 " style="color:#3c8dbc;">Marca</label> 
          <label class="col-sm-9 col-xs-12">{{$infoSoli[0]->marca}}</label>
        </div>
      </div>
      <div class="col-xs-12 col-lg-6">
        <div class="form-group">
          <label class="col-sm-3 col-xs-12 " style="color:#3c8dbc;">Modelo</label> 
          <label class="col-sm-9 col-xs-12">{{$infoSoli[0]->modelo}}</label>
        </div>
      </div>
      <div class="clearfix "></div>
          <div class="col-xs-12 col-lg-6">
  <div class="form-group">
    <label class="col-sm-3 col-xs-12 " style="color:#3c8dbc;">N° de Serie</label> 
    <label class="col-sm-9 col-xs-12">{{$infoSoli[0]->numSerieHard}}</label>
  </div>
</div>
<div class="col-xs-12 col-lg-6">
  <div class="form-group">
    <label class="col-sm-3 col-xs-12 " style="color:#3c8dbc;">Fecha</label> 
    <label class="col-sm-9 col-xs-12">{{ date('d-m-Y', strtotime($infoSoli[0]->fecCreaSop))}}</label>
  </div>
</div>
<div class="clearfix "></div>
 </div> 
</div>

<div class="box-body">
  <div class="box-group" id="accordion">
    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
    <div class="panel box box-primary">
      <div class="box-header with-border">
        <h4 class="box-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">
            Ver Motivo de Solitud
          </a>
        </h4>
      </div>
      <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
        <div class="box-body">
          {{$infoSoli[0]->solicitudSop}}
        </div>
      </div>
    </div>
  </div>
</div>

</div>
            <!-- /.box-header -->

    @if($mostrar_recepcion ==1)
    <form class="form-horizontal" action="enviaCalificacion" method="post" id="formEvaluacion">
    	{{ csrf_field() }}
    	<input type="hidden" name="id" id="id" value="{{$infoSoli[0]->idSolSop}}">
    	<div class="box box-info">
            <div class="box-header with-border">
		      <h3 class="box-title">Calificar</h3>
		      <div class="box-header margenb5 pull-right hidden-print">
		        <a onclick="enviarEvaluacion();" class="btn btn-success btn-lg">
			    <span class="glyphicon glyphicon-send"></span> Enviar
			  </a>
			</div>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            
              <div class="box-body">
                <div class="form-group">
                  <label  class="col-sm-2 control-label">Calificación</label>

                  <div class="col-sm-8">
                    <select class="form-control" name="tipo_evaluacion" id="tipo_evaluacion">
                    	@foreach($tipos_evaluacion as $tipos_evaluacion)
                    	<option value="{{$tipos_evaluacion->idTev}}">{{$tipos_evaluacion->nombreTev}}</option>
                    	@endforeach
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Observación</label>

                  <div class="col-sm-8">
                    <textarea class="form-control" rows="3" name="obs" id="obs"></textarea>
                  </div>
                </div>
              </div>
            
          </div>
    </form>
    @endif        
            <!-- /.box-body -->


