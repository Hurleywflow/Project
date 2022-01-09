<?php
class BreedsDB {
    var $pdo;
    // constructor function
    public function __construct() {
        //local database
        $this->pdo = new PDO("mysql:host=localhost;dbname=epetsdb;", "root", "");
        //virtual database
        // $this->pdo = new PDO("mysql:host=localhost;dbname=epetsdb;", "root", "Redhat1@");
    }
    // add function
    function addBreed($values) {
        // add to database
        $sql = "INSERT INTO breeds (name, origin, type, coat_colour, temperament, common_traits, filename) VALUES (?,?,?,?,?,?,?)";
        $statement = $this->pdo->prepare($sql);
        return
            $statement->execute($values);
    }
    // retrieve all data form database
    function getBreeds() {
        $sql = "select * from breeds";
        $statement = $this->pdo->query($sql);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        return
            $statement->fetchAll();
    }
    // searching data from database
    function searchBreeds($keyword) {
        $sql = "select * from breeds where
        name like '%$keyword%' or
        origin like '%$keyword%' or
        type like '%$keyword%' or
        coat_colour like '%$keyword%' or
        temperament like '%$keyword%' or
        common_traits like '%$keyword%' or
        filename like '%$keyword%'";
        $statement = $this->pdo->query($sql);
        $statement->setFetchMode(PDO::FETCH_ASSOC);
        return
            $statement->fetchAll();
    }
}// end class
