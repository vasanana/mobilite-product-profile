@extends('layouts.welcome')

@section('navbar')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1>Edit About</h1>
            <form action="{{ route('about.update', $project->id) }}" method="POST">
            @method('PUT')
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="gambar">Gambar</label>
                    <input type="file" class="form-control" name="gambar" value="{{$about->gambar}}>
                </div>
                <div class="form-group">
                    <label for="judul">Judul</label>
                    <input type="text" class="form-control" id="judul" aria-describedby="emailHelp" name="judul" value="{{$about->judul}}">
                </div>
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea class="form-control" id="deskripsi" rows="5" name="deskripsi">{{$about->deskripsi}}</textarea>
                </div>
                <input type="hidden" name="id" value="{{ $about->id }}"><br/>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection