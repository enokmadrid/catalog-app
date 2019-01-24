<?php

namespace App\Http\Controllers\API;

use App\Design;
use Illuminate\Http\Request;
use App\Http\Controllers\API\ApiController as ApiController;

class DesignController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get all the designs
        $designs = Design::where('owner_id', auth()->id())->get();

        return $this->sendResponse($designs->toArray(), 'Products retrieved successfully.');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // load the create form (app/views/designs/create.blade.php)

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
            'name'      => 'required',
            'number'    => 'required',
            'price'     => 'required | numeric',
            'image'     => 'required | mimes:jpeg,png,jpg | max:2048',
        ]);

        // Store image and save image path
        $imagePath = $this->storeImage($request);

        $attributes = [
            'name'  => $request->name,
            'number'=> $request->number,
            'price' => $request->price,
            'image' => $imagePath,
            'owner_id' => auth()->id(),
        ];

        // create and store by this user
        $design = Design::create($attributes);

        return $this->sendResponse($design->toArray(), 'Design saved successfully');

    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function show(Design $design)
    {
        if (! $design) {
            return $this->respondNotFound('Design does not exist');
        }

        // only show this design if it belongs to current user
        // TODO: need to refactor into it's own method
        if ($design->owner_id !== auth()->id()) {
            return $this->respondNotFound('Design does not exist');
        }

        return $this->sendResponse($design->toArray(), 'Design retrieved successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function edit(Design $design)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Design $design)
    {
        // only show this design if it belongs to current user
        // TODO: need to refactor into it's own method
        if ($design->owner_id !== auth()->id()) {
            return $this->respondNotFound('Design does not exist');
        }

        // image file not required to continue the request
        $design->fill($request->except('image'));

        // Check for image, Store image and save image path
        if ($request->hasFile('image')) {
            $design['image'] = $this->storeImage($request);
        }
        $design->save();

        return $this->sendResponse($design->toArray(), 'Design updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function destroy(Design $design)
    {

        if (empty($design)) {
            return $this->respondNotFound('Design does not exist');
        }

        // only show this design if it belongs to current user
        // TODO: need to refactor into it's own method
        if ($design->owner_id !== auth()->id()) {
            return $this->respondNotFound('Design does not exist');
        }

        // delete design
        $design->delete();

        return $this->sendResponse($design, 'Design deleted successfully');
    }


    /**
     * Store the image file
     *
     * @param Request $request
     * @return string
     */
    private function storeImage(Request $request): string {
        // validate image file
        $request->validate(['image' => 'required | mimes:jpeg,png,jpg | max:2048']);

        $file = $request->file('image');
        $imageName = time() . '-' . $file->getClientOriginalName();
        $imageFolder = 'images';
        $imagePath = $imageFolder . '/' . $imageName;

        // Store image in AWS S3
        $file->storeAs($imageFolder, $imageName, 's3');

        return $imagePath;
    }
}
