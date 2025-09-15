<?php namespace App\Interfaces;

use Illuminate\Support\Carbon;

interface HorarioServiceInterface {
    public function isAvaibleInterval($date, $doctorId, Carbon $start );
    public function getAvaiableIntervals($date, $doctorId );
}

