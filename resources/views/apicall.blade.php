<h1>User's List</h1>
<table border="1">
    <tr>
    <td>Id</td>
    <td>Name</td>
    <td>Email</td>
    <td>Profile Photo</td>
</tr>
@foreach ($data as $item)
    
<tr>
    <td>{{$item['id']}}</td>
    <td>{{$item['first_name']}}</td>
    <td>{{$item['email']}}</td>
    <td><img src="{{$item['avatar']}}" height="100" width="100"></td>
</tr>
@endforeach
</table>