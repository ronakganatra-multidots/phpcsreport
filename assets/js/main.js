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
		alert( actionUrl );
		if( '' != actionUrl && '' != wpstandard && '' != wpseverity && '' != wpreporterr ) {
			$.ajax({
				url: actionUrl,
				type: "POST",
				data: new FormData( this ),
				contentType: false,
				cache: false,
				processData: false,
				success: function( response ) {
					console.log( response );
					// var result = JSON.parse( response );
					// __this.find( '.msg' ).html( result.message ).show();
				}           
			});
		}
		return false;
	} );
}( jQuery ) );
