<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use Illuminate\Validation\Rule;
use App\Models\Designation;

class DesignationController extends BaseController
{

       public function __construct() {
        parent::__construct();
        $this->data['routeType'] = 'designation';

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['designations'] = Designation::latest()->paginate($this->default_pagination_limit);
        return view('admin.designation.view', $this->data);
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
         $this->validate($request, [
            'name' => 'required|string|max:100',
            ]);
        $designation=new Designation();
        $designation->name=$request->input('name');
        if($designation->save())
        {
             return response()->json(['status'=>true,'message'=>'Data saved successfully']);

        }else
        {
            return response()->json(['status'=>false,'message'=>'Something went wrong!']);

        }
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
    public function edit(Designation $designation)
    {
         return response()->json($designation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designation $designation)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',

        ]);

        $designation->name=$request->input('name');

        if($designation->save())
        {
             return response()->json(['status'=>true,'message'=>'Data updated successfully']);

        }else
        {
            return response()->json(['status'=>false,'message'=>'Something went wrong!']);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        $output = [];
        if($designation->delete())
        {
                $output['status'] = 1;
                $output['message'] = 'Data deleted successfully.';
        }else
        {
            $output['status'] = 0;
            $output['message'] = 'Something went wrong. Please try again.';

        }
         return response()->json($output);
    }

     public function loadData(Request $request)
    {

        $model = new Designation();
        $output = $model->getData($request->all());
        $this->data['datas'] = $output['result'];
        $this->data['totalData'] = $output['totalData'];
        return view('admin.designation.load_data', $this->data);


    }


}
