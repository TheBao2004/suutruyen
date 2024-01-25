<?php

namespace App\Http\Controllers;

use App\Models\BlCate;
use App\Models\BlKind;
use App\Models\Book;
use Illuminate\Http\Request;


// Database 
use App\Models\Categorie;
use App\Models\Kind;
use App\Models\Comic;
use App\Models\Chapter;

use function PHPUnit\Framework\returnSelf;

class IndexController extends Controller
{
    private $categories, $kinds;
    
    public function __construct()
    {
        $this->categories = Categorie::where('active', 1)->get();
        $this->kinds = Kind::all();
    }

    public function index(){

        $categories = $this->categories;
        $kinds = $this->kinds;

        $comicHot = Comic::where('active', 1)->where('outstanding', 2)->take(16)->get();
        $comicNew = Comic::where('active', 1)->where('outstanding', 1)->take(16)->get();
        $comicFull = Comic::where('active', 1)->where('full', 1)->take(16)->get();

        return view('clients.pages.home', compact(['categories', 'comicHot', 'comicFull', 'comicNew', 'kinds']));

    }


    public function search_ajax(Request $request){

        $keyword = $request->keyword;
        $result = '';

        if(!empty($keyword)){

            $comics = Comic::where('active', 1)->where('name', 'LIKE', '%'.$keyword.'%')->get();
            $result = '<div class="card text-white bg-light">';
            $result .= '<div class="card-body p-0">';
            $result .= '<ul class="list-group list-group-flush">';

            foreach ($comics as $item) {

                $result .= '<li class="result-ajax list-group-item"><a class="text-dark hover-title" href="#">'.$item->name.'</a></li>';

            }

            $result .= "</ul>";
            $result .= "</div>";
            $result .= "</div>";

            return $result;

         }

    }

    public function search(Request $request){

        $kinds = $this->kinds;
        $categories = $this->categories;

        $keyword = $request->key_word;

        $comics = Comic::where('active', 1)->where('name', 'LIKE', '%'.$keyword.'%')->get();

        return view('clients.pages.search', compact(['comics', 'kinds', 'categories', 'keyword']));

    }

    public function keywords($slug){

        $kinds = $this->kinds;
        $categories = $this->categories;

        $keywords = explode('-', $slug);

        $comics = Comic::where('active', 1);

        $comics = $comics->where(function($query) use ($keywords) {
        foreach ($keywords as $key) { 
                $query->orWhere('name', 'LIKE', "%".$key."%");
            }
        });
        $comics = $comics->get();

        return view('clients.pages.keywords', compact(['categories', 'kinds', 'comics', 'slug']));

    }

    public function categories($slug){

        $kinds = $this->kinds;
        $categories = $this->categories;

        $category = Categorie::where('slug', $slug)->select("id", "name")->where('active', 1)->first();

        if(empty($category)) return redirect()->route('trang-chu');

        $blCate = BlCate::where('cate_id', $category->id)->get();

        $conmics = [];

        foreach ($blCate as $key => $value) {
            $comics[] = Comic::find($value->comic_id);
        }

        $comics = array_filter($comics);

        return view('clients.pages.categories', compact(['categories', 'comics', 'category', 'kinds']));

    }


    public function kinds($slug){

        $kinds = $this->kinds;
        $categories = $this->categories;

        $kind = Kind::where('slug', $slug)->select("id", "name")->first();

        if(empty($kind)) return redirect()->route('trang-chu');

        $blKind = BlKind::where('kind_id', $kind->id)->get();

        $comics = [];

        foreach ($blKind as $key => $value) {
            $comics[] = Comic::find($value->comic_id);
        }

        $comics = array_filter($comics);

        return view('clients.pages.kinds', compact(['categories', 'comics', 'kind', 'kinds']));

    }


    public function detail($slug){

    
        $categories = $this->categories;
        $kinds = $this->kinds;

        $comic = Comic::where('slug', $slug)->with('category', 'kind')->where('active', 1)->first();

        $cateSame = $comic->categories;
        $comicBlCate = [];
        foreach ($cateSame as $key => $cate) {
            $blCate = BlCate::where('cate_id', $cate->id)->where('comic_id', '<>', $comic->id)->with('comic')->first();
            if(!empty($blCate)) $comicBlCate[] = $blCate->comic;    
            if($key == 7) break;
        }

        if(empty($comic)) return redirect()->route('trang-chu');

        $viewNow = $comic->view;

        $comic->view = $viewNow + 1;

        $comic->save();

        $comicId = $comic->id;

        $keywords = explode(',', $comic->keyword);

        $chapters = Chapter::where('comic_id', $comicId)->orderBy('id', 'DESC')->paginate(4);
        // $comics = Comic::where('cate_id', $comic->cate_id)->where('id', '<>', $comic->id)->take(8)->get();

        $comicOutstanding = Comic::where('active', 1)->where('outstanding', 2)->take(10)->get();
        $comicNew = Comic::where('active', 1)->where('outstanding', 1)->take(10)->get();
        $comicView = Comic::where('active', 1)->orderBy('view', 'DESC')->take(10)->get();

        return view('clients.pages.comic', compact(['categories', 'comic', 'chapters', 'comicBlCate', 'kinds', 'keywords', 'comicOutstanding', 'comicNew', 'comicView']));

    }


    public function chapter($slug){

        $backSlug = '';
        $nextSlug = '';

        $kinds = $this->kinds;
        $categories = $this->categories;

        $chapter = Chapter::where('slug', $slug)->first();

        $comicId = $chapter->comic_id;

        $comic = Comic::where('id', $comicId)->with('category')->first();

        $chapters = Chapter::where('comic_id', $comicId)->orderBy('id', 'DESC')->get();

        $back = Chapter::where('comic_id', $comicId)->where('id', '<', $chapter->id)->select('slug')->orderBy('id', 'DESC')->first();
        if(!empty($back)) $backSlug = $back->slug;
        $next = Chapter::where('comic_id', $comicId)->where('id', '>', $chapter->id)->select('slug')->orderBy('id', 'ASC')->first();
        if(!empty($next)) $nextSlug = $next->slug;
        

        $max = Chapter::select('slug')->where('comic_id', $comicId)->orderBy('id', 'DESC')->first();
        $maxSlug = $max->slug;
        $min = Chapter::select('slug')->where('comic_id', $comicId)->orderBy('id', 'ASC')->first();
        $minSlug = $min->slug;

        if(empty($chapter)) return redirect()->route('trang-chu');

        return view('clients.pages.chapter', compact(['categories', 'kinds', 'comic', 'chapter', 'chapters', 'backSlug', 'nextSlug', 'maxSlug', 'minSlug']));

    }



    public function books(){

        $kinds = $this->kinds;
        $categories = $this->categories;

        $books = Book::where('active', 1)->get();

        return view('clients.pages.books', compact(['kinds', 'categories', 'books']));

    }


    public function read_now(Request $request){

        $output = '';

        $bookId = $request->book_id;


        $book = Book::find($bookId);

        $book->view = 10;

        $book->save;

        if(!empty($book)){

            $output .= '   
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">'.$book->name.'</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">'.html_entity_decode($book->content).'</div>
                <div class="modal-footer">
            </div>';

        }        


        return $output;

    }



}
