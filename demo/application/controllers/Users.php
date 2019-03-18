<?php
    class Users extends CI_Controller{
        function __construct(){
            parent::__construct();
            $this->load->model('users_model');
            $this->load->model('tables_model');
        }

        function index(){
            $this->load->view("auth/login");
        }

        function login(){
            if(isset($_POST['username']) && isset($_POST['password'])){

                if($this->users_model->checkUsername($_POST['username'])){
                    $user = array($_POST['username'],$_POST['password']);
                    if($this->users_model->checkPassword($user)){
                        $_SESSION['user'] = array(
                           'username' => $_POST['username'],
                           'password' => $_POST['password'],
                           'roles' => $this->users_model->getIdRoles($_POST['username']),
                           'permissions' => $this->users_model->getIdPermissions($_POST['username'])
                        );
                        $this->tables_model->startScheduler();
                        unset($_POST);            
                        //redirect(base_url("business/home"));
                        echo "true";
                        return true;
                    }
                }else{
                    echo "";
                    //$this->load->view("auth/login");
                    return false;
                }

            }
            $this->load->view("auth/login");
            return false;
        }

        function logout(){
            session_destroy();
            redirect(base_url('users/login'));
        }

        function registration(){
            $this->load->view('auth/registration');
        }

        function createAccount(){
            if($this->users_model->checkUsername($_POST['username'])){
                echo "Username da ton tai";
                return;
            }
            if($this->users_model->checkCMND($_POST['cmnd'])){
                echo "CMND da ton tai";
                return;
            }else{
                $user = array(
                    'name' => $_POST['name'],
                    'cmnd' => $_POST['cmnd'],
                    'username' => $_POST['username'],
                    'password' => password_hash($_POST['password'],PASSWORD_DEFAULT)
                );
                if($this->users_model->createNewAccount($user)){
                    unset($_POST);
                    redirect(base_url('users/login'));
                }else{
                    echo "Failed";
                }
                
            }
        }

        function show_profile(){
            try{
                $result = $this->users_model->getInfoUser($_SESSION['user']['username']);
                $data = array(
                    'user' => $result
                );
                $this->load->view('templates/header');
                $this->load->view('templates/profile',$data);
                $this->load->view('templates/footer');
            }catch(Exception $e){ 
                echo "Cause error ".$e->getMessege()."<br>";
            }
           
        }
       
        function show_accounts(){
            try{
                $result = $this->users_model->getAllUsers();
                $data = array(
                    'users' => $result
                );
                $this->load->view('templates/header');
                $this->load->view('templates/accounts',$data);
                $this->load->view('templates/footer');
            }catch(Exception $e){
                echo "Cause error ".$e->getMessege()."<br>";
            }
        }

        function change_password(){
            try{
                if(isset($_POST['password'])){
                    $username = $_SESSION['user']['username'];
                    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
                    $data = array($password,$username);
                    if($this->users_model->change_password($data)){
                        unset($_POST);
                        return true;
                    }
                }
            }catch(Exception $e){
                echo "Cause error ".$e->getMessege()."<br>";
            }
            return false;
        }

        function reset_password(){
            try{
                if(!empty($_POST['id']) && !empty($_POST['password'])){
                    $id = $_POST['id'];
                    $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
                    $data = array($password,$id);
                    if($this->users_model->resetPassword($data)){
                        echo "Password was changed";
                        return true;
                    }else{
                        echo "Something went wrong";
                        return false;
                    }
                }
            }catch(Exception $e){
                echo "Cause error ".$e->getMessege()."<br>";
            }
            return false;
        }

        function create_account(){
            try{
                if(!empty($_POST['user'])){
                    $name = $_POST['user']['name'];
                    $cmnd = $_POST['user']['cmnd'];
                    $username = $_POST['user']['username'];
                    $password = password_hash($_POST['user']['password'],PASSWORD_DEFAULT);
                    $data = array($name,$cmnd,$username,$password);
                    if($this->users_model->createNewAccount($data)){
                        echo "New account was created";
                        return true;
                    }else{
                        echo "Something went wrong";
                        return false;
                    }
                }
            }catch(Exception $e){
                echo "Cause error ".$e->getMessege()."<br>";
            }
            return false;
        }

        function delete_user(){
            try{
                if(isset($_POST['id'])){
                    $id = $_POST['id'];
                    if($this->users_model->deleteUser($id)){
                        return true;
                    }
                }
            }catch(Exception $e){
                echo "Cause error ".$e->getMessege()."<br>";
            }
            return false;
        }
    }
?>