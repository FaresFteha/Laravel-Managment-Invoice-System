<?php
namespace App\RepositoryInterface;
interface CategoryRepositoryInterface{
    
public function index();

public function store($request);

public function update($request);

public function destroy($request);

}