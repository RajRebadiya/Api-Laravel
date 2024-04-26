<h1>Add new students</h1>
<form action="" method="post">
    @csrf

    <label for="name">First Name : </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text" name="firstname" id=""><br>

    <label for="name">Last Name : </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text" name="lastname" id=""><br>
    <button type="submit">Add</button>
</form>