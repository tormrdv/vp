<?php
 $username = "Torm Erik Raudvee";
 $fulltimenow = date("d.m.Y H:i:s");
 $hournow = date("H");
 $partofday = "Lihtsalt aeg";
 if($hournow < 7){
	 $partofday = "uneaeg";
 }
 if($hournow >= 8 and $hournow <= 18){
	 $partofday = "reservaeg";
 }
if($hournow >= 19 and $hournow <=22){
	$partofday = "vaba aeg";
}
?>
<!DOCTYPE html>
<html lang="et">
<head>
  <meta charset="utf-8">
  <title><?php echo $username; ?> IFIFB </title>

</head>
<body>
  <h1><?php echo $username; ?> IFIFB</h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda VEEL mingit tõsiseltvõetavat sisu!</p>
  <P>leht on loodud veebiprogrammeerimise kursuse käigus <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</P>
  <h2>Hiljem näeb</h2>
  <p>Lehe avamise hetk: <?php echo $fulltimenow; ?>. </p>
  <p> <?php echo "Parajasti on ".$partofday .".";?></p>

</body>
</html>
