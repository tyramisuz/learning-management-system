<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Models\Participant;
use App\Models\Groupquiz;
use App\Models\Group;
use App\Models\User;
use App\Models\Response;
use App\Models\Notification;
use App\Models\Export;



class ReportExpirationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reports:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Report after 7 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $oldReports = Export::where('created_at', '<', Carbon::now()->subDays(7))->get();

        foreach ($oldReports as $report) {
                Storage::delete($report->file_path);
                // $report->delete();
                $report->update(['status'=>'expired']);

                $this->info("Report {$report->file_name} has been deleted.");
        }
    }
}
