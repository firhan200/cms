
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

/*require('./bootstrap');

window.Vue = require('vue');*/

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

/*Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app'
});
*/
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