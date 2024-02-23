<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Invoice_line;

use App\Models\products;
use App\Models\suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class InvoiceController extends Controller
{

    public function index()
    {
       $invoices = Invoice::all();
    //    $data  = Invoice::with("supplier")->select('*')->get();
    //    dd( $data);
       return view('invoices.invoices', compact('invoices'));
    }
    public function  add_new_invoice(){
        return view('invoices.make_new_invoice');
    }

    public function getinvoicessTable(Request $request)
    {
        if ($request->ajax()) {
            
           
            $data = Invoice::with(['supplier:id,name'])
            ->select('*')
            ->orderBy('created_at', 'desc')
            ->get();
           
             return Datatables::of($data)
                 ->addIndexColumn()
                 ->addColumn('action', function($row){
                     $actionBtn = '<a href="#exampleModal2" data-name="'.$row['name'].'" data-address="'.$row['address'].'"  data-id="' . $row['id'] . '" data-effect="effect-scale" data-toggle="modal" class="edit btn btn-success btn-sm"><i class="far fa-2x fa-eye"></i> فتح الفاتوره  </a> 
                                    <a href="#modaldemo9"   data-name="'.$row['name'].'" data-address="'.$row['address'].'"  data-id="' . $row['id'] . '"  data-effect="effect-scale" data-toggle="modal" class="delete btn btn-danger btn-sm"><i class="fa fa-2x fa-trash"></i> حذف </a>';
                                    
                     return $actionBtn;
                 })
                 ->rawColumns(['action'])
                 ->make(true);
                }

        }





            // تعديل علي الفاتوره 
            public function showEditInvoice(Request $request , $id){
                $invoice = Invoice::find($id);
                $theID = $id;
               
                
                $data=  DB::table('invoice_line')
                ->join('products', 'invoice_line.product_id', '=', 'products.id')
                ->select(
                    'invoice_line.*',
                    'products.name as product_name' // Adjust the field name accordingly
                )
                ->where('invoice_line.invoice_id', $id)
                ->get();

           
                return view('invoices.editInvoic', compact('data' ,'invoice','theID'));
                
               }


    //ajax code for get the price for every product to put in the table 
    public function getProductPrices(Request $request)
    {
        $productId = $request->input('productId');
        $product = products::find($productId);

        if ($product) {
            return response()->json([
                'buy_price' => $product->buy_price,
                'sell_price' => $product->sell_price,
            ]);
        }

        return response()->json(['error' => 'Product not found'], 404);
    }



    public function store(Request $request)
    {
        $data = $request->all();
          // Create a new invoice
       
          $invoice = new Invoice();
          $invoice->username = $request->input('username');
          $invoice->supplier_name = $request->input('supplier_name');
          $invoice->outlet_name = $request->input('outlet_name');
          $invoice->ordertype = $request->input('ordertype');
          $invoice->total_amount = $request->input('total_amount');
          $invoice->total_Buy_price = $request->input('total_Buy_price');
          $invoice->profit = $request->input('profit');
          $invoice->save();
          

    
         // Attach products to the invoice
         $products = [];
         $productCount = count($request->input('product_id'));
         $invoice_id = Invoice::latest()->first()->id;
         for ($i = 0; $i < $productCount; $i++) {
             
             $products[] = [
                 'invoice_id' => $invoice_id,
                 'product_id' => $request->input('product_id')[$i],
                 'product_name' => $request->input('product_name')[$i],
                 'buy_price' => $request->input('buy_prices')[$i],
                 'sell_price' => $request->input('sell_prices')[$i],
                 'quantity' => $request->input('quantities')[$i],
                 'profit_per_product' => $request->input('profit_per_product')[$i],
                 'total' => $request->input('totals')[$i],
             ];
         }


         $invoice->invoiceLines()->createMany($products);
    
         // Add the total buy_price to the supplier's blance



            $supplierName = $request->input('supplier_name');
        

            
            $totalBuyPrice = $request->input('total_Buy_price');
            
         
      
            $supplier = suppliers  ::where('id' , $supplierName)->get();
            $supplier = $supplier->first(); // Get the first item from the collection
            
     
         if ($supplier) {
             $supplier->add($totalBuyPrice);
         } else {
            dd();
         }
                 
         session()->flash('Add' , 'تم تسجيل فاتوره جديده');
         return redirect('/invoices');
    }





//عرض تفاصيل الفاتوره في موديل الفواتير


    public function getInvoiceDetails($id)
    {

        try {
            // Fetch details for the given invoice ID
            $invoiceLines = invoice_line::with('invoice')
                ->where('invoice_id', '=', $id)
                ->get();
    
            return response()->json(['details' => $invoiceLines]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }


    public function edit(Request $request ,$id)
    {
  
            // Validate the request data
            $request->validate([
                'created_at' => 'required|date',
                // Add other validation rules for your form fields
            ]);
    
            // Update the invoice
            $invoice = Invoice::find($id);
            $invoice->created_at = $request->input('created_at');
            // Update other fields as needed
            $invoice->save();
          
            // Update or create invoice lines
            $invoiceLines = $request->input('invoice_lines', []);

        if ($request->input('product_id')){
                    $invoiceLinesData = [];
                foreach ($request->input('product_id') as $key => $productId) {
                    $invoiceLinesData[] = [
                        'id' => $productId,
                        'product_id' => $productId,
                        'product_name' => $request->input('product_name.' . $key),
                        'buy_price' => $request->input('buy_prices.' . $key),
                        'sell_price' => $request->input('sell_prices.' . $key),
                        'quantity' => $request->input('quantities.' . $key),
                        'total' => $request->input('totals.' . $key),
                        'profit_per_product' => $request->input('profit_per_product.' . $key),
                    ];
                }
                        
                            $invoice->invoiceLines()->createMany($invoiceLinesData);
                // You may also want to associate the invoice line with the invoice
                            
    }
    
            session()->flash('Add' , 'تم تعديل الفاتوره ');
            return redirect('/invoices');
            
        }
    







  

    public function destroy(Request $request)
    {
        $id = $request->id;
        Invoice::find($id)->delete();
        session()->flash('delete','تم حذف الفاتوره بنجاح');
        return redirect('/invoices');
    }

}







