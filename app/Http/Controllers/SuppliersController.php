<?php

namespace App\Http\Controllers;

use App\Models\suppliers;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SuppliersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = suppliers::all();
        return view('suppliers.suppliers', compact('suppliers'));
    }



    public function getsuppliersTable(Request $request)
    {
        if ($request->ajax()) {
            
           
            $data  = suppliers::select('*');
            
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

       
        $b_exists = suppliers::where('name', '=' ,$input['name'])->exists();
        if( $b_exists ) {

          session()->flash('Error' , 'اسم المورد موجود بالفعل');
          return redirect('/suppliers');
        }else{
            suppliers::create([
              'name' => $request-> name,
              'code' => $request-> code,
              'phone' => $request-> phone,
  
          ]);
          session()->flash('Add' , 'تم تسجيل مورد جديد');
          return redirect('/suppliers');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function show(suppliers $suppliers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function edit(suppliers $suppliers)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, suppliers $suppliers)
    {
        $id = $request->id;
        $input = $request->all();
    

 
        $suppliers = suppliers::find($id);

        if($input['code']){
            $suppliers->update([
                'name' => $request->name,
                'code' => $request->code,
                'phone' => $request->phone,
            ]);
        }else{
            $suppliers->update([
                'name' => $request->name,
                'phone' => $request->phone,
            ]);
        
        }
       
    

        session()->flash('edit','تم تعديل المورد بنجاج');
        return redirect('/suppliers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\suppliers  $suppliers
     * @return \Illuminate\Http\Response
     */
    public function destroy(suppliers $suppliers)
    {
        //
    }
}
