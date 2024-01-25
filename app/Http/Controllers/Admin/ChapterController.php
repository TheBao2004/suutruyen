<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


//Database
use App\Models\Comic;
use App\Models\Chapter;


class ChapterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chapters = Chapter::orderBy('id', 'DESC')->with('comic')->get();
        return view('chapters.index', compact(['chapters']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $comics = Comic::all();
        return view('chapters.create')->with(compact(['comics']));
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|min:5',
            // 'slug' => 'required|min:5,unique:chapters,slug',
            'slug' => 'required|min:5',
            'sumary' => 'required|min:10',
            'content' => 'required',
            'active' => ['required', Rule::in([0,1])],
            'comic_id' => 'required|integer',
        ];

        $request->validate($rules);

        $chapter = new Chapter();

        $chapter->title = $request->title;
        $chapter->slug = $request->slug;
        $chapter->sumary = $request->sumary;
        $chapter->content = $request->content;
        $chapter->active = $request->active;
        $chapter->comic_id = $request->comic_id;
        $chapter->created_at = date('Y-m-d H:i:s');

        $chapter->save();

        return redirect()->route('chapters.index')->with('msg', 'Add Chapter Success');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $comics = Comic::all();
        $chapter = Chapter::find($id);
        return view('chapters.update', compact(['chapter', 'comics']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'title' => 'required|min:5',
            'slug' => 'required|min:5,unique:chapters,slug,'.$id,
            'sumary' => 'required|min:10',
            'content' => 'required',
            'active' => ['required', Rule::in([0,1])],
            'comic_id' => 'required|integer',
        ];

        $request->validate($rules);

        $chapter = Chapter::find($id);

        $chapter->title = $request->title;
        $chapter->slug = $request->slug;
        $chapter->sumary = $request->sumary;
        $chapter->content = $request->content;
        $chapter->active = $request->active;
        $chapter->comic_id = $request->comic_id;
        $chapter->updated_at = date('Y-m-d H:i:s');

        $chapter->save();

        return back()->with('msg', 'Fix Chapter Success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $chapter = Chapter::find($id);
        if($chapter){
            $chapter->delete();
            return back()->with('msg', 'Delete Chapter Success');
        }
        return back();
    }
}
