<?php
    class Manage_products extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('products_model');
            $this->load->model('invoice_model');
        }

        private function checkLogin(){
            if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
                return true;
            }
            redirect("users/login");
        }

        function show_products(){
            $this->checkLogin();
            $products = $this->products_model->getProducts();
            $id_invoice = $this->invoice_model->get_id_invoice_processing($_SESSION['id_table']);
            $id_products_in_invoice = $this->products_model->get_id_products_in_invoice($id_invoice);
            $data = array(
                'products' => $products,
                'productsInvoice' => $id_products_in_invoice,
                'type' => 'order'
            );
            $numItems = 0;
            if($id_products_in_invoice){
                $numItems = array('numItems' => count($id_products_in_invoice));
            }
            $this->load->view('templates/header',$numItems);
            $this->load->view('templates/products',$data);
            $this->load->view('templates/footer');
        }


        function update_quantities_product(){
            $this->checkLogin();
            if(isset($_POST['id_product']) && isset($_POST['quantities'])){
                $id = $_POST['id_product'];
                $value = $_POST['quantities'];
                if($result = $this->products_model->update_quantities_product_detail_invoice($id,$value)){
                    unset($_POST['id_product']);
                    unset($_POST['quantities']);
                    echo json_encode($result);
                    return true;
                }

            }
            unset($_POST['id_product']);
            unset($_POST['quantities']);
            return false;
        }

        function detele_product_in_detail_invoice(){
            $this->checkLogin();
            if(isset($_POST['id'])){
                $id = $_POST['id'];
                try{
                    if($result = $this->products_model->detele_product_in_detail_invoice($id)){
                        unset($id);
                        echo $result;
                        return $result;
                    }
                }catch(Exception $e){
                    echo "Cause error ".$e->getMessege()."<br>";
                }
            }
            return false;
        }

        function list_products(){
            unset($_SESSION['id_table']);
            $this->checkLogin();
            $products = $this->products_model->getProducts();
            //$id_invoice = $this->invoice_model->get_id_invoice_processing($_SESSION['id_table']);
            //$id_products_in_invoice = $this->products_model->get_id_products_in_invoice($id_invoice);
            $data = array(
                'products' => $products,
                //'productsInvoice' => $id_products_in_invoice,
                'type' => 'view'
            );
            $numItems = 0;
            //if($id_products_in_invoice){
                //$numItems = array('numItems' => count($id_products_in_invoice));
            //}
            $this->load->view('templates/header',$numItems);
            $this->load->view('templates/products',$data);
            $this->load->view('templates/footer');
        }

        function edit_products(){
            unset($_SESSION['id_table']);
            $this->checkLogin();
            $products = $this->products_model->getProducts();
            //$id_invoice = $this->invoice_model->get_id_invoice_processing($_SESSION['id_table']);
            //$id_products_in_invoice = $this->products_model->get_id_products_in_invoice($id_invoice);
            $data = array(
                'products' => $products,
                //'productsInvoice' => $id_products_in_invoice,
                'type' => 'permiss_edit'
            );
            $numItems = 0;
            //if($id_products_in_invoice){
                //$numItems = array('numItems' => count($id_products_in_invoice));
            //}
            $this->load->view('templates/header',$numItems);
            $this->load->view('templates/products',$data);
            $this->load->view('templates/footer');
        }

        function add_new_product(){
            if(isset($_POST['type-product']) && isset($_POST['name-product']) && isset($_POST['price-product']) && isset($_FILES['image-product'])){

                if($this->products_model->name_product_exists($_POST['name-product'])){
                    $_SESSION['msg_upload_image'] = 'Product already exists';
                    $uploadOk = 0;
                    unset($_POST);
                    redirect(base_url('manage_products/edit_products'));
                }

                $uploadOk = 1;
                if($_POST['type-product'] == 'drink'){
                    $target_dir = "public/products/images/drink/";
                    $target_file = $target_dir.basename($_FILES['image-product']['name']);
                }else if($_POST['type-product'] == 'food'){
                    $target_dir = "public/products/images/food";
                    $target_file = $target_dir.basename($_FILES['image-product']['name']);
                }
                $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                $check = getimagesize($_FILES['image-product']['tmp_name']);
                if($check !== false){
                    $uploadOk = 1;
                }else{
                    $_SESSION['msg_upload_image'] = 'File is not an Images';
                    $uploadOk = 0;
                    unset($_POST);
                    redirect(base_url('manage_products/edit_products'));
                }

                if(file_exists($target_file)){
                    echo $target_file;
                    $_SESSION['msg_upload_image'] = "Sorry, image already exists";
                    unset($_POST);
                    $uploadOk = 0;
                    redirect(base_url('manage_products/edit_products'));
                }

                if($_FILES['image-product']['size'] > 5000000){
                    $_SESSION['msg_upload_image'] = "Sorry, file is too large for upload";
                    $uploadOk = 0;
                    redirect(base_url('manage_products/edit_products'));
                }

                if($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png' && $imageFileType != 'gif'){
                    $_SESSION['msg_upload_image'] = "Sorry only JPG,JPEG,PNG and GIF are allowed";
                    $uploadOk = 0;
                    unset($_POST);
                    redirect(base_url('manage_products/edit_products'));
                }

                if($uploadOk == 1){
                    if(move_uploaded_file($_FILES['image-product']['tmp_name'],$target_file)){
                        
                        $data = array(
                            'type' => $_POST['type-product'],
                            'name' => $_POST['name-product'],
                            'price' => $_POST['price-product'],
                            'image' => $target_file
                        );
                        if($this->products_model->add_new_product($data)){
                            $_SESSION['msg_upload_image'] = "A new products is added to list products";
                        }else{
                            unlink($target_file);
                            $_SESSION['msg_upload_image'] = "Sorry, there was a error uploading your file(storage)";
                        }
                    }else{
                        $_SESSION['msg_upload_image'] = "Sorry, there was a error uploading your file";
                    }
                    unset($_POST);
                    redirect(base_url('manage_products/edit_products'));
                }
                
            }else{
                $_SESSION['msg_upload_image'] = "Please fill all input fields";
                $uploadOk = 0;
                unset($_POST);
                redirect(base_url('manage_products/edit_products'));
            }
        }

        function check_upload_file($data,$query){
            if($data['type-product'] == 'drink'){
                $target_dir = "public/products/images/drink/";
                $target_file = $target_dir.basename($data['image-product']['name']);
            }else if($data['type-product'] == 'food'){
                $target_dir = "public/products/images/food";
                $target_file = $target_dir.basename($data['image-product']['name']);
            }
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $check = getimagesize($data['image-product']['tmp_name']);
            if($check !== false){
                $uploadOk = 1;
            }else{
                $_SESSION['msg_upload_image'] = 'File is not an Images';
                redirect(base_url('manage_products/edit_products'));
            }

            if(file_exists($target_file)){
                $_SESSION['msg_upload_image'] = "Sorry, image already exists";
                redirect(base_url('manage_products/edit_products'));
            }

            if($data['image-product']['size'] > 5000000){
                $_SESSION['msg_upload_image'] = "Sorry, file is too large for upload";
                redirect(base_url('manage_products/edit_products'));
            }

            if($imageFileType != 'jpg' && $imageFileType != 'jpeg' && $imageFileType != 'png' && $imageFileType != 'gif'){
                $_SESSION['msg_upload_image'] = "Sorry only JPG,JPEG,PNG and GIF are allowed";
                redirect(base_url('manage_products/edit_products'));
            }

            if(move_uploaded_file($data['image-product']['tmp_name'],$target_file)){
                    
                $result = array(
                    'type' => $data['type-product'],
                    'name' => $data['name-product'],
                    'price' => $data['price-product'],
                    'description' => $data['description-product'],
                    'id' => $data['id-product'],
                    'image' => $target_file
                );
                if($image = $this->products_model->$query($result)){
                    if($query == "edit_change_image_product"){
                        unlink($image);
                        $_SESSION['msg_upload_image'] = "Update successfully";
                    }else{
                        $_SESSION['msg_upload_image'] = "A new products is added to list products";
                    }
                }else{
                    unlink($target_file);
                    $_SESSION['msg_upload_image'] = "Sorry, there was a error uploading your file(storage)";
                }
            }else{
                $_SESSION['msg_upload_image'] = "Sorry, there was a error uploading your file";
            }
            redirect(base_url('manage_products/edit_products'));
        }

        function add_new_product_v2(){
            if(!empty($_POST['type-product']) && !empty($_POST['name-product']) && !empty($_POST['price-product']) && !empty($_FILES['image-product'])){
                if($this->products_model->name_product_exists($data['name-product'])){
                    $_SESSION['msg_upload_image'] = 'Product already exists';
                    redirect(base_url('manage_products/edit_products'));
                }
                $data = array(
                    'type-product' => $_POST['type-product'],
                    'name-product' => $_POST['name-product'],
                    'price-product' => $_POST['price-product'],
                    'image-product' => $_FILES['image-product']
                );         
                unset($_POST);
                $query = "add_new_product";
                $this->check_upload_file($data,$query);
            }else{
                $_SESSION['msg_upload_image'] = "Please fill all input fields";
                unset($_POST);
                redirect(base_url('manage_products/edit_products'));
            }
        }

        function edit_product(){
            if(!empty($_POST['type-edit-product']) && !empty($_POST['name-edit-product']) && !empty($_POST['price-edit-product']) &!empty($_POST['description-edit-product'])){
                if($this->products_model->edit_name_product_exists($_POST['name-edit-product'],$_POST['id-edit-product'])){
                    $_SESSION['msg_upload_image'] = 'Product already exists';
                    redirect(base_url('manage_products/edit_products'));
                }
                if(!empty($_FILES['image-edit-product']['size'])){
                    $data = array(
                        'type-product' => $_POST['type-edit-product'],
                        'name-product' => $_POST['name-edit-product'],
                        'price-product' => $_POST['price-edit-product'],
                        'description-product' => $_POST['description-edit-product'],
                        'image-product' => $_FILES['image-edit-product'],
                        'id-product' => $_POST['id-edit-product']
                    );
                    unset($_POST);
                    $query = "edit_change_image_product";
                    $this->check_upload_file($data,$query);
                }else{
                    $data = array(
                        'type-product' => $_POST['type-edit-product'],
                        'name-product' => $_POST['name-edit-product'],
                        'price-product' => $_POST['price-edit-product'],
                        'description-product' => $_POST['description-edit-product'],
                        'id-product' => $_POST['id-edit-product']
                    );
                    unset($_POST);
                    if($this->products_model->edit_product($data)){
                        $_SESSION['msg_upload_image'] = "Update successfully";
                    }else{
                        $_SESSION['msg_upload_image'] = "Please fill all input fields";
                    }
                    redirect(base_url('manage_products/edit_products'));
                }
            }else{
                $_SESSION['msg_upload_image'] = "Please fill all input fields";
                unset($_POST);
                redirect(base_url('manage_products/edit_products'));
            }
        }

        function get_product(){
            try{
                if(!empty($_POST['id_product'])){
                    if($data = $this->products_model->getProduct($_POST['id_product'])){
                        unset($_POST);
                        echo json_encode($data);
                        return false;
                    }
                }
            }catch(Exception $e){
                echo "Cause error ".$e->getMessege()."<br>";
            }
            return false;
        }

        function delete_product(){
            try{
                if(!empty($_POST['id_product'])){
                    if($this->products_model->delete_product($_POST['id_product'])){
                        echo "This product was deleted";
                        return true;
                    }
                }
            }catch(Exception $e){
                echo "Cause error ".$e->getMessege()."<br>";
            }
            echo "There was an error when delete product";
            return false;
        }

    }
?>