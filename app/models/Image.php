<?php

class Image extends Eloquent {

	protected $table = 'images';
	protected $fillable = ['src'];

	public function product()
	{
		$this->belongsTo('Product');
	}
	
}
