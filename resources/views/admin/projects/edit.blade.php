@extends('layouts.admin')


@section('content')
    <h1 class="text-white">EDIT PROJECT</h1>
    @if ($errors->any())
        <div class="alert-danger alert">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
    <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data"
        class="needs-validation">
        @csrf
        @method('PUT')
        <div class="form-group text-white">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title"
                value='{{ old('title') ? old('title') : $project->title }}'>
        </div>

        <div class="form-group">
            <label class="text-white" for="type_id">Tipi</label>
            <select class="form-select" name="type_id">
                <option disabled>Choose project type</option>
                @foreach ($types as $type)
                    @if ($project->type != null)
                        <option @selected($type->id == $project->type->id) value="{{ $type->id }}">{{ $type->name }}</option>
                    @else
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        @foreach ($technologies as $i => $technology)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="technologies[]" value="{{ $technology->id }}"
                    id="technologies{{ $i }}">
                <label class="text-white form-check-label" for="technologies{{ $i }}">
                    {{ $technology->name }}
                </label>
            </div>
        @endforeach

        <div class="form-group">
            <label class="text-white" for="description">Description</label>
            <textarea name="description" id="description" class="form-control" cols="30" rows="10">{{$project->description}}</textarea>
        </div>
        <div class="mt-2">
            <img src="{{asset('storage/' . $project->img)}}" alt="">
            <figcaption class="text-white">Current Image</figcaption>
        </div>
        <div class="form-group">
            <label class="text-white" for="img">URL IMG</label>
            <input type="file" class="form-control" name="img" id="img">
        </div>

        <button type="submit" class="btn btn-primary my-4">Submit</button>

    </form>
@endsection
