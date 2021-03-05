<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stok_konsumen extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->model('auth_model');
        $this->load->library('form_validation');
		$this->load->model('stok_konsumen_model');
		$this->load->model('pelanggan_model');
		$this->load->model('kategori_model');
		$this->load->model('produk_model');
		$this->load->model('user_model');
		// Check Session Login
		if(!isset($_SESSION['logged_in'])){
			redirect(site_url('auth/login'));
		}
	}
	
	function index(){
		if(isset($_GET['search'])){
			$filter = [];
			if(!empty($_GET['customer_id']) && $_GET['customer_id'] != ''){
				$filter['customer_id'] = $_GET['customer_id'];
			}
			// $total_row = $this->stok_konsumen_model->count_total_filter($filter);
			$data['penjualans'] = $this->stok_konsumen_model->get_all($filter);
		}else{
			$total_row = $this->stok_konsumen_model->count_total();
			$data['penjualans'] = $this->stok_konsumen_model->get_all();
		}
		$data['customers'] = $this->pelanggan_model->get_all();
		$data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));

		$this->load->view('stokKonsumen/index',$data);
	}
	public function detail($id){
		$data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));
		$filter = [];
		$filter['customer_id'] = $id;
	
		$details = $this->stok_konsumen_model->get_detail($filter);
		if($details){
			$data['details'] = $details;
			$this->load->view('stokKonsumen/detail',$data);
		}else{
			redirect(site_url('stokKonsumen', $data));
		}
	}
	function surat_jalan(){
		if(isset($_GET['search'])){
			$filter = [];
			if(!empty($_GET['date_from']) && $_GET['date_from'] != ''){
				$filter['DATE(surat_jalan.tanggal_kirim) >='] = $_GET['date_from'];
			}

			if(!empty($_GET['date_end']) && $_GET['date_end'] != ''){
				$filter['DATE(surat_jalan.tanggal_kirim) <='] = $_GET['date_end'];
			}
			// $total_row = $this->stok_konsumen_model->count_total_filter($filter);
			$data['penjualans'] = $this->stok_konsumen_model->get_all_sj($filter);
		}else{
			$total_row = $this->stok_konsumen_model->count_total();
			$data['penjualans'] = $this->stok_konsumen_model->get_all_sj();
		}
		$data['customers'] = $this->pelanggan_model->get_all();
		$data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));

		$this->load->view('stokKonsumen/surat_jalan',$data);
	}
	public function surat_jalan_detail($id){
		$data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));
		$filter = [];
		$filter['sj.id'] = $id;
	
		$details = $this->stok_konsumen_model->get_detail_sj($filter);
		if($details){
			$data['details'] = $details;
			$this->load->view('stokKonsumen/surat_jalan_detail',$data);
		}else{
			redirect(site_url('stokKonsumen/surat_jalan', $data));
		}
	}
	function create(){
		// destry cart
		$this->cart->destroy();
		$data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));
		$data['code_penjualan'] = "SJ".strtotime(date("Y-m-d H:i:s"));
		$data['customers'] = $this->pelanggan_model->get_all();
		$data['kategoris'] = $this->kategori_model->get_all();
		$this->load->view('stokKonsumen/form',$data);
	}
	
	

	// public function update_status_product($id)
	// {
	// 	$details = $this->stok_konsumen_model->update_status_product($id);
	// 	redirect(site_url('penjualan/detail/'.$id));
	// }
	// public function updatepesanan($id)
	// {
	// 	$quantity = $this->input->post('jumlah');
	// 	$item = $this->input->post('item_id');
	// 	$data = array(
	// 		'id' => $item,
	// 		'qty' => $quantity
	// 	);
	// 	if($this->_check_qty_db($data)){
	// 		redirect(site_url('penjualan/detail/'.$id));
	// 		exit;
	// 	}
		
	// 	$details = $this->stok_konsumen_model->update_qty($id,$quantity,$item);
	// 	$kurang = $this->produk_model->update_qty_min($item,array('product_qty' => $quantity));
	// 	redirect(site_url('penjualan/detail/'.$id));
	// }

	// private function _check_qty_db($carts){
		
	// 	$status = false;
	// 	$product = $this->produk_model->get_by_id($carts['id']);
	// 	if($carts['qty'] > $product[0]['product_qty']){
	// 		$status = true;
	// 	}
	// 	return $status;
	// }
	// public function edit($id){
	// 	// destry cart
	// 	$this->cart->destroy();
	// 	$data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));
	// 	$data['suppliers'] = $this->supplier_model->get_all();
	// 	$data['kategoris'] = $this->kategori_model->get_all();

	// 	$transaksi = $this->stok_konsumen_model->get_detail($id);
	// 	if($transaksi){
	// 		//print_r($transaksi); exit;
	// 		$data['carts'] = $this->_process_cart($transaksi);
	// 		$data['pembelian'] = $transaksi;
	// 		$this->load->view('penjualan/form',$data);
	// 	}else{
	// 		redirect(site_url('penjualan', $data));
	// 	}
	// }

	private function _process_cart($transaksi = ''){
		if($transaksi & is_array($transaksi)){
			foreach($transaksi as $key => $item){
				$data = array(
					'id'      => $item->product_id,
					'qty'     => $item->quantity,
					'price'   => $item->price_item,
					'category_id' => $item->category_id,
					'category_name' => $item->category_name,
					'name'    => $item->product_name
				);
				$this->cart->insert($data);
			}
		}
		$response = array(
				'data' => $this->cart->contents() ,
				'total_item' => $this->cart->total_items(),
				'total_price' => $this->cart->total()
			);
		return $response;
	}

	public function check_id(){
		$id = $this->input->post('id');
		$check_id = $this->stok_konsumen_model->get_by_id($id);
		if(!$check_id){
			echo "available";
		}else{
			echo "unavailable";
		}
	}
	
	public function check_category_id($category_id){
		$products = $this->produk_model->get_by_category($category_id);
		echo json_encode($products);
	}
	public function check_product_id($product_id,$customer_id){
		$products = $this->stok_konsumen_model->produk_get_by_id($product_id,$customer_id);
		echo json_encode($products);
	}
	public function add_item(){
		$product_id = $this->input->post('product_id');
		$quantity = $this->input->post('quantity');
		$jumlah = $this->input->post('jumlah');
		$sale_price = 1;

		$get_product_detail =  $this->produk_model->detail_by_id($product_id);
		if($get_product_detail){
			$data = array(
				'id'      => $product_id,
				'qty'     => $jumlah,
				'jumlah'     => $quantity,
				'price'   => $sale_price,
				'category_id' => $get_product_detail[0]['category_id'],
				'category_name' => $get_product_detail[0]['category_name'],
				'name'    => $get_product_detail[0]['product_name']
			);
			$this->cart->insert($data);
			echo json_encode(array('status' => 'ok',
							'data' => $this->cart->contents() ,
							'total_item' => $this->cart->total_items(),
							'total_price' => $this->cart->total()
						)
				);
		}else{
			echo json_encode(array('status' => 'error'));
		}

	}
	public function delete_item($rowid){
		if($this->cart->remove($rowid)) {
			echo number_format($this->cart->total());
		}else{
			echo "false";
		}
	}
	public function add_process(){
		$this->form_validation->set_rules('pengiriman_id', 'pengiriman_id', 'required');
		$this->form_validation->set_rules('customer_id', 'customer_id', 'required');
		$this->form_validation->set_rules('tanggal_kirim', 'tanggal_kirim', 'required');
		$this->form_validation->set_rules('plat', 'plat', 'required');

		$carts =  $this->cart->contents();
		
		// if($this->_check_qty($carts)){
		// 	echo json_encode(array('status' => 'limit'));
		// 	exit;
		// }
		
		if($this->form_validation->run() != FALSE && !empty($carts) && is_array($carts)){
			$data['id'] = escape($this->input->post('pengiriman_id'));
			$data['customer_id'] = escape($this->input->post('customer_id'));
			$data['tanggal_kirim'] = escape($this->input->post('tanggal_kirim'));
			$data['no_plot_truk'] = escape($this->input->post('plat'));

			$this->stok_konsumen_model->insert($data);
			if($data['id']){
				$this->_insert_stok_data($data['id'],$carts);
			}
			echo json_encode(array('status' => 'ok'));
		}else{
			echo json_encode(array('status' => 'error'));
		}
	}
	
	private function _check_qty($carts){
		$status = false;
		foreach($carts as $key => $cart){
			$product = $this->produk_model->get_by_id($cart['id']);
			if($cart['qty'] > $product[0]['product_qty']){
				$status = true;
				break;
			}
		}
		return $status;
	}
	private function _insert_stok_data($id,$carts){
		foreach($carts as $key => $cart){
			$d = array(
				'surat_jalan_id' => $id,
				'product_id' => $cart['id'],
				'qty' => $cart['qty']
			);
			$this->stok_konsumen_model->insert_detail($d);
		}
		$this->cart->destroy();
	}
	public function delete($transaction_id){

		$this->stok_konsumen_model->delete($transaction_id);
		$this->stok_konsumen_model->delete_sjd_data($transaction_id);
		redirect(site_url('stok_konsumen/surat_jalan'));
	}
	public function export_csv(){
		$filter = [];
		if(isset($_GET['search'])){
			if(!empty($_GET['customer_id']) && $_GET['customer_id'] != ''){
				$filter['customer_id'] = $_GET['customer_id'];
			}
		}
		$result =  $this->stok_konsumen_model->get_all($filter);
		if($result){
			$result = $this->_set_csv_format($result);
		}
		//echo json_encode($result);
		$this->csv_library->export('stok_konsumen.csv',$result);
	}
	public function print_now($id = ""){
		$details = $this->stok_konsumen_model->get_detail($id);
		if($details){
			$data['details'] = $details;
			$this->load->view("penjualan/print",$data);
		}else{
			redirect(site_url('penjualan'));
		}
	}

	public function cetak_surat_jalan($id="")
	{
		$filter = [];
		$filter['sj.id'] = $id;
		$details = $this->stok_konsumen_model->get_detail_sj($filter);
		if($details){
			$data['details'] = $details;
			$this->load->view("stokKonsumen/print_surat_jalan",$data);
		}else{
			redirect(site_url('stok_konsumen/surat_jalan'));
		}
	}
	
	private function _set_csv_format($datas){
		$result = false;
		if(is_array($datas)){
			$data_before = "";
			foreach($datas as $k => $data){
				$datas[$k]['customer_name'] = "";
				$datas[$k]['total_item'] = "";
				$datas[$k]['total_kirim'] = "";
				$datas[$k]['total_price'] = "";
			}
			$result = $datas;
		}
		return $result;
	}
}
