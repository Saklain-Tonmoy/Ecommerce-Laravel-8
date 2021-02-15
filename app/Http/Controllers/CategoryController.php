<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\Console\Descriptor\Descriptor;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('backend.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'string|required',
            'summary' => 'string|nullable',
            'is_parent' => 'sometimes|in:1',
            'photo' => 'string|required',
            'parent_id' => 'nullable',
            'status' => 'nullable|in:active,inactive'
        ]);

        $data = $request->all();
        $slug = Str::slug($request->input('title', '-'));
        $data['slug'] = $slug;
        $status = false;

        try {

            $status = Category::create($data);

        }
        catch (Exception $e) {

        }

        if($status) {
            return redirect()->route('category.index')->with('success', "Successfully created category.");
        }
        else {
            return back()->with('error', "Something went wrong.");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findorfail($id);
        if($category) {
            $status = $category->delete();
            if($status) {
                return redirect()->route('category.index')->with('success', "Successfully deleted category.");
            }
            else {
                return back()->with('error', "Data not found");
            }
        }
        else {
            return back()->with('error', 'Data not found');
        }
    }

    public function categoryStatus(Request $request) {
        if($request->mode == 'true') {
            //DB::table('banners')->where('id', $request->id)->update(['status' => 'active']);
            Category::where('id', $request->id)->update(['status' => 'active']);
        }
        else {
            //DB::table('banners')->where('id', $request->id)->update(['status' => 'inactive']);
            Category::where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Successfully updated status', 'status' => true]);
    }
}
