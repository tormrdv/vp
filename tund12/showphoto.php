<?php
require("usesession.php");
require("../../../config.php")

header("Content-type: image/jpeg");
readfile("../photoupload_normal/" .$_REQUEST["photo"]);