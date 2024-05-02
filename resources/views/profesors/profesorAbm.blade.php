<div class="modal fade" id="profModal" tabindex="-1" role="dialog" aria-labelledby="profModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            @if($prof->id < 1) 
            <h5 class="modal-title" id="licModalLabel">Crear Profesor</h5>
            @else
            <h5 class="modal-title" id="licModalLabel">Editar Profesor: {{$prof->nombre}} {{$prof->apellido}}</h5> 
            @endif
            <button id="btnCloseCreate" type="button" class="close" data-bs-dismiss="modal"
                aria-label="Close" onClick="closeProfModal()">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
        <div class="modal-body">
            <div class="container">
                <div class="alert alert-danger" style="display:none"></div>
                <form action="{{ route('profesors.licCreate') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputNombre">Nombre</label>
                            <input type="text" name='nombreFrm' id="nombreFrm" class="form-control"
                                id="inputNombre" placeholder="Nombre" @if($prof->id>0) value="{{$prof->nombre}}" @endif>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputApellido">Apellido</label>
                            <input type="text" name="apellidofrm" id="apellidofrm" class="form-control"
                                placeholder="Apellido" @if($prof->id>0) value="{{$prof->apellido}}" @endif/>
                        </div>
                        @if($prof->id < 1) 
                        <div class="form-group col-md-6">
                            <label for="inputLegajo">Legajo</label>
                            <input type="number" name="legajofrm" id="legajofrm" class="form-control"
                                placeholder="Legajo" />
                        </div>
                        @else
                        <div class="form-group col-md-6">
                        <label for="inputLegajo">Legajo</label>
                            <input type="input" name="legajofrm" id="legajofrm" class="form-control"
                                placeholder="Legajo" 
                                 value="{{$prof->legajo}}"/>
                        </div>
                        @endif
                        <div class="form-group col-lg-12 col-md-12">
                            <input type="checkbox" class="" id="idProfesorFrm" @if($prof->id>0 && $prof->es_profesor) checked @endif>
                            <label class="form-check-label" for="check1">Es profesor</label>
                        </div>
                    </div>
            </div>
            <br>
            </form>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="formSubmit"
                    onClick="saveProf({{$prof->id}})">Grabar</button>
            </div>
        </div>

    </div>
    <div class="modal-footer">
    </div>
</div>
</div>