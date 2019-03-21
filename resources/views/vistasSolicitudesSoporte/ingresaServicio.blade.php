<script type="text/javascript">


    $(document).ready(function() {
      $("#servicio").keypress(function(e) {
          if (e.which == 13) {
              return false;
          }
      });
    });

	function enviarServicio(){

     var envia = true;     
     var indicador_critico = $("#critico").val();
     var indicador_jefatura = $('#jefatura').val();
     var servicio = $("#motivo_solicitud_servicio").val();
    if(servicio == ''){ 
        makeGritter("Advertencia", "Debe Ingresar Motivo", "warning");
        return;

      } 
    var x = function callback(){

  	if ((indicador_critico == 1) && (indicador_jefatura =='SI') ){
		$('#divPin').show();
		if($('#pin').val() == ''){
      makeGritter("Advertencia", "Debe Ingresar Pin Para esta Solicitud", "warning"); 
			return;
		} else{

      var dataString = $('#servicio').serialize();

        $.ajax({
            type: "POST",
            url: "/validarPin",
            data: dataString,
            success: function(data) {

              if(data != '1') {
                makeGritter("Advertencia", "Pin de Seguridad no valido", "danger");
                return;
              }else{
                $("#servicio").submit();
              }

            }
        });

    }

 
	 }else{
    $("#servicio").submit();
   }
       
      }
      confirmar('Esta Seguro de enviar Solicitud Servicio?',x);
  }
</script> 
<form class="form-horizontal" name="servicio" id="servicio" method="post" action="recibeSolicitudServicio">
	{{ csrf_field() }}
	<input type="hidden" name="id_usuario" value="{{$id_func}}">
	<input type="hidden" name="id_servicio" value="{{$id_serv}}">
	<input type="hidden" name="critico" id="critico" value="{{$indicador_criticico}}">
  <input type="hidden" name="jefatura" id="jefatura" value="{{$indicador_jefatura}}">
  <div class="box-body" id="form_enviar">
    <div class="form-group">
      <label class="col-sm-3 control-label">Criticidad</label>
      <div class="col-sm-6">
			<select class="form-control" name="criticidad">
			<option value="1">Baja</option>
			<option value="2">Media</option>
			<option value="3">Alta</option>
			</select> 
      </div>
    </div>
    <div class="form-group">
      <label for="inputPassword3" class="col-sm-3 control-label">Solicitud</label>
      <div class="col-sm-6" >
       <textarea class="form-control" id="motivo_solicitud_servicio" name="motivo_solicitud_servicio"></textarea>
      </div>
    </div>
    <div class="form-group " id="divPin" style="display: none">
      <label  class="col-sm-3 control-label">Pin</label>
      <div class="col-sm-6" >
       <input type="password" id="pin" class="form-control" required="required" maxlength="4" name="pin">
      </div>
    </div>
  </div>
  <div class="box-footer">
    <button type="button" class="btn btn-info pull-right" onclick="enviarServicio();">Guardar</button>
  </div>
</form>

