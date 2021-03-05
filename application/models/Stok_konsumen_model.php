<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_konsumen_model extends CI_Model {
	private $table;
	private $table2;
	private $table3;
	private $select_default;
	function __construct(){
        parent::__construct();
		$this->table = "sales_transaction as st";
		$this->table2 = "surat_jalan";
		$this->table3 = "surat_jalan_detail";
		$this->select_default = 'st.id AS id, customer_name, customer_phone, total_price, total_item,st.date AS date,st.pay_deadline_date,st.is_cash';
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
		$this->db->insert($this->table2, $data);
	}
	public function insert_detail($data){
		$this->db->insert($this->table3, $data);
	}
	public function update($id,$data,$where){
		$this->db->where($where);
		$this->db->update($this->table, $data);
	}
	public function update_qty($id,$qty,$item){
		$this->db->query('update sales_data set quantity = quantity + '.$qty.', reserv = reserv - '.$qty.' where sales_id="'.$id.'" and product_id = '. $item);
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
		$this->db->delete($this->table2, array('id' => $id));
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
	

	public function get_filter_csv($filter = ''){
		$this->db->select('st.id AS id, st.total_price, st.total_item,st.date AS date,
					st.is_cash, st.pay_deadline_date,
					customer.id as customer_id,customer.customer_name,customer.customer_phone,customer.customer_address,
					category.category_name,
					product.id as product_id,product.product_name,product.product_desc,
					sales_data.quantity,sales_data.price_item,sales_data.subtotal');

		$this->db->join('sales_data', 'st.id = sales_data.sales_id');
		$this->db->join('customer', 'customer.id = st.customer_id');
		$this->db->join('category', 'category.id = sales_data.category_id');
		$this->db->join('product', 'product.id = sales_data.product_id');
		
		$this->db->order_by("st.date", "desc");
		
		$filter['type'] = '1';
		$this->db->where($filter);
		
		$query = $this->db->get($this->table);
		return $query->result_array();
	}

	public function get_filter($filter = '',$limit_offset = array(),$is_array = false){
		$this->db->select($this->select_default);
		$this->db->join('customer', 'customer.id = st.customer_id', 'left');
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
	public function delete_sjd_data($transaction_id){
		$this->db->delete('surat_jalan_detail', array('surat_jalan_id' => $transaction_id));
	}

	/*
	 * Tunggakan Disini
	 */
	public function count_total_filter_tunggakan($filter = array()){
		$filter['is_cash'] = 0;
		$query = $this->db->order_by("date", "desc")->get_where($this->table,$filter);
		return $query->num_rows();
	}
	public function get_filter_tunggakan($filter = '',$limit_offset = array(),$is_array = false){
		$filter['is_cash'] = 0;
		$this->db->select($this->select_default);
		$this->db->join('customer', 'customer.id = st.customer_id', 'left');
		$this->db->where($filter);
		if($limit_offset){
			$this->db->limit($limit_offset['limit'],$limit_offset['offset']);
		}
		$query = $this->db->order_by($this->table.".date", "desc")->get($this->table);

		if($is_array){
			$resopnse = $query->result_array();
		}else{
			$resopnse = $query->result();
		}
		return $resopnse;
    }
    
    public function produk_get_by_id($id,$customer){
		$response = false;
        $this->db->select('p.id,p.product_name,(NVL(SUM(sd.quantity),0) - NVL(SUM(sjd.qty),0)) qtyData');
		$this->db->join('sales_data sd', 'st.id = sd.sales_id', 'left');
		$this->db->join('surat_jalan sj', 'st.customer_id = sj.customer_id', 'left');
		$this->db->join('surat_jalan_detail sjd', 'sj.id = sjd.surat_jalan_id', 'left');
		$this->db->join('product p', 'sd.product_id = p.id', 'left');
        $this->db->group_by('st.customer_id','sd.product_id');
		// $this->db->join('sales_data sd', 'p.id = sd.product_id', 'left');
		$query = $this->db->get_where($this->table,array('sd.product_id' => $id, 'st.customer_id' => $customer));
		if($query && $query->num_rows()){
			$response = $query->result_array();
		}
		return $response;
    }
    public function get_all($customer = null){
		$this->db->select('c.id AS id, customer_name, customer_phone, SUM(total_price) total_price, SUM(total_item) total_item,NVL((
            SELECT SUM(sjd.qty)
            FROM `surat_jalan` `sj`
            INNER JOIN `surat_jalan_detail` `sjd` ON `sj`.`id` = `sjd`.`surat_jalan_id`
            WHERE `sj`.`customer_id` = `c`.`id`

        ),0) total_kirim,st.date AS date, p.product_name');
		$this->db->join('customer c', 'c.id = st.customer_id', 'left');
		$this->db->join('sales_data sd', 'st.id = sd.sales_id', 'left');
		$this->db->join('product p', 'sd.product_id = p.id', 'left');
        $this->db->order_by("date", "desc");
        $this->db->group_by('c.id');
		if(!empty($customer)){
			$query = $this->db->get_where($this->table,$customer);
		}else{
			$query = $this->db->get($this->table);
		}
		return $query->result();
	}

	public function get_detail($where){
		$this->db->select('c.id AS id, customer_name, customer_phone, SUM(total_price) total_price, SUM(total_item) total_item,NVL((
            SELECT SUM(sjd.qty)
            FROM `surat_jalan` `sj`
            INNER JOIN `surat_jalan_detail` `sjd` ON `sj`.`id` = `sjd`.`surat_jalan_id`
            WHERE `sj`.`customer_id` = `c`.`id` AND  `sjd`.`product_id` = `p`.`id`

        ),0) total_kirim,st.date AS date, p.product_name');
		$this->db->join('customer c', 'c.id = st.customer_id', 'left');
		$this->db->join('sales_data sd', 'st.id = sd.sales_id', 'left');
		$this->db->join('product p', 'sd.product_id = p.id', 'left');
        $this->db->order_by("date", "desc");
        $this->db->group_by('c.id,p.id');
		$query = $this->db->get_where($this->table,$where);;
		return $query->result();
	}

	public function get_all_sj($filter = null){
		$this->db->select('surat_jalan.*,c.customer_name');
		$this->db->join('customer c', 'c.id = surat_jalan.customer_id');
		if(!empty($filter)){
			$query = $this->db->get_where("surat_jalan",$filter);
		}else{
			$query = $this->db->get("surat_jalan");
		}
		return $query->result();
	}
	public function get_detail_sj($where = null){
		$this->db->select('sj.*,p.product_name,sjd.qty,c.customer_name,c.customer_address,c.customer_phone');
		$this->db->join('surat_jalan_detail sjd', 'sj.id = sjd.surat_jalan_id');
		$this->db->join('customer c', 'c.id = sj.customer_id');
		$this->db->join('product p', 'p.id = sjd.product_id');
		if(!empty($where)){
			$query = $this->db->get_where("surat_jalan sj",$where);
		}else{
			$query = $this->db->get("surat_jalan sj");
		}
		return $query->result();
	}
}