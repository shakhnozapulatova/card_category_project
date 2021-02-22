<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AttributeOption extends Model
{
    use HasFactory;

    protected $table = 'product_attribute_options';

    protected $guarded = [];

    public function attribute() : BelongsTo
    {
        return $this->belongsTo(ProductAttribute::class);
    }
}
