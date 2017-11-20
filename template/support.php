<html lang="en"><head>
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
		<script type="text/javascript">
            var reload = true;
            $(document).ready(function(){
                $(".support_button").on("click",function(){
                    var tid = $(this).data("x");
                    var title = $("#ticketTitle").val();
                    var cat = $("#ticketCat").val();
                    var body = $("#text"+tid).val();
                    var close = $("#check"+tid).is(":checked")?1:0;
                    var flag = $("#flag"+tid).is(":checked")?1:0;
                    var lmao = $("#lmao"+tid).is(":checked")?1:0;
                    var conf = "Are you sure you wish to submit this reply?";
                    if(tid==0){
                        if(title.length==0){
                            bootbox.alert("Title cannot be left blank.");
                            return;
                        }else if(cat==0){
                            bootbox.alert("Department cannot be left blank.");
                            return;
                        }else if(body.length==0){
                            bootbox.alert("Description cannot be left blank.");
                            return;
                        }
                        conf = "Are you sure you wish to submit this ticket?<br><br><b style='color:red'>WARNING: Misuse of this system will result in a 1 week ban.</b>";
                    }                        
                    bootbox.confirm(conf,function(result){
                        if(result){
                            $.ajax({
                                url:"/support_new",
                                type:"POST",
                                data:{"tid":tid,"title":title,"reply":body,"close":close,"cat":cat,"flag":flag,"lmao":lmao},
                                success:function(data){
                                    try{
                                        data = JSON.parse(data);
                                        if(data.success){
                                            bootbox.alert(data.msg,function(){
                                                if(reload){
                                                   location.reload(); 
                                               }                                                
                                            });                     
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
</script>		<div class="container" style="margin-bottom:20%">
<div class="alert alert-warning">You have <a href="?open"><?=$open?> open tickets</a> and <a href="?closed"><?=$closed?> closed tickets</a>.</div>
<? if(isset($_GET['new'])) { ?>
<div class="panel panel-info text-left">
<div class="panel-heading">
<input id="ticketTitle" type="text" class="form-control" placeholder="Title..." maxlength="100">
</div>
<div class="panel-body">
<select class="form-control" id="ticketCat">
    <option value="0">Category...</option>
    <option value="1">Deposit / Withdraw</option>
    <option value="2">Rates</option>
    <option value="3">Advertising</option>
    <option value="4">Donations</option>
</select>
<br>
<textarea id="text0" class="form-control" rows="10" placeholder="Description..."></textarea><br>
<button data-x="0" type="button" class="btn btn-danger btn-block support_button">Apply</button>
</div>
</div>
<? } elseif(isset($_GET['closed'])) { ?>
<? foreach ($tickets as $key => $value) { ?>
<div class="panel panel-info text-left"><div class="panel-heading"><h4><?=$value['title']?></h4></div><div class="panel-body">
<? foreach ($value['messages'] as $key2 => $value2) { ?>
<div class="alert alert-<?=($user['steamid']==$value2['user'])?'info':'warning'?> bubble"><?=$value2['message']?></div>
<? } ?>
</div></div>
<? } ?>
<? } elseif(isset($_GET['open'])) { ?>
<div class="panel panel-info text-left"><div class="panel-heading"><h4><?=$ticket['title']?></h4></div><div class="panel-body">
<? foreach($ticket['messages'] as $key => $value): ?>
<div class="alert alert-<?=($user['steamid']==$value['user'])?'info':'warning'?> bubble"><?=$value['message']?></div>
<? endforeach; ?>
<div class="alert alert-info"><textarea id="text<?=$ticket['id']?>" class="form-control" rows="3" placeholder="Reply..."></textarea><label><input id="check<?=$ticket['id']?>" type="checkbox"> Close Ticket</label><button data-x="<?=$ticket['id']?>" type="button" class="btn btn-success btn-block support_button">Reply</button></div></div></div>
<? } else { ?>
	
<div class="panel panel-info">
  <div class="panel-heading"><h4>How do I send coins to people??</h4></div>
  <div class="panel-body">
    <p>To send coins use the chat command "/send [steam64id] [amount]".</p>

    <p>For example, to send 100 coins to steam64id 76561198160884702 you'd type "/send 76561198160884702 100".".</p>

    <p>Alternatively right click the person's avatar in chat and select "Send coins.</p>

    <p>To find your steam64id you can use sites like <a target="_blank" href="https://steamid.io/lookup">steamid.io</a></p>

  </div>
</div>
<div class="panel panel-info">
  <div class="panel-heading"><h4>How do I get more coins? Can I have free coins??</h4></div>
  <div class="panel-body">
    <p>Coins are obtained by depositing CS:GO skins. If you've used up the free 100 coins you'll need to make a deposit to get more..</p>

    <b>DO NOT contact support asking for coins.</b>
  </div>
</div>
<div class="panel panel-info">
  <div class="panel-heading"><h4>How do I generate a referral code?</h4></div>
  <div class="panel-body">
    <p>To generate your own referral code please visit the affiliates page located here. <a target="_blank" href="/affiliates">affiliates</a>.</p>
  </div>
</div>
<div class="panel panel-info">
  <div class="panel-heading"><h4>I accepted the trade offer but never got coins!?</h4></div>
  <div class="panel-body">
    After accepting the trade offer you must wait a few minutes and you'll receive the coins.
	If you don't get your coins directly then please wait a few minutes.
	Write a support ticket only if you still haven't got your coins after 2 hours.
  </div>
</div>
<div class="panel panel-info">
  <div class="panel-heading"><h4>Error when sending trade offer. Mobile Verification not enabled or Steam Lagging.</h4></div>
  <div class="panel-body">
    <b>Possible solutions:</b>
	<br>
	- Wait 7 days after you active your Steam Mobile Verification.
	<br>
	- Make your Steam Profile & Inventory public..
	<br>
	- Check if the trade url you set is correct.
	<br>
	- Check if steam isn't delayed. Steam Status
	<br>
	If you are sure that none of these reasons are the problem then please retry a few times in a different hour.
  </div>
</div>
<div class="panel panel-info">
  <div class="panel-heading"><h4>I keep getting "connection lost..."!</h4></div>
  <div class="panel-body">
    <b>Please do the following points and then try:</b>
	<br>
	- Please do the following points and then try.
	<br>
	- Clear your browser cookies and cache.
	<br>
	- Restart your router.
	<br>
	Then please start refreshing the site until you suddenly get connected.
  </div>
</div>
<a class="btn btn-danger btn-lg btn-block" href="?new">You need more help? Send a ticket to support</a>
 <? } ?>
		</div>
	<?php include "Templates/Agreement.php"; ?>
	<?php include "Templates/Footer.php"; ?>				
	
</body></html>