<?php

namespace App\Jobs;

use App\Models\Export;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportStudent;

class ExportStudentReport implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    
    public $userId;
    public $quizId;
    public $attempt;
    public $exportId;

    public function __construct($userId, $quizId, $attempt, $exportId)
    {
        $this->userId = $userId;
        $this->quizId = $quizId;
        $this->attempt = $attempt;
        $this->exportId = $exportId;
    }

    public function handle()
    {
        $export = Export::find($this->exportId);
        try {
            $filePath = $export->file_path;
            Excel::store(new ExportStudent($this->userId, $this->quizId, $this->attempt, $export->id), $filePath, 'public');
            $export->update(['status' => 'success']);
        } catch (\Exception $e) {
            $export->update([
                'status' => 'failed',
                'response' => $e->getMessage(),
                'failed_at' => now(),
            ]);
        }
    }
}
