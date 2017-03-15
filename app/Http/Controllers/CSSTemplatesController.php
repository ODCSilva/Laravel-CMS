<?php

namespace App\Http\Controllers;

use App\ContentArea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\CSSTemplate;

class CSSTemplatesController extends Controller
{
	public function __construct()
	{
		$this->middleware('verify:Editor');
	}

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    $templates = CSSTemplate::all();

        return view('csstemplate.index', compact('templates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('csstemplate.create');
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
		    'name' => 'required|max:255',
		    'css_content' => 'required',
	    ]);

	    $template = new CSSTemplate($request->all());
	    $template->active = (!empty($request['active']));

	    if ($template->active) {
		    foreach (CSSTemplate::where('id', '!=', $request['id'])->get() as $other) {
			    $other->active = 0;
			    $other->save();
		    }
	    }

	    $template->created_by = Auth::id();
	    $template->modified_by = Auth::id();
	    $template->save();

	    return redirect('dashboard/csstemplates');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $template = CSSTemplate::find($id);
	    return view('csstemplate.show', compact('template'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $template = CSSTemplate::find($id);

	    return view('csstemplate.edit', compact('template'));
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
	    $this->validate($request, [
		    'name' => 'required|max:255',
		    'css_content' => 'required',
	    ]);

        $template = CSSTemplate::find($id);
	    $template->active = (!empty($request['active']));

	    if ($template->active) {
		    foreach (CSSTemplate::where('id', '!=', $request['id'])->get() as $other) {
			    $other->active = 0;
			    $other->save();
		    }
	    }

	    $template->modified_by = Auth::id();
	    $template->update($request->all());

	    return redirect('dashboard/csstemplates');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $template = CSSTemplate::find($id);
	    $template->delete();

	    return redirect('dashboard/csstemplates');
    }
}
