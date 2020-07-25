<?php

namespace App\Http\Controllers;

use App\Models\Motivation;
use Illuminate\Support\Str;
use App\Http\Requests\MotivationRequest;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;

class MotivationController extends Controller
{
    // READ
    public function index()
    {
        $motivations = Motivation::with('user', 'tags')->latest()->paginate(6);

        return view('pages.motivation', compact('motivations'));
    }

    // CREATE
    public function create()
    {
        $tags = Tag::get();
        return view('pages.motivation_create', compact('tags'));
    }

    // STORE
    public function store(MotivationRequest $request)
    {
        $data = $request->all();

        // Cek IMG
        if ($request->file('img')) {
            $img = $request->file('img');
            $data['img']  = $request->file('img')->storeAs('img_motivations', time() . '.' . $img->getClientOriginalExtension());
        } else $data['img'] = null;

        $data['slug'] = Str::slug($request->title);
        // Query Input
        $motivation =  $request->user()->motivations()->create($data);

        // Query Input Many to Many Tag
        $motivation->tags()->attach($request->tag_id);

        return redirect('motivation')->with('msg', 'Motivation Successfully add');
    }

    // SHOW
    public function show($slug)
    {
        $tags = Tag::get();
        $motivation =  Motivation::with('user', 'tags')->where('slug', $slug)->first();
        return view('pages.motivation_show', compact('tags', 'motivation'));
    }

    // EDIT
    public function edit($slug)
    {
        $tags = Tag::get();
        $motivation = Motivation::where('slug', $slug)->first();
        // Cek Author Cara Lama
        // if (!$motivation->author()) {
        //     return 'Anda tidak memiliki akses';
        // }

        // Cek Authorization Policy
        $this->authorize('update', $motivation);

        return view('pages.motivation_edit', compact('tags', 'motivation'));
    }

    // UPDATE
    public function update(MotivationRequest $request, $id)
    {
        $data = $request->all();
        $motivation = Motivation::findOrFail($id);
        // Cek Author
        // if (!$motivation->author()) {
        //     return redirect('motivation')->with('msg', 'Access Failed');
        // }

        // Cek Authorization Policy
        $this->authorize('update', $motivation);

        // Cek IMG
        if ($request->file('img')) {

            Storage::delete($motivation->img);
            $img = $request->file('img');
            $data['img']  = $request->file('img')->storeAs('img_motivations', time() . '.' . $img->getClientOriginalExtension());
        } else $data['img'] = null;

        $data['slug'] = Str::slug($request->title);

        // Query Update
        $motivation->update($data);

        // Query Update Many to Many Tag
        $motivation->tags()->sync($request->tag_id);

        return redirect('motivation')->with('msg', 'Motivation Successfully Updated');
    }

    // DELETE
    public function destroy($id)
    {
        $motivation = Motivation::findOrFail($id);

        // Cek Authorization Policy
        $this->authorize('delete', $motivation);

        Storage::delete($motivation->img);
        $motivation->destroy($id);

        return redirect('motivation')->with('msg', 'Motivation Succsess Delete');
    }
}
