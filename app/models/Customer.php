<?php

class Customer extends Eloquent {

	protected $table = 'customers';
	protected $fillable = ['product', 'price', 'number', 
		'other', 'name', 'email', 'phone', 'ship', 'address'];
	
}
