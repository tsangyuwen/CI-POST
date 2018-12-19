<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class UserModel extends CI_Model {
  function __construct(){
      parent::__construct();
  }

  function insert($account, $password){
    $this->db->insert("user", Array(
      "account" =>  $account,
      "password" =>  password_hash($password,  PASSWORD_DEFAULT)
    ));     
  }    

  function checkUserExist($account){
    $this->db->select("COUNT(*) AS users");
    $this->db->from("user");
    $this->db->where("account", $account);
    $query = $this->db->get(); 
    return $query->row()->users > 0 ;
  }

  function getUser($account, $password){
    $query = $this->db->get_where("user", Array("account" => $account, "password"));
    
    if ($query->num_rows() > 0){
      $obj = $query->row_array();
      if(password_verify($password, $obj['Password'])){
        return $query->row();
      }else{
        return null;
      } 
    }else{
      return null;
    }
  }
}