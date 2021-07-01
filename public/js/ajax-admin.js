(($) => {
	$( document ).ready(
		() => {
        // when user submits the form
			$( ".object-cache-panel" ).on(
				"submit",
				function (event) {
					// prevent form submission
					event.preventDefault();

					// add loading message if making an external request
					// $(".ajax-response-clear-cache").html("Loading...");

					// submit the data
					$.post(
						ajaxurl,
						{
							nonce: ajax_admin.nonce,
							action: "admin_hook",
						},
						(data) => {
                        $( ".ajax-response-clear-cache" ).html( data );
						}
					);
				}
			);
		$( ".random-quote-panel" ).on(
			"submit",
			(event) => {
            event.preventDefault();
            $.post(
					ajaxurl,
					{
						nonce: ajax_admin.nonce,
						action: "admin_quote_handler",
					},
					(data) => {
                    $( ".ajax-quote-response" ).html( data );
					}
				);
			}
		);
		}
	);
})( jQuery );