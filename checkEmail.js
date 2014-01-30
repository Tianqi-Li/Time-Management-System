
var _veroq = _veroq || [];
    _veroq.push(['init', { api_key: '92bd6ca368b6997e73a877740f37dc24f3104854'} ]);
    (function() {var ve = document.createElement('script'); ve.type = 'text/javascript'; ve.async = true; ve.src = 'http://d3qxef4rp70elm.cloudfront.net/m.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ve, s);})();
$(document).ready(function() {
    
    checkEmailSend();
    
});
 

// Check if sign up email is sent to the user
function checkEmailSend(event) {
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("POST", "getEmail.php",true);
    xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
    xmlHttp.addEventListener("load", checkEmailSendCallback, false);
    xmlHttp.send(null);
}

function checkEmailSendCallback(event) {
    var jsonData = JSON.parse(event.target.responseText);
    if (jsonData.needtosend) {
	var email = jsonData.email;
	_veroq.push(['user', {
	// Required attributes
	id: email, 
	email: email
	}]);
	_veroq.push(['track', 'Signs up']);  // Capture when a user signs up 
    }
}