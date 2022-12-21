    <div class="modal fade" id="rolModalSem" tabindex="-1" role="dialog" aria-labelledby="rolModalSemLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="rolModalSemLabel">Baja Rol: {{$nombre_rol}} - {{$data_sit}}</h5>
            <button id="btnCloseDeleteRol" type="button" class="close" data-bs-dismiss="modal" aria-label="Close" 
            onClick="closeRolDeleteModal()">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="container"> 
              <div class="alert alert-danger" style="display:none"></div>
              <form action="{{route('profesors.rolDelete')}}" method="POST">
                  @csrf
                  <div class="form-row">  
                    <div class="form-group col-lg-12 col-md-6">   
                        <input type="checkbox" class="form-check-input" id="mondayModalFrm" @if($r->lunes) checked @endif>
                        <label class="form-check-label" for="check1">Lunes</label>   
                </div>
            </div>
                <div class="form-row">  
                    <div class="form-group col-lg-12 col-md-6">    
                        <input type="checkbox" class="form-check-input" id="tuesdayModalFrm" @if($r->martes) checked @endif>
                        <label class="form-check-label" for="check1">Martes</label>  
                </div>
            </div>
                <div class="form-row">  
                    <div class="form-group col-lg-12 col-md-6">   
                        <input type="checkbox" class="form-check-input" id="wenesdayModalFrm" @if($r->miercoles) checked @endif>
                        <label class="form-check-label" for="check1">Miercoles</label> 
                </div>
            </div>
                <div class="form-row">  
                    <div class="form-group col-lg-12 col-md-6">     
                        <input type="checkbox" class="form-check-input" id="thursdayModalFrm" @if($r->jueves) checked @endif>
                        <label class="form-check-label" for="check1">Jueves</label>  
                </div>
            </div>
                <div class="form-row">  
                    <div class="form-group col-lg-12 col-md-6">   
                        <input type="checkbox" class="form-check-input" id="fridayModalFrm" @if($r->viernes) checked @endif>
                        <label class="form-check-label" for="check1">Viernes</label>  
                </div>
            </div>
                <div class="form-row">  
                    <div class="form-group col-lg-12 col-md-6">                 
                        <input type="checkbox" class="form-check-input" id="saturdayModalFrm" @if($r->sabado) checked @endif>
                        <label class="form-check-label" for="check1">Sabado</label>  
                </div>
            </div>
                  <br>
                </form>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" name="frmRolSem" id="frmRolSem" onClick="saveRolSem({{$r->id}},{{$r->id_rol_prof}})" >Grabar</button>
                    </div>
          </div>
          
          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>