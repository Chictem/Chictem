<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Facades\Voyager;


class VoyagerMediaController extends Controller
{
	/**
	 * @var string
	 */
	private $filesystem;

	/**
	 * @var string
	 */
	private $directory = '';

	/**
	 * VoyagerMediaController constructor.
	 */
	public function __construct()
	{
		$this->filesystem = config('filesystems.default');

		if ($this->filesystem === 'local') {
			$this->directory = 'public';
		} elseif ($this->filesystem === 's3') {
			$this->directory = '';
		}
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index()
	{
		Voyager::can('browse_media');

		return view('voyager::media.index');
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function files(Request $request)
	{
		$folder = $request->folder;

		if ($folder == '/') {
			$folder = '';
		}

		$dir = $this->directory . $folder;

		return response()->json([
			'name' => 'files',
			'type' => 'folder',
			'path' => $dir,
			'folder' => $folder,
			'items' => $this->getFiles($dir),
			'last_modified' => 'asdf',
		]);
	}

	/**
	 * @param $dir
	 * @return array
	 */
	private function getFiles($dir)
	{
		$files = [];
		$storageFiles = Storage::files($dir);
		$storageFolders = Storage::directories($dir);

		foreach ($storageFiles as $file) {
			$files[] = [
				'name' => strpos($file, '/') > 1 ? str_replace('/', '', strrchr($file, '/')) : $file,
				'type' => Storage::mimeType($file),
				'path' => Storage::disk(config('filesystem.default'))->url($file),
				'size' => Storage::size($file),
				'last_modified' => Storage::lastModified($file),
			];
		}

		foreach ($storageFolders as $folder) {
			$files[] = [
				'name' => strpos($folder, '/') > 1 ? str_replace('/', '', strrchr($folder, '/')) : $folder,
				'type' => 'folder',
				'path' => Storage::disk(config('filesystem.default'))->url($folder),
				'items' => '',
				'last_modified' => '',
			];
		}

		return $files;
	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public function new_folder(Request $request)
	{
		$new_folder = $request->new_folder;
		$success = false;
		$error = '';

		if (Storage::exists($new_folder)) {
			$error = trans('admin.media.message.exist');
		} elseif (Storage::makeDirectory($new_folder)) {
			$success = true;
		} else {
			$error = trans('admin.media.message.permission');
		}

		return compact('success', 'error');
	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public function delete_file_folder(Request $request)
	{
		$folderLocation = $request->folder_location;
		$fileFolder = $request->file_folder;
		$type = $request->type;
		$success = true;
		$error = '';

		if (is_array($folderLocation)) {
			$folderLocation = rtrim(implode('/', $folderLocation), '/');
		}

		$location = "{$this->directory}/{$folderLocation}";
		$fileFolder = "{$location}/{$fileFolder}";

		if ($type == 'folder') {
			if (! Storage::deleteDirectory($fileFolder)) {
				$error = trans('admin.media.message.permission');
				$success = false;
			}
		} elseif (! Storage::delete($fileFolder)) {
			$error = trans('admin.media.message.permission');
			$success = false;
		}

		return compact('success', 'error');
	}

	// GET ALL DIRECTORIES Working with Laravel 5.3

	public function get_all_dirs(Request $request)
	{
		$folderLocation = $request->folder_location;

		if (is_array($folderLocation)) {
			$folderLocation = rtrim(implode('/', $folderLocation), '/');
		}

		$location = "{$this->directory}/{$folderLocation}";

		return response()->json(str_replace($location, '', Storage::directories($location)));
	}


	/**
	 * @param Request $request
	 * @return array
	 */
	public function move_file(Request $request)
	{
		$source = $request->source;
		$destination = $request->destination;
		$folderLocation = $request->folder_location;
		$success = false;
		$error = '';

		if (is_array($folderLocation)) {
			$folderLocation = rtrim(implode('/', $folderLocation), '/');
		}

		$location = "{$this->directory}/{$folderLocation}";
		$source = "{$location}/{$source}";
		$destination = strpos($destination, '/../') !== false ? $this->directory . '/' . dirname($folderLocation) . '/' . str_replace('/../', '', $destination) : "{$location}/{$destination}";

		if (! file_exists($destination)) {
			if (Storage::move($source, $destination)) {
				$success = true;
			} else {
				$error = trans('admin.media.message.permission');
			}
		} else {
			$error = trans('admin.media.message.exist');
		}

		return compact('success', 'error');
	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public function rename_file(Request $request)
	{
		$folderLocation = $request->folder_location;
		$filename = $request->filename;
		$newFilename = $request->new_filename;
		$success = false;
		$error = false;

		if (is_array($folderLocation)) {
			$folderLocation = rtrim(implode('/', $folderLocation), '/');
		}

		$location = "{$this->directory}/{$folderLocation}";

		if (! Storage::exists("{$location}/{$newFilename}")) {
			if (Storage::move("{$location}/{$filename}", "{$location}/{$newFilename}")) {
				$success = true;
			} else {
				$error = trans('admin.media.message.permission');
			}
		} else {
			$error = trans('admin.media.message.exist');
		}

		return compact('success', 'error');
	}

	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function upload(Request $request)
	{
		try {
			$path = $request->file->store($request->upload_path);
			$success = true;
			$message = trans('flash.upload', ['name' => '文件']);
		} catch (Exception $e) {
			$success = false;
			$message = $e->getMessage();
		}

		$path = preg_replace('/^public\//', '', $path);

		return response()->json(compact('success', 'message', 'path'));
	}
}
