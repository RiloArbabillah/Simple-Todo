<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'project';

    protected $fillable = [
        'klien_id',
        'user_id',
        'nama',
        'keterangan',
        'due_at',
        'done_at',
    ];

    public function klien()
    {
        return $this->belongsTo(Klien::class);
    }
}
