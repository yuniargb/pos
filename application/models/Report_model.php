<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {
	private $table;
	private $select_default;
	function __construct(){
        parent::__construct();
	}
	
	public function get_detail_penjualan($filter){
		$sql = "SELECT sales_transaction.id, sales_transaction.date, product.product_name, sales_data.quantity, customer.customer_name, sales_data.subtotal, sales_data.price_item FROM sales_transaction 
				JOIN sales_data ON sales_transaction.id = sales_data.sales_id 
				JOIN product ON product.id = sales_data.product_id 
				JOIN customer ON customer.id = sales_transaction.customer_id 
				JOIN category ON category.id = sales_data.category_id 
				WHERE (sales_transaction.date BETWEEN '".$filter['from']."' AND '".$filter['to']."')";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_detail_pengeluaran($filter)
	{
		$sql = "SELECT a.id, a.tanggal, a.jumlah, a.keterangan, b.code, b.name FROM pengeluaran a
				Inner JOIN expense_account b ON a.akun_id = b.id WHERE (a.tanggal BETWEEN '".$filter['from']."' AND '".$filter['to']."') ";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_pendapatan($bulan=null, $tahun=null)
	{
		$sql = "SELECT sales_transaction.id, sales_transaction.date, product.product_name, sales_data.quantity, customer.customer_name, sales_data.subtotal, sales_data.price_item FROM sales_transaction 
				JOIN sales_data ON sales_transaction.id = sales_data.sales_id 
				JOIN product ON product.id = sales_data.product_id 
				JOIN customer ON customer.id = sales_transaction.customer_id 
				JOIN category ON category.id = sales_data.category_id 
				WHERE MONTH(sales_transaction.date) = '".$bulan."' and YEAR(sales_transaction.date) = '".$tahun."'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_biaya($bulan=null, $tahun=null)
	{
		$sql = "SELECT a.id, a.tanggal, a.jumlah, a.keterangan, b.code, b.name FROM pengeluaran a
				Inner JOIN expense_account b ON a.akun_id = b.id WHERE MONTH(a.tanggal) = '".$bulan."' and YEAR(a.tanggal) = '".$tahun."'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function get_detail_laba_rugi($id=null, $filter=null)
	{	
		if($id)
		{
			$sql = "SELECT * from proyeksi_laba where id='".$id."'";
		} else {
			if($filter){
				$sql = "SELECT * from proyeksi_laba where (month BETWEEN '".$filter['txtBulan_from']."' AND '".$filter['txtBulan_to']."') 
				and (year BETWEEN '".$filter['txtTahun_from']."' AND '".$filter['txtTahun_to']."')";
			} else {
				$sql = "SELECT * from proyeksi_laba";
			}
		}

		$query = $this->db->query($sql);
		return $query->result();
	}

	public function check_data_proyeksi($bulan=null, $tahun=null)
	{
		$sql = "SELECT * from proyeksi_laba where month='".$bulan."' and year='".$tahun."'";
		$query = $this->db->query($sql);
		return $query->result();
	}

	public function insert_proyeksi($id=null)
	{
		$txtBulan = $this->input->post('txtBulan',TRUE);
		$txtTahun = $this->input->post('txtTahun',TRUE);
		$txtPendapatan = $this->input->post('txtPendapatan',TRUE);
		$txtHPP = $this->input->post('txtHPP',TRUE);
		$txtLabaRugiKotor = $this->input->post('txtLabaRugiKotor',TRUE);
		$txtTotalBiaya = $this->input->post('txtTotalBiaya',TRUE);
		$txtLabaRugi = $this->input->post('txtLabaRugi',TRUE);

		$ket = "";
		if($txtLabaRugi > 0){
			$ket = "Untung";
		} else {
			$ket = "Rugi";
		}

		$save = array(
			'month' => $txtBulan, 
			'year' => $txtTahun, 
			'tot_pendapatan' => $txtPendapatan, 
			'hpp' => $txtHPP, 
			'tot_biaya' => $txtTotalBiaya, 
			'tot_laba_rugi_kotor' => $txtLabaRugiKotor, 
			'tot_laba_rugi' => $txtLabaRugi, 
			'keterangan' => $ket, 
		);

		if($id)
    	{
    		$where = array(
				'id' => $id
			);

			$this->db->where($where);
			$this->db->update('proyeksi_laba',$save);

    	} else {
    		$this->db->insert('proyeksi_laba', $save);
    	}
	}

	public function delete_proyeksi($id)
	{
		$this->db->delete('proyeksi_laba', array('id' => $id));
	}

}