<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tunggakan extends MY_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('penjualan_model');
        $this->load->model('produk_model');
        $this->load->library('form_validation');
        $this->load->model('user_model');
        $this->load->model('kategori_model');

        // Check Session Login
        if (!isset($_SESSION['logged_in'])) {
            redirect(site_url('auth/login'));
        }
    }

    public function index()
    {
        $filter = [];
        if(!empty($_GET['id']) && $_GET['id'] != ''){
            $filter['sales_transaction.id LIKE'] = "%".$_GET['id']."%";
        }

        if(!empty($_GET['date_range']) && $_GET['date_range'] != ''){
            $date = date('Y-m-d', strtotime("+".$_GET['date_range']." days"));
            $filter['DATE(sales_transaction.pay_deadline_date) <='] = $date;
        }

        if(!empty($_GET['date_trx']) && $_GET['date_trx'] != ''){
            $filter['DATE(sales_transaction.date)'] = $_GET['date_trx'];
        }

        $total_row = $this->penjualan_model->count_total_filter_tunggakan($filter);
        $data['tunggakans'] = $this->penjualan_model->get_filter_tunggakan($filter,url_param());
        //var_dump($this->db); exit;
        $data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));
        $data['paggination'] = get_paggination($total_row,get_search());
        $this->load->view('tunggakan/index',$data);
    }
    public function detail($id){
        $data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));
        $data['details'] = $this->penjualan_model->get_detail_tunggakan($id);
        $this->load->view('tunggakan/detail',$data);
    }
    public function update_lunas($id){
        // $data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));
        $details = $this->penjualan_model->get_detail($id);
        $data['is_credit'] = 1;
        $data['pay_lunas_date'] = date('Y-m-d');
        $where['id'] = $id;
        if($details){
            $this->penjualan_model->update(null,$data,$where);
        }else{
                $this->penjualan_model->update_po($data,$where);
        }

        redirect(site_url('tunggakan'));
    }
    public function export_csv(){
        $filter = false;
        if(!empty($_GET['id']) && $_GET['id'] != ''){
            $filter['sales_transaction.id LIKE'] = "%".$_GET['id']."%";
        }

        if(!empty($_GET['date_range']) && $_GET['date_range'] != ''){
            $date = date('Y-m-d', strtotime("+".$_GET['date_range']." days"));
            $filter['DATE(sales_transaction.pay_deadline_date) <='] = $date;
        }

        if(!empty($_GET['date_trx']) && $_GET['date_trx'] != ''){
            $filter['DATE(sales_transaction.date)'] = $_GET['date_trx'];
        }
        
        $data = $this->penjualan_model->get_filter_tunggakan('',url_param(),true);
        $this->csv_library->export('tunggakan.csv',$data);
    }
}