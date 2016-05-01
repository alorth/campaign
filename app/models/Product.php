<?php

class Product extends Eloquent {

	protected $table = 'products';
	protected $fillable = ['prefix', 'title', 'rightDesc', 'bottomDesc', 'price'];
	

	public function images()
	{
		return $this->hasMany('Image');
	}

	public function video()
	{
		return $this->hasOne('Video');
	}
}
