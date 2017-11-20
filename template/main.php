<html lang="en"><head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>y91036d3.beget.tech</title>
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
		<script src="http://y91036d3.beget.tech/template/js/jcanvas.min.js"></script>
		<script src="http://y91036d3.beget.tech/template/js/plot.js"></script>
		<?php include "Templates/Settings.php"; ?>
		<style>
		.navbar{
			margin-bottom: 0px;
		}
		.progress-bar{
			transition:         none !important;
			-webkit-transition: none !important;
			-moz-transition:    none !important;
			-o-transition:      none !important;
		}
		#case {

			max-width: 1050px;
			height: 69px;
			background-image: url("http://y91036d3.beget.tech/template/img/casesn.png");
			background-repeat: no-repeat;
			background-position: 0px 0px;
			position: relative;
			margin:0px auto;

		}
		</style>

		<script type="text/javascript" src="http://y91036d3.beget.tech/template/js/new.js?v=<?=time()?>"></script>
		<script type="text/javascript" src="http://y91036d3.beget.tech/template/js/graph.js?v=<?=time()?>"></script>
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
			<ul id="contextMenu" class="dropdown-menu" role="menu" style="display:none">
				<li><a tabindex="-1" href="#" data-act="0">Username</a></li>
			    <li><a tabindex="-1" href="#" data-act="1">Mute player</a></li>
			    <li><a tabindex="-1" href="#" data-act="3">Send coins</a></li>
			    <li><a tabindex="-1" href="#" data-act="4">Ignore</a></li>
			</ul>			
<div class="col-xs-3">
	<div id="pullout">
		<div id="tab1" class="tab-group" style="height: 515px;">
			<div class="dropdown" style="margin: -10px; font-family: 'Ubuntu-Medium'; font-size: 13px; padding: 20px; padding-bottom: 10px; text-align: center;">
					<center><span class="lang-select">Chat</span></center>
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
						<span class="userson">Users online: <span id="isonline">0</span></span>
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
		</div><br>
		<div class="panel panel-default">
			<div class="panel-body" style="margin-top: 10px;">
				<div><span class="settings-header">ROOM</span><span class="settings-header">THEME</span></div>
				<ul class="nav settings-header" style="padding-top: 10px; display: inline-block;">
					<li class="dropdown">
						<img id="changeLang0" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" src="http://y91036d3.beget.tech/template/img/lang/en.png">
						<ul class="dropdown-menu" role="menu" style="min-width: 32px;margin-left: 24%;">
							<li><a onclick="changeLang(1)"><img src="http://y91036d3.beget.tech/template/img/lang/en.png"></a></li>
							<li><a onclick="changeLang(2)"><img src="http://y91036d3.beget.tech/template/img/lang/br.png"></a></li>
							<li><a onclick="changeLang(3)"><img src="http://y91036d3.beget.tech/template/img/lang/ru.png"></a></li>
						</ul>
					</li>
				</ul>

				<a href="#" id="light" style="width:27%;" class="settings-header"><div class="template" style="background-color: #f1f1f1;">LIGHT</div></a>
				<a href="#" id="dark" style="width:1%;" class="settings-header"><div class="template" style="background-color: #272727; ">DARK</div></a>

			</div>
		</div>
		<!--<div class="panel panel-default">
			<div class="panel-body text-center" style="margin-top: 10px;">
				<center><button href="#" class="btn free-coins" id="oneplusbutton">GET COINS</button></center>
			</div>
		</div>-->
	</div>
		<div id="mainpage" class="col-xs-9">
			<?php include "Templates/Announcements.php"; ?>

		<ul class="nav nav-pills nav-justified chooseBar" style="margin-top:25px;">
			<li id="roulette-nav" class="active" style="cursor: pointer;"><a onclick="changeGame('roulette')"><i class="fa fa-dot-circle-o" aria-hidden="true"></i> Roulette</a></li>
			<li id="coinflip-nav" style="cursor: pointer;"><a onclick="changeGame('coinflip')"><i class="fa fa-gg" aria-hidden="true"></i> Coinflip</a></li>
			<li id="crash-nav" style="cursor: pointer;"><a onclick="changeGame('crash')"><i class="fa fa-line-chart" aria-hidden="true"></i> Crash<sup class="alert alert-danger" style="margin:0;border:0;padding:0;position:absolute;margin-top:21px;color:red;"></sup></a></li>
			<li id="mines-nav" style="cursor: pointer;"><a onclick="changeGame('mines')"><i class="fa fa-bomb" aria-hidden="true"></i> Mines<!-- sup class="alert alert-danger" style="margin:0;border:0;padding:0;position:absolute;margin-top:21px;color:orange;">HOT</sup> --><!--<sup class="alert alert-success" style="margin:0;border:0;padding:0;position:absolute;margin-top:21px;">NEW</sup>--></a></li>
			<li id="safebox-nav" style="cursor: pointer;"><a onclick="changeGame('safebox')"><i class="fa fa-expeditedssl" aria-hidden="true"></i> Safebox<sup class="alert alert-success" style="margin:0;border:0;padding:0;position:absolute;margin-top:21px;color:green">NEW</sup></a></li>
			<li id="mbox-nav" style="cursor: pointer;"><a onclick="changeGame('mbox')"><i class="fa fa-archive" aria-hidden="true"></i> Mystery Box</a></li>
			<li id="dices-nav" style="cursor: pointer;"><a onclick="changeGame('dices')"><i class="fa fa-delicious" aria-hidden="true"></i> Dices<sup class="alert alert-danger" style="margin:0;border:0;padding:0;position:absolute;margin-top:21px;color:orange">BETA</sup></a></li>
			<li id="jackpot-nav" style="cursor: pointer;"><a onclick="changeGame('jackpot')"><i class="fa fa-sun-o" aria-hidden="true"></i> Jackpot<sup class="alert alert-danger" style="margin:0;border:0;padding:0;position:absolute;margin-top:21px;color:orange">BETA</sup></a></li>
						
		</ul>


