
 <div id="getLicenceFrmlInner">                   
    <label for="inputRol">Licencia</label>
    <select class="form-select"  name="getLicencefrm" id="getLicencefrm">
        
        <option value="">--Por favor seleccionar una opcion--</option>
        @foreach($lic as $l)
            <option value="{{ $l->id }}">
                {{ $l->nombre }}
            </option>
    
        @endforeach
    
    </select>
     </div>