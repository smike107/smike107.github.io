"use strict";
var CASEW = 1050;
var LAST_BET = 0;
var MAX_BET = 0;
var HIDEG = false;
var USER = "";
var RANK = 0;
var ROUND = 0;
var HOST = ":8080";
var SOCKET = null;
var showbets = true;

function todongers(x) {
	if ($("#settings_dongers").is(":checked")) {
		return (x / 1000);
	}
	return x;
}

function todongersb(x) {
	if ($("#settings_dongers").is(":checked")) {
		return (x / 1000).toFixed(3);
	}
	return x;
}

//CRASH SETTINGS:
var carnat = null;
var betplaced;



//BALANCES TO UPDATE:
var allBalances = '#balance, #dbalance, #mbalance, #jbalance, #crbalance, #cfbalance, #sbbalance, #b1balance, #b2balance, #b3balance, #b4balance';
var allGBalances = '#rgetbal, #dgetbal, #mgetbal, #jgetbal, #cfgetbal, #crgetbal, #sbgetbal, #b1getbal, #b2getbal, #b3getbal, #b4getbal';



//COINFLIP SETTINGS
var spinArray = ['animation900', 'animation1080'];
var watchingGame = 0;
var watchingGameID = 0;


//MBOX SETTINGS
var boxIsMoving = false;
var mAnimstart = 0;
var $MBOX01 = null;
var $MBOX02 = null;
var $MBOX03 = null;
var $MBOX04 = null;
var mSnapX = 0;
var mBoxStarted = 0;
var mR = 0.999;
var mS = 0.01;
var mtf = 0;
var mvi = 0;




var snapX = 0;
var R = 0.999;
var S = 0.01;
var tf = 0;
var vi = 0;
var animStart = 0;
var isMoving = false;
var LOGR = Math.log(R);
var $CASE = null;
var $BANNER = null;
var $CHATAREA = null;
var SCROLL = true;
var LANG = 1;
var IGNORE = [];
var sounds_rolling = new Audio('http://y91036d3.beget.tech/template/sounds/rolling.wav');
var sounds_tone = new Audio('http://y91036d3.beget.tech/template/sounds/tone.wav');

var sounds_rolling2 = new Audio('http://y91036d3.beget.tech/template/sounds/rolling.wav');
var sounds_tone2 = new Audio('http://y91036d3.beget.tech/template/sounds/tone.wav');

var sounds_type = new Audio('http://y91036d3.beget.tech/template/sounds/safebox/write.mp3');
var sounds_won = new Audio('http://y91036d3.beget.tech/template/sounds/safebox/win.mp3');

var sounds_boom = new Audio('http://y91036d3.beget.tech/template/sounds/mines/boom.mp3');
var sounds_click = new Audio('http://y91036d3.beget.tech/template/sounds/mines/click.mp3');
sounds_boom.volume = 0.75;
sounds_click.volume = 0.5;

sounds_rolling2.volume = 0.75;
sounds_tone2.volume = 0.5;

sounds_type.volume = 0.5;
sounds_won.volume = 0.75;

sounds_rolling.volume = 0.75;
sounds_tone.volume = 0.5;


//JACKPOT SCRIPTS
var $JBANNER = null;
var $JTOTAL = null;
var $JCHANCE = null;
var yourjackpotchance = 0;
var yourjackpotbet = 0;
var jackpotTotal = 0;



var botsEnabled = 0;

function play_sound(x) {
	var conf = $("#settings_sounds").is(":checked");
	if (conf) {
		if (x == "roll") {
			sounds_rolling.play();
		} else if (x == "finish") {
			sounds_tone.play();
		} else if(x == "boom") {
			sounds_boom.play();
		} else if(x == "click") {
			sounds_click.play();
		} else if(x == "roll2") {
			sounds_rolling2.play();
		} else if(x == "finish2") {
			sounds_tone2.play();
		} else if(x == "type") {
			sounds_type.play();
		} else if(x == "win") {
			sounds_won.play();
		}
	}
}


function showLoad(ID){
	if(ID){
		var Atributul = $('#'+ID).attr('hidden');
		if(Atributul == false) {
			$('#'+ID).toggle();
			$('#'+ID).attr('hidden', true);
		}else{
			$('#'+ID).toggle();
			$('#'+ID).attr('hidden', false);
		}
	}else{
		console.log('This ID does not exists!');
	}
}



// DICES GAME
var mGameIsStarted = 0;
var mSelectedGameType = 0;
var mSummagame = 0;
var CannotUsePlayButton = 0;


function diceGameType(type) {
	if(SOCKET) {
		if(AutomaticBettingStarted == 1) {
			return $.notify('You cannot change the gametype while the automatic betting is on.', 'error');
		}
		if(type == "Low") {
			mSelectedGameType = "Low";
			$('.dice1').addClass('active');
			$('.dice2').removeClass('active');
			$('.dice3').removeClass('active');
		}else if(type == "Medium") {
			mSelectedGameType = "Medium";
			$('.dice2').addClass('active');
			$('.dice1').removeClass('active');
			$('.dice3').removeClass('active');
		}else if(type == "High") {
			mSelectedGameType = "High";
			$('.dice3').addClass('active');
			$('.dice1').removeClass('active');
			$('.dice2').removeClass('active');
		}else {
			mSelectedGameType = "0";
			$('.dice1').removeClass('active');
			$('.dice2').removeClass('active');
			$('.dice3').removeClass('active');
		}
	}
}

function startDicesGame() {
	if(SOCKET){
		if(CannotUsePlayButton == 1) {
			return $.notify('You cannot start a new game during automatic betting!', 'error');
		}
		if(mGameIsStarted == 1){

		}else {
			var amount = str2int($("#dbetAmount").val());
			mSummagame = amount;
		}

		SOCKET.emit('Dices', {
			type: mSelectedGameType,
			suma: mSummagame,
			started: mGameIsStarted,
			tip: 'startDice'
		});
	}
}

var automaticBetterTime = 3000;
var interval;
var AutomaticBettingStarted = 0;
var AutomatedAB = 0;

function DicesAutomaticBet() {
	if(SOCKET){
		if(AutomaticBettingStarted == 0) {
			if(mSelectedGameType != 0) {
				CannotUsePlayButton = 1;
				AutomaticBettingStarted = 1;
				var amount = str2int($("#dbetAmount").val());
				AutomatedAB = amount;
				interval = setInterval(function () {
					SOCKET.emit('Dices', {
						type: mSelectedGameType,
						suma: AutomatedAB,
						started: mGameIsStarted,
						tip: 'AstartDice'
					});
				}, automaticBetterTime);
				$.notify('Automatic betting started! Amount: '+AutomatedAB+' & Interval time: '+automaticBetterTime/1000+' seconds.', 'success');
				$('.AutomatedBets').html('<span style="color:green">ON</span>');
			}else {
				$.notify('You need to select a game type to play.', 'error');
			}
		}else {
			CannotUsePlayButton = 0;
			AutomatedAB = 0;
			AutomaticBettingStarted = 0;
			clearInterval(interval);
			$.notify('Automatic betting stopped!', 'success');
			$('.AutomatedBets').html('<span style="color:red">OFF</span>');
		}
	}
}



function mineGameType(type) {
	if(SOCKET) {
		if(selectedGameType != 0 && gameIsStarted == 1) {
			return $.notify('You cannot change the gametype while the game is already started.', 'error');
		}
		if(type == "1") {
			selectedGameType = "1";
			$('.type1').addClass('active');
			$('.type2').removeClass('active');
			$('.type3').removeClass('active');
			$('.type4').removeClass('active');
		}else if(type == "3") {
			selectedGameType = "3";
			$('.type2').addClass('active');
			$('.type1').removeClass('active');
			$('.type3').removeClass('active');
			$('.type4').removeClass('active');
		}else if(type == "5") {
			selectedGameType = "5";
			$('.type3').addClass('active');
			$('.type1').removeClass('active');
			$('.type2').removeClass('active');
			$('.type4').removeClass('active');
		}else if(type == "24") {
			selectedGameType = "24";
			$('.type4').addClass('active');
			$('.type1').removeClass('active');
			$('.type2').removeClass('active');
			$('.type3').removeClass('active');
		}else {
			selectedGameType = "0";
			$('.type4').removeClass('active');
			$('.type1').removeClass('active');
			$('.type2').removeClass('active');
			$('.type3').removeClass('active');
		}
	}
}


var gameIsStarted = 0;
var selectedGameType = 0;
var definedGameType = 0;
var summaGame = 0;
var canCheckTiles = 0;
var gameID = null;
var amountyoucanwin = 0;
var clickedBomb = 0;
var TilesClicked = 0;
var gotBombs = 0;

//BOMBS
var m1Bomb01;
var m3Bomb01;
var m3Bomb02;
var m3Bomb03;
var m5Bomb01;
var m5Bomb02;
var m5Bomb03;
var m5Bomb04;
var m5Bomb05;
var m24noBomb;

function getBombs() {
	if(SOCKET){
		if(gotBombs == 0) {
			SOCKET.emit('mineSweeper', {
				tipm: 'getBombs',
				gotBombs: '0',
				tipJocm: selectedGameType
			});
		}else{
			SOCKET.emit('mineSweeper', {
				tipm: 'getBombs',
				gotBombs: '1'
			});
		}
	}
}

