
            <form class="form-horizontal">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Marca</label>
                  <div class="col-sm-6">
                    <select class="form-control select2" name="marca" style="width: 100%;" tabindex="-1" aria-hidden="true" onchange="cargar(this.value);">
                    	<option value="">Seleccione..</option>

                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Modelo</label>
                  <div class="col-sm-6">
                   <select class="form-control" id="id_prueba" name="modelo">
            
                    </select>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" class="btn btn-info pull-right">Guardar</button>
              </div>
              <!-- /.box-footer -->
            </form>



          <div class="modal in printable" id="modal" >
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" onclick="cerrarModal();"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
						<h4 class="modal-title" id="modal-title"></h4>
					</div>
					<div class="modal-body" id = "modal-body">
					</div>
					<div class="modal-footer">	        
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->	