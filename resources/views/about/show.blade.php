@extends('layouts.welcome')

@section('navbar')
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1>{{$about->judul}}</h1>
            <small>Tanggal : {{$about->created_at}}</small>
            <p>{{$about->deskripsi}}</p>
            <a href="/about/{{$about->id}}/edit" class="btn btn-primary">Edit</a>

            <form action="{{ route('about.destroy', $project->id) }}" method="POST">
            @method('DELETE')
            {{ csrf_field() }}
            <input type="hidden" name="id" value="{{ $about->id }}"> <br />
            <button type="submit" class="btn btn-danger">Delete</button>
            <a href="/about/hapus/{{$about->id}}" onclick ="return confirm('Yakin ingin menghapus?');" class="btn btn-danger">Delete 2</a>
            </form>
        </div>
    </div>
@endsection