<div id="roulette">
		 <div class="well text-center" style="margin-bottom:10px;margin-top:25px; padding: 20px;">	
			<center>
				<style>
				.infohash {
				    border: 1px solid #333;
				    width: 69.7%;
				    font-size: 13;
				    margin-bottom: 3;
				}
				.roundedHashh {
				    margin-right: 455;
				    margin-top: 5;
				}
				.roundedHash {
				    margin: -18;
				    margin-bottom: 5;
				    margin-left: 95;
				}
				</style>
				<div class="infohash">
				<div class="roundedHashh"> Round hash:</div><div class="roundedHash"></div></div>
			</center>
			<div class="progress text-center" style="height:50px;margin-bottom:5px;margin-top:5px">
				<span id="banner"></span>
				<div class="progress-bar progress-bar-danger progress-bar-striped" id="counter"></div>
			</div>


		<div id="case" style="margin-bottom: 5px; background-position: -1042.5px 0px;"><div id="pointer"></div></div>
		<div class="well text-center" style="padding:5px;margin-bottom:5px"><div id="past"></div>
			<div style="margin: 20px 0px;">
			</div>

			<?php if(!$user) {?>
			<center>
				<h3 style="border-radius: 10px;text-align: center;color: #fff;padding: 5px;" class="ball-0 text-center">You are logged as Guest!</h3>
				<h3 style="border-radius: 10px;text-align: center;color: #fff;padding: 5px;" class="ball-1 text-center">To play you need to <a href="/login">login with Steam</a>!</h3>
			</center>
			<?php }else{ ?>
			<div class="form-group">
				<div class="input-btn bet-buttons">
                    <p>
					<span style="font-size:18px;font-weight:bold;color:orange;">Balance: <span id="dongers"></span> <span id="balance">0</span> <i style="cursor:pointer" class="fa fa-refresh noselect" id="rgetbal"></i></span>
					</p>
					<div class="form-group">
						<div class="btn-group">
		                    <button type="button" class="btn btn-warning betshort" data-action="10">+10</button>
		                    <button type="button" class="btn btn-warning betshort" data-action="100">+100</button>
		                    <button type="button" class="btn btn-warning betshort" data-action="1000">+1000</button>
		                    <button type="button" class="btn btn-warning betshort" data-action="half">1/2</button>
		                    <button type="button" class="btn btn-warning betshort" data-action="double">x2</button>
		                    <button type="button" class="btn btn-danger betshort" data-action="clear">Clear</button>
		                    <button type="button" class="btn btn-primary betshort" data-action="max">Max</button>
						</div>
					</div>
                    <input type="text" class="form-control input-lg" placeholder="0" id="betAmount" style="margin-top:15px;">
				</div>
			</div>
			<?php } ?>
			
		</div>
			</div>
			<div class="row text-center">



				<div class="col-xs-3 betBlock" style="padding-right:0px">
					<div class="panel panel-default bet-panel" id="panel11-7-b">
						<div class="panel-heading" style="padding: 1px;">
							<button style="background-color: #444" class="btn btn-lg  btn-block betButton" data-lower="1" data-upper="7"><span style="color:white">GRAY (1~7) [x2]</span></button>
						</div>
					</div>
					<div class="panel panel-default bet-panel" id="panel1-7-m" style="width: 220px; margin: auto; margin-bottom: 10px;">
						<div class="panel-body" style="padding:0px">
							<div class="my-row">
								<div class="text-center"><span class="mytotal">0</span></div>
							</div>
						</div>
					</div>
					<div class="panel panel-default bet-panel" id="panel1-7-t">
						<div class="panel-body" style="padding:0px" id="panel1-7">
							<div class="total-row">
								<div class="text-center">Total bet: <span class="total">0</span></div>
							</div>
							<ul class="list-group betlist"></ul>
						</div>
					</div>
				</div>
				
				<div class="col-xs-3 betBlock" style="padding-right:0px">
					<div class="panel panel-default bet-panel" id="panel8-12-b">
						<div class="panel-heading" style="padding: 1px;">
							<button style="background-color: #D32F2F" class="btn btn-lg  btn-block betButton" data-lower="8" data-upper="12"><span style="color:white">RED (8~12) [x3]</span></button>
						</div>
					</div>
					<div class="panel panel-default bet-panel" id="panel8-12-m" style="width: 220px; margin: auto; margin-bottom: 10px;">
						<div class="panel-body" style="padding:0px">
							<div class="my-row">
								<div class="text-center"><span class="mytotal">0</span></div>
							</div>
						</div>
					</div>
					<div class="panel panel-default bet-panel" id="panel8-12-t">
						<div class="panel-body" style="padding:0px" id="panel8-12">
							<div class="total-row">
								<div class="text-center">Total bet: <span class="total">0</span></div>
							</div>
							<ul class="list-group betlist"></ul>
						</div>
					</div>
				</div>
				
				<div class="col-xs-3 betBlock" style="padding-right:0px">
					<div class="panel panel-default bet-panel" id="panel13-14-b">
						<div class="panel-heading" style="padding: 1px;">
							<button style="background-color: #2196F3" class="btn btn-lg  btn-block betButton" data-lower="13" data-upper="14"><span style="color:white">BLUE (13~15) [x5]</span></button>
						</div>
					</div>
					<div class="panel panel-default bet-panel" id="panel13-14-m" style="width: 220px; margin: auto; margin-bottom: 10px;">
						<div class="panel-body" style="padding:0px">
							<div class="my-row">
								<div class="text-center"><span class="mytotal">0</span></div>
							</div>
						</div>
					</div>
					<div class="panel panel-default bet-panel" id="panel13-14-t">
						<div class="panel-body" style="padding:0px" id="panel13-14">
							<div class="total-row">
								<div class="text-center">Total bet: <span class="total">0</span></div>
							</div>
							<ul class="list-group betlist"></ul>
						</div>
					</div>
				</div>

				<div class="col-xs-3 betBlock">
					<div class="panel panel-default bet-panel" id="0-0-b">
						<div class="panel-heading" style="padding: 1px;">
							<button style="background-color: #FBC02D" class="btn btn-lg  btn-block betButton" data-lower="0" data-upper="0"><span style="color:white">GOLD (0) [x11]</span></button>
						</div>
					</div>
					<div class="panel panel-default bet-panel" id="panel0-0-m" style="width: 220px; margin: auto; margin-bottom: 10px;">
						<div class="panel-body" style="padding:0px">
							<div class="my-row">
								<div class="text-center"><span class="mytotal">0</span></div>
							</div>
						</div>
					</div>
					<div class="panel panel-default bet-panel" id="panel0-0-t">
						<div class="panel-body" style="padding:0px" id="panel0-0">
							<div class="total-row">
								<div class="text-center">Total bet: <span class="total">0</span></div>
							</div>
							<ul class="list-group betlist"></ul>
						</div>
					</div>
				</div>
			</div>
		</div>
