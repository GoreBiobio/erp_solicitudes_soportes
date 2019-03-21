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
     <div class="panel box box-info">
      <div class="box-header with-border">
        <h4 class="box-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false" class="collapsed">
            Ver Observación Personal Informatica
          </a>
        </h4>
      </div>
      <div id="collapse2" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
        <div class="box-body">
          {{$infoSoli[0]->solicitudSop}}
        </div>
      </div>
    </div>

    <div class="panel box box-success">
      <div class="box-header with-border">
        <h4 class="box-title">
          <a data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false" class="collapsed">
            Ver Observación Evaluación
          </a>
        </h4>
      </div>
      <div id="collapse3" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
        <div class="box-body">
          <b>Calificación:</b>
          <p>{{$infoSoli[0]->nombreTev}}</p> 
          <b>Observacion:</b>
          @if($infoSoli[0]->obsEval != '')
          <p>{{$infoSoli[0]->obsEval}}</p> 
          @else
          <p>Sin Observación</p>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

</div>

   
            <!-- /.box-body -->
