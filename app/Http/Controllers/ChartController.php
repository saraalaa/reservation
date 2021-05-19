<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function index()
    {
        return DB::table('reservations')
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as reservation'))
            ->groupBy('date')
            ->get();
    }
}
