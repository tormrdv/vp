<?php
//var_dump($_POST);
require("../../../config.php");
$database = "if20_torm_rdv_2";

//loen andmebaasist mõtted
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
$username = "Torm Erik Raudvee";
require("header.php");
?>

<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
<h1><?php echo $username; ?></h1>
<p>See veebileht on loodud õppetöö käigus ning ei sisalda VEEL mingit tõsiseltvõetavat sisu!</p>
<p>Leht on loodud veebiprogrammeerimise kursuse raames <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</p>
<p><a href="home.php">Avalehele</a></p>
<?php echo $ideahtml; ?>
</body>
</html>