</div>


<div id="mines" class="hidden">
<div id="mainpage" class="col-xs-9">
	<br><br>
<style>
.button {
    font-size: 10px;
    line-height: 20px;
    width: 150px;
    height: 40px;
    background: linear-gradient(#4EEDE3, #26D4C8);
    border: 3px solid #87FFF9;
    border-radius: 5px;
    text-shadow: 0 0 20px rgba(64, 255, 255, 0.9);
    -webkit-transition: .1s;
    transition: .1s;
    -webkit-transform: scale(1);
    transform: scale(1);
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    box-shadow: 0 0 50px rgb(0, 255, 255);
    overflow: hidden;
    font-weight: 700;
    text-transform: uppercase;
    text-align: center;
    color: #fff;
    display: inline-block;
}
.tiles {
    margin: -1%;
    padding: 20px;
    width: 350px;
}
.tiles .tile1, .tile2, .tile3, .tile4, .tile5, .tile6, .tile7, .tile8, .tile9, .tile10, .tile11, .tile12, .tile13, .tile14, .tile15, .tile16, .tile17, .tile18, .tile19, .tile20, .tile21, .tile22, .tile23, .tile24, .tile25 {
    background: #b8b8b8;
    float: left;
    height: 50px;
    margin: 1%;
    width: 50px;
    text-align: center;
    vertical-align: middle;
    line-height: 50px;
    cursor: pointer;
}
.active {
    box-shadow: 0 0 3px 3px #88e685;
}
</style>
<center>
<div style="font-size: 13px; padding: 10px 20px; margin-right: 5px; color: #fff; border-radius: 10px;">

<?php if(!$user) {?>
<center>
	<h3 style="border-radius: 10px;text-align: center;color: #fff;padding: 5px;" class="ball-0 text-center">You are logged as Guest!</h3>
	<h3 style="border-radius: 10px;text-align: center;color: #fff;padding: 5px;" class="ball-1 text-center">To play you need to <a href="/login">login with Steam</a>!</h3>
</center>
<?php }else{ ?>
<div class="form-group">
			<div class="input-btn bet-buttons">
                <p>
				<span style="font-size:18px;font-weight:bold;color:orange;">Balance: <span id="dongers"></span> <span id="mbalance">0</span> <i style="cursor:pointer" class="fa fa-refresh noselect" id="mgetbal"></i></span>
				</p>
				<div class="form-group">
					<div class="btn-group">
	                    <button type="button" class="btn btn-warning type1" onclick="mineGameType('1')">x1</button>
	                    <button type="button" class="btn btn-warning type2" onclick="mineGameType('3')">x3</button>
	                    <button type="button" class="btn btn-warning type3" onclick="mineGameType('5')">x5</button>
	                    <button type="button" class="btn btn-warning type4" onclick="mineGameType('24')">x24</button>
	                    <button type="button" class="btn btn-primary" onclick="startMineGame()">Start Game</button>
					</div>
				</div>
				<input type="text" class="form-control input-lg" placeholder="0" id="mbetAmount" style="margin-top:15px;">
			</div>
		</div>


<?php } ?>
	<br>
	<br>

</div>	




<br>
	<div id="TilesTiles">
		<div id="showmine" class="hidden"></div>
	</div>
	<br>
</center>
	</div>
</div>
	</div>


<div id="dices" class="hidden">
<div id="mainpage" class="col-xs-9">
	<br><br>
<style>
.button {
    font-size: 10px;
    line-height: 20px;
    width: 150px;
    height: 40px;
    background: linear-gradient(#4EEDE3, #26D4C8);
    border: 3px solid #87FFF9;
    border-radius: 5px;
    text-shadow: 0 0 20px rgba(64, 255, 255, 0.9);
    -webkit-transition: .1s;
    transition: .1s;
    -webkit-transform: scale(1);
    transform: scale(1);
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    box-shadow: 0 0 50px rgb(0, 255, 255);
    overflow: hidden;
    font-weight: 700;
    text-transform: uppercase;
    text-align: center;
    color: #fff;
    display: inline-block;
}
</style>
<center>
<div style="font-size: 13px;padding: 10px 20px; margin-right: 5px; color: #fff; border-radius: 10px;">

<?php if(!$user) {?>
<center>
	<h3 style="border-radius: 10px;text-align: center;color: #fff;padding: 5px;" class="ball-0 text-center">You are logged as Guest!</h3>
	<h3 style="border-radius: 10px;text-align: center;color: #fff;padding: 5px;" class="ball-1 text-center">To play you need to <a href="/login">login with Steam</a>!</h3>
</center>
<?php }else{ ?>
<div class="form-group">
			<div class="input-btn bet-buttons">
                <p>
				<span style="font-size:18px;font-weight:bold;color:orange;">Balance: <span id="dongers"></span> <span id="dbalance">0</span> <i style="cursor:pointer" class="fa fa-refresh noselect" id="dgetbal"></i></span>
				</p>
				<div class="form-group">
					<div class="btn-group">
						<button type="button" class="btn btn-warning dice1" onclick="diceGameType('Low')">Low [1-2]</button>
						<button type="button" class="btn btn-warning dice2" onclick="diceGameType('Medium')">Medium [3-4]</button>
						<button type="button" class="btn btn-warning dice3" onclick="diceGameType('High')">High [5-6]</button>
						<button type="button" class="btn btn-primary" onclick="startDicesGame()">Start</button>
					</div>
				</div>
				<input type="text" class="form-control input-lg" placeholder="0" data-value="0" id="dbetAmount" style="margin-top:15px;">
				<br>
				<button type="button" class="btn btn-info" onclick="DicesAutomaticBet()">Automatic Bets</button>
				<div class="AutomatedBets"><span style="color:red">OFF</span></div>


			</div>
		</div>
<?php } ?>


	<br>
	<br>

</div>	
<br>
	<br>
</center>
	</div>
</div>
</div>

<div id="jackpot" class="hidden">
<div id="mainpage" class="col-xs-9">
<center>


<?php if(!$user) {?>
<center>
	<h3 style="border-radius: 10px;text-align: center;color: #fff;padding: 5px;" class="ball-0 text-center">You are logged as Guest!</h3>
	<h3 style="border-radius: 10px;text-align: center;color: #fff;padding: 5px;" class="ball-1 text-center">To play you need to <a href="/login">login with Steam</a>!</h3>
</center>
<?php }else{ ?>
<br>
<center><span style="color:red"><b>Min. bet: 1.000 coins <> Max.bet: 10.000 coins <> Chances: <span style="color:green">randomly</span> <> Bets: 1 time</b></span></center>
<div class="form-group">
<div class="input-btn bet-buttons">
<br>
<p>
<span style="font-size:18px;font-weight:bold;color:orange;">Balance: <span id="dongers"></span> <span id="jbalance">0</span> <i style="cursor:pointer" class="fa fa-refresh noselect" id="jgetbal"></i></span>
</p>
 
<input type="text" class="form-control input-lg" placeholder="Bet amount..." id="jbetSum">
<input id="joinJackpot" class="btn btn-inverse btn-lg joinJackpot" value="Join Jackpot" style="font-weight: bold; margin-bottom:3px;" readonly />
 
</div>
</div>
<?php } ?>


 
<div id="stats">
 
<div id="info" class="well text-center pull-right" style="padding:5px;margin-bottom:5px;margin-right:50px;margin-top:75px;">
<span id="jchance">CHANCE <b>0%</b></span>
</div>
</div>
<div id="timeleft" class="well text-center" style="padding:5px;margin-bottom:5px;width:50%">
<div class="progress text-center" style="height:50px;margin:5px;border-radius:5px;">
<span id="jbanner"></span>
<div class="progress-bar progress-bar-danger" id="jcounter"></div>
</div>
<span id="jtotal" style="font-size:150%"><b>0 coins</b></span>
</div>
</center>
<div class="row text-center">
<div class="betBlock pull-left" style="width:100%">
<div class="panel panel-default bet-panel" id="paneljackpot">
<div class="panel-body" style="padding:0px" id="paneljackpot">
<div class="total-row">
<div class="pull-left">User</div><div class="pull-right">Amount</div>
</div>
<ul class="list-group jbetlist"></ul>
</div>
</div>
</div>
</div>
</div>
</div>


<!--<div class="mbox" style=display:none>
<div align="center">
<div class="alert alert-info text-center" style=margin-top:10px;margin-right:25px;margin-left:25px>
                <i class="fa fa-info-circle"></i> We are adding more cases over the next week!</div>
    <style>
        #casebox01 {
 
            max-width:890px;
            height:69px;
            background-repeat:no-repeat;
            background-position:0px 0px;
            position:relative;
            margin:0px auto;
            border-radius:10px;
            background-image: url("http://y91036d3.beget.tech/template/img/mcases.png");
 
        }
        #pointercase{
            width:3px;
            background:#c3c3c3;
            position:absolute;
            left:50%;
            top:0px;
            height:100%;
        }
 
    </style>
   
        <br>
        <br>
        <div id="boxeslist">
            <div class="row">
                    <center><input class="btn btn-danger default backboxes hidden" value="BACK" style="font-weight: bold; border-radius: 5px; cursor: pointer; margin-bottom: 10px;" readonly="">
                   
                    <div class="form-group">
                    <div class="hidden" id="contentbox01" style="margin-bottom:35px;">
                    <br>
                    <div id="casebox01" style="margin-bottom: 20px; background-position: -710.5px 0px;"><div id="pointercase"></div></div>
                    <div class="input-btn bet-buttons">
                    <br>
                    <input id="openBox01" class="btn btn-success betshort Openbox" value="Open box" style="font-weight: bold; margin-bottom:3px;" readonly="">
                    </div>
                    </div>
                    </div>
                   
 
                </div>
 
 
               
                <div class="col-sm-3" id="box01" style="margin-bottom:35px;">
                    <div class="well text-center" style="width:90%;margin-bottom:0;padding: 10px;border-radius:7px 7px 0 0;cursor:pointer;">
                        <div style="border-radius: 10px;text-align: center;position: absolute;color: #fff;padding: 5px;" class="ball-0 text-center">300 credits</div>
                        <img style="width:75%;" src="http://y91036d3.beget.tech/template/img/box03.png">
                    </div>
                    <div class="well text-center casename" style="width:90%;padding: 10px;border-radius:0 0 7px 7px;cursor:pointer;">
                        <b>Box 1</b>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>-->



