<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pendaftaran extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'pendaftaran';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $dates = ['deleted_at'];


    public function User()
    {
        return $this->belongsTo(User::class,'id_user')->withTrashed();
    }


}
