<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;

class CompanyController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->data['routeType'] = 'company';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['company'] = Company::findOrFail(1);
        return view('admin.company.view', $this->data);
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
    public function update(Request $request, Company $company)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'province_no' => 'nullable|string',
            'company_type' => 'nullable|integer',
            'email' => 'required|string|email|max:100',
            'phone' => 'required|string|max:15|min:5',
            'address' => 'nullable|string|max:100',
            'website' => 'nullable|string|max:100',
            'facebook_link' => 'nullable|string|max:255',
            'twitter_link' => 'nullable|string|max:255',
//            'description' => 'nullable|string|max:10000',

        ]);

        $company->name = $request->input('name');
        if ($company->company_type == 1){
            $company->company_type = $request->input('company_type');
            $company->province_no = null;
        } elseif ($company->company_type == 0){
            $company->company_type = $request->input('company_type');
            $company->province_no = $request->input('province_no');
        }

        $company->email = $request->input('email');
        $company->phone = $request->input('phone');
        $company->address = $request->input('address');
        $company->website = $request->input('website');
        $company->facebook_link = $request->input('facebook_link');
        $company->twitter_link = $request->input('twitter_link');
        $company->description = $request->input('description');
        if ($company->save()) {
            return redirect()->route('company.index')->with('success_message', 'Data updated successfully!');

        } else {
            return redirect()->back()->with('failure_message', "Sorry, the office data couldn't be updated. Please try again later!");
        }

    }

}
