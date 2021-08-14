<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recommendation extends Model
{
    public $timestamps = true;
    protected $table = 'recommendation';
    
    protected $fillable = [
        'user_indicator',
        'user_indicated',
        'first_name',
        'title',
        'description',
        'indicator',
        'indicated',
        'flag_status',
    ];

    public function indicator()
    {
        return $this->belongsTo(User::class, 'user_indicator', 'id');
    }

    public function indicated()
    {
        return $this->belongsTo(User::class, 'user_indicated', 'id');
    }
}
