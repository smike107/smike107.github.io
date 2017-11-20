<html lang="en"><head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Dice - y91036d3.beget.tech</title>

		<link href="http://y91036d3.beget.tech/template/css/bootstrap.min.new.css" rel="stylesheet">
		<link href="http://y91036d3.beget.tech/template/css/font-awesome.min.css" rel="stylesheet">
		<link href="http://y91036d3.beget.tech/template/css/dataTables.bootstrap.min.css" rel="stylesheet">

		<link href="http://y91036d3.beget.tech/template/css/mineNew.css?v=5" rel="stylesheet">
		<link id="style" href="" rel="stylesheet">

		<link rel="shortcut icon" href="favicon.ico">

		<script src="http://y91036d3.beget.tech/template/js/jquery-1.11.1.min.js"></script>
		<script src="http://y91036d3.beget.tech/template/js/jquery.cookie.js"></script>
		<script src="http://y91036d3.beget.tech/template/js/socket.io-1.4.5.js"></script>
		<script src="http://y91036d3.beget.tech/template/js/bootstrap.min.js"></script>
		<script src="http://y91036d3.beget.tech/template/js/bootbox.min.js"></script>
		<script src="http://y91036d3.beget.tech/template/js/jquery.dataTables.min.js"></script>
		<script src="http://y91036d3.beget.tech/template/js/dataTables.bootstrap.js"></script>
		<script src="http://y91036d3.beget.tech/template/js/tinysort.js"></script>
		<script src="http://y91036d3.beget.tech/template/js/expanding.js"></script>
		<script src="http://y91036d3.beget.tech/template/js/twitch.js"></script>
		<script src="http://y91036d3.beget.tech/template/js/theme.js"></script>
		<?php include "Templates/Settings.php"; ?>
		<style>
        textarea{
            margin-bottom: 5px;
        }
        .panel-body .alert:last-child{
            margin-bottom: 0px;
        }
        .bubble{
            margin-bottom: 5px !important;
        }
		
		</style>

		<script type="text/javascript" src="http://y91036d3.beget.tech/template/js/new.js?v=<?=time()?>"></script>
	</head>
	<body style="margin-bottom: 62px;">
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
<div class="col-xs-3">
	<div id="pullout">
		<div id="tab1" class="tab-group" style="height: 515px;">
			<div class="dropdown" style="margin: -10px; font-family: 'Ubuntu-Medium'; font-size: 13px; padding: 20px; padding-bottom: 10px; text-align: center;">
					<center><span class="lang-select">CHATBOX</span></center>
			</div>
			<div style="width: 106,5%;height: 80px;margin: 10px -10px -80px -10px;"></div>
			<div class="divchat" id="chatArea"></div>
			<form id="chatForm">
				<div style="margin: 5px">
					<div class="input-group" style="margin-bottom: 5px">
						<input type="text" class="form-control" placeholder="Type here to chat..." id="chatMessage" maxlength="200">
						<div class="input-group-btn dropup">
							<button id="Smiles" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" type="button" class="btn btn-default dropdown-toggle" aria-label="Smiles">
								<span class="glyphicon fa fa-smile-o fa-lg"></span>
							</button>
							<ul class="dropdown-menu smiles" style="padding: 10px;" aria-labelledby="Smiles">
    							<li>
    								<img data-smile="BibleThump" src="http://y91036d3.beget.tech/template/img/site/BibleThump.png">
    								<img data-smile="CA" src="http://y91036d3.beget.tech/template/img/site/CA.png">
    								<img data-smile="CO" src="http://y91036d3.beget.tech/template/img/site/CO.png">
    								<img data-smile="Tb" src="http://y91036d3.beget.tech/template/img/site/Tb.png">
    								<img data-smile="deIlluminati" src="http://y91036d3.beget.tech/template/img/site/deIlluminati.png">
    							</li>
    							<li>
    								<img data-smile="Fire" src="http://y91036d3.beget.tech/template/img/site/Fire.png">
    								<img data-smile="Kappa" src="http://y91036d3.beget.tech/template/img/site/Kappa.png">
    								<img data-smile="KappaPride" src="http://y91036d3.beget.tech/template/img/site/KappaPride.png">
    								<img data-smile="KappaRoss" src="http://y91036d3.beget.tech/template/img/site/KappaRoss.png">
    								<img data-smile="Keepo" src="http://y91036d3.beget.tech/template/img/site/Keepo.png">
    							</li>
    							<li>
    								<img data-smile="Kreygasm" src="http://y91036d3.beget.tech/template/img/site/Kreygasm.png">
    								<img data-smile="heart" src="http://y91036d3.beget.tech/template/img/site/heart.png">
    								<img data-smile="offFire" src="http://y91036d3.beget.tech/template/img/site/offFire.png">
    								<img data-smile="PJSalt" src="http://y91036d3.beget.tech/template/img/site/PJSalt.png">
    								<img data-smile="rip" src="http://y91036d3.beget.tech/template/img/site/rip.png">
    							</li>
    							<li>
    								<img data-smile="FailFish" src="http://y91036d3.beget.tech/template/img/site/FailFish.png">
    							</li>
							</ul>
						</div>
					</div>
					<div class="pull-left">
						<span>Users online: <span id="isonline">0</span></span>
					</div>
					<div class="pull-right">
						<a href="#" class="clearChat">Clear chat</a>
					</div>
					<br>
					<div class="checkbox pull-right" style="margin: 0px">
						<label class="noselect"><input type="checkbox" id="scroll"><span>Stop chat</span></label>
					</div>
					<div class="pull-left">
						<a href="#" data-toggle="modal" data-target="#chatRules">Chat rules</a>
					</div>
				</div>
			</form>
		</div>
		<div id="tab2" class="tab-group hidden"></div>
		<div id="tab3" class="tab-group hidden"></div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body" style="margin-top: 10px;">
				<div><span class="settings-header">LANGUAGE</span><span class="settings-header">THEME</span></div>
				<ul class="nav settings-header" style="padding-top: 10px; display: inline-block;">
					<li class="dropdown">
						<img class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" src="http://y91036d3.beget.tech/template/img/lang/en.png">
						<ul class="dropdown-menu" role="menu" style="min-width: 32px;margin-left: 24%;">
							<li><a href="en.php" onclick="setLang('en')"><img src="http://y91036d3.beget.tech/template/img/lang/en.png"></a></li>
							<li><a href="ro.php" onclick="setLang('ro')"><img src="http://y91036d3.beget.tech/template/img/lang/ro.png"></a></li>
						</ul>
					</li>
				</ul>

				<a href="#" id="light" style="width:27%;" class="settings-header"><div class="template" style="background-color: #f1f1f1;">LIGHT</div></a>
				<a href="#" id="dark" style="width:1%;" class="settings-header"><div class="template" style="background-color: #272727; ">DARK</div></a>

			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-body text-center" style="margin-top: 10px;">
				<span>ACTIVE STREAMERS</span>
				<div id="streamoff" style="margin-top: 20px;">All streamers offline!</div>
				<div class="streamers">     
				</div>
			</div>
		</div>
	</div>
<div id="mainpage" class="col-xs-9">
		<?php include "Templates/FlipSystem.php"; ?>
</div>
	<?php include "Templates/Footer.php"; ?>			
	
</body></html>