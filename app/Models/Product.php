<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait Filterable
{
    public function scopeFilter($query, $request)
    {
        $param = $request->all();
        foreach ($param as $field => $value) {
            $method = 'filter' . Str::studly($field);

            if ($value != '') {
                if (method_exists($this, $method)) {
                    $this->{$method}($query, $value);
                } else {
                    if (!empty($this->filterable) && is_array($this->filterable)) {
                        if (in_array($field, $this->filterable)) {
                            $query->where($this->table . '.' . $field, $value);
                        } elseif (key_exists($field, $this->filterable)) {
                            $query->where($this->table . '.'
                                . $this->filterable[$field], $value);
                        }
                    }
                }
            }
        }

        return $query;
    }
}

class Product extends Model
{
    use HasFactory;
    use Filterable;
    protected $table = 'products';
    protected $filterable = [
        'name',
        'category_id'
    ];

    protected $fillable = [
        'name', 'status', 'image', 'price', 'tag', 'sale_price', 'description', 'image_list', 'status', 'category_id', 'summary'
    ];

    public function category()
    {
        return $this->hasOne('App\Category');
    }

    public function filterName($query, $value)
    {
        return $query->where('name', 'LIKE', '%' . $value . '%');
    }

    public function filterCategory($query, $value)
    {
        return $query->where('category_id', '=', $value);
    }

    public function filterPrice($query, $value)
    {
        return $query->where('price', '>=', $value)
                    ->where('price', '<=', $value);
    }
}
