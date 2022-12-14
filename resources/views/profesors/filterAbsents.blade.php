<table class="table" name="order_table" id="order_table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">Licencia</th>
        <th scope="col">Rol</th>
        <th scope="col">Sit Revista</th>
        <th scope="col">Fecha</th>
      <th scope="col"></th>
      </tr>
    </thead>
  <tbody>
@foreach ($lxps as $l)
<tr>
    <td>{{$l->nombre_licencia}}</td>
    <td>{{$l->nombre_rol}}</td>
    <td>{{$l->sit_revista}}</td>
    <td>{{$l->fecha}}</td>
    <td onclick="deleteLic({{$l->id}})"> <button type="button" name="deletelic" id="deletelic" class="btn btn-danger fa fa-trash"></button></td>
    
  </tr>
@endforeach
 
</tbody>
</table>
{!! $lxps->links() !!}