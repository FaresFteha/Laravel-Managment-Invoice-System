<?php

use App\Models\City;
use App\Models\State;
use App\Models\Client;
use App\Models\Country;
use App\Models\Product;
use App\Models\category;
use App\Models\Currency;
use App\Models\Invoice;
use App\Models\Invoice_attachment;
use App\Models\Tax;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

//General Fuctions
function getLogInUser()
{
    return Auth::user();
}

function getDashboardURL()
{
    return RouteServiceProvider::HOME;
}


function getStates($countryId)
{
    return State::where('country_id', $countryId)->get();
}

function getCities($stateId)
{
    return City::where('state_id',  $stateId)->get();
}

function successAlert()
{
    return  toastr()->success('تمت الاضافة,العملية ناجحة.');
}

function updateAlert()
{
    return  toastr()->success('تم التحديث,العملية ناجحة.');
}

function deleteAlert()
{
    return  toastr()->success('تم الحذف,العملية ناجحة.');
}
//Random Text
function randomText()
{
    return Str::random(7);
}

//Random Integer
function randomDigit()
{
    return random_int(0000000, 9999999);
}


//Client Fuctions
function getClient($id)
{
    return Client::findOrFail($id);
}

function getCountry()
{
    return Country::get();
}

//Category Fuctions
function validateCategory(Request $request)
{
    $validated = $request->validate([
        'name' => ['required', Rule::unique('categories')->ignore($request->id)],
    ]);
    return  $validated;
}

//Taxes Fucnctions
function validateTax(Request $request)
{
    $validated = $request->validate([
        'name' => ['required', Rule::unique('taxes')->ignore($request->id)],
        'value' => 'required|integer'
    ]);
    return  $validated;
}

//Product Function

function getCategory()
{
    return category::get();
}

function getProduct($id)
{
    return Product::findOrfail($id);
}

//Invoice Functions
function getClientsforInvoice()
{
    return Client::get();
}

function getCurrency()
{
    return Currency::get();
}

function getProductforInvoice()
{
    return Product::get();
}

function getTaxforInvoice()
{
    return Tax::get();
}

function getInvoice($id)
{
    return Invoice::findOrfail($id);
}

function getInvoiceId()
{
    return  Invoice::latest()->first()->id;
}

function getInvoiceAttachmentId($id)
{
    return  Invoice_attachment::where('invoice_id', $id)->first();
}




