var app = {};

app.web = {
	init : function(){
		app.web.users();
	},
	users : function(){
		$(".login-form-trigger").click(function(){
			if(!$(".dropdown-login").hasClass('show')){
				setTimeout(function(){
				    $(".form-login").find('#email').focus();
				});
			}
		});
	}
}

$(document).ready(function() {
	app.web.init();
});