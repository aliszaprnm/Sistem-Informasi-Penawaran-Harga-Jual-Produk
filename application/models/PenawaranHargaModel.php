<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenawaranHargaModel extends CI_Model
{

	public function GetPenawaranHarga($where=array())
	{
		$this->db->select('penawaran_harga.id, pesanan_id, kode_pesanan, penawaran_harga.kode_produk, customer.nama_customer as nama_customer, produk.nama_produk as nama_produk, process_cost, tooling_cost, total, penawaran_harga.status');
		$this->db->from('penawaran_harga');
		$this->db->join('pesanan', 'pesanan.id = penawaran_harga.pesanan_id', 'left');
		$this->db->join('customer', 'customer.kode_customer = penawaran_harga.kode_customer', 'left');
		$this->db->join('produk', 'produk.kode_produk = penawaran_harga.kode_produk', 'left');
		// if(count($where) > 0) $this->db->where($where);
		// if(isset($where['penawaran_harga.status']) && $where['penawaran_harga.status'] == 'Negotiating') $this->db->or_where('penawaran_harga.status', 'New');
		// return $this->db->get();
		if(count($where) > 0 && isset($where['penawaran_harga.status']) && $where['penawaran_harga.status'] == 'Negotiating') $this->db->where_in('penawaran_harga.status',array('New','Negotiating','Reject By OM'));
		if(count($where) > 0 && (isset($where['penawaran_harga.status']) && $where['penawaran_harga.status'] != 'Negotiating')) $this->db->where($where);
		return $this->db->get();
		//print_r($this->db->last_query()); exit;
	}

	public function tambah()
	{		
		$data = [
			'pesanan_id' => $this->input->post('kode_pesanan', true),
			'kode_produk' => $this->input->post('kode_produk', true),
			'kode_customer' => $this->input->post('kode_customer', true),
			'process_cost' => $this->input->post('process_cost', true),
			'tooling_cost' => $this->input->post('tooling_cost', true),
			'total' => $this->input->post('harga_jual', true),
			'status' => 'New',
			'created_by' => $this->session->userdata('userid'),
			'created_date' => date('Y-m-d H:i:s')
		];
		$this->db->insert('penawaran_harga', $data);
		$headerId = $this->db->insert_id();
		if($this->db->affected_rows() > 0) {
			$this->db->select('MIN(id) as uid');
			$this->db->from('user');
			$this->db->where('level','Marketing');
			$toUser = $this->db->get();
			$creator = $toUser->row()->uid;
			$dataNotif = [
				'request_id' => $headerId,
				'type' => 'Offer',
				'message' => 'There is new offering',
				'from_user_id' => $this->session->userdata('userid'),
				'to_user_id' => $creator,
				'date' => date('Y-m-d H:i:s'),
				'status' => 'unread'
			];

			$this->db->insert('notification', $dataNotif);
		}
	}

	public function edit($id)
	{
		$data = $this->db->select('status,created_by,mod_by')->from('penawaran_harga')->where('id', $id)->limit(1)->get()->row();
		$status = $data->status;
		$creator = $data->mod_by;
		$data = [
			//'pesanan_id' => $this->input->post('kode_pesanan', true),
			//'kode_produk' => $this->input->post('kode_produk', true),
			//'kode_customer' => $this->input->post('kode_customer', true),
			'process_cost' => $this->input->post('process_cost', true),
			'tooling_cost' => $this->input->post('tooling_cost', true),
			'total' => $this->input->post('harga_jual', true),
			'mod_by' => $this->session->userdata('userid'),
			'mod_date' => date('Y-m-d H:i:s')
		];
		$this->db->where('id', $id);
		$this->db->update('penawaran_harga', $data);
		if($this->db->affected_rows() > 0 && $status == 'Negotiating') {
			/*$this->db->select('MIN(id) as uid');
			$this->db->from('user');
			$this->db->where('level','Marketing');
			$toUser = $this->db->get();*/
			$dataNotif = [
				'request_id' => $id,
				'type' => 'Offer',
				'message' => 'There is new offering',
				'from_user_id' => $this->session->userdata('userid'),
				'to_user_id' => $creator,
				'date' => date('Y-m-d H:i:s'),
				'status' => 'unread'
			];

			$this->db->insert('notification', $dataNotif);
		}
	}
}
