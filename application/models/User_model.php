
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	function __construct(){
        parent::__construct();
	}
	
	public function get_all($limit_offset = array()){
		if(!empty($limit_offset)){
			$query = $this->db->get("user",$limit_offset['limit'],$limit_offset['offset']);
		}else{
			$query = $this->db->get("user");
		}
		return $query->result();
	}
	public function count_total(){
		$query = $this->db->get("user");
		return $query->num_rows();
	}
	public function get_all_array($filter = false){
		if($filter){
			$query = $this->db->get_where("user",$filter);
		}else{
			$query = $this->db->get("user");
		}
		return $query->result_array();
	}
	public function get_last_id(){
		$this->db->order_by('id', 'DESC');

		$query = $this->db->get("user",1,0);
		return $query->result();
	}
	public function insert($id=null, $check_id =null){
		$txtUsername = $this->input->post('txtUsername',TRUE);
		$txtEmail = $this->input->post('txtEmail',TRUE);
		$txtPassword = $this->input->post('txtPassword',TRUE);

		if ($_FILES['file']['name'] != "") {
			$fileName          = $_FILES['file']['name'];
			$tmp                = explode('.', $fileName);
			$fileExtension      = end($tmp);
			$uploadable_file    = 'uploads/'. md5(uniqid(rand(), true)).'.'.$fileExtension;

			if($id)
			{
				unlink($check_id[0]['photo_profile']);
			}

			move_uploaded_file($_FILES['file']['tmp_name'], $uploadable_file);
    	} else {
    		$uploadable_file    ="";
    	}

    	if($id)
    	{
    		$data_photo = array(
    			'username' => htmlspecialchars($txtUsername),
    			'email' => htmlspecialchars($txtEmail),
    			'password' => md5($txtPassword),
    			'photo_profile' => $uploadable_file,
    			'updatedby' => "admin",
    			'updatedDate' => date('Y-m-d'),
    		);

    		$where = array(
				'id' => $id
			);

			$this->db->where($where);
			$this->db->update('user',$data_photo);

    	} else {
    		$data = array(
    			'username' => htmlspecialchars($txtUsername),
    			'email' => htmlspecialchars($txtEmail),
    			'password' => md5($txtPassword),
    			'photo_profile' => $uploadable_file,
    			'createdby' => "admin",
    			'createdDate' => date('Y-m-d'),
    		);

    		$this->db->insert('user', $data);
    	}

	}

	public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where('user',array('id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result_array();
		}
		return $response;
	}
	public function delete($id, $check_id){
		$this->db->delete('user', array('id' => $id));
		unlink($check_id[0]['photo_profile']);
	}
	public function get_filter($filter = '',$limit_offset = array()){
		if(!empty($filter)){
			$query = $this->db->get_where("user",$filter,$limit_offset['limit'],$limit_offset['offset']);
		}else{
			$query = $this->db->get("user",$limit_offset['limit'],$limit_offset['offset']);
		}
		return $query->result();
	}
	public function count_total_filter($filter = array()){
		if(!empty($filter)){
			$query = $this->db->get_where("user",$filter);
		}else{
			$query = $this->db->get("user");
		}
		return $query->num_rows();
	}
}