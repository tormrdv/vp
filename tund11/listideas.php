<?php
require("usesession.php");
//var_dump($_POST);
require("../../../config.php");
$database = "if20_torm_rdv_2";

//loen andmebaasist senised mõtted
$ideahtml = "";
$conn = new mysqli($serverhost, $serverusername, $serverpassword, $database);
$stmt = $conn->prepare("SELECT idea FROM myideas");
//seon tulemuse muutujaga
$stmt->bind_result($ideafromdb);
$stmt->execute();
while($stmt->fetch()){
    $ideahtml .= "<p>" .$ideafromdb ."</p>";
}
$stmt->close();
$conn->close();
//$username = "Andrus Rinde";
require("header.php");
?>

<h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?></h1>
<p>See veebileht on loodud õppetöö käigus ning ei sisalda mingit tõsiseltvõetavat sisu!</p>
<p>Leht on loodud veebiprogrammeerimise kursuse raames <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
<ul>
    <li><a href="home.php">Avalehele</a></li>
    <li><a href="?logout=1">Logi välja</a>!</li>
</ul>
<?php echo $ideahtml; ?>
</body>
</html>