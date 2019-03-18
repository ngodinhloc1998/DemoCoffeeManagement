<?php
    class Tracking extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('users_model');
            $this->load->model('invoice_model');
        }

        function show_all_invoices(){
            try{
                $this->users_model->checkLogin();
                $data = array(
                    'invoices' => $this->invoice_model->tracking_invoice()
                );
                $this->load->view('templates/header');
                $this->load->view('templates/tracking_invoice',$data);
                $this->load->view('templates/footer');
            }catch(Exception $e){   
                echo "Cause error ".$e->getMessege().'<br>';
            }
        }

        function show_all_detail_invoices($id){
            try{
                $this->users_model->checkLogin();
                $data = array(
                    'detail_invoices' => $this->invoice_model->tracking_detail_invoice($id)
                );
                $this->load->view('templates/header');
                $this->load->view('templates/detail_invoice',$data);
                $this->load->view('templates/footer');
            }catch(Exception $e){
                echo "Cause error ".$e->getMessege()."<br>";
            }
        }
    }
?>