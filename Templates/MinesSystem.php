<center>

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
</style>
<head>
<div style="font-size: 13px;background-color: #efefef; padding: 10px 20px; margin-right: 5px; color: #fff; border-radius: 10px;">
<h1><span style="color:black">Balance: <span id="Coins">0</span></span></h1>
	<input type="text" class="form-control input-lg" placeholder="Bet amount..." id="betAmount" value="0">
				<input type="button" id="selectMineGameType" class="btn btn-default betshort" value="x1" style="font-weight: bold; margin-bottom:5px; width: 5%;" onclick="selectMineGameType(1)" readonly="">
				<input type="button" id="selectMineGameType" class="btn btn-default betshort" value="x3" style="font-weight: bold; margin-bottom:5px; width: 5%;" onclick="selectMineGameType(3)" readonly="">
				<input type="button" id="selectMineGameType" class="btn btn-default betshort" value="x5" style="font-weight: bold; margin-bottom:5px; width: 5%;" onclick="selectMineGameType(5)" readonly="">
				<input type="button" id="selectMineGameType" class="btn btn-default betshort" value="x24" style="font-weight: bold; margin-bottom:5px; width: 5%;" onclick="selectMineGameType(24)" readonly="">
				<input type="button" id="startMineGame" class="btn btn-primary betshort" value="Start Game" style="font-weight: bold; margin-bottom:3px;" onclick="startMineGame()" readonly="">
	<br>
	<br>

</div>	
<br>
	<div id="TilesTiles">
		<div id="showmine" class="hidden"></div>
	</div>
	<br>
</center>

<center><button type="button" class="btn-lg betButton" id="hideorshow">Hide</button></center>
<div id="container" class="container">
<table class='table table-striped dataTable no-footer'><thead><th>Round ID</th><th>User</th><th>Bet</th><th>Multiplier</th><th>Cashout</th><th>Result</th><th>Time</th></thead><tbody>
				<?php foreach($mines as $key => $value): ?>



					<tr><td>#<?=$value['id']?></td>
					<td><? echo '<a href="http://steamcommunity.com/profiles/'.$value['steamid'].'">'.$value['name'].'</a>';?></td>
					<td><?=$value['bet']?></td>
          <td><?=$value['multiplier']?>x</td>
					<td><?if($value['result'] == 0){
						echo '<span style="color:red">0</span>';
					}else{
						echo '<span style="color:green">'.$value['amount'].'</span>';
					}
					?></td>
					<td><?php if($value['result'] == 0){
						echo '<span style="color:red">LOST</span>';
					}else {
						echo '<span style="color:green">WON</span>';
					}
					?></td>
					<td><?=date('H:i:s', $value['time'])?></td>
				</tr>
				<?php endforeach; ?>
				</tbody></table>
</div>



<?php
	$secret = "cacat";
?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" ></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>

<script type="text/javascript" src="https://rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>
<script language="javascript" type="text/javascript" src="http://y91036d3.beget.tech/Templates/minecs.js"></script>


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

	$('#hideorshow').click(function() {
	    $('#container').toggle();
	    if( $('#hideorshow').text() == "Hide") {
	    	$('#hideorshow').text('Show');
	    }else{
	    	$('#hideorshow').text('Hide');
	    }
	});

	var Secret = "cacat";

	updateLastRolls();

	function updateLastRolls() {
		setInterval(function() {
			$("#container").load(location.href+" #container>*","");
		}, 200);
	}

function time() {
	return parseInt(new Date().getTime()/1000);
}

function getCookie(key){
	var patt = new RegExp(key+"=([^;]*)");
	var matches = patt.exec(document.cookie);
	if(matches){
		return matches[1];
	}
	return "";
}


</script>