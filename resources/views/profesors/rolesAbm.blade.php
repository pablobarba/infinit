<div class="modal fade" id="rolModalCreate" tabindex="-1" role="dialog" aria-labelledby="rolModalCreateLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
@if($rxps->id < 1) 
          <h5 class="modal-title" id="rolModalCreateLabel">Crear Rol: {{$profesor->nombre}} {{$profesor->apellido}} </h5>
@else
<h5 class="modal-title" id="rolModalCreateLabel">Editar Rol:{{$rxps->nombre_rol}} - {{$rxps->sit_revista}} </h5>
@endif
          <button id="btnRolCloseCreate" type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container"> 
            <div class="alert alert-danger" style="display:none"></div>
            <form method="POST">
                @csrf
                <div class="form-row">     
                    @if($rxps->id<=0)
                  <div class="form-group col-lg-12 col-md-6">
                    <label for="inputRol">Rol *</label>
                    <select class="form-select"  name="rolfrm" id="rolfrm">
                      <option value="">--Por favor seleccionar una opcion--</option>
                      @foreach($roles as $rol)
                          <option value="{{ $rol->id }}">
                              {{ $rol->nombre }}
                          </option>
                  
                      @endforeach
                      </select>
                  </div>
                  @endif

                  <div class="form-group col-lg-12 col-md-6">
                    <label for="inputDate">Sit Revista *</label>
                    <input type="text" name="sitRevistafrm" id="sitRevistafrm" class="form-control" placeholder="Sit Revista" @if($rxps->id>0) value="{{$rxps->sit_revista}}" @endif/>
                  </div>
                  <div class="form-group col-lg-12 col-md-6">
                    <label for="inputDate">Observacion</label>
                    <input type="text" name="observacionfrm" id="observacionfrm" class="form-control" placeholder="Observacion visible en reporte" @if($rxps->id>0) value="{{$rxps->observacion}}" @endif maxlength="50"/>
                  </div>
                  <div class="form-group col-lg-12 col-md-6">
                    <label for="inputDate">Descripcion</label>
                    <input type="text" name="descripcionfrm" id="descripcionfrm" class="form-control" placeholder="Descripcion corta para identificar Rol" @if($rxps->id>0) value="{{$rxps->descripcion}}" @endif maxlength="10"/>
                  </div>
                </div>
                <div class="form-group col-md-6">
                    <input name="legajo" id="legajo" type="hidden" value="{{ $profesor->legajo }}"/>
                </div>
                <br>
              </form>
              <div class="modal-footer">
                      <button type="button" class="btn btn-primary" id="formSubmit" onClick="saveRolAbm({{$rxps->id}})">Grabar</button>
                  </div>
        </div>
        
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
  