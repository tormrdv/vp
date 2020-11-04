<?php
   require ("../../../config.php");
    //var_dump($_POST);
    $username = "Torm Erik Raudvee";
    require("header.php");
    $firstname = "";
    $lastname ="";
    $gender = "";
    $email ="";
    $password ="";

    $firstnameerror = "";
    $lastnameerror = "";
    $emailerror = "";
    $passworderror
?>
<h1>Registreerimine</h1>
<form method="POST">
        <label>Registreeri kasutaja!</label>
            <input type ="text" name="firstnameinput" placeholder="Eesnimi" >
            <span></span>
            <input type ="text" name="lastnameinput" placeholder="Perekonnanimi">
            <span></span>
            <input type="radio" name="genderinput" id="gendermale" value="1"> <label for="gendermale">Mees</label>
            <span></span>
            <input type="radio" name="genderinput" id="genderfemale" value="2"> <label for="genderfemale">Naine</label>
            <span></span>
            <input type ="text" name="emailinput" placeholder="Email" >
            <span></span>
            <input type ="password" name="passwordinput" placeholder="Salasõna" >
            <span></span>
            <input type ="password" name="passwordsecondaryinput" placeholder="Salasõna uuesti" >


            <input type="submit" name="usersubmit" value ="Registreeri kasutaja">
</form>
