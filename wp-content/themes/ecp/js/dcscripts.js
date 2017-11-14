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
		// console.log('PARENT: ', parent);
		const expandable = parent.getElementsByClassName('expandable')[0];
		// console.log('EXAPNDABLE: ', expandable);
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
	function flip() {
		visibleNow = visibleNow === screensCount - 1 ? 0 : visibleNow + 1;
		for (var i = 0; i < screensCount; i++) {
			screens[i].style.opacity = i === visibleNow ? 1 : 0;
		}
	}

	var slider = document.getElementById( 'slider-container');
	if (slider) {
		var screens = slider.getElementsByClassName('carpet');
		var screensCount = screens.length;
		screens[0].style.opacity = 1;
		var visibleNow = 0;

		var timer = window.setInterval(flip, 6000);
	}

	var jQueryLoaded = window.setInterval(initedjQuery, 1000);

	function initedjQuery() {
		if (typeof window.jQuery === 'function') {
			clearInterval(jQueryLoaded);
			// run jQuery funcs
			toTopLink();
			toNextSection();
		}
		// console.log('not initiated yet');
	}


	function debounce(func, wait, immediate) {
		var timeout;
		return function() {
			var context = this, args = arguments;
			var later = function() {
				timeout = null;
				if (!immediate) func.apply(context, args);
			};
			var callNow = immediate && !timeout;
			clearTimeout(timeout);
			timeout = setTimeout(later, wait);
			if (callNow) func.apply(context, args);
		};
	};

	// document.body.classList.add('toTopShow');
	var statusOfToTop = false;

	function hideToTop() {
		if (document.body.scrollTop < 500 && statusOfToTop) {
			// hide it and return
			document.body.classList.remove('toTopShow');
			statusOfToTop = false;
		}
		if (document.body.scrollTop > 500 && !statusOfToTop) {
			// show it and return
			document.body.classList.add('toTopShow');
			statusOfToTop = true;
		}
	};

	var hideToTopDebounced = debounce(hideToTop, 300);

	window.addEventListener('scroll', hideToTopDebounced);

	function toTopLink() {
		// console.log('run');
  		jQuery('a[href*="#"]').click(function(e) {
  			// console.log('PATHNAME: ', this.pathname);
  			// console.log('HOSTINAME: ', this.hostname);
  			if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
	      		var target = jQuery(this.hash);
	      		// console.log('TARGET: ', target);
	      		target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
	      		target = target.length ? target : jQuery('body');
	      		if (target.length) {
	        		jQuery('html, body').animate({
	          			scrollTop: target.offset().top - 50
	        		}, 700);
	        		return false;
	      		}
    		}
	    });
	};

	function toNextSection() {
		// console.log('run');
  		jQuery('.to-next-section').click(function(e) {
    		jQuery('html, body').animate({
      			scrollTop: document.body.scrollTop + 500
    		}, 700);
    		return false;
	    });
	};

	// debounce on scroll
	// document.body.scrollTop > 300 nebo tak...
	// document.body.classList.remove / add("CLASS_NAME"); to show/hide totop


} )();
