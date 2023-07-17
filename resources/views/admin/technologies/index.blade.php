@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-between">
            @foreach ($technologies as $technology)
                <div class="card p-0 mb-4" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $technology->name }}</h5>
                    </div>
                    <form id="form" action="{{ route('admin.technologies.destroy', $technology) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary">Rimuovi</button>
                    </form>
                </div>
            @endforeach
        </div>
    </div>
@endsection
