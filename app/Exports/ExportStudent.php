<?php

namespace App\Exports;

use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Models\Quiz;
use App\Models\User;
use App\Models\Response;
use DB;
use Illuminate\Support\Facades\Log;
use App\Exports\StudentDetailsSheet;

class ExportStudent implements WithMultipleSheets
{
    protected $userId;
    protected $quizId;
    protected $attempt;
    protected $exportId;

    public function __construct($userId, $quizId, $attempt, $exportId)
    {
        $this->userId = $userId;
        $this->quizId = $quizId;
        $this->attempt = $attempt;
        $this->exportId = $exportId;
    }

    public function sheets(): array
    {
        return [
            new StudentDetailsSheet($this->userId, $this->quizId, $this->attempt),
        ];
    }
}




