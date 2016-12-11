<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {
	public function indexs(){
		$this->load->view('index.html');
	}
    public function login_check(){
       // echo 1;die;
        $username=$this->input->post('username');
        //echo $username;die;
        $password=$this->input->post('password');
        //echo $password;die;
        $arr=$this->db->get_where('login',array('username'=>$username))->row_array();
        if(!$arr){

            $this->load->view('index.html');
            echo "<script>alert('用户名不正确');location.href('views/index.html')</script>";
        }
        else{
         // echo "<script>alert('用户名正确');location.href('show')</script>";
            $this->load->library('session');
            $this->session->username=$username;
            redirect('index/show');

        }


    }
    public function show(){
        $this->load->library('session');
        if(!$this->input->post()){
          $arr['list']=$this->db->get('book')->result_array();
            $this->load->view('show.html',$arr);
        }
        else{
            $_POST['j_content']=$this->input->post('j_content');
            $_POST['j_time']=date('Y/m/d');
            $ar=$this->db->insert('book',$_POST);
            if($ar){
                echo 1;
            }else{
                echo 0;
            }

        }

    }


}