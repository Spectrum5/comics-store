<?php

namespace App\Http\Controllers\Admin;

// controller
use App\Http\Controllers\Controller;

// utilities
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Models\Comic;
use App\Http\Requests\StorecomicsRequest;
use App\Http\Requests\UpdatecomicsRequest;

class ComicsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comics = Comic::all();

        return view('admin.comics.index', [
            'comics' => $comics
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.comics.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorecomicsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorecomicsRequest $request)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        if (array_key_exists('image', $data)) {
            $imagePath = Storage::put('comics', $data['image']);
            $data['image'] = $imagePath;
        }

        $newComic = Comic::create($data);

        return redirect()->route('admin.comicss.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\comics  $comics
     * @return \Illuminate\Http\Response
     */
    public function show(Comic $comics)
    {
        return view('admin.comics.show', compact('comics'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\comics  $comics
     * @return \Illuminate\Http\Response
     */
    public function edit(Comic $comics)
    {
        return view('admin.comics.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatecomicsRequest  $request
     * @param  \App\Models\comics  $comics
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatecomicsRequest $request, Comic $comics)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        if (array_key_exists('delete-image', $data)) {
            if ($comics->img) {
                Storage::delete($comics->image);
                $comics->image = null;
                $comics->save();
            }
        }
        else if (array_key_exists('image', $data)) {
            $imagePath = Storage::put('projects', $data['image']);
            $data['image'] = $imagePath;

            if ($comics->image) {
                Storage::delete($comics->image);
            }
        }

        $comics->update($data);
        
        return redirect()->route('admin.comics.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\comics  $comics
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comic $comics)
    {
        if ($comics->image) {
            Storage::delete($comics->image);
        }

        $comics->delete();

        return redirect()->route('admin.comics.index');
    }
}
