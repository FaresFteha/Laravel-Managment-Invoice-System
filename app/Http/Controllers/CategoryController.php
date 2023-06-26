<?php

namespace App\Http\Controllers;

use App\RepositoryInterface\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    private $categoryRepo;

    public function __construct(CategoryRepositoryInterface $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
        $this->middleware('permission:الفئات', ['only' => ['index']]);
        $this->middleware('permission:اضافة الفئات', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل الفئات', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف الفئات', ['only' => ['destroy']]);
    }

    public function index()
    {
        //
        return $this->categoryRepo->index();
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
        return $this->categoryRepo->store($request);
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
        return $this->categoryRepo->update($request);
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
        return $this->categoryRepo->destroy($request);
    }
}
