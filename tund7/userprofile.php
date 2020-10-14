<?php
    //require("usesession.php");
    require("../../../config.php");
    $database = "if20_torm_rdv_2";
    require("fnc_common.php");

    $notice = "";
    $userdescription =""; //edaspidi loeb andmebaasisit
    
    if(isset($_POST["profilesubmit"])){
        $description = test_input($_POST["descriptioninput"]);
        $notice = storeuserprofile($description, $_POST["bgcolorinput"], $_POST[
            "txtcolorimnput"]);
        //Ok
        if($result == "ok") {
            $notice = "kasutajaprofiil on salvestatud";
            $_SESSION["userbgcolor"] = $_POST["bgcolorinput"];
            $_SESSION["usertxtcolor"] = $_POST["txtcolorinput"];
        }else{
            $notice = "Profiili salvestamine ebaõnnestus.";
        }
        
    }
    require("header.php")
?>
<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?> </h1>
<p>See veebileht on loodud õppetöö käigus ning ei sisalda VEEL mingit tõsiseltvõetavat sisu!</p>
<P>leht on loodud veebiprogrammeerimise kursuse käigus <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</P>
<p><a href="home.php">Avalehele</a></p>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for ="descriptioninput">Minu lühitutvustus</label>
           <br>
    <textarea name="descriptioninput" id="descriptioninput" rows="10" cols="80"
              placeholder="Minu tutvustus"></textarea>
    <br>
    <label for ="bgcolorinput">Minu valitud taustavärv</label>
    <input type="color" name="bgcolorinput" id="bgcolorinput value="<?php echo
     $_SESSION["userbgcolor"];?>">
    <br>
    <label for ="txtcolorinput">Minu valitud tekstivärv</label>
    <input type="color" name="txtcolorinput" id="txtcolorinput value="<?php echo
    $_SESSION["usertxtcolor"];?>">
    <br>
    <input type="submit" name="profilesubmit" name="Salvesta profiil">
    <span><?php echo $notice; ?></span>
    
</form>