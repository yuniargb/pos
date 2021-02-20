<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_opname extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('Stock_opname_model');
        $this->load->library('form_validation');
        $this->load->model('user_model');
        // Check Session Login
        if(!isset($_SESSION['logged_in'])){
            redirect(site_url('auth/login'));
        }
    }

    public function index(){
        if(isset($_GET['search'])){
            $filter = array();
            if(!empty($_GET['value']) && $_GET['value'] != ''){
                $filter[$_GET['search_by'].' LIKE'] = "%".$_GET['value']."%";
            }
            
            $result = $this->Stock_opname_model->get_filter($filter,url_param());

            $data['kategoris'] = $result;
        }else{
            $result = $this->Stock_opname_model->get_all(url_param());
            $data['kategoris'] = $result;
        }
        $total_row = count($result);
        $data['paggination'] = get_paggination($total_row,get_search());
        $data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));

        $this->load->view('opname/index',$data);
    }

    public function create(){
        $data['products'] = $this->Stock_opname_model->get_product();
        $data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));
        $this->load->view('opname/form', $data);
    }

    public function check_id(){
        $id = $this->input->post('id');
        $check_id = $this->Stock_opname_model->get_by_id($id);
        if(!$check_id){
            echo "available";
        }else{
            echo "unavailable";
        }
    }

    public function edit($id = ''){
        $data['products'] = $this->Stock_opname_model->get_product();
        $data['users'] = $this->user_model->get_by_id($this->session->userdata('id'));
        $check_id = $this->Stock_opname_model->get_by_id($id);
        if($check_id){
            $data['kategori'] = $check_id;
            $this->load->view('opname/form',$data);
        }else{
            redirect(site_url('Stock_opname', $data));
        }
    }

    public function save($id = ''){
        if(!$id){
            $save = $this->Stock_opname_model->insert();
        } else {
            $save = $this->Stock_opname_model->insert($id);
        }
        redirect(site_url('Stock_opname'));
    }
    public function delete($id){
        $check_id = $this->Stock_opname_model->get_by_id($id);
        if($check_id){
            $this->Stock_opname_model->delete($id);
        }
        redirect(site_url('Stock_opname'));
    }
    public function export_csv(){
        $filter = false;
        if(isset($_GET['search'])) {
            if (!empty($_GET['value']) && $_GET['value'] != '') {
                $filter[$_GET['search_by'] . ' LIKE'] = "%" . $_GET['value'] . "%";
            }
        }
        $data = $this->Stock_opname_model->get_all_array($filter);
        $this->csv_library->export('Stock Opname.csv',$data);
    }
}