<div id="mbox" class="hidden" style="margin-top:100;">
	<br><br>
	<style>
        #casebox01 {
 
            max-width:890px;
            height:69px;
            background-repeat:no-repeat;
            background-position:0px 0px;
            position:relative;
            margin:0px auto;
            border-radius:10px;
            background-image: url("http://y91036d3.beget.tech/template/img/casesb01.png");
 
        }
        #casebox02 {
 
            max-width:890px;
            height:69px;
            background-repeat:no-repeat;
            background-position:0px 0px;
            position:relative;
            margin:0px auto;
            border-radius:10px;
            background-image: url("http://y91036d3.beget.tech/template/img/casesb02.png");
 
        }
        #casebox03 {
 
            max-width:890px;
            height:69px;
            background-repeat:no-repeat;
            background-position:0px 0px;
            position:relative;
            margin:0px auto;
            border-radius:10px;
            background-image: url("http://y91036d3.beget.tech/template/img/casesb03.png");
 
        }
        #casebox04 {
 
            max-width:890px;
            height:69px;
            background-repeat:no-repeat;
            background-position:0px 0px;
            position:relative;
            margin:0px auto;
            border-radius:10px;
            background-image: url("http://y91036d3.beget.tech/template/img/casesb04.png");
 
        }
        #pointercase{
            width:3px;
            background:#c3c3c3;
            position:absolute;
            left:50%;
            top:0px;
            height:100%;
        }
	</style>
	<center>
		<br>
		<br>
		<div id="boxeslist">
			<div class="row">
				<input class="btn-inverse text-center backboxes hidden" value="BACK" style="font-weight: bold; border-radius: 5px; cursor: pointer; margin-bottom: 10px;" readonly="">
				<br>
				<div class="col-xs-9 hidden" id="contentbox01" style="margin-bottom:35px;">

                    <div class="form-group">
                    <br>
                    <div id="casebox01" style="margin-bottom: 20px; background-position: -710.5px 0px;"><div id="pointercase"></div></div>
                    <div class="input-btn bet-buttons">
                    <br>
                    </div>
                    </div>


					<?php if(!$user) {?>
					<center>
						<h3 style="border-radius: 10px;text-align: center;color: #fff;padding: 5px;" class="ball-0 text-center">You are logged as Guest!</h3>
						<h3 style="border-radius: 10px;text-align: center;color: #fff;padding: 5px;" class="ball-1 text-center">To play you need to <a href="/login">login with Steam</a>!</h3>
					</center>
					<?php }else{ ?>
					<div class="form-group">
						<div class="input-btn bet-buttons">
							<span style="font-size: 13px;background-color: #b04a43; padding: 10px 20px; margin-right: 5px; color: #fff; border-radius: 10px;">
								<span>Balance: </span>
								<span id="dongers"></span>
								<span id="b1balance" style="display: inline;"></span> <i style="cursor:pointer; margin-left: 5px;" class="fa fa-refresh noselect" id="b1getbal"></i>
								</span>
							<input id="openBox01" class="btn btn-inverse btn-lg Openbox" value="Open box" style="font-weight: bold; margin-bottom:3px;" readonly="">
						</div>
					</div>
					<?php } ?>

				</div>
				<div class="col-xs-9 hidden" id="contentbox02" style="margin-bottom:35px;">

                    <div class="form-group">
                    <br>
                    <div id="casebox02" style="margin-bottom: 20px; background-position: -710.5px 0px;"><div id="pointercase"></div></div>
                    <div class="input-btn bet-buttons">
                    <br>
                    </div>
                    </div>


					<?php if(!$user) {?>
					<center>
						<h3 style="border-radius: 10px;text-align: center;color: #fff;padding: 5px;" class="ball-0 text-center">You are logged as Guest!</h3>
						<h3 style="border-radius: 10px;text-align: center;color: #fff;padding: 5px;" class="ball-1 text-center">To play you need to <a href="/login">login with Steam</a>!</h3>
					</center>
					<?php }else{ ?>
					<div class="form-group">
						<div class="input-btn bet-buttons">
							<span style="font-size: 13px;background-color: #b04a43; padding: 10px 20px; margin-right: 5px; color: #fff; border-radius: 10px;">
								<span>Balance: </span>
								<span id="dongers"></span>
								<span id="b2balance" style="display: inline;"></span> <i style="cursor:pointer; margin-left: 5px;" class="fa fa-refresh noselect" id="b2getbal"></i>
								</span>
							<input id="openBox02" class="btn btn-inverse btn-lg Openbox" value="Open box" style="font-weight: bold; margin-bottom:3px;" readonly="">
						</div>
					</div>
					<?php } ?>

				</div>




				<div class="col-xs-9 hidden" id="contentbox03" style="margin-bottom:35px;">

                    <div class="form-group">
                    <br>
                    <div id="casebox03" style="margin-bottom: 20px; background-position: -710.5px 0px;"><div id="pointercase"></div></div>
                    <div class="input-btn bet-buttons">
                    <br>
                    </div>
                    </div>


					<?php if(!$user) {?>
					<center>
						<h3 style="border-radius: 10px;text-align: center;color: #fff;padding: 5px;" class="ball-0 text-center">You are logged as Guest!</h3>
						<h3 style="border-radius: 10px;text-align: center;color: #fff;padding: 5px;" class="ball-1 text-center">To play you need to <a href="/login">login with Steam</a>!</h3>
					</center>
					<?php }else{ ?>
					<div class="form-group">
						<div class="input-btn bet-buttons">
							<span style="font-size: 13px;background-color: #b04a43; padding: 10px 20px; margin-right: 5px; color: #fff; border-radius: 10px;">
								<span>Balance: </span>
								<span id="dongers"></span>
								<span id="b3balance" style="display: inline;"></span> <i style="cursor:pointer; margin-left: 5px;" class="fa fa-refresh noselect" id="b3getbal"></i>
								</span>
							<input id="openBox03" class="btn btn-inverse btn-lg Openbox" value="Open box" style="font-weight: bold; margin-bottom:3px;" readonly="">
						</div>
					</div>
					<?php } ?>

				</div>

				<div class="col-xs-9 hidden" id="contentbox04" style="margin-bottom:35px;">

                    <div class="form-group">
                    <br>
                    <div id="casebox04" style="margin-bottom: 20px; background-position: -710.5px 0px;"><div id="pointercase"></div></div>
                    <div class="input-btn bet-buttons">
                    <br>
                    </div>
                    </div>


					<?php if(!$user) {?>
					<center>
						<h3 style="border-radius: 10px;text-align: center;color: #fff;padding: 5px;" class="ball-0 text-center">You are logged as Guest!</h3>
						<h3 style="border-radius: 10px;text-align: center;color: #fff;padding: 5px;" class="ball-1 text-center">To play you need to <a href="/login">login with Steam</a>!</h3>
					</center>
					<?php }else{ ?>
					<div class="form-group">
						<div class="input-btn bet-buttons">
							<span style="font-size: 13px;background-color: #b04a43; padding: 10px 20px; margin-right: 5px; color: #fff; border-radius: 10px;">
								<span>Balance: </span>
								<span id="dongers"></span>
								<span id="b4balance" style="display: inline;"></span> <i style="cursor:pointer; margin-left: 5px;" class="fa fa-refresh noselect" id="b4getbal"></i>
								</span>
							<input id="openBox04" class="btn btn-inverse btn-lg Openbox" value="Open box" style="font-weight: bold; margin-bottom:3px;" readonly="">
						</div>
					</div>
					<?php } ?>

				</div>



				<br>
				<center><div class="col-sm-3" id="box01" style="margin-bottom:35px;">
					<div class="well text-center" style="width:90%;margin-bottom:0;padding: 10px;border-radius:7px 7px 0 0;cursor:pointer;">
						<div style="border-radius: 10px;text-align: center;position: absolute;color: #fff;padding: 5px;" class="ball-0 text-center">300</div>
						<img style="width:75%;" src="http://y91036d3.beget.tech/template/img/boxes/box01.png">
					</div>
					<div class="well text-center casename" style="width:90%;padding: 10px;border-radius:0 0 7px 7px;cursor:pointer;">
						<b>Box 01</b>
					</div>
				</div></center>
				<center><div class="col-sm-3" id="box02" style="margin-bottom:35px;">
					<div class="well text-center" style="width:90%;margin-bottom:0;padding: 10px;border-radius:7px 7px 0 0;cursor:pointer;">
						<div style="border-radius: 10px;text-align: center;position: absolute;color: #fff;padding: 5px;" class="ball-0 text-center">1000</div>
						<img style="width:75%;" src="http://y91036d3.beget.tech/template/img/boxes/box02.png">
					</div>
					<div class="well text-center casename" style="width:90%;padding: 10px;border-radius:0 0 7px 7px;cursor:pointer;">
						<b>Box 02</b>
					</div>
				</div></center>
				<center><div class="col-sm-3" id="box03" style="margin-bottom:35px;">
					<div class="well text-center" style="width:90%;margin-bottom:0;padding: 10px;border-radius:7px 7px 0 0;cursor:pointer;">
						<div style="border-radius: 10px;text-align: center;position: absolute;color: #fff;padding: 5px;" class="ball-0 text-center">3000</div>
						<img style="width:75%;" src="http://y91036d3.beget.tech/template/img/boxes/box03.png">
					</div>
					<div class="well text-center casename" style="width:90%;padding: 10px;border-radius:0 0 7px 7px;cursor:pointer;">
						<b>Box 03</b>
					</div>
				</div></center>
				<center><div class="col-sm-3" id="box04" style="margin-bottom:35px;">
					<div class="well text-center" style="width:90%;margin-bottom:0;padding: 10px;border-radius:7px 7px 0 0;cursor:pointer;">
						<div style="border-radius: 10px;text-align: center;position: absolute;color: #fff;padding: 5px;" class="ball-0 text-center">5000</div>
						<img style="width:75%;" src="http://y91036d3.beget.tech/template/img/boxes/box04.png">
					</div>
					<div class="well text-center casename" style="width:90%;padding: 10px;border-radius:0 0 7px 7px;cursor:pointer;">
						<b>Box 04</b>
					</div>
				</div></center>
			</div>
		</div>
	</center>
