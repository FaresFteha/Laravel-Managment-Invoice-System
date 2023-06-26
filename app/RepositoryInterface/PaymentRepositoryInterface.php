<?php

namespace App\RepositoryInterface;

interface PaymentRepositoryInterface
{
    public function index();
    public function create();
    public function store($request);
    public function show($id);
    public function update($request);
    public function destroy($request);
    public function incoicesPaymentExport();
    public function payment_print($id);

}
