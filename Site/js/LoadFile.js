
	   function previewFile(id, id2 = null, type){
	       var preview = document.getElementById(id); //selects the query named img
	       if(id2 != null){
		       var preview2 = document.getElementById(id2);
		   }
	       //var default = preview.src;
	       var file    = document.querySelector('input[name='+ type +']').files[0]; //sames as here
	       var reader  = new FileReader();
	       
	       reader.onloadend = function () {
	           preview.src = reader.result;
	           if(id2 != null){
	       		 preview2.src = reader.result;
	       		 $.modal.close();
	       	   }	
	       }

	       if (file) {
	           reader.readAsDataURL(file); //reads the data as a URL
	       } else {
	           //preview.src = default;
	       }
	  }