function cashoutMineGame(gameID) {
	if(SOCKET){
		var AmountWon = amountyoucanwin;
		if(gameIsStarted == 0) {
			SOCKET.emit('mineSweeper', {
				tip: 'cashout',
				suma: AmountWon,
				gameStarted: '0',
				gamenrID: gameID
			});
		}else{
			gameIsStarted = 0;
			canCheckTiles = 0;

			SOCKET.emit('mineSweeper', {
				tip: 'cashout',
				suma: AmountWon,
				gameStarted: '1',
				gamenrID: gameID,
				summaGame: summaGame,
				CheckedTiles: TilesClicked,
				minaTypeselectata: selectedGameType
			});

			if(selectedGameType == '1') {
				$('#gameID'+gameID+'.tile'+m1Bomb01).addClass('fa fa-bomb fa-lg');
				$('#gameID'+gameID+'.tile'+m1Bomb01).css('background-color', '#d3433c');
				$('#gameID'+gameID+'.tile'+m1Bomb01).addClass('checked');
				$('#gameID'+gameID+'.tile'+m1Bomb01).removeClass('unchecked');
			}else if(selectedGameType == '3') {
				$('#gameID'+gameID+'.tile'+m3Bomb01).addClass('fa fa-bomb fa-lg');
				$('#gameID'+gameID+'.tile'+m3Bomb01).css('background-color', '#d3433c');
				$('#gameID'+gameID+'.tile'+m3Bomb01).addClass('checked');
				$('#gameID'+gameID+'.tile'+m3Bomb01).removeClass('unchecked');

				$('#gameID'+gameID+'.tile'+m3Bomb02).addClass('fa fa-bomb fa-lg');
				$('#gameID'+gameID+'.tile'+m3Bomb02).css('background-color', '#d3433c');
				$('#gameID'+gameID+'.tile'+m3Bomb02).addClass('checked');
				$('#gameID'+gameID+'.tile'+m3Bomb02).removeClass('unchecked');

				$('#gameID'+gameID+'.tile'+m3Bomb03).addClass('fa fa-bomb fa-lg');
				$('#gameID'+gameID+'.tile'+m3Bomb03).css('background-color', '#d3433c');
				$('#gameID'+gameID+'.tile'+m3Bomb03).addClass('checked');
				$('#gameID'+gameID+'.tile'+m3Bomb03).removeClass('unchecked');
			}else if(selectedGameType == '5') {
				$('#gameID'+gameID+'.tile'+m5Bomb01).addClass('fa fa-bomb fa-lg');
				$('#gameID'+gameID+'.tile'+m5Bomb01).css('background-color', '#d3433c');
				$('#gameID'+gameID+'.tile'+m5Bomb01).addClass('checked');
				$('#gameID'+gameID+'.tile'+m5Bomb01).removeClass('unchecked');

				$('#gameID'+gameID+'.tile'+m5Bomb02).addClass('fa fa-bomb fa-lg');
				$('#gameID'+gameID+'.tile'+m5Bomb02).css('background-color', '#d3433c');
				$('#gameID'+gameID+'.tile'+m5Bomb02).addClass('checked');
				$('#gameID'+gameID+'.tile'+m5Bomb02).removeClass('unchecked');

				$('#gameID'+gameID+'.tile'+m5Bomb03).addClass('fa fa-bomb fa-lg');
				$('#gameID'+gameID+'.tile'+m5Bomb03).css('background-color', '#d3433c');
				$('#gameID'+gameID+'.tile'+m5Bomb03).addClass('checked');
				$('#gameID'+gameID+'.tile'+m5Bomb03).removeClass('unchecked');

				$('#gameID'+gameID+'.tile'+m5Bomb04).addClass('fa fa-bomb fa-lg');
				$('#gameID'+gameID+'.tile'+m5Bomb04).css('background-color', '#d3433c');
				$('#gameID'+gameID+'.tile'+m5Bomb04).addClass('checked');
				$('#gameID'+gameID+'.tile'+m5Bomb04).removeClass('unchecked');

				$('#gameID'+gameID+'.tile'+m5Bomb05).addClass('fa fa-bomb fa-lg');
				$('#gameID'+gameID+'.tile'+m5Bomb05).css('background-color', '#d3433c');
				$('#gameID'+gameID+'.tile'+m5Bomb05).addClass('checked');
				$('#gameID'+gameID+'.tile'+m5Bomb05).removeClass('unchecked');
			}else if(selectedGameType == '24') {
				for(var kk = 0; kk <= 25; kk++) {
					if(kk == m24noBomb) {

					}else{
						$('#gameID'+gameID+'.tile'+kk).addClass('fa fa-bomb fa-lg');
						$('#gameID'+gameID+'.tile'+kk).css('background-color', '#d3433c');
						$('#gameID'+gameID+'.tile'+kk).addClass('checked');
						$('#gameID'+gameID+'.tile'+kk).removeClass('unchecked');
					}
				}
			}

			m1Bomb01 = 0;
			m3Bomb01 = 0;
			m3Bomb02 = 0;
			m3Bomb03 = 0;
			m5Bomb01 = 0;
			m5Bomb02 = 0;
			m5Bomb03 = 0;
			m5Bomb04 = 0;
			m5Bomb05 = 0;
			m24noBomb = 0;
		}
	}

}

function startMineGame() {
	if(SOCKET){
		TilesClicked = 0;
		if(gameIsStarted == 1){

		}else {
			if(gameID == null) {
				gameID = 0;
			}else {
				gameID++;
			}

			var amount = str2int($("#mbetAmount").val());
			var canCheckTiles = 1;
			summaGame = amount;
			amountyoucanwin = amount;
			$('span#amountyoucanwin.gameID'+gameID).html(parseInt($('span#amountyoucanwin.gameID'+gameID).html(), 10)+ amountyoucanwin);

			getBombs();
		}

		SOCKET.emit('mineSweeper', {
			type: selectedGameType,
			suma: amount,
			started: gameIsStarted,
			gamenrid: gameID,
			cchecktiles: canCheckTiles,
			tip: 'start'
		});
	}
}

function checkTile(number, gameid) {
	if(SOCKET) {
			if($('#gameID'+gameID+'.tile'+number).hasClass('checked')) {
				
			}else {
				TilesClicked++;
			}

			if(selectedGameType == '1') {
				SOCKET.emit('mineSweeper', {
					numarTile: number,
					nrrgameid: gameid,
					cchecktiles: canCheckTiles,
					tipJoc: selectedGameType,
					tip: 'checkTile',
					sumaJoc: summaGame,
					TilesClicked: TilesClicked,
					trimiteBomb01: m1Bomb01
				});
			}else if(selectedGameType == '3') {
				SOCKET.emit('mineSweeper', {
					numarTile: number,
					nrrgameid: gameid,
					cchecktiles: canCheckTiles,
					tipJoc: selectedGameType,
					tip: 'checkTile',
					sumaJoc: summaGame,
					TilesClicked: TilesClicked,
					trimiteBomb01: m3Bomb01,
					trimiteBomb02: m3Bomb02,
					trimiteBomb03: m3Bomb03
				});
			}else if(selectedGameType == '5') {
				SOCKET.emit('mineSweeper', {
					numarTile: number,
					nrrgameid: gameid,
					cchecktiles: canCheckTiles,
					tipJoc: selectedGameType,
					tip: 'checkTile',
					sumaJoc: summaGame,
					TilesClicked: TilesClicked,
					trimiteBomb01: m5Bomb01,
					trimiteBomb02: m5Bomb02,
					trimiteBomb03: m5Bomb03,
					trimiteBomb04: m5Bomb04,
					trimiteBomb05: m5Bomb05
				});
			}else if(selectedGameType == '24') {
				SOCKET.emit('mineSweeper', {
					numarTile: number,
					nrrgameid: gameid,
					cchecktiles: canCheckTiles,
					tipJoc: selectedGameType,
					tip: 'checkTile',
					sumaJoc: summaGame,
					TilesClicked: TilesClicked,
					trimitenoBomb: m24noBomb
				});
			}
	}
}


function cfjoinGame(id, p2_pick) {
	if(SOCKET) {
		send({
			type: 'joincfgame',
			gamenr: id,
			pick_p2: p2_pick
		});
	}
}

function cfwatchGame(id, amount) {
	if(SOCKET) {
		send({
			type: 'watchcfgame',
			gamenr: id,
			suma: amount
		});
	}
}

