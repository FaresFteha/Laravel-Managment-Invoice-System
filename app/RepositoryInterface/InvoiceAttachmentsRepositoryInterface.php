<?php

namespace App\RepositoryInterface;

interface InvoiceAttachmentsRepositoryInterface
{

    public function store($request);

    public function donlowad($filename);

    public function destroy($request);
}
