<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class master_biaya extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('masterbiaya_model');
        $this->load->library('form_validation');
        $this->load->model('user_model');

        // Check Session Login
        if(!isset($_SESSION['logged_in'])){
            redirect(site_url('auth/login'));
        }

        $Access_page = $this->user_model->get_status_access($this->session->userdata('id'), 'Master Biaya');
        if($Access_page[0]['status_access'] == "0")
        {
            redirect('home');
        }
    }

    public function index(){
        if(isset($_GET['search'])){
            $filter = "";
            if(!empty($_GET['value']) && $_GET['value'] != ''){
                $filter = " username like "."'%".$_GET['value']."%'";
            }

            $total_row = $this->masterbiaya_model->count_total_filter($filter);

            $result = $this->masterbiaya_model->get_filter($filter,url_param());
            $data['users_list'] = $result;
        }else{
            $total_row = $this->masterbiaya_model->count_total();
            
            $result = $this->masterbiaya_model->get_all(url_param());
            $data['users_list'] = $result;
        }
        $data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));
        $data['paggination'] = get_paggination($total_row,get_search());

        $this->load->view('biaya/index',$data);
    }

    public function create(){
        $data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));
        $this->load->view('biaya/form', $data);
    }

    public function check_id(){
        $id = $this->input->post('id');
        $check_id = $this->masterbiaya_model->get_by_id($id);
        if(!$check_id){
            echo "available";
        }else{
            echo "unavailable";
        }
    }

    public function edit_akun($id = ''){
        $data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));
        $check_id = $this->masterbiaya_model->get_by_id($id);
        if($check_id){
            $data['user'] = $check_id[0];
            $this->load->view('biaya/form',$data);
        }else{
            redirect(site_url('biaya', $data));
        }
    }

    public function save_akun($id = ''){
        // INSERT NEW
        if(!$id){
            $save = $this->masterbiaya_model->insert();
        } else {
            $check_id = $this->masterbiaya_model->get_by_id($id);
            $save = $this->masterbiaya_model->insert($id, $check_id);
        }
        redirect(site_url('master_biaya'));
    }

    public function delete_akun($id){
        $check_id = $this->masterbiaya_model->get_by_id($id);
        if($check_id){
            $this->masterbiaya_model->delete($id, $check_id);
        }
        redirect(site_url('master_biaya'));
    }
    public function export_csv(){
        $filter = false;
        if(isset($_GET['search'])) {
            if (!empty($_GET['value']) && $_GET['value'] != '') {
                $filter[$_GET['search_by'] . ' LIKE'] = "%" . $_GET['value'] . "%";
            }
        }
        $data = $this->masterbiaya_model->get_all_array($filter);
        $this->csv_library->export('Master_biaya.csv',$data);
    }

    public function pengeluaran(){
        if(isset($_GET['search'])){
            $filter = "";
            if(!empty($_GET['value']) && $_GET['value'] != ''){
                $filter = " username like "."'%".$_GET['value']."%'";
            }

            $total_row = $this->masterbiaya_model->count_total_pengeluaran_filter($filter);

            $result = $this->masterbiaya_model->get_pengeluaran_filter($filter,url_param());
            $data['users_list'] = $result;
        }else{
            $total_row = $this->masterbiaya_model->count_total_pengeluaran();
            
            $result = $this->masterbiaya_model->get_all_pengeluaran(url_param());
            $data['users_list'] = $result;
        }
        $data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));
        $data['paggination'] = get_paggination($total_row,get_search());

        $this->load->view('biaya/pengeluaran',$data);
    }

    public function create_pengeluaran(){
        $data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));
        $data['akun_biaya'] = $this->masterbiaya_model->get_all();
        $this->load->view('biaya/create_pengeluaran', $data);
    }

    public function save_pengeluaran($id = ''){
        // INSERT NEW
        if(!$id){
            $save = $this->masterbiaya_model->insert_pengeluaran();
        } else {
            $save = $this->masterbiaya_model->insert_pengeluaran($id);
        }
        redirect(site_url('master_biaya/pengeluaran'));
    }
}
