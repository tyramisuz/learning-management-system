<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Groupquiz;
use Carbon\Carbon;

class CheckDueDates extends Command
{
    // Command signature and description
    protected $signature = 'check:duedates';
    protected $description = 'Check for due dates and update status';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = Carbon::now();

        $quizzes = Groupquiz::where('dueDate', '<=', $now)
                            ->where('status', 'active')
                            ->get();

        foreach ($quizzes as $quiz) {
            $quiz->update(['status' => 'completed']);
            // Perform any other actions like sending notifications
        }

        return 0;
    }
}
