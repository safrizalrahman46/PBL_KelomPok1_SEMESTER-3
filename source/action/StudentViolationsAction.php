<?php
header('Content-Type: application/json');

include('../lib/Session.php');
include_once('../model/StudentViolationsModel.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    http_response_code(403); // Forbidden
    echo json_encode(["error" => "Unauthorized access. Please login."]);
    exit;
}

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $studentViolations = new StudentViolationsModel();
    $data = $studentViolations->getDataForDataTables($_POST);

    // Prepare the response for DataTables
    $result = [
        "draw" => intval($_POST['draw']),
        "recordsTotal" => $data['recordsTotal'], // Total number of records
        "recordsFiltered" => $data['recordsFiltered'], // Total filtered records
        "data" => []
    ];

    foreach ($data['data'] as $key => $row) {
        $result['data'][] = [
            'nim' => htmlspecialchars($row['nim']),
            'nama' => htmlspecialchars($row['nama']),
            'email' => htmlspecialchars($row['email']),
            'id_pelanggaran' => htmlspecialchars($row['id_pelanggaran']),
            'komentar' => htmlspecialchars($row['komentar']),
            // 'status_verifikasi_admin' => $row['status_verifikasi_admin'] == 'Setuju' ? 'Setuju' : 'Tidak Setuju',
            'status_verifikasi_admin' => htmlspecialchars($row['status_verifikasi_admin']),
            'jenis_pelanggaran' => htmlspecialchars($row['jenis_pelanggaran']),
            'tanggal_laporan' => htmlspecialchars($row['tanggal_laporan']->format('Y-m-d H:i:s')),
            'tempat' => htmlspecialchars($row['tempat']),
        ];
    }

    echo json_encode($result);
} else {
    echo json_encode([
        "draw" => intval($_POST['draw']),
        "recordsTotal" => 0,
        "recordsFiltered" => 0,
        "data" => []
    ]);
}
?>
