( function( $ ) {
	"use strict";
	$( "form" ).on( 'submit', function( e ) {
		e.preventDefault();
		var actionUrl = $( this ).attr( 'action' ) || '';
		alert( actionUrl );
		if( '' != actionUrl ) {
			$.ajax({
				url: actionUrl,
				type: "POST",
				data: new FormData( this ),
				contentType: false,
				cache: false,
				processData: false,
				success: function( data ){
					console.log( data );
				}           
			});
		}
		return false;
	} );
}( jQuery ) );
