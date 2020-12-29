<?php

namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSku extends Model
{
    use HasFactory;
    use HasDateTimeFormatter;
    protected $fillable= ['title','description','price','stock'];

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
