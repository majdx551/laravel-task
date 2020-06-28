<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all();
        return $movies;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|min:3',
            'genre' => 'required|int|exists:genres,id',
            'description,' => 'required|string|min:6',
            'country' =>'required|string',
            'cover' => 'image'
        ]);

        $image = $request->file('image');
        $image_path = $image->store('covers','public');

        $movie = Movie::create([
            'title'=>$request->title,
            'cover'=>$image_path,
            'description'=>$request->description,
            'country'=>$request->country,

        ]);

        return $movie;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {

        $request->validate([
            'title' => 'required|string|max:255|min:3',
            'genre' => 'required|int|exists:genres,id',
            'description,' => 'required|string|min:6',
            'country' =>'required|string',
            'cover' => 'image'
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image') && $request->file('image')->isValid())
        {
            $image = $request->file('image');
            $image_path = $image->store('covers','public');
            $data['image']= $image_path;
        }



            $movie->update($data);

        return $movie;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return response()->json(['message'=>'deleted']);
    }
}
