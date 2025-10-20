<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Plant;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        // Get all categories for the dropdown
        $categories = Category::all();

        // Get selected family from request
        $selectedFamily = $request->input('family');

        // Filter plants if family is selected
        $plants = $selectedFamily 
            ? Plant::where('family', $selectedFamily)->get()
            : Plant::all();

        return view('store', compact('plants', 'categories', 'selectedFamily'));
    }
}
