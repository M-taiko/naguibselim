<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\transactions;
use Illuminate\Support\Facades\DB;


class supplierReport extends Controller
{
    public function index() {
        return view('supplierReport.supplierReport');
    
    }




public function SupplierPaymentreport(Request $request)
{
  

   


        $supplierId = $request->supplier;
        $start_at = $request->start_at;
        $end_at = $request->end_at;
        if($start_at == null)   {
            $start_at = '2000-01-01';
        }  

        if($end_at == null)   {
            $end_at = now();
        }  

        $result = DB::table(function ($query) use ($supplierId, $start_at, $end_at) {
            $subquery = DB::table('suppliers')
                ->select(
                    'suppliers.name',
                    DB::raw('(SELECT SUM(invoices.total_Buy_price) FROM invoices WHERE invoices.supplier_name = suppliers.id AND invoices.created_at < "' . $start_at . '") AS total_buy'),
                    DB::raw('(SELECT SUM(transactions.total) FROM transactions WHERE transactions.supplier_id = suppliers.id AND transactions.created_at < "' . $start_at . '") AS total_recive'),
                    DB::raw('"' . $start_at . '" AS created_at'),
                    DB::raw('NULL AS outlet_name'),
                    DB::raw('NULL AS discription'),
                    DB::raw('"رصيد سابق" AS type'),
                    'suppliers.id AS supplier_id'
                )
                ->where('suppliers.id', $supplierId)
                ->unionAll(
                    DB::table('invoices')
                        ->select(
                            'suppliers.name',
                            'invoices.total_Buy_price AS total_buy',
                            DB::raw('NULL AS total_recive'),
                            'invoices.created_at',
                            'invoices.outlet_name',
                            DB::raw('NULL AS discription'),
                            DB::raw('"شراء" AS type'),
                            'suppliers.id AS supplier_id'
                        )
                        ->join('suppliers', 'suppliers.id', '=', 'invoices.supplier_name')
                        ->whereBetween('invoices.created_at', [$start_at, $end_at])
                        ->where('invoices.supplier_name', $supplierId)
                )
                ->unionAll(
                    DB::table('transactions')
                        ->select(
                            'suppliers.name',
                            DB::raw('NULL AS total_buy'),
                            'transactions.total AS total_recive',
                            'transactions.created_at',
                            DB::raw('NULL'),
                            'transactions.description',
                            DB::raw('"دفع" AS type'),
                            'suppliers.id'
                        )
                        ->join('suppliers', 'suppliers.id', '=', 'transactions.supplier_id')
                        ->whereBetween('transactions.created_at', [$start_at, $end_at])
                        ->where('transactions.supplier_id', $supplierId)
                );
        
            $query->select(
                'name',
                'total_buy',
                'total_recive',
                DB::raw('SUM(IFNULL(total_buy, 0) - IFNULL(total_recive, 0)) over(ORDER BY created_at ROWS UNBOUNDED PRECEDING) AS Balance'),
                'created_at',
                'outlet_name',
                'discription',
                'type'      
            )
                ->fromSub($subquery, 'X')
                ->orderBy('X.created_at', 'ASC');
        })
        ->get();


        // Use $results as needed in your application.
        


  
    

 
    









    // return view('supplierReport.supplierReport', ['all_invoices' => $all_invoices ,'all_transaction' => $all_transaction ]);
    return view('supplierReport.supplierReport', ['result' => $result   ]);






}
    


}
