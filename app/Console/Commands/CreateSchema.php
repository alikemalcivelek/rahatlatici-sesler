<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;
use File;

class CreateSchema extends Command {
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'schema:create {--clean}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Create database schema.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct() {
	  parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle() {
		if ( $this->option('clean') )
		DB::unprepared('DROP SCHEMA IF EXISTS `app`');

	  if ( DB::unprepared(File::get('.schema/app.sql')) ) {
			$this->info('Database schema created successfully.');
		} else {
			$this->error('Database schema create is failed.');
		}
	}
}