function onGames(msg) {
	var m = msg;

	if(m.type == "mines") {

		if(m.receiveNextAmount == 1) {
			var nextAmount = $('span#amountnextwon.gameID'+gameID);
			if(TilesClicked >= 24) {
				nextAmount.html('<span style="color:orange">Done</span>');
			}else {
				nextAmount.html('<span style="color:green">+'+m.amountt+'</span>');
			}
		}


		if(m.gameHacked == 1) {
			gameIsStarted = 0;
			canCheckTiles = 0;
		}

		if(m.sendBombs == 1) {
			if(m.sendTipJocM == '1') {
				m1Bomb01 = m.bomb01;
			}else if(m.sendTipJocM == '3') {
				m3Bomb01 = m.bomb01;
				m3Bomb02 = m.bomb02;
				m3Bomb03 = m.bomb03;
			}else if(m.sendTipJocM == '5') {
				m5Bomb01 = m.bomb01;
				m5Bomb02 = m.bomb02;
				m5Bomb03 = m.bomb03;
				m5Bomb04 = m.bomb04;
				m5Bomb05 = m.bomb05;
			}else if(m.sendTipJocM == '24') {
				m24noBomb = m.noBomb;
			}
		}



		if(m.started == '1') {
			if(m.gameEnd) {
				if(m.cashout == '1') {
					$.notify('Game were cashout. Amount collected: '+m.amountcollected, 'success');
					gameIsStarted = 0;
					$('span#amountnextwon.gameID'+gameID).html('<span style="color:blue">✓</span>');
				}else if(m.cashout == '0') {
					gameIsStarted = 0;
					$.notify('You clicked a bomb! Try again.', 'error');
				}
			}else {
				if(!m.tile) {
					gameIsStarted = m.started;
					$('#showmine').before('<div id="showmine" class="shown"><div class="form-group" style="margin-top:15px;"><div class="input-btn bet-buttons"><center><span style="font-size:18px;font-weight:bold">Amount: <span id="amountyoucanwin" class="gameID'+gameID+'">0</span> || <span style="font-size:18px;font-weight:bold">Next: <span id="amountnextwon" class="gameID'+gameID+'">0</span>       </center><br><input id="cashoutMine" class="btn btn-info betshort" value="Cashout" style="font-weight: bold; margin-bottom:3px;" onclick="cashoutMineGame('+gameID+')" readonly=""></div></span><br>Hash: <div class="HashID'+gameID+'"></div></div><div class="well text-center" style="margin-bottom:5px;width:350px;height:350px;padding-right:1px;"><center><div class="tiles"><div id="gameID'+gameID+'" class="tile tile1 unchecked" onclick="checkTile(1, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile2 unchecked" onclick="checkTile(2, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile3 unchecked" onclick="checkTile(3, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile4 unchecked" onclick="checkTile(4, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile5 unchecked" onclick="checkTile(5, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile6 unchecked" onclick="checkTile(6, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile7 unchecked" onclick="checkTile(7, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile8 unchecked" onclick="checkTile(8, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile9 unchecked" onclick="checkTile(9, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile10 unchecked" onclick="checkTile(10, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile11 unchecked" onclick="checkTile(11, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile12 unchecked" onclick="checkTile(12, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile13 unchecked" onclick="checkTile(13, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile14 unchecked" onclick="checkTile(14, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile15 unchecked" onclick="checkTile(15, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile16 unchecked" onclick="checkTile(16, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile17 unchecked" onclick="checkTile(17, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile18 unchecked" onclick="checkTile(18, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile19 unchecked" onclick="checkTile(19, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile20 unchecked" onclick="checkTile(20, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile21 unchecked" onclick="checkTile(21, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile22 unchecked" onclick="checkTile(22, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile23 unchecked" onclick="checkTile(23, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile24 unchecked" onclick="checkTile(24, '+gameID+')"></div><div id="gameID'+gameID+'" class="tile tile25 unchecked" onclick="checkTile(25, '+gameID+')"></div></div></center></div></div>');
					canCheckTiles = 1;
				}else {
					if(m.trimitegameID == gameID) {
						if($('#gameID'+m.trimitegameID+'.tile'+m.tile).hasClass('checked')) {
							SOCKET.emit('mineSweeper', {
								verificareTile: 'checked'
							});
						}else {
							if(m.result == "lost") {
								$('span#amountyoucanwin.gameID'+gameID).html('<span style="color:red">0</span>');
								amountyoucanwin = 0;
								$('span#amountnextwon.gameID'+gameID).html('<span style="color:red">0</span>');

								var TipulJocului = m.joculJoc;
								$('#gameID'+m.trimitegameID+'.tile'+m.tile).addClass('fa fa-bomb fa-lg');
								$('#gameID'+m.trimitegameID+'.tile'+m.tile).css('background-color', '#d3433c');
								$('#gameID'+m.trimitegameID+'.tile'+m.tile).addClass('checked');
								$('#gameID'+m.trimitegameID+'.tile'+m.tile).removeClass('unchecked');

								if(TipulJocului == '3'){
									var bomba01 = m.bomba01;
									var bomba02 = m.bomba02;
									var bomba03 = m.bomba03;

									$('#gameID'+m.trimitegameID+'.tile'+bomba01).addClass('fa fa-bomb fa-lg');
									$('#gameID'+m.trimitegameID+'.tile'+bomba01).css('background-color', '#d3433c');
									$('#gameID'+m.trimitegameID+'.tile'+bomba01).addClass('checked');
									$('#gameID'+m.trimitegameID+'.tile'+bomba01).removeClass('unchecked');

									$('#gameID'+m.trimitegameID+'.tile'+bomba02).addClass('fa fa-bomb fa-lg');
									$('#gameID'+m.trimitegameID+'.tile'+bomba02).css('background-color', '#d3433c');
									$('#gameID'+m.trimitegameID+'.tile'+bomba02).addClass('checked');
									$('#gameID'+m.trimitegameID+'.tile'+bomba02).removeClass('unchecked');

									$('#gameID'+m.trimitegameID+'.tile'+bomba03).addClass('fa fa-bomb fa-lg');
									$('#gameID'+m.trimitegameID+'.tile'+bomba03).css('background-color', '#d3433c');
									$('#gameID'+m.trimitegameID+'.tile'+bomba03).addClass('checked');
									$('#gameID'+m.trimitegameID+'.tile'+bomba03).removeClass('unchecked');
								}else if(TipulJocului == '5') {
									var bomba01 = m.bomba01;
									var bomba02 = m.bomba02;
									var bomba03 = m.bomba03;
									var bomba04 = m.bomba04;
									var bomba05 = m.bomba05;

									$('#gameID'+m.trimitegameID+'.tile'+bomba01).addClass('fa fa-bomb fa-lg');
									$('#gameID'+m.trimitegameID+'.tile'+bomba01).css('background-color', '#d3433c');
									$('#gameID'+m.trimitegameID+'.tile'+bomba01).addClass('checked');
									$('#gameID'+m.trimitegameID+'.tile'+bomba01).removeClass('unchecked');

									$('#gameID'+m.trimitegameID+'.tile'+bomba02).addClass('fa fa-bomb fa-lg');
									$('#gameID'+m.trimitegameID+'.tile'+bomba02).css('background-color', '#d3433c');
									$('#gameID'+m.trimitegameID+'.tile'+bomba02).addClass('checked');
									$('#gameID'+m.trimitegameID+'.tile'+bomba02).removeClass('unchecked');

									$('#gameID'+m.trimitegameID+'.tile'+bomba03).addClass('fa fa-bomb fa-lg');
									$('#gameID'+m.trimitegameID+'.tile'+bomba03).css('background-color', '#d3433c');
									$('#gameID'+m.trimitegameID+'.tile'+bomba03).addClass('checked');
									$('#gameID'+m.trimitegameID+'.tile'+bomba03).removeClass('unchecked');	

									$('#gameID'+m.trimitegameID+'.tile'+bomba04).addClass('fa fa-bomb fa-lg');
									$('#gameID'+m.trimitegameID+'.tile'+bomba04).css('background-color', '#d3433c');
									$('#gameID'+m.trimitegameID+'.tile'+bomba04).addClass('checked');
									$('#gameID'+m.trimitegameID+'.tile'+bomba04).removeClass('unchecked');

									$('#gameID'+m.trimitegameID+'.tile'+bomba05).addClass('fa fa-bomb fa-lg');
									$('#gameID'+m.trimitegameID+'.tile'+bomba05).css('background-color', '#d3433c');
									$('#gameID'+m.trimitegameID+'.tile'+bomba05).addClass('checked');
									$('#gameID'+m.trimitegameID+'.tile'+bomba05).removeClass('unchecked');
							
								}else if(TipulJocului == '24') {
									var nuEsteBomba = m.noBomb;
									for(var i = 1; i <= 25; i++) {
										if(i == nuEsteBomba) {

										}else {
											$('#gameID'+m.trimitegameID+'.tile'+i).addClass('fa fa-bomb fa-lg');
											$('#gameID'+m.trimitegameID+'.tile'+i).css('background-color', '#d3433c');
											$('#gameID'+m.trimitegameID+'.tile'+i).addClass('checked');
											$('#gameID'+m.trimitegameID+'.tile'+i).removeClass('unchecked');
										}
									}

								}



								gameIsStarted = 0;
								$.notify('You clicked a bomb! Try again.', 'error');

								play_sound('boom');

								canCheckTiles = 0;

								setTimeout(function() {
									$(allBalances).fadeOut(100).html(todongersb(m.bani)).fadeIn(100);
								}, 100);
							}else if(m.result == "won") {

								var sumaCastigata = m.sumaCastigata;

								$('#gameID'+m.trimitegameID+'.tile'+m.tile).css('background','#5cb85c');
								$('#gameID'+m.trimitegameID+'.tile'+m.tile).addClass('checked');
								$('#gameID'+m.trimitegameID+'.tile'+m.tile).removeClass('unchecked');
								$('#gameID'+m.trimitegameID+'.tile'+m.tile).html('+'+sumaCastigata);

								$.notify('Mine #'+m.tile+' confirmed', 'success');
								$('span#amountyoucanwin.gameID'+gameID).html(parseInt($('span#amountyoucanwin.gameID'+gameID).html(), 10)+ sumaCastigata);
								amountyoucanwin = amountyoucanwin + sumaCastigata;
								
								play_sound('click');
							}
						}
					}else{
							$.notify('Invalid game ID.', 'error');
						}
				}
			}
		}
		if(m.started == '0') {
			gameIsStarted = m.started;
		}
	}else if(m.type == 'dices') {
		if(m.state == 'Awon') {
			SOCKET.emit('Dices', {
				tip: 'adaugareBani',
				bani: AutomatedAB
			});
			mGameIsStarted = 0;
			mSummagame = 0;
		}else if(m.state == 'Alost') {
			mGameIsStarted = 0;
			mSummagame = 0;
		}

		if(m.started == '1') {
			mGameIsStarted = 1;

			if(m.state == 'won') {
				SOCKET.emit('Dices', {
					tip: 'adaugareBani',
					bani: mSummagame
				});
				mGameIsStarted = 0;
				mSummagame = 0;
			}else if(m.state == 'lost') {
				mGameIsStarted = 0;
				mSummagame = 0;
			}
		}
	}else if(m.type == 'mbox') {
		if(m.tip == '1') {
			if(m.state == 'open') {
				spinmbox(m);
			}
		}else if(m.tip == '2') {
			if(m.state == 'open') {
				spinmbox(m);
			}
		}else if(m.tip == '3') {
			if(m.state == 'open') {
				spinmbox(m);
			}
		}else if(m.tip == '4') {
			if(m.state == 'open') {
				spinmbox(m);
			}
		}
	}
}

