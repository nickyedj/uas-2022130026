@extends('layouts.app')

@section('content')
    <div class="container">
        <main>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form action="{{ route('artists.update',$artist) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="row">
                    <div class="col-12">
                        <label class="form-label" for="name">Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" value="{{old('name',$artist->name)}}">
                    </div>
                    <b5-col>
                        <label class="form-label" for="bio"> Bio</label>
                        <textarea class="form-control @error('bio') is-invalid @enderror" type="text" id="bio" name="bio" rows="2">{{old('bio',$artist->bio)}}</textarea>
                    </b5-col>
                    <button class="btn btn-primary mt-3" type="submit"> Update </button>
                </div>
            </form>
        </main>
    </div>
@endsection
