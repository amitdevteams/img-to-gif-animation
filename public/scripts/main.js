$(function() {

 $.ajaxSetup({
    headers: {
      'X-CSRF-Token': $('meta[name="_token"]').attr('content')
    }
  });
	
	var imagesform = $('#imagesform');
	var names = [];

	

	Dropzone.options.imagesform = {
		success: function(file, response){
		         names.push(response.fileName); //Add file name to array , to send then back to server to generate the gif.
		         		$('#result').html('')
		       }
		       ,
			error: function(file , response){
			var errors =response.file;
			$('#result').html('')
			//handle errors validation
			errors.forEach(function(error)
				{
					$('#result').append('<div class="alert alert-danger"> ' + error + ' </div>');
				});

		}
	};



		        $(document).on('click', '#generate-button', function(){
		        	if(names.length <= 1) //2 and more images can become GIF
		        	{
		        		$('#result').html('')
		        		$('#result').append('<div class="alert alert-danger"> You must put at least 2 pictures. </div>');
		        	}
		        	else if(names.length >= 10) //10 + is way too much!
		        	{
		        		$('#result').html('')
		        		$('#result').append('<div class="alert alert-danger"> Limit is 10 pictures. </div>');
		        	}
		        	else{
		        		$.ajax({
		        			type:"POST",
		        			url:"/generate",
		        			data: { "names" : names, },
		        			success: function(res)
		        			{
		        				
		        				$('#result').html('<a target="_blank" class="btn btn-warning" href="' + res.created + '">Download Image</a> <div class="result-image"><img height=150 class="img-responsive" src="' + res.created +'" /> </div>');

		        				names=[];
		        				var myDropzone = Dropzone.forElement("#imagesform");
		        				myDropzone.removeAllFiles();
		        				
		        			},
		        			error: function(error)
		        			{
		        				$('#result').html('')
		        				$('#result').append('<div class="alert alert-danger"> ' + error + ' </div>');
		        			}
		        		
		        		});
		        	}

		        })
		       

});