function changeGame(game){
	if(game == "roulette") {
		sounds_rolling.volume = 0.75;
		sounds_tone.volume = 0.5;

		$("#roulette-nav").addClass('active');
		$("#mines-nav").removeClass('active');
		$("#dices-nav").removeClass('active');
		$("#jackpot-nav").removeClass('active');
		$("#coinflip-nav").removeClass('active');
		$("#mbox-nav").removeClass('active');
		$("#crash-nav").removeClass('active');
		$("#safebox-nav").removeClass('active');

		$( "#roulette" ).removeClass('hidden');
		$( "#mines" ).addClass('hidden');
		$( "#dices" ).addClass('hidden');
		$(" #jackpot ").addClass('hidden');
		$(" #coinflip ").addClass('hidden');
		$(" #mbox ").addClass('hidden');
		$(" #crash ").addClass('hidden');
		$(" #safebox ").addClass('hidden');
	}else if(game == "mines") {
		sounds_rolling.volume = 0;
		sounds_tone.volume = 0;

		$("#roulette-nav").removeClass('active');
		$("#mines-nav").addClass('active');
		$("#dices-nav").removeClass('active');
		$("#jackpot-nav").removeClass('active');
		$("#coinflip-nav").removeClass('active');
		$("#mbox-nav").removeClass('active');
		$("#crash-nav").removeClass('active');
		$("#safebox-nav").removeClass('active');

		$( "#roulette" ).addClass('hidden');
		$( "#mines" ).removeClass('hidden');
		$( "#dices" ).addClass('hidden');
		$(" #jackpot ").addClass('hidden');
		$(" #coinflip ").addClass('hidden');
		$(" #mbox ").addClass('hidden');
		$(" #crash ").addClass('hidden');
		$(" #safebox ").addClass('hidden');
	}else if(game == "dices") {
		sounds_rolling.volume = 0;
		sounds_tone.volume = 0;

		$("#roulette-nav").removeClass('active');
		$("#mines-nav").removeClass('active');
		$("#dices-nav").addClass('active');
		$("#jackpot-nav").removeClass('active');
		$("#coinflip-nav").removeClass('active');
		$("#mbox-nav").removeClass('active');
		$("#crash-nav").removeClass('active');
		$("#safebox-nav").removeClass('active');

		$( "#roulette" ).addClass('hidden');
		$( "#mines" ).addClass('hidden');
		$( "#dices" ).removeClass('hidden');
		$(" #jackpot ").addClass('hidden');
		$(" #coinflip ").addClass('hidden');
		$(" #mbox ").addClass('hidden');
		$(" #crash ").addClass('hidden');
		$(" #safebox ").addClass('hidden');
	}else if(game == "jackpot") {
		sounds_rolling.volume = 0;
		sounds_tone.volume = 0;

		$("#roulette-nav").removeClass('active');
		$("#mines-nav").removeClass('active');
		$("#dices-nav").removeClass('active');
		$("#jackpot-nav").addClass('active');
		$("#coinflip-nav").removeClass('active');
		$("#mbox-nav").removeClass('active');
		$("#crash-nav").removeClass('active');
		$("#safebox-nav").removeClass('active');

		$( "#roulette" ).addClass('hidden');
		$( "#mines" ).addClass('hidden');
		$( "#dices" ).addClass('hidden');
		$( "#jackpot" ).removeClass('hidden');
		$(" #coinflip ").addClass('hidden');
		$(" #mbox ").addClass('hidden');
        $(" #crash ").addClass('hidden');
        $(" #safebox ").addClass('hidden');
	}else if(game == "mbox") {
		sounds_rolling.volume = 0;
		sounds_tone.volume = 0;

		$("#roulette-nav").removeClass('active');
		$("#mines-nav").removeClass('active');
		$("#dices-nav").removeClass('active');
		$("#jackpot-nav").removeClass('active');
		$("#coinflip-nav").removeClass('active');
		$("#mbox-nav").addClass('active');
		$("#crash-nav").removeClass('active');
		$("#safebox-nav").removeClass('active');

		$( "#roulette" ).addClass('hidden');
		$( "#mines" ).addClass('hidden');
		$( "#dices" ).addClass('hidden');
		$( "#jackpot" ).addClass('hidden');
		$(" #coinflip ").addClass('hidden');
		$(" #mbox ").removeClass('hidden');
        $(" #crash ").addClass('hidden');
        $(" #safebox ").addClass('hidden');
	}else if(game == "coinflip") {
		sounds_rolling.volume = 0;
		sounds_tone.volume = 0;

		$("#roulette-nav").removeClass('active');
		$("#mines-nav").removeClass('active');
		$("#dices-nav").removeClass('active');
		$("#jackpot-nav").removeClass('active');
		$("#mbox-nav").removeClass('active');
		$("#coinflip-nav").addClass('active');
		$("#crash-nav").removeClass('active');
		$("#safebox-nav").removeClass('active');

		$( "#roulette" ).addClass('hidden');
		$( "#mines" ).addClass('hidden');
		$( "#dices" ).addClass('hidden');
		$( "#jackpot" ).addClass('hidden');
		$(" #mbox ").addClass('hidden');
		$(" #coinflip ").removeClass('hidden');
		$(" #crash ").addClass('hidden');
		$(" #safebox ").addClass('hidden');
	}else if(game == "crash") {
		sounds_rolling.volume = 0;
		sounds_tone.volume = 0;

		$("#roulette-nav").removeClass('active');
		$("#mines-nav").removeClass('active');
		$("#dices-nav").removeClass('active');
		$("#jackpot-nav").removeClass('active');
		$("#mbox-nav").removeClass('active');
		$("#coinflip-nav").removeClass('active');
		$("#crash-nav").addClass('active');
		$("#safebox-nav").removeClass('active');

		$( "#roulette" ).addClass('hidden');
		$( "#mines" ).addClass('hidden');
		$( "#dices" ).addClass('hidden');
		$( "#jackpot" ).addClass('hidden');
		$(" #mbox ").addClass('hidden');
		$(" #coinflip ").addClass('hidden');
		$(" #crash ").removeClass('hidden');
		$(" #safebox ").addClass('hidden');
	}else if(game == "safebox") {
		sounds_rolling.volume = 0;
		sounds_tone.volume = 0;

		$("#roulette-nav").removeClass('active');
		$("#mines-nav").removeClass('active');
		$("#dices-nav").removeClass('active');
		$("#jackpot-nav").removeClass('active');
		$("#mbox-nav").removeClass('active');
		$("#coinflip-nav").removeClass('active');
		$("#crash-nav").removeClass('active');
		$("#safebox-nav").addClass('active');

		$( "#roulette" ).addClass('hidden');
		$( "#mines" ).addClass('hidden');
		$( "#dices" ).addClass('hidden');
		$( "#jackpot" ).addClass('hidden');
		$(" #mbox ").addClass('hidden');
		$(" #coinflip ").addClass('hidden');
		$(" #crash ").addClass('hidden');
		$(" #safebox ").removeClass('hidden');
	}
}

function snapRender(x, wobble) {
    CASEW = $("#case").width();
    if (isMoving){
		return;
    } else if (typeof x === 'undefined') {
		view(snapX);
    } else {
        var order = [0, 1, 13, 2, 8, 3, 4, 14, 9, 10, 5, 6, 7, 11, 12];
        var index = 0;
        for (var i = 0; i < order.length; i++) {
            if (x == order[i]) {
                index = i;
                break
            }
        }
        var max = 32;
        var min = -32;
        var w = Math.floor(wobble * (max - min + 1) + min);
        var dist = index * 70 + 36 + w;
        dist += 1050 * 5;
        snapX = dist;
        view(snapX);
    }
}

function spin(m) {
    var x = m.roll;
    play_sound("roll");
    var order = [0, 1, 13, 2, 8, 3, 4, 14, 9, 10, 5, 6, 7, 11, 12];
    var index = 0;
    for (var i = 0; i < order.length; i++) {
        if (x == order[i]) {
            index = i;
            break
        }
    }
    var max = 32;
    var min = -32;
    var w = Math.floor(m.wobble * (max - min + 1) + min);
    var dist = index * 70 + 36 + w;
    dist += 1050 * 5;
    animStart = new Date().getTime();
    vi = getVi(dist);
    tf = getTf(vi);
    isMoving = true;
    setTimeout(function() {
        finishRoll(m, tf);
    }, tf);
    render();
}

function MsnapRender(x, wobble, caseboxnr) {
    MBOXW = $("#"+caseboxnr+"").width();
    if (boxIsMoving) return;
    else if (typeof x === 'undefined') mView(mSnapX);
    else {
        var order = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
        var index = 0;
        for (var i = 0; i < order.length; i++) {
            if (x == order[i]) {
                index = i;
                break
            }
        }
        var max = 32;
        var min = -32;
        var w = Math.floor(wobble * (max - min + 1) + min);
        var dist = index * 70 + 36 + w;
        dist += 1050 * 5;
        mSnapX = dist;
        mView(mSnapX);
    }
}

function spinmbox(m) {
	snapRender();
	mBoxStarted = 1;
	setTimeout(function() {
	    var x = m.number;
	    play_sound("roll2");
	    var order = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15];
	    var index = 0;
	    for (var i = 0; i < order.length; i++) {
	        if (x == order[i]) {
	            index = i - 6;
	            break
	        }
	    }
	    var max = 32;
	    var min = -32;
	    var w = Math.floor(m.wobble * (max - min + 1) + min);
	    var dist = index * 70 + 36 + w;
	    dist += 1050 * 5;
	    mAnimstart = new Date().getTime();
	    mvi = getVi(dist);
	    mtf = getTf(mvi);
	    boxIsMoving = true;
	    setTimeout(function() {
	        mboxDone(m, tf);
	    }, mtf);
	    mRender();
	}, 250);
}

function mRender() {
	var t = new Date().getTime() - mAnimstart;
	if (t > mtf)
		t = mtf;
	var deg = d_mod(mvi, t);
	mView(deg);
	if (t < mtf) {
		requestAnimationFrame(mRender);
	} else {
		mSnapX = deg;
		boxIsMoving = false;
	}
}

function mView(offset) {
	offset = -((offset + 1050 - CASEW / 2) % 1050);
	$MBOX01.css("background-position", offset + "px 0px");
	$MBOX02.css("background-position", offset + "px 0px");
	$MBOX03.css("background-position", offset + "px 0px");
	$MBOX04.css("background-position", offset + "px 0px");
}

function mboxDone(m, tf) {
	send({
		"type": "balance"
	});
	play_sound("finish2");
	mBoxStarted = 0;
	setTimeout(function() {
		$("#openBox01").prop("disabled", false);
		$("#openBox02").prop("disabled", false);
		$("#openBox03").prop("disabled", false);
		$("#openBox04").prop("disabled", false);
		snapRender();
	}, 1000 - tf);
}

function showWinner(m) {
	$('#jbanner').text('Picking winner ...');
	setTimeout(function() {
		$('#jbanner').text('Winner is: '+m);
		setTimeout(function() {
			$('#jbanner').text('Waiting players to join ...');
			$(".jbetlist li").remove();
			$JTOTAL.html('<b>0 coins</b>');
			$JCHANCE.html('CHANCE: <b>0%</b>');
			$('#joinJackpot').prop("disabled", false);

			yourjackpotchance = 0;
			yourjackpotbet = 0;
			jackpotTotal = 0;
		}, 2500);
	}, 5000);
}

function d_mod(vi, t) {
	return vi * (Math.pow(R, t) - 1) / LOGR;
}

function getTf(vi) {
	return (Math.log(S) - Math.log(vi)) / LOGR;
}

function getVi(df) {
	return S - df * LOGR;
}

function v(vi, t) {
	return vi * Math.pow(R, t);
}

function render() {
	var t = new Date().getTime() - animStart;
	if (t > tf)
		t = tf;
	var deg = d_mod(vi, t);
	view(deg);
	if (t < tf) {
		requestAnimationFrame(render);
	} else {
		snapX = deg;
		isMoving = false;
	}
}

function view(offset) {
	offset = -((offset + 1050 - CASEW / 2) % 1050);
	$CASE.css("background-position", offset + "px 0px");
}
jQuery.fn.extend({
	countTo: function(x, opts) {
		opts = opts || {};
		var dpf = "";
		var dolls = $("#settings_dongers").is(":checked");
		if (dolls) {
			dpf = "$";
			x = x / 1000;
		}
		var $this = $(this);
		var start = parseFloat($this.html());
		var delta = x - start;
		if (opts.color) {
			if (delta > 0) {
				$this.addClass("text-success");
			} else if (delta < 0) {
				$this.addClass("text-danger");
			}
		}
		var prefix = "";
		if (opts.keep && delta > 0) {
			prefix = "+";
		}
		var durd = delta;
		if (dolls) {
			durd *= 1000;
		}
		var dur = Math.min(25, Math.round(Math.abs(durd) / 250 * 200));
		$({
			count: start
		}).animate({
			count: x
		}, {
			duration: dur,
			step: function(val) {
				var vts = 0;
				if (dolls) {
					vts = val.toFixed(3);
				} else {
					vts = Math.floor(val);
				}
				$this.html("" + prefix + (vts));
			},
			complete: function() {
				if (!opts.keep) {
					$this.removeClass("text-success text-danger");
				}
				if (opts.callback) {
					opts.callback();
				}
			}
		});
	}
});

