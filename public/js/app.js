/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(1);
__webpack_require__(2);
module.exports = __webpack_require__(3);


/***/ }),
/* 1 */
/***/ (function(module, exports) {


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
var loading = '<i class="fa fa-spinner loading"></i>';

app.web = {
	init: function init() {
		app.web.commons();
		app.web.users();
	},
	commons: function commons() {
		$(".disable-form-unconfirm").submit(function () {
			$(this).find('.btn-submit').text("Please wait...");
			$(this).find('.btn-submit').prop('disabled', true);
		});

		$(".confirm-modal").click(function () {
			var url = $(this).data('url');
			var content = $(this).data('content');
			$("#confirm-content").text(content);
			$("#confirm-url").attr('href', url);
		});
	},
	users: function users() {
		var isEmailValid = false;
		var isPasswordValid = false;
		checkSubmitButton();

		$(".login-form-trigger").click(function () {
			if (!$(".dropdown-login").hasClass('show')) {
				setTimeout(function () {
					$(".form-login").find('#email').focus();
				});
			}
		});

		$(".sign-up-form").find("#email").bind('change keyup', function () {
			var entity = 'users';
			var field = 'email';
			var value = $(this).val();
			var feedbackField = $(".sign-up-form").find('.email-feedback').html('');
			if (value.length > 4) {
				$.ajax({
					url: host + 'checkUnique',
					data: { entity: entity, field: field, value: value },
					type: 'post',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					beforeSend: function beforeSend() {
						feedbackField.html(loading + " checking email");
					},
					success: function success(data) {
						if (data.found == true) {
							isEmailValid = false;
							feedbackField.html('<div class="error">Email already taken!</div>');
						} else {
							isEmailValid = true;
							feedbackField.html('');
						}
						checkSubmitButton();
					},
					error: function error() {
						console.log('error');
					}
				});
			}
		});

		$(".sign-up-form").find("#password").bind('keyup change', function () {
			checkPassword();
		});

		$(".sign-up-form").find("#repeat_password").bind('keyup change', function () {
			checkPassword();
		});

		function checkPassword() {
			var message = '';
			var password = $(".sign-up-form").find("#password").val();
			var repeat_password = $(".sign-up-form").find("#repeat_password").val();
			if (password.length > 5) {
				$(".password-error").html('');
				if (password === repeat_password) {
					isPasswordValid = true;
					message = '<div class="success"><i class="fa fa-check-circle"></i> password match!</div>';
				} else {
					isPasswordValid = false;
					message = '<div class="error">password not same</div>';
				}
				$(".repeat-password-error").html(message);
			} else {
				isPasswordValid = false;
				if (password.length < 1) {
					message = '';
				} else {
					message = '<div class="error">password must be at least 6 character</div>';
					$(".password-error").html(message);
				}
				$(".password-error").html(message);
			}
			checkSubmitButton();
		}

		function checkSubmitButton() {
			if (isPasswordValid && isEmailValid) {
				$(".sign-up-form").find(".btn-submit").prop('disabled', false);
			} else {
				$(".sign-up-form").find(".btn-submit").prop('disabled', true);
			}
		}
	}
};

$(document).ready(function () {
	app.web.init();
});

/***/ }),
/* 2 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),
/* 3 */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ })
/******/ ]);