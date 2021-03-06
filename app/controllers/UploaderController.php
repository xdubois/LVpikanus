<?php

class UploaderController extends BaseController {

	protected $rules = array(
   	 'img' => 'required|image|max:5000', 
    );

	protected $base_url = 'images/';
	protected $temp_folder = 'images/temp/';
	protected $upload_folder = 'images/'; 
	protected $thumbnail_directory_name = 'min/';
	protected $valide_mime = array('image/gif','image/jpeg','image/jpg','image/png'); //we need that to validate remote file

	protected $max_width = 250;
	protected $max_height = 250;

	protected $prod_gif_tag_id = 246;

	public function index() {

		return View::make('uploads.index');
	}

	public function upload() {
		$validator = Validator::make(Input::all(), $this->rules);
		if($validator->passes()) {

			$file = Input::file('img');
			$filename = Str::random(12).'.'.$file->getClientOriginalExtension();
			$success = $file->move($this->temp_folder, $filename);
			if (Request::ajax()) {
				if($success) {
				 	$link = $this->process_file($filename);
			        return Response::json(array('link' => $link), 200);
			    } 
			    else {
			        return Response::json('error', 400);
			    }
			}
			else { //fallback
				return View::make('front.account.profilePicture')->with('image', $image);
			}

		
		}
		return Response::make($validator->messages()->all(), 400);
	}

	public function process_file($filename) {

		$now = new DateTime(null, new DateTimeZone('Europe/Zurich'));
		$year_folder = $now->format('Y'). '/';
		$this->upload_folder.=$year_folder;

		//check if the directory of the year exist
		if(! File::isDirectory($this->upload_folder)) {
			File::makeDirectory($this->upload_folder,  $mode = 0755, $recursive = false);
			File::makeDirectory($this->upload_folder . $this->thumbnail_directory_name,  $mode = 0755, $recursive = false);
		}

		//crop and resize that bitch
		Intervention\Image\Image::make($this->temp_folder . $filename)
			->resize($this->max_width, $this->max_height, true, true)
			->save($this->upload_folder . $this->thumbnail_directory_name .'min_'. $filename);

		File::move($this->temp_folder . $filename, $this->upload_folder . $filename);


		//save that bitch
		$img = new Image();
		$img->nom = $filename;
		$img->date = $now->getTimestamp(); 
		$img->ip = Request::getClientIp();
		$img->save();

		//tag as gif
		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		if($ext == 'gif') {
			$img->tags()->attach($this->prod_gif_tag_id);
		}

		return $link = route('image.show', $filename);
	}

	public function remote($url = '') {

		$url = Input::has('url') ? Input::get('url') : str_replace('_CACA_','/', $url); //If its a remote we replace the url

		$ch = curl_init ($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
    $raw = curl_exec($ch);
		if(curl_getinfo($ch, CURLINFO_CONTENT_TYPE) !== FALSE){
				
				$mime = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
				if(in_array($mime, $this->valide_mime)) {
					curl_close ($ch);
					if(file_exists($this->temp_folder.basename($url)))
						unlink($this->temp_folder.basename($url));
					$filename = Str::random(12).'.' .$this->getExtFromMime($mime);
					$fp = fopen($this->temp_folder.$filename, 'x');
					fwrite($fp, $raw);
					fclose($fp);
				  $link = $this->process_file($filename);
					return route('image.show', $filename);
				}
			}

		 return 'Error / Invalid file';
	}

	private function getExtFromMime($mime_type){
		$ext = explode('/', $mime_type);
		if($ext[1] == 'jpeg')
			$ext[1] = 'jpg';
			
		return $ext[1];
	}

}
