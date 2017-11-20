<!-- INCLUDE OF forpanel.JS -->
	<script src="/template/js/socket.io-1.4.5.js"></script>
	<?php include "Templates/Settings.php"; ?>
	<script type="text/javascript" src="/template/js/forpanel.js?v=<?=time()?>"></script>
<!-- INCLUDE OF forpanel.JS -->


<?php

	//SEARCH BUTTON
	include "Templates/Connection.php";

	function searchUser() {
		if(isset($_GET['search'])) {
			$searchq = $_GET['search'];
			$coded = '%'.$searchq.'%';

			$query = $db->query('SELECT * FROM `users` WHERE `steamid` LIKE '.$db->quote($coded).' OR `name` LIKE '.$db->quote($coded));
			if($query->rowCount() == 0) {
				$output = 'This name or steamid were not find.<br><input id="goBack" type="submit" value="Back">';
				echo $output;
			}else if($query->rowCount() > 1) {
				$output = 'There are too much results.<br><input id="goBack" type="submit" value="Back">';
				echo $output;
			}else {
				while($row = $query->fetch()) {
					$steamid = $row['steamid'];
					header('Location: /apanel?steamid='.$steamid);
				}
			}
		}
	}

	if(isset($_GET['search'])) {
		$searchq = $_GET['search'];
		$coded = '%'.$searchq.'%';

		$query = $db->query('SELECT * FROM `users` WHERE `steamid` LIKE '.$db->quote($coded).' OR `name` LIKE '.$db->quote($coded));
		if($query->rowCount() == 0) {
			$output = 'This name or steamid were not find.<br><input id="goBack" type="submit" value="Back">';
			echo $output;
		}else if($query->rowCount() > 1) {
			$output = 'There are too much results.<br><input id="goBack" type="submit" value="Back">';
			echo $output;
		}else {
			while($row = $query->fetch()) {
				$steamid = $row['steamid'];
				header('Location: /apanel?steamid='.$steamid);
			}
		}
	}
	//SEARCH BUTTON



	if(isset($_GET['steamid'])) {
		if($isUser == true) {
			echo '<center>';
			echo '<input id="goBack" type="submit" value="Voltar" /><br>';
			echo '<a id="button03" href="#" data-toggle="modal" data-target="#editUserVariable">Editar informações do usuário</a>';
			echo '<h3>STEAMID: '.$newuser['steamid'].'</h3>';
			echo '<h4><br>Jogador: <br><img class="rounded" src="'.$newuser['avatar'].'"> '.color($newuser['name'], 'red').'<br>';
			echo '<br>Rank: <br>'.setRank($newuser['rank']).' ('.$newuser['rank'].')<br>';
			echo '<br>Saldo: <br>'.color($newuser['balance'], 'red').'<br>';
			echo '<br>Total de Apostas: <br>'.color($newuser['totalbets'], 'red').'<br>';
			echo '<br>Disponível: <br>'.color($newuser['available'], 'red').'<br>';
			echo '<br>Total de Depositos: <br>'.color($newuser['tDeposits'], 'red').'<br>';
			echo '<br>Total de Retiradas: <br>'.color($newuser['tWithdraws'], 'red').'<br>';
			echo '<br>Pode enviar coins: <br>'.color($newuser['canSend'], 'red').'<br>';
			echo '<br>Verificado: <br>'.color($newuser['verify'], 'red').'<br>';
			echo '<br>Mutado: <br>'.color($newuser['mute'], 'red').'<br>';
			echo '<br>Banido de Retirada: <br>'.color($newuser['WithdrawBanned'], 'red').'<br>';
			echo '<br>Motivo: <br>'.color($newuser['WithdrawReason'], 'red').'<br>';
			echo '<br>Banido: <br>'.color($newuser['isBanned'], 'red').'<br>';
			echo '<br>Motivo: <br>'.color($newuser['ReasonBan'], 'red').'<br>';
			echo '<br>Rank: <br>'.color($newuser['rank'], 'red').'<br>';
			echo '</h4></center>';
		}else {
			echo '<center><h2>ESTE USUÁRIO NÃO EXISTE NO BANCO DE DADOS!</h2></center>';
		}
?>
		<div class="modal fade" id="editUserVariable">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><b>Edit User Variable</b></h4>
					</div>
					<div class="modal-body">
						<div class="btn-group" style="width:100%;">
							<button type="button" style="width:100%;outline:none;border:0;" class="btn2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="variableSelected" data-site="">Select variable:</span> <span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a href="#" style="color:#333333;" onclick="setVariableToEdit('name')">name</a></li>
								<li><a href="#" style="color:#333333;" onclick="setVariableToEdit('rank')">rank</a></li>
								<li><a href="#" style="color:#333333;" onclick="setVariableToEdit('balance')">balance</a></li>
								<li><a href="#" style="color:#333333;" onclick="setVariableToEdit('totalbets')">totalbets</a></li>
								<li><a href="#" style="color:#333333;" onclick="setVariableToEdit('available')">available</a></li>
								<li><a href="#" style="color:#333333;" onclick="setVariableToEdit('tDeposits')">tDeposits</a></li>
								<li><a href="#" style="color:#333333;" onclick="setVariableToEdit('tWithdraws')">tWithdraws</a></li>
								<li><a href="#" style="color:#333333;" onclick="setVariableToEdit('canSend')">Pode enviar trocas</a></li>
							</ul>
						</div>
						<br>
						<div class="form-group">
							<label for="exampleInputEmail1">New value:</label>
							<input type="text2" class="form-control" id="newVariable" value="">
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-success" onclick="editUser()">Edit User</button>
				</div>
			</div>
		</div>
<?php

	}else {

?>
	<style>
		input[type=text] {
		    width: 340px;
		    box-sizing: border-box;
		    border: 2px solid #ccc;
		    border-radius: 4px;
		    font-size: 16px;
		    background-color: white;
		    background-image: url('http://www.w3schools.com/howto/searchicon.png');
		    background-position: 10px 10px; 
		    background-repeat: no-repeat;
		    padding: 12px 20px 12px 40px;
		    -webkit-transition: width 0.4s ease-in-out;
		    transition: width 0.4s ease-in-out;
		}

		input[type=text]:focus {
		    width: 500px;
		}

		.dropdown-content {
		    position: center;
		    background-color: #4CAF50;
		    min-width: 160px;
		    max-width: 200px;
		    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
		}

		.dropbtn {
		    background-color: #4CAF50;
		    color: white;
		    padding: 16px;
		    font-size: 16px;
		    border: none;
		    position: center;
		    min-width: 160px;
		    max-width: 200px;
		    cursor: pointer;
		}
	</style>

	<center>
		<div id="Error"></div>


		<div class="dropbtn" id="selectFunction">
			<span href="#" style='color:red'>Select a function</span>
			<div id="optionsDrop" class="hidden">
				<div class="dropdown-content">
					<a id="button01" href="#">Search an user</a><br>
					<a id="button02" href="#" data-toggle="modal" data-target="#addItem">Add fake item to withdraw</a><br>
					<a id="button03" href="#" data-toggle="modal" data-target="#editBS">Edit status of bots</a><br>
				</div>
			</div>
		</div>



		<br>
		<br>
		<form id="search" class="hidden">
		  <input type="text" name="search" placeholder="Search a player via SteamID or name.." />
		  <input id="searchUser001" onclick="searchUser()" type="submit" value="Submit" />
		</form>
		<br>
		<div class="modal fade" id="addItem">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><b>Add Fake Items to Withdraw</b></h4>
					</div>
					<div class="modal-body">
						<div class="btn-group" style="width:100%;">
							<button type="button" style="width:100%;outline:none;border:0;" class="btn2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="fakeItem" data-site="">Fake item:</span> <span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a href="#" style="color:#333333;" onclick="selectItem('AWP Asiimov (BS)')">AWP Asiimov (BS)</a></li>
								<li><a href="#" style="color:#333333;" onclick="selectItem('AWP Asiimov (WW)')">AWP Asiimov (WW)</a></li>
								<li><a href="#" style="color:#333333;" onclick="selectItem('AWP Asiimov (FT)')">AWP Asiimov (FT)</a></li>
								<li><a href="#" style="color:#333333;" onclick="selectItem('AWP Asiimov (FT)')">AWP Asiimov (FT)</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-success" onclick="addItem()">Add Item</button>
				</div>
			</div>
		</div>

		<div class="modal fade" id="editBS">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title"><b>Edit Bot Status</b></h4>
					</div>
					<div class="modal-body">
						<div class="btn-group" style="width:100%;">
							<button type="button" style="width:100%;outline:none;border:0;" class="btn2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="botSts" data-site="">Bot status:</span> <span class="caret"></span>
							</button>
							<ul class="dropdown-menu">
								<li><a href="#" style="color:#333333;" onclick="editBotStatus('0')">Offline [0]</a></li>
								<li><a href="#" style="color:#333333;" onclick="editBotStatus('1')">Online [1]</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-success" onclick="editBots()">Edit Status</button>
				</div>
			</div>
		</div>
	</center>


<?php
}





	function color($something, $color) {
		return "<span style='color:".$color."'>".$something."</span>";
	}

	function goBack() {
		header('Location: /apanel');
	}

	function setRank($RRank) {
		if($RRank == 100) {
			return color('Owner', 'darkred');
		}else if($RRank == 0) {
			return color('Member', 'orange');
		}else if($RRank == 1) {
			return color('Moderator', 'blue');
		}else if($RRank == -1) {
			return color('Streamer', 'black');
		}else if($RRank == -2) {
			return color('Veteran', 'black');
		}else if($RRank == -3) {
			return color('Pro', 'black');
		}else if($RRank == -4) {
			return color('Youtuber', 'black');
		}else if($RRank == -5) {
			return color('Coder', 'black');
		}else if($RRank == -6) {
			return color('GFX', 'black');
		}
	}


