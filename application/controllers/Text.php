<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Text extends CI_Controller {
  public function author(){
    $this->load->view('author');
  }

  public function post(){
    if(isset($_SESSION["user"])){
      redirect(site_url("/user/login"));
      return true;
    }

    $this->load->view('post', Array(
      "pageTitle" => "POST"
    )); 
  }

  public function posting(){
    if (isset($_SESSION["user"])){
      redirect(site_url("/user/login"));
      return true;
    }

    $title = trim($this->input->post("title"));
    $content= trim($this->input->post("content"));
    
    if($title == "" || $content == ""){
      $this->load->view('post',Array(
        "pageTitle" => "POST",
        "errorMessage" => "Title or Content shouldn't be empty,please check!",
        "title" => $title,
        "content" => $content
      ));
      return false;
    }

    $this->load->model("TextModel");
    session_start();
    $insertID = $this->TextModel->insert($_SESSION["user"]->UserID, $title, $content); 
    redirect(site_url("text/author"));
  } 

  public function postSuccess($articleID){
    $this->load->view('article_success',Array(
        "pageTitle" => "發文系統 - 文章發表成功",
        "articleID" => $articleID
    ));
  }

  public function edit(){
    $this->load->view('edit');  
  }

  public function view($articleID = null){
    if($articleID == null){
      show_404("Post not found !");
      return true;
    }

    $this->load->model("PostModel");
    //完成取資料動作
    $article = $this->ArticleModel->get($articleID); 

    if($article == null){
      show_404("Post not found !");
      return true;  
    }

    $this->load->view('view',Array(
      //設定網頁標題
      "pageTitle" => "發文系統 - 文章 [".$article->Title."] ", 
      "article" => $article
    ));
  }

}