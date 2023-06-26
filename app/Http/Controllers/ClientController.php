<?php

namespace App\Http\Controllers;
use App\Http\Requests\ClientRequest;
use Illuminate\Http\Request;
use App\RepositoryInterface\ClientRepositoryInterface;

class ClientController extends Controller
{

    private $clientRepo;

    public function __construct(ClientRepositoryInterface $clientRepo)
    {
        $this->clientRepo = $clientRepo;
        $this->middleware('permission:العملاء', ['only' => ['index' , 'show']]);
        $this->middleware('permission:اضافة العملاء', ['only' => ['create', 'store']]);
        $this->middleware('permission:تعديل العملاء', ['only' => ['edit', 'update']]);
        $this->middleware('permission:حذف العملاء', ['only' => ['destroy']]);
    }


    public function index()
    {
        //
        return $this->clientRepo->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return $this->clientRepo->create();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        //
        return $this->clientRepo->store($request);
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
        return $this->clientRepo->show($id);
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
        return $this->clientRepo->edit($id);
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
        return $this->clientRepo->update($request);
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
        return $this->clientRepo->destroy($request);

    }

    public function getStates(Request $request)
    {
        $countryId = $request->id;
        //getStates -> helper functions
        $States = getStates($countryId);

        $output = '<option value ="">' . ucfirst("--حدد الولاية --") . '</option>';
        foreach ($States as $State) {
            $output .= '<option value =" ' . $State->id . '">' . $State->name . '</option>';
        }
        return $output;
    }

    /**
     * @param  Request  $request
     * @return mixed
     */
    public function getCities(Request $request)
    {
        $stateId = $request->id;
        //getCities -> helper functions
        $Cityis =  getCities($stateId);

        $output = '<option value ="">' . ucfirst("--حدد المدينة --") . '</option>';
        foreach ($Cityis as $cities) {
            $output .= '<option value =" ' . $cities->id . '">' . $cities->name . '</option>';
        }
        echo $output;
    }
}
