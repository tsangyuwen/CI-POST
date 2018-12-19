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
    if($user == null){
      show_404("Author not found !");
    }

    $results = $this->TextModel->getTextByUserID($user->UserID);

    $this->load->view('author', Array(
        "pageTitle" => $user->Account." POST",
        "results" => $results,
        "user" => $user,
      )
    );
  }

  public function post(){
    $this->load->view('post');
  }

  public function create(){
    if(isset($_SESSION["user"])){
      redirect(site_url("/user/login"));
      return true;
    }

    $this->load->view('create', Array(
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
      $this->load->view('create',Array(
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

  public function edit(){
    $this->load->view('edit');  
  }

}