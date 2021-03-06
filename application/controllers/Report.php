<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends MY_Controller {
	function __construct(){
        parent::__construct();
		$this->load->model('auth_model');
        $this->load->library('form_validation');
		$this->load->model('penjualan_model');
		$this->load->model('Report_model');
		$this->load->model('user_model');
		$this->load->model('pelanggan_model');
		$this->load->model('kategori_model');
		$this->load->model('produk_model');
		// Check Session Login
		if(!isset($_SESSION['logged_in'])){
			redirect(site_url('auth/login'));
		}

		$Access_page = $this->user_model->get_status_access($this->session->userdata('id'), 'Laporan');
        if($this->session->userdata('username') != 'admin')
        {
            if($Access_page[0]['status_access'] == "0")
            {
                redirect('home');
            }
        }
	}
	public function stok(){
		if(isset($_GET['search'])){
			$filter = [];
			if(!empty($_GET['date_from']) && $_GET['date_from'] != ''){
				$filter['from'] = $_GET['date_from'];
			}

			if(!empty($_GET['date_end']) && $_GET['date_end'] != ''){
				$filter['to'] = $_GET['date_end'];
			}
			if(!empty($_GET['item']) && $_GET['item'] != ''){
				$filter['item'] = $_GET['item'];
			}

			$data['from'] = $filter['from'];
			$data['to'] = $filter['to'];
			$data['items'] = $filter['item'];
			$data['stok'] = $this->Report_model->get_detail_stok($filter,url_param());
			// var_dump($data['stok']);
			// $total_row = count($data['stok']);
			// $data['paggination'] = get_paggination($total_row,get_search());
		}
		$data['produk'] = $this->produk_model->get_all();
		$data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));
		$data['title'] = 'Laporan Stok'; 
		$this->load->view('laporan/stok',$data);
	}
	public function penjualan(){
		if(isset($_GET['search'])){
			$filter = [];
			if(!empty($_GET['date_from']) && $_GET['date_from'] != ''){
				$filter['from'] = $_GET['date_from'];
			}

			if(!empty($_GET['date_end']) && $_GET['date_end'] != ''){
				$filter['to'] = $_GET['date_end'];
			}

			if(!empty($_GET['item']) && $_GET['item'] != ''){
				$filter['item'] = $_GET['item'];
				$data['items'] = $filter['item'];
			}

			$data['from'] = $filter['from'];
			$data['to'] = $filter['to'];
			
			
			$data['penjualans'] = $this->Report_model->get_detail_penjualan($filter,url_param());
			$total_row = count($data['penjualans']);
			$data['paggination'] = get_paggination($total_row,get_search());
		}
		$data['produk'] = $this->produk_model->get_all();
		$data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));
		$data['title'] = 'Laporan Detail Penjualan'; 
		$this->load->view('laporan/penjualan',$data);
	}

	public function pendapatan(){
		if(isset($_GET['search'])){
			$filter = [];
			if(!empty($_GET['date_from']) && $_GET['date_from'] != ''){
				$filter['from'] = $_GET['date_from'];
			}

			if(!empty($_GET['date_end']) && $_GET['date_end'] != ''){
				$filter['to'] = $_GET['date_end'];
			}

			$data['from'] = $filter['from'];
			$data['to'] = $filter['to'];
			$data['penjualans'] = $this->Report_model->get_detail_penjualan_pendapatan($filter,url_param());
			$total_row = count($data['penjualans']);
			$data['paggination'] = get_paggination($total_row,get_search());

			// $count = 0;
			// if($total_row > 0){
			// 	for($i=0; $i < count($data['penjualans']); $i++){
			// 		$count = $count + $data['penjualans'][$i]->subtotal;
			// 	}
			// }

			// $data['jumlah_pendapatan'] = $count;
		}

		$data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));
		$data['title'] = 'Laporan Pendapatan'; 
		$this->load->view('laporan/pendapatan',$data);
	}

	public function pengeluaran(){
		if(isset($_GET['search'])){
			$filter = [];
			if(!empty($_GET['date_from']) && $_GET['date_from'] != ''){
				$filter['from'] = $_GET['date_from'];
			}

			if(!empty($_GET['date_end']) && $_GET['date_end'] != ''){
				$filter['to'] = $_GET['date_end'];
			}

			$data['from'] = $filter['from'];
			$data['to'] = $filter['to'];
			$data['pengeluarans'] = $this->Report_model->get_detail_pengeluaran($filter,url_param());
			$total_row = count($data['pengeluarans']);
			$data['paggination'] = get_paggination($total_row,get_search());
		}

		$data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));
		$data['title'] = 'Laporan pengeluaran'; 
		$this->load->view('laporan/pengeluaran',$data);
	}

	public function laba_rugi()
	{
		if(isset($_GET['search'])){
			$filter = [];
			if(!empty($_GET['txtBulan_from']) && $_GET['txtBulan_from'] != ''){
				$filter['txtBulan_from'] = $_GET['txtBulan_from'];
			}

			if(!empty($_GET['txtTahun_from']) && $_GET['txtTahun_from'] != ''){
				$filter['txtTahun_from'] = $_GET['txtTahun_from'];
			}

			if(!empty($_GET['txtBulan_to']) && $_GET['txtBulan_to'] != ''){
				$filter['txtBulan_to'] = $_GET['txtBulan_to'];
			}
			
			if(!empty($_GET['txtTahun_to']) && $_GET['txtTahun_to'] != ''){
				$filter['txtTahun_to'] = $_GET['txtTahun_to'];
			}

			if($filter['txtBulan_from'] != '' && $filter['txtTahun_from'] != '' && $filter['txtBulan_to'] != '' && $filter['txtTahun_to'] != '') {
				$data['Bulan_from'] = $filter['txtBulan_from'];
				$data['Tahun_from'] = $filter['txtTahun_from'];
				$data['Bulan_to'] = $filter['txtBulan_to'];
				$data['Tahun_to'] = $filter['txtTahun_to'];

				$data['search'] =true;
				$data['labas'] = $this->Report_model->get_detail_laba_rugi(null, $filter);
				$total_row = count($data['labas']);
				$data['paggination'] = get_paggination($total_row,get_search());
			} else {
				redirect(site_url('report/laba_rugi'));
			}
		} else {
			$data['search'] =false;
			$data['labas'] = $this->Report_model->get_detail_laba_rugi();
			$total_row = count($data['labas']);
			$data['paggination'] = get_paggination($total_row,get_search());
		}

		$data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));
		$data['title'] = 'Laporan Laba Rugi'; 
		$this->load->view('laporan/laba_rugi',$data);
	}

	public function proyeksi_laba_rugi()
	{
		$this->cart->destroy();
		$data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));
		$data['title'] = 'Proyeksi Laba Rugi';
		$data['title2'] = 'Laporan Laba Rugi'; 
		$this->load->view('laporan/laba_rugi/form',$data);
	}

	public function edit_proyeksi($id)
	{
		$this->cart->destroy();
		$data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));
		$data['labas'] = $this->Report_model->get_detail_laba_rugi($id);
		$month = $data['labas'][0]->month;
		$year = $data['labas'][0]->year;
		$data['detail_biaya'] = $this->Report_model->get_biaya($month, $year);
		$data['title'] = 'Proyeksi Laba Rugi';
		$data['title2'] = 'Laporan Laba Rugi'; 
		$this->load->view('laporan/laba_rugi/edit',$data);
	}

	public function get_proyeksi()
	{
		$bulan = $_POST['bulan'];
		$tahun = $_POST['tahun'];

		if($bulan < 10){
			$bulan = '0'.$bulan;
		}

		//cek data 
		$check_data = $this->Report_model->check_data_proyeksi($bulan, $tahun);
		if(count($check_data) > 0) {
			$data = array(
				'info' => 1,
			);
		} else {
			// get pendapatan
			$pendapatan = $this->Report_model->get_pendapatan($bulan, $tahun,url_param());
			$biaya = $this->Report_model->get_biaya($bulan, $tahun,url_param());

			// count pendapatan
			$count_pendapatan=0;
			if(count($pendapatan) > 0){
				for($i=0; $i < count($pendapatan); $i++){
					$count_pendapatan = $count_pendapatan + $pendapatan[$i]->subtotal;
				}
			}

			//count biaya
			$count_biaya=0;
			if(count($biaya) > 0){
				for($i=0; $i < count($biaya); $i++){
					$count_biaya = $count_biaya + $biaya[$i]->jumlah;
				}
			}

			$data = array(
				'info' => 0,
				'pendapatan' => $count_pendapatan, 
				'biaya' => $count_biaya,
				'biaya_detail' => $biaya,
			);
		}
		
		echo json_encode($data);
	}

	public function print_stok($from = null, $to=null,$item=null)
	{
		if($from != '' && $to != '' && $item != ''){
			$filter['from'] = $from;
			$filter['to'] = $to;
			$filter['item'] = $item;
			$details = $this->Report_model->get_detail_stok($filter,url_param());
			$total_row = count($details);
			$data['paggination'] = get_paggination($total_row,get_search());

			if($details){
				$data['from'] = $from;
				$data['to'] = $to;
				$data['item'] = $item;
				$data['details'] = $details;
				$this->load->view("laporan/print/print_stok",$data);
			}else{
				redirect(site_url('report/stok'));
			}
		} else{
			redirect(site_url('report/stok'));
		}
	}
	public function print_now($from = null, $to=null)
	{
		if($from != '' && $to != ''){
			$filter['from'] = $from;
			$filter['to'] = $to;
			if(!empty($_GET['item']) && $_GET['item'] != ''){
				$filter['item'] = $_GET['item'];
			}
			$details = $this->Report_model->get_detail_penjualan($filter,url_param());
			$total_row = count($details);
			$data['paggination'] = get_paggination($total_row,get_search());

			if($details){
				$data['from'] = $from;
				$data['to'] = $to;
				$data['details'] = $details;
				$this->load->view("laporan/print/print",$data);
			}else{
				redirect(site_url('report/penjualan'));
			}
		} else{
			redirect(site_url('report/penjualan'));
		}
	}

	public function print_pengeluaran($from = null, $to=null)
	{
		if($from != '' && $to != ''){
			$filter['from'] = $from;
			$filter['to'] = $to;

			$details = $this->Report_model->get_detail_pengeluaran($filter,url_param());
			$total_row = count($details);
			$data['paggination'] = get_paggination($total_row,get_search());

			if($details){
				$data['from'] = $from;
				$data['to'] = $to;
				$data['details'] = $details;
				$this->load->view("laporan/print/print_pengeluaran",$data);
			}else{
				redirect(site_url('report/pengeluaran'));
			}
		} else{
			redirect(site_url('report/pengeluaran'));
		}
	}

	public function print_pendapatan($from = null, $to=null)
	{
		if($from != '' && $to != ''){
			$filter['from'] = $from;
			$filter['to'] = $to;

			$details = $this->Report_model->get_detail_penjualan_pendapatan($filter,url_param());
			$total_row = count($details);
			$data['paggination'] = get_paggination($total_row,get_search());

			

			if($details){
				$data['from'] = $from;
				$data['to'] = $to;
				$data['details'] = $details;
				$this->load->view("laporan/print/print_pendapatan",$data);
			}else{
				redirect(site_url('report/pendapatan'));
			}
		} else{
			redirect(site_url('report/pendapatan'));
		}
	}

	public function save_laba_rugi($id=null)
	{
		if(!$id){
            $save = $this->Report_model->insert_proyeksi();
        } else {
            $save = $this->Report_model->insert_proyeksi($id);
        }
        redirect(site_url('report/laba_rugi'));
	}

	public function print_laporan_laba_rugi($bulan_from = null, $tahun_from=null, $bulan_to = null, $tahun_to=null)
	{
		if($bulan_from != '' && $tahun_from != '' && $bulan_to != '' && $tahun_to != ''){
			$filter['txtBulan_from'] = $bulan_from;
			$filter['txtTahun_from'] = $tahun_from;
			$filter['txtBulan_to'] = $bulan_to;
			$filter['txtTahun_to'] = $tahun_to;

			$data['Bulan_from'] = $bulan_from;
			$data['Tahun_from'] = $tahun_from;
			$data['Bulan_to'] = $bulan_to;
			$data['Tahun_to'] = $tahun_to;

			$data['search'] =true;
			$details = $this->Report_model->get_detail_laba_rugi(null, $filter);
		} else {
			$data['search'] =false;
			$details = $this->Report_model->get_detail_laba_rugi();
		}

		$data['details'] = $details;
		$this->load->view("laporan/print/print_laba_rugi",$data);
	}

	public function delete_proyeksi($id)
	{
		$this->Report_model->delete_proyeksi($id);
        redirect(site_url('report/laba_rugi'));
	}

	// public function export_csv(){

	// 	if(isset($_GET['search'])){
	// 		$filter = [];
	// 		if(!empty($_GET['date_from']) && $_GET['date_from'] != ''){
	// 			$filter['DATE(sales_transaction.date) >='] = $_GET['date_from'];
	// 			$filter['from'] = $_GET['date_from'];
	// 		}

	// 		if(!empty($_GET['date_end']) && $_GET['date_end'] != ''){
	// 			$filter['DATE(sales_transaction.date) <='] = $_GET['date_end'];
	// 			$filter['to'] = $_GET['date_end'];
	// 		}

	// 		$data['penjualans'] = $this->Report_model->get_detail_penjualan($filter,url_param());
	// 		$total_row = count($data['penjualans']);
	// 		$data['paggination'] = get_paggination($total_row,get_search());

	// 		if($result){
	// 			$result = $this->_set_csv_format($result);
	// 		}

	// 		//echo json_encode($result);
	// 		$this->csv_library->export('Laporan Penjualan.csv',$result);
	// 	}
	// }
}
