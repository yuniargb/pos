<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_opname_model extends CI_Model {
	function __construct(){
        parent::__construct();
	}
	
	public function get_all($limit_offset = array()){
		if(!empty($limit_offset)){
			$limit = $limit_offset['limit'];
			$offset = $limit_offset['offset'];
			$sql = "SELECT a.id, a.tanggal, a.stock_fisik, a.selisih_stock, a.keterangan, b.product_name,
			b.product_desc, b.product_qty, c.category_name FROM stock_opname a
				Inner JOIN product b ON a.product_id = b.id
				Inner JOIN category c ON b.category_id = c.id LIMIT $limit OFFSET $offset ";
		} else {
			$sql = "SELECT a.id, a.tanggal, a.stock_fisik, a.selisih_stock, a.keterangan, b.product_name,
			b.product_desc, b.product_qty, c.category_name FROM stock_opname a
				Inner JOIN product b ON a.product_id = b.id
				Inner JOIN category c ON b.category_id = c.id";
			
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function count_total(){
		$query = $this->db->get("stock_opname");
		return $query->num_rows();
	}
	public function get_all_array($filter = false){
		if($filter){
			$query = $this->db->get_where("stock_opname",$filter);
		}else{
			$query = $this->db->get("stock_opname");
		}
		return $query->result_array();
	}
	public function get_last_id(){
		$this->db->order_by('id', 'DESC');

		$query = $this->db->get("stock_opname",1,0);
		return $query->result();
	}
	public function insert($id){

		$txtProductID = $this->input->post('txtProductID',TRUE);
		$txtTanggal = $this->input->post('txtTanggal',TRUE);
		$txtStockFisik = $this->input->post('txtStockFisik',TRUE);
		$txtSelisih = $this->input->post('txtSelisih',TRUE);
		$category_desc = $this->input->post('category_desc',TRUE);

		$data = array(
			'product_id' => htmlspecialchars($txtProductID),
			'tanggal' => htmlspecialchars($txtTanggal),
			'stock_fisik' => htmlspecialchars($txtStockFisik),
			'selisih_stock' => htmlspecialchars($txtSelisih),
			'keterangan' => htmlspecialchars($category_desc),
		);

    	if($id)
    	{
    		$where = array(
				'id' => $id
			);

			$this->db->where($where);
			$this->db->update('stock_opname',$data);

    	} else {
    		$this->db->insert('stock_opname', $data);
    	}

    	// update stock
    	$product = array(
			'product_qty' => htmlspecialchars($txtStockFisik),
		);

    	$where = array(
    		'id' => $txtProductID
    	);

    	$this->db->where($where);
    	$this->db->update('product',$product);
	}
	public function update($id,$data){
		$this->db->where('id', $id);
		$this->db->update('stock_opname', $data);
	}
	public function get_by_id($id){
		$sql = "SELECT a.id, a.product_id, a.tanggal, a.stock_fisik, a.selisih_stock, a.keterangan, b.product_name, b.product_desc, b.product_qty, c.category_name FROM stock_opname a
				Inner JOIN product b ON a.product_id = b.id
				Inner JOIN category c ON b.category_id = c.id where a.id='".$id."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function delete($id){
		$this->db->delete('stock_opname', array('id' => $id));
	}
	public function get_filter($filter = '',$limit_offset = array()){
		if(!empty($filter)){
			$query = $this->db->get_where("stock_opname",$filter,$limit_offset['limit'],$limit_offset['offset']);
		}else{
			$query = $this->db->get("stock_opname",$limit_offset['limit'],$limit_offset['offset']);
		}
		return $query->result();
	}
	public function count_total_filter($filter = array()){
		if(!empty($filter)){
			$query = $this->db->get_where("stock_opname",$filter);
		}else{
			$query = $this->db->get("stock_opname");
		}
		return $query->num_rows();
	}

	public function get_product()
	{
		$sql = "SELECT b.id, b.product_name, b.product_desc, b.product_qty, c.category_name FROM product b
				Inner JOIN category c ON b.category_id = c.id";
		$query = $this->db->query($sql);
		return $query->result();
	}
}