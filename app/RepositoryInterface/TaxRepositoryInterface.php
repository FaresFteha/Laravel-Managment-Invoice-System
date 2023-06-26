<?php
namespace App\RepositoryInterface;
interface TaxRepositoryInterface{
    
public function index();

public function store($request);

public function update($request);

public function destroy($request);

}