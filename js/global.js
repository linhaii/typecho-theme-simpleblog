// ======================================================================= Namespace
var TEST = TEST || {},
	$ = jQuery;


// ======================================================================= Global variables
var doc = $( document ),
	win = $( window ),
	winHeight = win.height(),
	winWidth = win.width();

	var viewport = {};
	viewport.top = $( window ).scrollTop();
	viewport.bottom = viewport.top + $( window ).height();


// =======================================================================  Mobile Menu
TEST.mobileMenu = {

	init: function(){

		// Toggle navigation
		$( '.nav-toggle' ).on( 'click', function(){
			$( this ).toggleClass( 'active' );
			$( '.mobile-menu-wrapper' ).slideToggle().toggleClass( 'visible' );
			$( 'body' ).toggleClass( 'mobile-menu-visible lock-scroll' );
			$( '.mobile-search, .toggle-mobile-search' ).removeClass( 'active' );
		} );

		// Hide navigation on resize
		$( window ).on( 'resize', function(){
			var winWidth = $( window ).width();
			if ( winWidth > 1000 ) {
				$( 'body' ).removeClass( 'mobile-menu-visible lock-scroll' );
				$( '.mobile-menu-wrapper' ).hide().removeClass( 'visible' );
				$( '.nav-toggle' ).removeClass( 'active' );
				$( '.mobile-search' ).removeClass( 'active hide' );

				// Empty the mobile search results
				TEST.ajaxSearch.emptyResults();
			}
		} );

	},

} // TEST.mobileMenu

console.log("%c主题移植者：", "color: #4CAF50; font-weight: bold; font-size: 18px;");
console.log("%c林海草原 https://lhcy.org", "color: #2196F3; font-size: 16px;");
console.log("%c林海爱折腾 https://blog.lhcy.org", "color: #2196F3; font-size: 16px;");

// =======================================================================  Search Toggle
TEST.searchToggle = {

	init: function(){

		// Toggle desktop search
		$( 'a[href$="?s="]' ).on( 'click', function(){
			$( this ).toggleClass( 'active' );
			$( '.search-overlay' ).toggleClass( 'active' );
			if ( $( this ).hasClass( 'active' ) ) {
				$( '.search-overlay .search-field' ).focus();
			} else {
				$( '.search-overlay .search-field' ).blur();
			}
			return false;
		} );

		// Untoggle on click outside of form
		$( '.search-overlay' ).click( function( e ){
			console.log( 'log' );
			if ( e.target != this ) return; // only continue if the target itself has been clicked
			$( '.search-overlay .search-field' ).blur();
			$( '.search-overlay' ).removeClass( 'active' );
			$( '.social-menu.desktop a[href$="?s="]' ).removeClass( 'active' );
		} );

		// Toggle mobile search
		$( '.toggle-mobile-search' ).on( 'click', function(){
			$( '.mobile-search' ).removeClass( 'hide' );
			$( '.toggle-mobile-search, .mobile-search' ).toggleClass( 'active' );
			$( '.mobile-search .search-field' ).focus();
			return false;
		} );

		// Untoggle mobile search
		$( '.untoggle-mobile-search' ).on( 'click', function(){
			$( '.mobile-search' ).addClass( 'hide' );
			$( '.mobile-search, .toggle-mobile-search' ).removeClass( 'active' )
			$( '.mobile-search .search-field' ).blur();

			// Empty the results
			TEST.ajaxSearch.emptyResults();
			return false;
		} );

	},

} // TEST.searchToggle



// =======================================================================  Resize videos
TEST.intrinsicRatioEmbeds = {

	init: function(){

		// Resize videos after their container
		var vidSelector = ".post iframe, .post object, .post video, .widget-content iframe, .widget-content object, .widget-content iframe";
		var resizeVideo = function( sSel ) {
			$( sSel ).each( function() {
				var $video = $( this ),
					$container = $video.parent(),
					iTargetWidth = $container.width();

				if ( ! $video.attr( "data-origwidth" ) ) {
					$video.attr( "data-origwidth", $video.attr( "width" ) );
					$video.attr( "data-origheight", $video.attr( "height" ) );
				}

				var ratio = iTargetWidth / $video.attr( "data-origwidth" );

				$video.css( "width", iTargetWidth + "px" );
				$video.css( "height", ( $video.attr( "data-origheight" ) * ratio ) + "px" );
			} );
		}

		resizeVideo( vidSelector );

		$( window ).resize( function() {
			resizeVideo( vidSelector );
		} );

	},

} // TEST.intrinsicRatioEmbeds




// =======================================================================  Smooth Scroll
TEST.smoothScroll = {

	init: function(){

		// Smooth scroll to anchor links
		$( 'a[href*="#"]' )
		// Remove links that don't actually link to anything
		.not( '[href="#"]' )
		.not( '[href="#0"]' )
		.not( '.skip-link' )
		.click( function( event ) {
			// On-page links
			if ( location.pathname.replace( /^\//, '' ) == this.pathname.replace( /^\//, '' ) && location.hostname == this.hostname ) {
				// Figure out element to scroll to
				var target = $( this.hash );
				target = target.length ? target : $( '[name=' + this.hash.slice( 1 ) + ']' );
				// Does a scroll target exist?
				if ( target.length ) {
					// Only prevent default if animation is actually gonna happen
					event.preventDefault();
					$( 'html, body' ).animate({
						scrollTop: target.offset().top
					}, 1000 );
				}
			}
		} );

	},

} // TEST.smoothScroll



// ======================================================================= AJAX Search
TEST.ajaxSearch = {

	init: function(){

		// Delay function
		var delay = ( function(){
			var timer = 0;
			return function( callback, ms ) {
				clearTimeout( timer );
				timer = setTimeout( callback, ms );
			}
		} )();

		// Update results on keyup, after delay
		$( '.mobile-search .search-field' ).keyup( function() {
			if ( $( this ).val().length != 0 ) {
				delay( function(){
					TEST.ajaxSearch.loadPosts();
				}, 200 );
			} else {
				delay( function(){
					TEST.ajaxSearch.emptyResults();
				}, 50 );
			}
		} );

		delay( function(){
			TEST.ajaxSearch.emptyResults();
		}, 50 );

		// Check for empty on blur
		$( '.mobile-search .search-field' ).blur( function() {
			if ( $( this ).val().length == 0 ) {
				TEST.ajaxSearch.emptyResults();
			}
		} );

	},

	loadPosts: function(){

		var $container = $( '.mobile-results .results-wrapper' ),
			data = $( '.mobile-search .search-field' ).val();

		search_string = JSON.stringify( data );

		

	},

	emptyResults: function(){
		$( '.mobile-results .results-wrapper' ).empty();
		$( '.mobile-results' ).removeClass( 'no-results searching' );
		$( '.mobile-search .search-field' ).val( '' );
	}

} // TEST.ajaxSearch



// ======================================================================= Function calls
$( document ).ready( function() {

	TEST.mobileMenu.init();							// Mobile Menu

	TEST.searchToggle.init();							// Search Toggles

	TEST.intrinsicRatioEmbeds.init();					// Resize videos

	TEST.smoothScroll.init();							// Resize videos

	TEST.ajaxSearch.init();							// AJAX search on mobile

} );
