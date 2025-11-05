<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;
class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Genre::all();
        return view('admincp.genre.index', compact('list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('admincp.genre.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
             'title' => 'required|string|max:255|unique:genres',
             'slug' => 'required|string|max:255|unique:genres',
             'description' => 'required',
             'status' => 'required',
            ],

            [
             'title.required'=>'Vui lòng nhập tên',
             'title.unique'=>'Tên đã có vui lòng nhập tên khác',
             'slug.required'=>'Vui lòng nhập slug',
             'slug.unique'=>'Slug đã có vui lòng nhập tên khác',

             'description.required'=>'Vui lòng nhập mô tả'
            ],
         );

        $genre = new Genre();
        $genre->title = $data['title'];
        $genre->slug = $data['slug'];
        $genre->description = $data['description'];
        $genre->status = $data['status'];
        $genre->save();
        return redirect()->back();
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
        $genre = Genre::find($id);
        $list = Genre::all();
        return view('admincp.genre.form', compact('list','genre'));
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
        $data = $request->validate(
            [
             'title' => 'required|string|max:255|unique:genres',
             'slug' => 'required|string|max:255|unique:genres',
             'description' => 'required',
             'status' => 'required',
            ],

            [
             'title.required'=>'Vui lòng nhập tên',
             'title.unique'=>'Tên đã có vui lòng nhập tên khác',
             'slug.required'=>'Vui lòng nhập slug',
             'slug.unique'=>'Slug đã có vui lòng nhập tên khác',

             'description.required'=>'Vui lòng nhập mô tả'
            ],
         );

        $genre = Genre::find($id);
        $genre->title = $data['title'];
        $genre->slug = $data['slug'];
        $genre->description = $data['description'];
        $genre->status = $data['status'];
        $genre->save();
        return redirect()->route('genre.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Genre::find($id)->delete();
        return redirect()->back();
    }
}
