<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use App\Models\Banner;

class PageController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$slug = $request->route()->getUri();
		$page = Page::whereSlug($slug)->first();

		$view = 'pages.default';

		if (view()->exists('pages.' . $slug)) {
			$view = 'pages.' . $slug;
		}
		
		return view($view, compact('slug', 'page'));
	}
}
