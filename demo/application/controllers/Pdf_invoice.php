<?
    class Pdf_invoice extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->libraries('Pdf');
        }
        function create_invoice(){
            $this->load->view();
        }
    }