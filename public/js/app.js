var host = 'http://localhost:8000/';//window.location.hostname;
var hostAdmin = 'http://localhost:8000/admin/';//window.location.hostname;

var app = {};

app.web = {
	init : function(){
		app.web.common();
		app.web.users();
	},
	common : function(){
		CKEDITOR.replaceClass = 'ckeditor';

		$(".disable-form").submit(function(){
			$(this).find('.btn-submit').text("Please wait...");
			$(this).find('.btn-submit').prop('disabled', true);
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
		
	}
}

$(document).ready(function() {
	app.web.init();
});