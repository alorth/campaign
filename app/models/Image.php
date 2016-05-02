<?php

class Image extends Eloquent {

	protected $table = 'images';
	protected $fillable = ['src'];

	public function product()
	{
		$this->belongsTo('Product');
	}

	public function logs() 
	{
		return $this->belongsToMany('Jenssegers\AB\Models\Log', 'image_log')->withPivot('count')->withTimestamps();
	}	
	
	
}
