<?php

namespace App\Http\Controllers;
use App\Models\About;

use Illuminate\Http\Request;


class AboutController extends Controller
{
    public function index()
    {
        $data = array(
            'id' => "about",
            'about' => About::orderBy('created_at', 'desc')->paginate(10)
        );
        return view('about.about')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('about.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate($request, [
            'gambar' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required'
        ]);
        $about = new About;
        $about->gambar = $request->input('gambar');
        $about->judul = $request->input('judul');
        $about->deskripsi = $request->input('deskripsi');
        $about->save();

        return redirect('about')->with ('success', 'Berhasil menambah data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return Post::find($id);
        $data = array(
            'id' => "about",
            'about' => About::find($id)
        );
        return view('about.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = array(
            'id' => "about",
            'about' => About::find($id)
        );
        return view('about.edit')->with($data);
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
        About::where('id', $request->id)->update([
            'gambar'=>$request->gambar,
            'judul'=>$request->judul,
            'deskripsi'=>$request->deskripsi
        ]);
        return redirect('about');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $about = About::find($id);
        $about->delete();
        return redirect('about')->with('success', 'Berhasil menghapus data');
    }

    public function hapus($id)
    {
        $about = About::find($id);
        $about->delete();
        return redirect('/about')->with('success', 'Berhasil menghapus data');
    }
}
