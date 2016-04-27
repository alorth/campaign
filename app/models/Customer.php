<?php

class Customer extends Eloquent {

	protected $table = 'customers';
	protected $fillable = ['product', 'price', 'number', 'ship', 'address', 'email'];

}
