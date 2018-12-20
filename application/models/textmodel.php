<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class TextModel extends CI_Model {
  function __construct(){
    parent::__construct();
  }

  function insert($author, $title, $content){
    $this->db->insert("text", Array(
      "Author" =>  $author,
      "Title" => $title,
      "Content" => $content
    ));
  }

  function getTextByUserID($userID){
    $this->db->select("text.*, user.Account");
    $this->db->from('text');
    $this->db->join('user', 'text.author = user.userID', 'left');
    $this->db->where(Array("author" => $userID));
    $this->db->order_by("TextID","desc");
    $query = $this->db->get();

    return $query->result();
  }

  function getAllText(){
    $this->db->select("text.*, user.Account");
    $this->db->from('text');
    $this->db->join('user', 'text.author = user.userID', 'left');
    $this->db->order_by("TextID","desc");
    $query = $this->db->get();

    return $query->result();
  }

   function get($textID){
    $this->db->select("text.*, user.Account");
    $this->db->from('text');
    $this->db->join('user', 'text.author = user.userID', 'left');
    $this->db->where(Array("TextID" => $textID));
    $query = $this->db->get();

    if ($query->num_rows() <= 0){
      return null; 
    }

    return $query->row();
  }
}