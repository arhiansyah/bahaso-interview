@extends('master')

@section('konten')
    @if (Auth::user())
        @if (Auth::user()->hasRole[0]->name == "Visitor")
            <script> document.location.href = "/article"; </script>
        @endif
    @endif
    <div class="row">
        <div class="col-12 mb-4 mt-2">
            <h3>Update Article</h3>
        </div>
        <div class="col-12">
            <form id="formModal" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" class="id" id="{{ $id }}" value="{{ $id }}">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" id="">
                <div class="row" id="row">
                    {{-- <div class="col-6">
                        <div class="form-group @error('title') has-error @enderror">
                            <label for="exampleFormControlInput1" class="form-label">Judul Article</label>
                            <input type="text" class="form-control" name="title" id="exampleFormControlInput1" value="{{ old('title') }}" placeholder="input your title film">       
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group @error('tag') has-error @enderror">
                            <label for="tag" class="d-block mb-2">Hastag</label>
                            <input type="text" name="tag" autofocus id="tag" value="{{ old('tag') }}"
                                placeholder="Input tag your film" class="form-control tagsinput w-100 h-100"
                                data-role="tagsinput">
                        </div>
                    </div> 
                    <div class="col-12 mt-3">
                        <div class="form-group @error('description') has-error @enderror">
                            <label for="description" class="d-block mb-3">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="5">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group @error('cover') has-error @enderror">
                            <div class="row">
                                <div class="col-6">
                                    <label for="cover" class="d-block">Cover</label>
                                    <input type="file" name="cover" id="cover" class="form-control" value="{{ old('cover') }}" id="cover">
                                </div>
                                <div class="col-4 mt-3">
                                    <button type="button" class="btn btn-primary mt-2" id="btnImage">Save</button>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <button class="w-100 btn btn-primary mt-5 mb-5" id="btnSubmit" type="button">Submit Data</button>
            </form>
        </div>
    </div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        let imageFile;
        let id =  $(".id").attr('id')
        $.get("{{ url('api/article') }}/" + id, function(data, status){
                let result = data.data[0];
                $("#row").append(
                    `
                    <div class="col-6">
                        <div class="form-group @error('title') has-error @enderror">
                            <label for="exampleFormControlInput1" class="form-label">Judul Article</label>
                            <input type="text" class="form-control" name="title" id="exampleFormControlInput1" value="{{ old('title', '`+ result.title +`') }}" placeholder="input your title film">       
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group @error('tag') has-error @enderror">
                            <label for="tag" class="d-block mb-2">Hastag</label>
                            <input type="text" name="tag" autofocus id="tag" value="{{ old('tag', '`+ result.tag +`') }}"
                                placeholder="Input tag your film" class="form-control tagsinput w-100 h-100"
                                data-role="tagsinput">
                        </div>
                    </div> 
                    <div class="col-12 mt-3">
                        <div class="form-group @error('description') has-error @enderror">
                            <label for="description" class="d-block mb-3">Deskripsi</label>
                            <textarea name="description" class="form-control" rows="5">{{ old('description', '`+ result.description +`') }}</textarea>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group @error('cover') has-error @enderror">
                            <div class="row">
                                <div class="col-6">
                                    <img src="{{ url('image') }}/`+ result.cover +`" class="rounded w-100"
                                            alt="alt">
                                    <label for="cover" class="d-block">Cover</label>
                                    <input type="file" name="cover" id="cover" class="form-control" value="{{ old('cover') }}" id="cover">
                                </div>
                                <div class="col-4 mt-3">
                                    <button type="button" class="btn btn-primary mt-2" id="btnImage">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    `
                )
            
        });
        $("#cover").on('change',function(event) {
            const files = event.target.files;
            imageFile = files[0]                  
        })
        $("#btnSubmit").click(function(){
            // console.log(dataForm['id'])
            let postData = new FormData($("#formModal")[0])        
            // console.log(cover);
            $.ajax({
                url: '{{ url("api/article/update") }}/'+id,
                method: "POST",
                data: postData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    document.location.href = "{{ url('/article') }}/"+id
                },
                error: function (error) {
                    console.log(error)
                }
            });
        })
    })
</script>
@endsection
