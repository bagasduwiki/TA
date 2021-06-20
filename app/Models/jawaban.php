<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class jawaban extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'jawaban';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function  User()
    {
        return $this->belongsTo(User::class,'id_user');
    }
//    public function  Tes_tulis()
//    {
//        return $this->belongsTo(tes_tulis::class);
//    }
}
