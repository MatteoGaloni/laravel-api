@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-5">
            <h1 class="text-white text-center m-4">Create Technology</h1>
            @if ($errors->any())
                <div class="alert-danger alert">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('admin.technologies.store') }}" method="POST" class="needs-validation">
                @csrf
                <div class="form-group">
                    <label for="name">Title</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" id="name">
                </div>
                <button type="submit" class="btn btn-primary my-4">Add</button>
            </form>
        </div>
    </div>
</div>
@endsection