</div>




<div id="coinflip" class="hidden">
<style>

#coin-flip-cont {
	width: 200px;
	height: 200px;
	position: absolute;
	top: calc(50% - 100px);
	left: calc(50% - 100px);
}

#coin {
position: relative;
width: 200px;
transform-style: preserve-3d;
}

#coin .front, #coin .back {
position: absolute;
width: 200px;
height: 200px;
}

#coin .front {
    transform: translateZ(1px);
    border-radius: 50%;
    background-image: url('http://y91036d3.beget.tech/template/img/flipcoin/ct-icon.png');
    background-size: cover;
    display: block;
}

#coin .back {
	transform: translateZ(-1px) rotateY(180deg);
	border-radius: 50%;
	background-image: url('http://y91036d3.beget.tech/template/img/flipcoin/t-icon.png');
	background-size: cover;
	display: block;
}

#coin.animation900 {
-webkit-animation: rotate900 3s linear forwards; 
animation: rotate900 3s linear forwards;
}

#coin.animation1080 {
-webkit-animation: rotate1080 3s linear forwards; 
animation: rotate1080 3s linear forwards;
}

#coin.animation1260 {
-webkit-animation: rotate1260 3s linear forwards; 
animation: rotate1260 3s linear forwards;
}

#coin.animation1440 {
-webkit-animation: rotate1440 3s linear forwards; 
animation: rotate1440 3s linear forwards;
}

