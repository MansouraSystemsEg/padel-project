<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slug','description','image','status','parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class , 'parent_id')
                    ->withDefault([
                        'name' => '-',
                    ]);
    }

    public function children()
    {
        return $this->hasMany(Category::class , 'parent_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }



    public function getImageUrlAttribute()
    {
        if (!empty($this->image) && file_exists(public_path('uploads/' . $this->image))) {
            return asset('uploads/' . $this->image);
        }
    
        return asset('uploads/default-avatar.png');
    }

    public static function getStatus() 
    { 
        return [
            'active' => 'Active' , 
            'inactive' => 'Inactive' , 
        ]; 
    }
}
