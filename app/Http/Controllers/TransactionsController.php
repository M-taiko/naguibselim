<?php

namespace App\Http\Controllers;

use App\Models\transactions;
use App\Models\treasury;
use App\Models\suppliers;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data = Transactions::with([ 'from_User' , 'to_User' , 'treasury', 'cases'])->select('*');
        // // dd(    $data);
        // $datatable = Datatables::of($data );
        // dd(    $datatable);
        return view('transaction.transaction');
    }

    public function gettransactionTable(Request $request)
    {
        if ($request->ajax()) {
            
           
            // $data = Transactions::with([ 'treasury', 'cases'])->select('*');
            $data = Transactions::with(['to_user', 'from_user', 'treasury', 'cases'])
            ->orderBy('created_at', 'DESC')
            ->select('*');

             return Datatables::of($data)
                 ->addIndexColumn()
                 ->addColumn('action', function($row){
                     $actionBtn = '<a href="#exampleModal2" data-name="'.$row['name'].'" data-address="'.$row['address'].'"  data-id="' . $row['id'] . '" data-effect="effect-scale" data-toggle="modal" class="edit btn btn-success btn-sm">تعديل</a> 
                                    <a href="#modaldemo9"   data-name="'.$row['name'].'" data-address="'.$row['address'].'"  data-id="' . $row['id'] . '"  data-effect="effect-scale" data-toggle="modal" class="delete btn btn-danger btn-sm">حذف</a>';
                                    
                     return $actionBtn;
                 })
                 ->rawColumns(['action'])
                 ->make(true);
                }

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

    
    
    
    /***************************************حركات المندوب********************************************* */
    public function getUsertransactionTable(Request $request)
    {
        if ($request->ajax()) {
            
           
            // $data = Transactions::with([ 'treasury', 'cases'])->select('*');
            $data = Transactions::with(['to_user', 'from_user', 'treasury', 'cases'])
            ->where(function ($query) {
                $query->where('fromUser_id', auth()->user()->id)
                      ->orWhere('toUser_id', auth()->user()->id);
            })
            ->orderBy('created_at', 'DESC')
            ->select('*')
            ->get();
        

             return Datatables::of($data)
                 ->addIndexColumn()
                 ->addColumn('action', function($row){
                     $actionBtn = '<a href="#exampleModal2" data-name="'.$row['name'].'" data-address="'.$row['address'].'"  data-id="' . $row['id'] . '" data-effect="effect-scale" data-toggle="modal" class="edit btn btn-success btn-sm">تعديل</a> 
                                    <a href="#modaldemo9"   data-name="'.$row['name'].'" data-address="'.$row['address'].'"  data-id="' . $row['id'] . '"  data-effect="effect-scale" data-toggle="modal" class="delete btn btn-danger btn-sm">حذف</a>';
                                    
                     return $actionBtn;
                 })
                 ->rawColumns(['action'])
                 ->make(true);
                }

            }





    public function payment(Request $request){
        
        
     $user_id = auth()->user()->id;

  

     
     $data = [

            'fromUser_id' => $user_id,
            'amount' => $request->input('amount'),
            'transaction_type' => $request->input('transaction_type'),
            'cases' =>  $request->input('cases') ,
            'description' => $request->input('description'),
        ];
        
        
        
        
     
        $transaction = transactions::create($data);
        
        $amountToSubtract = $transaction->amount;
        $userToTakMony = User::find($transaction->fromUser_id);
        
        
        $userToTakMony->subtract('balance', $amountToSubtract);

        $transaction->status ="completed";
        
        $transaction->save();

        session()->flash('Add' , 'تم تسجيل اذن دفع   جديد');
        return redirect('/userTransactions');
    }

    


    public function recive_request(Request $request)
    {
 
        $user_id = auth()->user()->id;
      
        $data = [

           
            'treasury' => $request->input('treasury'),
            'toUser_id' => $user_id,
            'amount' => $request->input('amount'),
            'transaction_type' => $request->input('transaction_type'),
            'description' => $request->input('description'),
        ];
    
        // $treasuryId = $request->input('treasury_id');
        // $amountToSubtract = $request->input('total');
    
        // treasury::find($treasuryId)->increment('balance', $amountToSubtract);


     
        $transaction = transactions::create($data);
        $transaction->save();

        session()->flash('Add' , 'تم تسجيل طلب  جديد');
        return redirect('/userTransactions');
   
    }

    public function account_accept(Request $request){
        $transaction_id = $request->input('id');
        $transaction = transactions::where('id','=',$transaction_id)->firstOrFail();
        $treasury = treasury::find($transaction->treasury);
        $amountToSubtract = $transaction->amount;
                
           $treasury->decrement('balance', $amountToSubtract);
           $transaction->status ="prepending";
           $transaction->save();
           session()->flash('Add' , 'تم الموافقه من قبل المحاسب ');
           return redirect('/userTransactions');
           

 
    }
    
    public function acceptMonyFromAccountant(Request $request){
        
        $transaction_id = $request->input('id');
        $transaction = transactions::where('id','=',$transaction_id)->firstOrFail();
  
        $userToTakMony = User::find($transaction->toUser_id);
        $amountToSubtract = $transaction->amount;
        $userToTakMony->increment('balance', $amountToSubtract);

        $transaction->status ="completed";
        $transaction->save();
        session()->flash('Add' , 'تم استلام المبلغ من قبل المندوب ');
        return redirect('/userTransactions');
        
        

    }
    
    /***************************************حركات المندوب********************************************* */
    
    
    
    
    /***************************************حركات المحاسب********************************************* */

    public function trsurypayment(Request $request){
        
        // dd($request->all());

        $userToPay = $request->input("toUser_id");
        $treasury  = $request->input('treasuries');
        $cases     = $request->input('cases');
        $Thetreasury = treasury::find($treasury);

  


        if($userToPay) {
         
            $data = [
                'treasury' => $request->input('treasuries'),
                'toUser_id' => $userToPay,
                'amount' => $request->input('amount'),
                'transaction_type' => $request->input('transaction_type'),
                'description' => $request->input('description'),
            ];

            $transaction = transactions::create($data);
            $transaction->save();

            $amountToSubtract = $transaction->amount;
            $Thetreasury = treasury::find($request->input('treasuries'));
            $Thetreasury->decrement('balance', $amountToSubtract);
            $transaction->status ="prepending";
            $transaction->save();
            session()->flash('Add' , 'تم تسليم المبلغ  المكتوب ');
            return redirect('/transaction');
            
            
        }elseif( $cases  ){
       
            $data = [
                'treasury' => $request->input('treasuries'),
                'cases' => $request->input('cases'),
                'amount' => $request->input('amount'),
                'transaction_type' => $request->input('transaction_type'),
                'description' => $request->input('description'),
            ];
            $transaction = transactions::create($data);
            $transaction->save();

            $amountToSubtract = $transaction->amount;
            $Thetreasury = treasury::find($request->input('treasuries'));
            $Thetreasury->decrement('balance', $amountToSubtract);
            $transaction->status ="completed";
            $transaction->save();
            session()->flash('Add' , 'تم تسليم المبلغ  المكتوب ');
            return redirect('/transaction');

        }



        


    }
    
    public function reciveTotreasury(Request $request){

        $data = [
            'treasury' => $request->input('treasuries'),
            'amount' => $request->input('amount'),
            'transaction_type' => $request->input('transaction_type'),
            'description' => $request->input('description'),
        ];
        $transaction = transactions::create($data);
        $transaction->save();

        $amountToIncease = $transaction->amount;
        $Thetreasury = treasury::find($request->input('treasuries'));
        $Thetreasury->increment('balance', $amountToIncease);
        $transaction->status ="completed";
        $transaction->save();
        session()->flash('Add' , 'تم تسليم المبلغ  المكتوب ');
        return redirect('/transaction');
    }

    




    







    /**
     * Display the specified resource.
     *
     * @param  \App\Models\transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function show(transactions $transactions)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function edit(transactions $transactions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transactions $transactions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\transactions  $transactions
     * @return \Illuminate\Http\Response
     */
    public function destroy ( Request $request,transactions $transactions)
    {
        $id = $request->id;
        $transactionsToDelete = transactions::find($id);
        $transactionsToDelete->delete();
        return redirect()->route('transaction.index')->with('delete', 'تم حذف الفاتوره بنجاح');

        

    }
}
