<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    //Vamos a visualizar los meses y el numero de citas realizadas de cada mes
    public function appointments(){
        
        $monthCounts = Appointment::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(1) as count'))
                ->groupBy('month')
                ->get()
                ->toArray();
        $counts = array_fill(0, 12, 0);
        foreach ($monthCounts as $monthCount){
            $index = $monthCount['month']-1;
            $counts[$index] = $monthCount['count'];
        }
        
        return view('charts.appointments', compact('counts'));
    }


    public function doctors(){
        return view('charts.doctors');
    }

    public function doctorsJson(){
        $doctors = User::doctors()
            ->select('name')
            ->withCount(['attendedAppointments','cancellAppointments'])
            ->orderBy('attended_appointments_count', 'desc')
            ->take(5)
            ->get();
            
        $data = [];
        $data['categories'] = $doctors->pluck('name');

        $series = [];
        $series1['name'] = 'Citas atendidas';
        $series1['data'] = $doctors->pluck('attended_appointments_count');
        $series2['name'] = 'Citas canceladas';
        $series2['data'] = $doctors->pluck('cancell_appointments_count');

        $series[] = $series1;
        $series[] = $series2;
        $data['series'] = $series;

        return $data;

    }
}
