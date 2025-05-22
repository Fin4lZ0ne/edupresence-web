<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nip',
        'birthplace',
        'birthdate',
        'photos',
        'gender',
        'address',
    ];

    protected $casts = [
        'birthdate' => 'date',
        'photos' => 'array', // JSON akan otomatis dikonversi ke array
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
