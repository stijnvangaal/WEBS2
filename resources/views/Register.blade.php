@include('Header')
<div id="BreadCrumb">
    <?php $crumbs = explode("/",$_SERVER["REQUEST_URI"]);
    foreach($crumbs as $crumb){
        echo ucfirst(str_replace(array(".php","_"),array(""," "),$crumb) . '>');
    }?>
</div>
<form method="POST" action="{{action('UserController@DoRegister')}}"  >
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
    <p>
        <label>Herhaal Wachtwoord</label>
        <input type="password" name="TestPassword">
    </p>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <p><input type="submit" value="inloggen"></p>
</form>

@include('Footer')