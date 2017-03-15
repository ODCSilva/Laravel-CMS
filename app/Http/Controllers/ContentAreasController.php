<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContentArea;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Http\Requests;

class ContentAreasController extends Controller
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
        $contentAreas = ContentArea::all();
	    return view('content_area.index', compact('contentAreas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    $count = ContentArea::count();
        return view('content_area.create', compact('count'));
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
		    'alias' => 'required|max:255',
	    ]);

	    $area = new ContentArea($request->all());
	    $area->display_order = $request['display_order'];

	    // Check if a content area with the same display order exist
	    $oldPosition = ContentArea::where('display_order', '=',$request['display_order'])->first();

	    if (!empty($oldPosition)) {
		    $oldPosition->display_order = ContentArea::count() + 1;
		    $oldPosition->save();
	    }

	    $area->created_by = Auth::id();
	    $area->modified_by = Auth::id();
	    $area->save();

	    return redirect('dashboard/contentareas');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $area = ContentArea::find($id);
	    return view('content_area.show', compact('area'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $area = ContentArea::find($id);
	    $count = ContentArea::count();
        return view('content_area.edit', compact('area', 'count'));
    }


    public function update(Request $request, $id)
    {
	    $this->validate($request, [
		    'name' => 'required|max:255',
		    'alias' => 'required|max:255',
	    ]);

	    $area = ContentArea::find($id);
	    $oldOrder = $area->display_order;

	    $area->display_order = $request['display_order'];

	    // Check if a content area with the same display order exist
	    $oldPosition = ContentArea::where('display_order', '=',$request['display_order'])->first();

	    if (!empty($oldPosition)) {
		    $oldPosition->display_order = $oldOrder;
		    $oldPosition->save();
	    }

	    $area->modified_by = Auth::id();
        $area->update($request->all());

	    return redirect("dashboard/contentareas");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	    $area = ContentArea::with('articles')->find($id);

	    if(!empty($area)) {
		    foreach($area->articles()->get() as $article) {
			    $article->content_area_id = null;
			    $article->save();
		    }
		    $area->delete();
	    }

        return redirect("dashboard/contentareas");
    }
}
