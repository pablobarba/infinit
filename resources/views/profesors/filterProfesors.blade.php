<table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col"></th>
        <th scope="col">Nombre</th>
        <th scope="col">Apellido</th>
        <th scope="col">Legajo</th>
        <th scope="col">Es Profesor</th>
        <th scope="col">Ausentes</th>
        <th scope="col">Roles</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
        @foreach ($profesores as $profesor)
            <tr>
                <th class="fa fa-user"></th>
                <td>{{$profesor->nombre}}</td>
                <td>{{$profesor->apellido}}</td>
                <td>{{$profesor->legajo}}</td>
                <td>
                  <div class="custom-control custom-switch">
                  <input type="checkbox" class="custom-control-input" disabled id="customSwitch2" @if ($profesor->es_profesor) checked @endif>
                  <label class="custom-control-label" for="customSwitch2"></label>
                  </div>
                </td>
                <td><a class="fa fa-calendar-times" href="{{route('profesors.absents',['id_profesor' => $profesor->id])}}"></a></td>
                <td><a class="fa fa-graduation-cap" href="{{route('profesors.roles',['id_profesor' => $profesor->id])}}"></a></td>
                <td onclick="deleteProf({{$profesor->id}})"><a class="fa fa-times-circle" style="color:red"></a></td>
              </tr>
        @endforeach
    </tbody>
  </table>
  <div class="d-flex justify-content-center">
    {{ $profesores->links() }}