<?php

namespace App\Http\Controllers;

use App\RepositoryInterface\InvoiceStatusRepositoryInterface;
use Illuminate\Http\Request;

class InvoiceStatusController extends Controller
{
    private $InvoiceStatusRepo;

    public function __construct(InvoiceStatusRepositoryInterface $InvoiceStatusRepo)
    {
        $this->InvoiceStatusRepo = $InvoiceStatusRepo;
        $this->middleware('permission:حالات الفواتير|الحالات الخاصة للفواتير|الحالات', ['only' => ['show']]);
        $this->middleware('permission:الحالات الخاصة للفواتير|الحالات', ['only' => ['show']]);
        $this->middleware('permission:تغير حالة الفواتير', ['only' => ['store', 'edit']]);
        $this->middleware('permission:جميع الحالات', ['only' => ['create']]);
        $this->middleware('permission:تصدير الحالات pdf', ['only' => ['exportstatysinvoices']]);
    }

    public function index()
    {
        //
        return $this->InvoiceStatusRepo->index();
    }

    public function create()
    {
        //
        return $this->InvoiceStatusRepo->create();
    }

    public function store(Request $request)
    {
        //
        return $this->InvoiceStatusRepo->store($request);
    }

    public function edit($id)
    {
        //
        return $this->InvoiceStatusRepo->edit($id);
    }

    public function show($id)
    {
        //
        return $this->InvoiceStatusRepo->show($id);
    }

    public function exportstatysinvoices()
    {
        return $this->InvoiceStatusRepo->exportstatysinvoices();
    }
}
