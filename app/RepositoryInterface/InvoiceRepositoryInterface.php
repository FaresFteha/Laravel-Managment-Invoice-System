<?php

namespace App\RepositoryInterface;

interface InvoiceRepositoryInterface
{

    public function index();

    public function create();

    public function show($id);

    public function edit($id);

    public function store($request);

    public function insertAttachments($request);

    public function update($request);

    public function destroy($request);

    public function invoicePrint($id);

    public function invoiceAll();

    public function readAllNotify($request);
    
    public function notifications();
}
