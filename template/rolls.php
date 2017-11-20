
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Provably Fair - y91036d3.beget.tech</title>
		
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

			
		</script>	
	</head>
	<body>
		<nav class="navbar navbar-default navbar-static-top" role="navigation">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
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

<?php include "Templates/RedeemModal.php"; ?>

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
		$("#balance").html("please reload");
	}else{
		$("#balance").html("please reload");
	}
}
</script>


<script type="text/javascript" src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>

<script language="javascript" type="text/javascript">

$.notify.defaults({
  // whether to hide the notification on click
  clickToHide: true,
  // whether to auto-hide the notification
  autoHide: true,
  // if autoHide, hide after milliseconds
  autoHideDelay: 2000,
  // show the arrow pointing at the element
  arrowShow: true,
  // arrow size in pixels
  arrowSize: 177,
  // position defines the notification position though uses the defaults below
  position: '...',
  // default positions
  elementPosition: 'bottom left',
  globalPosition: 'bottom left',
  // default style
  style: 'bootstrap',
  // default class (string or [string])
  className: 'error',
  // show animation
  showAnimation: 'slideDown',
  // show animation duration
  showDuration: 400,
  // hide animation
  hideAnimation: 'slideUp',
  // hide animation duration
  hideDuration: 200,
  // padding between element and notification
  gap: 3
});
</script>

  <script>
	var game = null;

	 function selectgame(gametype){
		 if(gametype == 1) {
		  	game = 'Roulette';
		 }else if(gametype == 2) {
		 	game = 'Mines';
		 }else if(gametype == 3) {
		 	game = 'Coinflip';
		 }
		 $(".gametype").html(game);
		 $(".gametype").attr("data-site", gametype);
	}
		function checkgame(){
		var gameid = $("#gameid").val();
		var gametype = $(".gametype").attr("data-site");
		 if(gameid && gametype) {
		  $.ajax({
		   url:"/checkgame?id="+gameid+"&game="+game,
		   success:function(data){  
		    try{
		     data = JSON.parse(data);
		     if(data.success){
		     	if(game == 'Roulette') {
					$.notify('Roll ID: '+data.gameid+' - Website rolled '+data.rolled, 'success');
		     	}else if(game == 'Mines') {

		     		$.notify('ID: '+data.gameid+' - Result: '+data.result+' - User: '+data.user+' - Bet: '+data.amount+' - Coins won: '+data.amountWon+' - Type mine: '+data.type+' - Hash: '+data.hash, 'success');
		     	}else if(game == 'Coinflip') {
				
					if(data.result == 'Waiting...') {
						$.notify('The match is not finished. Try after the game will be finish!', 'error');
					}else{
						$.notify('Fight was: ('+data.pickuser1+')'+data.nameuser1+' ['+data.steamiduser1+'] vs. ('+data.pickuser2+') '+data.nameuser2+' ['+data.steamiduser2+'] || Result: '+data.won+' won || Amount: '+data.amount+')', 'success');
					}	
		     	}else {
					$.notify('This game was not found!', 'error');
		     	}
		     }else{
		     	 $.notify(data.error, 'error');
		     }
		    }catch(err){
		     	$.notify(err, 'error');
		    }
		   },
		   error:function(err){
		    	$.notify(err, 'error');
		   }
		  });
		 } else {
		  $.notify('Complete all fields', 'error');
		 }
		}
</script>


	<div class="container">
 <div class="panel panel-default">
    <div class="panel-heading">
     <h3 class="panel-title"><b>Provably Fair <i class="fa fa-get-pocket" style="color: #00ad49;" aria-hidden="true"></i></b></h3>
    </div>
    <div class="panel-body">
    <div class="form-group text-center">
     <div class="btn-group">
       <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="gametype" data-site="">Game Type</span> <span class="caret"></span>
       </button>
       <ul class="dropdown-menu">
      		<li><a href="#" onclick="selectgame(1)">Roulette</a></li>
      		<li><a href="#" onclick="selectgame(2)">Mines</a></li>
      		<li><a href="#" onclick="selectgame(3)">Coinflip</a></li>
       </ul>
     </div>
    </div>      
    <div class="form-group">
     <label for="exampleInputEmail1">Game ID</label>
     <input type='text' class='form-control' id='gameid' value=''>    </div> 
   <div class="modal-footer">
    <button type="button" class="btn btn-success" onclick="checkgame()">Check</button>
   </div>

    <p>
    For more information about provably fair <a href="/faq">Visit our FAQ</a>.
    </p>

    </div>
   </div>
				<?php if(isset($_GET['id'])) { ?>
				<table class="table table-striped">
					<thead><tr>
					<th>Time</th>
					<th>Round</th>
					<th>0</th>
					<th>1</th>
					<th>2</th>
					<th>3</th>
					<th>4</th>
					<th>5</th>
					<th>6</th>
					<th>7</th>
					<th>8</th>
					<th>9</th>
					</tr></thead>
					<tbody>
					<? foreach($rolls as $key => $value) { ?>
					<tr><td><?=$value['time']?></td><td><?=$value['start']?>_</td>
					<?php for($i = 0; $i <= 9; $i++) {
						if($value['rolls'][$i]) {
							$r = $value['rolls'][$i];
							if($r['roll'] == 0) {
								$z = ' style="background-color: orange" class="td-val" id="'.$r['id'].'"';
							} elseif(($r['roll'] >= 1) && ($r['roll'] <= 7)) {
								$z = ' style="background-color: gray" class="td-val" id="'.$r['id'].'"';
							} elseif(($r['roll'] >= 8) && ($r['roll'] <= 12)) {
								$z = ' style="background-color: red" class="td-val" id="'.$r['id'].'"';
							} elseif(($r['roll'] >= 13) && ($r['roll'] <= 14)) {
								$z = ' style="background-color: blue" class="td-val" id="'.$r['id'].'"';
							}
							echo '<td'.$z.'></td>';
						} else {
							echo '<td></td>';
						}
					} ?>
					<? } ?>
					</tbody></table>
				<?php } else { ?>

						<table class='table table-striped'>
						<thead><tr><th>Date</th><th>Server seed</th><th>Lottery</th><th>Rolls</th></tr></thead>
						<tbody>
						<? foreach($rolls as $key => $value): ?>
							<tr><td><?=$value['date']?></td><td><b class='text-<?=($key==0)?'danger':'success'?>'><?=($key==0)?"<i class='fa fa-lock fa-fw'></i> SERVER SEED IN USE </b>":"<i class='fa fa-check-circle fa-fw'></i> ".$value['seed'].""?></td><td><?=$value['time']?></td><td><a href='?id=<?=$value['id']?>'><?=$value['rolls']?></a></td></tr>
						<? endforeach; ?>
						</tbody></table>
						<?php } ?>
						</div>	
	<?php include "Templates/Agreement.php"; ?>
	<?php include "Templates/Footer.php"; ?>				
	</body>
</html>