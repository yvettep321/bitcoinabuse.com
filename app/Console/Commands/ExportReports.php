<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use DB;
use App\Reports;
use File;

class ExportReports extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'bitcoinabuse:export-reports {--since=1d : "forever", "1d", or "30d"} {--full-dump : If present, we dump all fields, otherwise we only dump public fields.}';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Export the reports.';

	protected $select_limited;
	protected $select_all;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		$this->select_limited = "id,address,abuse_type_id,abuse_type_other,abuser,description,from_country,from_country_code,created_at";
		$this->select_all = "id,address,abuse_type_id,abuse_type_other,abuser,description,user_id,from_ip,from_country,from_country_code,created_at";
	}

	public function handle()
	{
		$this->info('Creating backup');
		$this->info(Carbon::now());

		// Determine file and temp file
		$file = 'records_' .$this->option('since');
		if ($this->option('full-dump'))	$file .= '_full';
		$temp_file = "{$file}_temp";
		$file = storage_path("backups/{$file}.csv");
		$temp_file = storage_path("backups/{$temp_file}.csv");

		// Delete old temp file if present & create a new one
		if (file_exists($temp_file)) unlink($temp_file);
		if (file_exists($file)) unlink($file);
		if(!file_exists(dirname($temp_file)))
		    mkdir(dirname($temp_file), 0777, true);
		touch($temp_file);

		// Determine time range
		if ($this->option('since') == "forever")
			$where = "1=1";
		else if ($this->option('since') == "30d")
			$where = "created_at > '" . Carbon::now()->subDays(30)->format('Y-m-d') . "'";
		else
			$where = "created_at > '" . Carbon::now()->subDays(1)->format('Y-m-d') . "'";

		// Determine select
		$select = $this->option('full-dump') ? $this->select_all : $this->select_limited;

		// First thing, put the header
		$fp = fopen($temp_file, 'a');
		fwrite($fp, $select . "\n");
		fclose($fp);

		// Page through results:
		$max = 100;
		$total = DB::select("SELECT COUNT(*) count FROM reports WHERE {$where}")[0]->count;
		$pages = ceil($total / $max);
		for ($i = 1; $i < ($pages + 1); $i++) {
			$offset = (($i - 1)  * $max);
			$start = ($offset == 0 ? 0 : ($offset + 1));
			$reports = Reports::select(DB::raw($select))->whereRaw($where)->skip($start)->take($max)->get();

			$fp = fopen($temp_file, 'a');
			foreach ($reports->toArray() as $report)
			{
				fputcsv($fp, $report);
			}
			fclose($fp);
		}

		File::move($temp_file, $file);

		$this->info('Done. ');
		$this->info("File: {$file}");
		$this->info(Carbon::now());
	}
}
