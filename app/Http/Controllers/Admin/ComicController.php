<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

// Database
use App\Models\Categorie;
use App\Models\Comic;
use App\Models\Kind;
use App\Models\BlCate;
use App\Models\BlKind;
use App\Models\Chapter;

class ComicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comics = Comic::with('category')->orderBy('id', 'DESC')->get();
        return view('comics.index', compact(['comics']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kinds = Kind::all();
        $categories = Categorie::where('active', 1)->get();
        return view("comics.create", compact(['categories', 'kinds']));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|min:3',
            'author' => 'required|min:3',
            'slug' => 'required|min:3|unique:comics,slug',
            'keyword' => 'required',
            'description' => 'required|min:10',
            'categories' => 'required',
            'kinds' => 'required',
            'active' => ['required', Rule::in([0,1])],
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
            // 'image' => 'required',
        ];

        $request->validate($rules);

        $comic = new Comic();

        $categories = $request->categories;
        $kinds = $request->kinds;

        $comic->cate_id = $categories[0];
        $comic->kind_id = $kinds[0];

        $comic->author = $request->author;
        $comic->view = 0;
        $comic->name = $request->name; 
        $comic->slug = $request->slug; 
        $comic->description = $request->description; 
        $comic->active = $request->active; 
        $comic->keyword = $request->keyword; 
        $comic->created_at = Carbon::now();

        // upload image ko hiểu
        // $get_img = $request->image;
        // $path = "public/upload/image/";
        // $get_name_img = $get_img->getClientOriginalName();
        // $name_img = current(explode('.', $get_name_img));
        // $new_img = $name_img.rand(0, 99).'.'.$get_img->getClientOriginalExtention();
        // $get_img->move($path, $new_img);

        // $comic->image = $new_img;

        // upload image
        $image = $request->file('image');

        $imgName = time() . '_' . $image->getClientOriginalName();

        $image->move(public_path('upload/image'), $imgName);

        $comic->image = $imgName;

        $comic->save();

        $comic->category_multiple()->attach($categories);
        $comic->kind_multiple()->attach($kinds);

        return redirect()->route('comics.index')->with('msg', 'Add Comic');

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
        $comic = Comic::find($id);

        $blCate = BlCate::where('comic_id', '=', $id)->get();
        $blKind = BlKind::where('comic_id', '=', $id)->get();

        $arrCate = [];
        $arrKind = [];

        foreach ($blCate as $value) {
            $arrCate[] = $value->cate_id;
        }

        foreach ($blKind as $value) {
            $arrKind[] = $value->kind_id;
        }

        $categories = Categorie::where('active', 1)->get();
        $kinds = Kind::all();
        return view("comics.update", compact(['categories', 'kinds', 'comic', 'arrCate', 'arrKind']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $rules = [
            'name' => 'required|min:3',
            'author' => 'required|min:3',
            'slug' => 'required|min:3|unique:comics,slug,'.$id,
            'keyword' => 'required',
            'description' => 'required|min:10',
            'categories' => 'required',
            'kinds' => 'required',
            'active' => ['required', Rule::in([0,1])],
        ];

        if(!empty($request->image)) $rules['image'] = 'required|image|mimes:jpg,png,jpeg,gif,svg';

        $request->validate($rules);

        $comic = Comic::find($id);

        $oldImg = $comic->image;


        $comic->author = $request->author;
        $comic->name = $request->name; 
        $comic->slug = $request->slug; 
        $comic->description = $request->description; 
        $comic->active = $request->active; 
        $comic->keyword = $request->keyword; 
        $comic->updated_at = Carbon::now();

        // upload image ko hiểu
        // $get_img = $request->image;
        // $path = "public/upload/image/";
        // $get_name_img = $get_img->getClientOriginalName();
        // $name_img = current(explode('.', $get_name_img));
        // $new_img = $name_img.rand(0, 99).'.'.$get_img->getClientOriginalExtention();
        // $get_img->move($path, $new_img);

        // $comic->image = $new_img;


        // upload image

        if(!empty($request->image)){

            $image = $request->file('image');

            $imgName = time() . '_' . $image->getClientOriginalName();
    
            $image->move(public_path('upload/image'), $imgName);
    
            $comic->image = $imgName;

            if(File::exists(public_path("upload/image/$oldImg"))){
                if(!empty($oldImg)) unlink(public_path("upload/image/$oldImg"));
            }

        }

        $categories = $request->categories;
        $kinds = $request->kinds;

        $comic->cate_id = $categories[0];
        $comic->kind_id = $kinds[0];

        $comic->save();

        BlCate::where('comic_id', $id)->delete();
        BlKind::where('comic_id', $id)->delete();

        $comic->category_multiple()->attach($categories);
        $comic->kind_multiple()->attach($kinds);

        return back()->with('msg', 'Fix Comic Success');

    }



    public function outstanding(Request $request){

        $comic = Comic::find($request->id);

        $comic->outstanding = $request->outstanding;

        $comic->save();

    }

    public function full(Request $request){

        $comic = Comic::find($request->id);

        $comic->full = $request->full;

        $comic->save();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(empty($id)) return redirect()->route('comics.index'); 
        $comic = Comic::find($id);
        if(empty($comic)) return redirect()->route('comics.index'); 

        $chapters = Chapter::where('comic_id', $id)->get();


        if(!empty($chapters->count())) return back()->with('msg', 'Cannot Delete Because There Are Still Chapters');

        BlCate::where('comic_id', $id)->delete();
        BlKind::where('comic_id', $id)->delete();

        Comic::where('id', $id)->delete();

        return back()->with('msg', 'Delete Comic Success');

    }
}
