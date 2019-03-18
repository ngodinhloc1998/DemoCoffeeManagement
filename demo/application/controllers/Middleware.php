<?php
    class Middleware extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('users_model');
            $this->load->model('invoice_model');
            $this->load->model('products_model');
            $this->load->model('tables_model');
        }

        private function checkLogin(){
            if(isset($_SESSION['user']['username']) && !empty($_SESSION['user']['username'])){
                return true;
            }
            redirect("users/login");
            return false;
        }

        function redirect_new_order($id){
            if($this->checkLogin()){
                $_SESSION['id_table'] = $id;
                //var_dump($id);
                //var_dump($_SESSION['id_table']);
                redirect(base_url('business/create_invoice/'.$id));
            }
        }

        function redirect_order($id){
            if($this->checkLogin()){
                $_SESSION['id_table'] = $id;
                //var_dump($id);
                //var_dump($_SESSION['id_table']);
                redirect(base_url('manage_products/show_products'));
            }
        }

        function redirect_checkout($id=''){
            if($this->checkLogin()){
                if(empty($_SESSION['id_table'])){
                    $_SESSION['id_table'] = $id;
                }
                else{
                    $id = $_SESSION['id_table'];
                }
                $id_invoice = $this->invoice_model->get_id_invoice_processing($id);
                $id_products = $this->products_model->get_id_products_in_invoice($id_invoice);
                var_dump($id_products);
                    if(empty($id_products)){
                        $this->tables_model->updateTableIsAvailable($id);
                        $this->invoice_model->updateInvoiceStatusIsDone($id_invoice);
                        redirect(base_url('business/manage_table'));
                        return true;
                    }
                redirect(base_url('business/show_shopping_list'));
                return false;
            }
        }
    }
?>