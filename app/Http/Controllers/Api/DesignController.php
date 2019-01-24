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

        return response()->json($design, 200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Design  $design
     * @return \Illuminate\Http\Response
     */
    public function destroy(Design $design)
    {
        //
    }
}
