<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Comic;   

class BlCate extends Model
{
    use HasFactory;

    protected $table = 'bl_categories';



    public function comic(){
        return $this->BelongsTo(
            Comic::class,
            'comic_id',
            'id'
        );
    }


}
