( function( $ ) {
	"use strict";

	//===== Prealoder
	window.onload = function () {
		window.setTimeout(fadeout, 500);
	};

	function fadeout() {
		document.querySelector(".preloader").style.opacity = "0";
		document.querySelector(".preloader").style.display = "none";
	}


	// WOW active
	new WOW().init();

	$( "form" ).on( 'submit', function( e ) {
		e.preventDefault();
		var __this 		= $( this ),
			actionUrl 	= __this.attr( 'action' ) || '',
			wpstandard 	= __this.find( '#wpstandard' ) || '',
			wpseverity 	= __this.find( '#wpseverity' ) || '',
			wpreporterr = __this.find( '#wpreporterr' ) || '';
		if( '' != actionUrl && '' != wpstandard && '' != wpseverity && '' != wpreporterr ) {
			__this.find( '.msg' ).removeClass( 'error' ).removeClass( 'success' ).hide();
			$.ajax({
				url: actionUrl,
				type: "POST",
				data: new FormData( this ),
				contentType: false,
				cache: false,
				processData: false,
				success: function( response ) {
					var result = JSON.parse( response );
					__this.find( '.msg' ).html( result.message ).show();
					__this.find( '.msg' ).addClass( result.status );
				}           
			});
		}
		return false;
	} );
}( jQuery ) );
