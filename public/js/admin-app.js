var app = {};

app.web = {
	init : function(){
		app.web.notifications();
		app.web.common();
		app.web.users();
		app.web.articles();
	},
	notifications : function(){
		notificationsCheck();

		setInterval(function(){
			//check notification every 5 minute
			notificationsCheck();
		}, 1000 * 60 * 5)

		function notificationsCheck(){
			$.ajax({
				url:hostAdmin+'checkNotifications',
				data:{ },
				type : 'post',
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				beforeSend:function(){
					$(".notifications-count").hide();
					$(".notification-head").find('.loading').show();
					$(".notifications-bell").removeClass('.active');
				},
				success:function(data){			
					$(".notification-head").find('.loading').hide();	
					if(data.total > 0){
						$(".notifications-bell").addClass('active');
						$(".notifications-count").text(data.total);
						$(".notifications-count").fadeIn();
					}else{
						$(".notifications-bell").removeClass('.active');
						$(".notifications-count").hide();
					}
				},
				error: function(){
					console.log('error');
				}
			});

			$(".notification-head").click(function(){
				if(!$(".dropdown-notifications").hasClass('show')){
					$.ajax({
						url:hostAdmin+'getNotifications',
						data:{ },
						type : 'post',
						headers: {
					        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					    },
						beforeSend:function(){
							$(".notification-content-loading").show();
						},
						success:function(data){		
							$(".notification-content-loading").hide();	
							if(data.notifications.length > 0){
								$(".dropdown-notifications").html('');
								$.each(data.notifications, function(key, notification){
									$(".dropdown-notifications").append('<a class="dropdown-item" href="'+host+notification.link+'">'+notification.action+' '+notification.object+'</a>');
								})
								setTimeout(function(){
									//truncate notification after wait for 1 sec
									truncateNotifications();
								}, 1000);
							}else{
								$(".dropdown-notifications").html('<center class="help">no notifications</center>');
							}
							
						},
						error: function(){
							console.log('error');
						}
					});
				}
			});
		}		

		//delete all notification
		function truncateNotifications(){
			$.ajax({
				url:hostAdmin+'truncateNotifications',
				data:{ },
				type : 'post',
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				success:function(data){	
					console.log(data);	
				},
				error: function(){
					console.log('error occured');
				}
			});
		}
	},
	common : function(){
		CKEDITOR.replaceClass = 'ckeditor';

		$(".disable-form").submit(function(){
			var confirm = window.confirm('Save data?', 'Yes', 'Abort');
			if(confirm){
				$(this).find('.btn-submit').text("Please wait...");
				$(this).find('.btn-submit').prop('disabled', true);
			}else{
				$(this).find('.btn-submit').prop('disabled', false);
				return false;
			}
			
		})

		$(".confirm-modal").click(function(){
			var url = $(this).data('url');
			var content = $(this).data('content');
			$("#confirm-content").text(content);
			$("#confirm-url").attr('href', url);
		});

		$('[data-toggle="tooltip"]').tooltip(); 

		$(".unique-validation").bind('change keyup', function(){
			var entity = $(this).data('entity');
			var field = $(this).data('field');
			var value = $(this).val();
			var feedbackField = $(this).parents('.unique-form').find('.unique-feedback');
			$.ajax({
				url:hostAdmin+'checkUnique',
				data:{ entity: entity, field:field, value:value },
				type : 'post',
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				beforeSend:function(){
					feedbackField.text('please wait...');
				},
				success:function(data){
					console.log(data);
					if(data.found==true){
						feedbackField.html('<div class="error">Email already taken!</div>');
					}else{
						feedbackField.html('');
					}
					
				},
				error: function(){
					console.log('error');
				}
			})
		});

		$(".unique-validation-edit").bind('change keyup', function(){
			var entity = $(this).data('entity');
			var field = $(this).data('field');
			var oldValue = $(this).data('old-value');
			var value = $(this).val();
			var feedbackField = $(this).parents('.unique-form').find('.unique-feedback');
			$.ajax({
				url:hostAdmin+'checkUnique',
				data:{ entity: entity, field:field, value:value, oldValue:oldValue },
				type : 'post',
				headers: {
			        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			    },
				beforeSend:function(){
					feedbackField.text('please wait...');
				},
				success:function(data){
					console.log(data);
					if(data.found==true){
						feedbackField.html('<div class="error">Email already taken!</div>');
					}else{
						feedbackField.html('');
					}
					
				},
				error: function(){
					feedbackField.html('<div class="error">error occured!</div>');
				}
			})
		});

		$(".form-with-check-passsword").find(".btn-submit").prop('disabled', true);

		$("#password").bind('keyup change', function(){
			checkPassword();
		});

		$("#repeat_password").bind('keyup change', function(){
			checkPassword();
		});

		function checkPassword(){
			var message = '';
			var password = $("#password").val();
			var repeat_password = $("#repeat_password").val();
			if(password.length > 5){
				$(".password-error").html('');
				if(password===repeat_password){
					message = '<div class="success"><i class="fa fa-check-circle"></i> password match!</div>';				
					$(".form-with-check-passsword").find(".btn-submit").prop('disabled', false);
				}else{
					message = '<div class="error">password not same</div>';
					$(".form-with-check-passsword").find(".btn-submit").prop('disabled', true);
				}
				$(".repeat-password-error").html(message);
			}else{
				if(password.length < 1){
					message = '';
				}else{
					message = '<div class="error">password must be at least 6 character</div>';
					$(".password-error").html(message);
				}	
				$(".password-error").html(message);	
				$(".form-with-check-passsword").find(".btn-submit").prop('disabled', true);		
			}
		}
	},
	users : function(){
		
	},
	articles : function(){
		$("#newsContent").val($("#content").val());

		if($("#tags").val().length > 2){
			var tags = $("#tags").val();
			var tagsResult = renderTags(tags);
			$("#tags-result").html(tagsResult);
		}

		$("#tags").bind('keyup change', function(){			
			var tags = $(this).val();
			var tagsResult = renderTags(tags);

			$("#tags-result").html(tagsResult);
		})

		function renderTags(tagsString){
			var tagsResult = '';
			var tagList = tagsString.split(',');
			$.each(tagList, function(key, tag){
				tagsResult = tagsResult + '<div class="badge badge-info tag">'+tag.trim()+'</div>';
			})

			return tagsResult;
		}
	}
}

$(document).ready(function() {
	app.web.init();
});