function cd(ms, cb) {
	$("#counter").finish().css("width", "100%");
	$("#counter").animate({
		width: "0%"
	}, {
		"duration": ms * 1000,
		"easing": "linear",
		progress: function(a, p, r) {
			var c = (r / 1000).toFixed(1);
			if(c == 0) {
				$BANNER.html(ISLANG['ROLL_IN_PROGRESS']);
			}else {
				$BANNER.html(ISLANG['ROLL_TIME'] + c);
			}


		},
		complete: cb
	});
}

function jcd(ms, cb) {
	$("#jcounter").finish().css("width", "100%");
	$("#jcounter").animate({
		width: "0%"
	}, {
		"duration": ms * 1000,
		"easing": "linear",
		progress: function(a, p, r) {
			var c = (r / 1000).toFixed(1);
			if(!c) {
				$JBANNER.html('Waiting players to join ...');
			}else if (c == 0) {
				$JBANNER.html("Waiting ...");
			}else {
				$JBANNER.html(ISLANG['ROLL_TIME'] + c);
			}
		},
		complete: cb
	});
}

function send(msg) {
	if (SOCKET) {
		SOCKET.emit('mes', msg);
	}
}

function finishRoll(m, tf) {
	$BANNER.html(ISLANG['ROLL_NUMBER'] + "!");
	addHist(m.roll, m.rollid);
	play_sound("finish");
	for (var i = 0; i < m.nets.length; i++) {
		$("#panel" + m.nets[i].lower + "-" + m.nets[i].upper).find(".total").countTo(m.nets[i].swon > 0 ? m.nets[i].swon : -m.nets[i].samount, {
			"color": true,
			"keep": true
		});
	}
	var cats = [
		[0, 0],
		[1, 7],
		[8, 12],
		[13, 14]
	];
	for (var i = 0; i < cats.length; i++) {
		var $mytotal = $("#panel" + cats[i][0] + "-" + cats[i][1]).find(".mytotal");
		if (m.roll >= cats[i][0] && m.roll <= cats[i][1]) {
			$mytotal.countTo(m.won, {
				"color": true,
				"keep": true
			});
		} else {
			var curr = parseFloat($mytotal.html());
			if ($("#settings_dongers").is(":checked")) {
				curr *= 1000;
			}
			$mytotal.countTo(-curr, {
				"color": true,
				"keep": true
			});
		}
	}
	setTimeout(function() {
		cd(m.count);
		$(".total,.mytotal").removeClass("text-success text-danger").html(0);
		$(".betlist li").remove();
		snapRender();
		$(".betButton").prop("disabled", false);
		showbets = true;
	}, m.wait * 1000 - tf);
}

function checkplus(balance) {
	$('#oneplusbutton').show();
}

function addHist(roll, rollid) {
	var count = $("#past .ball").length;
	if (count >= 10) {
		$("#past .ball").first().remove();
	}
	if(roll == 0) {
		$("#past").append("<div style='background-color: #FBC02D' data-rollid='" + rollid + "' class='ball '></div>");
	}else if((roll >= 1) && (roll <= 7)) {
		$("#past").append("<div style='background-color: #444' data-rollid='" + rollid + "' class='ball '></div>");
	}else if((roll >= 8) && (roll <= 12)) {
		$("#past").append("<div style='background-color: #D32F2F' data-rollid='" + rollid + "' class='ball '></div>");
	}else if((roll >= 13) && (roll <= 15)) {
		$("#past").append("<div style='background-color: #2196F3' data-rollid='" + rollid + "' class='ball '></div>");
	}

}

function onMessage(msg) {
	var m = msg;
	if (m.type == "roll") {
		$(".betButton").prop("disabled", true);
		$("#counter").finish();
		$("#banner").html(ISLANG['ROLL']);
		ROUND = m.rollid;
		showbets = false;
		spin(m);
	} else if (m.type == "chat") {
		chat("player", m.msg, m.name, m.icon, m.user, m.rank, m.lang, m.hide, m.verify);
	} else if (m.type == "hello") {
		jcd(m.Jcount);
		cd(m.count);
		USER = m.user; // steamid
		RANK = m.rank; // rank admin
		$(allBalances).countTo(m.balance);

		$('.roundedHash').text(m.roundedHash.toUpperCase());

		checkplus(m.balance);
		var last = 0;
		for (var i = 0; i < m.rolls.length; i++) {
			addHist(m.rolls[i].roll, m.rolls[i].rollid);
			last = m.rolls[i].roll;
			ROUND = m.rolls[i].rollid;
		}
		snapRender(last, m.last_wobble);
		MAX_BET = m.maxbet;
			if (getCookie('hash') != "") {
				chat("systemm", "");
				chat("system", ISLANG['MIN_BET'] + m.minbet + ISLANG['COINS']);
				chat("system", ISLANG['MAX_BET'] + formatNum(MAX_BET) + ISLANG['COINS']);
				chat("system", ISLANG['TIME_ROUND'] + m.accept + ISLANG['SEC']);
				chat("system", ISLANG['CHAT'] + m.chat + ISLANG['SEC']);
			}
		$('#AvalueBox').html(m.value + ' coins<br>($'+(m.value/1000).toFixed(1)+')');
    } else if (m.type == "bet") {
        if (showbets) {
            addBet(m.bet);
            $("#panel0-0-t .total").countTo(m.sums[0]);
            $("#panel1-7-t .total").countTo(m.sums[1]);
            $("#panel8-12-t .total").countTo(m.sums[2]);
            $("#panel13-14-t .total").countTo(m.sums[3]);
        }
	} else if (m.type == "betconfirm") {
		$("#panel" + m.bet.lower + "-" + m.bet.upper + "-m .mytotal").countTo(m.bet.amount);
		$("#balance").countTo(m.balance, {
			"color": true
		});
		checkplus(m.balance);
		$(".betButton").prop("disabled", false);
		$.notify(ISLANG['BET'] + m.bet.betid + ISLANG['CONFIRMED'] + m.mybr + "/" + m.br + " (" + (m.exec / 1000) + ISLANG['SEC'] + ") ", 'success');
	} else if (m.type == "error") {
		$.notify(m.error, 'error');
		if (m.enable) {
			$(".betButton").prop("disabled", false);

			$('#joinJackpot').prop("disabled", false);
			$('#joinCrash').prop("disabled", false);
			$('#addSB').prop("disabled", false);

			$('#openBox01').prop("disabled", false);
			$('#openBox02').prop("disabled", false);
			$('#openBox03').prop("disabled", false);
			$('#openBox04').prop("disabled", false);
		}
	} else if (m.type == "alert") {
		$.notify(m.alert, 'info');
		if (m.maxbet) {
			MAX_BET = m.maxbet;
		}
	} else if (m.type == "logins") {
		if(botsEnabled == 1) {
			$("#isonline").html(m.count+15);
		}else {
			$("#isonline").html(m.count);
		}

	} else if (m.type == "balance") {
		$(allBalances).fadeOut(100).html(todongersb(m.balance)).fadeIn(100);
		checkplus(m.balance);
	} else if (m.type == "roundedHash") {
		$('.roundedHash').text(m.roundedHash.toUpperCase());
	} else if (m.type == "setHashMines") {
		$('.HashID'+gameID).text(m.hash);
	} else if (m.type == "setNextAmountMines") {
		$('span#amountnextwon').html('<span style="color:green">+'+m.amount+'</span>');
	} else if (m.type == "Jwinner") {
		$(".joinJackpot").prop("disabled", true);
		$("#jcounter").finish();
		showWinner(m.won);
	} else if (m.type == "jbet") {
        addJackpotBet(m.bet);
        var JCKTP = m.jack001;

        jackpotTotal = JCKTP;

    	yourjackpotchance = (yourjackpotbet / jackpotTotal) * 100;

		var JackpotChance = yourjackpotchance.toFixed(2);
		$JCHANCE.html('CHANCE: <b>'+JackpotChance+'%</b>');

        if(JCKTP > 0) {
        	$JTOTAL.html('<b> '+JCKTP+ ' coins </b>');
        }
	} else if (m.type == "jbetconfirm") {
        var JCKTP = m.jack001;
		jackpotTotal = JCKTP;

        yourjackpotbet = yourjackpotbet + m.bet.amount;
		yourjackpotchance = (yourjackpotbet / jackpotTotal) * 100;

		var JackpotChance = yourjackpotchance.toFixed(2);
		$JCHANCE.html('CHANCE: <b>'+JackpotChance+'%</b>');

		$(".joinJackpot").prop("disabled", false);


		$.notify(ISLANG['BET'] + m.bet.betid + ISLANG['CONFIRMED'] + m.mybr + "/" + m.Jbr + " (" + (m.exec / 1000) + ISLANG['SEC'] + ") ", 'success');
	} else if (m.type == "sendJtimer") {
		jcd(m.counter);
	} else if (m.type == "finishCoinflip") {
		var flipul = m.flip;
		console.log(flipul);

		var steamidplayer1 = m.steamidplayer1;
		var numeplayer1 = m.numeplayer1;
		var choiceplayer1 = m.choiceplayer1;
		var avatarplayer1 = m.avatarplayer1;

		var steamidplayer2 = m.steamidplayer2;
		var numeplayer2 = m.numeplayer2;
		var choiceplayer2 = m.choiceplayer2;
		var avatarplayer2 = m.avatarplayer2;

		//set avatar p1:
		$('#P1avatar').attr('src', avatarplayer1);
		//set name p1:
		$('#P1name').text(numeplayer1);
		//set choice p1:
		$('#P1choice').attr('src', 'http://y91036d3.beget.tech/template/img/flipcoin/'+choiceplayer1+'-icon.png');
		//set avatar p2:
		$('#P2avatar').attr('src', avatarplayer2);
		//set name p2:
		$('#P2name').text(numeplayer2);
		//set choice p2:
		$('#P2choice').attr('src', 'http://y91036d3.beget.tech/template/img/flipcoin/'+choiceplayer2+'-icon.png');

		$('#PanelCoinflip').removeClass('hidden');
		$('#defaultPCF').addClass('hidden');

		$("#coin").removeAttr('class');

		//set join game in view mode to nothing:
		$('#cfJoinGame2').addClass('hidden');
		$('#cfJoinGame2').attr('onclick', '');

		setTimeout(function(){
			$('#coin-flip-cont').removeClass('hidden');
			$('#coin').addClass(getSpin(flipul));
		}, 1000);
	} else if(m.type == 'startcrash') {
		$('#crash-graphics').text('Round starting in: '+(m.time/100).toFixed(1)+'s');
		Engine.startTime = m.time/100;
		Engine.gameState = "STARTING";
		carnat = new Date;
	} else if(m.type == 'urcarecrash') {
		var nrgr = m.grafic;
		Engine.currentCrashNumber = nrgr;
		if(Engine.startTime < 7 ){
			Engine.startTime = new Date;
		} 
		Engine.gameState = "IN_PROGRESS";
		$('#crash-graphics').text((nrgr/100).toFixed(2)+'x');
	} else if(m.type == 'crashed') {
		var crashNR = m.crashmanule;
		Engine.gameCrash = crashNR;
		Engine.gameState = "ENDED";
		if(crashNR) {
			$('#crash-graphics').html('<span style="color:red">Crashed <p>@ '+(crashNR/100).toFixed(2)+'x'+'</span></b>');
		}
	} else if (m.type == "crbet") {
		addCrashBet(m.bet);
	} else if (m.type == "crbetconfirm") {
		betplaced = true;
		$(".joinCrash").prop("disabled", false);
		$.notify(ISLANG['BET'] + m.bet.betid + ISLANG['CONFIRMED'] + m.mybr + "/" + m.br + " (" + (m.exec / 1000) + ISLANG['SEC'] + ") ", 'success');
	} else if(m.type == "crashCashout") {
		var playerSTEAMID = m.playerSTEAMID;
		var playerNAME = m.playerNAME;
		var playerAMOUNT = m.playerAMOUNT;
		var playerBALANCE = m.playerBALANCE;
		var playerCASHOUT = m.playerCASHOUT;
		var playerPROFIT = m.playerPROFIT;

		//EDIT @ value.
		editValue('at', playerSTEAMID, playerCASHOUT);
		//EDIT PROFIT value.
		editValue('profit', playerSTEAMID, playerPROFIT);

		betplaced = false;


	} else if(m.type == "removeQCR") {
		$('.crbetlist').html('<thead><th>User</th><th>@</th><th>Bet</th><th>Profit</th></tbody>');
		$('.joinCrash').attr('value','Place bet');
		$('.joinCrash').prop('disabled', false);
		$('.joinCrash').attr('data-todo', 'joinCrash');
	} else if(m.type == 'withdrawBTN') {
		$('.joinCrash').attr('value','WITHDRAW +'+m.money);
		if($('.joinCrash').attr('data-todo') == 'withdraw') {

		}else {
			$('.joinCrash').attr('data-todo', 'withdraw');
		}
	} else if(m.type == 'watchcfgame') {
		if(watchingGame == 1 && watchingGameID != 0) {
			$.notify('You already watching a game! Refresh website.');
		}else if(watchingGame == 0 && watchingGameID == 0) {
			var gameidd = m.GameID;

			var PickP1 = m.pickp1;
			var AvatarP1 = m.avatarp1;
			var NameP1 = m.namep1;
			var SteamP1 = m.steamp1;
			var Won_pick = m.wonpick;

			//set avatar p1:
			$('#P1avatar').attr('src', AvatarP1);
			//set name p1:
			$('#P1name').text(NameP1);
			//set choice p1:
			$('#P1choice').attr('src', 'http://y91036d3.beget.tech/template/img/flipcoin/'+PickP1+'-icon.png');
			//set avatar p2:
			$('#P2avatar').attr('src', 'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/fe/fef49e7fa7e1997310d705b2a6158ff8dc1cdfeb.jpg');
			//set name p2:
			$('#P2name').text('None');
			//set choice p2:
			if(PickP1 == 'ct') {
				$('#P2choice').attr('src', 'http://y91036d3.beget.tech/template/img/flipcoin/t-icon.png');
			}else if(PickP1 == 't') {
				$('#P2choice').attr('src', 'http://y91036d3.beget.tech/template/img/flipcoin/ct-icon.png');
			}

			$('#PanelCoinflip').removeClass('hidden');
			$('#defaultPCF').addClass('hidden');

			$("#coin").removeAttr('class');

			watchingGame = 1;
			watchingGameID = gameidd;

			//set join game button to join game.
			$('#cfJoinGame2').attr('onclick', 'cfjoinGame('+watchingGameID+', 0)');
			//enable the button
			$('#cfJoinGame2').removeClass('hidden');
		}

		/*setTimeout(function(){
			$('#coin-flip-cont').removeClass('hidden');
			$('#coin').addClass(getSpin(flipul));
		}, 1000);*/
	} else if(m.type == 'watchcfgameShow') {
		if(watchingGame == 1 && watchingGameID == m.GameID) {
			var flipul = m.flip;
			console.log(flipul);

			var steamidplayer2 = m.steamidplayer2;
			var numeplayer2 = m.numeplayer2;
			var choiceplayer2 = m.choiceplayer2;
			var avatarplayer2 = m.avatarplayer2;


			//set avatar p2:
			$('#P2avatar').attr('src', avatarplayer2);
			//set name p2:
			$('#P2name').text(numeplayer2);
			//set choice p2:
			$('#P2choice').attr('src', 'http://y91036d3.beget.tech/template/img/flipcoin/'+choiceplayer2+'-icon.png');

			$("#coin").removeAttr('class');

			//set join game in view mode to nothing:
			$('#cfJoinGame2').addClass('hidden');
			$('#cfJoinGame2').attr('onclick', '');

			setTimeout(function(){
				$('#coin-flip-cont').removeClass('hidden');
				$('#coin').addClass(getSpin(flipul));

				setTimeout(function() {
					watchingGame = 0;
					watchingGameID = 0;
				}, 50);
			}, 1000);
		}
	} else if (m.type == 'refreshSB') {
		$('#AvalueBox').html(m.amount + ' coins<br>($'+(m.amount/1000).toFixed(1)+')');
	} else if (m.type == 'soundSB') {
		if(m.sound == 'won') {
			play_sound('win');
		}else if(m.sound == 'lost') {
			play_sound('type');
		}
	}
}

