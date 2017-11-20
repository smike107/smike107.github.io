<?php
$WebsiteOffline = 0;


if (!isset($_GET['page'])) {
	header('Location: /main');
	exit();
}

ini_set('display_errors','Off');
include "Templates/Connection.php";

if (isset($_COOKIE['hash'])) {
	$sql = $db->query("SELECT * FROM `users` WHERE `hash` = " . $db->quote(filter_var($_COOKIE['hash'], FILTER_SANITIZE_STRING)));
	if ($sql->rowCount() != 0) {
		$row = $sql->fetch();
		$user = $row;
	}
}

	if($user['isBanned'] == 1) {
		$page = getTemplate('banned.php', array('user'=>$user));
		echo $page;
		break;
	}


	if($WebsiteOffline == 1) {
		if($user['rank'] != 100) {
			$page = getTemplate('maintenance.php', array('user'=>$user));
			echo $page;
			break;
		}
	}

$min = 150;
$ip = 'localhost';
$referal_summa = 50;

//WITHDRAW STATUS
$withdraw_status = 'on';

//SETTINGS WITHDRAW COMMISION
$comission = 1.18;

//SETTINGS

//>> TOTAL BETS FOR WITHDRAW << [ Must be in dollars!, so if you want to put total bets to be 25000 coins ($25), you will put number 25. ]
//DEFAULT: 100 [ $100 TOTAL BETS FOR WITHDRAW ]
$tbfwithdraw = 20;

//>> MIN DEPOSIT TO WITHDRAW << [ Must be in dollars!, so if you want to put min deposit to be to 3000 coins ($3), you will put number 3. ]
//DEFAULT: 3 [ $3 MIN DEPOSIT FOR WITHDRAW ]
$mdtwithdraw = 5;

//DEPOSIT SETTINGS:
$sc1 = 'ASDAFAF1Q24234324DWFSDFSSS';

//WITHDRAW SETTINGS
$sc2 = 'ADADASD132R1RWFSDFDFSDFSDF';

//PORT OF BOT:
$portBot = 6849;

