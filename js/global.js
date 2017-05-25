jQuery( function( $ ) {

	$( document ).ready(function() {

		// Comment scroll
		$( ".comment-scroll a" ).click( function( event ) {
			event.preventDefault();
			$( 'html, body' ).animate({
				scrollTop: $(this.hash).offset().top
			}, 'normal' );
		} );

		// Responsive videos
		if ( $.fn.fitVids != undefined ) {
			$( '.fitvids' ).fitVids();
		}

		// Mobile select menu
		$( "<select />" ).appendTo( "#navigation" );
		$( "<option />", {
			"selected": "selected",
			"value" : "",
			"text" : navLocalize.text
		}).appendTo( "#navigation select" );
		$( "#navigation .dropdown-menu a" ).each(function() {
			var el = $(this);
			if(el.parents('.sub-menu').length >= 1) {
				$('<option />', {
					'value' : el.attr( "href" ),
					'text' : '- ' + el.text()
				}).appendTo( "#navigation select" );
			}
			else if(el.parents('.sub-menu .sub-menu').length >= 1) {
				$('<option />', {
					'value' : el.attr('href'),
					'text' : '-- ' + el.text()
				}).appendTo( "#navigation select" );
			}
			else {
				$('<option />', {
					'value' : el.attr('href'),
					'text' : el.text()
				}).appendTo( "#navigation select" );
			}
		} );

		$( "#navigation select" ).change(function() {
			window.location = $(this).find( "option:selected" ).val();
		} );

		if ( $.fn.uniform != undefined ) {
			$( "#navigation select" ).uniform();
		}
		
	} );
} );