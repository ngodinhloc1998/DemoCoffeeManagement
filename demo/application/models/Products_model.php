<?php
    class Products_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->load->database();
        }

        function getProducts(){
            $sql = "SELECT products.*,price_release.price FROM products,price_release WHERE products.id = price_release.id_product AND status = 'existed'; ";
            $query = $this->db->query($sql);
            $result = $query->result_array();
            //var_dump($result);
            return $result;
        }

        function getProduct($idProduct){
            try{
                $sql = "SELECT products.*,price_release.price FROM products,price_release WHERE products.id = price_release.id_product AND products.id = ? AND status = 'existed' ;";
                if($query = $this->db->query($sql,$idProduct)){
                    return $query->first_row();
                }
            }catch(Exception $e){
                echo "Cause error ".$e->getMessage()."<br>";
            }
            return false;       
        }

        function getArrayIdProducts(){
            $sql = "SELECT id FROM detail_invoice";
            $query = $this->db->query($sql);
            if($result = $query->result_array()){
                return $result;
            }
            return false;
        }

        function get_id_products_in_invoice($id_invoice){
            $sql = "SELECT detail_invoice.id_product FROM invoice,detail_invoice WHERE invoice.id = ? AND detail_invoice.id_invoice = invoice.id AND  detail_invoice.status = ?;";
            try{
                $query = $this->db->query($sql,array($id_invoice,'existed'));
                if($query){
                    $result = $query->result_array();
                    //var_dump($result);
                    return $result;
                }
                return false;
            }catch(Exception $e){
                echo "Cause error ".$e->getMessage()."<br>";
            }
            return false;
        }

        function update_quantities_product_detail_invoice($id,$value){
            if(isset($id) && isset($value)){
                try{
                    $sql = "UPDATE detail_invoice SET quantities = ? WHERE id = ?";
                    if($this->db->query($sql,array($value,$id))){
                        $sql = "SELECT total FROM detail_invoice WHERE id = ?";
                        if($query1 = $this->db->query($sql,$id)){
                            //$result = array('totalThisProduct' => $query->first_row()->total);
                            $sql = "SELECT SUM(detail_invoice.total) AS 'total' FROM detail_invoice WHERE detail_invoice.status <> 'deleted' AND detail_invoice.id_invoice IN (SELECT invoice.id FROM detail_invoice,invoice WHERE invoice.id = detail_invoice.id_invoice AND detail_invoice.id = ?);";
                            if($query2 = $this->db->query($sql,$id)){
                                $result = array(
                                    "totalProduct" => number_format($query1->first_row()->total),
                                    "totalInvoice" => number_format($query2->first_row()->total)
                                );
                                return $result;
                            }
                            //return $result->total;
                        }
                    }
                }catch(Exception $e){
                    echo "Cause error ".$e->getMessage()."<br>";
                }
            }
            return false;
        }

        function detele_product_in_detail_invoice($id){
            $sql = "UPDATE detail_invoice SET status = ? WHERE id = ?";
            try{
                if($query = $this->db->query($sql,array('deleted',$id))){
                    $sql = "SELECT invoice.total FROM invoice,detail_invoice WHERE detail_invoice.id = ? AND detail_invoice.id_invoice = invoice.id;";
                    if($query = $this->db->query($sql,$id)){
                        $result = $query->first_row();
                        return $result->total;
                    }
                }   
            }catch(Exception $e){
                echo "Cause error ".$e->getMessage()."<br>";
            }
            return false;
        }

        function add_new_product($data){
            try{
                $sql = "INSERT INTO products (id_type,name,image) VALUES (?,?,?)";
                if($idType = $this->get_id_type_product($data['type'])){
                    if($query = $this->db->query($sql,array($idType,$data['name'],$data['image']))){
                        if($id = $this->get_last_id_product()){
                            $sql = "INSERT INTO price_release VALUES (?,?)";
                            if($query = $this->db->query($sql,array($id,$data['price']))){
                                return true;
                            }
                        }  
                    }
                }
            }catch(Exception $e){
                echo "Cause error ".$e.getMessage()."<br>";
            }
            return false;
        }

        function get_id_type_product($typeName){
            try{
                $sql = "SELECT id FROM type_product WHERE name = ?";
                if($query = $this->db->query($sql,$typeName)){
                    return $query->first_row()->id;
                }       
            }catch(Exception $e){
                echo "Cause error ".$e->getMessage()."<br>";
            }
            return false;
        }

        function get_last_id_product(){
            try{
                $sql = "SELECT id FROM products ORDER BY id DESC LIMIT 1";
                if($query = $this->db->query($sql)){
                    return $query->first_row()->id;
                } 
            }catch(Exception $e){
                echo "Cause error ".$e->getMessage()."<br>";
            }
            return false;
        }

        function name_product_exists($nameNewProduct){
            try{
                $sql = "SELECT name FROM products;";
                if($query = $this->db->query($sql)){
                    $nameProducts = $query->result_array();
                    foreach($nameProducts as $nameProduct){
                        if(strtolower($nameNewProduct) == strtolower($nameProduct['name'])){
                            return true;
                        }
                    }
                }
            }catch(Exception $e){
                echo "Cause error ".$e->getMessage()."<br>";
            }
            return false;
        }

        function edit_name_product_exists($nameEditProduct,$idProduct){
            try{
                $sql = "SELECT name FROM products WHERE id != ?;";
                if($query = $this->db->query($sql,$idProduct)){
                    $nameProducts = $query->result_array();
                    foreach($nameProducts as $nameProduct){
                        if(strtolower($nameEditProduct) == strtolower($nameProduct['name'])){
                            return true;
                        }
                    }
                }
            }catch(Exception $e){
                echo "Cause error ".$e->getMessage()."<br>";
                die();
            }
            return false;
        }

        function delete_product($id_product){
            try{
                $sql = "UPDATE products SET status = 'deleted' WHERE id = ?;";
                if($query = $this->db->query($sql,$id_product)){
                    return true;
                }
            }catch(Exception $e){
                echo "Cause error ".$e->getMessage()."<br>";
            }
            return false;
        }

        function edit_change_image_product($data){
            try{
                $sql = "SELECT image FROM products WHERE id = ?";
                $image = $this->db->query($sql,$data['id'])->first_row()->image;
                $idType = $this->get_id_type_product($data['type']);
                $sql = "UPDATE products SET id_type = ?, name = ? , description = ?, image = ? WHERE id = ?";
                if($query = $this->db->query($sql,array($idType,$data['name'],$data['description'],$data['image'],$data['id']))){
                    $sql = "UPDATE price_release SET price = ? WHERE id_product = ?";
                    if($query = $this->db->query($sql,array($data['price'],$data['id']))){
                        return $image;
                    }
                }
            }catch(Exception $e){
                echo "Cause error ".$e->getMessage()."<br>";
            }
            return false;
        }

        function edit_product($data){
            try{
                $idType = $this->get_id_type_product($data['type-product']);
                $sql = "UPDATE products SET id_type = ?, name = ? , description = ? WHERE id = ?;";
                if($query = $this->db->query($sql,array($idType,$data['name-product'],$data['description-product'],$data['id-product']))){
                    $sql = "UPDATE price_release SET price = ? WHERE id_product = ?";
                    if($query = $this->db->query($sql,array($data['price-product'],$data['id-product']))){
                        return true;
                    }
                }
            }catch(Exception $e){
                echo "Cause error ".$e->getMessage()."<br>";
            }
            return false;
        }

    }
?>