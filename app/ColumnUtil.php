<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ColumnUtil extends Model
{
    public static function getColNamesAndTypes($model)
    {
    	$column_names = Schema::getColumnListing($model);
        $column_types = array_map(
        	function($name) use ($model) {
            	return DB::getSchemaBuilder()->getColumnType($model, $name);
        	}
        , $column_names);

        return array_combine($column_names, $column_types);
    }
}
