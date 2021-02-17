
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class masterbiaya_model extends CI_Model {
	function __construct(){
        parent::__construct();
	}
	
	public function get_all($limit_offset = array()){
		if(!empty($limit_offset)){
			$query = $this->db->get("expense_account",$limit_offset['limit'],$limit_offset['offset']);
		}else{
			$query = $this->db->get("expense_account");
		}
		return $query->result();
	}

	public function get_all_pengeluaran($limit_offset = array()){
		if(!empty($limit_offset)){
			$limit = $limit_offset['limit'];
			$offset = $limit_offset['offset'];
			$sql = "SELECT a.tanggal, a.jumlah, a.keterangan, b.code, b.name FROM pengeluaran a
				Inner JOIN expense_account b ON a.akun_id = b.id LIMIT $limit OFFSET $offset ";
		} else {
			$sql = "SELECT a.tanggal, a.jumlah, a.keterangan, b.code, b.name
				FROM pengeluaran a
				Inner JOIN expense_account b ON a.akun_id = b.id ";
			
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	
	public function count_total(){
		$query = $this->db->get("expense_account");
		return $query->num_rows();
	}
	public function count_total_pengeluaran(){
		$query = $this->db->get("pengeluaran");
		return $query->num_rows();
	}
	public function get_all_array($filter = false){
		if($filter){
			$query = $this->db->get_where("expense_account",$filter);
		}else{
			$query = $this->db->get("expense_account");
		}
		return $query->result_array();
	}
	public function get_last_id(){
		$this->db->order_by('id', 'DESC');

		$query = $this->db->get("expense_account",1,0);
		return $query->result();
	}
	public function insert($id=null, $check_id =null){
		$txtexpense_accountname = $this->input->post('txtexpense_accountname',TRUE);
		$txtEmail = $this->input->post('txtEmail',TRUE);
		$txtStatus = $this->input->post('txtStatus',TRUE);

    	if($id)
    	{
    		$data_photo = array(
    			'code' => htmlspecialchars($txtexpense_accountname),
    			'name' => htmlspecialchars($txtEmail),
    			'status_akun' => htmlspecialchars($txtStatus),
    			'updatedby' => $this->session->userdata('username'),
    			'updatedDate' => date('Y-m-d h:i:s'),
    		);

    		$where = array(
				'id' => $id
			);

			$this->db->where($where);
			$this->db->update('expense_account',$data_photo);

    	} else {
    		$data = array(
    			'code' => htmlspecialchars($txtexpense_accountname),
    			'name' => htmlspecialchars($txtEmail),
    			'status_akun' => htmlspecialchars($txtStatus),
    			'createdby' => $this->session->userdata('username'),
    			'createdDate' => date('Y-m-d h:i:s'),
    		);

    		$this->db->insert('expense_account', $data);
    	}

	}

	public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where('expense_account',array('id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result_array();
		}
		return $response;
	}

	public function delete($id, $check_id){
		$this->db->delete('expense_account', array('id' => $id));
		unlink($check_id[0]['photo_profile']);
	}
	public function get_filter($filter = '',$limit_offset = array()){
		if(!empty($filter)){
			$query = $this->db->get_where("expense_account",$filter,$limit_offset['limit'],$limit_offset['offset']);
		}else{
			$query = $this->db->get("expense_account",$limit_offset['limit'],$limit_offset['offset']);
		}
		return $query->result();
	}
	public function count_total_filter($filter = array()){
		if(!empty($filter)){
			$query = $this->db->get_where("expense_account",$filter);
		}else{
			$query = $this->db->get("expense_account");
		}
		return $query->num_rows();
	}

	public function get_pengeluaran_filter($filter = '',$limit_offset = array()){
		if(!empty($filter)){
			$query = $this->db->get_where("pengeluaran",$filter,$limit_offset['limit'],$limit_offset['offset']);
		}else{
			$query = $this->db->get("pengeluaran",$limit_offset['limit'],$limit_offset['offset']);
		}
		return $query->result();
	}
	public function count_total_pengeluaran_filter($filter = array()){
		if(!empty($filter)){
			$query = $this->db->get_where("pengeluaran",$filter);
		}else{
			$query = $this->db->get("pengeluaran");
		}
		return $query->num_rows();
	}
}