?>


<script type="text/javascript">
var selectedItem = "";
var varSet;
var botStss;

$(document).ready(function() {
	connect();
	var $_GET = <?php echo json_encode($_GET); ?>;

	if($_GET['search']) {
		$('#selectFunction').addClass('hidden');
	}

	$('#goBack').click(function(){
		document.location.href = "/apanel";
	});

	$('#selectFunction').click(function(){
		if($('#optionsDrop').hasClass('hidden')) {
			$('#optionsDrop').removeClass('hidden');
		}else {
			$('#optionsDrop').addClass('hidden');
		}
	});

	$('#button01').click(function() {
		if($('#search').hasClass('hidden')) {
			$('#search').removeClass('hidden');
		}else {
			$('#search').addClass('hidden');
		}
	});

	$('#button02').click(function() {
		$('#search').addClass('hidden');
	});

	$('#searchUser001').click(function() {
		$('#selectFunction').addClass('hidden');
	});
});

function selectItem(item) {
	$('.fakeItem').text(item);

	if(item == "AWP Asiimov (BS)") {
		selectedItem = 'AWP Asiimov (BS)';
	}else if(item == "AWP Asiimov (WW)") {
		selectedItem = 'AWP Asiimov (WW)';
	}else if(item == "AWP Asiimov (FT)") {
		selectedItem = 'AWP Asiimov (FT)';
	}
}

