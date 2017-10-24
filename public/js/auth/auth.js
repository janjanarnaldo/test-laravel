var Auth = {
	init: function(){
		if($("#login-error").val()){
			$("#login-form").modal('show');
		}
	},
	focus: function(){
		$('#login-form').on('shown.bs.modal', function () {
		    $('#email').focus();
		})  
	}
};

Auth.init();
Auth.focus();

$(document).ready(function(e) {
	$.cookie("playbooklogin", null);
	$.removeCookie("playbooklogin");
})