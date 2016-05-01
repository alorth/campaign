<?php

class Video extends Eloquent {

	protected $table = 'videos';
	protected $fillable = ['image', 'src'];
	
	public function product()
	{
		$this->belongsTo('Product');
	}
}
