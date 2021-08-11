<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		is_log_in();
        $this->db->select('count(kode_customer) as customers, (select count(kode_produk) from produk) as products, (select count(id) from pesanan) as orders, (select count(id) from penawaran_harga)  as quotations');
        $this->db->from('customer a');
        $header = $this->db->get();
        
        $this->db->select('count(id)  as counted');
        $this->db->from('penawaran_harga a');
        $this->db->group_by('status'); 
		$this->db->order_by('status', 'asc');
        $get_status = $this->db->get();
        
        $this->db->select('count(id) as counted, left(MONTHNAME(tanggal),3) as months');
        $this->db->from('pesanan a');
        $this->db->group_by('month(tanggal)'); 
		$this->db->order_by('month(tanggal)', 'asc');
        $get_monthly = $this->db->get();
        
        foreach($get_status->result_array() as $val) {
			$status[] = $val['counted'];
		}
		
		foreach($get_monthly->result_array() as $val) {
			$total[] = $val['counted'];
			$month[] = $val['months'];
		}
        
        $data = array('header' => $header->row(), 'status' => isset($status) ? $status : 0, 'total' => isset($total) ? $total : 0, 'month' => isset($month) ? $month : 0);
		$data['title'] = 'Dashboard';
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('dashboard', $data);
		$this->load->view('templates/footer');
	}
	
	
	public function ajx_get_notification(){
		if($this->input->is_ajax_request()){
			$user_id = $this->session->userdata('userid');
			$count = $this->db->query("SELECT count(*) as count from notification where to_user_id = '$user_id' and status ='unread'")->row('count');
			$strQuery = "SELECT to_user_id,
						type,
						count(request_id) as sum
						from notification
						where status = 'unread'
						and to_user_id = '$user_id'
						group by to_user_id, type";

			$query = $this->db->query($strQuery);
			$result = array();
			foreach($query->result() as $row){
				if($row->sum == 1){
					$sql = $this->db->query("select message,
													case type when 'Order' then '/pesanan/baru'
													when 'Offer' then '/penawaranharga/validasi'
													when 'Negotiate' then '/penawaranharga'
													when 'Reject' then '/penawaranharga/reject'
													end as menu_link
												 	from notification where type = '$row->type'")->row();
					$link = $sql->menu_link;
					$message = $sql->message;
				}else{
					$link = $row->type == 'Order' ? '/pesanan/baru' : '#';
					$link = $row->type == 'Offer' ? '/penawaranharga/validasi' : '#';
					$link = $row->type == 'Negotiate' ? '/penawaranharga/validasi' : '#';
					$link = $row->type == 'Reject' ? '/penawaranharga/reject' : '#';
					$message = "There is ".$row->sum." new ".$row->type .'s';					
				}

				$result[] = [
					'type' => $row->type,
					'notification_link' => $link,
					'notification_message' => $message
				];
			}
			// echo '<pre>'; print_r($this->db->last_query()); exit;
			// $result = $query->result_array();

			$return_value = [
				'count' => $count,
				'result' => $result
			];

			// echo '<pre>';print_r($return_value);


			echo json_encode($return_value);
		}
	}

	public function ajx_read_message(){
		if($this->input->is_ajax_request()){
			$prm_id = $this->input->post('message_id');
			$user_id = $this->session->userdata('userid');
            $query = $this->db->query("UPDATE notification set status = 'read' where to_user_id = $user_id and type = '$prm_id'");

            $return_value = array(
                'status' => 'ok',
                'message' => 'success'
            );
            if(!$this->db->affected_rows() > 0){
                $return_value = array(
                    'status' => 'error',
                    'message' => 'something went wrong'
                );
            }

            echo json_encode($return_value);
		}
	}

}
