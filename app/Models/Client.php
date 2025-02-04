<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $table = "project_clients";

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
