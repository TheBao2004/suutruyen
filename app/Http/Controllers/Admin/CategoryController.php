<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use App\Models\Categorie;
use App\Models\Comic;
use App\Models\BlCate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   
        $categories = Categorie::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3|unique:categories,name',
            'slug' => 'required|min:3|unique:categories,slug',
            'active' => ['required', Rule::in([0,1])],
        ];
    
        $request->validate($rules);

        $category = new Categorie();

        $category->name = $request->name;
        $category->active = $request->active;
        $category->slug = $request->slug;
        $category->created_at = date('Y-m-d H:i:s');
        $category->save();

        return redirect()->route('categories.index')->with('msg', 'Add Category Success');

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

        if(empty($id)) return redirect()->route('categories.index');
        
        $user = Categorie::find($id);

        if(empty($user->id)) return redirect()->route('categories.index');

        return view('categories.update', compact(['user']));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $rules = [
            'name' => 'required|min:3|unique:categories,name,'.$id,
            'slug' => 'required|min:3|unique:categories,slug,'.$id,
            'active' => ['required', Rule::in([0,1])],
        ];
    
        $request->validate($rules);

        $category = Categorie::find($id);

        $category->name = $request->name;
        $category->active = $request->active;
        $category->slug = $request->slug;
        $category->updated_at = date('Y-m-d H:i:s');
        $category->save();

        return back()->with('msg', 'Fix Category Success');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Categorie::find($id);
        $blCate = BlCate::where('cate_id', $id)->get();
        if(!empty($blCate->count())) return back()->with('msg', "Cannot be deleted because the story is still there");
        if($category){
            $category->delete();
            return back()->with('msg', 'Delete Category Success');
        }
        return back();
    }
}
