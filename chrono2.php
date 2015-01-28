<html>
    <head>
        <script src="public/js/jquery-1.11.2.min.js"></script>
        <script>
var startTime = 0;
var start = 0;
var end = 0;
var diff = 0;
var timerID = 0;
$(document).ready(function() {
    setInterval(enregisterTime, 10000)
    window.setInterval(enregisterTime, 10000)
    //window.onbeforeunload = enregisterTime();
});
function chrono(){
	end = new Date()
	diff = end - start
	diff = new Date(diff)
	var msec = diff.getMilliseconds()
	var sec = diff.getSeconds()
	var min = diff.getMinutes()
	var hr = diff.getHours()-1
	if (min < 10){
		min = "0" + min
	}
	if (sec < 10){
		sec = "0" + sec
	}
	if(msec < 10){
		msec = "00" +msec
	}
	else if(msec < 100){
		msec = "0" +msec
	}
	document.getElementById("chronotime").innerHTML = hr + ":" + min + ":" + sec + ":" + msec
        document.chronoForm.time.value = hr + ":" + min + ":" + sec 
	timerID = setTimeout("chrono()", 10)
}
function chronoStart(){
	document.chronoForm.startstop.value = "stop!"
	document.chronoForm.startstop.onclick = chronoStop
	document.chronoForm.reset.onclick = chronoReset
	start = new Date()
	chrono()
}
function chronoContinue(){
	document.chronoForm.startstop.value = "stop!"
	document.chronoForm.startstop.onclick = chronoStop
	document.chronoForm.reset.onclick = chronoReset
	start = new Date()-diff
	start = new Date(start)
	chrono()
}
function chronoReset(){
	document.getElementById("chronotime").innerHTML = "0:00:00:000"
	start = new Date()
}
function chronoStopReset(){
	document.getElementById("chronotime").innerHTML = "0:00:00:000"
	document.chronoForm.startstop.onclick = chronoStart
}
function chronoStop(){
	document.chronoForm.startstop.value = "start!"
	document.chronoForm.startstop.onclick = chronoContinue
	document.chronoForm.reset.onclick = chronoStopReset
	clearTimeout(timerID)
        enregisterTime()
}
function enregisterTime(){
    var time = $('#time').val();
    if(time !== '0:00:00') {
        $.ajax({
            url: "application/controller/ctrlTache.php?action=enregistrerTemps",
            type: "POST",
            data: {time: time},
            dataType: 'json', // JSON
            success: function(json) {
                if(json === 'ok') {
                } else {
                    alert('Erreur : '+ json);
                }
            }
        });
    }
}
</script>
    </head>
    <body>
        
<span id="chronotime">0:00:00:00</span>
<p id='untruc'></p>
<form name="chronoForm" action="application/controller/ctrlTache.php?action=enregistrerTemps" method="POST">
    <input type="button" name="startstop" value="start!" onClick="chronoStart()" />
    <input type="button" name="reset" value="reset!" onClick="chronoReset()" />
    <input type="hidden" name="time" value="" id="time"/>
    <input type="submit" value="envoyer"/>
</form>
    </body>
</html>






