/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	// var menu, links, subMenus, i, len;

	var container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	var button = container.getElementsByTagName( 'button' )[0];
	if ( 'undefined' === typeof button ) {
		return;
	}

	var content = document.getElementById( 'content' );
	if ( ! content ) {
		return;
	}

	// var toggleableMenu = content.getElementsByClassName( 'menu-full-menu-container' )[0];
	var toggleableMenu = document.getElementById( 'toggleable-menu');

	if ( !toggleableMenu ) {
		button.style.display = 'none';
		return;
	}

	toggleableMenu.setAttribute( 'aria-expanded', 'false' );
	button.setAttribute( 'aria-expanded', 'false' );

	button.onclick = function() {
		if ( toggleableMenu.className.indexOf( 'is-visible' ) !== -1 ) {
			toggleableMenu.className = toggleableMenu.className.replace( ' is-visible', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			toggleableMenu.setAttribute( 'aria-expanded', 'false' );
		} else {
			toggleableMenu.className += ' is-visible';
			button.setAttribute( 'aria-expanded', 'true' );
			toggleableMenu.setAttribute( 'aria-expanded', 'true' );
		}
	};

	var toggleExpandedClass = function(el) {
		const parent = el.parentElement;
		console.log('PARENT: ', parent);
		const expandable = parent.getElementsByClassName('expandable')[0];
		console.log('EXAPNDABLE: ', expandable);
		let showtext;
		
		if (el.className.indexOf('expanded') !== -1) {
			el.className = el.className.replace( ' expanded', '' );
			showtext = el.getAttribute('data-more');
		} else {
			el.className += ' expanded';
			showtext = el.getAttribute('data-less');
		}

		if (expandable.className.indexOf('expanded') !== -1) {
			expandable.className = expandable.className.replace( ' expanded', '' );
		} else {
			expandable.className += ' expanded';
		}
		el.innerHTML = showtext;
	}


	var toggleMore = function toggleMore(e) {
		e.preventDefault();
		toggleExpandedClass(e.target);
	};

	window.toggleMore = toggleMore;


	// slider here

	var slider = document.getElementById( 'slider-container');
	var screens = slider.getElementsByClassName('carpet');
	var screensCount = screens.length;
	screens[0].style.opacity = 1;
	var visibleNow = 0;

	function flip() {
		visibleNow = visibleNow === screensCount - 1 ? 0 : visibleNow + 1;
		for (var i = 0; i < screensCount; i++) {
			screens[i].style.opacity = i === visibleNow ? 1 : 0;
		}
	}

	var timer = window.setInterval(flip, 6000);


} )();
