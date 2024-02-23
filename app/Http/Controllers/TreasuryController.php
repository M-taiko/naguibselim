<?php

namespace App\Http\Controllers;

use App\Models\treasury;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TreasuryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $treasury = treasury::all();
        return view('treasury.treasury', compact('treasury'));
    }

    public function gettreasuryTable(Request $request)
    {
        if ($request->ajax()) {
            
           
            $data  = treasury::select('*');
            
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
    
        $input = $request->all();

       
        $b_exists = treasury::where('name', '=' ,$input['name'])->exists();
        if( $b_exists ) {

          session()->flash('Error' , 'اسم الخزينة موجود بالفعل');
          return redirect('/products');
        }else{
            treasury::create([
              'name' => $request-> name,
           
  
          ]);
          session()->flash('Add' , 'تم تسجيل خزينة جديده');
          return redirect('/treasury');
        }
     
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\treasury  $treasury
     * @return \Illuminate\Http\Response
     */
    public function show(treasury $treasury)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\treasury  $treasury
     * @return \Illuminate\Http\Response
     */
    public function edit(treasury $treasury)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\treasury  $treasury
     * @return \Illuminate\Http\Response
     */
  
     public function update(Request $request)
     {
         $id = $request->id;
         $input = $request->all();
     
 
  
         $treasury = treasury::find($id);
 
        
      
            $treasury->update([
                 'name' => $request->name,
               
             ]);
         
        
        
     
 
         session()->flash('edit','تم تعديل الصنف بنجاج');
         return redirect('/treasury');
     }
 

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\treasury  $treasury
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        treasury::find($id)->delete();
        session()->flash('delete','تم حذف الخزينة بنجاح');
        return redirect('/treasury');
    }
}
