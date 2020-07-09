<?php 

class Foodhygieneedinburgh extends Controller {
    public function __construct() {
        $this->ratingsModel = $this->model('FoodHE');
    }

    public function index() {
        $this->ratingsModel->clearDb();

        $this->ratingsModel->loadData();
        
        $ratings = $this->ratingsModel->getAllRatings();
        
        $data = [
            'ratings' => $ratings
            ];

        $this->view('foodhygieneedinburgh/index', $data);
    }
}