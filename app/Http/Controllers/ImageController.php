<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use URL;
use App\Library\GifCreator;
use App\Http\Requests\FileUploadRequest;

use Illuminate\Validation\Validator;

class ImageController extends Controller
{
	//the home page
    public function index(){
    	return view('index');
    }


    //Every drag and drop of the dropzone pugin is a different POST request to this method.
    public function upload(FileUploadRequest $request)
    {

    	//Validation to avoid exploiting and etc. Think that a user can upload a .php in your server, that's baaaaaad. ONLY IMAGES
    	//validation becomes with FileUploadRequest request.
   	
    	$file = $request->file('file');
    	$name = time() . $file->getClientOriginalName();
    	$file->move('images',$name);
    	return response()->json(['fileName'=>$name],201);
    }


    //generate the gif image.
    //it uses open source GifCreator class for the image proccessing part.
    public function generate(Request $request)
    {
    	$names = $request->names;

    	//add /public/images/ to every image image , so the final will be /public/images/exampleName.png
    	$names = array_map(function($name){
    		return public_path() . '/images/' . $name; 
    	} , $names);
 		

    	//fill the durations array as many times are are the images.
    	$durations = [];
    	foreach($names as $i)
    		$durations[] = 150; 

    	$gc = new GifCreator();
    	$gc->create($names , $durations , 0);
    	$gifBinary = $gc->getGif();
    	$gifName = time();
    	file_put_contents(public_path() .'/images/gifs/' . $gifName . '.gif', $gifBinary); //saving the gif to public/images/gifs/date.gif

        //delete the old-images to free memory
        foreach($names as $img)
            unlink($img);

    	return response()->json(['created'=>URL::to('/images/gifs/'.$gifName.'.gif')] , 200);
    }




}


