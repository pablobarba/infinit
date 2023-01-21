
 <div id="rolFrmlInner">                   
    <label for="inputRol">Rol</label>
    <select class="form-select"  name="rolfrm" id="rolfrm">
        
        <option value="">--Por favor seleccionar una opcion--</option>
        @foreach($rxps as $rxp)
            <option value="{{ $rxp->id }}">
                {{ $rxp->nombre_rol }} - {{$rxp->sit_revista}}
            </option>
    
        @endforeach
    
    </select>
     </div>
    <script>
    
      document.getElementById('rolfrm').addEventListener('change', function() {
        //console.log('rolfrm');
        getViewLicence();
      });
    
    
      </script>