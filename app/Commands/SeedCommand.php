<?php

namespace App\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Intervention\Image\ImageServiceProviderLaravel5;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Process\Process;
use App\Traits\Seedable;
use App\VoyagerServiceProvider;

class SeedCommand extends Command
{
	use Seedable;

	protected $seedersPath = __DIR__ . '/../../publishable/database/seeds/';

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'voyager:seed';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Seed the Voyager DB';

	protected function getOptions()
	{
		return [
			['with-dummy', null, InputOption::VALUE_NONE, 'Install with dummy data', null],
		];
	}

	/**
	 * Get the composer command for the environment.
	 *
	 * @return string
	 */
	protected function findComposer()
	{
		if (file_exists(getcwd() . '/composer.phar')) {
			return '"' . PHP_BINARY . '" ' . getcwd() . '/composer.phar';
		}

		return 'composer';
	}

	/**
	 * Execute the console command.
	 *
	 * @param \Illuminate\Filesystem\Filesystem $filesystem
	 *
	 * @return void
	 */
	public function fire(Filesystem $filesystem)
	{

		$this->info('Dumping the autoloaded files and reloading all new files');

		$composer = $this->findComposer();

		$process = new Process($composer . ' dump-autoload');
		$process->setWorkingDirectory(base_path())->run();

		$this->info('Seeding data into the database');
		$this->seed('VoyagerDatabaseSeeder');

		if ($this->option('with-dummy')) {
			$this->seed('VoyagerDummyDatabaseSeeder');
		}

		$this->info('Adding the storage symlink to your public folder');
		$this->call('storage:link');

		$this->info('Successfully Seed Voyager DB!');
	}
}