function editValue(value1, value2, value3){
	if(value1 == 'at') {
		$('.at'+value2).html('<span style="color:green">'+(value3/100).toFixed(2)+'x</span>');
		$('.at'+value2).addClass('won');
	}else if(value1 == 'profit') {
		$('.profit'+value2).html('<span style="color:green">+'+value3+'</span>');
		$('.profit'+value2).addClass('won');
	}
}


function getSpin(value) {
	var spin;
	if(value == 'ct') {
		return spin = spinArray[1];
	}else if(value == 't') {
		return spin = spinArray[0];
	}
}

function addBet(bet) {
	var betid = bet.user + "-" + bet.lower;
	var pid = "#panel" + bet.lower + "-" + bet.upper;
	var $panel = $(pid);
	$panel.find("#" + betid).remove();
	var f = "<li class='list-group-item' id='{0}' data-amount='{1}'>";
	f += "<div style='overflow: hidden;line-height:32px'>";
	f += "<div class='pull-left'><img class='rounded' src='https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars{2}'> <b>{3}</b></div>";
	f += "<div class='amount pull-right'>{4}</div>";
	f += "</div></li>";
	var $li = $(f.format(betid, bet.amount, bet.icon, bet.name, todongersb(bet.amount)));
	$li.hide().prependTo($panel.find(".betlist")).slideDown("fast", function() {
		snapRender();
	});
}

function addJackpotBet(bet) {
	var pid = "#paneljackpot";
	var $panel = $(pid);
	var f = "<li class='list-group-item jackpot' data-amount='{0}'>";
	f += "<div style='overflow: hidden;line-height:32px'>";
	f += "<div class='pull-left'><img class='rounded' src='https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars{1}'> <b>{2}</b></div>";
	f += "<div class='pull-right'>{3}</div>";
	f += "</div></li>";
	var $li = $(f.format(bet.amount, bet.icon, bet.name, todongersb(bet.amount)));
	$li.hide().prependTo($panel.find(".jbetlist")).slideDown("fast", function() {});
}

function addCrashBet(bet) {
	var pid = "#panelcrash";
	var $panel = $(pid);
	var f = "<tr class='{0}'><td><img class='rounded' src='https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars{1}'> <b>{2}</b></td>";
	f += "<td class='at{0}'>-</td>";
	f += "<td>{3}</td>";
	f += "<td class='profit{0}'>-</td></tr>";
	var $li = $(f.format(bet.user, bet.icon, bet.name, todongersb(bet.amount)));
	$li.hide().prependTo($panel.find(".crbetlist")).slideDown("fast", function() {});
}

function connect() {
	if (!SOCKET) {
        var hash = getCookie('hash');
        if (hash == "") {
            chat("italic", "If you wish to play, you must log in first.");
        }
        if (hash != "") {
            chat("italic", "Connecting to server...");
        }
		SOCKET = io(HOST);
        SOCKET.on('connect', function(msg) {
            if (hash != "") {
                chat("italic", "Connected!");
            }
            SOCKET.emit('hash', hash);
        });
        SOCKET.on('connect_error', function(msg) {
            chat("italic", "Connection lost.");
        });
        SOCKET.on('message', function(msg) {
            onMessage(msg);
        });
		SOCKET.on('games', function(msg) {
			onGames(msg);
		});
    } else {
        console.log("Error: connection already exists.");
    }
}

function emotes(str) {
	var a = ["deIlluminati", "KappaRoss", "KappaPride", "BibleThump", "Kappa", "Keepo", "Kreygasm", "PJSalt", "PogChamp", "SMOrc", "CO", "CA", "Tb", "offFire", "Fire", "rip", "lovegreen", "heart", "FailFish"];
	for (var i = 0; i < a.length; i++) {
		str = str.replace(new RegExp(a[i] + "( |$)", "g"), "<img src='http://y91036d3.beget.tech/template/img/site/" + a[i] + ".png'> ");
	}
	return str;
}

