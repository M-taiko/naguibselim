<?php

namespace App\Http\Controllers;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class outletProducts extends Controller
{
    public function index(){

        //make index to view report blade 
        return view('outletProductReport.outletProductReport');
    }



    public function outletProductReport(Request $request)
    {
        $from = $request->start_at;
        $to = $request->end_at;
        $outlet_name = $request->outlet;
        
        $query = Invoice::select(
            'invoices.outlet_name',
            'invoice_line.product_id',
            'invoice_line.product_name',
            DB::raw('SUM(invoice_line.quantity) as total_quantity'),
            DB::raw('SUM(invoice_line.total) as total_sales')
        )
            ->join('invoice_line', 'invoices.id', '=', 'invoice_line.invoice_id');
        
        if ($outlet_name) {
            $query->where('invoices.outlet_name', $outlet_name);
        }
        
        if ($from && $to) {
            $query->whereBetween('invoices.created_at', [$from, $to]);
        }
        
        // Add GROUP BY clause for all relevant columns
        $query->groupBy('invoices.outlet_name', 'invoice_line.product_id', 'invoice_line.product_name');
        
        $result = $query->orderBy('invoices.outlet_name')
            ->orderBy('invoice_line.product_id')
            ->get();
        
        return view('outletProductReport.outletProductReport', ['result' => $result]);
    }
}
