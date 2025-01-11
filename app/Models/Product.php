<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slug','description','image','status','category_id',
        'price','compare_price','quantity','rating','featured',
    ];  

    public function category()
    {
        return $this->belongsTo(Category::class)
        ->withDefault([
             'name' => '-',
        ]);
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
            'draft' => 'Draft' , 
            'inactive' => 'Inactive' , 
        ]; 
    }
}
