<table class="table table-dark">
  <thead>
    <tr>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
     <tr>
      <th colspan="15"><span style="font-weight: bold">SECRETARIA: SECRETARÍA DE EDUCACIÓN, CULTURA Y DEPORTE</th>
      </tr>
      <tr>
        <th colspan="15">DIRECCIÓN:	DE EDUCACION</th>
        </tr>
        <tr>
          <th colspan="15">DEPARTAMENTO: ESCUELA MUNICIPAL DE DANZAS JOSE NEGLIA</th>
          </tr>
          <tr>
            <th colspan="15">SEMANA: {{$dayReport}}</th>
            </tr>
           
  </tbody>
</table>
@if($isprof == 1) 
<h5>ASUNTOS DOCENTES:   <h5>
@else
<h5>AUXILIARES:   <h5>
@endif
  <table class="table">
    <thead>
      <tr>
        <th scope="col">LEGAJO</th>
        <th scope="col">APELLIDO</th>
        <th scope="col">NOMBRE</th>
        <th scope="col">PUESTO</th>
        <th scope="col">SIT Revista</th>

        <th colspan="2">LUNES </th>
        <th colspan="2">MARTES</th>
        <th colspan="2">MIERCOLES</th>
        <th colspan="2">JUEVES</th>
        <th colspan="2">VIERNES</th>
        <th colspan="2">SABADO</th>
        <th colspan="2">observaciones</th>
      </tr>
      <tr>
        <th></th>
        <th></th>
        <th></th>
          <th></th>
        <th></th>
       <th>Articulo</th> <th>M.T</th> 
       <th>Articulo</th> <th>M.T</th> 
       <th>Articulo</th> <th>M.T</th> 
       <th>Articulo</th> <th>M.T</th> 
       <th>Articulo</th> <th>M.T</th> 
       <th>Articulo</th> <th>M.T</th> 
       <th>Articulo</th> <th>M.T</th> 
      </tr>

    </thead>
    <tbody>
      @foreach ($collection as $c)
      <tr>
        <td>{{$c->legajo}}</td>
          <td>{{$c->apellido}}</td>
          <td>{{$c->nombre}}</td>
          <td>{{$c->puesto}}</td>
          <td>{{$c->sit_revista}}</td>

          <td>{{$c->lunes}}</td>
          <td></td>

          <td>{{$c->martes}}</td>
          <td></td>

          <td>{{$c->miercoles}}</td>
          <td></td>
          <td>{{$c->jueves}}</td>
          <td></td>
          <td>{{$c->viernes}}</td>
          <td></td>
          <td>{{$c->sabado}}</td>
          <td></td>
          <td>{{$c->observaciones}}</td>
          <td></td>
          </tr>
  @endforeach
    </tbody>
  </table>


  {{--
      <table class="table" id="customers" style="border: 1px solid">
    <thead>
      <tr>
        <th scope="col">LEGAJO</th>
        <th scope="col">APELLIDO</th>
        <th scope="col">NOMBRE</th>
        <th scope="col">PUESTO</th>
        <th scope="col">SIT Revista</th>
        <th scope="col">LUNES

        </th>
        <th scope="col">MARTES</th>
        <th scope="col">MIERCOLES</th>
        <th scope="col">JUEVES</th>
        <th scope="col">VIERNES</th>
        <th scope="col">SABADO</th>
        <th scope="col">observaciones</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($collection as $c)
            <tr>
              <td>{{$c->legajo}}</td>
                <td>{{$c->apellido}}</td>
                <td>{{$c->nombre}}</td>
                <td>{{$c->puesto}}</td>
                <td>{{$c->sit_revista}}</td>
                <td>{{$c->lunes}}</td>
                <td>{{$c->martes}}</td>
                <td>{{$c->miercoles}}</td>
                <td>{{$c->jueves}}</td>
                <td>{{$c->viernes}}</td>
                <td>{{$c->sabado}}</td>
                <td>{{$c->observaciones}}</td>
                </tr>
        @endforeach
    </tbody>
  </table>
    --}}