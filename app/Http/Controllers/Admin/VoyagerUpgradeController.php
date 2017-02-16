<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Schema\Blueprint;
use Schema;
use App\Facades\Voyager;

class VoyagerUpgradeController extends Controller
{
	/**
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function index()
	{
		$upgraded = $this->upgrade_v0_10_6();

		if ($upgraded) {
			return redirect()->route('voyager.dashboard')->with([
				'message' => trans('flash.upgrade', ['name' => trans('common.model.database')]),
				'alert-type' => 'success'
			]);
		} else {
			return redirect()->route('voyager.dashboard');
		}
	}

	/**
	 * @return bool
	 */
	private function upgrade_v0_10_6()
	{
		if (! Schema::hasColumn('data_types', 'server_side')) {
			Schema::table('data_types', function (Blueprint $table) {
				$table->tinyInteger('server_side')->default(0)->after('generate_permissions');
			});

			return true;
		}

		return false;
	}
}
