/* Author:

*/


/* Spell Check Jank */

var shown = 0

$("#tweet").keydown(function(e){
    if(e.which === 32) {
   	var text = $('#tweet').val();
   	var words = "word"
   	if (text.toLowerCase().indexOf(words) >= 0 && shown == 0) {
   		alert("word detected");
   		shown++;
   		} else {
   			if(shown == 1) { shown = 0; } }
    	}
});


/* Twitter Counter */
	
	$("tweet").keydown(function() {
    var text = $('#tweet').val();
    var counter == text.length - 140 } );
