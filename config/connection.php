<?php

try {
    class connection{

        static public function conectar(){
            $database = new PDO('mysql:host=localhost;dbname=proyecto', 'root', '');
            return $database;
        }
    }
} catch (\Throwable $th) {
    print "¡Error!: " . $e->getMessage() . "<br/>";
    die();
}

?>