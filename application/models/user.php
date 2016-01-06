<?php

class User extends CI_Model{

 public function get_users(){
   // var_dump($this->db);
   // die();
   return $this->db->query("SELECT * FROM users")->result_array();
 }

 public function get_words(){

  return $this->db->query("SELECT * FROM words")->result_array();
 }

 public function get_blocked_words(){

  return $this->db->query("SELECT * FROM blockedwords")->result_array();
 }


}


?>
