<?php

require_once 'database.class.php';

class CategoryDatabase{

    private $conn;

    public function __construct(){
        $database = new Database();
        $this->conn = $database->getConnection();

    }


    public function catOpslaan($categorieNaam){


        $query = "INSERT INTO categorie (categorieName, categorieStatus) VALUES ('$categorieNaam', 'concept')";
        $stm = $this->conn->prepare($query);
        if ($stm->execute()){
            Header("Location: Qa.php");
        }

    }

    public function catAanpassen($categorieNaam, $categorieStatus, $customerID){
        $query = "UPDATE categorie SET categorieName = '$categorieNaam',
                                       categorieStatus= '$categorieStatus'
                                       WHERE categorieID = '$customerID'";
        $stm = $this->conn->prepare($query);
        if ($stm->execute()){

        }
    }

}
