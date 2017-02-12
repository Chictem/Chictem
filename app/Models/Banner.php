<?php

namespace App\Models;

use App\Facades\Voyager;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class Banner extends Model
{
	protected $table = 'banners';

	protected $guarded = [];

	private static $permissions;
	private static $user_permissions;
	private static $dataTypes;
	private static $prefix;

	/**
	 * @param $query
	 * @param $name
	 * @return mixed
	 */
	public function scopeName($query, $name)
	{
		return $query->where('name', $name)->first();
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function items()
	{
		return $this->hasMany(BannerItem::class);
	}

	/**
	 * Display banner.
	 *
	 * @param string      $bannerName
	 * @param string|null $type
	 * @param array       $options
	 *
	 * @return string
	 */
	public static function display($bannerName, $type = null, $options = [])
	{
		// GET THE MENU
		$banner = static::with('items')->where('name', '=', $bannerName)->first();

		// Check for Banner Existence
		if (! isset($banner)) {
			return false;
		}

		event('voyager.banner.display', $banner);

		// Convert options array into object
		$options = (object)$options;

		self::$permissions = Permission::all();

		if (! Auth::guest()) {
			$user = User::find(Auth::id());

			self::$user_permissions = $user->role->permissions->pluck('key')->toArray();
		}

		self::$dataTypes = DataType::all();

		self::$prefix = trim(route('voyager.dashboard', [], false), '/');

		switch ($type) {
			case 'admin':
				return self::buildAdminOutput($banner->items, '', $options);

			case 'admin_banner':
				return self::buildAdminBannerOutput($banner->items, '', $options, request());

			case 'bootstrap':
				return self::buildBootstrapOutput($banner->items, '', $options, request());
		}

		return empty($type) ? self::buildOutput($banner->items, '', $options, request()) : self::buildCustomOutput($banner->items, $type, $options, request());
	}

	/**
	 * Create bootstrap banner.
	 *
	 * @param \Illuminate\Support\Collection|array $bannerItems
	 * @param string                               $output
	 * @param object                               $options
	 * @param \Illuminate\Http\Request             $request
	 *
	 * @return string
	 */
	public static function buildBootstrapOutput($bannerItems, $output, $options, Request $request, $child = null)
	{
		if (! $child) {
			$parentItems = $bannerItems->filter(function ($value) {
				return $value->parent_id == null;
			});
		} else {
			$parentItems = $bannerItems->filter(function ($value) use ($child) {
				return $value->parent_id == $child;
			});
		}

		$parentItems = $parentItems->sortBy('order');

		if (empty($output)) {
			$output = '<ul class="nav navbar-nav">';
		} else {
			$output .= '<ul class="dropdown-banner">';
		}

		foreach ($parentItems as $item) {
			$li_class = '';
			$a_attrs = '';

			if ($request->is(ltrim($item->url, '/')) || $item->url == '/' && $request->is('/')) {
				$li_class = ' class="active"';
			}

			$children_banner_items = $bannerItems->filter(function ($value, $key) use ($item) {
				return $value->parent_id == $item->id;
			});

			$caret = '';

			if ($children_banner_items->count() > 0) {
				if ($li_class != '') {
					$li_class = rtrim($li_class, '"') . ' dropdown"';
				} else {
					$li_class = ' class="dropdown"';
				}
				$a_attrs = 'class="dropdown-toggle" data-toggle="dropdown" ';
				$caret = '<span class="caret"></span>';
			}

			$icon = '';

			if (isset($options->icon) && $options->icon == true) {
				$icon = '<i class="' . $item->icon_class . '"></i>';
			}

			$styles = '';

			if (isset($options->color) && $options->color == true) {
				$styles = ' style="color:' . $item->color . '"';
			}

			if (isset($options->background) && $options->background == true) {
				$styles = ' style="background-color:' . $item->color . '"';
			}

			$output .= '<li' . $li_class . '><a ' . $a_attrs . ' href="' . $item->url . '" target="' . $item->target . '"' . $styles . '>' . $icon . '<span>' . $item->title . '</span>' . $caret . '</a>';

			if ($children_banner_items->count() > 0) {
				$output = self::buildBootstrapOutput($bannerItems, $output, $options, $request, $item->id);
			}

			$output .= '</li>';
		}

		$output .= '</ul>';

		return $output;
	}

	/**
	 * Create custom banner based on supplied view.
	 *
	 * @param \Illuminate\Support\Collection|array $bannerItems
	 * @param string                               $view
	 * @param object                               $options
	 * @param \Illuminate\Http\Request             $request
	 *
	 * @return string
	 */
	public static function buildCustomOutput($bannerItems, $view, $options, Request $request)
	{
		return view()->exists($view) ? view($view)->with('items', $bannerItems)->render() : self::buildOutput($bannerItems, '', $options, $request);
	}

	/**
	 * Create default banner.
	 *
	 * @param \Illuminate\Support\Collection|array $bannerItems
	 * @param string                               $output
	 * @param object                               $options
	 * @param \Illuminate\Http\Request             $request
	 *
	 * @return string
	 */
	public static function buildOutput($bannerItems, $output, $options, Request $request, $child = null)
	{
		if (! $child) {
			$parentItems = $bannerItems->filter(function ($value) {
				return $value->parent_id == null;
			});
		} else {
			$parentItems = $bannerItems->filter(function ($value) use ($child) {
				return $value->parent_id == $child;
			});
		}

		$parentItems = $parentItems->sortBy('order');

		if (empty($output)) {
			$output = '<ul>';
		} else {
			$output .= '<ul>';
		}

		foreach ($parentItems as $item) {
			$li_class = '';

			if ($request->is(ltrim($item->url, '/')) || $item->url == '/' && $request->is('/')) {
				$li_class = ' class="active"';
			}

			$children_banner_items = $bannerItems->filter(function ($value, $key) use ($item) {
				return $value->parent_id == $item->id;
			});

			$icon = '';

			if (isset($options->icon) && $options->icon == true) {
				$icon = '<i class="' . $item->icon_class . '"></i>';
			}

			$styles = '';

			if (isset($options->color) && $options->color == true) {
				$styles = ' style="color:' . $item->color . '"';
			}

			if (isset($options->background) && $options->background == true) {
				$styles = ' style="background-color:' . $item->color . '"';
			}

			$output .= '<li' . $li_class . '><a href="' . $item->url . '" target="' . $item->target . '"' . $styles . '>' . $icon . '<span>' . $item->title . '</span></a>';

			if ($children_banner_items->count() > 0) {
				$output = self::buildOutput($bannerItems, $output, $options, $request, $item->id);
			}

			$output .= '</li>';
		}

		$output .= '</ul>';

		return $output;
	}

	/**
	 * Create admin banner.
	 *
	 * @param \Illuminate\Support\Collection|array $bannerItems
	 * @param string                               $output
	 * @param object                               $options
	 * @param \Illuminate\Http\Request             $request
	 *
	 * @return string
	 */
	public static function buildAdminBannerOutput($bannerItems, $output, $options, Request $request, $child = null)
	{
		if (! $child) {
			$parentItems = $bannerItems->filter(function ($value, $key) {
				return $value->parent_id == null;
			});
		} else {
			$parentItems = $bannerItems->filter(function ($value, $key) use ($child) {
				return $value->parent_id == $child;
			});
		}

		$parentItems = $parentItems->sortBy('order');

		foreach ($parentItems as $item) {
			$li_class = '';
			$collapse_id = '';

			if ($request->is(ltrim($item->url, '/'))) {
				$li_class = ' class="active"';
			}

			$children_banner_items = $bannerItems->filter(function ($value, $key) use ($item) {
				return $value->parent_id == $item->id;
			});

			if ($children_banner_items->count() > 0) {
				if ($li_class != '') {
					$li_class = rtrim($li_class, '"') . ' dropdown"';
				} else {
					$li_class = ' class="dropdown"';
				}

				$collapse_id = Str::slug($item->title, '-') . '-dropdown-element';
				$a_attrs = 'data-toggle="collapse" href="#' . $collapse_id . '"';
			} else {
				$a_attrs = 'href="' . $item->url . '"';
			}

			// Permission Checker
			$slug = str_replace('/', '', preg_replace('/^\/' . self::$prefix . '/', '', $item->url));
			if ($slug != '') {
				// Get dataType using slug
				$dataType = self::$dataTypes->first(function ($value) use ($slug) {
					return $value->slug == $slug;
				});

				if ($dataType) {
					// Check if datatype permission exist
					$exist = self::$permissions->first(function ($value) use ($dataType) {
						return $value->key == 'browse_' . $dataType->name;
					});
				} else {
					// Check if admin permission exists
					$exist = self::$permissions->first(function ($value) use ($slug) {
						return $value->key == 'browse_' . $slug && $value->table_name == 'admin';
					});
				}

				if ($exist) {
					// Check if current user has access
					if (! in_array($exist->key, self::$user_permissions)) {
						continue;
					}
				}
			}

			$children_output = null;

			if ($children_banner_items->count() > 0) {
				$children_output = self::buildAdminBannerOutput($bannerItems, '', [], $request, $item->id);

				if ($children_output == '') {
					continue;
				}
			}

			$output .= '<li' . $li_class . '><a ' . $a_attrs . ' target="' . $item->target . '">' . '<span class="icon ' . $item->icon_class . '"></span>' . '<span class="title">' . $item->title . '</span></a>';

			if (! is_null($children_output)) {
				// Add tag for collapse panel
				$output .= '<div id="' . $collapse_id . '" class="panel-collapse collapse"><div class="panel-body">';
				//$output = self::buildAdminBannerOutput($bannerItems, $output, [], $request, $item->id);
				$output .= $children_output;
				$output .= '</div></div>';      // close tag of collapse panel
			}

			$output .= '</li>';
		}

		if (empty($output)) {
			return '';
		}

		return '<ul class="nav navbar-nav">' . $output . '</ul>';
	}

	/**
	 * Build admin banner.
	 *
	 * @param \Illuminate\Support\Collection|array $bannerItems
	 * @param string                               $output
	 * @param object                               $options
	 *
	 * @return string
	 */
	public static function buildAdminOutput($bannerItems, $output, $options, $child = null)
	{
		if (! $child) {
			$parentItems = $bannerItems->filter(function ($value, $key) {
				return $value->parent_id == null;
			});
		} else {
			$parentItems = $bannerItems->filter(function ($value, $key) use ($child) {
				return $value->parent_id == $child;
			});
		}

		$parentItems = $parentItems->sortBy('order');

		$output .= '<ol class="dd-list">';

		foreach ($parentItems as $item) {
			$output .= '<li class="dd-item" data-id="' . $item->id . '">';
			$output .= '<div class="pull-right item_actions">';
			$output .= '<div class="btn-sm btn-danger pull-right delete" data-id="' . $item->id . '"><i class="voyager-trash"></i> Delete</div>';
			$output .= '<div class="btn-sm btn-primary pull-right edit" data-id="' . $item->id . '" data-title="' . $item->title . '" data-url="' . $item->url . '" data-description="' . $item->description . '" data-image="' . Voyager::image($item->getOriginal('image')) . '" data-image_url="' . $item->image_url . '"><i class="voyager-edit"></i> Edit</div>';
			$output .= '</div>';

			$img = '<img src="' . $item->image . '" class="thumb">';

			$output .= '<div class="dd-handle"><h4>' . $item->title . '</h4>' . $img . '</div>';

			$children_banner_items = $bannerItems->filter(function ($value, $key) use ($item) {
				return $value->parent_id == $item->id;
			});

			if ($children_banner_items->count() > 0) {
				$output = self::buildAdminOutput($bannerItems, $output, $options, $item->id);
			}

			$output .= '</li>';
		}

		$output .= '</ol>';

		return $output;
	}

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
