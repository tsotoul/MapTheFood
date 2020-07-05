<?php 

class FoodHygieneEdinburgh extends Controller {
    public function __construct() {
        
    }

    public function index() {
        $data = [
            'title' => ''
            ];

        $this->view('foodhygieneedinburgh/index', $data);
    }
}