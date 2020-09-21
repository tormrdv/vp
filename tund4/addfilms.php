<?php
require("../../../config.php");
$database = "if20_torm_rdv_20";
require("fnc_film.php");

    $inputerror ="";
    $filmhtml = "";
    //kas vajutati nuppu
    if(isset($_POST["Filmsubmit"])){
        if(empty($_POST["titleinput"]) or empty ($_POST["genreinput"]) or empty ($_POST["studioinput"]) or empty ($_POST["directorinput"])) {
            $inputerror .="Osa infot on sisestamata!";
        }
        if($_POST["yearinput"] < 1895 or $_POST["yearinput"] > date("Y")){
    $inputerror .="Ebareaalne valmimisaasta.";
        }
        if(empty($inputerror)){
            $storeinfo = storefilminfo($_POST["titleinput"],$_POST["yearinput"], $_POST["durationinput"], $_POST["genreinput"], $_POST["studioinput"], $_POST["directorinput"]);
            if($storeinfo == 1){
                $filmhtml = readfilms(1);
            } else {
                $filmhtml = "<p> Kahjuks filmiinfo salvestamine seekord ebaõnnestus!</p>";
            }
            }

    }
    $username = "Torm Erik Raudvee";
  require("header.php");
?>

<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
<h1><?php echo $username; ?></h1>
<p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
<p>Leht on loodud veebiprogrammeerimise kursuse raames <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
<ul>
    <li><a href="home.php">Avalehele</a></li>
</ul>
<form method = "POST">
    <label for="titleinput">Filmi pealkiri</label>
    <input type="text" name="titleinput" id="titleinput" placeholder="Filmi pealkiri">
    <br>
    <label for="yearinput">Filmi valmimisaastaaasta</label>
    <input type="number" name="yearinput" id="yearinput" value="<?php echo date("Y"); ?>">
    <br>
    <label for="durationinput">Filmi kestus</label>
    <input type="number" name="durationinput" id="durationinput" value="90">
    <br>
    <label for="genreinput">Filmi zanr</label>
    <input type="text" name="genreinput" id="genreinput" placeholder="Filmi zanr">
    <br>
    <label for="studioinput">Filmi tootja</label>
    <input type="text" name="studioinput" id="studioinput" placeholder="Filmi tootja">
    <br>
    <label for="directorinput">Filmi lavastaja</label>
    <input type="text" name="directorinput" id="directorinput" placeholder="Filmi lavastaja">
    <br>
    <input type="submit" name"filmsubmit" value="Salvesta filmi info">
</form>
<p><?php echo $inputerror; ?></p>
<hr>
<?php echo $filmhtml;
?>
</body>
</html>t
