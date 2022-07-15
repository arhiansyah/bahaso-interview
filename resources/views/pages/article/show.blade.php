@extends('master')
@section('konten')
    @if (Auth::user())
        @if (Auth::user()->hasRole[0]->name == "Visitor")
            <script> document.location.href = "/article"; </script>
        @endif
    @endif
<div class="row">
    <div class="col-12 columnThis" id="{{$id}}">
        <a href="{{ route('article.index') }}"><button class="btn btn-primary mb-3">Back</button></a>
        <div class="card">
            <div class="card-header" id="ch">
                
            </div>
            <div class="card-body" id="cb">

            </div> 
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        let id =  $(".columnThis").attr('id')
        console.log(id);
        $.get("{{ url('api/article') }}/" + id, function(data, status){
            $.each(data.data, function(index, item){
                console.log(item.id);
                $("#ch").append(
                    `
                        <h3 class="text-dark">Detail `+ item.title +`</h3>
                        <div id="toggle">
                            <a href="{{ url('article/`+item.id+`/edit') }}" class="btn btn-warning mr-2">Edit</a>
                            <form id="formModal" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <button type="button" class="btn btn-danger btnDeleteRecord">Delete</button>
                            </form>
                        </div>
                    `
                )
                $("#cb").append(`
                <div class="row mb-3" id="showID">
                    <div class="col-12">
                        <img style="width:40%;" src="{{ url('image') }}/`+ item.cover +`" alt="img">
                    </div>
                    <div class="col-6">
                        <span>Judul Article</span>
                        <h1 class="h1 fw-bold">`+ item.title +`</h1>
                    </div>
                    <div class="col-6">
                        <span>Code Uniq Article</span>
                        <h1 class="h1 fw-bold">`+ item.article_code +`</h1>
                    </div>
                    <div class="col-6">
                        <span>Deskripsi</span>
                        <h1 class="h1 fw-bold">`+ item.description +`</h1>
                    </div>
                    <div class="col-6">
                        <span>Tag</span>
                        <h1 class="h1 fw-bold">`+ item.tag +`</h1>
                    </div>
                </div>   
                `)
                
            })
            $(".btnDeleteRecord").click(function(){
                let postData = new FormData($("#formModal")[0])
                $.ajax({
                    url: '{{ url("api/article/delete") }}/'+id,
                    method: "POST",
                    data: postData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        console.log(response);
                        // location.href("{{ route('article.index') }}")
                    },
                    error: function (error) {
                        console.log(error)
                    }
                });
   
            }); 
        });
    });
</script>        
@endsection