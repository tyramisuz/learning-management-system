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
use App\Exports\QuizDetailsSheet;
use App\Exports\UserScoresSheet;

class ExportQuiz implements WithMultipleSheets
{
    protected $quizId;

    public function __construct($quizId, $exportId)
    {
        $this->quizId = $quizId;
        $this->exportId = $exportId;
    }

    public function sheets(): array
    {
        return [
            new QuizDetailsSheet($this->quizId),
        ];
    }
}




