<?php

class Video extends Eloquent {

	protected $table = 'videos';
	protected $fillable = ['image', 'src'];
	
	public function product()
	{
		return $this->belongsTo('Product');
	}

	public function thumbnail()
	{
		return $this->belongsTo('Image', 'image_id', 'id');
	}
}
