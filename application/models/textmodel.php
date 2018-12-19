<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class TextModel extends CI_Model {
  function __construct(){
    parent::__construct();
  }

  function insert($author, $title, $content){
    $this->db->insert("article", Array(
      "Author" =>  $author,
      "Title" => $title,
      "Content" => $content,
      "Views" => 0,
    ));     
    return $this->db->insert_id() ;
  }

  function getTextByUserID($userID){
    $this->db->select("article.*,user.Account");
    $this->db->from('article');
    $this->db->join('user', 'article.author = user.userID', 'left');
    $this->db->where(Array("author" => $userID));
    $this->db->order_by("ArticleID","desc");
    $query = $this->db->get();

    return $query->result();
  }

   function get($articleID){
    //CI 裡面跨資料表結合的寫法
    $this->db->select("article.*,user.account");
    $this->db->from('article');
    $this->db->join('user', 'article.author = user.userID', 'left');
    $this->db->where(Array("articleID" => $articleID));
    $query = $this->db->get();

    if ($query->num_rows() <= 0){
        return null; //無資料時回傳 null
    }

    return $query->row();  //回傳第一筆
  }
}