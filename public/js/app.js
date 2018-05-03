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
		app.web.articles();
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
						checkSubmitButton($(".sign-up-form"), true);
					},
					error: function error() {
						console.log('error');
					}
				});
			}
		});

		$(".sign-up-form").find("#password").bind('keyup change', function () {
			checkPassword($(".sign-up-form"), true);
		});

		$(".sign-up-form").find("#repeat_password").bind('keyup change', function () {
			checkPassword($(".sign-up-form"), true);
		});

		$(".change-password-form").find("#password").bind('keyup change', function () {
			checkPassword($(".change-password-form"), false);
		});

		$(".change-password-form").find("#repeat_password").bind('keyup change', function () {
			checkPassword($(".change-password-form"), false);
		});

		function checkPassword(obj, withEmail) {
			var message = '';
			var password = obj.find("#password").val();
			var repeat_password = obj.find("#repeat_password").val();
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
			checkSubmitButton(obj, withEmail);
		}

		function checkSubmitButton(obj, withEmail) {
			if (withEmail) {
				if (isPasswordValid && isEmailValid) {
					obj.find(".btn-submit").prop('disabled', false);
				} else {
					obj.find(".btn-submit").prop('disabled', true);
				}
			} else {
				if (isPasswordValid) {
					obj.find(".btn-submit").prop('disabled', false);
				} else {
					obj.find(".btn-submit").prop('disabled', true);
				}
			}
		}
	},
	articles: function articles() {
		var page = 1;
		var keyword = '';
		var showMoreArticlesBtn = '<a href="#!" id="show-more-articles" class="btn btn-info btn-default">Show more</a>';
		renderArticles(true);

		$(".articles-search").submit(function (e) {
			e.preventDefault();
			page = 1;
			keyword = $(this).find('#keyword').val();
			renderArticles(true);
			$(this).find('#keyword').blur();
			return false;
		});

		$(document).on('click', "#show-more-articles", function () {
			page = page + 1;
			renderArticles(false);
			return false;
		});

		$(document).on('click', '.tag-searchable', function () {
			keyword = $(this).text();
			//active label
			$(".articles-search").find('.control-label').addClass('active');
			$(".articles-search").find('.prefix').addClass('active');

			$(".articles-search").find('#keyword').val(keyword);
			renderArticles(true);
		});

		function renderArticles(reset) {
			$.ajax({
				url: host + 'getArticles',
				data: { page: page, keyword: keyword },
				type: 'post',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				beforeSend: function beforeSend() {
					if (reset) {
						$("#articles-results").html('<div class="col-md-12">' + loading + '</div>');
					}
					$(".articles-navigation").html(loading);
					$(".total-results").html(loading);
				},
				success: function success(data) {
					if (reset) {
						$("#articles-results").html('');
					}

					//set total result
					$(".total-results").html(data.total_results);

					if (data.articles.length > 0) {
						$(".articles-navigation").html(showMoreArticlesBtn);

						var articleCard = renderArticlesCardView(data.articles);

						$("#articles-results").append(articleCard);

						if (data.page < data.total_page) {
							$(".articles-navigation").html(showMoreArticlesBtn);
						} else {
							$(".articles-navigation").html('');
						}

						//set on result
						$(".articles-navigation").prepend('<div align="center" class="help"><b>' + data.on_result + "</b> of <b>" + data.total_results + '</b></div>');
					} else {
						$(".articles-navigation").html('');
						$("#articles-results").html('<div class="col-md-12 help" align="center">No results</div>');
					}
				},
				error: function error() {
					console.log('error');
				}
			});
		}

		function renderArticlesCardView(articles) {
			var articlesHtml = '';

			$.each(articles, function (key, article) {
				var openTag = '<div class="col-lg-4 col-md-6 mb-4 news-box"><div class="card">';
				var date = formatDateTime(article.created_at);
				var articleDate = '<div class="news-date">' + date + '</div>';
				var image = article.cover != null ? host + 'images/article/' + article.cover : '';
				var articleImg = '<div class="news-img-frame"><img src="' + image + '" class="card-img"/></div>';
				var articleTitle = '<div class="card-body"><div class="card-title"><a href="' + host + 'articles/' + article.id + '">' + escapeHTML(article.title) + '</a></div>';

				var summary = article.summary.length > 150 ? escapeHTML(article.summary.substring(0, 150)) + "..." : escapeHTML(article.summary);
				var articleBody = '<div class="card-text">' + escapeHTML(summary) + '</div>';
				var articleTags = article.tags != null ? renderTags(article.tags) : '';
				var closeTag = '</div></div></div>';

				var articleCard = openTag + articleImg + articleTitle + articleBody + articleDate + articleTags + closeTag;

				articlesHtml = articlesHtml + articleCard;
			});

			return articlesHtml;
		}
	}
};

$(document).ready(function () {
	app.web.init();
});

function escapeHTML(unsafe_str) {
	if (unsafe_str != null) {
		return unsafe_str.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/\"/g, '&quot;').replace(/\'/g, '&#39;').replace(/\//g, '&#x2F;');
	}
}

function renderTags(tagsString) {
	var tagsResult = '';
	var tagList = tagsString.split(',');
	$.each(tagList, function (key, tag) {
		tag = escapeHTML(tag);
		tagsResult = tagsResult + '<a href="#"><div class="badge badge-info badge-default tag tag-searchable">' + tag.trim() + '</div></a>';
	});

	return tagsResult;
}

function formatDateTime(dateTime) {
	dateFormatted = moment(dateTime).format('DD MMM YYYY, HH:mm');
	return dateFormatted;
}

String.prototype.replaceAll = function (str1, str2, ignore) {
	return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g, "\\$&"), ignore ? "gi" : "g"), typeof str2 == "string" ? str2.replace(/\$/g, "$$$$") : str2);
};

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