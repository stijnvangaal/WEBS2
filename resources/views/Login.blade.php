@include("Header")

<form method="POST" action="{{action('UserController@DoLogin')}}"  >
    <h1>Login</h1>

    <p style="color:red;">

        @if($errors->any())
            {{$errors->first()}}
        @endif


    </p>
    <p>
       <label>Gebruikers naam</label>
        <input type="text" name="UserName">
    </p>

    <p>
        <label>Wachtwoord</label>
        <input type="password" name="Password">
    </p>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <p><input type="submit" value="inloggen"></p>
</form>
@include("Footer")