<?php
require("usesession.php");
require("../../../config.php");
require("fnc_photo.php");
require("fnc_common.php");
require("classes/Photoupload_class.php");


$notice = "";
$fileuploaddir_orig = "../photoupload_orig/";
$fileuploaddir_normal = "../photoupload_normal/";
$fileuploaddir_thumb = "../photoupload_thumb/";

//$publicphotothumbshtml = readAllPublicPhotoThumbs(2);
$gallerypagelimit = 3;
$page = 1;
//$photocount = countPublicPhotos(2);

if(isset($_GET["page"])){
    $page = $_GET["page"];
}
$publicphotothumbshtml = readAllPublicPhotoThumbs(2, $gallerypagelimit);


//kas vajutati salvestusnuppu

require("header.php");
?>
<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
<p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
<p>Leht on loodud veebiprogrammeerimise kursuse raames <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
<ul>
    <li><a href="home.php">Avalehele</a></li>
    <li><a href="?logout=1">Logi välja</a>!</li>
</ul>
<hr>
<p>
    <?php
    if($page > 1){
        
    }
    ?>
</p>
<h2>Fotogalerii</h2>
<?php
    echo $publicphotothumbshtml;
?>
<hr>

<hr>
</body>
</html>
