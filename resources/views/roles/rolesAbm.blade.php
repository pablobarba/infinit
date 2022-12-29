    <div class="modal fade" id="rolModal" tabindex="-1" role="dialog" aria-labelledby="rolModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            @if($rol->id < 1) 
            <h5 class="modal-title" id="rolModalLabel">Crear Rol</h5> 
            @else
            <h5 class="modal-title" id="rolModalLabel">Editar Rol: {{$rol_name}}</h5> 
            @endif
            <button id="btnCloseDeleteRol" type="button" class="close" data-bs-dismiss="modal" aria-label="Close" 
            onClick="closeRolModal()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container"> 
              <div class="alert alert-danger" id="alertRolDanger" style="display:none"></div>
              <form method="POST">
                  @csrf
                  <div class="form-row">  
                    <div class="form-group col-lg-12 col-md-6">  
                      <label for="inputApellido">Nombre</label> 
                        <input type="text" class="form-control" id="nameRolModalFrm" placeholder="Nombre" @if($rol->id>0) value="{{$rol->nombre}}" @endif> 
                </div>
            </div>
                <div class="form-row">  
                    <div class="form-group col-lg-12 col-md-6">    
                      <label for="inputApellido">Codigo</label>
                        <input type="text" class="form-control" id="codeRolModalFrm" placeholder="Codigo" @if($rol->id>0) value="{{$rol->codigo}}" @endif> 
                </div>
            </div>
                  <br>
                </form>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" name="rolSaveFrm" id="rolSaveFrm" onClick="saveRol({{$rol->id}})" >Grabar</button>
                    </div>
          </div>
          
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>