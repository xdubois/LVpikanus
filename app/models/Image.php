<?php

class Image extends Eloquent {
	protected $guarded = array();
	protected $table = 'image';
	protected $primaryKey = 'idimage';
	public    $timestamps = false;


	public static $rules = array();


	public function tags() {

		return $this->BelongsToMany('Tag', 'imagehastag', 'idxImage', 'idxTag');
	}

	public function comments() {

		return $this->HasMany('Comment', 'idxImage', 'idimage');
	}

	public function getDates() {
	    return array('date');
	}

	public function image_tag() {
		$now = new DateTime($this->date, new DateTimeZone('Europe/Zurich'));
		$url =  asset('images/'.  $now->format('Y'). '/' . $this->nom);
		return '<img src="'. $url .'" alt="anus"  >';
	}

	public function image_path() {
		$now = new DateTime($this->date, new DateTimeZone('Europe/Zurich'));
		$year_folder = $now->format('Y'). '/';

		return asset('images/' . $year_folder  .$this->nom);
	}

	public function image_min_path() {
		$now = new DateTime($this->date, new DateTimeZone('Europe/Zurich'));
		$year_folder = $now->format('Y'). '/';

		return asset('images/' . $year_folder  . 'min/min_' . $this->nom);
	}

	public function folder() {
		$now = new DateTime($this->date, new DateTimeZone('Europe/Zurich'));
		$year_folder = $now->format('Y'). '/';
		return 'images/'. $year_folder;
	}
}
