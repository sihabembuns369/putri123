<?php
defined('BASEPATH') OR exit('No direct script access allowed');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
ini_set('display_errors', 1); 
error_reporting(E_ALL);

class Api extends CI_Controller {
	function __construct(){
		parent ::__construct();
	}

	public function get_buku(){
		$data = $this->M_api->mget_buku();
		echo json_encode($data);
	}

	Public function login(){
		ini_set('display_errors', 1); 
		error_reporting(E_ALL);
		$x = $_POST["x"];
		$z = $_POST["z"];

		$data = $this->M_api->m_login($x,$z);
		if(is_array($data)){
			if(count($data)>0){
				foreach ($data as $k) {
					$nama = $k->user;
				}
				echo("1|$nama");
			}else{
				echo("0|Akun tidak ditemukan");
			}
		}else{
			echo("0|Akun tidak ditemukan");
			
		}
	}

	public function bukuJSON(){
        $dtJSON = '{"data": [xxx]}';
        $dtisi = "";
        $dt = $this->M_api->bukuJSON();
        foreach ($dt as $k){
            $kode = $k->Kode_Buku;
            $judul = $k->Judul;

            $isbn = $k->ISBN;
            $tt = $k->Tahun_Terbit;
            $rak = $k->Rak;
            $nmp = $k->Nama_Pengarang;
            $nmr = $k->Nama_Penerbit;
            $tomboledit = "<button type='button' class='btn btn-warning btn-sm' data-toggle='modal' data-target='.bs-example-modal-lg' data-kode='".$kode."' onclick='edit(this)'> <i class='mdi mdi-pencil'></i></button> <button type='button' class='btn btn-danger btn-sm' onclick='hapus(".$kode.");'><i class='mdi mdi-delete'></i></button>" ;
            $dtisi .= '["'.$kode.'","'.$judul.'","'.$nmp.'","'.$nmr.'","'.$isbn.'","'.$tt.'","'.$rak.'","'.$tomboledit.'"],';
        }
        $dtisifix = rtrim($dtisi, ",");
        $data = str_replace("xxx", $dtisifix, $dtJSON);
        echo $data;
    }

	public function pengarangJSON(){
        $data = $this->M_api->mpengarangJSON();
        echo json_encode($data);

    }

	public function penerbitJSON(){
        $data = $this->M_api->mpenerbitJSON();
        echo json_encode($data);

    }

    public function tambahbuku(){
        $kode = $this->input->post("kode");
        $judul = $this->input->post("judul");
        $pengarang = $this->input->post("pengarang");
        $penerbit = $this->input->post("penerbit");
        $isbn = $this->input->post("isbn");
        $tahun = $this->input->post("tahun");
        $rak = $this->input->post("rak");
		$operasi = $this->M_api->mtambahbuku($kode, $judul, $pengarang, $penerbit, $isbn, $tahun, $rak);
		echo $operasi;
	}

	function hapusbuku(){
		$kode = $this->input->post("kode");
		$operasi = $this->M_api->mhapusbuku($kode);
		echo $operasi;
	}

	function filterbuku(){
		$kode = $this->input->post("kd");
		$dt = $this->M_api->mfilterbuku($kode);
		$dtkirim = "";
		if(is_array($dt)){
			foreach($dt as $x){
				$dtkirim = "1|".$x->Judul. "|".$x->ID_Pengarang. "|".$x->ID_Penerbit. "|".$x->ISBN. "|".$x->Tahun_Terbit. "|".$x->Rak;
			}
		}else{$dtkirim = "0|";}
		echo $dtkirim;
	}

	function updatedata(){
		$kode = $this->input->post("kd");
        $judul = $this->input->post("jd");
        $pengarang = $this->input->post("png");
        $penerbit = $this->input->post("pnr");
        $isbn = $this->input->post("isbn");
        $tahun = $this->input->post("th");
        $rak = $this->input->post("rak");
		$operasi = $this->M_api->mupdatedata($kode, $judul, $pengarang, $penerbit, $isbn, $tahun, $rak);
		echo $operasi;
	}

}