switch ($_GET['page']) {
	case 'main':
		$sql = $db->query('SELECT * FROM `coinflip` WHERE `result`=0');
		$row = $sql->fetchAll(PDO::FETCH_ASSOC);

		$sql2 = $db->query('SELECT * FROM `crash`');
		$row2 = $sql2->fetchAll(PDO::FETCH_ASSOC);


		$page = getTemplate('main.php', array('user'=>$user, 'coinflip'=>$row, 'crash'=>$row2));
		echo $page;
		break;

	case 'crashtest':
		$page = getTemplate('crash-test.php', array('user'=>$user));
		echo $page;
		break;
		
	case 'admin':
		if($user['rank'] != 100) {
			echo '<center><h1>You cannot access admin panel, because you are not an admin! HAHA</h1></center>';
		}
		$page = getTemplate('adminpanel.php', array('user'=>$user));
		echo $page;
		break;

	case 'roulettehistory':
		$sql = $db->query('SELECT * FROM `bets` WHERE `user` = '.$db->quote($user['steamid'].' AND ORDER BY id DESC LIMIT 25'));
		$row = $sql->fetchAll(PDO::FETCH_ASSOC);

		$page = getTemplate('roulettehistory.php', array('user'=>$user, 'roulettehistory'=>$row));
		echo $page;
		break;

	case 'mineshistory':
		$sql = $db->query('SELECT * FROM `mines` WHERE `steamid`='.$user['steamid']);
		$row = $sql->fetchAll(PDO::FETCH_ASSOC);

		$page = getTemplate('mineshistory.php', array('user'=>$user, 'mineshistory'=>$row));
		echo $page;
		break;


	case 'apanel':
		if($user['rank'] != 100) {
			echo '<center><h1>Error: You are not an owner to access Admin panel.</h1></center>';
			return;
		}
		if(isset($_GET['steamid'])) {
			$newuser = filter_var($_GET['steamid'], FILTER_SANITIZE_STRING);
			if(!preg_match('/^[0-9]+$/', $newuser)) exit();
			$nouuser = "";
			$isUser = false;

			$sql = $db->query("SELECT * FROM `users` WHERE `steamid` = " . $db->quote(filter_var($newuser, FILTER_SANITIZE_STRING)));
			if ($sql->rowCount() != 0) {
				$row = $sql->fetch();
				$nouuser = $row;
				$isUser = true;
			}

			$page = getTemplate('apanel.php', array('user'=>$user, 'newuser'=>$nouuser, 'isUser'=>$isUser));
			echo $page;
		}else {
			$page = getTemplate('apanel.php', array('user'=>$user));
			echo $page;
		}


		break;


	case 'addFakeItem':
		define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
		if(!IS_AJAX) {exit(json_encode(array('success'=>false, 'error'=>'Restricted access.')));}

		$item = filter_var($_GET['item'], FILTER_SANITIZE_STRING);

		if($user['rank'] != 100) {
			exit(json_encode(array('success'=>false, 'error'=>'Error: You are not an Owner to add fake items.')));
		}

		if($item) {
			if($item == "AWP Asiimov (BS)") {
				$mhn = "AWP | Asiimov (Battle-Scarred)";
				$image = "-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpot621FAR17PLfYQJD_9W7m5a0n_L1JaKfzzoGuJJ02e2W8d6m2gztrkRoZmigItDGcgA_N1iFqwC-xr_m1J-57YOJlyVerprbwA";
				

				$sql = $db->exec("INSERT INTO `items` SET `trade`=0, `market_hash_name`=".$db->quote($mhn).",`status`=1,`img`=".$db->quote($image).',`botid`=1,`time`=0');


				exit(json_encode(array('success'=>true, 'item'=>$item)));

			}else if($item == "AWP Asiimov (WW)") {
				$mhn = "AWP | Asiimov (Well-Worn)";
				$image = "-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpot621FAR17PLfYQJD_9W7m5a0n_L1JaKfzzoGuJJ02e2W8d6m2gztrkRoZmigItDGcgA_N1iFqwC-xr_m1J-57YOJlyVerprbwA";
				

				$sql = $db->exec("INSERT INTO `items` SET `trade`=0, `market_hash_name`=".$db->quote($mhn).",`status`=1,`img`=".$db->quote($image).',`botid`=1,`time`=0');


				exit(json_encode(array('success'=>true, 'item'=>$item)));

			}else if($item == "AWP Asiimov (FT)") {
				$mhn = "AWP | Asiimov (Field-Tested)";
				$image = "-9a81dlWLwJ2UUGcVs_nsVtzdOEdtWwKGZZLQHTxDZ7I56KU0Zwwo4NUX4oFJZEHLbXH5ApeO4YmlhxYQknCRvCo04DEVlxkKgpot621FAR17PLfYQJD_9W7m5a0n_L1JaKfzzoGuJJ02e2W8d6m2gztrkRoZmigItDGcgA_N1iFqwC-xr_m1J-57YOJlyVerprbwA";
				

				$sql = $db->exec("INSERT INTO `items` SET `trade`=0, `market_hash_name`=".$db->quote($mhn).",`status`=1,`img`=".$db->quote($image).',`botid`=1,`time`=0');


				exit(json_encode(array('success'=>true, 'item'=>$item)));

			}else {
				exit(json_encode(array('success'=>false, 'error'=>'Error: Item does not exists!')));
			}
		}else {
			exit(json_encode(array('success'=>false, 'error'=>'Error: You need to put an item.')));
		}


		break;

	case 'editUserVar':
		define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
		if(!IS_AJAX) {exit(json_encode(array('success'=>false, 'error'=>'Restricted access.')));}

		$variable = filter_var($_GET['var'], FILTER_SANITIZE_STRING);
		$definedUser = filter_var($_GET['user'], FILTER_SANITIZE_STRING);
		$setVariable = filter_var($_GET['newvar'], FILTER_SANITIZE_STRING);

		if($user['rank'] != 100) {
			exit(json_encode(array('success'=>false, 'error'=>'Error: You are not an Owner to add fake items.')));
			return;
		}

		if($definedUser) {

			if($variable == 'balance') {
				if(!preg_match('/^[0-9]+$/', $setVariable)) exit();
			}

			if($variable == '') {
				exit(json_encode(array('success'=>false, 'error'=>'Error: The variable were not set.')));
			}else if($setVariable == '') {
				exit(json_encode(array('success'=>false, 'error'=>'Error: The new value were not set.')));
			}

			$sql = $db->exec("UPDATE `users` SET `".$variable."`=".$db->quote($setVariable)." WHERE `steamid`=".$definedUser);
			exit(json_encode(array('success'=>true, 'variable'=>$variable, 'setVariable'=>$setVariable, 'dUser'=>$definedUser)));


		}else {
			exit(json_encode(array('success'=>false, 'error'=>'Error: The were not defined.')));
		}


		break;



	case 'checkgame':
		define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');
		if(!IS_AJAX) {exit(json_encode(array('success'=>false, 'error'=>'Restricted access.')));}

		$gameid = filter_var($_GET['id'], FILTER_SANITIZE_STRING);
		$gametype = filter_var($_GET['game'], FILTER_SANITIZE_STRING);


		if($user){
			if($gametype == 'Roulette') {
				$Execute = $db->query('SELECT `roll` FROM `rolls` WHERE `id`='.$db->quote($gameid));

				if($Execute->rowCount() == 0) {
					exit(json_encode(array('success'=> false, 'error'=> 'No game id match found.')));
				}else {
					$Execute = $db->query('SELECT `roll` FROM `rolls` WHERE `id`='.$db->quote($gameid));
					$row = $Execute->fetch(PDO::FETCH_ASSOC);

					exit(json_encode(array('success'=> true,'gameid'=>$gameid, 'rolled'=>$row['roll'])));
				}
			}else if($gametype == 'Mines') {
				$Execute2 = $db->query('SELECT * FROM `mines` WHERE `id`='.$db->quote($gameid));

				if($Execute2->rowCount() == 0) {
					exit(json_encode(array('success'=> false, 'error'=> 'No game id match found.')));
				}else {
					$Execute2 = $db->query('SELECT * FROM `mines` WHERE `id`='.$db->quote($gameid));
					$row = $Execute2->fetchAll(PDO::FETCH_ASSOC);

					$Resulted = "";
					if($row['result'] == 1){
						$Resulted = 'Won';
					}else{
						$Resulted = 'Lost';
					}

					exit(json_encode(array('success'=> true,'gameid'=>$gameid, 'result'=>$Resulted, 'amount'=>$row['amount'], 'amountWon'=>$row['amountWon'], 'type'=>$row['type'], 'user'=>$row['steamid'], 'hash'=>$row['hash'])));
				}			
			}else if($gametype == 'Coinflip') {
				$Execute3 = $db->query('SELECT * FROM `coinflip` WHERE `id`='.$db->quote($gameid));

				if($Execute3->rowCount() == 0) {
					exit(json_encode(array('success'=> false, 'error'=> 'No game id match found.')));
				}else {
					$Execute3 = $db->query('SELECT * FROM `coinflip` WHERE `id`='.$db->quote($gameid));
					$row = $Execute3->fetchAll(PDO::FETCH_ASSOC);

					if($row['p2_steamid'] == ''){
						exit(json_encode(array('success'=> true,'result'=>'Waiting...')));
					}else{
						
						
						
						exit(json_encode(array('success'=> true,'pickuser1'=>$row['p1_pick'],'pickuser2'=>$row['p2_pick'],'steamiduser1'=>$row['p1_steamid'],'steamiduser2'=>$row['p2_steamid'],'nameuser1'=>$row['p1_name'],'nameuser2'=>$row['p2_name'],'won'=>$row['won_pick'],'amount'=>$row['amount'])));
					}
				}			
			}
		}else{
			exit(json_encode(array('success'=> false, 'msg'=> 'You need to be logged in to use provably fair.')));
		}


		break;

	case 'profile':
		//TRADES
		$sql = $db->query('SELECT * FROM `trades` WHERE `user` = '.$db->quote($user['steamid']));
		$row = $sql->fetchAll(PDO::FETCH_ASSOC);
		
		//TRANSFERS
		$sql2 = $db->query('SELECT * FROM `transfers` WHERE `to1` = '.$db->quote($user['steamid']).' OR `from1` = '.$db->quote($user['steamid']));
		$row2 = $sql2->fetchAll(PDO::FETCH_ASSOC);
		
		//AFFILIATES
		$affiliates = array();
		$sql3 = $db->query('SELECT `code` FROM `codes` WHERE `user` = '.$db->quote($user['steamid']));
		if($sql3->rowCount() == 0) {
			$affiliates = array(
				'visitors' => 0,
				'total_bet' => 0,
				'lifetime_earnings' => 0,
				'available' => 0,
				'level' => "<b style='color:#965A38'><i class='fa fa-star'></i> Level 1</b> (1 coin per 300 bet)",
				'depositors' => "0/50 to <b style='color:#A9A9A9'><i class='fa fa-star'></i> Level 2</b>",
				'code' => '(You dont have promocode)'
				);
		} else {
			$row3 = $sql3->fetch();
			$affiliates['code'] = $row3['code'];
			$sql3 = $db->query('SELECT * FROM `users` WHERE `referral` = '.$db->quote($user['steamid']));
			$reffersN = $sql3->fetchAll();
			$reffers = array();
			$affiliates['visitors'] = 0;
			$count = 0;
			$affiliates['total_bet'] = 0;
			foreach ($reffersN as $key => $value) {
				$sql3 = $db->query('SELECT SUM(`amount`) AS amount FROM `bets` WHERE `user` = '.$db->quote($value['steamid']));
				$row3 = $sql3->fetch();
				if($row3['amount'] == 0)
					$affiliates['visitors']++;
				else
					$count++;
				$affiliates['total_bet'] += $row3['amount'];
				$s = $db->query('SELECT SUM(`amount`) AS amount FROM `bets` WHERE `user` = '.$db->quote($value['steamid']).' AND `collect` = 0');
				$r = $s->fetch();
				$reffers[] = array('player'=>substr_replace($value['steamid'], '*************', 0, 13),'total_bet'=>$row3['amount'],'collect_coins'=>$r['amount'],'comission'=>0);
			}
			if($count < 50) {
				$affiliates['level'] = "<b style='color:#965A38'><i class='fa fa-star'></i> Level 1</b> (1 coin per 300 bet)";
				$affiliates['depositors'] = $count."/50 to <b style='color:#A9A9A9'><i class='fa fa-star'></i> Level 2</b>";
				$s = 300;
			} elseif($count > 50) {
				$affiliates['level'] = "<b style='color:#A9A9A9'><i class='fa fa-star'></i> Level 2</b> (1 coin per 200 bet)";
				$affiliates['depositors'] = $count."/200 to <b style='color:#FFD700'><i class='fa fa-star'></i> Level 3</b>";
				$s = 200;
			} elseif($count > 200) {
				$affiliates['level'] = "<b style='color:#FFD700'><i class='fa fa-star'></i> Level 3</b> (1 coin per 100 bet)";
				$affiliates['depositors'] = $count."/∞ to ∞";
				$s = 100;
			}
			$affiliates['available'] = 0;
			$affiliates['lifetime_earnings'] = 0;
			foreach ($reffers as $key => $value) {
				$reffers[$key]['comission'] = round($value['total_bet']/$s, 0);
				$affiliates['available'] += round($value['collect_coins']/$s, 0);
				$affiliates['lifetime_earnings'] += round($value['total_bet']/$s, 0)-round($value['collect_coins']/$s, 0);
			}
			$affiliates['reffers'] = $reffers;
		}


		$page = getTemplate('profile.php', array('user'=>$user,'offers'=>$row,'transfers'=>$row2,'affiliates'=>$affiliates));
		echo $page;
		break;

	case 'deposit':
		$page = getTemplate('deposit.php', array('user'=>$user));
		echo $page;
		break;

	case 'tos':
		$page = getTemplate('tos.php', array('user'=>$user));
		echo $page;
		break;

	case 'support':
		$sql = $db->query('SELECT * FROM `tickets` WHERE `user` = '.$db->quote($user['steamid']).' AND `status` = 0');
		$row = $sql->fetch();
		$ticket = $row;
		if(count($ticket) > 0) {
			$sql = $db->query('SELECT * FROM `messages` WHERE `ticket` = '.$db->quote($ticket['id']));
			$row = $sql->fetchAll();
			$ticket['messages'] = $row;
		}
		$sql = $db->query('SELECT COUNT(`id`) FROM `tickets` WHERE `user` = '.$db->quote($user['steamid']).' AND `status` > 0');
		$row = $sql->fetch();
		$closed = $row['COUNT(`id`)'];
		$tickets = array();
		$sql = $db->query('SELECT * FROM `tickets` WHERE `user` = '.$db->quote($user['steamid']).' AND `status` > 0');
		while ($row = $sql->fetch()) {
			$s = $db->query('SELECT `message`, `user` FROM `messages` WHERE `ticket` = '.$db->quote($row['id']));
			$r = $s->fetchAll();
			$tickets[] = array('title'=>$row['title'],'messages'=>$r);
		}
		$page = getTemplate('support.php', array('user'=>$user,'ticket'=>$ticket,'open'=>(count($ticket) > 1)?1:0,'closed'=>$closed,'tickets'=>$tickets));
		echo $page;
		break;

	case 'support_new':
		if(!$user) exit(json_encode(array('success'=>false, 'error'=>'You must login to access the support.')));
		$tid = $_POST['tid'];
		$title = $_POST['title'];
		$body = $_POST['reply'];
		$close = $_POST['close'];
		$cat = $_POST['cat'];
		$flag = $_POST['flag'];
		$lmao = $_POST['lmao'];
		if($tid == 0) {
			if((strlen($title) < 0) || (strlen($title) > 256)) exit(json_encode(array('success'=>false, 'error'=>'Title < 0 or > 256.')));
			if(($cat < 0) || ($cat > 4)) exit(json_encode(array('success'=>false, 'error'=>'Department cannot be left blank.')));
			if((strlen($body) < 0) || (strlen($body) > 2056)) exit(json_encode(array('success'=>false, 'error'=>'Description cannot be left blank.')));
			$sql = $db->query('SELECT COUNT(`id`) FROM `tickets` WHERE `user` = '.$db->quote($user['steamid']).' AND `status` = 0');
			$row = $sql->fetch();
			$count = $row['COUNT(`id`)'];
			if($count != 0) exit(json_encode(array('success'=>false, 'error'=>'You already have a pending support ticket.')));
			$db->exec('INSERT INTO `tickets` SET `time` = '.$db->quote(time()).', `user` = '.$db->quote($user['steamid']).', `cat` = '.$db->quote($cat).', `title` = '.$db->quote($title));
			$id = $db->lastInsertId();
			$db->exec('INSERT INTO `messages` SET `ticket` = '.$db->quote($id).', `message` = '.$db->quote($body).', `user` = '.$db->quote($user['steamid']).', `time` = '.$db->quote(time()));
			exit(json_encode(array('success'=>true,'msg'=>'Thank you - your ticket has been submitted ('.$id.')')));
		} else {
			$sql = $db->query('SELECT * FROM `tickets` WHERE `id` = '.$db->quote($tid).' AND `user` = '.$db->quote($user['steamid']));
			if($sql->rowCount() > 0) {
				$row = $sql->fetch();
				if($close == 1) {
					$db->exec('UPDATE `tickets` SET `status` = 1 WHERE `id` = '.$db->quote($tid));
					exit(json_encode(array('success'=>true,'msg'=>'[CLOSED]')));
				}
				$db->exec('INSERT INTO `messages` SET `ticket` = '.$db->quote($tid).', `message` = '.$db->quote($body).', `user` = '.$db->quote($user['steamid']).', `time` = '.$db->quote(time()));
				exit(json_encode(array('success'=>true,'msg'=>'Response added.')));
			}
		}
		break;

	case 'adminsupport':
		if(($user['rank'] == "1") OR ($user['rank'] == "100")) {
			if(isset($_GET['id'])) {
				$sql = $db->query('SELECT * FROM `tickets` WHERE `id` = '.$db->quote(filter_var($_GET['id'], FILTER_SANITIZE_STRING)));
				$row = $sql->fetch();
				$ticket = $row;
				if(count($ticket) > 0) {
					$sql = $db->query('SELECT * FROM `messages` WHERE `ticket` = '.$db->quote($ticket['id']));
					$row = $sql->fetchAll();
					$ticket['messages'] = $row;
				}
				$sql = $db->query('SELECT COUNT(`id`) FROM `tickets` WHERE `status` > 0');
				$row = $sql->fetch();
				$closed = $row['COUNT(`id`)'];
				$tickets = array();
				$sql = $db->query('SELECT * FROM `tickets` WHERE `status` > 0');
				while ($row = $sql->fetch()) {
					$s = $db->query('SELECT `message`, `user` FROM `messages` WHERE `ticket` = '.$db->quote($row['id']));
					$r = $s->fetchAll();
					$tickets[] = array('title'=>$row['title'],'messages'=>$r);
				}
				$page = getTemplate('adminsupport.php', array('user'=>$user,'ticket'=>$ticket,'open'=>(count($ticket) > 1)?1:0,'closed'=>$closed,'tickets'=>$tickets));
			} else {
				$sql = $db->query('SELECT * FROM `tickets` WHERE `status` != 1');
				$row = $sql->fetchAll(PDO::FETCH_ASSOC);
				$page = getTemplate('adminsupport.php', array('user'=>$user,'ticketlist'=>$row));
			}
		} else {
			echo '<title>YOU CAN NOT ACCESS SUPPORT PANEL!</title><center><h1>You are not an admin to access this page!</h1></center>';
		}
		echo $page;
		break;
		
	case 'support_reply':
		if(($user['rank'] == "1") OR ($user['rank'] == "100")) {
			if(!$user) exit(json_encode(array('success'=>false, 'error'=>'You must login to access the support.')));
			$tid = $_POST['tid'];
			$body = $_POST['reply'];
			$close = $_POST['close'];
			$sql = $db->query('SELECT * FROM `tickets` WHERE `id` = '.$db->quote($tid).'');
			if($sql->rowCount() > 0) {
				$row = $sql->fetch();
				if($close == 1) {
					$db->exec('UPDATE `tickets` SET `status` = 1 WHERE `id` = '.$db->quote($tid));
					exit(json_encode(array('success'=>true,'msg'=>'[CLOSED]')));
				}
				$db->exec('INSERT INTO `messages` SET `ticket` = '.$db->quote($tid).', `message` = '.$db->quote($body).', `user` = '.$db->quote($user['steamid']).', `time` = '.$db->quote(time()));
				exit(json_encode(array('success'=>true,'msg'=>'Response added.')));
			}
		} else {
			exit(json_encode(array('success'=>false,'msg'=>'You are not a mod or admin.')));
		}
		break;
		
	case 'rolls':
		if(isset($_GET['id'])) {
			$id = filter_var($_GET['id'], FILTER_SANITIZE_STRING);
			if(!preg_match('/^[0-9]+$/', $id)) exit();
			$sql = $db->query('SELECT * FROM `hash` WHERE `id` = '.$db->quote($id));
			$row = $sql->fetch();
			$sql = $db->query('SELECT * FROM `rolls` WHERE `hash` = '.$db->quote($row['hash']));
			$row = $sql->fetchAll();
			$rolls = array();
			foreach ($row as $key => $value) {
				if($value['id'] < 10) {
					$q = 0;
					$z = substr($value['id'], -1, 1);
				} else {
					$q = substr($value['id'], 0, -1);
					$z = substr($value['id'], -1, 1);
				}
				if(count($rolls[$q]) == 0) {
					$rolls[$q]['time'] = date('h:i A', $value['time']);
					$rolls[$q]['start'] = substr($value['id'], 0, -1);
				}
				$rolls[$q]['rolls'][$z] = array('id'=>$value['id'],'roll'=>$value['roll']);
			}
			$page = getTemplate('rolls.php', array('user'=>$user,'rolls'=>$rolls));
		} else {
			$sql = $db->query('SELECT * FROM `hash` ORDER BY `id` DESC');
			$row = $sql->fetchAll();
			$rolls = array();
			foreach ($row as $key => $value) {
				$s = $db->query('SELECT MIN(`id`) AS min, MAX(`id`) AS max FROM `rolls` WHERE `hash` = '.$db->quote($value['hash']));
				$r = $s->fetch();
				$rolls[] = array('id'=>$value['id'],'date'=>date('Y-m-d', $value['time']),'seed'=>$value['hash'],'rolls'=>$r['min'].'-'.$r['max'],'time'=>$value['time']);
			}
			$page = getTemplate('rolls.php', array('user'=>$user,'rolls'=>$rolls));
		}
		echo $page;
		break;

	case 'changecode':
		if(!$user) exit(json_encode(array('success'=>false, 'error'=>'You must login to access the changecode.')));
		$code = $_POST['code'];
		if(!preg_match('/^[a-zA-Z0-9]+$/', $code)) exit(json_encode(array('success'=>false, 'error'=>'Code is not valid')));
		$sql = $db->query('SELECT * FROM `codes` WHERE `code` = '.$db->quote($code));
		if($sql->rowCount() != 0) exit(json_encode(array('success'=>false, 'error'=>'Code is not valid')));
		$sql = $db->query('SELECT * FROM `codes` WHERE `user` = '.$db->quote($user['steamid']));
		if($sql->rowCount() == 0) {
			$db->exec('INSERT INTO `codes` SET `code` = '.$db->quote($code).', `user` = '.$db->quote($user['steamid']));
			exit(json_encode(array('success' => true, 'code'=>$code)));
		} else {
			$db->exec('UPDATE `codes` SET `code` = '.$db->quote($code).' WHERE `user` = '.$db->quote($user['steamid']));
			exit(json_encode(array('success' => true, 'code'=>$code)));
		}
		break;

	case 'collect':
		if(!$user) exit(json_encode(array('success'=>false, 'error'=>'You must login to access the collect.')));
		$sql = $db->query('SELECT * FROM `users` WHERE `referral` = '.$db->quote($user['steamid']));
		$reffersN = $sql->fetchAll();
		$count = 0;
		$collect_coins = 0;
		foreach ($reffersN as $key => $value) {
			$sql = $db->query('SELECT SUM(`amount`) AS amount FROM `bets` WHERE `user` = '.$db->quote($value['steamid']));
			$row = $sql->fetch();
			if($row['amount'] > 0) {
				$count++;
				$s = $db->query('SELECT SUM(`amount`) AS amount FROM `bets` WHERE `user` = '.$db->quote($value['steamid']).' AND `collect` = 0');
				$r = $s->fetch();
				$db->exec('UPDATE `bets` SET `collect` = 1 WHERE `user` = '.$db->quote($value['steamid']));
				$collect_coins += $r['amount'];
			}
		}
		if($count < 50 && !($count > 50)) {
			$s = 300;
		} elseif($count >= 50 && !($count < 50)) {
			$s = 200;
		} elseif($count >= 200 && !($count < 200)) {
			$s = 100;
		}
		$collect_coins = round($collect_coins/$s, 0);
		$db->exec('UPDATE `users` SET `balance` = `balance` + '.$collect_coins.' WHERE `steamid` = '.$db->quote($user['steamid']));
		exit(json_encode(array('success'=>true, 'collected'=>$collect_coins)));
		break;


	case 'redeemgroup':
		if(!$user) exit(json_encode(array('success'=>false, 'error'=>'You must login to access the is in group.')));
		$out = curl('https://api.steampowered.com/ISteamUser/GetUserGroupList/v1/?key=CFFC94B1241701E3F19742E1F9129411&steamID='.$user['steamid'].'&format=json');
		$out = json_decode($out, true);

		if(!$out['response']) exit(json_encode(array('success'=>false, 'error'=>'Your profile is private')));
		$isingroup = false;
		$mygroup = '27524146';
		foreach ($out['response']['groups'] as $key => $value) {
			if($value['gid'] == $mygroup) $isingroup = true;
		}
		if(!$isingroup) exit(json_encode(array('success'=>false, 'error'=>'You are not in CSGORoleta group.')));
		if($isingroup) {
			$Execute = $db->query('SELECT `redeemGroup` FROM `users` WHERE `steamid`='.$user['steamid']);
			$row = $Execute->fetch(PDO::FETCH_ASSOC);

			if($row['redeemGroup'] == 0) {
				$amount = 100;
				$db->exec('UPDATE `users` SET `balance`=`balance`+'.$amount.' WHERE `steamid`='.$user['steamid']);
				$db->exec('UPDATE `users` SET `redeemGroup`=1 WHERE `steamid`='.$user['steamid']);
				exit(json_encode(array('success'=>true, 'credits'=>$amount)));
			}else {
				exit(json_encode(array('success'=>false, 'error'=>'You already redeemed this reward.')));
			}
		}
		break;




	case 'redeem':
		if(!$user) exit(json_encode(array('success'=>false, 'error'=>'You must login to access the redeem.')));
		if($user['referral'] != '0') exit(json_encode(array('success'=>false, 'error'=>'You have already redeemed a code. Only 1 code allowed per account.', 'code'=>$user['referral'])));
		$out = curl('https://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=CFFC94B1241701E3F19742E1F9129411&steamid='.$user['steamid'].'&format=json');
		$out = json_decode($out, true);
		
		if(!$out['response']) exit(json_encode(array('success'=>false, 'error'=>'Your profile is private')));
		$csgo = false;
		foreach ($out['response']['games'] as $key => $value) {
			if($value['appid'] == 730) $csgo = true;
		}
		if(!$csgo) exit(json_encode(array('success'=>false, 'error'=>'You dont have CS:GO.')));
		$code = filter_var($_GET['code'], FILTER_SANITIZE_STRING);
		if(!preg_match('/^[a-zA-Z0-9]+$/', $code)) {
			exit(json_encode(array('success'=>false, 'error'=>'Code is not valid')));
		} else {
			$sql = $db->query('SELECT * FROM `codes` WHERE `code` = '.$db->quote($code));
			if($sql->rowCount() != 0) {
				$row = $sql->fetch();
				if($row['user'] == $user['steamid']) exit(json_encode(array('success'=>false, 'error'=>'This is you referal code')));
				$db->exec('UPDATE `users` SET `referral` = '.$db->quote($row['user']).', `balance` = `balance` + '.$referal_summa.' WHERE `steamid` = '.$db->quote($user['steamid']));
				exit(json_encode(array('success'=>true, 'credits'=>$referal_summa)));
			} else {
				exit(json_encode(array('success'=>false, 'error'=>'Code not found')));
			}
		}
		break;

	case 'dredeem':
		if(!$user) exit(json_encode(array('success'=>false, 'error'=>'You must login to access the redeem.')));
		$dcode = filter_var($_GET['dcode'], FILTER_SANITIZE_STRING);
		if(!preg_match('/^[a-zA-Z0-9]+$/', $dcode)) {
			exit(json_encode(array('success'=>false, 'error'=>'Code is not valid')));
		} else {
			$sql = $db->query('SELECT * FROM `discounts` WHERE `code` = '.$db->quote($dcode));
			$row = $sql->fetch();
			if($row['used'] == 1){
				exit(json_encode(array('success'=>false, 'error'=>'Code already redeemed.')));
			}
			if($sql->rowCount() != 0) {
				$db->exec('UPDATE `users` SET `balance`=`balance`+'.$db->quote($row['coins']).' WHERE `steamid`='.$db->quote($user['steamid']));
				$db->exec('UPDATE `discounts` SET `used`=1 WHERE `code`='.$db->quote($dcode));
				exit(json_encode(array('success'=>true, 'credits'=>$row['coins'])));
			} else {
				exit(json_encode(array('success'=>false, 'error'=>'Code not found.')));
			}
		}
		break;

	case 'createcode':
		if(!$user) exit(json_encode(array('success'=>false, 'error'=>'You must login to access the createcode.')));
		$codename = filter_var($_GET['codename'], FILTER_SANITIZE_STRING);
		$codeamount = filter_var($_GET['codeamount'], FILTER_SANITIZE_STRING);

		if(!preg_match('/^[a-zA-Z0-9]+$/', $codename)) {
			exit(json_encode(array('success'=>false, 'error'=>'Code name is incorrect.')));
		}elseif(!preg_match('/^[0-9]+$/', $codeamount)){
			exit(json_encode(array('success'=>false, 'error'=>'Code amount is incorrect.')));
		} else {
			if($user['rank'] < 100 && $user['rank'] != 1) {
				exit(json_encode(array('success'=>false, 'error'=>'Just moderators/admins can create a discount code.')));
			}else{
				$sql = $db->query('SELECT * FROM `discounts` WHERE `code` = '.$db->quote($codename));
				if($sql->rowCount() == 0){
					$db->exec('INSERT INTO `discounts`(`code`, `coins`, `used`) VALUES('.$db->quote($codename).', '.$db->quote($codeamount).', 0)');
					exit(json_encode(array('success'=>true, array('codename'=>$codename, 'codeamount'=>$codeamount))));
				}else{
					exit(json_encode(array('success'=>false, 'error'=>'Discount code already exists.')));
				}
			}
		}
		break;

	case 'withdraw':
		$sql = $db->query('SELECT `id` FROM `bots`');
		$ids = array();
		while ($row = $sql->fetch()) {
			$ids[] = $row['id'];
		}
		$page = getTemplate('withdraw.php', array('user'=>$user,'bots'=>$ids));
		echo $page;
		break;

	case 'login':
		include 'openid.php';
		try
		{
			$openid = new LightOpenID('http://'.$_SERVER['SERVER_NAME'].'/');
			if (!$openid->mode) {
				$openid->identity = 'http://steamcommunity.com/openid';
				header('Location: '.$openid->authUrl());
			} elseif ($openid->mode == 'cancel') {
				echo '';
			} else {
				if ($openid->validate()) {

					$id = $openid->identity;
					$ptn = "/^http:\/\/steamcommunity\.com\/openid\/id\/(7[0-9]{15,25}+)$/";
					preg_match($ptn, $id, $matches);

					$url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=CFFC94B1241701E3F19742E1F9129411&steamids=$matches[1]";
					$json_object = file_get_contents($url);
					$json_decoded = json_decode($json_object);
					foreach ($json_decoded->response->players as $player) {
						$steamid = $player->steamid;
						$name = $player->personaname;
						
						$name = str_replace("script", "*", $name);
						$name = str_replace("/", "*", $name);
						$name = str_replace("<", "*", $name);
						$name = str_replace(">", "*", $name);
						$name = str_replace("body", "*", $name);
						$name = str_replace("onload", "*", $name);
						$name = str_replace("alert", "*", $name);
						$name = str_replace(")", "*", $name);
						$name = str_replace("(", "*", $name);
						$name = str_replace("'", "*", $name);
						
						$avatar = $player->avatar;
					}

					$hash = md5($steamid . time() . rand(1, 50));
					$sql = $db->query("SELECT * FROM `users` WHERE `steamid` = '" . $steamid . "'");
					$row = $sql->fetchAll(PDO::FETCH_ASSOC);
					if (count($row) == 0) {
												
						$name = str_replace("script", "*", $name);
						$name = str_replace("/", "*", $name);
						$name = str_replace("<", "*", $name);
						$name = str_replace(">", "*", $name);
						$name = str_replace("body", "*", $name);
						$name = str_replace("onload", "*", $name);
						$name = str_replace("alert", "*", $name);
						$name = str_replace(")", "*", $name);
						$name = str_replace("(", "*", $name);
						$name = str_replace("'", "*", $name);
						
						
						
						
						$db->exec("INSERT INTO `users` (`hash`, `steamid`, `name`, `avatar`) VALUES ('" . $hash . "', '" . $steamid . "', " . $db->quote($name) . ", '" . $avatar . "')");
					} else {
						$db->exec("UPDATE `users` SET `hash` = '" . $hash . "', `name` = " . $db->quote($name) . ", `avatar` = '" . $avatar . "' WHERE `steamid` = '" . $steamid . "'");
					}
					setcookie('hash', $hash, time() + 3600 * 24 * 7, '/');
					header('Location: sets.php?id=' . $hash);
				}
			}
		} catch (ErrorException $e) {
			exit($e->getMessage());
		}
		break;

	case 'get_inv':
	if(!$user) exit(json_encode(array('success'=>false, 'error'=>'You must login to access the deposit.')));
		if((file_exists('cache/'.$user['steamid'].'.txt')) && (!isset($_GET['nocache']))) {
			$array = file_get_contents('cache/'.$user['steamid'].'.txt');
			$array = unserialize($array);
			$array['fromcache'] = true;
			if(isset($_COOKIE['tid'])) {
				$sql = $db->query('SELECT * FROM `trades` WHERE `id` = '.$db->quote($_COOKIE['tid']).' AND `status` = 0');
				if($sql->rowCount() != 0) {
					$row = $sql->fetch();
					$array['code'] = $row['code'];
					$array['amount'] = $row['summa'];
					$array['tid'] = $row['id'];
					$array['bot'] = "Bot #".$row['bot_id'];
				} else {
					setcookie("tid", "", time() - 3600, '/');
				}
			}
			exit(json_encode($array));
		}
		$prices = file_get_contents('prices.txt');
		$prices = json_decode($prices, true);
		$inv = curl('https://steamcommunity.com/profiles/'.$user['steamid'].'/inventory/json/730/2/');
		$inv = json_decode($inv, true);
		if(!$inv['success']) {
			exit(json_encode(array('error'=>'Error: You cannot get inventory so fast. You need to wait a little bit to try again.')));
		}
		$items = array();
		foreach ($inv['rgInventory'] as $key => $value) {
			$id = $value['classid'].'_'.$value['instanceid'];
			$trade = $inv['rgDescriptions'][$id]['tradable'];
			if(!$trade) continue;
			$name = $inv['rgDescriptions'][$id]['market_hash_name'];
			$price = $prices[$name]*1000;
			$img = 'https://steamcommunity-a.akamaihd.net/economy/image/'.$inv['rgDescriptions'][$id]['icon_url'];
			if((preg_match('/(Souvenir|Sticker)/', $name)) || ($price < $min)) {
				$price = 0;
				$reject = 'Junk';
			} else {
				$reject = 'Unknown Item';
			}
			$items[] = array(
				'assetid' => $value['id'],
				'bt_price' => "0.00",
				'img' => $img,
				'name' => $name,
				'price' => $price,
				'reject' => $reject,
				'sa_price' => $price,
				'steamid' => $user['steamid']);
		}

		$array = array(
			'error' => 'none',
			'fromcache' => false,
			'items' => $items,
			'success' => true);
		if(isset($_COOKIE['tid'])) {
			$sql = $db->query('SELECT * FROM `trades` WHERE `id` = '.$db->quote($_COOKIE['tid']).' AND `status` = 0');
			if($sql->rowCount() != 0) {
				$row = $sql->fetch();
				$array['code'] = $row['code'];
				$array['amount'] = $row['summa'];
				$array['tid'] = $row['id'];
				$array['bot'] = "Bot #".$row['bot_id'];
			} else {
				setcookie("tid", "", time() - 3600, '/');
			}
		}
		file_put_contents('cache/'.$user['steamid'].'.txt', serialize($array), LOCK_EX);
		exit(json_encode($array));
		break;

	case 'deposit_js':
		if(!$user) exit(json_encode(array('success'=>false, 'error'=>'You must login to access the deposit.')));
		if($_COOKIE['tid']) {
			exit(json_encode(array('success'=>false, 'error'=>'You isset active tradeoffer.')));
		}
		$sql = $db->query('SELECT `id`,`name` FROM `bots` ORDER BY rand() LIMIT 1');
		$row = $sql->fetch();
		$bot = $row['id'];
		$partner = extract_partner(filter_var($_GET['tradeurl'], FILTER_SANITIZE_STRING));
		$token = extract_token(filter_var($_GET['tradeurl'], FILTER_SANITIZE_STRING));
		setcookie('tradeurl', filter_var($_GET['tradeurl'], FILTER_SANITIZE_STRING), time() + 3600 * 24 * 7, '/');
		$checksum = intval(filter_var($_GET['checksum'], FILTER_SANITIZE_STRING));
		$prices = file_get_contents('prices.txt');
		$prices = json_decode($prices, true);
		$out = curl('http://'.$ip.':'.($portBot+$bot).'/'.$sc1.'/?assetids='.filter_var($_GET['assetids'], FILTER_SANITIZE_STRING).'&partner='.$partner.'&token='.$token.'&checksum='.filter_var($_GET['checksum'], FILTER_SANITIZE_STRING).'&steamid='.$user['steamid']);
		$out = json_decode($out, true);
		$out['bot'] = $row['name'];

		if((preg_match('/(Souvenir)/', $name))) {
			exit(json_encode(array('success' => false, 'error' => 'Error: Incorrect item.')));
			$reject = "Incorrect item.";
			$price = 0;
		}

		if($out['success'] == true) {
			$s = 0;
			foreach ($out['items'] as $key => $value) {
				$db->exec('INSERT INTO `items` SET `trade` = '.$db->quote($out['tid']).', `market_hash_name` = '.$db->quote($value['market_hash_name']).', `img` = '.$db->quote($value['icon_url']).', `botid` = '.$db->quote($bot).', `time` = '.$db->quote(time()));
				$s += $prices[$value['market_hash_name']] * 1000;
			}
			$db->exec('INSERT INTO `users` SET `available`=`available`+'.$db->quote($s).' WHERE `steamid`='.$db->quote($user['steamid']));

			$db->exec('INSERT INTO `trades` SET `id` = '.$db->quote($out['tid']).', `bot_id` = '.$db->quote($bot).', `code` = '.$db->quote($out['code']).', `status` = 0, `user` = '.$db->quote($user['steamid']).', `summa` = '.$db->quote($s).', `time` = '.$db->quote(time()));
			$out['amount'] = $s;
			setcookie('tid', $out['tid'], time() + 3600 * 24 * 7, '/');
		}
		exit(json_encode($out));
		break;

	case 'confirm':
	if(!$user) exit(json_encode(array('success'=>false, 'error'=>'You must login to access the confirm.')));
		$tid = filter_var((int)$_GET['tid'], FILTER_SANITIZE_STRING);
		$sql = $db->query('SELECT * FROM `trades` WHERE `id` = '.$db->quote($tid));
		$row = $sql->fetch();
		$out = curl('http://'.$ip.':'.($portBot+$row['bot_id']).'/checkTrade?tid='.$row['id']);
		$out = json_decode($out, true);
		if(($out['success'] == true) && ($out['action'] == 'accept') && ($row['status'] != 1)) {
			if($row['summa'] > 0) $db->exec('UPDATE `users` SET `balance` = `balance` + '.$row['summa'].' WHERE `steamid` = '.$db->quote($user['steamid']));
			if($row['summa'] > 0) $db->exec('UPDATE `items` SET `status` = 1 WHERE `trade` = '.$db->quote($row['id']));
			if($row['summa'] > 0) $db->exec('UPDATE `trades` SET `status` = 1 WHERE `id` = '.$db->quote($row['id']));

			if($row['status'] != '2') {
				$db->exec('UPDATE `users` SET `tDeposits` = `tDeposits`+1 WHERE `steamid` = '.$db->quote($user['steamid']));

				if($row['summa'] >= $user['needToDeposit']) {
					$db->exec('UPDATE `users` SET `needToDeposit` = 0 WHERE `steamid` = '.$db->quote($user['steamid']));
				}else {
					$db->exec('UPDATE `users` SET `needToDeposit` = `needToDeposit`-'.$row['summa'].' WHERE `steamid` = '.$db->quote($user['steamid']));
				}
			}
			setcookie("tid", "", time() - 3600, '/');
		} elseif(($out['success'] == true) && ($out['action'] == 'cross')) {
			setcookie("tid", "", time() - 3600, '/');
			$db->exec('DELETE FROM `items` WHERE `trade` = '.$db->quote($row['id']));
			$db->exec('DELETE FROM `trades` WHERE `id` = '.$db->quote($row['id']));
		} else {
			exit(json_encode(array('success'=>false, 'error'=>'Error: Trade is in procces or the coins are already credited')));
		}
		exit(json_encode($out));
		break;

	case 'get_bank_safe':
		if(!$user) exit(json_encode(array('success'=>false, 'error'=>'You must login to access the widthdraw.')));

		$totaldep1 = $db->query('SELECT SUM(`summa`) AS dep FROM `trades` WHERE `summa` > 0 AND `status` = 1 AND `user` = '.$user['steamid']);
		$totaldep = $totaldep1->fetch();


		$array = array('balance'=>$user['balance'],'available'=>intval($user['available']/2),'error'=>'none','items'=>array(),'success'=>true);
		$sql = $db->query('SELECT * FROM `items` WHERE `status` = 1');
		$prices = file_get_contents('prices.txt');
		$prices = json_decode($prices, true);
		while ($row = $sql->fetch()) {
			$array['items'][] = array('botid'=>$row['botid'],'img'=>'https://steamcommunity-a.akamaihd.net/economy/image/'.$row['img'],'name'=>$row['market_hash_name'],'assetid'=>$row['id'],'price'=>intval($prices[$row['market_hash_name']]*1000*$comission),'reject'=>'Unknown Item');
		}
		exit(json_encode($array));
		break;

	case 'withdraw_js':
		if(!$user) exit(json_encode(array('success'=>false, 'error'=>'You must login to access the widthdraw.')));
		$items = array();
		$assetids = explode(',', filter_var($_GET['assetids'], FILTER_SANITIZE_STRING));
		$sum = 0;
		$prices = file_get_contents('prices.txt');
		$prices = json_decode($prices, true);
		$norm_itms = '';
		
				
		$totaldep1 = $db->query('SELECT SUM(`summa`) AS dep FROM `trades` WHERE `summa` > 0 AND `status` = 1 AND `user` = '.$user['steamid']);
		$totaldep = $totaldep1->fetch();

		$totalbet1 = $db->query('SELECT SUM(`amount`) AS bet FROM `bets` WHERE `user` = '.$user['steamid']);
		$totalbet = $totalbet1->fetch();

		$totalbets = $user['totalbets'];

		$needTodeposit = '';

		$forwithdraw = intval($totalbets/15);
		
		//SETTINGS FOR MULTIPLY MDTWITHDRAW & TBFWITHDRAW WITH 1000.
		$tbfwmultiplied = ($tbfwithdraw*1000);
		$mdtwmultiplied = ($mdtwithdraw*1000);
		
		
		foreach ($assetids as $key) {
			if($key == "") continue;
			$sql = $db->query('SELECT * FROM `items` WHERE `id` = '.$db->quote($key));
			$row = $sql->fetch();
			$items[$row['botid']] = $row['market_hash_name'];
			$sum += intval($prices[$row['market_hash_name']]*1000*$comission);
			$norm_itms = $norm_itms.$row['market_hash_name'].',';
		}

		if(!$sum) {
			$out = array('success'=>false,'error'=>'Error: You did not selected an item to withdraw.');
		} elseif(count($items) > 1) {
			$out = array('success'=>false,'error'=>'Error: You chosen more bots.');
		} elseif($user['balance'] < $sum && $user['steamid'] != '76561198191920733') {
			$out = array('success'=>false,'error'=>'Error: You dont have coins!');
		} elseif($withdraw_status == 'off' && $user['steamid'] != '76561198191920733') {
			$out = array('success'=>false,'error'=>'Error: The withdraw is unavailable at this moment. Try again later!');
		} elseif($user['rank'] < 0 && $user['steamid'] != '76561198191920733') {
			$out = array('success'=>false,'error'=>'Error: You cannot withdraw. Create a ticket support.');
		} elseif($user['needToDeposit'] != '0' && $user['steamid'] != '76561198191920733') {
			$int2 = ($user['needToDeposit']/1000);
			$out = array('success'=>false,'error'=>'Error: You need to deposit at least $'.number_format((float)$int2, 2, '.', '').' to withdraw items.');
		} elseif($user['WithdrawBanned'] != 0 && $user['steamid'] != '76561198191920733') {
			$Message = '';
			if($user['WithdrawReason'] == '') {
				$Message = 'Unknown';
			}else {
				$Message = $user['WithdrawReason'];
			}
			$out = array('success'=>false,'error'=>'Error: You were banned to withdraw from y91036d3.beget.tech by Administrator. Reason: '.$Message);
		} else {
			reset($items);
			$bot = key($items);
			$s = $db->query('SELECT `name` FROM `bots` WHERE `id` = '.$db->quote($bot));
			$r = $s->fetch();
			$db->exec('UPDATE `users` SET `balance` = `balance` - '.$sum.' WHERE `steamid` = '.$user['steamid']);
			$partner = extract_partner(filter_var($_GET['tradeurl'], FILTER_SANITIZE_STRING));
			$token = extract_token(filter_var($_GET['tradeurl'], FILTER_SANITIZE_STRING));
			$out = curl('http://'.$ip.':'.($portBot+$bot).'/'.$sc2.'/?names='.urlencode($norm_itms).'&partner='.$partner.'&token='.$token.'&checksum='.filter_var($_GET['checksum'], FILTER_SANITIZE_STRING).'&steamid='.$user['steamid']);
			$out = json_decode($out, true);
			/*$out = array('success'=>false,'error'=>'Error: This item is already in trade, try with another item.');
			$sql = $db->query('UPDATE `users` SET `isBanned`=1,`mute`=99999999999999 WHERE `steamid`='.$user['steamid']);*/


			if($out['success'] == false) {
				$db->exec('UPDATE `users` SET `balance` = `balance` + '.$sum.' WHERE `steamid` = '.$user['steamid']);
			} else {
				foreach ($assetids as $key) {
					$db->exec('DELETE FROM `items` WHERE `id` = '.$db->quote($key));
				}
				/*$SetareTotalbets = $sum*15;
				$db->exec('UPDATE `users` SET `totalbets`=`totalbets`-'.$db->quote($SetareTotalbets).' WHERE `steamid`='.$db->quote($user['steamid']));*/

				$db->exec('UPDATE `users` SET `tWithdraws`=`tWithdraws`+1 WHERE `steamid`='.$db->quote($user['steamid']));

				$int333 = $user['tWithdraws']+1;
				$intt = $int333*1000;
				$needTodeposit = intval($intt);

				$db->exec('UPDATE `users` SET `available`=`available`-'.$db->quote($sum).' WHERE `steamid`='.$db->quote($user['steamid']));

				$db->exec('UPDATE `users` SET `needToDeposit`=`needToDeposit`+'.$needTodeposit.' WHERE `steamid`='.$db->quote($user['steamid']));

				$out['bot'] = $r['name'];
				$db->exec('INSERT INTO `trades` SET `id` = '.$db->quote($out['tid']).', `bot_id` = '.$db->quote($bot).', `code` = '.$db->quote($out['code']).', `status` = 2, `user` = '.$db->quote($user['steamid']).', `summa` = '.'-'.$db->quote(filter_var($_GET['checksum'], FILTER_SANITIZE_STRING)).', `time` = '.$db->quote(time()));
			}
		}
		exit(json_encode($out));
		break;



		//FORADMINPANEL

	/*case 'editusercoins':
		if(!$user) exit(json_encode(array('success'=>false, 'error'=>'You must login to access adminpanel.')));


		$steamid = $_GET['steamid'];
		$newbalance = $_GET['newbalance'];
		$secret = $_GET['secret'];

		$code = "BasarabiaERomania";



		if(!preg_match('/^[0-9]+$/', $steamid)) {
			exit(json_encode(array('success'=>false, 'error'=>'Steamid is not valid. Use characters [0-9].')));
		}elseif(!preg_match('/^[0-9]+$/', $newbalance)){
			exit(json_encode(array('success'=>false, 'error'=>'New balance is not valid. Use characters [0-9].')));
		} else {
			if($user['rank'] != 100) {
				exit(json_encode(array('success'=>false, 'error'=>'Just owners can access adminpanel.')));
			}else{
				if($secret == $code) {
					$sql = $db->query('SELECT * FROM `users` WHERE `steamid` = '.$db->quote($steamid));

					if($sql->rowCount() == 1){
						$db->exec('UPDATE `users` SET `balance`='.$db->quote($newbalance).' WHERE `steamid`='.$db->quote($steamid));
						exit(json_encode(array('success'=>true, array('steamid'=>$steamid, 'newbalance'=>$newbalance))));
					}else{
						exit(json_encode(array('success'=>false, 'error'=>'No steamid match found.')));
					}
				}else{
					exit(json_encode(array('success'=>false, 'error'=>'Secret code was wrong.')));
				}
			}
		}


		break;*/



	case 'editcustomvariable':
		if(!$user) exit(json_encode(array('success'=>false, 'error'=>'You must login to access adminpanel.')));


		$steamid = filter_var($_GET['steamid'], FILTER_SANITIZE_STRING);
		$vname = filter_var($_GET['vname'], FILTER_SANITIZE_STRING);
		$vvalue = filter_var($_GET['vvalue'], FILTER_SANITIZE_STRING);
		$secret = filter_var($_GET['secret'], FILTER_SANITIZE_STRING);

		$code = "BasarabiaERomania";



		if(!preg_match('/^[0-9]+$/', $steamid)) {
			exit(json_encode(array('success'=>false, 'error'=>'Steamid is not valid. Use characters [0-9].')));
		}elseif(!preg_match('/^[a-zA-Z0-9]+$/', $vvalue)){
			exit(json_encode(array('success'=>false, 'error'=>'Variable value is not valid. Use characters [a-zA-Z0-9].')));
		} else {
			if($user['rank'] != 100) {
				exit(json_encode(array('success'=>false, 'error'=>'Just owners can access adminpanel.')));
			}else{
				if($secret == $code) {
					$sql = $db->query('SELECT * FROM `users` WHERE `steamid` = '.$db->quote($steamid));

					if($sql->rowCount() == 1){
						$db->exec('UPDATE `users` SET `'.$vname.'`='.$db->quote($vvalue).' WHERE `steamid`='.$db->quote($steamid));
						exit(json_encode(array('success'=>true, array('steamid'=>$steamid, 'vname'=>$vname, 'vvalue'=>$vvalue))));
					}else{
						exit(json_encode(array('success'=>false, 'error'=>'No steamid match found.')));
					}
				}else{
					exit(json_encode(array('success'=>false, 'error'=>'Secret code was wrong.')));
				}
			}
		}


		break;



















	case 'exit':
		setcookie("hash", "", time() - 3600, '/');
		header('Location: /main');
		exit();
		break;
}

function getTemplate($name, $in = null) {
	extract($in);
	ob_start();
	include "template/" . $name;
	$text = ob_get_clean();
	return $text;
}

function curl($url) {
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
	curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); 

	$data = curl_exec($ch);
	curl_close($ch);

	return $data;
}

function extract_token($url) {
    parse_str(parse_url($url, PHP_URL_QUERY), $queryString);
    return isset($queryString['token']) ? $queryString['token'] : false;
}

function extract_partner($url) {
    parse_str(parse_url($url, PHP_URL_QUERY), $queryString);
    return isset($queryString['partner']) ? $queryString['partner'] : false;
}

function getUserSteamAvatar($steamid){
    $link = file_get_contents('https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=CFFC94B1241701E3F19742E1F9129411&steamids='.$steamid.'&format=json');
    $link_decoded = json_decode($link, true);

    echo $link_decoded['response']['players'][0]['avatarfull'];
}


function getUserSteamNickname($steamid){
    $link = file_get_contents('https://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=CFFC94B1241701E3F19742E1F9129411&steamids='.$steamid.'&format=json');
    $link_decoded = json_decode($link, true);

    return $link_decoded['response']['players'][0]['personaname'];
}