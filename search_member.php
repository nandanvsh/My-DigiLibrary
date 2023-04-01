<?php
include 'db.php';

//get search term
$searchTerm = $_GET['term'];
//get matched data from skills table
$query  = $db->query("SELECT * FROM lms_members WHERE MEMBER_NAME LIKE '%$searchTerm%' LIMIT 10");
$result = $query->fetch_all(MYSQLI_ASSOC);

// Format bentuk data untuk autocomplete.
foreach ($result as $data) {
    $arr_result[] = array(
        'label' => $data['MEMBER_NAME'],
        'description'    => $data['MEMBER_NAME'],
        'id'    => $data['MEMBER_ID'],
    );
}

if (!empty($arr_result)) {
    // Encode ke format JSON.
    echo json_encode($arr_result);
}
