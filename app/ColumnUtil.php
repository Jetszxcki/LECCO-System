<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ColumnUtil extends Model
{
    public static function getColNamesAndTypes($model, $fieldsWithChoices = null)
    {
    	$column_names = Schema::getColumnListing($model);
        $column_types = array_map(
        	function($name) use ($model) {
            	return DB::getSchemaBuilder()->getColumnType($model, $name);
        	}
        , $column_names);

        $columns = array_combine($column_names, $column_types);

        /*
            add args in controller by adding a string version of the arg
            e.g. $columns['amount']['args'] = ['disabled', 'radio/checkbox', ...];

            then in form, create a custom if-blade for each args (e.g. <input type={{ @radio "" @endradio }})
        */

        foreach ($columns as $name => $type) {
            $columns[$name] = [
                'type' => $type,
                'choices' => null,
                'args' => [],
            ];
        }

        if ($fieldsWithChoices != null) {
            foreach ($fieldsWithChoices as $name => $choices) {
                $columns[$name] = [
                    'type' => 'choices',
                    'choices' => $choices,
					'multiple' => False,
                    'args' => [],
                ];
            }
        }

        return $columns;
    }
}
