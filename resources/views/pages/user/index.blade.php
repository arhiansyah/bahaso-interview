@extends('master')

@section('konten')
@if (Auth::user())
    @if (Auth::user()->hasRole[0]->name == "Visitor")
        
    @else
    
    @endif
    
@endif
  <div class="row">
      <div class="col-12">
          <ul class="list-group mt-3">
            @foreach ($user as $key => $usr)
            <div class="d-flex d-flex-between">
                <div class="col-8">
                    <h5>{{ $usr->name }}</h5>
                    <p>{{ $usr->email }}</p>
                </div>
                <div class="col-4">
                    <a href="{{ route('user.edit', $usr->id) }}" class="btn btn-primary">
                        Edit
                    </a>
                </div>
            </div>  
            @endforeach
        </ul> 
      </div>
  </div>
@endsection