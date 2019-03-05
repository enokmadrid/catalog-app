<?php

namespace App\Http\Controllers;

use App\Design;
use App\DesignImage;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Image;
use Storage;

class DesignController extends Controller
{
    /**
     * DesignController constructor.
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        // get all the designs of the user
        $designs = Design::where('owner_id', auth()->id())->get();

        // load the view and pass the designs
        return view('designs.index')->with('designs', $designs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $categories = Category::all();

        // load the create form (app/views/designs/create.blade.php)
        return view('designs.create')->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        // validate
        $request->validate([
            'name'      => 'required',
            'number'    => 'required',
            'price'     => 'required | numeric',
            'image'     => 'required | mimes:jpeg,png,jpg | max:2048',
        ]);

        // Store image and save image path
        $image = $request->file('image');
        $imagePath = DesignImage::store($image);


        $attributes = [
            'name'  => $request->name,
            'number'=> $request->number,
            'price' => $request->price,
            'image' => $imagePath,
            'owner_id' => auth()->id(),
        ];

        // create and store by this user
        $design = Design::create($attributes);
        
        // associate category to the newly created design
        $categories = $request->categories;
        $design->categories()->sync($categories, false);

        // redirect
        Session::flash('message', 'Successfully created design!');
        return Redirect::to('designs');

    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function show(Design $design) {
        // only show this design if it belongs to current user
        abort_if($design->owner_id !== auth()->id(), 403);

        // show the view and pass the design to it
        return view('designs.show', compact('design'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function edit(Design $design) {
        $categories = Category::all();

        return view('designs.edit', compact('design'))->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Design $design) {
        // validate
        $request->validate([
            'name'      => 'required',
            'number'    => 'required',
            'price'     => 'required | numeric',
        ]);

        // image file not required to continue the request
        $design->fill($request->except('image'));

        // Check for image, Store image and save image path
        if ($request->hasFile('image')) {
            // validate image file
            $request->validate(['image' => 'required | mimes:jpeg,png,jpg | max:2048']);

            //create and store image file
            $image = $request->file('image');
            $design['image'] = DesignImage::store($image);
        }
        $design->save();

        // associate category to the newly created design
        $categories = $request->categories;
        $design->categories()->sync($categories, false);

        // redirect
        Session::flash('message', 'Successfully Updated design!');
        return Redirect::to('designs');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function destroy(Design $design) {

        if (empty($design)) {
            Session::flash('message', 'Design not found');
            return Redirect::to('designs');
        }

        // delete design
        $design->delete();

        Session::flash('message', 'Design deleted successfully!');
        return Redirect::to('designs');
    }
}
