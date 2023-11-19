<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\FAQ;

class FAQController extends Controller
{
    public function index()
    {
        $data = array(
            'id' => "faq",
            'faq' => FAQ::orderBy('created_at', 'desc')->paginate(10)
        );
        return view('FAQ.FAQ')->with($data);
    }

    public function create()
    {
        return view('FAQ.create');
    }

    public function store(Request $request)
    {
        $this -> validate($request, [
            'pertanyaan' => 'required',
            'jawaban' => 'required',
        ]);
        $faq = new FAQ;
        $faq->pertanyaan = $request->input('pertanyaan');
        $faq->jawaban = $request->input('jawaban');
        $faq->save();

        return redirect('FAQ')->with ('success', 'Berhasil menambah data');
    }

    public function show($id)
    {
        // return Post::find($id);
        $data = array(
            'id' => "faq",
            'faq' => FAQ::find($id)
        );
        return view('FAQ.show')->with($data);
    }

    public function edit($id)
    {
        $data = array(
            'id' => "faq",
            'faq' => FAQ::find($id)
        );
        return view('FAQ.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $faq = FAQ::find($id);
        $faq->pertanyaan = $request->input('pertanyaan');
        $faq->jawaban = $request->input('jawaban');
        $faq->update();
        return redirect('FAQ');
    }

    public function destroy($id)
    {
        $faq = FAQ::find($id);
        $faq->delete();
        return redirect('/FAQ')->with('success', 'Berhasil menghapus data');
    }
}
