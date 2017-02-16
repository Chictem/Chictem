<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * @todo: Refactor this class by using something like MenuBuilder Helper.
 */
class Menu extends Model
{
	protected $table = 'menus';

	protected $guarded = [];

	private static $permissions;
	private static $userPermissions;
	private static $dataTypes;
	private static $prefix;

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\HasMany
	 */
	public function items()
	{
		return $this->hasMany(MenuItem::class)->orderBy('order');
	}

	/**
	 * <ul class="nav navbar-nav">
	 * <li class="active"><a href="#">Link <span class="sr-only">(current)</span></a></li>
	 * <li><a href="#">Link</a></li>
	 * <li class="dropdown">
	 * <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
	 * aria-expanded="false">Dropdown <span class="caret"></span></a>
	 * <ul class="dropdown-menu">
	 * <li><a href="#">Action</a></li>
	 * <li><a href="#">Another action</a></li>
	 * <li><a href="#">Something else here</a></li>
	 * <li role="separator" class="divider"></li>
	 * <li><a href="#">Separated link</a></li>
	 * <li role="separator" class="divider"></li>
	 * <li><a href="#">One more separated link</a></li>
	 * </ul>
	 * </li>
	 * </ul>
	 */
	public static function render($menuName, $class = 'nav navbar-nav')
	{
		return Menu::display($menuName, 'bootstrap', ['class' => $class]);
	}

	/**
	 * Display menu.
	 *
	 * @param string      $menuName
	 * @param string|null $type
	 * @param array       $options
	 *
	 * @return string
	 */
	public static function display($menuName, $type = null, $options = [])
	{
		// GET THE MENU
		$menu = static::with('items')->where('name', '=', $menuName)->first();

		// Check for Menu Existence
		if (! isset($menu)) {
			return false;
		}

		event('voyager.menu.display', $menu);

		// Convert options array into object
		$options = (object)$options;

		self::$permissions = Permission::all();

		if (! Auth::guest()) {
			$user = User::find(Auth::id());

			self::$userPermissions = $user->role->permissions->pluck('key')->toArray();
		}

		self::$dataTypes = DataType::all();

		self::$prefix = trim(route('voyager.dashboard', [], false), '/');

		switch ($type) {
			case 'admin':
				return self::buildAdminOutput($menu->items, '', $options);

			case 'admin_menu':
				return self::buildAdminMenuOutput($menu->items, '', $options, request());

			case 'bootstrap':
				return self::buildBootstrapOutput($menu->items, '', $options, request());
		}

		return empty($type) ? self::buildOutput($menu->items, '', $options, request()) : self::buildCustomOutput($menu->items, $type, $options, request());
	}

