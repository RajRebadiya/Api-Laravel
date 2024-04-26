<h1>Hello User</h1>
<h2>{{$nnn}}</h2>
{{-- 
@if($name == 'Hitesh') --}}
@if ($nnn == 'Hiteh')
<h2>Hello , {{$nnn}}</h2>
    
@else
<h2>Hello , Unknown</h2>
    
@endif

@for ($i = 1; $i <= 10; $i++)
 <h2>{{$i}}</h2>   
@endfor     

@foreach ($name as $user)
    <h2>{{$user}}</h2>
@endforeach