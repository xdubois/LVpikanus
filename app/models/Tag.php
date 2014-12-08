<?php

class Tag extends Eloquent {
	protected $guarded = array();
	protected $table = 'tag';
	protected $primaryKey = 'idtag';
	public    $timestamps = false;

	public static $rules = array();


	public function tags() {

		return $this->BelongsToMany('Tag', 'imagehastag', 'idxTag', 'idxImage');
	}
}
