<?php

namespace App\Http\Controllers;

use App\RepositoryInterface\InvoiceAttachmentsRepositoryInterface;
use Illuminate\Http\Request;

class InvoiceAttachmentsController extends Controller
{
    private $invoiceAttRepo;

    public function __construct(InvoiceAttachmentsRepositoryInterface $invoiceAttRepo)
    {
        $this->invoiceAttRepo = $invoiceAttRepo;
        $this->middleware('permission:اضافة مرفقات', ['only' => ['store']]);
        $this->middleware('permission:تحميل مرفقات', ['only' => ['donlowad']]);
        $this->middleware('permission:حذف مرفقات', ['only' => ['destroy']]);
    }

    public function index()
    {
        //

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
        return $this->invoiceAttRepo->store($request);
    }

    public function donlowad($filename)
    {
        //
        return $this->invoiceAttRepo->donlowad($filename);
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        return $this->invoiceAttRepo->destroy($request);
    }
}
