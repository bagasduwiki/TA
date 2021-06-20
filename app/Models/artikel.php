<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class artikel extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'artikel';
    protected $primaryKey = 'artikel_id';
    protected $guarded = [];
    protected $dates = ['deleted_at'];

    public function komentar_artikel()
    {
        return $this->hasMany(komentar_artikel::class);
    }
}
