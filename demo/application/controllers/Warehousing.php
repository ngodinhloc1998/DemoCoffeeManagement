<?php
class Warehousing extends CI_Controller{
    function __construct(){
        parent::__construct();
    }
    
    function show_warehousing(){
        $this->load->view('templates/header');
        $this->load->view('templates/warehousing');
        $this->load->view('templates/footer');
    }
}
?>