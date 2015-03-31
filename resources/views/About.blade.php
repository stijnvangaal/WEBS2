@include('Header')
<div id="BreadCrumb">
    <?php $crumbs = explode("/",$_SERVER["REQUEST_URI"]);
    foreach($crumbs as $crumb){
        echo ucfirst(str_replace(array(".php","_"),array(""," "),$crumb) . '>');
    }?>
</div>

<div id="ContentContainer">
    <p style="text-align: justify">{{ $Tekst or "About nog niet gedifinieerd"}}</p>
</div>

@include('Footer')