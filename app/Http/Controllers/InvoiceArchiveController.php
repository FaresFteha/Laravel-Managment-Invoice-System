<?php

namespace App\Http\Controllers;

use App\RepositoryInterface\InvoiceArchiveRepositoryInterface;
use Illuminate\Http\Request;

class InvoiceArchiveController extends Controller
{
    private $invoiceArchiveRepo;

    public function __construct(InvoiceArchiveRepositoryInterface $invoiceArchiveRepo)
    {
        $this->invoiceArchiveRepo = $invoiceArchiveRepo;
        $this->middleware('permission:ارشيف الفواتير', ['only' => ['index']]);
        $this->middleware('permission:الغاء ارشيف الفواتير', ['only' => ['update']]);
        $this->middleware('permission:حذف الفواتير نهائياً', ['only' => ['destroy']]);
    }

    public function index()
    {
        //
        return $this->invoiceArchiveRepo->index();
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
    public function update(Request $request)
    {
        //
        return $this->invoiceArchiveRepo->update($request);
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
        return $this->invoiceArchiveRepo->destroy($request);
    }
}
