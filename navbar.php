<?php
function active($currect_page){
  $url_array =  explode('/', $_SERVER['REQUEST_URI']) ;
  $url = end($url_array);  
  if($currect_page == $url){
      echo 'is-active'; //class name in css 
  } 
}
?>
<nav>
    <div class="title-bar" data-responsive-toggle="example-menu" data-hide-for="medium">
        <button class="menu-icon" type="button" data-toggle="example-menu"></button>
        <div class="title-bar-title">Data Collector</div>
    </div>

    <div class="top-bar" id="example-menu">
        <div class="top-bar-left">
            <ul class="menu">
                <li class="menu-text">Data Collector</li>
                <li class="<?php active('index.php');?>"><a href="index.php">Home</a></li>
                <li class="<?php active('predicttime.php');?>"><a href="predicttime.php">Timepredicter</a></li>
                <li class="<?php active('afstelling.php');?>"><a href="afstelling.php">Afstellingpredicter</a></li>
            </ul>
        </div>
    </div>
</nav>