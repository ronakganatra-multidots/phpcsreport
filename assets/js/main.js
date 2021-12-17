( function( $ ) {
	"use strict";
	$( "form" ).on( 'submit', function( e ) {
		e.preventDefault();
		var __this 		= $( this ),
			actionUrl 	= __this.attr( 'action' ) || '';
		alert( actionUrl );
		if( '' != actionUrl ) {
			$.ajax({
				url: actionUrl,
				type: "POST",
				data: new FormData( this ),
				contentType: false,
				cache: false,
				processData: false,
				success: function( response ) {
					var result = $.parseJSON( response );
					console.log( result );
					__this.find( '.msg' ).html( 'Sucess..!!' );
				}           
			});
		}
		return false;
	} );
}( jQuery ) );