#coin.animation1620 {
-webkit-animation: rotate1620 3s linear forwards; 
animation: rotate1620 3s linear forwards;
}

#coin.animation1800 {
-webkit-animation: rotate1800 3s linear forwards; 
animation: rotate1800 3s linear forwards;
}

#coin.animation1980 {
-webkit-animation: rotate1980 3s linear forwards; 
animation: rotate1980 3s linear forwards;
}

#coin.animation2160 {
-webkit-animation: rotate2160 3s linear forwards; 
animation: rotate2160 3s linear forwards;
}

@-webkit-keyframes rotate900 {
from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
to { -webkit-transform: rotateY(900deg); -moz-transform: rotateY(900deg); transform: rotateY(900deg); }
}

@keyframes rotate900 {
from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
to { -webkit-transform: rotateY(900deg); -moz-transform: rotateY(900deg); transform: rotateY(900deg); }
}

@-webkit-keyframes rotate1080 {
from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
to { -webkit-transform: rotateY(1080deg); -moz-transform: rotateY(1080deg); transform: rotateY(1080deg); }
}

@keyframes rotate1080 {
from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
to { -webkit-transform: rotateY(1080deg); -moz-transform: rotateY(1080deg); transform: rotateY(1080deg); }
}

@-webkit-keyframes rotate1260 {
from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
to { -webkit-transform: rotateY(1260deg); -moz-transform: rotateY(1260deg); transform: rotateY(1260deg); }
}

