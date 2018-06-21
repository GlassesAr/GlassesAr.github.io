

var mn = 1;

(function() {

		// detect WebAssembly support and load either WASM or ASM version of BRFv4
		var support	= (typeof WebAssembly === 'object');
		if(support) {
			// from https://github.com/brion/min-wasm-fail/blob/master/min-wasm-fail.js
			function testSafariWebAssemblyBug() {
				var bin = new Uint8Array([0,97,115,109,1,0,0,0,1,6,1,96,1,127,1,127,3,2,1,0,5,3,1,0,1,7,8,1,4,116,101,115,116,0,0,10,16,1,14,0,32,0,65,1,54,2,0,32,0,40,2,0,11]);
				var mod = new WebAssembly.Module(bin);
				var inst = new WebAssembly.Instance(mod, {});
				// test storing to and loading from a non-zero location via a parameter.
				// Safari on iOS 11.2.5 returns 0 unexpectedly at non-zero locations
				return (inst.exports.test(4) !== 0);
			}
			if (!testSafariWebAssemblyBug()) {
				support = false;
			}
		}
		 brfv4BaseURL = "js/libs/brf_asmjs/"; 

		//console.log("Checking support of WebAssembly: " + support + " " + (support ? "loading WASM (not ASM)." : "loading ASM (not WASM)."));
	
		var script	= document.createElement("script");

		script.setAttribute("type", "text/javascript");
		script.setAttribute("async", true);
		script.setAttribute("src", brfv4BaseURL + "BRFv4_JS_TK190218_v4.0.5_trial.js");

		document.getElementsByTagName("head")[0].appendChild(script);
	})();

	$("#reload").click(function() {
			stop = false;
			
			initExample();
	});	
	
	// $("#next").click(function() {
	// 		$("#top").attr("src","../assets/glasses1.png");
	// });

	$("#stop").click(function() {
			stop = true;
	});

	var i = 5;
	var timeout = 0;

	$("#plus").mousedown(function() {
	 timeout = setInterval(function(){
	 	mn += 0.01;
	 },100)
	  
	});
	  
	$("#plus").mouseup(function() {
		clearInterval(timeout);  
	});


	$("#minus").mousedown(function() {
	 timeout = setInterval(function(){
	  mn -= 0.01;
	 },100)
	  
	});
	  
	$("#minus").mouseup(function() {
		clearInterval(timeout);  
	});



	$( "#plus" ).click(function() {

		mn += 0.01;

	});

	$( "#minus" ).click(function() {

		mn -= 0.01;

	});

	// $("#prev").click(function() {
	// 		$("#top").attr("src","../assets/glasses.png");
	// });

	function initExample() {
		$('#_imageData').css('background-image', 'url(../images/reloader1.gif)');
		$('#_webcam').css('display', 'none');
		var webcam			= document.getElementById("_webcam");		// our webcam video
		var imageData		= document.getElementById("_imageData");	// image data for BRFv4
		var imageDataCtx	= null;

		var brfv4			= null;
		var brfManager		= null;
		var resolution		= null;
		var ua				= window.navigator.userAgent;
		var isIOS11			= (ua.indexOf("iPad") > 0 || ua.indexOf("iPhone") > 0) && ua.indexOf("OS 11_") > 0;

		//var stats			= brfv4Example.stats;
		//if(stats.init) { stats.init(30); }

		startCamera();

		

		function startCamera() {

			console.log("startCamera");

			// Start video playback once the camera was fetched.
			function onStreamFetched (mediaStream) {

				console.log("onStreamFetched");

				webcam.srcObject = mediaStream;
				webcam.play();

				// Check whether we know the video dimensions yet, if so, start BRFv4.
				function onStreamDimensionsAvailable () {

					console.log("onStreamDimensionsAvailable");

					if (webcam.videoWidth === 0) {
						setTimeout(onStreamDimensionsAvailable, 100);
					} else {

						// Resize the canvas to match the webcam video size.
						imageData.width		= webcam.videoWidth;
						imageData.height	= webcam.videoHeight;
						imageDataCtx		= imageData.getContext("2d");

						// on iOS we want to close the video stream first and
						// wait for the heavy BRFv4 initialization to finish.
						// Once that is done, we start the stream again.

						if(isIOS11) {
							webcam.pause();
							webcam.srcObject.getTracks().forEach(function(track) {
								track.stop();
							});
						}

						waitForSDK();
					}
				}

				if(imageDataCtx === null) {
					onStreamDimensionsAvailable();
				} else {
					trackFaces();
				}
			}

			window.navigator.mediaDevices.getUserMedia({video: {width: 640, height: 480, frameRate: 60}})
				.then(onStreamFetched).catch(function () { 
					$('#_imageData').css('background-image', 'url(../images/not_found.png)');
					alert("No camera available."); 
						
					

				});
		}

		function waitForSDK() {

			if(brfv4 === null) {
				brfv4 = { locateFile: function(fileName) { return brfv4BaseURL+fileName; } };
				initializeBRF(brfv4);
			}
			if(brfv4.sdkReady) {
				initSDK();
			} else {
				setTimeout(waitForSDK, 100);
			}
		}

		function initSDK() {

			resolution	= new brfv4.Rectangle(0, 0, imageData.width, imageData.height);
			brfManager	= new brfv4.BRFManager();
			brfManager.init(resolution, resolution, "com.tastenkunst.brfv4.js.examples.minimal.webcam");

			if(isIOS11) {
				// Start the camera stream again on iOS.
				setTimeout(function () {
					console.log('delayed camera restart for iOS 11');
					startCamera()
				}, 2000)
			} else {
				trackFaces();
			}
		}

		function trackFaces() {

			var mask = document.getElementById("mask");
			if(stop == true){
				mask.style.opacity = "0.0";
				$('#_imageData').attr('height', '');
				$('#_imageData').css('background-image', 'url(../images/not_found.png)');
				webcam.pause();
							webcam.srcObject.getTracks().forEach(function(track) {
								track.stop();
							});

				return;

			}
			//if (stats.start) stats.start();

			imageDataCtx.setTransform(-1.0, 0, 0, 1, resolution.width, 0); // mirrored for draw of video
			imageDataCtx.drawImage(webcam, 0, 0, resolution.width, resolution.height);

			imageDataCtx.setTransform( 1.0, 0, 0, 1, 0, 0); // unmirrored for draw of results

			brfManager.update(imageDataCtx.getImageData(0, 0, resolution.width, resolution.height).data);

			var faces = brfManager.getFaces();

			
			//var left = document.getElementById("left");

			for(var i = 0; i < faces.length; i++) {

				var face = faces[i];

				if(		face.state === brfv4.BRFState.FACE_TRACKING_START ||
						face.state === brfv4.BRFState.FACE_TRACKING) {

					imageDataCtx.strokeStyle="#00a0ff";

					for(var k = 0; k < face.vertices.length; k += 2) {
						//imageDataCtx.beginPath();
						//imageDataCtx.arc(face.vertices[k], face.vertices[k + 1], 2, 0, 2 * Math.PI);
						//imageDataCtx.stroke();
					}

					// Set position to be nose top and calculate rotation.

					function toDegree(x) {
						return x * 180.0 / Math.PI;
					}

					var x = face.points[27].x;
					var y = face.points[27].y;

					

					var scaleX = (face.scale / 480) * (1 - toDegree(Math.abs(face.rotationY)) / 110.0) * 2.5 * mn;
					var scaleY = (face.scale / 480) * (1 - toDegree(Math.abs(face.rotationX)) / 110.0) * 2.5 * mn;

					var rotateY = toDegree(face.rotationY) *-1;
					var rotateX = toDegree(face.rotationX) *-1;

					mask.style.transform = "matrix("+scaleX+",0.0,0.0,"+scaleY+","+ (x) +","+y
					+") rotateZ("+face.rotationZ+"rad) rotateY("+(rotateY)+"deg) rotateX("+(rotateX / 2)+"deg)" ;




					if(rotateY > 0){
						$("#left").css("display", "");
						$("#right").css("display", "none");
					}
					else{
						if(rotateY == 0)
						{
							$("#right").css("display", "");
							$("#left").css("display", "");	
						}
						else
						{
							$("#right").css("display", "");
							$("#left").css("display", "none");	
						}
					}

					//console.log(mask.style);
					//left.style.transform = "rotateY("+ (face.rotationY-90 ) + "rad) translateZ( 240px )" ;
					mask.style.opacity = "1";

				} else {

					mask.style.opacity = "0.0";
				}
			}

			
			//if (stats.end) stats.end();
			requestAnimationFrame(trackFaces);
			
		}
	}