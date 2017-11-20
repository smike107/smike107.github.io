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

		$sql = $db->query('SELECT * FROM `coinflip` WHERE `result`=0');
		$coinflip = $sql->fetchAll(PDO::FETCH_ASSOC);

 ?>


<table class='table table-striped dataTable no-footer'><thead><th>Game ID</th><th>User</th><th>Amount</th><th>Coin</th><th>Status</th><th>Time</th></thead><tbody>
			
		
			<?php foreach($coinflip as $key => $value): 
				$p2_pick = '';

				if($value['p1_pick'] == 'ct') {
					$p2_pick = 't';
				}else if($value['p1_pick'] == 't') {
					$p2_pick = 'ct';
				}



			?>
				<tr><td>#<?=$value['id']?></td>
				<td><? echo '<a href="http://steamcommunity.com/profiles/'.$value['p1_steamid'].'">'.$value['p1_name'].'</a>';?></td>
				<td><?=$value['amount']?></td>
				<td><? if($value['p1_pick'] == 'ct') {
					echo '<img height="25" width="25" src="http://y91036d3.beget.tech/template/img/flipcoin/ct-icon.png">';
				}else {
					echo '<img height="25" width="25" src="http://y91036d3.beget.tech/template/img/flipcoin/t-icon.png">';
				}?></td>
				<td><?if($value['result'] == 0){
					echo '<span style="color:green">Waiting...</span>';
				}else{
					echo '<span style="color:red">Flipping...</span>';
				}
				?></td>
				<td><?=date('H:i:s', $value['time'])?></td>
				<td><input id="cfJoinGame" class="btn btn-primary btn-lg" onclick="cfjoinGame(<?=$value['id']?>, '<?=$p2_pick?>')" value="Join Game" style="font-weight: bold; margin-bottom:3px;" readonly /><button onclick="cfwatchGame(<?=$value['id']?>, <?=$value['amount']?>)" class="btn btn-primary btn-lg" style="font-weight: bold; margin-bottom:3px;"><i class="fa fa-search"></i></button></td>
			</tr>
			<?php endforeach; ?>

			<?php 
				if($sql->rowCount() == 0) {
					echo 'Currently there 0 games created. You can create a game!';
				}


			?>





</tbody></table>