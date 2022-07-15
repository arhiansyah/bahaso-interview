@extends('master')

@section('konten')
    @if (Auth::user())
        @if (Auth::user()->hasRole[0]->name == "Visitor")
            <script> document.location.href = "/article"; </script>
        @endif
    @endif    
    <div class="row">
        <div class="col-12 mb-4 mt-2">
            <h3>Update User</h3>
        </div>
        <div class="col-12">
            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1" class="form-label">Change Role</label>
                            <select class="form-control" name="role" id="">
                                @foreach ($role as $roles)
                                    @if ($user->hasRole[0]->id == $roles->id)
                                        <option selected value="{{ $roles->id }}">{{ $roles->name }}</option>
                                    @else
                                        <option value="{{ $roles->id }}">{{ $roles->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button class="w-100 btn btn-primary mt-5 mb-5" id="btnSubmit" type="submit">Submit Data</button>
            </form>
        </div>
    </div>
@endsection