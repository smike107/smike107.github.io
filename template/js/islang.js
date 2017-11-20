"use strict";

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


var LANG_SELECT = getCookie('language');
var ISLANG = [];
$(document).ready(function() {
    if (LANG_SELECT != "ro" && LANG_SELECT != "en") LANG_SELECT = "en";
    if (LANG_SELECT == "ro") {
        ISLANG['ROLL_TIME'] = "Se roleaza in ";
        ISLANG['ROLL_IN_PROGRESS'] = "Rolare in progres ...";
        ISLANG['APPLY_BET'] = "Se confirma ";
        ISLANG['APPLY_TOTAL_BETS'] = " beturi totale...";
        ISLANG['ROLL'] = "***SE ROLEAZA***";
        ISLANG['MIN_BET'] = "Minim bet: ";
        ISLANG['MAX_BET'] = "Maxim bet: ";
        ISLANG['BETS_PER_ROUND'] = "Beturi maxime pe roll: ";
        ISLANG['TIME_ROUND'] = "Timp roll: ";
        ISLANG['CHAT'] = "Secunde pt. chat: ";
        ISLANG['COINS'] = " coins";
        ISLANG['SEC'] = " sec";
        ISLANG['BET'] = "Betul #";
        ISLANG['CONFIRMED'] = " confirmat ";
        ISLANG['GENERATE_TOKEN'] = "Se genereaza auth token...";
        ISLANG['AUTHORIZATION_STEAM'] = "Te rog logheaza-te cu Steam-ul pentru a vedea site-ul.";
        ISLANG['SERVER_CONNECT'] = "Conectare catre server...";
        ISLANG['CONNECTED'] = "Conectat!";
        ISLANG['ERROR_CONNECTION_CLOSED'] = "Error: Conexiune anulata.";
        ISLANG['CONNECTION_ABORT'] = "Conexiune pierduta...";
        ISLANG['ERROR_NO_TOKEN'] = "Error: Nu s-a putut lua token-ul.";
        ISLANG['ALREADY_CONNECTED'] = "Error: Exista deja o conexiune.";
        ISLANG['OWNER'] = "[Owner] ";
        ISLANG['ADMIN'] = "[Admin] ";
        ISLANG['MODERATOR'] = "[Moderator] ";
        ISLANG['STREAMER'] = "[Streamer] ";
        ISLANG['VETERAN'] = "[Veteran] ";
        ISLANG['YOUTUBER'] = "[Youtuber] ";
        ISLANG['PRO'] = "[Pro] ";
        ISLANG['CODER'] = "[Coder] ";
        ISLANG['CHANGE_ROOM'] = "Te-ai dus pe masa: ";
        ISLANG['ABOUT_SEND'] = "Esti pe cale sa trimiti ";
        ISLANG['COINS_STEAMID'] = " coins catre Steamid-ul ";
        ISLANG['YOU_SURE'] = " - esti sigur?";
        ISLANG['CHAT_CLEAR'] = "Chat sters!";
        ISLANG['YOU_SURE_BET'] = "Esti sigur ca vrei sa betuiesti ";
        ISLANG['WARNING_BET'] = " coins?<br><br><i>Poti anula acest mesaj din setarile profilului.</i>";
        ISLANG['IGNORED'] = " a fost adaugat la lista de ignor.";
        ISLANG['ROLL_NUMBER'] = "S-a rolat ";
        ISLANG['CONFIRM_TRADEOFFER'] = "Se asteapta confirmarea - asteapta...";
        ISLANG['NEW_TRADEOFFER'] = "Tradeoffer-ul a fost trimis!";
        ISLANG['OFFER_SEND_TO_BOT'] = "<b>Schimbul a fost trimis catre bot, se asteapta confirmarea.";
        ISLANG['MINUTES'] = "secunde.</b>";
        ISLANG['NEW_TRADEOFFER_FROM'] = "<b>Tradeoffer trimis de catre";
        ISLANG['WITH_SECRETCODE'] = "cu codul secret";
        ISLANG['ON'] = " pentru ";
        ISLANG['COINS_PLEASE'] = " coins. Te rog, <a href=\'https://steamcommunity.com/tradeoffer/";
        ISLANG['CONFIRM_TRADEOFFER_PLEASE'] = "\' target=\'_blank\' > accepta schimbul</a>.";
        ISLANG['CHECK_STATUS'] = "Verifica Status";
        ISLANG['SUCCESS'] = "Complet";
        ISLANG['GET_COINS'] = " si ia coins.";
        ISLANG['LOAD_ITEMS'] = "Se incarca itemele - asteapta ...";
        ISLANG['BOT'] = "Bot";
        ISLANG['LOADED'] = "S-au incarcat";
        ISLANG['ITEMS'] = "iteme disponibile";
        ISLANG['PROCESS_SEND_OFFER'] = "Se trimite un tradeoffer - asteapta...";
        ISLANG['WAIT_BOT'] = "Se asteapta confirmarea de catre bot.";
        ISLANG['MESSAGE_DELETE'] = "Mesaj sters.";
        ISLANG['FROM_CACHE'] = "din cache";
        ISLANG['FORCE_RELOAD'] = "reimprospatare fortata";
        ISLANG['FULL_LOAD'] = "Serverele sunt full, incearca mai tarziu.";
        ISLANG['VERIFIED'] = "Verificat";

        //OTHER STUFF
        ISLANG['MY_STEAMID'] = "My steamid64";

    } else {
        ISLANG['ROLL_TIME'] = "Rolling in ";
        ISLANG['ROLL_IN_PROGRESS'] = "Rolling in progress ...";
        ISLANG['APPLY_BET'] = "Confirming ";
        ISLANG['APPLY_TOTAL_BETS'] = " total bets...";
        ISLANG['ROLL'] = "***ROLLING***";
        ISLANG['MIN_BET'] = "Minimum bet: ";
        ISLANG['MAX_BET'] = "Maximum bet: ";
        ISLANG['BETS_PER_ROUND'] = "Max bets per roll: ";
        ISLANG['TIME_ROUND'] = "Roll countdown: ";
        ISLANG['CHAT'] = "Chat delay: ";
        ISLANG['COINS'] = " coins";
        ISLANG['SEC'] = " sec";
        ISLANG['BET'] = "Bet #";
        ISLANG['CONFIRMED'] = " confirmed ";
        ISLANG['GENERATE_TOKEN'] = "Generating authentication token...";
        ISLANG['AUTHORIZATION_STEAM'] = "Please sign in through Steam to connect.";
        ISLANG['SERVER_CONNECT'] = "Connecting to server...";
        ISLANG['CONNECTED'] = "Connected!";
        ISLANG['ERROR_CONNECTION_CLOSED'] = "Error: Connection closed.";
        ISLANG['CONNECTION_ABORT'] = "Connection lost...";
        ISLANG['ERROR_NO_TOKEN'] = "Error: Failed to get AT";
        ISLANG['ALREADY_CONNECTED'] = "Error: Existing connection found.";
        ISLANG['OWNER'] = "[Owner] ";
        ISLANG['ADMIN'] = "[Admin] ";
        ISLANG['MODERATOR'] = "[Moderator] ";
        ISLANG['STREAMER'] = "[Streamer] ";
        ISLANG['VETERAN'] = "[Veteran] ";
        ISLANG['YOUTUBER'] = "[Youtuber] ";
        ISLANG['PRO'] = "[Pro] ";
        ISLANG['CODER'] = "[Coder] ";
        ISLANG['CHANGE_ROOM'] = "Switched to room: ";
        ISLANG['ABOUT_SEND'] = "You are about to send ";
        ISLANG['COINS_STEAMID'] = " coins to steamid ";
        ISLANG['YOU_SURE'] = " - are you sure?";
        ISLANG['CHAT_CLEAR'] = "Chat cleared!";
        ISLANG['YOU_SURE_BET'] = "Are you sure you wish to bet ";
        ISLANG['WARNING_BET'] = " coins?<br><br><i>You may disable this confirmation in the settings menu.</i>";
        ISLANG['IGNORED'] = " has been added to ignored.";
        ISLANG['ROLL_NUMBER'] = "Rolled ";
        ISLANG['CONFIRM_TRADEOFFER'] = "Awaiting confirmation of the exchange - please wait...";
        ISLANG['NEW_TRADEOFFER'] = "Your tradeoffer has been sent!";
        ISLANG['OFFER_SEND_TO_BOT'] = "<b>Exchange sent to the bot, awaiting for confirmation. approximate waiting time ~";
        ISLANG['MINUTES'] = "seconds.</b>";
        ISLANG['NEW_TRADEOFFER_FROM'] = "<b>Your offer has been sent from";
        ISLANG['WITH_SECRETCODE'] = "with secret code";
        ISLANG['ON'] = "for";
        ISLANG['COINS_PLEASE'] = "coins. Please, <a href=\'https://steamcommunity.com/tradeoffer/";
        ISLANG['CONFIRM_TRADEOFFER_PLEASE'] = "\' target=\'_blank\' >accept the exchange offer</a>.";
        ISLANG['CHECK_STATUS'] = "Check Status";
        ISLANG['SUCCESS'] = "Complete";
        ISLANG['GET_COINS'] = " and get coins.";
        ISLANG['LOAD_ITEMS'] = "Loading items - please wait ...";
        ISLANG['BOT'] = "Bot";
        ISLANG['LOADED'] = "Loaded";
        ISLANG['ITEMS'] = "available items";
        ISLANG['PROCESS_SEND_OFFER'] = "Sending a tradeoffer - please wait...";
        ISLANG['WAIT_BOT'] = "Awaiting confirmation from the bot.";
        ISLANG['MESSAGE_DELETE'] = "Message Deleted";
        ISLANG['FROM_CACHE'] = "from cache";
        ISLANG['FORCE_RELOAD'] = "force reload";
        ISLANG['FULL_LOAD'] = "Servers are currently full.";
        ISLANG['VERIFIED'] = "Verified";

        //OTHER STUFF
        ISLANG['MY_STEAMID'] = "My steamid64";
        ISLANG['CHAT_RULES'] = "Chat rules";

    }
});