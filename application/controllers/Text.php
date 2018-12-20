<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Text extends CI_Controller {
  public function author($author = null){
    if($author == null){
      show_404("author not found!");
      return true;
    }

    $this->load->model("UserModel");
    $this->load->model("TextModel");

    $user = $this->UserModel->getUserByAccount($author);
    $results = $this->TextModel->getTextByUserID($user->UserID);

    $this->load->view('author', Array(
        "pageTitle" => $user->Account." POST",
        "results" => $results,
        "user" => $user
      )
    );
  }

  public function post(){
    $this->load->model("TextModel");

    $results = $this->TextModel->getAllText();

    $this->load->view('post', Array(
        "pageTitle" => "POST",
        "results" => $results
      )
    );
  }

  public function posting(){
    if (!isset($_SESSION["user"])){
      redirect(site_url("/user/login"));
      return true;
    }

    $title = trim($this->input->post("title"));
    $content= trim($this->input->post("content"));

    $this->load->model("UserModel");
    $this->load->model("TextModel");

    $user = $this->UserModel->getUserByAccount($_SESSION["user"]->Account);
    $results = $this->TextModel->getTextByUserID($user->UserID);
    
    if($title == "" || $content == ""){
      $this->load->view('author',Array(
        "errorMessage" => "標題內容不得空白！",
        "title" => $title,
        "content" => $content,
        "results" => $results,
        "user" => $user
      ));
      return false;
    }

    $this->TextModel->insert($_SESSION["user"]->UserID, $title, $content); 

    redirect(site_url("text/author/".$_SESSION["user"]->Account));
  }

  public function view($textID = null){
    if (!isset($_SESSION["user"])){
      redirect(site_url("/user/login"));
      return true;
    }

    if($textID == null){
      show_404("Post not found !");
      return true;
    }

    $this->load->model("TextModel");
    $this->load->model("CommentModel");

    $post = $this->TextModel->get($textID); 
    $comments = $this->CommentModel->get($textID);

    if($post == null){
      show_404("Post not found !");
      return true;  
    }

    $this->load->view('view',Array(
      "pageTitle" => $post->Title, 
      "post" => $post,
      "comments" => $comments
    ));
  }

  public function commenting($textID = null){
    if (!isset($_SESSION["user"])){
      redirect(site_url("/user/login"));
      return true;
    }

    $comment = trim($this->input->post("comment"));

    $this->load->model("UserModel");
    $this->load->model("TextModel");
    $this->load->model("CommentModel");

    $user = $this->UserModel->getUserByAccount($_SESSION["user"]->Account);
    $post = $this->TextModel->get($textID);
    $comments = $this->CommentModel->get($textID);
    
    if($comment == ""){
      $this->load->view('view',Array(
        "errorMessage" => "回復內容不得空白！",
        "pageTitle" => $post->Title, 
        "post" => $post,
        "comments" => $comments
      ));
      return false;
    }

    $this->CommentModel->addComment($user->UserID, $textID, $comment);

    redirect(site_url("text/view/".$post->TextID));
  }

}