<h1>Login Form</h1>

<form action="users" method="POST">
    @csrf

    <label for="email">Email : </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="email" name="email" id="email"><br>
    <span style="color:red;">{{$errors->first('email')}}</span><br>
    <label for="password">Password :</label>
    <input type="password" name="password" id="password"><br>
    <span style="color:red;">{{$errors->first('password')}}</span><br>

    <button type="submit">Login</button>
</form>