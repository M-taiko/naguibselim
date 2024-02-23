<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
/*    function __construct()
    {
         $this->middleware('permission:التحكم', ['only' => ['index']]);
         $this->middleware('permission:التحكم', ['only' => ['create','store']]);
         $this->middleware('permission:التحكم', ['only' => ['edit','update']]);
         $this->middleware('permission:التحكم', ['only' => ['destroy']]);
    }*/
    public function index()
    {
       $products = products::all();
       return view('products.products', compact('products'));
    }



    public function getproductTable(Request $request)
    {
        if ($request->ajax()) {
            
           
            $data  = Products::select('*');
            
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

       
        $b_exists = products::where('name', '=' ,$input['name'])->exists();
        if( $b_exists ) {

          session()->flash('Error' , 'اسم الصنف موجود بالفعل');
          return redirect('/products');
        }else{
            products::create([
              'name' => $request-> name,
              'code' => $request-> code,
              'buy_price' => $request-> buy_price,
              'sell_price' => $request-> sell_price,
              'description' => $request-> description,
  
          ]);
          session()->flash('Add' , 'تم تسجيل صنف جديد');
          return redirect('/products');
        }
     
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $id = $request->id;
        $input = $request->all();
    

 
        $Whearhouse = products::find($id);

        if($input['code']){
            $Whearhouse->update([
                'name' => $request->name,
                'code' => $request->code,
                'description' => $request->description,
            ]);
        }else{
            $Whearhouse->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        
        }
       
    

        session()->flash('edit','تم تعديل الصنف بنجاج');
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        products::find($id)->delete();
        session()->flash('delete','تم حذف الصنف بنجاح');
        return redirect('/products');
    }
}
