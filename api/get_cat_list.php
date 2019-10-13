<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: http://localhost:4200');
if ($_SERVER['REQUEST_METHOD']=='OPTIONS') {
header('Access-Control-Allow-Methods : POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers : X-Requested-With, content-type');
}
else
{
	include('connect.php');
	$stmt = $db->prepare("SELECT id, name FROM category WHERE id_hi is null");
	$stmt->execute();
	$categ_arr = array();
	while( $row = $stmt->fetch() ) {
		$categ_arr[] = array('_id' => $row['id'], 'name' => $row['name']);
	};
	echo json_encode(
		array('meta' => array('code' => 200, 'success' => true, 'message' => 'Successfully get categories')
			, 'data' => array('categories' => $categ_arr))
	);
}
?>