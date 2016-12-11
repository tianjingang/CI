<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index_model extends CI_Model {
	//添加
	public function add($data){
		return $this->db->insert('login',$data);
	}
	//查询
	public function sel(){
		return $this->db->get('login')->result_array();
	}
	//删除
	public function del($where){
		return $this->db->where("id=$where")->delete('login');
	}
}