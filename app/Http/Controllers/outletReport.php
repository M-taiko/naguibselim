<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;

class outletReport extends Controller
{
    public function index(){

        //make index to view report blade 
        return view('outletProfitReport.outletProfitReport');
    }



    public function outletReport(Request $request)
    {
        $from = $request->start_at;
        $to = $request->end_at;
        $outlet_name = $request->outlet;
    
        $query = Invoice::select('outlet_name')
            ->selectRaw('SUM(total_amount) as total_sales')
            ->selectRaw('SUM(total_Buy_price) as total_buy')
            ->selectRaw('(SUM(total_amount) - SUM(total_Buy_price)) as profit');
    
        if ($outlet_name) {
            $query->where('outlet_name', $outlet_name);
        }
    
        if ($from && $to) {
            $query->whereBetween('created_at', [$from, $to]);
        }
    
        $result = $query->groupBy('outlet_name')->get();

        return view('outletProfitReport.outletProfitReport', ['result' => $result]);
    }
    
    
}
