<html lang="en"><head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Roulette History - y91036d3.beget.tech</title>
		
		<?php include 'Templates/DarkTemplate.php'; ?>

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
<div class="container">
	<?php include "Templates/RouletteHistory.php"; ?>	
</div>
	<?php include "Templates/Agreement.php"; ?>
	<?php include "Templates/Footer.php"; ?>			
	
</body></html>