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
<form method="POST">
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

@include('Admin.Footer')