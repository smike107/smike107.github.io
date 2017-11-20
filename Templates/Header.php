		<ul class="nav navbar-nav">
				<li class="" style="margin-left:5px"><a href="/"><i  class="fa fa-home"></i>&nbsp;Home</a></li>
				<li class=""><a href="/deposit"><i class="fa fa-money" aria-hidden="true"></i>&nbsp;Deposit</a></li>
				<li class=""><a href="/withdraw"><i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp;Withdraw</a></li>
				<!--<li class=""><a href="/dice"><i class=""></i>&nbsp;Dice</a></li>-->
				<li class=""><a href="/rolls"><i class="fa fa-check"></i>&nbsp;Provably Fair</a></li>
				<!--<li class=""><a href="/affiliates"><i class="fa fa-user-plus"></i>&nbsp;Affiliates</a></li>-->
				<li><a href="#" data-toggle="modal" data-target="#promoModal"><i class="fa fa-ticket fa-fw" aria-hidden="true"></i>&nbsp;Redeem code</a></li>
				<?php if($user['rank'] == 100) {?>
				<li class=""><a href="/apanel"><i class="fa fa-users" aria-hidden="true"></i>&nbsp;Admin Panel</a></li>
				<?php } ?>
				<?php if(($user['rank'] == "1") OR ($user['rank'] == "100")) {?>
				<li class=""><a href="/adminsupport"><i class="fa fa-ticket" aria-hidden="true"></i>&nbsp;Support Panel</a></li>
				<?php }else{ ?>
				<li class=""><a href="/support"><i class="fa fa-ticket"></i>&nbsp;Support</a></li>
				<?php } ?>
			</ul>