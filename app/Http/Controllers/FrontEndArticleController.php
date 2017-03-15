<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\CSSTemplate;
use App\Page;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

class FrontEndArticleController extends Controller
{
	public function __construct()
	{
		$this->middleware('verify:Author');
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
	    return redirect('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
	    $page = Page::find($request['page_id']);
	    $pages = Page::all();
	    $css = CSSTemplate::where('active','=','1')->first();

	    return view('front_end_article.create', compact('page','pages', 'css'));
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
		    'title' => 'required|max:255',
		    'html_content' => 'required',
	    ]);

	    $article = new Article($request->all());
	    $article->on_all = (!empty($request['on_all']));
	    $article->created_by = Auth::id();
	    $article->modified_by = Auth::id();
	    $article->save();

	    return redirect('page/' . $request['page_id']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
	    return redirect('/');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $pages = Page::all();
	    $css = CSSTemplate::where('active','=','1')->first();
	    $article = Article::with('page')->find($id);
	    return view('front_end_article.edit', compact('article', 'css', 'pages'));
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
		    'title' => 'required|max:255',
		    'html_content' => 'required',
	    ]);

	    $article = Article::find($id);
	    $article->on_all = (!empty($request['on_all']));
	    $article->page_id = (!empty($request['page_id'])) ? $request['page_id'] : NULL;
	    $article->content_area_id = (!empty($request['content_area_id'])) ? $request['content_area_id'] : NULL;
	    $article->modified_by = Auth::id();
	    $article->update($request->all());

	    return back()->with('status', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
	    return redirect('/');
    }
}
