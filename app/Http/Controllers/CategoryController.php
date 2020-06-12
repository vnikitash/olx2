<?php
/**
 * Created by PhpStorm.
 * User: viktor
 * Date: 12.06.2020
 * Time: 20:42
 */

namespace App\Http\Controllers;


class CategoryController extends Controller
{
    public function index()
    {
        die("I will show list of all categories");
    }

    public function show(int $categoryId) {
        die("I will show list of subcategories");
    }
}