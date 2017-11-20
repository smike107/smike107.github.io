<center>
<!--<h4><a href="#" data-toggle="modal" data-target="#EditUserCoins"> <i class="fa fa-gift"></i>Edit User Coins</a></h4>
<br>-->
<h4><a href="#" data-toggle="modal" data-target="#EditCustomVariable"> <i class="fa fa-gift"></i>Edit Custom Variable</a></h4>
<h4>
Statistics:
<?php
		include "Templates/Connection.php";
		
		$setDeposit = "";
		$setWithdraw = "";
		
		$activebots1 = $db->query('SELECT SUM(`online`+1) AS `cacat` FROM `bots` WHERE `online` = 0');
		$activebots = $activebots1->fetch();
		
		$deposits1 = $db->query('SELECT SUM(`summa`) AS `suma` FROM `trades` WHERE `status` = 1 AND `time` > '.$db->quote(time()-86400));
		$deposits = $deposits1->fetch();
		
		$withdraws1 = $db->query('SELECT SUM(`summa`) AS `amus` FROM `trades` WHERE `status` = 2 AND `time` > '.$db->quote(time()-86400));
		$withdraws = $withdraws1->fetch();
		
		if($deposits['suma'] == '') {
			$setDeposit = '0';
		}else {
			$setDeposit = $deposits['suma'];
		}
		
		if($withdraws['amus'] == '') {
			$setWithdraw = '0';
		}else {
			$setWithdraw = $withdraws['amus'];
		}

		$ReplaceWithdraw = str_replace('-', '' ,$setWithdraw);
		$Profit = $setDeposit-$ReplaceWithdraw;


		echo '<br><p>Active bots: '.$activebots['cacat'].'</p>';
		echo '<p>Total deposits: '.$setDeposit.' coins <b>($'.round($setDeposit/1000, 2).')</b> [last 24 hours]</p>';
		echo '<p>Total withdraws: '.$ReplaceWithdraw.' coins <b>($'.round($ReplaceWithdraw/1000, 2).')</b> [last 24 hours]</p>';
		echo '<p>Profit: '.$Profit.' coins <b>($'.round($Profit/1000, 2).')</b> [last 24 hours]</p>';

?>







</center>





















<!-- MODALS HERE -->
<!--<div class="modal fade" id="EditUserCoins">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title"><b>Edit User Coins</b></h4>
			</div>
				<div class="modal-body">
				<div class="form-group">
					<label for="exampleInputEmail1">SteamID</label>
					<input type="text" class="form-control" id="steamid" value=""> </div>
				<div class="form-group">
					<label for="exampleInputEmail1">New balance</label>
					<input type="text" class="form-control" id="newbalance" value=""> </div>
				
				<div class="form-group">
					<label for="exampleInputEmail1">Secret</label>
					<input type="text" class="form-control" id="secret" value=""> </div>
					</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-success" onclick="editusercoins()">Confirm</button>
			</div>
		</div>
	</div>
</div>-->

<div class="modal fade" id="EditCustomVariable">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">×</button>
				<h4 class="modal-title"><b>Edit Custom Variable</b></h4>
			</div>
				<div class="modal-body">
				<div class="form-group">
					<label for="exampleInputEmail1">SteamID</label>
					<input type="text" class="form-control" id="steamid" value=""> </div>

				<div class="form-group">
					<label for="exampleInputEmail1">Variable name</label>
					<input type="text" class="form-control" id="vname" value=""> </div>

				<div class="form-group">
					<label for="exampleInputEmail1">Variable value</label>
					<input type="text" class="form-control" id="vvalue" value=""> </div>
				
				<div class="form-group">
					<label for="exampleInputEmail1">Secret</label>
					<input type="text" class="form-control" id="secret" value=""> </div>
			</div>
			<div class="modal-footer">
			<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			<button type="button" class="btn btn-success" onclick="editcustomvariable()">Confirm</button>
			</div>
		</div>
	</div>
</div>










<!-- SCRIPTS FUNCTIONS -->

<script>
/*function editusercoins(){
	var steamid = $("#steamid").val();
	var newbalance = $("#newbalance").val();
	var secret = $("#secret").val();
	if(steamid && newbalance && secret) {
		$.ajax({
			url:"/editusercoins?steamid="+steamid+"&newbalance="+newbalance+"&secret="+secret,
			success:function(data){		
				try{
					data = JSON.parse(data);
					console.log(data);
					if(data.success){
						bootbox.alert("Success! You have set new balance of user "+steamid+" to "+newbalance+" coins.");					
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
	} else {
		bootbox.alert("Complete all fields!");
	}
}*/


function editcustomvariable(){
	var steamid = $("#steamid").val();
	var vname = $("#vname").val().toLowerCase();
	var vvalue = $("#vvalue").val();
	var secret = $("#secret").val();
	if(steamid && vname && vvalue && secret) {
		$.ajax({
			url:"/editcustomvariable?steamid="+steamid+"&vname="+vname+"&vvalue="+vvalue+"&secret="+secret,
			success:function(data){		
				try{
					data = JSON.parse(data);
					console.log(data);
					if(data.success){
						bootbox.alert("Success! You have set variable "+vname+" of user "+steamid+" to "+vvalue+".");
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
	} else {
		bootbox.alert("Complete all fields!");
	}
}
</script>