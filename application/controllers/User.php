<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller {
  public function register(){
    $this->load->view('register',
      Array("pageTitle" => "註冊")
    );
  }

  public function registering(){
    $account = $this->input->post("account");
    $password = $this->input->post("password");
    $passwordrt = $this->input->post("passwordrt");
    
    if(trim($password) == "" || trim($account) == ""){
      $this->load->view('register', Array(
        "errorMessage" => "帳號密碼不得空白，請確認！",
        "account" => $account
      ));
      return false;
    }

    if($password != $passwordrt){
      $this->load->view('register', Array(
        "errorMessage" => "密碼不相等，請重新輸入",
        "account" => $account
      ));
      return false;
    }

    $this->load->model("UserModel");
    if($this->UserModel->checkUserExist($account)){
      $this->load->view('register',Array(
        "errorMessage" => "帳號已存在"
      ));
      return false;
    }

    $this->UserModel->insert(trim($account),trim($password));
    redirect(site_url("/user/login")); 
  }

  public function login(){
    session_start();
    if(isset($_SESSION["user"]) && $_SESSION["user"] != null){
      redirect(site_url("/"));
      return true;
    }

    $this->load->view(
      "login",
      Array( "pageTitle" => "登入" )
    );
  }

  public function logining(){
    session_start();
    if(isset($_SESSION["user"]) && $_SESSION["user"] != null){
      redirect(site_url("/"));
      return true;
    }

    $account = trim($this->input->post("account"));
    $password = trim($this->input->post("password"));

    $this->load->model("UserModel");
    $user = $this->UserModel->getUser($account, $password);
    if($user == null){
      $this->load->view(
        "login",
        Array( "pageTitle" => "登入" ,
          "account" => $account,
          "errorMessage" => "使用者或密碼錯誤"
        )
      );    
      return true;
    }
    $_SESSION["user"] = $user;
    redirect(site_url("/")); //轉回首頁
  }

  public function logout(){
    session_start();
    session_destroy();
    redirect(site_url("/user/login")); //轉回登入頁
  }
}