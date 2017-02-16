<?php

namespace App\Utilities;

use App\Models\DataType;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use App\Models\Permission;
use App\Models\Setting;
use App\Models\User as UserModal;

class Voyager
{
	/**
	 * @var static instance
	 */
	private static $instance;

	/**
	 * @var
	 */
	protected $version;

	/**
	 * @var \Illuminate\Foundation\Application|mixed
	 */
	protected $filesystem;

	/**
	 * @var array
	 */
	protected $alerts = [];

	/**
	 * @var bool
	 */
	protected $allertsCollected = false;

	public function __construct()
	{
		$this->filesystem = app(Filesystem::class);

		// $this->findVersion();
	}

	public static function getInstance()
	{
		if (is_null(static::$instance)) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	/**
	 * @param      $key
	 * @param null $default
	 * @return null
	 */
	public static function setting($key, $default = null)
	{
		$setting = Setting::where('key', '=', $key)->first();
		if (isset($setting->id)) {
			return $setting->value;
		}

		return $default;
	}

	/**
	 * @param        $file
	 * @param string $default
	 * @return string
	 */
	public static function image($file, $default = '')
	{
		if (! empty($file) && Storage::exists(config('voyager.storage.subfolder') . $file)) {
			return Storage::url(config('voyager.storage.subfolder') . $file);
		}

		return $default;
	}

	/**
	 * get routes
	 */
	public static function routes()
	{
		require dirname(__DIR__) . '/../routes/admin.php';
	}

	/**
	 * @param $permission
	 */
	public static function can($permission)
	{
		// Check if permission exist
		$exist = Permission::where('key', $permission)->first();

		if ($exist) {
			$user = UserModal::find(Auth::id());
			if (! $user->hasPermission($permission)) {
				static::own();
			}
		}
	}

	/**
	 * @param $path
	 * @return null
	 */
	public static function getSlug($path)
	{
		$paths = explode('/', $path);
		foreach ($paths as $key => $value) {
			if (is_numeric($value)) {
				return [$paths[$key - 1], $value];
			}
		}
		return [null, null];
	}

	/**
	 * Check own permission
	 */
	public static function own()
	{
		$path = request()->path();
		list($slug, $id) = static::getSlug($path);
		$dataType = DataType::where('slug', '=', $slug)->first();
		$class = app($dataType->model_name);
		$result = $class::find($id);

		$exist = Permission::where('key', 'own_' . $slug)->first();

		if ($exist) {
			$user = UserModal::find(Auth::id());
			if (! $user->hasPermission('own_' . $slug)) {
				throw new UnauthorizedHttpException(null);
			} else if ($slug == 'users') {
				if ($result->id != $user->id) {
					throw new UnauthorizedHttpException(null);
				}
			} else if (isset($result->user) && $result->user) {
				if ($user->id != $result->user->id) {
					throw new UnauthorizedHttpException(null);
				}
			}
		}


	}

	/**
	 * @return mixed
	 */
	public function getVersion()
	{
		return $this->version;
	}

	/**
	 * find Version
	 *
	 * @return mixed
	 */
	protected function findVersion()
	{
		if (! is_null($this->version)) {
			return;
		}

		if ($this->filesystem->exists(base_path('composer.lock'))) {
			// Get the composer.lock file
			$file = json_decode($this->filesystem->get(base_path('composer.lock')));

			// Loop through all the packages and get the version of voyager
			foreach ($file->packages as $package) {
				if ($package->name == 'tcg/voyager') {
					$this->version = $package->version;
					break;
				}
			}
		}
	}

	/**
	 * @param Alert $alert
	 */
	public function addAlert(Alert $alert)
	{
		$this->alerts[] = $alert;
	}

	/**
	 * @return array
	 */
	public function alerts()
	{
		if (! $this->allertsCollected) {
			event('voyager.alerts.collecting');

			$this->allertsCollected = true;
		}
		return $this->alerts;
	}
}
