<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TwoFactor extends Model
{
    use HasFactory;

    public $table = 'twofactor';


    protected $fillable = [
        'second_password',
        'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
