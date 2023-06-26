<?php

namespace App\Http\Controllers;

use App\RepositoryInterface\PaymentRepositoryInterface;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    private $paymentRepo;

    public function __construct(PaymentRepositoryInterface $paymentRepo)
    {
        $this->paymentRepo = $paymentRepo;
        $this->middleware('permission:جميع المدفوعات|المدفوعات', ['only' => ['index', 'create']]);
        $this->middleware('permission:دفع الفواتير', ['only' => ['store']]);
        $this->middleware('permission:المدفوعات الخاصة', ['only' => ['show']]);
        $this->middleware('permission:تعديل المدفوعات', ['only' => ['update']]);
        $this->middleware('permission:حذف المدفوعات', ['only' => ['destroy']]);
        $this->middleware('permission:طباعة المدفوعات', ['only' => ['payment_print']]);
        $this->middleware('permission:تصدير المدفوعات pdf', ['only' => ['incoicesPaymentExport']]);
    }

    public function index()
    {
        //
        return $this->paymentRepo->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return $this->paymentRepo->create();
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
        return $this->paymentRepo->store($request);
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
        return $this->paymentRepo->show($id);
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
        return $this->paymentRepo->update($request);
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
        return $this->paymentRepo->destroy($request);
    }

    public function incoicesPaymentExport()
    {
        //
        return $this->paymentRepo->incoicesPaymentExport();
    }

    public function payment_print($id)
    {
        //
        return $this->paymentRepo->payment_print($id);
    }
}
