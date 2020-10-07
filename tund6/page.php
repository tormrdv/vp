<?php
//var_dump($_POST);
session_start();
require("../../../config.php");
require("fnc_user.php");
require("fnc_common.php");
//require("addnewuser.php");
$database = "if20_torm_rdv_2";

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
$email = "";
$emailerror = "";
$passworderror = "";
$notice = "";
if(isset($_POST["submituserdata"])){
    if (!empty($_POST["emailinput"])){
        //$email = test_input($_POST["emailinput"]);
        $email = filter_var($_POST["emailinput"], FILTER_SANITIZE_EMAIL);
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $email = filter_var($email, FILTER_VALIDATE_EMAIL);
        } else {
            $emailerror = "Palun sisesta õige kujuga e-postiaadress!";
            echo"email";
        }
    } else {
        $emailerror = "Palun sisesta e-postiaadress!";
    }

    if (empty($_POST["passwordinput"])){
        $passworderror = "Palun sisesta salasõna!";
    } else {
        if(strlen($_POST["passwordinput"]) < 8){
            $passworderror = "Liiga lühike salasõna (sisestasite ainult " .strlen($_POST["passwordinput"]) ." märki).";
            echo "pw";
        }
    }

    if(empty($emailerror) and empty($passworderror)){
        echo"juhhei";
        echo "Juhhei!" .$email .$_POST["passwordinput"];
        $notice = signin($email, $_POST["passwordinput"]);
    }
}


//$username = "";
require("header.php");
?>

<img src="../img/vp_banner.png" alt="Veebiprogrammeerimise kursuse logo">
<h1>IFIFB</h1>
<p>See veebileht on loodud õppetöö käigus ning ei sisalda VEEL mingit tõsiseltvõetavat sisu!</p>
<P>leht on loodud veebiprogrammeerimise kursuse käigus <a href="http://www.tlu.ee">Tallinna Ülikooli</a> Digitehnoloogiate instituudis.</P>
<p>Lehe avamise hetk: <?php echo $weekdaynameset [$weekdaynow - 1] .", ".$fulltimenow; ?>. </p>
<p> <?php echo "Parajasti on ".$partofday .".";?></p>
<p><?php echo "Semestris on " .$semesterdurationdays . " päeva.";?></p>
<p><?php echo "Semester on kestnud " .$fromsemesterstartdays . " päeva.";?></p>
<p><?php echo "Semestrist on läbitud " .$semesterpercent . "%";?></p>
<hr>
<h2>Sisselogimine</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <label for="emailinput">E-mail (kasutajatunnus):</label><br>
    <input type="email" name="emailinput" id="emailinput" value="<?php echo $email; ?>"><span><?php echo $emailerror; ?></span>
    <br>
    <label for="passwordinput">Salasõna:</label>
    <br>
    <input name="passwordinput" id="passwordinput" type="password"><span><?php echo $passworderror; ?></span>
    <br>
    <br>
    <input name="submituserdata" type="submit" value="Logi sisse"><span><?php echo "&nbsp; &nbsp; &nbsp;" .$notice; ?></span>
</form>

<hr>
<h2>Hiljem näeb</h2>
<hr>
<p>Registreeri kasutaja :</p>
<ul>
    <li><a href="addnewuser.php">Kasutaja tegemine</a> </li>
</ul>
<hr>
<?php echo $imghtml;?>
<hr>

</body>
</html>
