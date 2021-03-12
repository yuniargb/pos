<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_model extends CI_Model {
	private $table;
	private $select_default;
	function __construct(){
        parent::__construct();
		$this->table = "sales_transaction";
		$this->select_default = 'sales_transaction.id AS id, customer_name, customer_phone, total_price, total_item,sales_transaction.date AS date,sales_transaction.pay_deadline_date,sales_transaction.is_cash';
	}
	
	public function get_all($limit_offset = array()){
		$this->db->select($this->select_default);
		$this->db->join('customer', 'customer.id = sales_transaction.customer_id', 'left');
		$this->db->order_by("date", "desc");
		if(!empty($limit_offset)){
			$query = $this->db->get($this->table,$limit_offset['limit'],$limit_offset['offset']);
		}else{
			$query = $this->db->get($this->table);
		}
		return $query->result();
	}
	public function count_total(){
		$query = $this->db->order_by("date", "desc")->get($this->table);
		return $query->num_rows();
	}
	public function get_all_array($filter = false){
		if($filter){
			$query = $this->db->order_by("date", "desc")->get_where($this->table,$filter);
		}else{
			$query = $this->db->order_by("date", "desc")->get($this->table);
		}
		return $query->result_array();
	}
	public function get_last_id(){
		$this->db->order_by('id', 'DESC');

		$query = $this->db->get($this->table,1,0);
		return $query->result();
	}
	public function insert($data){
		$this->db->insert($this->table, $data);
	}
	public function update($id,$data,$where){
		$this->db->where($where);
		$this->db->update($this->table, $data);
	}
	public function update_po($data,$where){
		$this->db->where($where);
		$this->db->update('purchase_transaction', $data);
	}
	public function update_qty($id,$qty,$item){
		$this->db->query('update sales_data set quantity = quantity + '.$qty.' where sales_id="'.$id.'" and product_id = '. $item);
	}
	public function get_by_id($id){
		$response = false;
		$query = $this->db->get_where($this->table,array('id' => $id));
		if($query && $query->num_rows()){
			$response = $query->result_array();
		}
		return $response;
	}
	public function delete($id){
		$this->db->delete($this->table, array('id' => $id));
	}

	public function update_status_product($id)
	{
		$save = array(
			'status_product' => 1,
		);

		$where = array(
			'id' => $id
		);

		$this->db->where($where);
		$this->db->update('sales_transaction',$save);
	}
	public function get_detail($id){
		$sql = "SELECT *, sales_transaction.id AS id, product.id as product_id, sales_transaction.date as date 
				FROM sales_transaction 
				JOIN sales_data ON sales_transaction.id = sales_data.sales_id 
				JOIN product ON product.id = sales_data.product_id 
				JOIN customer ON customer.id = sales_transaction.customer_id 
				JOIN category ON category.id = sales_data.category_id 
				WHERE sales_data.sales_id = '".$id."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function get_detail_tunggakan($id){
		$sql = "SELECT sales_transaction.id AS id, 
		 		product.id as product_id, 
		 		product.product_name, 
		 		category.category_name, 
		 		sales_data.quantity, 
		 		sales_data.price_item, 
		 		sales_data.subtotal, 
		 		customer.customer_name, 
				 sales_transaction.total_item,
				 sales_transaction.total_price,
				 sales_transaction.is_cash,
				 sales_transaction.pay_deadline_date,
				 sales_transaction.date as date
				FROM sales_transaction 
				JOIN sales_data ON sales_transaction.id = sales_data.sales_id 
				JOIN product ON product.id = sales_data.product_id 
				JOIN customer ON customer.id = sales_transaction.customer_id 
				JOIN category ON category.id = sales_data.category_id 
				WHERE sales_data.sales_id = '".$id."'
				UNION
				SELECT purchase_transaction.id AS id, 
		 		product.id as product_id, 
		 		product.product_name, 
		 		category.category_name, 
		 		purchase_data.quantity, 
		 		purchase_data.price_item, 
		 		purchase_data.subtotal, 
		 		supplier.supplier_name, 
				 purchase_transaction.total_item,
				 purchase_transaction.total_price,
				 purchase_transaction.is_cash,
				 purchase_transaction.pay_deadline_date,
				 purchase_transaction.date as date
				FROM purchase_transaction 
				JOIN purchase_data ON purchase_transaction.id = purchase_data.transaction_id 
				JOIN product ON product.id = purchase_data.product_id 
				JOIN supplier ON supplier.id = purchase_transaction.supplier_id 
				JOIN category ON category.id = purchase_data.category_id 
				WHERE purchase_data.transaction_id = '".$id."'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_filter_csv($filter = ''){
		$this->db->select('sales_transaction.id AS id, sales_transaction.total_price, sales_transaction.total_item,sales_transaction.date AS date,
					sales_transaction.is_cash, sales_transaction.pay_deadline_date,
					customer.id as customer_id,customer.customer_name,customer.customer_phone,customer.customer_address,
					category.category_name,
					product.id as product_id,product.product_name,product.product_desc,
					sales_data.quantity,sales_data.price_item,sales_data.subtotal');

		$this->db->join('sales_data', 'sales_transaction.id = sales_data.sales_id');
		$this->db->join('customer', 'customer.id = sales_transaction.customer_id');
		$this->db->join('category', 'category.id = sales_data.category_id');
		$this->db->join('product', 'product.id = sales_data.product_id');
		
		$this->db->order_by("sales_transaction.date", "desc");
		
		$filter['type'] = '1';
		$this->db->where($filter);
		
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	public function get_filter($filter = '',$limit_offset = array(),$is_array = false){
		$this->db->select($this->select_default);
		$this->db->join('customer', 'customer.id = sales_transaction.customer_id', 'left');
		$this->db->order_by("date", "desc");
		if(!empty($filter)){
			$this->db->where($filter);
			if($limit_offset){
				$this->db->limit($limit_offset['limit'],$limit_offset['offset']);
			}
			$query = $this->db->get($this->table);
		}else{
			$query = $this->db->get($this->table,$limit_offset['limit'],$limit_offset['offset']);
		}
		if($is_array){
			return $query->result_array();
		}else{
			return $query->result();
		}
	}

	public function count_total_filter($filter = array()){
		if(!empty($filter)){
			$query = $this->db->get_where($this->table,$filter);
		}else{
			$query = $this->db->get($this->table);
		}
		return $query->num_rows();
	}
	public function insert_purchase_data($data){
		$this->db->insert('sales_data', $data);
	}
	// 
	public function delete_purchase_data_trx($transaction_id){
		$this->db->delete('sales_data', array('sales_id' => $transaction_id));
	}

	/*
	 * Tunggakan Disini
	 */
	public function count_total_filter_tunggakan($filter = []){
		$filter['is_cash'] = 0;
		$query = $this->db->order_by("date", "desc")->get_where($this->table,$filter);
		return $query->num_rows();
	}
	public function get_filter_tunggakan($filter = '',$limit_offset = array(),$is_array = false){
		$filter['is_cash'] = 0;
		$filter['is_credit'] = 0;
	
		$query1 = $this->db
					->select($this->select_default) 
					->join('customer', 'customer.id = sales_transaction.customer_id', 'left')
					->where($filter)
					->from($this->table)
					// ->order_by($this->table.".date", "desc")
					->get_compiled_select(); 

		$this->db->select('purchase_transaction.id AS id, supplier_name, supplier_phone, total_price, total_item,purchase_transaction.date AS date,purchase_transaction.pay_deadline_date,purchase_transaction.is_cash');
		$this->db->join('supplier', 'supplier.id = purchase_transaction.supplier_id', 'left');
		$this->db->where($filter);
		$this->db->from('purchase_transaction');
		$query2 = $this->db->get_compiled_select(); 

		$query = $this->db->query($query1. " UNION " .$query2);
		if($is_array){
			$resopnse = $query->result_array();
		}else{
			$resopnse = $query->result();
		}
		return $resopnse;
	}
}