<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Share;
use App\Loan;

class Member extends Model
{
	protected $guarded = [];
	
	protected $attributes = [
		'profile_picture' => 'user.jpg',
	];

	// accessors
	public function getFullNameAttribute()
	{
	    return "{$this->first_name} {$this->last_name}";
	}

	public function getBdayAttribute()
	{
		$date = explode('-', $this->birthday);
		$month = date_create_from_format('!m', $date[1])->format('F');
		return "{$month} {$date[2]}, {$date[0]}";
	}
	
	// scopes
	public function scopeNames($query)
	{
		return $query->select('id', 'first_name', 'last_name');
	}
	
    // relationships
    public function shares()
    {
    	return $this->hasMany(Share::class);
    }

    public function loans()
    {
    	return $this->hasMany(Loan::class);
    }

	// other functions
	public function getColumnNameForView($column)
	{
		return ucwords(str_replace('_', ' ', $column));
	}
}
