@extends('layouts.admin')

@section('content')
    <h1 class="text-white text-center">Create Project</h1>
    @if ($errors->any())
        <div class="alert-danger alert">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif


    <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation">
        @csrf

        <div class="form-group">
            <label class="text-white" for="title">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" id="title"
                class="form-control @error('title') is-invalid" @enderror>
        </div>


        <div class="form-group">
            <label class="text-white" for="type_id">Categoria</label>
            <select class="form-select" name="type_id">
                <option selected disabled>Choose project type</option>
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="d-flex justify-content-around">
            @foreach ($technologies as $i => $technology)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="technologies[]" value="{{ $technology->id }}"
                        id="technologies{{ $i }}">
                    <label class=" text-white form-check-label" for="technologies{{ $i }}">
                        {{ $technology->name }}
                    </label>
                </div>
            @endforeach
        </div>


        <div class="form-group">
            <label class="text-white" for="description">Description</label>
            <textarea name="description" id="description" class="form-control" cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label class="text-white" for="img">Inserisci un file</label>
            <input type="file" name="img" class="form-control" id="img">
        </div>

        <button type="submit" class="btn btn-primary my-4">Submit</button>

    </form>
@endsection
