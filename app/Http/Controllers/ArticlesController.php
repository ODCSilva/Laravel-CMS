<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\Article;

class ArticlesController extends Controller
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
	    $articles = Article::with(['page', 'area'])->get();
        return view('article.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    return view('article.create');
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

	    return redirect('dashboard/articles');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
	    $article = Article::find($id);
	    return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $article = Article::find($id);
	    return view('article.edit', compact('article'));
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

	    return redirect('dashboard/articles');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $article = Article::find($id);
	    $article->delete();

	    return redirect('dashboard/articles');
    }
}
