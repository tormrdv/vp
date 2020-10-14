<?php
  var_dump($_SESSION);
  require("usesession.php");
  require("../../../config.php");
  $database = "if20_torm_rdv_2";
  if(isset($_POST["ideasubmit"]) and !empty($_POST["ideainput"])){
	  //loome andmebaasiga uhenduse
	  $conn = new mysqli ($serverhost, $serverusername, $serverpassword, $database);
	  //valmistan ette sql kasu andmete kirjutamiseks
	  $stmt = $conn -> prepare("INSERT INTO myideas (idea) VALUES(?)");
	  echo $conn -> error;
	  //i - integer, d - decimal, s - string
	  $stmt -> bind_param("s", $_POST["ideainput"]);
	  $stmt->execute();
	  $stmt->close();
	  $conn->close();
  }
  
  //loen andmebaasist sellised mõtted
  $ideahtml = "";
  $conn = new mysqli ($serverhost, $serverusername, $serverpassword, $database);
  $stmt = $conn -> prepare("SELECT idea FROM myideas");
  //seon tulemuse muutujaga 
  $stmt -> bind_result($ideafromdb);
  $stmt -> execute();
  while ($stmt -> fetch()){
	  $ideahtml .= "<p>" .$ideafromdb ."</p>";

  }
 $stmt->close();
 $conn->close();
	  
 $username = "Torm Erik Raudvee";
 $fulltimenow = date("d.m.Y H:i:s");
 $hournow = date("H");
 $partofday = "Lihtsalt aeg";
 
 $weekdaynameset = ["esmaspäev", "teisipäev", "kolmapäev", "neljapäev", "reede", "laupäev", "pühapäev"];
  $monthnameset = ["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
  //echo $weekdaynameset[1];
  $weekdaynow = date("N");
 if($hournow < 7){
	 $partofday = "uneaeg";
 }
 if($hournow >= 8 and $hournow <= 16){
	 $partofday = "reservaeg";
 }
if($hournow >= 20 and $hournow <=22){
	$partofday = "vaba aeg";
}
if($hournow >= 16 and $hournow <= 19){
	$partofday = "trenni aeg";
}
if($hournow >= 19 and $hournow <= 20){
	$partofday = "söögiaeg";
}

//vaatame semestri kulgemist 
 $semesterstart = new DateTime("2020-8-31");
 $semesterend = new DateTime("2020-12-13");
// selgitame välja nende vahe
 $semesterduration = $semesterstart -> diff($semesterend);
 //leiame selle paevade arvuna 
 $semesterdurationdays = $semesterduration -> format("%r%a");
 //kui palju semestrist on läbitud 
 $today = new Datetime("now");
 $semesterpassed = $semesterstart->diff($today)->format("%r%a");
$semesterpercent = $semesterpassed * 100 / $semesterdurationdays;
  //tänane paev
 $today = new DateTime("now");
 $fromsemesterstartdays = $semesterstart->diff($today)->format("%r%a");
 //if($fromsemesterstartdays < 0)(semesterpoleveelpealehakanud)
	
//loome kataloogist piltide nimekirja
$allfiles = scandir("../pics/");
//var_dump($allfiles);
$picfiles = array_slice($allfiles, 2);
$imghtml = "";
$piccount = count($picfiles);
//$i = $i + 1;
//$i ++;
//$i +=3
for($i = 0;$i < $piccount; $i ++){
	//<img src="../img/pildifail" alt="tekst"
	//$imghtml .='<img src="../pics/' .$picfiles[$i] .'"alt="Tallinna Ülikool">';
    $imghtml = '<img src="../pics/' .$picfiles[mt_rand(0,($piccount - 1))] .'" alt="Tallinna Ülikool">';
}
require("header.php");
?>

<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
  <h1><?php echo $_SESSION["userfirstname"] ." " .$_SESSION["userlastname"]; ?> </h1>
  <p>See veebileht on loodud õppetöö käigus ning ei sisalda VEEL mingit tõsiseltvõetavat sisu!</p>
  <P>leht on loodud veebiprogrammeerimise kursuse käigus <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</P>
  <p>Lehe avamise hetk: <?php echo $weekdaynameset [$weekdaynow - 1] .", ".$fulltimenow; ?>. </p>
  <p> <?php echo "Parajasti on ".$partofday .".";?></p>
  <p><?php echo "Semestris on " .$semesterdurationdays . " päeva.";?></p>
  <p><?php echo "Semester on kestnud " .$fromsemesterstartdays . " päeva.";?></p>
  <p><?php echo "Semestrist on läbitud " .$semesterpercent . "%";?></p>
  <h2>Hiljem näeb</h2>
  <p><a href = "?logout=1">Logi välja</a>!</p>
  <hr>
  <p>Teised huvitavad lehed :</p>
<ul>
    <li><a href="addideas.php">Pane kirja oma mõte</a></li>
    <li><a href="listideas.php">Mõtete vaatamine</a></li>
    <li><a href="listfilms.php">Filmide nimekirja vaatamine</a></li>
    <li><a href="addfilms.php">Filmiinfo lisamine</a></li>
    <li><a href="userprofile.php">Minu kasutajaprofiil</a> </li>
    <li><a href="listfilmpersons.php">Filmitegelaste loend</a> </li>
</ul>
  <hr>
  <?php echo $imghtml;?>
  <hr>

  </body>
</html>
