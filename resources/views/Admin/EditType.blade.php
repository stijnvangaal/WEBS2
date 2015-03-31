@include('Admin.Header')
<div id="BreadCrumb">
    <?php $crumbs = explode("/",$_SERVER["REQUEST_URI"]);
    foreach($crumbs as $crumb){
        echo ucfirst(str_replace(array(".php","_"),array(""," "),$crumb) . '>');
    }?>
</div>

<p style="color:red;">
    @if($errors->any())
        {{$errors->first()}}
    @endif
</p>

<form method="POST" id="AdminTypeForm">
    <div id='AdminTypeTree'>
        <ul><li><input type="radio" name="SelectedType" value="!!!" checked="checked">Null</li></ul>
        {{--echo the full type tree--}}
        <?php echo $Types ?>
    </div>

    <input type="text" name="NewType">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" value="Toevoegen aan" onclick="this.form.action='{{action('AdminTypeController@AddType')}}'">
    <input type="submit" value="Verwijderen" onclick="this.form.action='{{action('AdminTypeController@DeleteType')}}'">

</form>

<div id="AdminTypeRules">
    <h2>Regels</h2>
    <ul>
        <li>Wanneer 'Null' geselecteerd is wordt een nieuw type onderaan de lijst toegevoegd.</li>
        <li>'Null' kan niet worden verwijderd</li>
        <li>Door een type te verwijderen worden zijn onderstaande types doorgegeven naar zijn bovenstaand</li>
        <li>Door een type te verwijderen krijgen de auto's die dit type hadden het bovenstaande type doorverwezen</li>
    </ul>
</div>

@include('Admin.Footer')