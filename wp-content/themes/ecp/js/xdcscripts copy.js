/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	
	var container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	var button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	var menuContainer = container.getElementsByTagName( 'div' );
	if ( !menuContainer || menuContainer.length === 0) {
		return;
	}
	menuContainer = menuContainer[0];
	// console.log(menuContainer);

	var menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );

	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		menuContainer.classList.toggle('is-visible');
	}

	function closeMenu(el) {
		if ( -1 !== el.className.indexOf( 'is-visible' ) ) {
			el.className = el.className.replace( ' is-visible', '' );
		}
		return true;
	}

	menuContainer.onclick = function() {
		// menuContainer.classList.toggle('is-visible');
		closeMenu(menuContainer);
	}

	document.onkeydown = function(evt) {
		evt = evt || window.event;
		// console.log(evt);
		var isEscape = false;
		if ("key" in evt) {
				isEscape = (evt.key == "Escape" || evt.key == "Esc");
		} else {
				isEscape = (evt.keyCode == 27);
		}
		if (isEscape) {
				closeMenu(menuContainer);
		}
	};

	// button.onclick = function() {
	//  if ( -1 !== menuContainer.className.indexOf( 'is-visible' ) ) {
	//    menuContainer.className = menuContainer.className.replace( ' is-visible', '' );
	//    button.setAttribute( 'aria-expanded', 'false' );
	//    menu.setAttribute( 'aria-expanded', 'false' );
	//  } else {
	//    menuContainer.className += ' is-visible';
	//    button.setAttribute( 'aria-expanded', 'true' );
	//    menu.setAttribute( 'aria-expanded', 'true' );
	//  }
	// };



	// Get all the link elements within the menu.
	var links    = menu.getElementsByTagName( 'a' );
	var subMenus = menu.getElementsByTagName( 'ul' );

	// Set menu items with submenus to aria-haspopup="true".
	for ( i = 0, len = subMenus.length; i < len; i++ ) {
		subMenus[i].parentNode.setAttribute( 'aria-haspopup', 'true' );
	}

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}

	/**
	 * Toggles `focus` class to allow submenu access on tablets.
	 */
	( function( container ) {
		var touchStartFn, i,
			parentLink = container.querySelectorAll( '.menu-item-has-children > a, .page_item_has_children > a' );

		if ( 'ontouchstart' in window ) {
			touchStartFn = function( e ) {
				var menuItem = this.parentNode, i;

				if ( ! menuItem.classList.contains( 'focus' ) ) {
					e.preventDefault();
					for ( i = 0; i < menuItem.parentNode.children.length; ++i ) {
						if ( menuItem === menuItem.parentNode.children[i] ) {
							continue;
						}
						menuItem.parentNode.children[i].classList.remove( 'focus' );
					}
					menuItem.classList.add( 'focus' );
				} else {
					menuItem.classList.remove( 'focus' );
				}
			};

			for ( i = 0; i < parentLink.length; ++i ) {
				parentLink[i].addEventListener( 'touchstart', touchStartFn, false );
			}
		}
	}( container ) );
} )();
