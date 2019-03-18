<?php
    class Invoice_model extends CI_Model{
        
        function __construct(){
            parent::__construct();
            $this->load->database();
        }

        function create_invoice($data){
            $sql = "INSERT INTO invoice(id_table,id_customer,id_employee,status) VALUES (?,?,?,?);";
            $data = array(
                $data['id_table'],
                $data['id_customer'],
                $data['id_employee'],
                $data['status']
            );
            try{
                if($query = $this->db->query($sql,$data)){
                    //var_dump($query);
                    return true;
                }
                else{
                    echo "Sai roi";
                }
            }catch(Exception $e){
                echo "Caught exception ", $e->getMessege() ,"\n";
            }
            return false;
        }

        function create_detail_invoice($id_table,$id_product){
            $id_invoice = $this->get_id_invoice_processing($id_table);
            if($id_invoice){
                $sql = "INSERT INTO detail_invoice (id_invoice,id_product) VALUES (?,?);";
                $data = array($id_invoice,$id_product);
                $query = $this->db->query($sql,$data);
                if($query){
                    return true;
                }
            }
            return false;
        }

        function get_id_invoice_processing($id_table){
            $sql = "SELECT id FROM invoice WHERE status = ? AND id_table = ? ORDER BY create_at DESC LIMIT 1";
            $data = array('processing',$id_table);
            if($query = $this->db->query($sql,$data)){
                $result = $query->first_row();
                if($result){
                    return $result->id;
                }
                return false;
            }
            echo "ERROR";
            return false;
        }

        function get_invoice($id_table){
            $id_invoice = $this->get_id_invoice_processing($id_table);
            $sql_products = "SELECT detail_invoice.id,products.name,price_release.price,detail_invoice.quantities,detail_invoice.total FROM detail_invoice,products,price_release WHERE detail_invoice.id_invoice = ? AND products.id = detail_invoice.id_product AND products.id = price_release.id_product AND detail_invoice.status = ?;";
            $sql_invoice = "SELECT total FROM invoice WHERE id = ?;";
            try{
                $result_products = 0;
                $result_invoice = 0;
                if($query = $this->db->query($sql_products,array($id_invoice,'existed'))){
                    $result_products = $query->result_array();
                    //var_dump($result_products);
                }else{
                    return false;
                }

                if($query = $this->db->query($sql_invoice,$id_invoice)){
                    $result_invoice = $query->row();
                    //echo "<br>";
                    //var_dump($result_invoice);
                }else{
                    return false;
                }

                $result = array('products' => $result_products,'invoice' => $result_invoice);
                return $result;

            }catch(Exception $e){
                echo "Cause error ".$e->getMessege()."<br>";
            }
            return false;
        }

        private function checkTransaction($guestMoney,$total){
            if(($guestMoney - $total) < 0){
                return false;
            } 
            return true;
        }

        function charge_invoice($guestMoney,$id_table){
            try{
                $id_invoice = $this->get_id_invoice_processing($id_table);
                $sql = "SELECT invoice.total FROM invoice WHERE id = ?";
                if($query = $this->db->query($sql,$id_invoice)){
                    $total = $query->first_row()->total;
                    if($this->checkTransaction($guestMoney,$total)){
                        $sql = "UPDATE invoice SET status = ? WHERE id = ?";
                        if($query = $this->db->query($sql,array('done',$id_invoice))){
                            $sql = "INSERT INTO transaction_charge(id,id_invoice,guest_cash) VALUES(NULL,?,?)";
                            if($query = $this->db->query($sql,array($id_invoice,$guestMoney))){
                                $sql = "UPDATE tables SET status = ? WHERE id = ?";
                                if($query = $this->db->query($sql,array('available',$_SESSION['id_table']))){
                                    unset($_SESSION['id_table']);
                                    return true;
                                }
                            }
                        }
                    }
                }
            }catch(Exception $e){
                echo "Cause error ".$e->getMessege()."<br>";
            }
            return false;
        }

        function updateInvoiceStatusIsDone($id_invoice){
            $sql = "UPDATE invoice SET status = ? WHERE id = ?";
            $query = $this->db->query($sql,array('done',$id_invoice));
            return;
        }

        function tracking_invoice(){
            try{
                $sql = "SELECT invoice.id AS 'id',tables.name AS 'table',customer.name AS 'customer',users.name AS 'employee',invoice.total_amount AS 'total',invoice.create_at AS 'create_at',invoice.check_out_at AS 'check_out_at' FROM customer,invoice,tables,users WHERE invoice.status = 'done' AND invoice.id_table = tables.id AND invoice.id_customer = customer.id AND invoice.id_employee = users.id ORDER BY invoice.create_at DESC";
                if($query = $this->db->query($sql)){
                    return $query->result_array();
                }
            }catch(Exception $e){
                echo "Cause error ".$e->getMessege().'<br>';
            }
            return false;
        }

        function tracking_detail_invoice($id_invoice){
            try{
                $sql = "SELECT detail_invoice.id AS 'id',products.name AS 'product',detail_invoice.quantities,detail_invoice.total,detail_invoice.status,detail_invoice.deleted_at FROM invoice,detail_invoice,products WHERE invoice.id = ? AND invoice.id = detail_invoice.id_invoice AND detail_invoice.id_product = products.id; ";
                if($query = $this->db->query($sql,$id_invoice)){
                    return $query->result_array();
                }
            }catch(Exception $e){
                echo "Cause error ".$e->getMessege().'<br>';
            }

            return false;
        }

        function create_data_chart_by_date($month=""){
            try{
            if(empty($month)){
                    $sql = "SELECT SUM(total) AS 'y', date(create_at) as 'label' FROM invoice GROUP BY date(create_at)";
                    if($query = $this->db->query($sql)){
                        return $query->result_array();
                    }
            }else{
                    $sql = "SELECT SUM(total) AS 'y', date(create_at) as 'label' FROM invoice WHERE MONTH(create_at) = ? GROUP BY date(create_at)";
                    if($query = $this->db->query($sql)){
                        return $query->result_array($sql,$month);
                    }
            }
            }catch(Exception $e){
                echo "Cause error ".$e->getMessege()."<br>";
            }
            return false;
        }

        function create_data_chart_by_month($year=""){
            try{
                if(empty($year)){
                    $sql = "SELECT SUM(total) AS 'y',month(create_at) AS 'label' FROM invoice WHERE year(create_at) = year(CURRENT_TIMESTAMP) GROUP BY month(create_at) ORDER BY month(create_at) ASC;";
                    if($query = $this->db->query($sql)){
                        return $query->result_array();
                    }
                }else{
                    $sql = "SELECT SUM(total) AS 'y',month(create_at) AS 'label' FROM invoice WHERE year(create_at) = ? GROUP BY month(create_at) ORDER BY month(create_at) ASC;";
                    if($query = $this->db->query($sql,$year)){
                        return $query->result_array();
                    }
                }
            }catch(Exception $e){
                echo "Cause error ".$e->getMessege()."<br>";
            }
            return false;
        }

        function create_data_chart_by_year(){
            try{
                $sql = "SELECT SUM(total) AS 'y',year(create_at) AS 'label' FROM invoice GROUP BY year(create_at) ORDER BY year(create_at) ASC;";
                if($query = $this->db->query($sql)){
                    return $query->result_array();
                }
            }catch(Exception $e){
                echo "Cause error ".$e->getMessege()."<br>";
            }
            return false;
        }
    
    }

?>