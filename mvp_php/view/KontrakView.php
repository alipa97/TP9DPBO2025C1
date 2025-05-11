<?php

/******************************************
 Asisten Pemrogaman 13 & 14
******************************************/

interface KontrakView{
	public function tampil();
	public function tambahData($data);
	public function editData($id);
	public function updateData($id, $data);
	public function deleteData($id);
}
?>