<?php 

class FoodHygieneEdinburgh extends Controller {
    public function __construct() {
        $this->ratingsModel = $this->model('FoodHE');
    }

    public function index() {
        $ratings = $this->ratingsModel->getRatings();


        $data = [
            'ratings' => $ratings
            ];

        $this->view('foodhygieneedinburgh/index', $data);
    }
}