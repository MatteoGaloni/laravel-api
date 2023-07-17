@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="row justify-content-between">
            @foreach ($projects as $project)
                <div class="card p-0 mb-4" style="width: 18rem;">
                    @if (str_contains($project->img, 'http'))
                        <img class="card-img-top" src="{{ $project->img }}" alt="{{ $project->title }}">
                    @else
                        <img class="card-img-top"
                            src="{{ $project->img ? asset('storage/' . $project->img) : 'https://www.pulsecarshalton.co.uk/wp-content/uploads/2016/08/jk-placeholder-image.jpg' }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $project->title }}</h5>
                        <p class="card-text">{{ $project->description }}</p>
                        <h5>Tipo: {{ $project->type->name }}</h5>
                        <h5>Tecnologia:</h5>
                        <ul>
                            @foreach ($project->technologies as $technology)
                                <li>{{ $technology->name }}</li>
                            @endforeach
                        </ul>

                        <a href='{{ route('admin.projects.show', $project) }}' class="btn btn-primary">Show Project</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
