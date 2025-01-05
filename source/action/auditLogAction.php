<?php
header('Content-Type: application/json');

include('../lib/Session.php');
include_once('../model/AuditLogModel.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    http_response_code(403); // Forbidden
    echo json_encode(["error" => "Unauthorized access. Please login."]);
    exit;
}

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $auditLog = new AuditLogModel();
    $data = $auditLog->getDataForDataTables($_POST);

    // Prepare the response for DataTables
    $result = [
        "draw" => intval($_POST['draw']),
        "recordsTotal" => $data['recordsTotal'], // Total number of records
        "recordsFiltered" => $data['recordsFiltered'], // Total filtered records
        "data" => []
    ];

    foreach ($data['data'] as $key => $row) {
        $result['data'][] = [
            'LogID' => htmlspecialchars($row['LogID']),
            'Action' => htmlspecialchars(string: $row['Action']),
            'ID_Pelanggaran' => htmlspecialchars($row['ID_Pelanggaran']),
            'Komentar' => htmlspecialchars($row['Komentar']),
            'Tanggal_Laporan' => htmlspecialchars($row['Tanggal_Laporan']->format('Y-m-d H:i:s')),
            // 'Tanggal_Laporan' => htmlspecialchars($row['Tanggal_Laporan']),
            'Tempat' => htmlspecialchars($row['Tempat']),
            'LogDate' => $row['LogDate'] instanceof DateTime 
            ? htmlspecialchars($row['LogDate']->format('Y-m-d H:i:s')) 
            : htmlspecialchars($row['LogDate']), 
            // 'LogDate' => htmlspecialchars($row['LogDate']),
            'deskripsi' => htmlspecialchars($row['deskripsi'] ?? '', ENT_QUOTES, 'UTF-8'), 
            'NamaMahasiswa' => htmlspecialchars($row['NamaMahasiswa'] ?? 'N/A'),
            // Add default value

        ];
    }

    // Log the JSON response for debugging
    file_put_contents('debug.log', json_encode($result));

    echo json_encode($result);
 } else {
    // Handle the case where 'act' is not 'load'
    echo json_encode([
        "draw" => intval($_POST['draw']),
        "recordsTotal" => 0,
        "recordsFiltered" => 0,
        "data" => []
    ]);
}

?>
