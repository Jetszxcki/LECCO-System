<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Member;

class Share extends Model
{
    protected $guarded = [];

    public function scopeColumnNames($query) {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

	public function getColumnNameForView($column)
	{
		return ucwords(str_replace('_', ' ', $column));
	}
}
