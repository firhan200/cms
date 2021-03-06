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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ 4:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(5);


/***/ }),

/***/ 5:
/***/ (function(module, exports) {

var app = {};

app.web = {
	init: function init() {
		app.web.notifications();
		app.web.dashboards();
		app.web.common();
		app.web.users();
		app.web.articles();
		app.web.messages();
	},
	notifications: function notifications() {
		try {
			notificationsCheck();
			messagesCheck();

			setInterval(function () {
				//check notification every 1 minute
				notificationsCheck();
			}, 1000 * 60 * 1);
		} catch (err) {
			console.log('error');
		}

		function messagesCheck() {
			genericNotificationCheck($(".messages-container"), hostAdmin + 'checkMessages');
		}
		function notificationsCheck() {
			genericNotificationCheck($(".notifications-container"), hostAdmin + 'checkNotifications');
		}

		function genericNotificationCheck(parentDOMObject, url) {
			var thisObj = parentDOMObject;
			$.ajax({
				url: url,
				data: {},
				type: 'post',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				beforeSend: function beforeSend() {
					thisObj.find(".notifications-count").hide();
					thisObj.find(".notification-head").find('.loading').show();
					thisObj.find(".notifications-bell").removeClass('.active');
				},
				success: function success(data) {
					thisObj.find(".notification-head").find('.loading').hide();
					if (data.total > 0) {
						thisObj.find(".notifications-bell").addClass('active');
						thisObj.find(".notifications-count").text(data.total);
						thisObj.find(".notifications-count").fadeIn();
					} else {
						thisObj.find(".notifications-bell").removeClass('.active');
						thisObj.find(".notifications-count").hide();
					}
				},
				error: function error() {
					console.log('error');
				}
			});
		}

		$(".notifications-container").find(".notification-head").click(function () {
			if (!$(".dropdown-notifications").hasClass('show')) {
				$.ajax({
					url: hostAdmin + 'getNotifications',
					data: {},
					type: 'post',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					beforeSend: function beforeSend() {
						$(".notifications-container").find(".notification-content-loading").show();
					},
					success: function success(data) {
						$(".notifications-container").find(".notification-content-loading").hide();
						if (data.notifications.length > 0) {
							$(".notifications-container").find(".dropdown-notifications").html('');
							$.each(data.notifications, function (key, notification) {
								$(".notifications-container").find(".dropdown-notifications").append('<a class="dropdown-item" href="' + notification.link + '">' + notification.action + ' <b>' + notification.object + '</b></a>');
							});
							setTimeout(function () {
								//truncate notification after wait for 1 sec
								truncateNotifications();
							}, 1000);
						} else {
							$(".notifications-container").find(".dropdown-notifications").html('<center class="help">no notifications</center>');
						}
					},
					error: function error() {
						console.log('error');
					}
				});
			}
		});

		$(".messages-container").find(".notification-head").click(function () {
			if (!$(".dropdown-notifications").hasClass('show')) {
				$.ajax({
					url: hostAdmin + 'getMessages',
					data: {},
					type: 'post',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					beforeSend: function beforeSend() {
						$(".messages-container").find(".notification-content-loading").show();
					},
					success: function success(data) {
						console.log(data);
						$(".messages-container").find(".notification-content-loading").hide();
						if (data.messages.length > 0) {
							$(".messages-container").find(".dropdown-notifications").html('');
							$.each(data.messages, function (key, message) {
								var messageBody = message.message.length > 50 ? escapeHTML(message.message.substring(0, 50)) + "..." : escapeHTML(message.message);
								$(".messages-container").find(".dropdown-notifications").append('<a class="dropdown-item" href="' + message.link + '"><i class="fa fa-user-circle-o"></i> ' + escapeHTML(message.name) + '<div>' + message.subject + '</div>' + '<div style="color:#696969">' + messageBody + '</div><div style="font-size:8pt;" align="right">' + message.date + '</div></a>');
							});
						} else {
							$(".messages-container").find(".dropdown-notifications").html('<center class="help">no messages</center>');
						}
					},
					error: function error() {
						console.log('error');
					}
				});
			}
		});

		//delete all notification
		function truncateNotifications() {
			$.ajax({
				url: hostAdmin + 'truncateNotifications',
				data: {},
				type: 'post',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function success(data) {
					console.log(data);
				},
				error: function error() {
					console.log('error occured');
				}
			});
		}
	},
	dashboards: function dashboards() {
		if ($(".dashboard")[0]) {
			var firstLoad = true;
			try {
				renderLatestFeedback();
				renderUsersChart();
				renderFeedbackChart();
				renderLatestUsers();
				renderTotal();

				//refresh dashboard every 1 minutes
				setInterval(function () {
					renderLatestFeedback();
					renderUsersChart();
					renderFeedbackChart();
					renderLatestUsers();
					renderTotal();
				}, 1000 * 60 * 1);

				firstLoad = false;
			} catch (err) {
				console.log('error:' + err);
			}
		}

		function renderUsersChart() {
			$.ajax({
				url: hostAdmin + 'getUsersStatistic',
				data: {},
				type: 'post',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				beforeSend: function beforeSend() {},
				success: function success(data) {
					try {
						var ctx = document.getElementById("users-chart").getContext('2d');
						var myChart = new Chart(ctx, {
							type: 'pie',
							data: {
								labels: ["Deleted", "Active", "Unactive"],
								datasets: [{
									label: '# of Votes',
									data: [data.deleted, data.active, data.unactive],
									backgroundColor: ['rgba(255, 99, 132, 0.2)', 'rgba(54, 162, 235, 0.2)', 'rgba(214, 214, 214, 0.2)'],
									borderColor: ['rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(214, 214, 214, 1)'],
									borderWidth: 1
								}]
							},
							options: {
								responsive: true
							}
						});
					} catch (err) {}
				},
				error: function error() {
					console.log('error occured');
				}
			});
		}

		function renderFeedbackChart() {
			$.ajax({
				url: hostAdmin + 'getFeedbackStatistic',
				data: {},
				type: 'post',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				beforeSend: function beforeSend() {},
				success: function success(data) {
					try {
						var ctx = document.getElementById("feedback-chart").getContext('2d');
						var myChart = new Chart(ctx, {
							type: 'line',
							data: {
								labels: data.month,
								datasets: [{
									label: 'Total Feedback',
									data: data.count,
									backgroundColor: ['rgba(54, 162, 235, 0.2)'],
									borderColor: ['rgba(54, 162, 235, 1)'],
									borderWidth: 1
								}]
							},
							options: {
								responsive: true,
								tooltips: {
									mode: 'index',
									intersect: false
								},
								hover: {
									mode: 'nearest',
									intersect: true
								},
								scales: {
									xAxes: [{
										display: true,
										scaleLabel: {
											display: true,
											labelString: 'Month'
										}
									}],
									yAxes: [{
										display: true,
										scaleLabel: {
											display: true,
											labelString: 'Count'
										}
									}]
								}
							}
						});
					} catch (err) {}
				},
				error: function error() {
					console.log('error occured');
				}
			});
		}

		function renderTotal() {
			$(".dashboard-total").each(function () {
				var entity = $(this).data('entity');
				var objectDOM = $(this);
				$.ajax({
					url: hostAdmin + 'getTotal',
					data: { entity: entity },
					type: 'post',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					beforeSend: function beforeSend() {
						objectDOM.find('.total-result').html('<i class="fa fa-spinner loading"></i>');
					},
					success: function success(data) {
						objectDOM.find('.total-result').html(data.total);
					},
					error: function error() {
						console.log('error occured');
					}
				});
			});
		}

		function renderLatestFeedback() {
			$.ajax({
				url: hostAdmin + 'getLatestFeedback',
				data: {},
				type: 'post',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				beforeSend: function beforeSend() {
					if (firstLoad == true) {
						$(".latest-feedback").html('<center><i class="fa fa-spinner loading"></i></center>');
					} else {
						$(".latest-feedback").parent('.box').find('.loader').html('<i class="fa fa-spinner loading"></i>');
					}
				},
				success: function success(data) {
					if (firstLoad == false) {
						$(".latest-feedback").parent('.box').find('.loader').html('');
					}

					try {
						if (data.length > 0) {
							$(".latest-feedback").html('');
							$.each(data, function (key, feedback) {
								var feedbackName = '<div class="feedback-container"><div class="feedback-name">' + escapeHTML(feedback.name) + '</div>';
								var feedbackEmail = '<div class="feedback-email">' + escapeHTML(feedback.email) + '</div>';
								var message = feedback.message.length > 50 ? escapeHTML(feedback.message.substring(0, 50)) + "..." : escapeHTML(feedback.message);
								var feedbackMessage = '<div class="feedback-message">' + message + '</div>';
								var feedbackLink = '<div align="right"><a href="' + hostAdmin + 'contact_us/' + feedback.id + '">see detail</a></div></div>';
								var feedbackContainer = feedbackName + feedbackEmail + feedbackMessage + feedbackLink;
								$(".latest-feedback").append(feedbackContainer);
							});
						} else {
							$(".latest-feedback").html('<center><div class="help">empty</div></center>');
						}
					} catch (err) {
						//console.log('renderLatestFeedback failed');
					}
				},
				error: function error(request, status, _error) {
					console.log('error occured');
				}
			});
		}

		function renderLatestUsers() {
			$.ajax({
				url: hostAdmin + 'getLatestUsers',
				data: {},
				type: 'post',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				beforeSend: function beforeSend() {
					if (firstLoad == true) {
						$(".latest-users").html('<center><i class="fa fa-spinner loading"></i></center>');
					} else {
						$(".latest-users").parent('.box').find('.loader').html('<i class="fa fa-spinner loading"></i>');
					}
				},
				success: function success(data) {
					if (firstLoad == false) {
						$(".latest-users").parent('.box').find('.loader').html('');
					}
					try {
						if (data.length > 0) {
							$(".latest-users").html('');
							$.each(data, function (key, user) {
								var userName = '<div class="feedback-container"><div class="feedback-name"><a href="' + hostAdmin + 'user/' + user.id + '">' + escapeHTML(user.name) + '</a></div>';
								var userEmail = '<div class="feedback-email">' + escapeHTML(user.email) + '</div></div>';
								var userContainer = userName + userEmail;
								$(".latest-users").append(userContainer);
							});
						} else {
							$(".latest-users").html('<center><div class="help">empty</div></center>');
						}
					} catch (err) {
						//console.log('renderLatestUsers failed');
					}
				},
				error: function error(request, status, _error2) {
					console.log('error occured');
				}
			});
		}
	},
	common: function common() {
		//sidenav
		var sidenav = localStorage.getItem("sidenav");
		if (sidenav != null) {
			renderSidenav();
		}

		function renderSidenav() {
			var sidenav = localStorage.getItem("sidenav");
			if (sidenav == 'large') {
				$(".sidenav").removeClass('sidenav-small');
				$(".sidenav").addClass('sidenav-large');
				$(".main").removeClass('main-small');
				$(".main").addClass('main-large');
				$(".toggle-sidebar").html('<i class="fa fa-chevron-left"></i>');
				$(".toggle-sidebar").removeClass('shrink');
			} else {
				$(".sidenav").removeClass('sidenav-large');
				$(".sidenav").addClass('sidenav-small');
				$(".main").removeClass('main-large');
				$(".main").addClass('main-small');
				$(".toggle-sidebar").html('<i class="fa fa-align-justify"></i>');
				$(".toggle-sidebar").addClass('shrink');
			}
		}

		$(".toggle-sidebar").click(function () {
			if ($(".toggle-sidebar").hasClass('shrink')) {
				localStorage.setItem('sidenav', 'large');
				renderSidenav();
			} else {
				localStorage.setItem('sidenav', 'small');
				renderSidenav();
			}
		});

		CKEDITOR.replaceClass = 'ckeditor';

		$(".disable-form").submit(function () {
			var confirm = window.confirm('Submit?', 'Yes', 'Abort');
			if (confirm) {
				$(this).find('.btn-submit').text("Please wait...");
				$(this).find('.btn-submit').prop('disabled', true);
			} else {
				$(this).find('.btn-submit').prop('disabled', false);
				return false;
			}
		});

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

		$('[data-toggle="tooltip"]').tooltip();

		$(".unique-validation").bind('change keyup', function () {
			var entity = $(this).data('entity');
			var field = $(this).data('field');
			var value = $(this).val();
			var feedbackField = $(this).parents('.unique-form').find('.unique-feedback');
			$.ajax({
				url: hostAdmin + 'checkUnique',
				data: { entity: entity, field: field, value: value },
				type: 'post',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				beforeSend: function beforeSend() {
					feedbackField.text('please wait...');
				},
				success: function success(data) {
					if (data.found == true) {
						feedbackField.html('<div class="error">Email already taken!</div>');
					} else {
						feedbackField.html('');
					}
				},
				error: function error() {
					console.log('error');
				}
			});
		});

		$(".unique-validation-edit").bind('change keyup', function () {
			var entity = $(this).data('entity');
			var field = $(this).data('field');
			var oldValue = $(this).data('old-value');
			var value = $(this).val();
			var feedbackField = $(this).parents('.unique-form').find('.unique-feedback');
			$.ajax({
				url: hostAdmin + 'checkUnique',
				data: { entity: entity, field: field, value: value, oldValue: oldValue },
				type: 'post',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				beforeSend: function beforeSend() {
					feedbackField.text('please wait...');
				},
				success: function success(data) {
					if (data.found == true) {
						feedbackField.html('<div class="error">Email already taken!</div>');
					} else {
						feedbackField.html('');
					}
				},
				error: function error() {
					feedbackField.html('<div class="error">error occured!</div>');
				}
			});
		});

		$(".form-with-check-passsword").find(".btn-submit").prop('disabled', true);

		$("#password").bind('keyup change', function () {
			checkPassword();
		});

		$("#repeat_password").bind('keyup change', function () {
			checkPassword();
		});

		function checkPassword() {
			var message = '';
			var password = $("#password").val();
			var repeat_password = $("#repeat_password").val();
			if (password.length > 5) {
				$(".password-error").html('');
				if (password === repeat_password) {
					message = '<div class="success"><i class="fa fa-check-circle"></i> password match!</div>';
					$(".form-with-check-passsword").find(".btn-submit").prop('disabled', false);
				} else {
					message = '<div class="error">password not same</div>';
					$(".form-with-check-passsword").find(".btn-submit").prop('disabled', true);
				}
				$(".repeat-password-error").html(message);
			} else {
				if (password.length < 1) {
					message = '';
				} else {
					message = '<div class="error">password must be at least 6 character</div>';
					$(".password-error").html(message);
				}
				$(".password-error").html(message);
				$(".form-with-check-passsword").find(".btn-submit").prop('disabled', true);
			}
		}
	},
	users: function users() {},
	articles: function articles() {
		$("#newsContent").val($("#content").val());

		/*$("#cover").change(function(){
  	var image = $(this).val();
  	console.log(image.height);
  })*/

		var tags = $("#tags").val();
		if (tags != null) {
			if (tags.length > 2) {
				var tags = $("#tags").val();
				var tagsResult = renderTags(tags);
				$("#tags-result").html(tagsResult);
			}
		}

		$("#tags").bind('keyup change', function () {
			var tags = $(this).val();
			var tagsResult = renderTags(tags);

			$("#tags-result").html(tagsResult);
		});

		function renderTags(tagsString) {
			var tagsResult = '';
			var tagList = tagsString.split(',');
			$.each(tagList, function (key, tag) {
				tag = escapeHTML(tag);
				tagsResult = tagsResult + '<div class="badge badge-info tag">' + tag.trim() + '</div>';
			});

			return tagsResult;
		}
	},
	messages: function messages() {
		if ($(".compose-message")[0]) {
			$('.message-to').select2();
		}

		$(".message-row").click(function () {
			var url = $(this).data('href');
			window.location = url;
		});
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

/***/ })

/******/ });