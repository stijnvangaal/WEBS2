@include('Header')
<div id="BreadCrumb">
    <?php $crumbs = explode("/",$_SERVER["REQUEST_URI"]);
    foreach($crumbs as $crumb){
        echo ucfirst(str_replace(array(".php","_"),array(""," "),$crumb) . '>');
    }?>
</div>
<a href="{{$Prev}}">terug</a>
<img src="/Laravel/public/Images/{{$Image}}" class="BigPicture">

@include('Footer')