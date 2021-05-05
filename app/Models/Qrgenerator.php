<?php

namespace App\Models;

use App\Http\Controllers\QrgeneratorController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\Relationship;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class qrgenerator extends Model
{

    use HasFactory;
    protected $guarded = [];
    //     protected $fillable = [
    //         'generatedUrl',
    //     ];


    public function user()
    {
        return $this->belongsTo(User::class);
        
    }
}
