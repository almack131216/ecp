// /**
//  * File navigation.js.
//  *
//  * Handles toggling the navigation menu for small screens and enables TAB key
//  * navigation support for dropdown menus.
//  */
// ( function() {
// 	var menu, links, subMenus, i, len;

// 	console.log('RUNNING');

// 	var container = document.getElementById( 'site-navigation' );
// 	if ( ! container ) {
// 		console.log('NO CONTAINER');
// 		return;
// 	}

// 	var button = container.getElementsByTagName( 'button' )[0];
// 	if ( 'undefined' === typeof button ) {
// 		return;
// 	}

// 	var content = document.getElementById( 'content' );
// 	if ( ! content ) {
// 		return;
// 	}

// 	var toggleableMenu = content.getElementsByClassName( 'menu-full-menu-container' )[0];

// 	if ( !toggleableMenu ) {
// 		button.style.display = 'none';
// 		return;
// 	}

// 	toggleableMenu.setAttribute( 'aria-expanded', 'false' );
// 	button.setAttribute( 'aria-expanded', 'false' );

// 	button.onclick = function() {
// 		console.log('Clicked');
// 		console.log(toggleableMenu);
// 		if ( toggleableMenu.className.indexOf( 'is-visible' ) !== -1 ) {
// 			toggleableMenu.className = container.className.replace( ' is-visible', '' );
// 			button.setAttribute( 'aria-expanded', 'false' );
// 			toggleableMenu.setAttribute( 'aria-expanded', 'false' );
// 		} else {
// 			container.className += ' is-visible';
// 			button.setAttribute( 'aria-expanded', 'true' );
// 			toggleableMenu.setAttribute( 'aria-expanded', 'true' );
// 		}
// 	};

// } )();
