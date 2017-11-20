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

		$sql = $db->query('SELECT * FROM `sbbets` ORDER BY `id` DESC LIMIT 5');
		$sbbets = $sql->fetchAll(PDO::FETCH_ASSOC);

 ?>

 				<center><span style="color:black"><b><h4>Logs</h4></b></span></center>
				<table class='table table-striped dataTable no-footer'><thead><th><center>Name</center></th><th><center>Code used</center></th></thead><tbody>
							
							<?php foreach($sbbets as $key => $value): 
								$sql2 = $db->query('SELECT `name`,`avatar` FROM `users` WHERE `steamid`='.$value['user']);
								$user2 = $sql2->fetch();
							?>
								

								<tr><td><center><? echo '<img class="rounded" src="'.$user2['avatar'].'">'.$user2['name'];?></center></td>
								<td><center><?=$value['digit']?></center></td>
							</tr>
							<?php endforeach; ?>
				</tbody></table>