@keyframes rotate1260 {
from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
to { -webkit-transform: rotateY(1260deg); -moz-transform: rotateY(1260deg); transform: rotateY(1260deg); }
}

@-webkit-keyframes rotate1440 {
from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
to { -webkit-transform: rotateY(1440deg); -moz-transform: rotateY(1440deg); transform: rotateY(1440deg); }
}

@keyframes rotate1440 {
from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
to { -webkit-transform: rotateY(1440deg); -moz-transform: rotateY(1440deg); transform: rotateY(1440deg); }
}

@-webkit-keyframes rotate1620 {
from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
to { -webkit-transform: rotateY(1620deg); -moz-transform: rotateY(1620deg); transform: rotateY(1620deg); }
}

@keyframes rotate1620 {
from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
to { -webkit-transform: rotateY(1620deg); -moz-transform: rotateY(1620deg); transform: rotateY(1620deg); }
}

@-webkit-keyframes rotate1800 {
from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
to { -webkit-transform: rotateY(1800deg); -moz-transform: rotateY(1800deg); transform: rotateY(1800deg); }
}

@keyframes rotate1800 {
from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
to { -webkit-transform: rotateY(1800deg); -moz-transform: rotateY(1800deg); transform: rotateY(1800deg); }
}

@-webkit-keyframes rotate1980 {
from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
to { -webkit-transform: rotateY(1980deg); -moz-transform: rotateY(1980deg); transform: rotateY(1980deg); }
}

@keyframes rotate1980 {
from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
to { -webkit-transform: rotateY(1980deg); -moz-transform: rotateY(1980deg); transform: rotateY(1980deg); }
}

@-webkit-keyframes rotate2160 {
from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
to { -webkit-transform: rotateY(2160deg); -moz-transform: rotateY(2160deg); transform: rotateY(2160deg); }
}

@keyframes rotate2160 {
from { -webkit-transform: rotateY(0); -moz-transform: rotateY(0); transform: rotateY(0); }
to { -webkit-transform: rotateY(2160deg); -moz-transform: rotateY(2160deg); transform: rotateY(2160deg); }
}
.jucator {
    background-color: #DFDFDF;
}
.jucator2 {
    background-color: #272727;
}
</style>


<div id="mainpage" class="col-xs-9">
<center>

