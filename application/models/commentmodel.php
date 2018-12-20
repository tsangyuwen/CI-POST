<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CommentModel extends CI_Model {
  function __construct(){
    parent::__construct();
  }

  function addComment($userID, $textID, $comment){
    $this->db->insert("comment", Array(
      "Text" =>  $textID,
      "Author" => $userID,
      "Comment" => $comment
    ));
  }

  function get($textID){
    $this->db->select("comment.*, user.Account");
    $this->db->from('comment');
    $this->db->join('user', 'comment.author = user.userID', 'left');
    $this->db->where(Array("Text" => $textID));
    $query = $this->db->get();

    return $query->result();
  }
}