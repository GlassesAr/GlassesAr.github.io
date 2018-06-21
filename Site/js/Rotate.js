$().ready(function(){
		var mask = document.getElementById("mask");

		mask.onmousedown = function(e) {

			  var coords = getCoords(mask);
			  // var shiftX = e.pageX - coords.left;
			  // var shiftY = e.pageY - coords.top;

			  var now = e.pageX;

			  mask.style.position = 'absolute';
			  //document.body.appendChild(mask);
			  if(e.which == 1){
			  moveAt(e);
			}

			  //mask.style.zIndex = 1000; // над другими элементами

			  function moveAt(e) {
			  	console.log()
			    mask.style.transform = "rotateY("+ (now - e.pageX)*-1 +"deg)";


			  }

			  document.onmousemove = function(e) {
			  	if(e.which == 1){
			    moveAt(e);
			}
			  };

			  mask.onmouseup = function() {
			    document.onmousemove = null;
			    mask.onmouseup = null;
			  };

			}

			mask.ondragstart = function() {
			  return false;
			};

			function getCoords(elem) {   // кроме IE8-
			  var box = elem.getBoundingClientRect();
			  return {
			    top: box.top + pageYOffset,
			    left: box.left + pageXOffset
			  };
			}
		});