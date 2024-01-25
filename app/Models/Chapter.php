<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


use App\Models\Comic;
use App\Models\Categorie;

class Chapter extends Model
{
    use HasFactory;

    protected $table = 'chapters';

    public function comic(){
        return $this->belongsTo(
            Comic::class,
            'comic_id',
            'id'
        );
    }



}