	/**
	 * Create bootstrap menu.
	 *
	 * @param \Illuminate\Support\Collection|array $menuItems
	 * @param string                               $output
	 * @param object                               $options
	 * @param \Illuminate\Http\Request             $request
	 *
	 * @return string
	 */
	public static function buildBootstrapOutput($menuItems, $output, $options, Request $request, $child = null)
	{
		if (! $child) {
			$parentItems = $menuItems->filter(function ($value) {
				return $value->parent_id == null;
			});
		} else {
			$parentItems = $menuItems->filter(function ($value) use ($child) {
				return $value->parent_id == $child;
			});
		}

		$parentItems = $parentItems->sortBy('order');

		if (empty($output)) {
			if (isset($options->class) && $options->class == true) {
				$output = '<ul class="' . $options->class . '">';
			} else {
				$output = '<ul class="nav navbar-nav">';
			}
		} else {
			$output .= '<ul class="dropdown-menu">';
		}

		foreach ($parentItems as $item) {
			$li_class = '';
			$a_attrs = '';

			if ($request->is(ltrim($item->url, '/')) || $item->url == '/' && $request->is('/')) {
				$li_class = ' class="active"';
			}

			$children_menu_items = $menuItems->filter(function ($value, $key) use ($item) {
				return $value->parent_id == $item->id;
			});

			$caret = '';

			if ($children_menu_items->count() > 0) {
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

			if ($children_menu_items->count() > 0) {
				$output = self::buildBootstrapOutput($menuItems, $output, $options, $request, $item->id);
			}

			$output .= '</li>';
		}

		$output .= '</ul>';

		return $output;
	}

	/**
	 * Create custom menu based on supplied view.
	 *
	 * @param \Illuminate\Support\Collection|array $menuItems
	 * @param string                               $view
	 * @param object                               $options
	 * @param \Illuminate\Http\Request             $request
	 *
	 * @return string
	 */
	public static function buildCustomOutput($menuItems, $view, $options, Request $request)
	{
		return view()->exists($view) ? view($view)->with('items', $menuItems)->render() : self::buildOutput($menuItems, '', $options, $request);
	}

	/**
	 * Create default menu.
	 *
	 * @param \Illuminate\Support\Collection|array $menuItems
	 * @param string                               $output
	 * @param object                               $options
	 * @param \Illuminate\Http\Request             $request
	 *
	 * @return string
	 */
	public static function buildOutput($menuItems, $output, $options, Request $request, $child = null)
	{
		if (! $child) {
			$parentItems = $menuItems->filter(function ($value) {
				return $value->parent_id == null;
			});
		} else {
			$parentItems = $menuItems->filter(function ($value) use ($child) {
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

			$children_menu_items = $menuItems->filter(function ($value, $key) use ($item) {
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

			if ($children_menu_items->count() > 0) {
				$output = self::buildOutput($menuItems, $output, $options, $request, $item->id);
			}

			$output .= '</li>';
		}

		$output .= '</ul>';

		return $output;
	}

	/**
	 * Create admin menu.
	 *
	 * @param \Illuminate\Support\Collection|array $menuItems
	 * @param string                               $output
	 * @param object                               $options
	 * @param \Illuminate\Http\Request             $request
	 *
	 * @return string
	 */
	public static function buildAdminMenuOutput($menuItems, $output, $options, Request $request, $child = null)
	{
		if (! $child) {
			$parentItems = $menuItems->filter(function ($value, $key) {
				return $value->parent_id == null;
			});
		} else {
			$parentItems = $menuItems->filter(function ($value, $key) use ($child) {
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

			$children_menu_items = $menuItems->filter(function ($value, $key) use ($item) {
				return $value->parent_id == $item->id;
			});

			if ($children_menu_items->count() > 0) {
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
					if (! in_array($exist->key, self::$userPermissions)) {
						continue;
					}
				}
			}

			$children_output = null;

			if ($children_menu_items->count() > 0) {
				$children_output = self::buildAdminMenuOutput($menuItems, '', [], $request, $item->id);

				if ($children_output == '') {
					continue;
				}
			}

			$output .= '<li' . $li_class . '><a ' . $a_attrs . ' target="' . $item->target . '">' . '<span class="icon ' . $item->icon_class . '"></span>' . '<span class="title">' . $item->title . '</span></a>';

			if (! is_null($children_output)) {
				// Add tag for collapse panel
				$output .= '<div id="' . $collapse_id . '" class="panel-collapse collapse"><div class="panel-body">';
				//$output = self::buildAdminMenuOutput($menuItems, $output, [], $request, $item->id);
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
	 * Build admin menu.
	 *
	 * @param \Illuminate\Support\Collection|array $menuItems
	 * @param string                               $output
	 * @param object                               $options
	 *
	 * @return string
	 */
	public static function buildAdminOutput($menuItems, $output, $options, $child = null)
	{
		if (! $child) {
			$parentItems = $menuItems->filter(function ($value, $key) {
				return $value->parent_id == null;
			});
		} else {
			$parentItems = $menuItems->filter(function ($value, $key) use ($child) {
				return $value->parent_id == $child;
			});
		}

		$parentItems = $parentItems->sortBy('order');

		$output .= '<ol class="dd-list">';

		foreach ($parentItems as $item) {
			$output .= '<li class="dd-item" data-id="' . $item->id . '">';
			$output .= '<div class="pull-right item_actions">';
			$output .= '<div class="btn-sm btn-danger pull-right delete" data-id="' . $item->id . '"><i class="voyager-trash"></i> Delete</div>';
			$output .= '<div class="btn-sm btn-primary pull-right edit" data-id="' . $item->id . '" data-title="' . $item->title . '" data-url="' . $item->url . '" data-target="' . $item->target . '" data-icon_class="' . $item->icon_class . '" data-color="' . $item->color . '"><i class="voyager-edit"></i> Edit</div>';
			$output .= '</div>';
			$output .= '<div class="dd-handle">' . $item->title . ' <small class="url">' . $item->url . '</small></div>';

			$children_menu_items = $menuItems->filter(function ($value, $key) use ($item) {
				return $value->parent_id == $item->id;
			});

			if ($children_menu_items->count() > 0) {
				$output = self::buildAdminOutput($menuItems, $output, $options, $item->id);
			}

			$output .= '</li>';
		}

		$output .= '</ol>';

		return $output;
	}
}
