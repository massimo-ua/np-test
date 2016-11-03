$(function() {
    $( "button" ).click(function( event ) {
		if (!$.trim($("textarea").val())) {
			event.preventDefault();
			$("#messages").html( '<p class="error">Error: input field is empty</p>' );
		} else {
			if(event.target.id && event.target.id == "ajax") {
				event.preventDefault();
				var url = window.location;
				$.ajax({
				  type: "POST",
				  url: url,
				  data: { data: $("textarea").val() },
				  success: function(response) {
				  	$("textarea").val('');
				  	if(response.success) {
				  		$("#messages").html(
							'<p class="success">Result: Success</p>'
							+'<p class="success">Input: ' + response.input + '</p>'
							+'<p class="success">Days between dates: ' + response.res + '</p>'
							+'<p class="success">Elapsed time: ' + response.et + ' sec</p>'
				  		);
				  	}
				  	else {
				  		var html =
							'<p class="error">Result: Failure</p>'
							+'<p class="error">Error list below:</p>';
							for(var i=0; i < response.errors.length; i++) {
								html += '<p class="error">' + (i+1) + ' ' + response.errors[i] + '</p>';
							}
							$("#messages").html(html);
				  	}
				  }
				});
			}
		}

	});
});