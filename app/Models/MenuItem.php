<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'url', 'parent_id'];

    public function children()
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('order_by','ASC');
    }
}
