@include('Admin.Header')
<div id="BreadCrumb">
    <?php $crumbs = explode("/",$_SERVER["REQUEST_URI"]);
    foreach($crumbs as $crumb){
        echo ucfirst(str_replace(array(".php","_"),array(""," "),$crumb) . '>');
    }?>
</div>

<div id=AdminAboutTekst">
    <form  method="POST" action="{{action('HomeController@UpdateAbout')}}">
        <textarea name="About" cols="100" rows="5">{{$Tekst or ""}}</textarea><br>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="submit" value="verstuur">
    </form>
</div>
@include('Admin.Footer')