<div id="defaultPCF">
	<?php if(!$user) {?>
	<center>
		<h3 style="border-radius: 10px;text-align: center;color: #fff;padding: 5px;" class="ball-0 text-center">You are logged as Guest!</h3>
		<h3 style="border-radius: 10px;text-align: center;color: #fff;padding: 5px;" class="ball-1 text-center">To play you need to <a href="/login">login with Steam</a>!</h3>
	</center>
	<?php }else{ ?>
	<br>
	<p>
	<span style="font-size:18px;font-weight:bold;color:orange;">Balance: <span id="dongers"></span> <span id="cfbalance">0</span> <i style="cursor:pointer" class="fa fa-refresh noselect" id="cfgetbal"></i></span>
	</p>

			<input type="text" class="form-control input-lg" placeholder="0" id="cfbetAmount" style="margin-top:15px;">
		<br>
			<img height="100" width="100" src="http://y91036d3.beget.tech/template/img/flipcoin/ct-icon.png" id="cfSelectCT" style="border-radius: 50%"/>
			<img height="100" width="100" src="http://y91036d3.beget.tech/template/img/flipcoin/t-icon.png" id="cfSelectT" style="border-radius: 50%"/>
			<br>
			<br>
			<input id="cfCreateGame" class="btn btn-inverse btn-lg createGameCF" value="Fight" style="font-weight: bold; margin-bottom:3px;" readonly />
	<br>
			<div id="cfHist" class="margin-top:15px;container">
			</div>
</div>

		<div id="PanelCoinflip" class="hidden">
			<div class="panel text-center" style="margin-bottom:10px;margin-top:25px; padding: 20px; height:315px;">
				<input class="btn-inverse text-center backCF" value="BACK" style="font-weight: bold; border-radius: 5px; cursor: pointer;" readonly="">


				<!-- PLAYER 1 -->
				<div class="well text-center pull-left jucator" style="margin-bottom:10px;margin-top:50px; padding: 20px;border-top-left-radius:0;border-bottom-left-radius:0;width:25%;">
					<img id="P1avatar" class="rounded" src="">
					<span id="P1name">None</span>
				</div>
				<div class="well text-center pull-left jucator2" style="margin-bottom:10px;margin-top:50px; padding: 20px;border-top-left-radius:0;border-bottom-left-radius:0;">
					<img id="P1choice" class="rounded pull-right" style="width:32px;" src="">
				</div>


				<!-- PLAYER 2 -->
				<div class="well text-center pull-right jucator" style="margin-bottom:10px;margin-top:50px; padding: 20px;border-top-left-radius:0;border-bottom-left-radius:0;width:25%;">
					<img id="P2avatar" class="rounded" src="">
					<span id="P2name">None</span>
				</div>
				<div class="well text-center pull-right jucator2" style="margin-bottom:10px;margin-top:50px; padding: 20px;border-top-right-radius:0;border-bottom-right-radius:0;">
					<img id="P2choice" class="rounded pull-left" style="width:32px;" src="">
				</div>





				<div id="coin-flip-cont" style="position:relative;" class="text-center">
					<div id="coin" class="">
						<div class="front"></div>
						<div class="back"></div>
					</div>
				</div>

				<!-- JOIN GAME -->
				<br><br><br><br><br>
				<center><input id="cfJoinGame2" class="btn btn-primary btn-lg hidden" onclick="cfjoinGame()" value="Join Game" style="font-weight: bold; margin-bottom:3px;" readonly /></center>
			</div>
		</div>

<?php } ?>
</div>
</div>





<div id="crash" class="hidden" style="margin-top:25px;">
	<div id="mainpage" class="col-xs-9">
		<br>
		<center>
				<div class="crash-game-graph">
				<script>
				        var Engine = {
				          gameState: '', // either: STARTING, IN_PROGRESS,  ENDED
				          currentlyPlaying: false, // is the user playing
				          startTime: null, // when the game starts
				          lag: null // if there's lag, this should be set to the last time we heard from the server
				        }
				      </script>
				<canvas id="crash-graph" width="547" height="331" style="width: 608px; height: 368px;"></canvas>
				<script>
				        var graph = new Graph();
				        graph.startRendering(document.getElementById('crash-graph'), {
				          controlsSize: 'large', // can also be 'small'
				          currentTheme: 'black',
				          width: 456,
				          height: 257
				        });
				      </script>
				</div>
			<div class="form-group">
				<div class="input-btn bet-buttons">
					<br>
					<p>
					<span style="font-size:18px;font-weight:bold;color:orange;">Balance: <span id="dongers"></span> <span id="crbalance">0</span> <i style="cursor:pointer" class="fa fa-refresh noselect" id="crgetbal"></i></span>
					</p>
					 
					Bet:<input type="text" style="width: calc(50% - 50px);" class="form-control input-lg" placeholder="0" id="crbetSum">Auto cashout:<input type="text" style="width: calc(50% - 50px);" class="form-control input-lg" placeholder="100.00" id="crAutoWithdraw">
					<input id="joinCrash" class="btn btn-primary btn-lg joinCrash" value="Place Bet" data-todo='joinCrash' style="font-weight: bold; margin-bottom:3px;" readonly />
					 
				</div>
			</div>

			</center>
			<div class="betBlock pull-left" style="width: calc(75% - 50px);">
				<div class="panel panel-default bet-panel" id="panelcrash">
					<div class="text-center panel-body" style="padding:0px" id="panelcrash">
						<div class="total-row">
							<table class="crbetlist pull-left table table-striped dataTable no-footer"><thead><th>User</th><th>@</th><th>Bet</th><th>Profit</th></tbody></table>
						</div>
					</div>
				</div>
			</div>


			<div id="crHist" class="margin-top:15px;container; pull-right"></div>


	</div>
</div>


<div id="safebox" class="hidden" style="margin-top:25px;">
	<div id="mainpage" class="col-xs-9">
		<center><div class="infohash"><b><span style="color:red">/-EXPLANATION-\</span> </b><br>Every user is trying to open the safe with the correct code. Each try costs 500 coins. If user type in the correct code, the safe is opened and he's taking whole amount - 10% tax that the box has. Have fun and guess well!</div></center>
		<center><b><span style="color:red">Total: <span style="color:green"><div id="AvalueBox">0</div></span></span></b></center>
		<br>
		<center>
			<div class="form-group">
				<div class="input-btn bet-buttons">
					<br>
					<p>
					<span style="font-size:18px;font-weight:bold;color:orange;">Balance: <span id="dongers"></span> <span id="sbbalance">0</span> <i style="cursor:pointer" class="fa fa-refresh noselect" id="sbgetbal"></i></span>
					</p>
					<b>Unlock code [10-99]: <b/><input type="text" style="width: calc(25% - 50px);" class="form-control input-lg" placeholder="0" id="sbBetSum">
					<input id="addSB" class="btn btn-primary btn-lg addSB" value="Try unlock" style="font-weight: bold; margin-bottom:3px;" readonly />
					<br><br>
						<div id="sbHist" class="margin-top:15px;container"></div>
				</div>
			</div>
		</center>
	</div>

</div>








	<?php include "Templates/Agreement.php"; ?>
	<?php include "Templates/Footer.php"; ?>	
</body></html>