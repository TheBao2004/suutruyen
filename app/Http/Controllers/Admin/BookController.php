<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;


use App\Models\Book;



class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact(['books']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        return view('books.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $rules = [
            'name' => 'required|min:3',
            'slug' => 'required|min:3|unique:books,slug',
            'keyword' => 'required',
            'summary' => 'required|min:10',
            // 'cate_id' => 'required|integer',
            'active' => ['required', Rule::in([0,1])],
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            'content' => 'required',
        ];

        $request->validate($rules);

        $book = new Book();

        $book->name = $request->name; 
        $book->slug = $request->slug; 
        $book->summary = $request->summary; 
        $book->content = $request->content; 
        // $book->cate_id = $request->cate_id; 
        $book->active = $request->active; 
        $book->keyword = $request->keyword; 
        $book->created_at = Carbon::now();


        // upload image
        $image = $request->file('image');

        $imgName = time() . '_' . $image->getClientOriginalName();

        $image->move(public_path('upload/image'), $imgName);

        $book->image = $imgName;

        $book->save();

        return redirect()->route('books.index')->with('msg', 'Add Book');


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
    public function edit(string $slug)
    {
        $book = Book::where('slug', $slug)->first();

        return view('books.update', compact(['book']));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {

        $book = Book::where('slug', $slug)->first();

        $rules = [
            'name' => 'required|min:3',
            'slug' => 'required|min:3|unique:books,slug,'.$book->id,
            'keyword' => 'required',
            'summary' => 'required|min:10',
            'content' => 'required',
            // 'cate_id' => 'required|integer',
            'active' => ['required', Rule::in([0,1])],
        ];

        if(!empty($request->image)) $rules['image'] = 'required|image|mimes:jpg,png,jpeg,gif,svg';

        $request->validate($rules);

        $oldImg = $book->image;

        $book->name = $request->name; 
        $book->slug = $request->slug; 
        $book->summary = $request->summary; 
        $book->content = $request->content; 
        // $book->cate_id = $request->cate_id; 
        $book->active = $request->active; 
        $book->keyword = $request->keyword; 
        $book->updated_at = Carbon::now();

        // upload image ko hiểu
        // $get_img = $request->image;
        // $path = "public/upload/image/";
        // $get_name_img = $get_img->getClientOriginalName();
        // $name_img = current(explode('.', $get_name_img));
        // $new_img = $name_img.rand(0, 99).'.'.$get_img->getClientOriginalExtention();
        // $get_img->move($path, $new_img);

        // $book->image = $new_img;


        // upload image

        if(!empty($request->image)){

            $image = $request->file('image');

            $imgName = time() . '_' . $image->getClientOriginalName();
    
            $image->move(public_path('upload/image'), $imgName);
    
            $book->image = $imgName;

            if(File::exists(public_path("upload/image/$oldImg"))){
                unlink(public_path("upload/image/$oldImg"));
            }

        }

        $book->save();

        return back()->with('msg', 'Fix Book Success');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!empty(Book::find($id))){
            Book::destroy($id);
            return back()->with('msg', 'Delete Book Success');
        } 
        return back()->with('msg', 'Delete Book failed');
    }
}
