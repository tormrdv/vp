<?php
$database = "if20_inga_filmibaas_E";

function readmovietoselect($selected){
    $notice = "<p>Kahjuks filme ei leitud!</p> \n";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT movie_id, title FROM movie");
    echo $conn-> error;
    $stmt -> bind_result($idfromdb, $titlefromdb);
    $stmt -> execute();
    $films = "";
    while($stmt -> fetch()){
        $films .= '<option value="' .$idfromdb .'"';
        if(intval($idfromdb) == $selected){
            $films .=" selected";
        }
        $films .= ">" .$titlefromdb ."</option> \n";
    }
    if(!empty($films)){
        $notice = '<select name="filminput" id="filminput">' ."\n";
        $notice .= '<option value="" selected disabled>Vali film</option>' ."\n";
        $notice .= $films;
        $notice .= "</select> \n";
    }
    $stmt->close();
    $conn->close();
    return $notice;
}

function readgenretoselect($selected){
    $notice = "<p>Kahjuks žanre ei leitud!</p> \n";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT genre_id, genre_name FROM genre");
    echo $conn->error;
    $stmt->bind_result($idfromdb, $genrefromdb);
    $stmt->execute();
    $genres = "";
    while($stmt->fetch()){
        $genres .= '<option value="' .$idfromdb .'"';
        if(intval($idfromdb) == $selected){
            $genres .=" selected";
        }
        $genres .= ">" .$genrefromdb ."</option> \n";
    }
    if(!empty($genres)){
        $notice = '<select name="filmgenreinput" id="filmgenreinput">' ."\n";
        $notice .= '<option value="" selected disabled>Vali žanr</option>' ."\n";
        $notice .= $genres;
        $notice .= "</select> \n";
    }
    $stmt->close();
    $conn->close();
    return $notice;
}

function readstudiotoselect($selectedstudio){
    $notice = "Stuudioid ei leitud!";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt -> $conn -> prepare("SELECT production_company_id, company_name FROM production_company");
    echo $conn -> error;
    $stmt -> bind_result($idformdb,$companyfromdb);
    $stmt -> execute();
    $studios ="";
    while($stmt -> fetch()){

        $studios .'option value"' .$idformdb .'"';
        if($idfromdb == $selectedstudio){
            $studios .= " selected";
        }
        $studios .= ">" .$companyfromdb ."</option> \n";
    }
    if(!empty($studios)){
        $notice = '<select name ="filmstudioinput">' ."\n";
        $notice .= '<option value = ""selectec disabled> Vali stuudio</option>' "\n";
        $notice .= $studios;
        $notice .= </selected>
    }

    $stmt->close();
    $conn->close();
    return $notice;
}

function storenewgenrerelation($selectedfilm, $selectedgenre){
    $notice = "";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT movie_genre_id FROM movie_genre WHERE movie_id = ? AND genre_id = ?");
    echo $conn->error;
    $stmt->bind_param("ii", $selectedfilm, $selectedgenre);
    $stmt->bind_result($idfromdb);
    $stmt->execute();
    if($stmt->fetch()){
        $notice = "Selline seos on juba olemas!";
    } else {
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO movie_genre (movie_id, genre_id) VALUES(?,?)");
        echo $conn->error;
        $stmt->bind_param("ii", $selectedfilm, $selectedgenre);
        if($stmt->execute()){
            $notice = "Uus seos edukalt salvestatud!";
        } else {
            $notice = "Seose salvestamisel tekkis tehniline tõrge: " .$stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
    return $notice;
}

function storenewstudiorelation($selectedfilm, $selectedstudio){
    $notice = "";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
    $stmt = $conn->prepare("SELECT movie_by_production_company_id FROM movie_by_production_company WHERE movie_movie_id = ? AND production_company_id = ?");
    echo $conn->error;
    $stmt->bind_param("ii", $selectedfilm, $selectedstudio);
    $stmt->bind_result($idfromdb);
    $stmt->execute();
    if($stmt->fetch()){
        $notice = "Selline seos on juba olemas!";
    } else {
        $stmt->close();
        $stmt = $conn->prepare("INSERT INTO movie_by_production_company (movie_id, production_company_id) VALUES(?,?)");
        echo $conn->error;
        $stmt->bind_param("ii", $selectedfilm, $selectedstudio);
        if($stmt->execute()){
            $notice = "Uus seos edukalt salvestatud!";
        } else {
            $notice = "Seose salvestamisel tekkis tehniline tõrge: " .$stmt->error;
        }
    }

    $stmt->close();
    $conn->close();
    return $notice;
}

function readpersoninmovie($sortby, $sortorder){
    $notice = "<p>Kahjuks ei leidnud filmi tegelasi</p>";
    $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);

    $sqlphrase = "SELECT first_name, last_name, role, title FROM person JOIN person_in_movie ON person.person_id = person_in_movie.person_id JOIN movie ON movie.movie_id = person_in_movie.movie_id";

    if($sortby == 0){
        $stmt = $conn -> prepare($sqlphrase);

    }
    if($sortby == 4){
        if($sortorder == 1){
            $stmt = $conn -> prepare($sqlphrase . " ORDER BY title DESC");
        } else {
            $stmt = $conn -> prepare($sqlphrase . " ORDER BY title");
        }

    }

    $stmt = $conn -> prepare("SELECT first_name, last_name, role, title FROM person JOIN person_in_movie ON person.person_id = person_in_movie.person_id JOIN movie ON movie.movie_id = person_in_movie.movie_id");
    echo $conn -> error;
    $stmt -> bind_result($firstnamefromdb, $lastnamefromdb, $rolefromdb, $titlefromdb);
    $stmt -> execute();
    $lines = "";

    while($stmt -> fetch()){
        $lines .= "\t <tr> \n";
        $lines .= "\t\t <td>" .$firstnamefromdb ." " .$lastnamefromdb "</td>";
        $lines .= "<td>" .$rolefromdb "</td>";
        $lines .= "<td>" .$titlefromdb "</td> \n";
        $lines .= "\t </tr> \n";
        }
        if(!empty($lines)) {
            $notice = "<table> \n";
            $notice .= "\t <tr> \n \t \t <th>Isik</th> \n \t \t <th>Roll</th> \n";
            $notice .= "\t \t" .'<th>Film <a href="?sortby=4&sortorder=1">&uarr;</a>&nbsp;<a href="?sortby=4&sortorder=2">&darr;</a></th>' ."\n \t </tr> \n";
            $notice .= $lines;
            $notice .="</table> \n";

        }

        $stmt -> close();
        $conn -> close();
        return result;
    }

}