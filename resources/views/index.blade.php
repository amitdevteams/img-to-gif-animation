<!DOCTYPE html>
<html>
<head>
	<title>Images to Gif</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.css">
	<link rel="stylesheet" type="text/css" href="{{ URL::to('/styles/main.css') }}">
	<meta name="_token" content="{{ csrf_token() }}">
</head>
<body>
   
      <div class="container" >
      	<div class="row">
      		<div class="col-sm-8 offset-sm-2">
      			<h2>Drop your images and generate a GIF image.</h2>
      			<div id="appform">
					<form enctype="multipart/form-data" method="POST" action="/upload" class="dropzone" id="imagesform">
						{{ csrf_field() }}
						 <div class="dz-message">Drop files here or click to upload.
                            <br> <span class="note">
                            	Max Files:10 | Min: 2 |Max Size: 2MB.
                            	<br>
                            	
                            </span>

                        </div>
					</form>
				</div>

				<button class="btn btn-success float-right" id="generate-button">Generate GIF</button>
	        </div>

		</div>

		<div class="row">

		<div class="col-sm-8 offset-sm-2">

			<div id="result"></div>
		</div>

		</div>
         
         {{-- <div class="row">
			<footer class="col-sm-8 offset-sm-2">
				&copy; 2018 George Lioympas - <a href="https://github.com/glioympas/imgtogif">Github Code</a>
			</footer>
		</div> --}}
	  </div>



<script
  src="https://code.jquery.com/jquery-1.12.4.min.js"
  integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ="
  crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/min/dropzone.min.js"></script>
<script src="{{ URL::to('/scripts/main.js') }}"></script>


</body>
</html>