
		$( function() {
		    var handleLeft = $( "#custom-handleLeft" );
		    $( "#sliderLeft" ).slider({
		      create: function() {
		        handleLeft.text( $( this ).slider( "value" ) );
		      },
		      min: 10,
		      max: 300,
		      value: 240,
		      slide: function( event, ui ) {
		        handleLeft.text( ui.value );
		        $('#left').css('left', (ui.value*-1)+'px');
		      }
		    });

		    var handleRight = $( "#custom-handleRight" );
		    $( "#sliderRight" ).slider({
		      create: function() {
		        handleRight.text( $( this ).slider( "value" ) );
		      },
		      min: 10,
		      max: 300,
		      value: 240,
		      slide: function( event, ui ) {
		        handleRight.text( ui.value );
		        $('#right').css('left', (ui.value*-1)+'px');
		      }
		    });

		    var handleTop = $( "#custom-handleTop" );
		    $( "#sliderTop" ).slider({
		      create: function() {
		        handleTop.text( $( this ).slider( "value" ) );
		      },
		      min: 120,
		      max: 160,
		      value: 3,
		      slide: function( event, ui ) {
		        handleTop.text( ui.value );
		        
		        $('#right').css({"-webkit-transform":" rotateY( 90deg ) translateZ( 126px )  translateX("+(ui.value)+"px)"});
		        $('#left').css({"-webkit-transform":" rotateY( 90deg ) translateZ( -126px )  translateX("+(ui.value)+"px)"});
		      }
		    });
		  } );