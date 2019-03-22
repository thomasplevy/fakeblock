/**
 * Frontend JS
 * @since    1.0.0
 * @version  1.0.0
 */
;( function( $ ) {

	var Fakeblock = function( settings ) {

		var self = this,
			tolerance = 400,
			passedBeats = 0,
			badBeats = 0,
			goodBeats = 0,
			doesBeatCount = false,
			audio = new Audio( settings.hit ),
			passed = false,
			countsOn, countsOff, metronome;

		var $visualizer = $( '#fkblk-visualizer' ),
			$bars = $visualizer.find( '.bar' ),
			$beats = $visualizer.find( '.beat' ),
			$pad = $( '#fkblk-pad' ),
			$results = $( '.fkblk-results' ),
			$start = $( '#fkblk-unblock-start' );

		$start.on( 'click', function( e ) {

			$start.hide();
			$results.hide();

			if ( ! passed ) {
				e.preventDefault();
				self.start( settings.bars, settings.bpm );
				return false;
			}

		} );

		$pad.on( 'mousedown', function() {

			var $this = $( this );

			audio.play();

			$this.addClass( 'hit' );

			if ( doesBeatCount ) {
				goodBeats++;
				$this.addClass( 'okay' );
			} else {
				badBeats++;
				$this.addClass( 'nope' );
			}

			setTimeout( function() {
				$this.removeClass( 'hit okay nope' );
			}, 350 );

		} );

		function resetTrackers() {
			passedBeats = 0;
			goodBeats = 0;
			badBeats = 0;
		}

		function reportResults() {

			$( '#fkblk-hits-good' ).text( goodBeats );
			$( '#fkblk-hits-total' ).text( passedBeats - 1 );

			$results.show();

			passed = ( goodBeats === ( passedBeats - 1 ) );

			if ( passed ) {

				$results.append( 'You are being un-fakeblocked...' );

				setTimeout( function() {
					$( '#fkblk-unblock-start' ).trigger( 'click' );
				}, 1000 );

			} else {

				$start.show();

			}

		}

		this.start = function( bars, bpm ) {

			var i = 3,
				orignalText = $pad.find( '.text' ).text(),
				countdown;

			countDown = setInterval( function() {

				if ( 0 === i ) {
					$pad.find( '.text' ).text( orignalText );
					startMetronome( settings.bars, settings.bpm );
					clearInterval( countDown );
				} else {
					$pad.find( '.text' ).text( i );
				}

				i--;

			}, getIntervalDelay( bars, bpm ) );

		}

		startMetronome = function( bars, bpm ) {

			resetTrackers();

			var intervalDelay = getIntervalDelay( bars, bpm );

			// Start immediately
			countsOn = setInterval( function() {
				doesBeatCount = true;
			}, intervalDelay );

			// start half tolerance after
			setTimeout( function() {
				metronome = setInterval( doBeat, intervalDelay );
			}, tolerance / 2 );

			// start after
			setTimeout( function() {

				countsOff = setInterval( function() {
					doesBeatCount = false;
				}, intervalDelay );

			}, tolerance );

		};

		stopMetronome = function() {

			doesBeatCount = false;
			clearInterval( metronome );
			clearInterval( countsOn );
			clearInterval( countsOff );

			reportResults();

			resetTrackers();

		}

		doBeat = function() {

			$beats.removeClass( 'hit' );
			passedBeats++;

			if ( passedBeats > getTotalBeats( settings.bars ) ) {
				stopMetronome();
				return;
			}

			$beats.eq( passedBeats - 1 ).addClass( 'hit' );

		};

		getIntervalDelay = function( bars, bpm ) {

			return ( getSecondsPerBar( bpm ) / 4 ) * 1000;

		};

		getSecondsPerBar = function( bpm ) {

			return ( 4 / bpm ) * 60;

		};

		getTotalBeats = function( bars ) {
			return 4 * bars;
		}

	};

	window.fkblk = new Fakeblock( fkblk );

} )( jQuery );
