<?php

namespace App\RepositoryInterface;

interface InvoiceArchiveRepositoryInterface
{

// This function is called when a user navigates to the index page.
public function index();

// This function is called when a user submits an update request.
public function update($request);

// This function is called when a user submits a delete request.
public function destroy($request);



}
