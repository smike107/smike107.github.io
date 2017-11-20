
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Affiliates - y91036d3.beget.tech</title>		
		<link href="http://y91036d3.beget.tech/template/css/bootstrap.min.new.css" rel="stylesheet">
		<link href="http://y91036d3.beget.tech/template/css/font-awesome.min.css" rel="stylesheet">
		<link href="http://y91036d3.beget.tech/template/css/dataTables.bootstrap.min.css" rel="stylesheet">

		<link href="http://y91036d3.beget.tech/template/css/mineNew.css?v=5" rel="stylesheet">
		<link id="style" href="" rel="stylesheet">

		<link rel="shortcut icon" href="favicon.ico">

		<script src="http://y91036d3.beget.tech/template/js/jquery-1.11.1.min.js"></script>
		<script src="http://y91036d3.beget.tech/template/js/jquery.cookie.js"></script>
		<script src="http://y91036d3.beget.tech/template/js/bootstrap.min.js"></script>
		<script src="http://y91036d3.beget.tech/template/js/bootbox.min.js"></script>
		<script src="http://y91036d3.beget.tech/template/js/jquery.dataTables.min.js"></script>
		<script src="http://y91036d3.beget.tech/template/js/dataTables.bootstrap.js"></script>
		<script src="http://y91036d3.beget.tech/template/js/tinysort.js"></script>
		<script src="http://y91036d3.beget.tech/template/js/expanding.js"></script>
		<script src="http://y91036d3.beget.tech/template/js/theme.js"></script>
		<style>

		</style>
		<?php include "Templates/Settings.php"; ?>
		<style>
		
		</style>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#referrals").DataTable({
					"searching":false,
					"pageLength":100,
					"lengthChange":false,
				});
				$("#collect").on("click",function(){
					$this = $(this);
					$this.attr("disabled",true);
					$.ajax({
					url:"/collect",
					type:"POST",
					success:function(data){
						try{
							data = JSON.parse(data);
							if(data.success){
								$("#avail").html(0);
								bootbox.alert(data.collected+" have been credited to your account!");
								//inlineAlert("success","You collected "+data.collected+" credits!");						
							}else{
								bootbox.alert(data.error);
								//inlineAlert("error",data.error);
							}
						}catch(err){
							bootbox.alert("Javascript error: "+err);
						}
					},
					error:function(err){
						bootbox.alert("AJAX error: "+err.statusText);
					},
					complete:function(){
						$this.attr("disabled",false);
					}
					});
				});
				$("#changecode").on("click",function(e){
					e.preventDefault();
					bootbox.prompt("Change promocode:",function(result){                
						if(result){
							$.ajax({
								url:"/changecode",
								data:{"code":result},
								type:"POST",
								success:function(data){
									try{
										data = JSON.parse(data);
										if(data.success){
											bootbox.alert("Promocode changed to: "+data.code);
											$("#thecode").html(data.code);						
										}else{
											bootbox.alert(data.error);
										}
									}catch(err){
										bootbox.alert("Javascript error: "+err);
									}
								},
								error:function(err){
									bootbox.alert("AJAX error: "+err.statusText);
								}
							});                                           
						}
					});
					return false;
				});
			});
			
		</script>	
	</head>
	<body>
		<nav class="navbar navbar-default navbar-static-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Navigation switch</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<!-- <a class="navbar-brand" style="padding-top:0px;padding-bottom:0px;padding-right:0px" href="./"><img alt="CSGO.mk" height="34" style="margin-top:8px;margin-bottom:8px;margin-right:5px" src="http://y91036d3.beget.tech/template/img/just.png"></a> -->
            <a class="navbar-brand" href="/"><div id="logo" class="logo"></div></a>
		</div>
		<div id="navbar" class="navbar-collapse collapse">
			<?php include "Templates/Header.php"; ?>
			<?php include "Templates/UserPanel.php"; ?>
		</div>
	</div>
