<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::paginate(10);
        return view('page.backend.Clients_Cpanel.Products.index', compact('products'));
    }
}
