<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_management extends MY_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('form_validation');

        // Check Session Login
        if(!isset($_SESSION['logged_in'])){
            redirect(site_url('auth/login'));
        }
    }

    public function index(){
        if(isset($_GET['search'])){
            $filter = "";
            if(!empty($_GET['value']) && $_GET['value'] != ''){
                $filter = " username like "."'%".$_GET['value']."%'";
            }

            $total_row = $this->user_model->count_total_filter($filter);

            $result = $this->user_model->get_filter($filter,url_param());
            $data['users'] = $result;
        }else{
            $total_row = $this->user_model->count_total();
            
            $result = $this->user_model->get_all(url_param());
            $data['users'] = $result;
        }
        $data['paggination'] = get_paggination($total_row,get_search());

        $this->load->view('user/index',$data);
    }

    public function create(){
        $this->load->view('user/form');
    }

    public function check_id(){
        $id = $this->input->post('id');
        $check_id = $this->user_model->get_by_id($id);
        if(!$check_id){
            echo "available";
        }else{
            echo "unavailable";
        }
    }

    public function edit($id = ''){
        $check_id = $this->user_model->get_by_id($id);
        if($check_id){
            $data['user'] = $check_id[0];
            $this->load->view('user/form',$data);
        }else{
            redirect(site_url('user'));
        }
    }

    public function save($id = ''){
        // INSERT NEW
        if(!$id){
            $save = $this->user_model->insert();
        } else {
            $check_id = $this->user_model->get_by_id($id);
            $save = $this->user_model->insert($id, $check_id);
        }
        redirect(site_url('User_management'));
    }
    public function delete($id){
        $check_id = $this->user_model->get_by_id($id);
        if($check_id){
            $this->user_model->delete($id, $check_id);
        }
        redirect(site_url('User_management'));
    }
    public function export_csv(){
        $filter = false;
        if(isset($_GET['search'])) {
            if (!empty($_GET['value']) && $_GET['value'] != '') {
                $filter[$_GET['search_by'] . ' LIKE'] = "%" . $_GET['value'] . "%";
            }
        }
        $data = $this->user_model->get_all_array($filter);
        $this->csv_library->export('pelanggan.csv',$data);
    }
}
