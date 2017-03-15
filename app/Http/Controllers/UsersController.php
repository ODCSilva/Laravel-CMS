<?php

namespace App\Http\Controllers;

use App\Privilege;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\User;

class UsersController extends Controller
{
	public function __construct()
	{
		$this->middleware('verify:Admin');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $users = User::with('privileges')->get();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $privileges = Privilege::all();

	    return view('user.create', compact('privileges'));
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
		    'first_name' => 'required|max:255',
		    'last_name' => 'required|max:255',
		    'email' => 'required|email|max:255|unique:users',
		    'password' => 'required|min:6|confirmed',
	    ]);

	    $request['password'] = bcrypt($request['password']);
        $user = new User($request->all());
	    $user->created_by = Auth::id();
	    $user->modified_by = Auth::id();
	    $user->save();

	    foreach ($request['privileges'] as $pId) {
		    $user->privileges()->save(Privilege::find($pId));
	    }

	    return redirect('dashboard/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::with('privileges')->find($id);
	    return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('privileges')->find($id);
	    $privileges = Privilege::all();
	    return view('user.edit', compact('user', 'privileges'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

	    $user = User::with('privileges')->find($id);
	    $user->privileges()->detach();

	    if (!empty($request['privileges'])) {
		    foreach ($request['privileges'] as $pId) {
			    $user->privileges()->save(Privilege::find($pId));
		    }
	    }

	    if (empty($request['password'])) {
		    $request['password'] = $user->password;
	    }
	    else {
		    $request['password'] = bcrypt($request['password']);
	    }

	    if ($request['email'] != $user->email) {
		    $this->validate($request, [
			    'email' => 'required|email|max:255|unique:users',
		    ]);
	    }

	    $this->validate($request, [
		    'first_name' => 'required|max:255',
		    'last_name' => 'required|max:255',
		    'email' => 'required|email|max:255',
	    ]);

	    $user->modified_by = Auth::id();
	    $user->update($request->all());

	    return redirect('dashboard/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
	    $user->privileges()->detach();
	    $user->save();

	    return redirect('dashboard/users');
    }
}
