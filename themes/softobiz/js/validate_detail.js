$().ready(function() {
	
	$.validator.addMethod("regx", function(value, element, regexpr) {          
	    return regexpr.test(value);
	}, "Please enter a valid pasword.");

	
	$("#user-form").validate({
		rules: {
			"Application[title]": {
				required: true,
				regx: /^[0-9a-zA-Z]+$/ 
			},
				"Application[id_app]": {
					required: true,
					regx: /^[a-z]+[.][0-9a-zA-Z]+[.][0-9a-zA-Z]+$/  
				},	
		
			"Application[description]": {
				required: true,
				regx: /^[a-zA-Z0-9]+[a-zA-Z0-9\r\s ]*$/  
			},	
			
			"Application[icon]": {
				 required: true,
				 extension: "png"
				 }
		},
		messages: {
			"Application[title]": {
				required: "<div class='alert alert-danger'>Please enter App Title</div>",
				regx: "<div class='alert alert-danger'>Please enter valid App Title(No special character allowed,No space allowed)</div>"
			},
			"Application[id_app]": {
				required: "<div class='alert alert-danger'>Please enter App ID</div>",
				regx: "<div class='alert alert-danger'>Please enter valid App Title(No special character allowed,ex-com.example.type,No space allowed)</div>"
			},
			
			
			"Application[description]": {
				required: "<div class='alert alert-danger'>Please enter App Description</div>",
				regx: "<div class='alert alert-danger'>Please enter valid App Description(No special character allowed,No space allowed in first place)</div>"
			},
			
			"Application[icon]": {
				required: "<div class='alert alert-danger'>Please select App Icon</div>",
				extension: "<div class='alert alert-danger'>Please select valid App Icon(PNG only)</div>"
			},
		}
	});

});


function user_valid()
{
	return $("#user-form").valid();
}
