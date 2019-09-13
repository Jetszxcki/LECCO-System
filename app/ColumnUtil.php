<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ColumnUtil extends Model
{
    /*
        Steps on how to use found at LoansController
    */

    public static function getColNamesAndTypes($model, $disabledFields = null, $fieldsWithChoices = null)
    {
    	$column_names = Schema::getColumnListing($model);
        $column_types = array_map(
        	function($name) use ($model) {
            	return DB::getSchemaBuilder()->getColumnType($model, $name);
        	}
        , $column_names);

        $columns = array_combine($column_names, $column_types);

        if ($fieldsWithChoices) {
            foreach ($fieldsWithChoices as $field) {
                $columns[$field] = 'choices';
            }
        }

        if ($disabledFields) {
            foreach ($disabledFields as $field) {
                $columns[$field] = "{$columns[$field]}|disabled";
            }
        }

        return $columns;
    }
}
