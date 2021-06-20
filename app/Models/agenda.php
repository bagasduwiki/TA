<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class agenda extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'agenda';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $dates = ['deleted_at'];


    public function Spj()
    {
        return $this->belongsTo(spj::class);
    }


}
