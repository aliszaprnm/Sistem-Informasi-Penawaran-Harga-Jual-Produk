<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PesananModel extends CI_Model
{

	public function GetPesanan($where=array())
	{
		$this->db->select('pesanan.id, pesanan.tanggal, pesanan.kode_pesanan, pesanan.kode_customer, customer.nama_customer as nama_customer, group_concat(produk.nama_produk order by pesanan_detil.id) as nama_produk, group_concat(pesanan_detil.qty order by pesanan_detil.id) as qty, group_concat(pesanan_detil.keterangan order by pesanan_detil.id) as keterangan, pesanan.status, pesanan.created_by');
		$this->db->from('pesanan');
		$this->db->join('pesanan_detil', 'pesanan_detil.pesanan_id = pesanan.id', 'left');
		$this->db->join('customer', 'customer.kode_customer = pesanan.kode_customer', 'left');
		$this->db->join('produk', 'produk.kode_produk = pesanan_detil.kode_produk', 'left');
		if(count($where) > 0) $this->db->where($where);
		if(isset($where['pesanan.status']) && $where['pesanan.status'] == 'Proses') $this->db->or_where('pesanan.status', 'Penawaran');
		$this->db->group_by('pesanan.kode_pesanan');
		return $this->db->get();
	}

	public function GetKodePesanan()
	{
		$this->db->select('MAX(kode_pesanan) as IDO');
		$this->db->from('pesanan');
		return $this->db->get();
	}

	public function tambah()
	{
		$arg = $this->input->post();
		
		$this->db->select('MIN(id) as uid');
		$this->db->from('user');
		$this->db->where('level','Operational Manager');
		$toUser = $this->db->get();

		$data = [
			'kode_pesanan' => $this->input->post('kode_pesanan', true),
			'tanggal' => $this->input->post('tanggal', true),
			'kode_customer' => $this->input->post('kode_customer', true),
			'status' => 'Baru',
			'created_by' => $this->session->userdata('userid'),
			'created_date' => date('Y-m-d H:i:s')
		];

		$this->db->insert('pesanan', $data);
		$headerId = $this->db->insert_id();

        $this->db->where('pesanan_id', $headerId)->delete('pesanan_detil');

        $product = ($arg['kode_produk']) ? $arg['kode_produk'] : null;
		for ($i=0; $i < count($product); $i++) {
			if ($product[$i] != '') {
				$detil[$i]['pesanan_id'] = $headerId;
				$detil[$i]['qty'] = $arg['qty'][$i];
				$detil[$i]['kode_produk'] = $arg['kode_produk'][$i];
				$detil[$i]['keterangan'] = $arg['keterangan'][$i];
			}
		}

		$this->db->insert_batch('pesanan_detil', $detil);
		$this->db->where_in('kode_produk', $arg['kode_produk']);
		$this->db->update('produk', ['status' => 'Used']);

		if($toUser->num_rows() > 0) {
			$dataNotif = [
				'request_id' => $headerId,
				'type' => 'Order',
				'message' => 'There is new order',
				'from_user_id' => $this->session->userdata('userid'),
				'to_user_id' => $toUser->row()->uid,
				'date' => date('Y-m-d H:i:s'),
				'status' => 'unread'
			];

			$this->db->insert('notification', $dataNotif);
		}
		
		//return $this->db->where('id', $id)->update('pesanan', $data['header']);
	}

	public function edit($id)
	{
		$arg = $this->input->post();

		$data = [
			'kode_pesanan' => $this->input->post('kode_pesanan', true),
			'tanggal' => $this->input->post('tanggal', true),
			'kode_customer' => $this->input->post('kode_customer', true),
			'mod_by' => $this->session->userdata('userid'),
			'mod_date' => date('Y-m-d H:i:s')
		];
		$this->db->where('id', $id);
		$this->db->update('pesanan', $data);

		$headerId = $id;

        $this->db->where('pesanan_id', $headerId)->delete('pesanan_detil');

        $product = ($arg['kode_produk']) ? $arg['kode_produk'] : null;
		for ($i=0; $i < count($product); $i++) {
			if ($product[$i] != '') {
				$detil[$i]['pesanan_id'] = $headerId;
				$detil[$i]['qty'] = $arg['qty'][$i];
				$detil[$i]['kode_produk'] = $arg['kode_produk'][$i];
				$detil[$i]['keterangan'] = $arg['keterangan'][$i];
			}
		}

		$this->db->insert_batch('pesanan_detil', $detil);
	}
}
