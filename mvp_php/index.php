<?php

/******************************************
 Asisten Pemrogaman 13 & 14
******************************************/

include("view/TampilMahasiswa.php");

$tp = new TampilMahasiswa();

if (isset($_POST['tambah'])) {
    $data = [
        'nim' => $_POST['nim'],           
        'nama' => $_POST['nama'],        
        'tempat' => $_POST['tempat'],    
        'tl' => $_POST['tl'],           
        'gender' => $_POST['gender'],    
        'email' => $_POST['email'],  
        'telp' => $_POST['telp']      
    ];
    $tp->tambahData($data); // tambahin method ini di View
    header("Location: index.php");
    exit;

} elseif (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $tp->editData($id);

// Default: tampilkan data
} elseif (isset($_POST['update'])) {
    $id = $_POST['id'];
    $data = [
        'nim' => $_POST['nim'],
        'nama' => $_POST['nama'],
        'tempat' => $_POST['tempat'],
        'tl' => $_POST['tl'],
        'gender' => $_POST['gender'],
        'email' => $_POST['email'],
        'telp' => $_POST['telp']
    ];
    $tp->updateData($id, $data); // Buat method ini di TampilMahasiswa
    header("Location: index.php");
    exit;
} elseif (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $tp->deleteData($id); // tambahin method ini di View
    header("Location: index.php");
    exit;
} else {
    $tp->tampil();
}