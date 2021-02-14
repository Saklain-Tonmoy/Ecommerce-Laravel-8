<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
//use Illuminte\Support\Facades\DB;
use DB;

class BannerController extends Controller
{
    protected function validateData()
    {
        return request()->validate([
            'title'=>'string|required',
            'description'=>'string|required',
            'photo'=>'string|required',
            'condition'=>'nullable|in:banner,promote',
            'status'=>'nullable|in:active,inactive'
        ]);
    }
    public function index()
    {
        //dd('hello');
        $banners = Banner::orderBy('id', 'DESC')->get();
        return view('backend.banners.index', compact('banners'));
        
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
    public function show($id)
    {
        $banner = Banner::findorfail($id);
        return response()->json($banner);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::findorfail($id);
        if($banner) {
            return view('backend.banners.edit', compact('banner'));
        }
        else {
            return back()->with('error', 'Data not found');
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $banner = Banner::findorfail($id);
        if($banner) {
            $this->validateData();
            $data = $request->all();
            $status = $banner->fill($data)->save();

            if($status) {
                return redirect()->route('banner.index')->with('success', "Successfully updated banner.");
            }
            else {
                return back()->with('error', "Something went wrong!");
            }

        }
        else {
            return back()->with('error', 'Data not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::findorfail($id);
        if($banner) {
            $status = $banner->delete();
            if($status) {
                return redirect()->route('banner.index')->with('success', "Successfully deleted banner.");
            }
            else {
                return back()->with('error', "Data not found");
            }
        }
        else {
            return back()->with('error', 'Data not found');
        }
    }

    public function bannerStatus(Request $request) {
        //dd($request->all());

        if($request->mode == 'true') {
            //DB::table('banners')->where('id', $request->id)->update(['status' => 'active']);
            Banner::where('id', $request->id)->update(['status' => 'active']);
        }
        else {
            //DB::table('banners')->where('id', $request->id)->update(['status' => 'inactive']);
            Banner::where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Successfully updated status', 'status' => true]);
    }
}
