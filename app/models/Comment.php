<?php

class Comment extends Eloquent {
	protected $guarded = array();
	protected $table = 'commentaire';
	protected $primaryKey = 'idcommentaire';
	public 	  $timestamps = false;

	public static $rules = array();


	public function image() {

		return $this->belongsTo('Image', 'idxImage', 'idimage');
	}
}
