<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;
    protected $fillable = ['name','description','price','stock','image'];

    public function order()
    {
        return $this->belongsToMany(Order::class)->withPivot(['quantity','message']);
    }
}
