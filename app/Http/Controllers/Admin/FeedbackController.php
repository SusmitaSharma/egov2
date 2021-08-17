<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\SolutionManagement;

class FeedbackController extends BaseController
{
    public function __construct() {
        parent::__construct();
        $this->data['routeType'] = 'feedback';
    }

    public function index()
    {
    	$this->data['feedbacks'] = SolutionManagement::latest()->paginate($this->default_pagination_limit);
         return view('admin.solution.view',$this->data);

    }


    public function loadData(Request $request)
    {

        $model = new SolutionManagement();
        $output = $model->getData($request->all());

        $this->data['datas'] = $output['result'];

        $this->data['totalData'] = $output['totalData'];

        return view('admin.solution.load_data', $this->data);


    }


    public function getData($id)
    {
    	$feedback=SolutionManagement::find($id);
    	return response()->json(['status'=>true,'data'=>$feedback]);

    }



    public function delete($id)
    {
    	$solution=SolutionManagement::find($id);
    	$output = [];
        if($solution->delete())
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
}
