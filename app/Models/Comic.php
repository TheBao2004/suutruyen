<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Categorie;
use App\Models\Kind;
use App\Models\BlCate;
use App\Models\BlKind;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Blade;

use App\Models\Chapter;

class Comic extends Model
{
    use HasFactory;

    protected $table = 'comics';
    protected $timestamp = false;

    public function category(){
        return $this->belongsTo(
            Categorie::class,
            'cate_id',
            'id' 
        );
    }

    public function kind(){
        return $this->belongsTo(
            Kind::class,
            'kind_id',
            'id'
        );
    }


    public function category_multiple()
    {
        return  $this->belongsToMany(BlCate::class, 'bl_categories', 'comic_id', 'cate_id');
    }

    public function kind_multiple(){
        return $this->belongsToMany(BlKind::class, 'bl_kinds', 'comic_id', 'kind_id');
    }

    public function categories(){
        return $this->belongsToMany(
            Categorie::class,
            'bl_categories',
            'comic_id',
            'cate_id',
        );
    }

    public function kinds(){
        return $this->belongsToMany(
            Kind::class,
            'bl_kinds',
            'comic_id',
            'kind_id',
        );
    }


    public static function comicCate($id){
        $blCate = BlCate::where('comic_id', $id)->get();
        $comicCate = [];
        foreach ($blCate as $key => $value) {
            $comicCate[] = Categorie::find($value->cate_id);
        }
        return $comicCate;
    }

    public function chapters(){
        return $this->hasMany(
            Chapter::class,
            'comic_id',
            'id'
        );
    }

}
