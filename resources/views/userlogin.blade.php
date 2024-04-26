<h1>login page</h1>
<form action="submit" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="email">Email : </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="email" name="email" id="email"><br>
    <label for="password">Password :</label>
    <input type="password" name="password" id="password"><br>
    <input type="file" name="file" id="">
    <button type="submit">Login</button>
</form>