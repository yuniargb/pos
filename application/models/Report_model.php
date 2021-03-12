<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report_model extends CI_Model {
	private $table;
	private $select_default;
	function __construct(){
        parent::__construct();
	}
	
	public function get_detail_penjualan($filter){
		$sql = "SELECT sales_transaction.id, DATE(sales_transaction.date) date, product.product_name, sales_data.quantity, customer.customer_name, sales_data.subtotal, sales_data.price_item,  product.buy_price
		FROM sales_transaction 
				JOIN sales_data ON sales_transaction.id = sales_data.sales_id 
				JOIN product ON product.id = sales_data.product_id 
				JOIN customer ON customer.id = sales_transaction.customer_id 
				JOIN category ON category.id = sales_data.category_id 
				WHERE (DATE(sales_transaction.date) BETWEEN '".$filter['from']."' AND '".$filter['to']."')";
		if(!empty($filter['item'])){
			$sql .= ' AND product.id = "'.$filter['item'].'"';
		}
		$query = $this->db->query($sql);
		return $query->result();
	}
	public function get_detail_penjualan_pendapatan($filter){
		// ada tanggal, total transaksi,total piutang,total penerimaan piutang,total hutang,total pembayaran hutang,keuntungan,pengeluaran biaya
		$sql1 = "SELECT 
		DATE(stx.date) date,
		COUNT(stx.id) as jumlah_transaksi, 
		IFNULL((
			select SUM(st.total_price) 
			from sales_transaction st 
			where DATE(st.date) = DATE(stx.date)
			and is_cash = 0
		),0) as total_piutang,
		IFNULL((
			select SUM(st.total_price) 
			from sales_transaction st 
			where DATE(st.date) = DATE(stx.date)
			and is_cash = 0
			and is_credit = 1
		),0) as total_penerimaan_piutang,
		0 as total_hutang,
		0 as total_pembayaran_hutang, 
		0 as total_pengeluaran, 
		SUM(total_price) as total_keuntungan 
		FROM sales_transaction stx
		WHERE (DATE(stx.date) BETWEEN '".$filter['from']."' AND '".$filter['to']."')
		GROUP BY DATE(stx.date)";

		$sql2 = "SELECT 
		DATE(ptx.date) date,
		COUNT(ptx.id) as jumlah_transaksi, 
		0 as total_piutang,
		0 as total_penerimaan_piutang,
		IFNULL((
			select SUM(st.total_price) 
			from purchase_transaction st 
			where DATE(st.date) = DATE(ptx.date)
			and is_cash = 0
		),0) as total_hutang,
		IFNULL((
			select SUM(st.total_price) 
			from purchase_transaction st 
			where DATE(st.date) = DATE(ptx.date)
			and is_cash = 0
			and is_credit = 1
		),0) as total_pembayaran_hutang, 
		SUM(total_price) as total_pengeluaran, 
		0 as total_keuntungan 
		FROM purchase_transaction ptx
		WHERE (DATE(ptx.date) BETWEEN '".$filter['from']."' AND '".$filter['to']."')
		GROUP BY DATE(ptx.date)";
		$sql = 'SELECT 
		DATE(date) date,
		SUM(jumlah_transaksi) jumlah_transaksi,
		SUM(total_piutang) total_piutang,
		SUM(total_penerimaan_piutang) total_penerimaan_piutang,
		SUM(total_hutang) total_hutang,
		SUM(total_pembayaran_hutang) total_pembayaran_hutang,
		SUM(total_pengeluaran) total_pengeluaran,
		SUM(total_keuntungan) total_keuntungan
		FROM (' . $sql1 . ' UNION ' . $sql2 . ') abc GROUP BY DATE(date)';
		$query = $this->db->query($sql);
		return $query->result();
	}
	

	public function get_detail_pengeluaran($filter)
	{
		$sql = "SELECT a.id, DATE(a.tanggal) tanggal,'-' total , a.jumlah, a.keterangan, b.code, b.name 
				FROM pengeluaran a
				Inner JOIN expense_account b ON a.akun_id = b.id 
				WHERE (DATE(a.tanggal) BETWEEN '".$filter['from']."' AND '".$filter['to']."') 
				UNION ALL
				SELECT pt.id, DATE(pt.date) date,pd.quantity total, pd.subtotal jumlah, 'pembelian barang' keterangan, s.id code, s.supplier_name name 
				FROM purchase_transaction pt
				INNER JOIN purchase_data pd ON pt.id = pd.transaction_id 
				INNER JOIN supplier s ON pt.supplier_id = s.id 
				WHERE (DATE(pt.date) BETWEEN '".$filter['from']."' AND '".$filter['to']."') 
				ORDER BY UNIX_TIMESTAMP(tanggal) ASC";
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

	public function get_detail_stok($filter){
		$sql = "SELECT * FROM (
					SELECT '-' transaksi_id, '-' tgl_transaksi,'-' customer, 'Saldo Awal' keterangan,p.product_name nama_product, ((p.product_qty -  IFNULL(SUM(j.quantity),0)) + IFNULL(SUM(x.quantity),0) ) as stok_masuk, 0 stok_keluar
					FROM product p
					LEFT JOIN (
						SELECT SUM(sd.quantity) quantity,sd.product_id 
						FROM sales_transaction st
						INNER JOIN sales_data sd ON sd.sales_id = st.id
						WHERE DATE(st.date) <= '".$filter['from']."'
						AND sd.type <> 0
						GROUP BY sd.product_id
					) x ON p.id = x.product_id
					LEFT JOIN (
						SELECT SUM(sd.quantity) quantity,sd.product_id 
						FROM purchase_transaction st
						INNER JOIN purchase_data sd ON sd.transaction_id = st.id
						WHERE DATE(st.date) <= '".$filter['from']."'
						
						GROUP BY sd.product_id
					) j ON p.id = j.product_id
					WHERE p.id = '".$filter['item']."'
					GROUP BY p.id
				) y
				UNION ALL
				SELECT * FROM ( 
				SELECT st.id transaksi_id, DATE(st.date) tgl_transaksi,c.customer_name,'Penjualan' keterangan, p.product_name nama_product , 0 stok_masuk, (sd.quantity * -1) stok_keluar
					FROM product p
					INNER JOIN sales_data sd ON sd.product_id = p.id
					INNER JOIN sales_transaction st ON sd.sales_id = st.id
					INNER JOIN customer c ON st.customer_id = c.id
					WHERE sd.quantity <> 0
					AND DATE(st.date) >= '".$filter['from']."' AND DATE(st.date) <=  '".$filter['to']."'
					AND p.id = '".$filter['item']."'
					AND sd.type <> 0
					UNION ALL
					SELECT st.id transaksi_id, DATE(st.date) tgl_transaksi,s.supplier_name,'Pembelian' keterangan, p1.product_name nama_product , sd.quantity stok_masuk, 0 stok_keluar
					FROM product p1
					INNER JOIN purchase_data sd ON sd.product_id = p1.id
					INNER JOIN purchase_transaction st ON sd.transaction_id = st.id
					INNER JOIN supplier s ON st.supplier_id = s.id
					WHERE sd.quantity <> 0
					AND DATE(st.date) >= '".$filter['from']."' AND DATE(st.date) <=  '".$filter['to']."'
					AND p1.id = '".$filter['item']."'
					ORDER BY DATE(tgl_transaksi) ASC
				) t";
		$query = $this->db->query($sql);
		return $query->result();
	}

}