<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use App\RepositoryInterface\InvoiceRepositoryInterface;
use Mpdf\Mpdf;
use PDF;

class InvoiceController extends Controller
{

    private $invoiceRepo;

    public function __construct(InvoiceRepositoryInterface $invoiceRepo)
    {
        $this->invoiceRepo = $invoiceRepo;
        $this->middleware('permission:الفواتير', ['only' => ['index', 'show']]);
        $this->middleware('permission:اضافة الفواتير', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل الفواتير', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف الفواتير', ['only' => ['destroy']]);
        $this->middleware('permission:اضافة مرفقات', ['only' => ['insertAttachments']]);
        $this->middleware('permission:تحميل وطباعة الفواتير', ['only' => ['invoicePrint']]);
        $this->middleware('permission:تصدير الفواتير pdf', ['only' => ['invoiceAll']]);
    }

    public function index()
    {
        //
        return $this->invoiceRepo->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return $this->invoiceRepo->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InvoiceRequest $request)
    {
        //
        return $this->invoiceRepo->store($request);
    }

    public function insertAttachments(Request $request)
    {
        //
        return $this->invoiceRepo->insertAttachments($request);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return $this->invoiceRepo->show($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        return $this->invoiceRepo->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //
        return $this->invoiceRepo->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->invoiceRepo->destroy($request);
    }

    public function invoicePrint($id)
    {
        return $this->invoiceRepo->invoicePrint($id);
    }


    public function invoiceAll()
    {
        return $this->invoiceRepo->invoiceAll();
    }

    public function readAllNotify(Request $request)
    {
        return $this->invoiceRepo->readAllNotify($request);
    }

    public function notifications()
    {
        return $this->invoiceRepo->notifications();
    }


    public function getProduct(Request $request)
    {
        $productId = $request->id;
        $products = Product::where('id', $productId)->first();
        return $products;
    }
}
