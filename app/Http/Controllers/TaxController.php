<?php

namespace App\Http\Controllers;

use App\RepositoryInterface\TaxRepositoryInterface;
use Illuminate\Http\Request;

class TaxController extends Controller
{
    private $taxRepo;

    public function __construct(TaxRepositoryInterface $taxRepo)
    {
        $this->taxRepo = $taxRepo;
        $this->middleware('permission:ضرائب', ['only' => ['index']]);
        $this->middleware('permission:اضافة ضرائب', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل ضرائب', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف ضرائب', ['only' => ['destroy']]);
    }

    public function index()
    {
        return $this->taxRepo->index();

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
        return $this->taxRepo->store($request);
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
        return $this->taxRepo->update($request);
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
        return $this->taxRepo->destroy($request);
    }
}
