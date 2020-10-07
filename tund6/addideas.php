<?php
require("usesession.php");
    require("../../../config.php");
    $database = "if20_torm_rdv_2";
    if(isset($_POST["ideasubmit"]) and !empty($POST["ideainput"])){
        //andmebaasiga uhendus
        $conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
        //sql käsk andmete kirjutamiseks
        $stmt = $conn -> prepare("INSERT INTO myideas (idea) VALUES(?)");
        echo $conn -> error;
        $stmt -> bind_param("s", $_POST["ideainput"]);
        $stmt -> execute();
        $stmt -> close();
    }
    
    $username = "Torm Erik Raudvee";
    require("header.php")
    ?>

    <img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
    <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?> </h1>
    <p>See veebileht on loodud õppetöö käigus ning ei sisalda VEEL mingit tõsiseltvõetavat sisu!</p>
    <P>leht on loodud veebiprogrammeerimise kursuse käigus <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</P>
    <p><a href="home.php">Avalehele</a></p>
    <form method="POST">
        <label>Kirjutage oma esimene pähe tulev mõte!</label>
            <input type ="text" name="ideainput" placeholder="mõttekoht" >
            <input type="submit" name="ideasubmit" value ="Saada mõte teele">
</form>
<hr>

</body>
</html>