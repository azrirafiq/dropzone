<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    //
	use SoftDeletes;

    public function area() {
    	return $this->belongsTo('App\Area');
    }
    public function brand() {
		return $this->belongsTo('App\Brand');
	}
	public function subcategory() {
		return $this->belongsTo('App\Subcategory');
	}
	public function state() {
		return $this->belongsTo('App\State');
	}
	public function user() {
		return $this->belongsTo('App\User');
	}
	public function category() {
		return $this->belongsTo('App\Category');
	}

}
