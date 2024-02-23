<?php

namespace App\Http\Controllers;

use App\Models\cases;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CasesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $data = outlets::select('*');
        // dd($data);
        return view('cases.cases');
    }



    public function getCasesTable(Request $request)
    {
        if ($request->ajax()) {


            $data = cases::select('*');
          

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="#exampleModal2" data-name="' . $row['name'] . '" data-address="' . $row['address'] . '"  data-id="' . $row['id'] . '" data-effect="effect-scale" data-toggle="modal" class="edit btn btn-success btn-sm">تعديل</a> 
                                    <a href="#modaldemo9"   data-name="' . $row['name'] . '" data-address="' . $row['address'] . '"  data-id="' . $row['id'] . '"  data-effect="effect-scale" data-toggle="modal" class="delete btn btn-danger btn-sm">حذف</a>';

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
        $b_exists = cases::where('name', '=', $input['name'])->exists();

        if ($b_exists) {

            session()->flash('Error', 'اسم الحالة  موجود بالفعل');
            return redirect('/cases');

        } else {

            cases::create([
                'name' => $request->name,
                'address' => $request->address,
                'age' => $request->age,
                'phone' => $request->phone,
                'maritalStatus' => $request->maritalStatus,
                'researcher' => $request->researcher,
                'BelongesTo' => $request->BelongesTo,
                'Neighborhood' => $request->Neighborhood,
                'governorate' => $request->governorate,
                'DescriptionOfTheHouse' => $request->DescriptionOfTheHouse,
                'DescriptionOfTheCase' => $request->DescriptionOfTheCase,
                'income' => $request->income,
                'NSamount' => $request->NSamount,
                'SearchHistory' => $request->SearchHistory,
                'receivedDate' => $request->receivedDate,
                'HelpHistory' => $request->HelpHistory,
                'situation' => $request->situation,
                'IsUrgent' => $request->IsUrgent,
                'notes' => $request->notes,
                'StatusType' => $request->StatusType


            ]);
            session()->flash('Add', 'تم تسجيل حالة جديده ');

            return redirect('/cases');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\cases  $cases
     * @return \Illuminate\Http\Response
     */
    public function show(cases $cases)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cases  $cases
     * @return \Illuminate\Http\Response
     */
    public function edit(cases $cases)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cases  $cases
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, cases $cases)
    {
        $id = $request->id;

        $this->validate($request, [

            'name' => 'required|max:255|unique:outlets,name,' . $id,
            'address' => 'required',

        ], [

            'name.required' => 'يرجي ادخال اسم المنفذ',
            'name.unique' => 'اسم المنفذ مسجل مسبقا',
            'address.required' => 'يرجي ادخال  العنوان',

        ]);

        $outlets = cases::find($id);
        $outlets->update([
            'name' => $request->name,
            'address' => $request->address,

        ]);

        session()->flash('edit', 'تم تعديل المنفذ بنجاج');
        return redirect('/outlets');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cases  $outlets
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        cases::find($id)->delete();
        session()->flash('delete', 'تم حذف المنفذ بنجاح');
        return redirect('/outlets');
    }
}
