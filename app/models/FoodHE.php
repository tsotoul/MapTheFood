<?php

class FoodHE {
    private $db;
    private $url;

    public function __construct() {
        $this->db = new Database;
    }

    public function clearDb() {
        $this->db->query('DELETE 
                            FROM food_ratings
                            ');
        $this->db->execute();
    }

    public function loadData() {
        $url = 'https://ratings.food.gov.uk/OpenDataFiles/FHRS773en-GB.xml';
        $xml = simplexml_load_file($url);

        foreach($xml->EstablishmentCollection->EstablishmentDetail as $row) {
            $name = $row->BusinessName;
            $businessType = $row->BusinessType;
            $address = $row->AddressLine1.', '.$row->AddressLine2.', '.$row->PostCode;
            $rating = $row->RatingValue;
            $rating_date = $row->RatingDate;
            $latitude = $row->Geocode->Latitude;
            $longitude = $row->Geocode->Longitude;
                
            $this->db->query('INSERT INTO food_ratings (name, business_type, address, rating, rating_date, latitude, longitude) 
                            VALUES (:name, :business_type, :address, :rating, :rating_date, :latitude, :longitude)');

            $this->db->bind(':name', $name);
            $this->db->bind(':business_type', $businessType);
            $this->db->bind(':address', $address);
            $this->db->bind(':rating', $rating);
            $this->db->bind(':rating_date', $rating_date);
            $this->db->bind(':latitude', $latitude);
            $this->db->bind(':longitude', $longitude);
            $this->db->execute();
        }
    }

    public function clearData() {
        $this->db->query('DELETE FROM food_ratings WHERE latitude = ""');
        $this->db->execute();
    }

    public function getAllRatings() {
        $this->db->query('SELECT * FROM food_ratings');

        $results = $this->db->resultSet();

        return $results;
    }

}