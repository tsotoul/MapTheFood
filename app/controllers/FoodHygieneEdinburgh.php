<?php 

class Foodhygieneedinburgh extends Controller {
    public function __construct() {
        $this->ratingsModel = $this->model('FoodHE');
    }

    public function cron() {
        $this->ratingsModel->clearDb();

        $this->ratingsModel->loadData();    
         
        $this->ratingsModel->clearData();
        
        $ratings = $this->ratingsModel->getAllRatings();
        
        $data = [
            'ratings' => $ratings
            ]; 
        
        $this->view('foodhygieneedinburgh/cron', $data);
    }

    public function index() {
        //$this->ratingsModel->clearDb();

        //$this->ratingsModel->loadData();

        $this->ratingsModel->clearData();
        
        $ratings = $this->ratingsModel->getAllRatings();
        
        $data = [
            'ratings' => $ratings
            ];

        $this->view('foodhygieneedinburgh/index', $data);
    }
}