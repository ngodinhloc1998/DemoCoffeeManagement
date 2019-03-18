<?php
    class Tables_model extends CI_Model{
        function __construct(){
            parent::__construct();
            $this->load->database();
        }

        function getTables(){
            $sql = "SELECT * FROM tables WHERE status <> 'deleted' ORDER BY  LENGTH(name),CAST(name AS SIGNED) ASC,name ASC";
            $query = $this->db->query($sql);
            $rows = $query->result_array();
            if(!empty($rows)){
                return $rows;
            }
            return false;
        }

        function getIdTableByName($name){
            $sql = "SELECT id FROM tables WHERE name = ?";
            try{
                if($query = $this->db->query($sql,$name)){
                    echo $query->first_row();
                    return $query->first_row();
                }
            }catch(Exception $e){
                echo "Something went wrong";
            }
            return false;
        }

        function updateWhenTableIsOrdered($id){
            $name_schedule = 'update_book_schedule_'.$id;
            $sql = "DROP EVENT IF EXISTS `$name_schedule`";
            $query = $this->db->query($sql,$id);
            $sql = "UPDATE tables SET status = 'active' WHERE id = ?";
            $query = $this->db->query($sql,$id);
        }

        function updateTableIsAvailable($id){
            $name_schedule = 'update_book_schedule_'.$id;
            $sql = "DROP EVENT IF EXISTS `$name_schedule`";
            $query = $this->db->query($sql,$id);
            $sql = "UPDATE tables SET status = 'available' WHERE id = ?";
            $query = $this->db->query($sql,$id);
        }

        function updateWhenTableIsBooked($data){//data : id_table,time_booked
            $data1 = array('booked',$data['time_booked'],$data['id_table']);
            $sql = "UPDATE tables SET status = ?,book_at = ? WHERE id = ?";
            if($query = $this->db->query($sql,$data1)){
                $name_schedule = 'update_book_schedule_'.$data['id_table'];
                $data2 = array($data['time_booked'],'available',$data['id_table']);
                $sql = "CREATE EVENT `$name_schedule` ON SCHEDULE AT ? + INTERVAL 15 MINUTE DO UPDATE tables SET status = ? WHERE id = ?";
                if($query = $this->db->query($sql,$data2)){
                    return true;
                }
            }
            return false;
        }

        function startScheduler(){
            $sql = "SET GLOBAL event_scheduler = ON";
            $query = $this->db->query($sql);
        }


        function checkTableIsExists($name){
            try{
                $sql = "SELECT COUNT(*) AS 'quantity' FROM tables WHERE tables.name = ?;";
                if($query = $this->db->query($sql,$name)){
                    $result = $query->first_row();
                    if($result->quantity >= 1){
                        return true;
                    }
                }
            }catch(Exception $e){
                echo "Cause error ".$e->getMessege()."<br>";
            }
            return false;
        }

        function addNewTable($name){
            try{
                if($this->checkTableIsExists($name)){
                    return false;
                }else{
                    $sql = "INSERT INTO tables VALUES (NULL,?,?,NULL)";
                    $data = array($name,'available');
                    if($query = $this->db->query($sql,$data)){
                        return true;
                    }
                }
            }catch(Exception $e){
                echo "Cause error ".$e->getMessege()."<br>";
            }
            return false;
        }

        function deleteTable($name){
            try{
                $sql = "UPDATE tables SET status = ? WHERE name = ?";
                if($query = $this->db->query($sql,array('deleted',$name))){
                    return true;
                }   
            }catch(Exception $e){
                echo "Cause error ".$e->getMessege()."<br>";
            }
            return false;
        }

    }
?>