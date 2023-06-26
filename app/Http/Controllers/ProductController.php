<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\RepositoryInterface\ProductRepositoryInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $productRepo;

    public function __construct(ProductRepositoryInterface $productRepo)
    {
        $this->productRepo = $productRepo;
        $this->middleware('permission:ضرائب', ['only' => ['index', 'show']]);
        $this->middleware('permission:اضافة المنتجات', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل المنتجات', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف المنتجات', ['only' => ['destroy']]);
    }


    public function index()
    {
        //
        return $this->productRepo->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return $this->productRepo->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        //
        return $this->productRepo->store($request);
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
        return $this->productRepo->show($id);
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
        return $this->productRepo->edit($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request)
    {
        //
        return $this->productRepo->update($request);
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
        return $this->productRepo->destroy($request);
    }
}
