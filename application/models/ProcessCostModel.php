<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProcessCostModel extends CI_Model
{
	public function GetProcessCost($where=array())
	{
		/*$this->db->select('*, produk.nama_produk as nama_produk, material_produk.harga_per_produk as harga_material, proses_produk.harga_per_produk as harga_proses, sub_material_produk.harga_per_produk as harga_sub_material, customer.jarak as jarak, material_produk.berat_produk, sum(proses_produk.harga_per_produk) as total_harga_proses');
		$this->db->from('process_cost');
		$this->db->join('pesanan', 'pesanan.id = process_cost.pesanan_id', 'left');
		$this->db->join('pesanan_detil', 'pesanan_detil.pesanan_id = pesanan.id', 'left');
		$this->db->join('produk', 'produk.kode_produk = process_cost.kode_produk', 'left');
		$this->db->join('material_produk', 'material_produk.kode_produk = process_cost.kode_produk', 'left');
		$this->db->join('proses_produk', 'proses_produk.kode_produk = process_cost.kode_produk', 'left');
		$this->db->join('sub_material_produk', 'sub_material_produk.kode_produk = process_cost.kode_produk', 'left');
		$this->db->join('customer', 'customer.kode_customer = pesanan.kode_customer', 'left');*/
		/*$this->db->select('process_cost.id, kode_produk, concat(pesanan_id, "&",kode_produk) as nama_produk, harga_delivery, harga_packing, harga_qc, harga_mtc_dies, total, (select berat_produk from material_produk where kode_produk = process_cost.kode_produk) as berat_produk,
							(select sum(harga_per_produk) from material_produk where kode_produk = `process_cost`.kode_produk) as harga_material,
							(select sum(harga_per_produk) from sub_material_produk where kode_produk = `process_cost`.kode_produk) as harga_sub_material,
							(select sum(harga_per_produk) from proses_produk where kode_produk = `process_cost`.kode_produk) as harga_proses,
							(select sum(harga_per_produk) from proses_produk where kode_produk = `process_cost`.kode_produk) as total_harga_proses,
							(select jarak from customer where kode_customer = pesanan.kode_customer) as jarak'
						);*/
	 	//$this->db->select('process_cost.id, kode_produk, concat(pesanan_id, "&",kode_produk) as nama_produk, harga_delivery, harga_packing, harga_qc, harga_mtc_dies, total, (select berat_produk from material_produk where kode_produk = process_cost.kode_produk) as berat_produk, harga_material, harga_sub_material, harga_proses, harga_proses as total_harga_proses, (select jarak from customer where kode_customer = pesanan.kode_customer) as jarak');
	 	$this->db->select('process_cost.id, pesanan_id, kode_pesanan, process_cost.kode_produk, customer.nama_customer as nama_customer, produk.nama_produk as nama_produk, harga_delivery, harga_packing, harga_qc, harga_mtc_dies, profit_dan_OH, total, (select sum(berat_produk) from material_produk where kode_produk = process_cost.kode_produk) as berat_produk, harga_material, harga_sub_material, harga_proses, harga_proses as total_harga_proses, (select jarak from customer where kode_customer = pesanan.kode_customer) as jarak');
	 	$this->db->from('process_cost');
	 	$this->db->join('pesanan', 'process_cost.pesanan_id = pesanan.id', 'left');
	 	$this->db->join('customer', 'customer.kode_customer = pesanan.kode_customer', 'left');
		$this->db->join('produk', 'produk.kode_produk = process_cost.kode_produk', 'left');
		if(count($where) > 0) $this->db->where($where);
		return $this->db->get();
	}

	public function GetHargaProduk($produk)
	{
	 	$this->db->select('sum(harga_per_produk) as harga_material,
							(select sum(harga_per_produk) from sub_material_produk where kode_produk = `material_produk`.kode_produk) as total_submaterial,
							(select sum(harga_per_produk) from proses_produk where kode_produk = `material_produk`.kode_produk) as total_proses'
						);
	 	$this->db->from('material_produk');
	 	$this->db->where('kode_produk',$produk);
	 	return $this->db->get()->row();
	}

	public function tambah()
	{
		$data = [
			'pesanan_id' => $this->input->post('kode_pesanan', true),
			'kode_produk' => $this->input->post('kode_produk', true),
			'harga_material' => $this->input->post('material', true),
			'harga_sub_material' => $this->input->post('sub_material', true),
			'harga_proses' => $this->input->post('process', true),
			'harga_delivery' => $this->input->post('transportation', true),
			'harga_packing' => $this->input->post('packing', true),
			'harga_qc' => $this->input->post('quality', true),
			'harga_mtc_dies' => $this->input->post('mtc_dies', true),
			'profit_dan_oh' => $this->input->post('profit_oh', true),
			'total' => $this->input->post('total', true),
		];
		$this->db->insert('process_cost', $data);
		if($this->db->affected_rows() > 0) {
			$this->db->where('pesanan.id', $data['pesanan_id']);
			$this->db->update('pesanan', array('status' => 'Proses', 'mod_by' => $this->session->userdata('userid'), 'mod_date' => date('Y-m-d H:i:s')));
		}
	}

	public function edit($id)
	{
		$data = [
			//'kode_produk' => $this->input->post('kode_produk', true),
			'harga_material' => $this->input->post('material', true),
			'harga_sub_material' => $this->input->post('sub_material', true),
			'harga_proses' => $this->input->post('process', true),
			'harga_delivery' => $this->input->post('transportation', true),
			'harga_packing' => $this->input->post('packing', true),
			'harga_qc' => $this->input->post('quality', true),
			'harga_mtc_dies' => $this->input->post('mtc_dies', true),
			'profit_dan_oh' => $this->input->post('profit_oh', true),
			'total' => $this->input->post('total', true),
		];
		$this->db->where('id', $id);
		$this->db->update('process_cost', $data);
		if($this->db->affected_rows() > 0) {
			$penawaran = $this->db->query("select * from penawaran_harga where pesanan_id = '".$this->input->post('kode_pesanan', true)."' and kode_produk = '".$this->input->post('kode_produk', true)."'");
			$id = $penawaran->row('id');
			$status = $penawaran->row('status');
			$receiver = $penawaran->row('mod_by');
			$this->db->where(['pesanan_id' => $this->input->post('kode_pesanan', true), 'kode_produk' => $this->input->post('kode_produk', true)]);
			$this->db->update('penawaran_harga', array('process_cost' => $data['total'], 'mod_by' => $this->session->userdata('userid'), 'mod_date' => date('Y-m-d H:i:s')));
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
					'to_user_id' => $receiver,
					'date' => date('Y-m-d H:i:s'),
					'status' => 'unread'
				];

				$this->db->insert('notification', $dataNotif);
			}
		}
	}
}
