<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialist extends Model
{
    use HasFactory;

    public function GetSpecialistLists(){
        return $this->hasMany(SpecialistDetail::class,'specialist_id','id');
    }
}
