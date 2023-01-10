    <div class="modal fade" id="rolModalSem" tabindex="-1" role="dialog" aria-labelledby="rolModalSemLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="rolModalSemLabel">Baja Rol: {{ $nombre_rol }} - {{ $data_sit }}
                    </h5>
                    <button id="btnCloseDeleteRol" type="button" class="close" data-bs-dismiss="modal"
                        aria-label="Close" onClick="closeRolDeleteModal()">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="container">
                        <div class="alert alert-danger" style="display:none"></div>
                        <form action="{{ route('profesors.rolDelete') }}" method="POST">
                            @csrf
                            <div class="custom-control custom-switch">
                                <div class="form-row">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <input type="checkbox" class="custom-control-input"
                                            id="mondayModalFrm" @if (!$r->lunes) checked @endif>
                                        <label class="custom-control-label" for="mondayModalFrm">Lunes</label>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <input type="checkbox" class="custom-control-input" id="tuesdayModalFrm"
                                            @if (!$r->martes) checked @endif>
                                        <label class="custom-control-label" for="tuesdayModalFrm">Martes</label>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <input type="checkbox" class="custom-control-input"
                                            id="wenesdayModalFrm" @if (!$r->miercoles) checked @endif>
                                        <label class="custom-control-label" for="wenesdayModalFrm">Miercoles</label>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <input type="checkbox" class="custom-control-input"
                                            id="thursdayModalFrm" @if (!$r->jueves) checked @endif>
                                        <label class="custom-control-label" for="thursdayModalFrm">Jueves</label>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <input type="checkbox" class="custom-control-input"
                                            id="fridayModalFrm" @if (!$r->viernes) checked @endif>
                                        <label class="custom-control-label" for="fridayModalFrm">Viernes</label>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-lg-12 col-md-6">
                                        <input type="checkbox" class="custom-control-input"
                                            id="saturdayModalFrm" @if (!$r->sabado) checked @endif>
                                        <label class="custom-control-label" for="saturdayModalFrm">Sabado</label>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </form>
                        <div class="alert alert-warning " role="alert">
                          Deshabilitar los dias que no corresponda asistencia. 
                          <br>
                          Por defecto se establece asistencia.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" name="frmRolSem" id="frmRolSem"
                                onClick="saveRolSem({{ $r->id }},{{ $r->id_rol_prof }})">Grabar</button>
                        </div>
                        
                    </div>

                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

<style>
.custom-control-input:focus~.custom-control-label::before {
  border-color: green !important;
  box-shadow: 0 0 0 0.2rem rgba(255, 47, 69, 0.25) !important;
}

.custom-control-input:checked~.custom-control-label::before {
  border-color: green !important;
  background-color: green !important;
}

.custom-control-input:active~.custom-control-label::before {
  background-color: green !important;
  border-color: green !important;
}

.custom-control-input:focus:not(:checked)~.custom-control-label::before {
  border-color: green !important;
}

.custom-control-input-green:not(:disabled):active~.custom-control-label::before {
  background-color: green !important;
  border-color: green !important;
}
</style>
