<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class pemilihan extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'pemilihan';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function User()
    {
        return $this->belongsTo(User::class,'id_user');
    }

    public function Cakahim()
    {
        return $this->belongsTo(cakahim::class, 'id_cakahim', 'id');
    }
}
