<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Insight;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class InsightController extends Controller
{
    public function index()
    {
        $data = array(
            'id' => "insight",
            'insight' => Insight::orderBy('created_at', 'desc')->paginate(10)
        );
        return view('insight.insight')->with($data);
    }

    public function create()
    {
        return view('insight.create');
    }

    public function store(Request $request)
    {
        $this -> validate($request, [
            'judul' => 'required',
            'deskripsi' => 'required',
            'picture' => 'image|nullable'
        ]);
        $insight = new Insight;
        $insight->judul = $request->input('judul');
        $insight->deskripsi = $request->input('deskripsi');
        if ($request->hasFile('picture')){
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('picture')->storeAs('public/posts_image', $filenameSimpan);
        }
        else{
            $filenameSimpan = 'noimage.png';
        }
        $insight->picture = $filenameSimpan;
        $insight->save();

        return redirect('insight')->with ('success', 'Berhasil menambah data');
    }

    public function show($id)
    {
        // return Post::find($id);
        $data = array(
            'id' => "insight",
            'insight' => Insight::find($id)
        );
        return view('insight.show')->with($data);
    }

    public function edit($id)
    {
        $data = array(
            'id' => "insight",
            'insight' => Insight::find($id)
        );
        return view('insight.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $insight = Insight::find($id);
        $insight->judul = $request->input('judul');
        $insight->deskripsi = $request->input('deskripsi');
        if ($request->hasFile('picture')){
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('picture')->storeAs('public/posts_image', $filenameSimpan);
        }
        else{
            $filenameSimpan = 'noimage.png';
        }
        $insight->picture = $filenameSimpan;

        $insight->update();
        return redirect('insight');
    }

    public function destroy($id)
    {
        $insight = Insight::find($id);
        $insight->delete();
        return redirect('/insight')->with('success', 'Berhasil menghapus data');
    }
}
