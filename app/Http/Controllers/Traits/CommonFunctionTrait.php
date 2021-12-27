<?php

namespace App\Http\Controllers\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

trait CommonFunctionTrait {
	public function getSlug($value, $table_name, $id = 0) {
		$new_slug = $slug = Str::slug($value);

		do {
			$count = DB::table($table_name)
			->where('slug', $slug);

			if ($id) {
				$count = $count->where('id', '!=', $id);
			}

			$count = $count->count();

			$new_slug = $slug = ($count) ? $slug . '-' . $count : $slug;
		} while ($count);

		return $new_slug;
	}
}