</nav>
<div class="modal fade" id="my64id">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><b>My Steam64Id</b></h4>
			</div>
			<div class="modal-body">
				<b><?=($user)?$user['steamid']:''?></b>			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<?php include "Templates/RedeemModal.php"; ?>


<div class="modal fade" id="settingsModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><b>Settings</b></h4>
			</div>
			<div class="modal-body">
				<form>	  			        	
								  
				  	<div class="checkbox">
				    	<label>
				      		<input type="checkbox" id="settings_confirm" checked>
				      		<strong>Confirm all bets over 10,000 coins</strong>
				    	</label>
				  	</div>
				  	<div class="checkbox">
				    	<label>
				      		<input type="checkbox" id="settings_sounds" checked>
				      		<strong>Enable sounds</strong>
				    	</label>
				  	</div>
				  	<div class="checkbox">
				    	<label>
				      		<input type="checkbox" id="settings_dongers">
				      		<strong>Display in $ amounts</strong>
				    	</label>
				  	</div>
				  	<div class="checkbox">
				    	<label>
				      		<input type="checkbox" id="settings_hideme">
				      		<strong>Hide my profile link in chat</strong>
				    	</label>
				  	</div>
				  	
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-success" onclick="saveSettings()">Save changes</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="chatRules">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"><b>Chat Rules</b></h4>
			</div>
			<div class="modal-body" style="font-size:24px">				  
				<ol>
					<li>No Spamming</li>
					<li>No Begging for Coins</li>
					<li>No Posting Promo Codes</li>
					<li>No CAPS LOCK</li>
					<li>No Promo Codes in Profile Name</li>
					</ol>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success btn-block" data-dismiss="modal">Got it!</button>
			</div>
		</div>
	</div>
</div>
<script>
function saveSettings(){
	for(var i=0;i<SETTINGS.length;i++){
		setCookie("settings_"+SETTINGS[i],$("#settings_"+SETTINGS[i]).is(":checked"));
	}
	$("#settingsModal").modal("hide");
	if($("#settings_dongers").is(":checked")){
		$("#balance").html("Please restart");
	}else{
		$("#balance").html("Please restart");
	}
}
</script>		<div class="container">
			
				<div class='alert alert-success text-center'>Your promocode is: <b><span id='thecode'><?=$affiliates['code']?></span> - <a href='#' id='changecode'>update</a></b></div>     
    <table class="table">

    	<tr><td>Affiliate level</td><td><?=$affiliates['level']?></td></tr>
		<tr><td>Visitors</td><td><?=$affiliates['visitors']?></td></tr>
		<tr><td>Depositors</td><td><?=$affiliates['depositors']?></td></tr>
		<tr><td>Total bet:</td><td><?=$affiliates['total_bet']?></td></tr>
		<tr><td>Lifetime Earnings</td><td><?=$affiliates['lifetime_earnings']?></td></tr>
		<tr><td>Available Now</td><td id='avail'><?=$affiliates['available']?></td></tr> 

    	</td></tr>
    </table>
<div class="text-right">
    <button class="btn btn-success btn-block" style="background: #5cb85c; color: #fff; width: 400px; margin: 0 auto;" id="collect">Collect coins</button>
</div>
				<br><table id='referrals' class='table table-striped dataTable no-footer'><thead><th>SteamID</th><th>Total bet</th><th>Commision</th></thead>
				<? foreach($affiliates['reffers'] as $key => $value): ?>
				<tr><th><?=$value['player']?><?=($value['total_bet'] > 0)?"<i class='fa fa-check text-success'></i>":""?></th><th><?=$value['total_bet']?></th><th><?=$value['comission']?></th></tr>
				<? endforeach; ?>
				<tbody></tbody></table>			
		</div>
	<?php include "Templates/Agreement.php"; ?>
	<?php include "Templates/Footer.php"; ?>			
	</body>
</html>