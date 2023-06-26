<?php

namespace App\Http\Requests;

use Spatie\LaravelData\Data;
use App\Models\Category;


class ReturnRequest extends Data
{
    public function __construct(){

    }

    public static function fromModel(Category $category): self
    {
        return new self(

        );
    }

}
