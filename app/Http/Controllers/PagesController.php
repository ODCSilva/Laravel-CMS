<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Page;

class PagesController extends Controller
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
        $pages = Page::all();

	    return view('page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('page.create');
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

        $page = new Page($request->all());
	    $page->created_by = Auth::id();
	    $page->modified_by = Auth::id();
	    $page->save();

	    return redirect('dashboard/pages');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $page = Page::find($id);
	    return view('page.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = Page::find($id);

	    return view('page.edit', compact('page'));
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
		    'alias' => 'required|max:255',
	    ]);

        $page = Page::find($id);
	    $page->modified_by = Auth::id();
	    $page->update($request->all());

	    return redirect("dashboard/pages");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	    $page = Page::with('articles')->find($id);

	    if(!empty($page)) {
		    foreach($page->articles()->get() as $article) {
			    $article->page_id = null;
			    $article->save();
		    }

		    $page->delete();
	    }

	    return redirect("dashboard/pages");
    }
}
