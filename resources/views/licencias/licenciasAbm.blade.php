    <div class="modal fade" id="licModal" tabindex="-1" role="dialog" aria-labelledby="licModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            @if($lic->id < 1) 
            <h5 class="modal-title" id="licModalLabel">Crear Licencia</h5> 
            @else
            <h5 class="modal-title" id="licModalLabel">Editar Licencia: {{$lic_name}}</h5> 
            @endif
            <button id="btnCloseDeleteLic" type="button" class="close" data-bs-dismiss="modal" aria-label="Close" 
            onClick="closeLicModal()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container"> 
              <div class="alert alert-danger" id="alertLicDanger" style="display:none"></div>
              <form method="POST">
                  @csrf
                  <div class="form-row">  
                    <div class="form-group col-lg-12 col-md-6">  
                      <label for="inputApellido">Nombre</label> 
                        <input type="text" class="form-control" id="nameLicModalFrm" placeholder="Nombre" @if($lic->id>0) value="{{$lic->nombre}}" @endif> 
                </div>
            </div>
                <div class="form-row">  
                    <div class="form-group col-lg-12 col-md-6">    
                      <label for="inputApellido">Codigo</label>
                        <input type="text" class="form-control" id="codeLicModalFrm" placeholder="Codigo" @if($lic->id>0) value="{{$lic->codigo}}" @endif> 
                </div>
            </div>
                  <br>
                </form>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" name="licSaveFrm" id="licSaveFrm" onClick="saveLic({{$lic->id}})" >Grabar</button>
                    </div>
          </div>
          
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>