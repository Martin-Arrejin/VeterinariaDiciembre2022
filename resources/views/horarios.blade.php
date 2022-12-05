@forelse($listadoHorario as $Item)
       <li>{{$Item->hora}}</li>
   
              
        @empty
            <li>no hay fecha ni horas</li>
        @endforelse 
