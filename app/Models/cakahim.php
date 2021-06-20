<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class cakahim extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'cakahim';
    protected $primaryKey = 'id';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function User()
    {
        return $this->belongsTo(User::class,'id_user');
    }
    public function Pemilihan()
    {
        return $this->belongsTo(pemilihan::class, 'id_cakahim');
    }
}
