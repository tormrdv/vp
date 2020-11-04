<?php
    $database = "if20_torm_rdv_2";
    function signup($firstname, $lastname, $email, $gender, $birthdate, $password){
        $result = null;
        $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
        $stmt = $conn->prepare("INSERT INTO vpusers (firstname, lastname, birthdate, gender, email, password) VALUES(?,?,?,?,?,?)");
        echo $conn -> error;

        //krüpteerime parooli
        $options = ["cost" => 12, "salt" => substr(sha1(rand()), 0, 22)];
        $pwdhash = password_hash($password, PASSWORD_BCRYPT, $options);

        $stmt -> bind_param("sssiss",$firstname, $lastname, $birthdate, $gender, $email, $pwdhash);

        if($stmt -> execute()){
            $result = "ok";
        } else {
            $result = $stmt -> error;
        }
        $stmt -> close();
        $conn -> close();
        return $result;
    }//funktsioon signup lõppeb

    function signin($email, $password){
        $result = null;
        $conn = new mysqli($GLOBALS["serverhost"], $GLOBALS["serverusername"], $GLOBALS["serverpassword"], $GLOBALS["database"]);
        $stmt = $conn->prepare("SELECT password FROM vpusers WHERE email = ?");
        echo $conn -> error;
        $stmt -> bind_param("s", email);
        $stmt -> bind_result($passwordfromdb);
        if($stmt -> execute()){
            //kui 6nnestus
            if($stmt -> fetch()){
                //kui tuli vaste on kasutaj olemas
                if(password_verify($password, $passwordfromdb)){
                    //parool oige, sisselogimine
                    $stmt -> close();
                    $conn -> close();
                    header("Location: home.php");
                    exit();

                }else {
                    $result = "Vale parool";
                }
            } else {
                $result = "kasutajat (" .$email .")pole olemas!";
            }
        } else {
            $result = $stmt -> error;

        }

        $stmt -> close();
        $conn -> close();
        return $result;
    }