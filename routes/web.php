<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**************************************oultels********************************************************************** */

Route::get('/cases', [\App\Http\Controllers\CasesController::class, 'index'])->name('cases.index');  //index all the data view...

Route::get('/cases/all', [\App\Http\Controllers\CasesController::class, 'getCasesTable'])->name('cases.getCasesTable');  //Get Users for Laravel Yajra Datatable Index Page record...

Route::resource('cases', \App\Http\Controllers\CasesController::class);

/**************************************oultels********************************************************************** */

/*************************************Products***************************************************************************** */


Route::get('/products/all', [\App\Http\Controllers\ProductsController::class, 'getproductTable'])->name('products.getproductTable');  //Get Users for Laravel Yajra Datatable Index Page record...

Route::resource('products',\App\Http\Controllers\ProductsController::class);
/*************************************Products***************************************************************************** */


/*************************************suppliers***************************************************************************** */

Route::get('/suppliers/all', [\App\Http\Controllers\SuppliersController::class, 'getsuppliersTable'])->name('suppliers.getsuppliersTable');  //Get Users for Laravel Yajra Datatable Index Page record...

Route::resource('suppliers',\App\Http\Controllers\SuppliersController::class);
/*************************************suppliers***************************************************************************** */

/*************************************treasury***************************************************************************** */


Route::get('/treasury/all', [\App\Http\Controllers\TreasuryController::class, 'gettreasuryTable'])->name('treasury.gettreasuryTable');  //Get Users for Laravel Yajra Datatable Index Page record...

Route::resource('treasury',\App\Http\Controllers\TreasuryController::class);
/*************************************treasury***************************************************************************** */


/*************************************invoices***************************************************************************** */

//datatable for all invoices
Route::get('/allinvoices', [\App\Http\Controllers\InvoiceController::class, 'getinvoicessTable'])->name('invoices.getinvoicesTable');  //Get Users for Laravel Yajra Datatable Index Page record...

//add new invoice
Route::get('/add-new-invoice', [\App\Http\Controllers\InvoiceController::class, 'add_new_invoice'])->name('invoices.add_new_invoice');

//get all prices from the selected product 
Route::get('/get-product-prices', [\App\Http\Controllers\InvoiceController::class , 'getProductPrices']);

Route::resource('invoices',\App\Http\Controllers\InvoiceController::class);

Route::get('/invoices/details/{id}', [\App\Http\Controllers\InvoiceController::class, 'getInvoiceDetails']);


Route::post('/invoices/{invoice}/edit', [\App\Http\Controllers\InvoiceController::class, 'edit'])->name('invoices.edit');


Route::delete('/invoices/{id}', [\App\Http\Controllers\InvoiceController::class, 'destroy'])->name('invoices.destroy');

Route::get('/editInvoice{id}', [\App\Http\Controllers\InvoiceController::class, 'showEditInvoice'])->name('invoices.showEditInvoice');

/*************************************invoices***************************************************************************** */


/*************************************transaction***************************************************************************** */


Route::get('/transaction/all', [\App\Http\Controllers\TransactionsController::class, 'gettransactionTable'])->name('transaction.gettransactionTable');  //Get Users for Laravel Yajra Datatable Index Page record...

Route::resource('transaction',\App\Http\Controllers\TransactionsController::class);


/*************************************transaction***************************************************************************** */







Route::resource('outlet-profit-Report',\App\Http\Controllers\outletReport::class);

Route::get('/outlet-profit-report', [\App\Http\Controllers\outletReport::class, 'outletReport']);



///out let product report 

Route::resource('outlet-product-Report',\App\Http\Controllers\outletProducts::class);
Route::get('/outlet-product-report', [\App\Http\Controllers\outletProducts::class, 'outletProductReport']);


///out let supplier report 

Route::resource('supplierReport',\App\Http\Controllers\supplierReport::class);
Route::get('/Supplier-Payment-report', [\App\Http\Controllers\supplierReport::class, 'SupplierPaymentreport']);




/*************************************payment represntetive***************************************************************************** */
Route::get('/pay', function () {

    return view('pay.pay');

})->middleware(['auth', 'verified'])->name('dashboard');



Route::post('transaction/payment', '\App\Http\Controllers\TransactionsController@payment')->name('transaction.payment');


Route::post('transaction/account_accept', '\App\Http\Controllers\TransactionsController@account_accept')->name('transaction.account_accept');


Route::post('transaction/acceptMonyFromAccountant', '\App\Http\Controllers\TransactionsController@acceptMonyFromAccountant')->name('transaction.acceptMonyFromAccountant');



Route::get('/recive', function () {
    return view('recive.recive');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::post('transaction/recive', '\App\Http\Controllers\TransactionsController@recive_request')->name('transaction.recive_request');


/*************************************payment represntetive***************************************************************************** */

/*************************************payment Accountent***************************************************************************** */




Route::get('/payFromTresury', function () {
    
    return view('payFromTresury.payFromTresury');
    
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/reciveTotreasury', function () {
    
    return view('reciveTotreasury.reciveTotreasury');
    
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/userTransactions', function () {
    
    return view('userTransactions.userTransactions');
    
})->middleware(['auth', 'verified'])->name('dashboard');




Route::get('/userTransactions/all', [\App\Http\Controllers\TransactionsController::class, 'getUsertransactionTable'])->name('userTransactions.getUsertransactionTable');  //Get Users for Laravel Yajra Datatable Index Page record...



Route::post('transaction/trsurypayment', '\App\Http\Controllers\TransactionsController@trsurypayment')->name('transaction.trsurypayment');


Route::post('transaction/reciveTotreasury', '\App\Http\Controllers\TransactionsController@reciveTotreasury')->name('transaction.reciveTotreasury');
















// Route::get('/index', function () {
//     return view('empty');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/index', [HomeController::class, 'index']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});




Route::group(['middleware' => ['auth']], function() {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    
});



Route::get('/{page}', 'AdminController@index');
require __DIR__.'/auth.php';
