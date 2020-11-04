<?php
    class Generic{
        //muutujad, klassis nimetataks neid omadusteks (properties)
        private $mysecret;
        public $yoursecret;

        function __construct($secretlimit){
            $this -> mysecret = mt_rand(0, $secretlimit);
            $this -> yoursecret = mt_rand(0, 100);
            echo "loositud arvude korrutis on: " .$this ->mysecret * $this -> yoursecret;
            $this -> tellSecret();
        }//construct loppeb
        function __destruct(){
            echo "Ongi selleks korraks kõik.";
        }


        private function tellSecret(){
            echo "Näidisklass on mõtetu!";
        }

        public function showValue(){
            echo "Väga salajane arv on: " .$this -> mysecret;
        }

        //funktsioonid, klassis meetodid (methods)
    } //Class loppeb