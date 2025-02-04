<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HowItWork extends Model
{
    use HasFactory;

    protected $table = "service_processs";

   
    protected $guarded = ['id'];
    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class,'service_id','id');
    }

    public function process_procedures(): HasMany
    {
        return $this->hasMany(ProcessProcedures::class, 'service_processs_id', 'id');
    }
}
