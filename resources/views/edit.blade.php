<h1>Update students</h1>
<form action="/edit" method="post">
    @csrf

    <input type="hidden" name="id" value='{{$data['id']}}'>

    <label for="name">First Name : </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text" name="firstname" value='{{$data['fname']}}' id=""><br>

    <label for="name">Last Name : </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text" name="lastname"  value='{{$data['lname']}}' id=""><br>
    <button type="submit">Update</button>
</form>