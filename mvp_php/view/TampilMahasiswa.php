<?php

/******************************************
 Asisten Pemrogaman 13 & 14
******************************************/

include("KontrakView.php");
include("presenter/ProsesMahasiswa.php");

class TampilMahasiswa implements KontrakView
{
	private $prosesmahasiswa; // Presenter yang dapat berinteraksi langsung dengan view
	private $tpl;

	function __construct()
	{
		//konstruktor
		$this->prosesmahasiswa = new ProsesMahasiswa();
	}

	function tampil()
	{
		$this->prosesmahasiswa->prosesDataMahasiswa();
		$data = null;

		//semua terkait tampilan adalah tanggung jawab view
		for ($i = 0; $i < $this->prosesmahasiswa->getSize(); $i++) {
			$no = $i + 1;
			// $id = $this->prosesmahasiswa->getId($i);
			$data .= "<tr>
			<td>" . $no . "</td>
			<td>" . $this->prosesmahasiswa->getNim($i) . "</td>
			<td>" . $this->prosesmahasiswa->getNama($i) . "</td>
			<td>" . $this->prosesmahasiswa->getTempat($i) . "</td>
			<td>" . $this->prosesmahasiswa->getTl($i) . "</td>
			<td>" . $this->prosesmahasiswa->getGender($i) . "</td>
			<td>" . $this->prosesmahasiswa->getEmail($i) . "</td>
			<td>" . $this->prosesmahasiswa->getTelp($i) . "</td> 
			<td>
                <a href='index.php?edit=$i' class='btn btn-warning btn-sm'>Edit</a>
                <a href='index.php?delete=$i' class='btn btn-danger btn-sm' onclick='return confirm(\"Yakin ingin hapus?\")'>Hapus</a>
            </td> </tr>";
		}
		// Membaca template skin.html
		$this->tpl = new Template("templates/skin.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_TABEL", $data);

		// Menampilkan ke layar
		$this->tpl->write();
	}

	function tambahData($data)
	{
		$this->prosesmahasiswa->tambahMahasiswa($data);
	}

	function editData($id)
	{
		$this->prosesmahasiswa->prosesDataMahasiswa();
	
		// Ambil data berdasarkan index
		$i = $this->prosesmahasiswa->getId($id);
		$nim = $this->prosesmahasiswa->getNim($id);
		$nama = $this->prosesmahasiswa->getNama($id);
		$tempat = $this->prosesmahasiswa->getTempat($id);
		$tl = $this->prosesmahasiswa->getTl($id);
		$gender = $this->prosesmahasiswa->getGender($id);
		$email = $this->prosesmahasiswa->getEmail($id);
		$telp = $this->prosesmahasiswa->getTelp($id);
	
		// Menentukan gender terpilih
		$genderL = $gender == "Laki-laki" ? "selected" : "";
		$genderP = $gender == "Perempuan" ? "selected" : "";
	
		// HTML form langsung
		$data = null;
		$data = "
			<input type='hidden' name='id' value='$i'>
			
			<div class='form-group col-md-4'>
				<label>NIM</label>
				<input type='text' name='nim' class='form-control' value='$nim' required>
			</div>
	
			<div class='form-group col-md-4'>
				<label>Nama</label>
				<input type='text' name='nama' class='form-control' value='$nama' required>
			</div>
	
			<div class='form-group col-md-4'>
				<label>Tempat Lahir</label>
				<input type='text' name='tempat' class='form-control' value='$tempat' required>
			</div>
	
			<div class='form-group col-md-4'>
				<label>Tanggal Lahir</label>
				<input type='date' name='tl' class='form-control' value='$tl' required>
			</div>
	
			<div class='form-group col-md-4'>
				<label>Gender</label>
				<select name='gender' class='form-control' required>
					<option value='Laki-laki' $genderL>Laki-laki</option>
					<option value='Perempuan' $genderP>Perempuan</option>
				</select>
			</div>
	
			<div class='form-group col-md-4'>
				<label>Email</label>
				<input type='email' name='email' class='form-control' value='$email' required>
			</div>
	
			<div class='form-group col-md-4'>
				<label>Telepon</label>
				<input type='text' name='telp' class='form-control' value='$telp' required>
			</div>
		";

		// Membaca template skin.html
		$this->tpl = new Template("templates/edit.html");

		// Mengganti kode Data_Tabel dengan data yang sudah diproses
		$this->tpl->replace("DATA_TABEL", $data);

		// Menampilkan ke layar
		$this->tpl->write();
	}	

	function updateData($id, $data)
	{
		$this->prosesmahasiswa->updateMahasiswa($id, $data);
	}

	function deleteData($id)
	{
		$this->prosesmahasiswa->prosesDataMahasiswa();

		$i = $this->prosesmahasiswa->getId($id);
		
		$this->prosesmahasiswa->deleteMahasiswa($i);
	}
}
