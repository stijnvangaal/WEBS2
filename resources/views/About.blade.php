@include('Header')
<div id="BreadCrumb">
    <?php $crumbs = explode("/",$_SERVER["REQUEST_URI"]);
    foreach($crumbs as $crumb){
        echo ucfirst(str_replace(array(".php","_"),array(""," "),$crumb) . '>');
    }?>
</div>

<div id="ContentContainer">
    <p style="text-align: justify">Bacon ipsum dolor amet chuck doner cow, spare ribs venison bacon chicken landjaeger porchetta meatball tongue sausage strip steak leberkas. T-bone pancetta turkey porchetta beef meatball. Shankle cow bacon ham. Flank bacon corned beef porchetta pig bresaola doner sirloin. Tongue prosciutto shank landjaeger swine brisket. Shoulder ham spare ribs beef meatloaf salami t-bone landjaeger. Rump shoulder filet mignon venison ham hock swine capicola</p>
</div>

@include('Footer')