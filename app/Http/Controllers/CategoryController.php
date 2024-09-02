<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
class CategoryController extends Controller
{
    //Show the storing form for categories.
    public function index(){
        return view('categories.index');
    }
    //Store the newly created Category in the database.
    public function store(StoreCategoryRequest $request){
        $validated = $request->validated();
        
        Category::create($validated);

        return redirect()->route('users.index');
    }
}
