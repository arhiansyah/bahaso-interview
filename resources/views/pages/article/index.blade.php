@extends('master')

@section('konten')
  <div class="row">
      <div class="col-12">
        @if (Auth::user())
            @if (Auth::user()->hasRole[0]->name == "Author")
                <div class="">
                    <a href="{{ route('article.create') }}" class="btn btn-primary">
                        Create
                    </a>
                </div>    
                <ul class="list-group mt-3" id="ul-author">
                   
                </ul>
            @else
                <ul class="list-group mt-3" id="ul-visitor">
                
                </ul>
            @endif
        @endif 
      </div>
  </div>
@endsection
@section('script')
<script>
    $(document).ready(function(){
        $.get("api/article", function(data, status){
            console.log(data.data);
            $.each(data.data, function(index, item){
                console.log(item.id);
                $("#ul-author").append(
                    `
                    <li class="list-group-item">
                        <div class="d-flex d-flex-between">
                            <div class="">
                                <h5>`+ item.title +`</h5>
                                <p>` + item.description + `</p>
                                <a href="article/`+item.id+`" class="btn btn-primary">Detail</a>
                            </div>
                        </div>
                    </li> 
                    `
                )
                $("#ul-visitor").append(
                    `
                    <li class="list-group-item">
                        <div class="d-flex d-flex-between">
                            <div class="">
                                <h5>`+ item.title +`</h5>
                                <p>` + item.description + `</p>
                            </div>
                        </div>
                    </li> 
                    `
                )
            })
        });
    });
</script>    
@endsection