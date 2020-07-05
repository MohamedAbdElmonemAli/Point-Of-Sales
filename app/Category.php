<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    use \Dimsav\Translatable\Translatable;


    protected $fillable = [
        'name'
    ];
    public $translatedAttributes = ['name'];
    public function products(){
        return $this->hasMany(Product::class);
    }

}