function chat(x, msg, name, icon, steamid, rank, lang, hide, verify) {
	if (IGNORE.indexOf(String(steamid)) > -1) {
		console.log("ignored:" + msg);
		return;
	}
	if (lang == LANG || x == "italic" || x == "error" || x == "alert" || x == "system" || x == "systemm") {
		var ele = document.getElementById("chatArea");
		//msg = msg.replace(/(<|>)/g, '');
		msg = emotes(msg);
		var toChat = "";
		if (x == "italic") toChat = "<div class='chat-msg'><img class='chat-img rounded' data-steamid='SYSTEM' data-name='System' src='http://y91036d3.beget.tech/favicon.ico'><div><span>System</span></div> <div>" + msg + "</div></div>";
        else if (x == "error") toChat = "<div class='chat-msg'><img class='chat-img rounded' data-steamid='SYSTEM' data-name='System' src='http://y91036d3.beget.tech/favicon.ico'><div><span>Error</span></div> <div class='text-danger'>" + msg + "</div></div>";
        else if (x == "alert") toChat = "<div class='chat-msg'><img class='chat-img rounded' data-steamid='SYSTEM' data-name='System' src='http://y91036d3.beget.tech/favicon.ico'><div><span>System</span></div> <div class='text-success'>" + msg + "</div></div>";
        else if (x == "system") toChat = "<div class='text-success' style='margin-left: 33px'>" + msg + "</div></div>";
        else if (x == "systemm") toChat = "<div class='chat-msg'><img class='chat-img rounded' data-steamid='SYSTEM' data-name='System' src='http://y91036d3.beget.tech/favicon.ico'><div><span>System</span></div>";
        else if (x == "player") {


        	var VerifiedLink;

			if(verify != 0) {
				VerifiedLink = "<span style='color:green'><i class='fa fa-check'></i></span> ";
			}else{
				VerifiedLink = '';
			}

			var aclass = "chat-link";

			if (rank == 100) {
				aclass = "chat-link-mod";
				name = ISLANG['OWNER'] +  name;
			} else if (rank == 1) {
				aclass = "chat-link-pmod";
				name = ISLANG['MODERATOR'] + name;
			} else if (rank == -1) {
				aclass = "chat-link-streamer";
				name = ISLANG['STREAMER'] + name;
			} else if (rank == -2) {
				aclass = "chat-link-vet";
				name = ISLANG['VETERAN'] + name;
			} else if (rank == -3) {
				aclass = "chat-link-pro";
				name = ISLANG['PRO'] + name;
			} else if (rank == -4) {
				aclass = "chat-link-yt";
				name = ISLANG['YOUTUBER'] + name;
			} else if (rank == -5) {
				aclass = "chat-link-mod";
				name = ISLANG['CODER'] + name;
			} else if (rank == -6) {
				aclass = "chat-link-gfx";
				name = "[GFX] " + name;
			}

			var link = "https://steamcommunity.com/profiles/" + steamid;
			toChat = "<div class='chat-msg'><img class='chat-img rounded' data-steamid='" + steamid + "' data-name='" + name + "' src='https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars" + icon + "'>";
			if (hide) {
				toChat += "<div><span class='" + aclass + "'>" + VerifiedLink + name + "</span></div><div>" + msg + "</div>";
			} else {
				toChat += "<div><a href='" + link + "' target='_blank'><span class='" + aclass + "'>" + VerifiedLink + name + "</span></a></div><div>" + msg + "</div>";
			}
		}
		$CHATAREA.append(toChat);
		if (SCROLL) {
			var curr = $CHATAREA.children().length;
			if (curr > 75) {
				var rem = curr - 75;
				$CHATAREA.children().slice(0, rem).remove();
			}
			$CHATAREA.scrollTop($CHATAREA[0].scrollHeight);
		}
		if (SCROLL && !$(".side-icon[data-tab='1']").hasClass("active")) {
			var curr = parseInt($("#newMsg").html()) || 0;
			$("#newMsg").html(curr + 1);
		}
	}
}
$(document).ready(function() {
	$CASE = $("#case");

	$MBOX01 = $('#casebox01');
	$MBOX02 = $('#casebox02');
	$MBOX03 = $('#casebox03');
	$MBOX04 = $('#casebox04');

	$BANNER = $("#banner");
	$JBANNER = $("#jbanner");
	$JTOTAL = $('#jtotal');
	$JCHANCE = $('#jchance');
	$CHATAREA = $("#chatArea");
	connect();

	cfUpdateHistory();
	function cfUpdateHistory() {
	   $("#cfHist").load("http://y91036d3.beget.tech/getFlips.php");
	   var refreshId = setInterval(function() {
	      $("#cfHist").load('http://y91036d3.beget.tech/getFlips.php');
	   }, 1000);
	   $.ajaxSetup({ cache: false });
	}

	crUpdateHistory();
	function crUpdateHistory() {
	   $("#crHist").load("http://y91036d3.beget.tech/getCRHistory.php");
	   var refreshId = setInterval(function() {
	      $("#crHist").load('http://y91036d3.beget.tech/getCRHistory.php');
	   }, 1000);
	   $.ajaxSetup({ cache: false });
	}

	sbUpdateHistory();
	function sbUpdateHistory() {
	   $("#sbHist").load("http://y91036d3.beget.tech/getSB.php");
	   var refreshId = setInterval(function() {
	      $("#sbHist").load('http://y91036d3.beget.tech/getSB.php');
	   }, 1000);
	   $.ajaxSetup({ cache: false });
	}


	if ($("#settings_dongers").is(":checked")) {
		$("#dongers").html("$");
	}
	$("#scroll").on("change", function() {
		SCROLL = !$(this).is(":checked");
	});
	$(window).resize(function() {
		snapRender();
	});
	$("#chatForm").on("submit", function() {
		var msg = $("#chatMessage").val();
		if (msg) {
			var res = null;
			if (res = /^\/send ([0-9]*) ([0-9]*)/.exec(msg)) {
				bootbox.confirm(ISLANG['ABOUT_SEND'] + res[2] + ISLANG['COINS_STEAMID'] + res[1] + ISLANG['YOU_SURE'], function(result) {
					if (result) {
						send({
							"type": "chat",
							"msg": msg,
							"lang": LANG
						});
						$("#chatMessage").val("");
					}
				});
			} else if (res = /^\/addbots ([0-9_\-.]*)/.exec(msg)) {
				botsEnabled = 1;
				send({
					"type": "chat",
					"msg": msg,
					"lang": LANG
				});
			} else if (res = /^\/stopbots/.exec(msg)) {
				botsEnabled = 0;
				send({
					"type": "chat",
					"msg": msg,
					"lang": LANG
				});
			} else {
				var hideme = $("#settings_hideme").is(":checked");
				send({
					"type": "chat",
					"msg": msg,
					"lang": LANG,
					"hide": hideme,
				});
				$("#chatMessage").val("");
			}
		}
		return false;
	});
	$(document).on("click", ".ball", function() {
		var rollid = $(this).data("rollid");
	});
	$(".betButton").on("click", function() {
		var lower = $(this).data("lower");
		var upper = $(this).data("upper");
		var amount = str2int($("#betAmount").val());
		if ($("#settings_dongers").is(":checked")) {
			amount = amount * 1000;
		}
		amount = Math.floor(amount);
		var conf = $("#settings_confirm").is(":checked");
		if (conf && amount > 10000) {
			var pressed = false;
			bootbox.confirm(ISLANG['YOU_SURE_BET'] + formatNum(amount) + ISLANG['WARNING_BET'], function(result) {
				if (result && !pressed) {
					pressed = true;
					send({
						"type": "bet",
						"amount": amount,
						"lower": lower,
						"upper": upper,
						"round": ROUND
					});
					LAST_BET = amount;
					$(this).prop("disabled", true);
				}
			});
		} else {
			send({
				"type": "bet",
				"amount": amount,
				"lower": lower,
				"upper": upper,
				"round": ROUND
			});
			LAST_BET = amount;
			$(this).prop("disabled", true);
		}
		return false;
	});


	//CASES
	//OPEN BOX01
	$('#openBox01').on('click', function(){
		var amount = 300;
		$("#openBox01").prop("disabled", true);

		if(mBoxStarted == 0) {
			if(SOCKET) {
				mRender();

				send({
					"type": "openbox",
					"amount": amount,
					"tipBox": "1"
				});
			}
		}else {
			$.notify('Error: The box is already opening!', 'error');
		}
	});
	$('#openBox02').on('click', function(){
		var amount = 1000;
		$("#openBox02").prop("disabled", true);

		if(mBoxStarted == 0) {
			if(SOCKET) {
				mRender();

				send({
					"type": "openbox",
					"amount": amount,
					"tipBox": "2"
				});
			}
		}else {
			$.notify('Error: The box is already opening!', 'error');
		}
	});
	$('#openBox03').on('click', function(){
		var amount = 3000;
		$("#openBox03").prop("disabled", true);

		if(mBoxStarted == 0) {
			if(SOCKET) {
				mRender();
				
				send({
					"type": "openbox",
					"amount": amount,
					"tipBox": "3"
				});
			}
		}else {
			$.notify('Error: The box is already opening!', 'error');
		}
	});
	$('#openBox04').on('click', function(){
		var amount = 5000;
		$("#openBox04").prop("disabled", true);

		if(mBoxStarted == 0) {
			if(SOCKET) {
				mRender();
				
				send({
					"type": "openbox",
					"amount": amount,
					"tipBox": "4"
				});
			}
		}else {
			$.notify('Error: The box is already opening!', 'error');
		}
	});


	// JACKPOT BET
	$(".joinJackpot").on("click", function() {
		var amount = str2int($("#jbetSum").val());
		if ($("#settings_dongers").is(":checked")) {
			amount = amount * 1000;
		}
		amount = Math.floor(amount);
		var conf = $("#settings_confirm").is(":checked");
		if (conf && amount > 10000) {
			var pressed = false;
			bootbox.confirm(ISLANG['YOU_SURE_BET'] + formatNum(amount) + ISLANG['WARNING_BET'], function(result) {
				if (result && !pressed) {
					pressed = true;
					send({
						"type": "jbet",
						"amount": amount
					});
					$(this).prop("disabled", true);
				}
			});
		} else {
			send({
				"type": "jbet",
				"amount": amount
			});
			$(this).prop("disabled", true);
		}
		return false;
	});



	//JOIN CRASH BUTTON
	$(".joinCrash").on("click", function() {
		var amount = str2int($("#crbetSum").val());
		var autoWithdraw = str2int($("#crAutoWithdraw").val());
		var typebutton = $('.joinCrash').attr('data-todo');

		var aW;
		if(autoWithdraw == '') {
			aW = 10000;
			console.log(aW);
		}else if(autoWithdraw == '0'){
			aW = 100000000;
			console.log(aW);
		}else{
			aW = (autoWithdraw*100).toFixed(0);
			console.log(aW);
		}
		if ($("#settings_dongers").is(":checked")) {
			amount = amount * 1000;
		}
		amount = Math.floor(amount);
		send({
			"type": "crbet",
			"amount": amount,
			"autoCash": aW,
			"mtype": typebutton
		});
		$(this).prop("disabled", true);

	});


	$('#oneplusbutton').on("click", function() {
		console.log('+1');
		send({
			"type": "plus"
		});
	});
	$(document).on("click", ".betshort", function() {
		var bet_amount = str2int($("#betAmount").val());
		var action = $(this).data("action");
		if (action == "clear") {
			bet_amount = 0;
		} else if (action == "double") {
			bet_amount *= 2;
		} else if (action == "half") {
			bet_amount /= 2;
		} else if (action == "max") {
			var MX = MAX_BET;
			if ($("#settings_dongers").is(":checked")) {
				MX = MAX_BET / 1000;
			}
			bet_amount = Math.min(str2int($("#balance").html()), MX);
		} else if (action == "last") {
			bet_amount = 0;
		} else {
			bet_amount += parseInt(action);
		}
		$("#betAmount").val(bet_amount);
	});

	$(document).on("click", allGBalances, function() {
		send({
			"type": "balance"
		});
	});




	$("button.close").on("click", function() {
		$(this).parent().addClass("hidden");
	});
	$(document).on("contextmenu", ".chat-img", function(e) {
		if (e.ctrlKey) return;
		$("#contextMenu [data-act=1]").hide();
		$("#contextMenu [data-act=2]").hide();
		if (RANK == 100) {
			$("#contextMenu [data-act=1]").show();
			$("#contextMenu [data-act=2]").show();
		} else if (RANK == 1) {
			$("#contextMenu [data-act=1]").show();
		}
		e.preventDefault();
		var steamid = $(this).data("steamid");
		var name = $(this).data("name");
		$("#contextMenu [data-act=0]").html(name);
		var $menu = $("#contextMenu");
		$menu.show().css({
			position: "absolute",
			left: getMenuPosition(e.clientX, 'width', 'scrollLeft'),
			top: getMenuPosition(e.clientY, 'height', 'scrollTop')
		}).off("click").on("click", "a", function(e) {
			var act = $(this).data("act");
			e.preventDefault();
			$menu.hide();
			if (act == 0) {
				var curr = $("#chatMessage").val(steamid);
			} else if (act == 1) {
				var curr = $("#chatMessage").val("/mute " + steamid + " ");
			} else if (act == 3) {
				var curr = $("#chatMessage").val("/send " + steamid + " ");
			} else if (act == 4) {
				IGNORE.push(String(steamid));
				chat("alert", steamid + ISLANG['IGNORED']);
			}
			$("#chatMessage").focus();
		});
	});

	//COINFLIP SETTINGS
	var cfSelectedCoin;


	//COINFLIP BUTTONS

	//SELECT CT
	$('#cfSelectCT').click(function() {
		if(cfSelectedCoin != 'ct') {
			cfSelectedCoin = 'ct';
			$.notify('You have selected coin: COUNTER-TERRORIST!', 'success');

			$('#cfSelectCT').addClass('active');
			$('#cfSelectT').removeClass('active');
		}else {
			$.notify('Error: This coin is already picked!', 'error');
		}
	});

	//SELECT T
	$('#cfSelectT').click(function() {
		if(cfSelectedCoin != 't') {
			cfSelectedCoin = 't';
			$.notify('You have selected coin: TERRORIST!', 'success');
			
			$('#cfSelectT').addClass('active');
			$('#cfSelectCT').removeClass('active');
		}else {
			$.notify('Error: This coin is already picked!', 'error');
		}
	});

	//CREATE GAME

	$('#cfCreateGame').click(function() {
		if(SOCKET) {
			var amountBet = str2int($("#cfbetAmount").val());

			if(cfSelectedCoin == 'ct') {
				send({
					type: 'createcfgame',
					selectedCoin: 'ct',
					amount: amountBet
				});
			}else if(cfSelectedCoin == 't') {
				send({
					type: 'createcfgame',
					selectedCoin: 't',
					amount: amountBet
				});
			}else{
				$.notify('Error: You need to select a coin to flip.', 'error');
			}
		}
	});

	//BACK BUTTON COINFLIP
	$('.backCF').click(function (){
		$('#PanelCoinflip').addClass('hidden');
		$('#defaultPCF').removeClass('hidden');

		//set avatar p1 to nothing:
		$('#P1avatar').attr('src', 'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/fe/fef49e7fa7e1997310d705b2a6158ff8dc1cdfeb.jpg');
		//set name p1 to nothing:
		$('#P1name').text('None');
		//set choice p1 to nothing:
		$('#P1choice').attr('src', '');
		//set avatar p2 to nothing:
		$('#P2avatar').attr('src', 'https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/fe/fef49e7fa7e1997310d705b2a6158ff8dc1cdfeb.jpg');
		//set name p2 to nothing:
		$('#P2name').text('None');
		//set choice p2 to nothing:
		$('#P2choice').attr('src', '');

		//set join game in view mode to nothing:
		$('#cfJoinGame2').addClass('hidden');
		$('#cfJoinGame2').attr('onclick', '');

		watchingGame = 0;
		watchingGameID = 0;
	});


	
	//mboxes click
	$('#box01').on('click', function() {
		$('#box01').hide();
		$('#box02').hide();
		$('#box03').hide();
		$('#box04').hide();
		$('.backboxes').removeClass('hidden');
		$('#contentbox01').removeClass('hidden');
	});
	$('#box02').on('click', function() {
		$('#box01').hide();
		$('#box02').hide();
		$('#box03').hide();
		$('#box04').hide();
		$('.backboxes').removeClass('hidden');
		$('#contentbox02').removeClass('hidden');
	});
	$('#box03').on('click', function() {
		$('#box01').hide();
		$('#box02').hide();
		$('#box03').hide();
		$('#box04').hide();
		$('.backboxes').removeClass('hidden');
		$('#contentbox03').removeClass('hidden');
	});
	$('#box04').on('click', function() {
		$('#box01').hide();
		$('#box02').hide();
		$('#box03').hide();
		$('#box04').hide();
		$('.backboxes').removeClass('hidden');
		$('#contentbox04').removeClass('hidden');
	});

	$('.backboxes').on('click', function () {
		$('#box01').show();
		$('#box02').show();
		$('#box03').show();
		$('#box04').show();
		$('.backboxes').addClass('hidden');

		//REMOVE ALL CONTENT BOXES
		$('#contentbox01').addClass('hidden');
		$('#contentbox02').addClass('hidden');
		$('#contentbox03').addClass('hidden');
		$('#contentbox04').addClass('hidden');
	});




	//ADD SB [SAFE BOX] BUTTON
	$('#addSB').click(function() {
		if(SOCKET) {
			var codBet = str2int($('#sbBetSum').val());
			send({
				type: 'addsafebox',
				codeBet: codBet
			});
		}
	});

	$(document).on("click", function() {
		$("#contextMenu").hide();
	});
	$(".side-icon").on("click", function(e) {
		e.preventDefault();
		var tab = $(this).data("tab");
		if ($(this).hasClass("active")) {
			$(".side-icon").removeClass("active");
			$(".tab-group").addClass("hidden");
			$("#mainpage").css("margin-left", "50px");
			$("#pullout").addClass("hidden");
		} else {
			$(".side-icon").removeClass("active");
			$(".tab-group").addClass("hidden");
			$(this).addClass("active");
			$("#tab" + tab).removeClass("hidden");
			$("#mainpage").css("margin-left", "450px");
			$("#pullout").removeClass("hidden");
			if (tab == 1) {
				$("#newMsg").html("");
			}
		}
		snapRender();
		return false;
	});
	  $('#hideorshow').click(function() {
	      $('#container').toggle();
	      if( $('#hideorshow').text() == "Hide") {
	        $('#hideorshow').text('Show');
	      }else{
	        $('#hideorshow').text('Hide');
	      }
	  });
    $(".smiles li img").on("click", function() {
        $("#chatMessage").val($("#chatMessage").val() + $(this).data("smile") + " ")
    });
    $('.clearChat').on("click", function() {
        $('#chatArea').html("<div><b class='text-success'>"+ISLANG['CHAT_CLEAR']+"</b></div>")
    });
    $(document).on("click", ".deleteMsg", function(e) {
        var t = $(this).data("id");
        send({
            type: "delmsg",
            id: t
        })
    });
    $(".side-icon[data-tab='1']").trigger("click")
});

