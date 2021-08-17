<?php

namespace App\Http\Controllers\Admin;

use App\Models\Designation;
use App\Http\Controllers\BaseController;
use App\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
        $this->data['routeType'] = 'user';
        $this->data['designations'] = Designation::latest()->get();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // dd(User::with('profile')->whereHas('profile', function ($q) {
        //                                 $q->where('type', '2');
        //             })->whereHas('roles', function ($q) {
        //                                 $q->where('name', 'user');
        //             })->get());

        $this->data['users'] = User::with('profile')->whereHas('roles', function ($q) {
            $q->where('name', 'user');
        })->get()->sortBy('profile.priority');

        return view('admin.user.view', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['edit'] = false;
        return view('admin.user.create', $this->data);
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
            'email' => 'nullable|string|email|unique:users',
            'designation_id' => 'required|integer',
            'address' => 'nullable|max:255',
            'phone' => 'required|string|max:15',
            // 'type' => 'required|in:1,2,3',

        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->is_active = 1;
        if (isset($request->password) && $request->password !== '') {
            $user->password = Hash::make($request->input('password'));

        }

        $user->save();
        if ($user) {

            $image_name = null;
            $image_path_from_public = 'users';
            if (!is_null($request->file('photo'))) {
                $image_name = upload_image($request->file('photo'), 'user', $image_path_from_public);

            }

            $user->profile()->create([
                'designation_id' => $request->input('designation_id'),
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
                'priority' => $request->input('priority') ? $request->input('priority') : 999,
                'image' => $image_name,
                'type' => 1,
            ]);
            $user->roles()->sync(['2']);
            return redirect()->route('user.index')->with('success_message', 'Data successfully save!');

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
    public function edit(User $user)
    {
        $this->data['edit'] = true;
        $this->data['user'] = $user;
        return view('admin.user.create', $this->data);
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|string|max:100',
            'email' => ['nullable', 'string', 'email', 'max:100',
                Rule::unique('users')->ignore($user->id),
            ],
            'designation_id' => 'required|integer',
            'address' => 'nullable|max:255',
            'phone' => 'required|string|max:15',

        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        if (isset($request->password) && $request->password !== '') {
            $user->password = Hash::make($request->input('password'));

        }

        $user->save();
        if ($user) {

            $image_name = $user->profile->image;
            $image_path_from_public = 'users';
            if (!is_null($request->file('photo'))) {
                if (!is_null($image_name)) {
                    $location = public_path('uploads/users/' . $image_name);
                    File::delete($location);
                }
                $image_name = upload_image($request->file('photo'), 'user', $image_path_from_public);

            }

            $user->profile()->update([
                'designation_id' => $request->input('designation_id'),
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
                'priority' => $request->input('priority') ? $request->input('priority') : 999,
                'image' => $image_name,
                'type' => 1,

            ]);

            return redirect()->route('user.index')->with('success_message', 'Data successfully updated!');

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->delete()) {
            $user->profile()->delete();
            return redirect()->back()->with('success_message', 'Data deleted successfully!');

        } else {
            return redirect()->back()->with('failure_message', 'Something went wrong, please try again!');

        }
    }
}
