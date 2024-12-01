<?php
include('../lib/Session.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/BukuModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $buku = new BukuModel();
    $data = $buku->getData();
    $result = [];
    $i = 1;
    foreach ($data as $row) {
        $result['data'][] = [
            $i,
            $row['buku_kode'], // Change to buku_kode
            $row['buku_nama'], // Change to buku_nama
            $row['kategori_id'], // You might want to display the kategori_name instead
            $row['jumlah'], // Add the jumlah field if required
            $row['deskripsi'], // Add the deskripsi field if required
       
        
        '<img width="200px" src="'.$row['gambar'].'">',
'<button class="btn btn-sm btn-warning" 
onclick="editBuku(' . $row['buku_id'] . ')"><i class="fa fa-edit"></i></button>  
 <button class="btn btn-sm btn-danger" 
onclick="deleteBuku(' . $row['buku_id'] . ')"><i class="fa fa-trash"></i></button>'
        ];
        $i++;
    }   
    echo json_encode($result);
}

if ($act == 'get') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $buku = new BukuModel();
    $data = $buku->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {
    $data = [
        'kategori_id' => antiSqlInjection($_POST['kategori_id']), // kategori_id
        'buku_kode' => antiSqlInjection($_POST['buku_kode']), // buku_kode
        'buku_nama' => antiSqlInjection($_POST['buku_nama']), // buku_nama
        'jumlah' => antiSqlInjection($_POST['jumlah']), // jumlah
        'deskripsi' => antiSqlInjection($_POST['deskripsi']), // deskripsi
        'gambar' => antiSqlInjection($_POST['gambar']) // gambar (if you are handling image URL or file path)
    ];
    $buku = new BukuModel();
    $buku->insertData($data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil disimpan.'
    ]);
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    $data = [
        'kategori_id' => antiSqlInjection($_POST['kategori_id']), // kategori_id
        'buku_kode' => antiSqlInjection($_POST['buku_kode']), // buku_kode
        'buku_nama' => antiSqlInjection($_POST['buku_nama']), // buku_nama
        'jumlah' => antiSqlInjection($_POST['jumlah']), // jumlah
        'deskripsi' => antiSqlInjection($_POST['deskripsi']), // deskripsi
        'gambar' => antiSqlInjection($_POST['gambar']) // gambar (if you are handling image URL or file path)
    ];

    $buku = new BukuModel();
    $buku->updateData($id, $data);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil diupdate.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $buku = new BukuModel();
    $buku->deleteData($id);

    echo json_encode([
        'status' => true,
        'message' => 'Data berhasil dihapus.'
    ]);
}
