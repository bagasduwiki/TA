<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class komentar_artikel extends Model
{
    use HasFactory;
    protected $table = 'komentar_artikel';
    protected $primaryKey = 'id';
    protected $guarded = [];
    const UPDATED_AT=NULL;

    public function artikel()
    {
        return $this->belongsTo(artikel::class,'artikel_id');
    }
}
