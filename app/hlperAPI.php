<?php



function getData($model)
{
    $data =  $model::get();
    return $data;
}

function getDataById($model, $id)
{
    $data =  $model::find($id);
    return $data;
}

function dataStore($model , $request){
    $dataStore = $model::create($request->all());
    return $dataStore;
}
