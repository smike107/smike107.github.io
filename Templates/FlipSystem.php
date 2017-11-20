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
.button2 {
    font-size: 10px;
    line-height: 20px;
    width: 150px;
    height: 40px;
    background: linear-gradient(#53ED4E, #26D435);
    border: 3px solid #87FF97;
    border-radius: 5px;
    text-shadow: 0 0 20px rgba(0, 255, 0, 0.9);
    -webkit-transition: .1s;
    transition: .1s;
    -webkit-transform: scale(1);
    transform: scale(1);
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    box-shadow: 0 0 50px rgb(0, 255, 0);
    overflow: hidden;
    font-weight: 700;
    text-transform: uppercase;
    text-align: center;
    color: #fff;
    display: inline-block;
}
</style>
<head>
<div style="font-size: 13px;background-color: #efefef; padding: 10px 20px; margin-right: 5px; color: #fff; border-radius: 10px;">
<h1><span style="color:black">Balance: <span id="Coins">0</span></span></h1>
  <input type="text" class="form-control input-lg" placeholder="Bet amount..." id="betAmount" value="0">
          <button type="button" class="btn btn-danger betshort" data-action="clear">Clear</button>
          <button type="button" class="btn btn-default betshort" data-action="10">+10</button>
          <button type="button" class="btn btn-default betshort" data-action="100">+100</button>
          <button type="button" class="btn btn-default betshort" data-action="1000">+1000</button>
          <button type="button" class="btn btn-default betshort" data-action="half">1/2</button>
          <button type="button" class="btn btn-default betshort" data-action="double">x2</button>
          <button type="button" class="btn btn-primary betshort" data-action="max">Max</button>
  <br>
  <br>
  <button class="btn-lg  btn-block button" onclick="roll('Low')">Low    [1-3]</button>
  <button class="btn-lg  btn-block button" onclick="roll('High')">High    [4-6]</button>
  <br>
  <button class="btn-lg  btn-block button2" onclick="roll('One')">[1]</button>
  <button class="btn-lg  btn-block button2" onclick="roll('Two')">[2]</button>
  <button class="btn-lg  btn-block button2" onclick="roll('Three')">[3]</button>
  <button class="btn-lg  btn-block button2" onclick="roll('Four')">[4]</button>
  <button class="btn-lg  btn-block button2" onclick="roll('Five')">[5]</button>
  <button class="btn-lg  btn-block button2" onclick="roll('Six')">[6]</button>
</div>  
  <h3><span id="Image"><img src='http://y91036d3.beget.tech/template/img/flip/faranumar.png'></span></h3>
</center>
<center><button type="button" class="btn-lg betButton" id="hideorshow">Hide</button></center>
<div id="container" class="container">
<table class='table table-striped dataTable no-footer'><thead><th>Round ID</th><th>User</th><th>Bet</th><th>Roll</th><th>Profit</th><th>Result</th><th>Time</th></thead><tbody>
        <?php foreach($capeflip as $key => $value): ?>



          <tr><td>#<?=$value['id']?></td>
          <td><? echo '<a href="http://steamcommunity.com/profiles/'.$value['steamid'].'">'.$value['name'].'</a>';?></td>
          <td><?=$value['bet']?></td>
          <td><?=$value['roll']?></td>
          <td><?
          if($value['value'] == 'normal') {
              $Amountdubbled = 2*($value['amount']);
          }else {
              $Amountdubbled = 5*($value['amount']);
          }


          if($value['result'] == 1){
            echo '<span style="color:green">+'.$Amountdubbled.'</span>';
          }else{
            echo '<span style="color:red">-'.$value['amount'].'</span>';
          }
          ?></td>
          <td><?php if($value['result'] == 1){
            echo '<span style="color:green">WIN</span>';
          }else {
            echo '<span style="color:red">LOSE</span>';
          }
          ?></td>
          <td><?=date('H:i:s', $value['time'])?>
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

<script language="javascript" type="text/javascript" src="http://y91036d3.beget.tech/Templates/flipcs.js"></script>


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
</script>