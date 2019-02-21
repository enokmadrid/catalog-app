<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();

        // load the view and pass the categories
        return view('categories.index')->with('categories', $categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // load the create form (app/views/categories/create.blade.php)
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         // validate
         $request->validate([
            'title' => 'required'
        ]);

        // create and store by this user
        $category = new Category;
        $category->title = $request->title;
        $category->save();

        // redirect
        Session::flash('message', 'Successfully created category!');
        return Redirect::to('categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        // show the view and pass the category to it
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // validate
        $request->validate([
            'title' => 'required'
        ]);

        // create and store by this user
        $category->title = $request->title;
        $category->save();

        // redirect
        Session::flash('message', 'Successfully updated category!');
        return Redirect::to('categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (empty($category)) {
            Session::flash('message', 'Design not found');
            return Redirect::to('categories');
        }
        $category->delete();

        Session::flash('message', 'Category deleted successfully!');
        return Redirect::to('categories');
    }
}