function addItem() {
	var itemToAdd = selectedItem;

	$.ajax({
		url:"/addFakeItem?item="+itemToAdd,
		success:function(data){		
			try{
				data = JSON.parse(data);
				console.log(data);
				if(data.success){
					bootbox.alert("You have added a new fake item to withdraw: "+data.item);
				}else{
					bootbox.alert(data.error);
				}
			}catch(err){
				bootbox.alert("Javascript error: "+err);
			}
		},
		error:function(err){
			bootbox.alert("AJAX error: "+err);
		}
	});
}

function setVariableToEdit(variable) {
	varSet = variable;

	$('.variableSelected').text(varSet);
}

function editBotStatus(value) {
	$('.botSts').text(value);

	botStss = value;
}

function send(msg) {
	if (SOCKET) {
		SOCKET.emit('mes', msg);
	}
}

function editBots() {
	if(botStss == 0) {
		bootbox.alert('The bots are now offline!');
		send({
			'type': 'stopbots'
		});
	}else if(botStss == 1) {
		bootbox.alert('The bots are now online!');
		send({
			'type': 'startbots'
		});
	}

	if(!botStss) {
		bootbox.alert('You need to select a value of bots status!');
	}
}

function editUser() {
	var $_GET = <?php echo json_encode($_GET); ?>;

	var variable = varSet;
	var variable2 = $('#newVariable').val();

	var definedUser = $_GET['steamid'];

	console.log(variable + ' ' + variable2 + ' ' + definedUser);

	if(!definedUser) {
		bootbox.alert('Error: There is no user defined!');
		return;
	}else {
		if(variable2 && variable) {
			$.ajax({
				url:"/editUserVar?var="+variable+"&newvar="+variable2+"&user="+definedUser,
				success:function(data){		
					try{
						data = JSON.parse(data);
						console.log(data);
						if(data.success){
							bootbox.alert("You have edited the variable "+data.variable+" to "+data.setVariable+" of user "+data.dUser+".");
						}else{
							bootbox.alert(data.error);
						}
					}catch(err){
						bootbox.alert("Javascript error: "+err);
					}
				},
				error:function(err){
					bootbox.alert("AJAX error: "+err);
				}
			});
		}else {
			if(!setVariable) {
				bootbox.alert('Error: The new variable were not set!');
			}else if(variable) {
				bootbox.alert('Error: You did not pick the variable to edit!');
			}
		}
	}
}



</script>