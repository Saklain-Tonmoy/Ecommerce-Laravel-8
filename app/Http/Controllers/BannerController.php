<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd('hello');
        return view('backend.banners.index');
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.banners.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'string|required',
            'description'=>'string|required',
            'photo'=>'string|required',
            'condition'=>'nullable|in:banner,promote',
            'status'=>'nullable|in:active,inactive'
        ]);

        $data = $request->all();
        $slug = Str::slug($request->input('title', '-'));   // this line of code is converting the title into slug, and seperating the words by '-'
        $data['slug'] = $slug;    // inserting the $slug into $data
        $status = false;
        try{
            $status = Banner::create($data);    // $status variable is storing a boolean value
        }catch(Exception $e) {
            //return $e->getMessage();
            //return back()->with('exception', $e->getMessage());
        }

        if($status) {
            return redirect()->route('banner.index')->with('success', 'Successfully created banner.');
        }
        else{
            return back()->with('error', 'Something went wrong!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        //
    }
}
