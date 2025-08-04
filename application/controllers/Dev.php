<?php

Class Dev extends CI_Controller{
	function __construct(){
		parent::__construct();
	}


	function index(){
		$uc = unique_code();

		echo "Kode Unik".$uc;


		$this->load->view('dev/index');
	}


	function detail($diklat_id = NULL, $diklat_tahun_id = NULL){

		if ($diklat_id != NULL || $diklat_tahun_id != NULL) {
			

			echo "diklat id :". $diklat_id;

			echo "diklat tahun id :". $diklat_tahun_id;


		}
	}
}