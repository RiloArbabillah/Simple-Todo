<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klien extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'klien';

    protected $fillable = [
        'nama',
        'email',
        'telp',
        'alamat',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
