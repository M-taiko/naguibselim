<?php

namespace App\Http\Controllers;

use App\Models\cr;
use App\Models\suppliers;
use App\Models\treasury;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $supplierStats = DB::table('suppliers')
        // ->select(
        //     'suppliers.id',
        //     'suppliers.name',
        //     'suppliers.code',
        //     DB::raw('COUNT(invoices.id) as invoices_count'),
        //     DB::raw('SUM(invoices.total_Buy_price) as total_balance')
        // )
        // ->leftJoin('invoices', 'suppliers.id', '=', 'invoices.supplier_name')
        // ->groupBy('suppliers.id', 'suppliers.name', 'suppliers.code')
        // ->get();


        // $supplierTransactionsStats = DB::table('transactions')
        // ->select(
        //     'suppliers.id as supplier_id',
        //     'suppliers.name as supplier_name',
        //     'suppliers.code as supplier_code',
        //     DB::raw('COUNT(transactions.id) as transactions_count'),
        //     DB::raw('SUM(transactions.total) as total_balance')
        // )
        // ->leftJoin('suppliers', 'transactions.supplier_id', '=', 'suppliers.id')
        // ->whereNotNull('transactions.supplier_id') // Exclude rows where supplier_id is null
        // ->groupBy('suppliers.id', 'suppliers.name', 'suppliers.code')
        // ->get();
    

        // $outletTransactionsStats = DB::table('transactions')
        // ->select(
        //     'outlets.id as outlet_id',
        //     'outlets.name as outlet_name',
        //     DB::raw('COUNT(transactions.id) as transactions_count'),
        //     DB::raw('SUM(transactions.total) as total_balance')
        // )
        // ->leftJoin('outlets', 'transactions.outlet_id', '=', 'outlets.id')
        // ->whereNotNull('transactions.outlet_id') // Exclude rows where supplier_id is null
        // ->groupBy('outlets.id', 'outlets.name')
        // ->get();





    //     $supplierDifferenceStats = DB::table(DB::raw('(
    //     SELECT
    //         invoices.supplier_name AS supplier_id,
    //         SUM(invoices.total_buy_price) AS total
    //     FROM invoices
    //     GROUP BY invoices.supplier_name
    
    //     UNION ALL
    
    //     SELECT
    //         transactions.supplier_id AS supplier_id,
    //         -SUM(transactions.total) AS total
    //     FROM transactions
    //     GROUP BY transactions.supplier_id
    // ) AS source'))
    //     ->join('suppliers', 'suppliers.id', '=', 'source.supplier_id')
    //     ->select('suppliers.name', DB::raw('SUM(source.total) as total'))
    //     ->groupBy('suppliers.name')
    //     ->get();

 





        



       
    




        // return view('index.index' , compact('supplierStats'  , 'supplierTransactionsStats' ,'outletTransactionsStats', 'supplierDifferenceStats'  ));
        return view('index.index' );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function show(cr $cr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function edit(cr $cr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cr $cr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cr  $cr
     * @return \Illuminate\Http\Response
     */
    public function destroy(cr $cr)
    {
        //
    }
}
