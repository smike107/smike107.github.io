<?php

// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}
// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");         

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

}




	include "Templates/Connection.php";

		$sql = $db->query('SELECT * FROM `crash` ORDER BY `id` DESC LIMIT 10');
		$crash = $sql->fetchAll(PDO::FETCH_ASSOC);

 ?>


				<table class='table table-striped dataTable no-footer'><thead><th>Game ID</th><th>Crash At</th></thead><tbody>
							
							<?php foreach($crash as $key => $value): ?>
								

								<tr><td>#<?=$value['id']?></td>
								<td><?php 

								$NumarFormat = number_format($value['crashAt']/100, 2, '.', '');



								if($value['crashAt'] <= 179) {
									echo '<span style="color:red">'.$NumarFormat.'x</span>';
								}else if($value['crashAt'] >= 180 && $value['crashAt'] <= 199) {
									echo '<span style="color:gray">'.$NumarFormat.'x</span>';
								}else if($value['crashAt'] >= 200) {
									echo '<span style="color:green">'.$NumarFormat.'x</span>';
								}


								?></td>
							</tr>
							<?php endforeach; ?>
				</tbody></table>