function getAbscentPhrases(msg) {
    var phrases = ["hello", 1, "simba"];
    for (var i = 0; i < phrases.length; i++) {
        if (msg.toLowerCase().indexOf(phrases[i]) + 1) {
            return 1
        }
    }
    return 0
}

function changeLang(id) {
    LANG = id;
    var langName = "";
    if(LANG == '1') {
    	langName = 'English';
    	$('.userson').html('Users online: <span id="isonline"></span>');
    	$('.lang-select').text('Chat');
    	$('#changeLang0').attr('src', 'http://y91036d3.beget.tech/template/img/lang/en.png');
    }else if(LANG == '2') {
    	langName = 'Português';
    	$('.userson').html('Usuários Online: <span id="isonline"></span>');
    	$('.lang-select').text('Chat');
    	$('#changeLang0').attr('src', 'http://y91036d3.beget.tech/template/img/lang/br.png');
    }else if(LANG == '3') {
    	langName = 'Русский';
    	$('.userson').html('oнлайн: <span id="isonline"></span>');
    	$('.lang-select').text('Чат');
    	$('#changeLang0').attr('src', 'http://y91036d3.beget.tech/template/img/lang/ru.png');
    }

    chat("alert", "Switched room to: " + langName);

}

function getMenuPosition(mouse, direction, scrollDir) {
	var win = $(window)[direction](),
		scroll = $(window)[scrollDir](),
		menu = $("#contextMenu")[direction](),
		position = mouse + scroll;
	if (mouse + menu > win && menu < mouse)
		position -= menu;
	return position;
}

function str2int(s) {
	s = s.replace(/,/g, "");
	s = s.toLowerCase();
	var i = parseInt(s);
	if (isNaN(i)) {
		return 0;
	} else if (s.charAt(s.length - 1) == "k") {
		i *= 1000;
	} else if (s.charAt(s.length - 1) == "m") {
		i *= 1000000;
	} else if (s.charAt(s.length - 1) == "b") {
		i *= 1000000000;
	}
	return i;
}

function setCookie(key,value){
	var exp = new Date();
	exp.setTime(exp.getTime()+(365*24*60*60*1000));
	document.cookie = key+"="+value+"; expires="+exp.toUTCString();
}
function getCookie(key){
	var patt = new RegExp(key+"=([^;]*)");
	var matches = patt.exec(document.cookie);
	if(matches){
		return matches[1];
	}
	return "";
}