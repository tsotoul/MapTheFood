<?php

class FoodHE {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function getRatings() {
        $this->db->query('SELECT *
                            FROM ratings
                            WHERE name = "Aldi"
                            ');

        $results = $this->db->resultSet();

        return $results;
    }

}