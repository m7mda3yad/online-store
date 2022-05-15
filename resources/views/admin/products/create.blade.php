@extends('layouts.app')

@section('content')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
            <div class="col-sm-3">
                {{--  <button type="button" class="btn btn-block btn-primary " data-toggle="modal" data-target="#modal-lg">{{ trans('cruds.add') }} {{trans('cruds.filter') }}</button>  --}}
            </div>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">{{ trans('cruds.home') }}</a></li>
            <li class="breadcrumb-item active">{{ trans('cruds.products') }}</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
                <div class="card card-primary">
                    <div class="card-header">
                    <h3 class="card-title">{{trans('cruds.add')}} {{trans('cruds.products')}}</h3>
                    </div>

                    <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">{{ trans('cruds.name') }}</label>
                                <div class="col-sm-8">
                                  <input type="text" class="form-control"  name="name">
                                </div>
                                @error('name')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">{{ trans('cruds.price') }}</label>
                                <div class="col-sm-8">
                                  <input type="number" class="form-control"  name="price">
                                </div>
                                @error('price')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">{{ trans('cruds.real_price') }}</label>
                                <div class="col-sm-8">
                                  <input type="number" class="form-control"  name="real_price">
                                </div>
                                @error('real_price')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">{{ trans('cruds.amount') }}</label>
                                <div class="col-sm-8">
                                  <input type="number" class="form-control"  name="amount">
                                </div>
                                @error('amount')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                                    <input type="hidden" value="{{ $subCategory->id }}" name="sub_category_id">

                            <div class="form-group row">
                                <label  class="col-sm-2 col-form-label">{{ trans('cruds.description') }}</label>
                                <div class="col-sm-8">
                                    <textarea  name="description"class="form-control"> </textarea>
                                </div>
                                @error('description')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="form-group row">
                                    <label  class="col-sm-2 col-form-label">{{ trans('cruds.photo') }}</label>
                                    <div class="col-sm-4">
                                        <input type="file" class="form-control" name="photo">
                                    </div>
                                    @error('photo')<div class="text-danger">{{ $message }}</div> @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{trans('cruds.submit')}}</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</section>











<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">{{ trans('cruds.add') }} {{trans('cruds.products') }}</h3>
                </div>
                     <div class="row">
                        @foreach ($subCategory->filters as $filters)
                        <div class="col-3">
                            <label >{{ $filters->name }}</label>
                            <select class="form-control"  id="filter[]">
                                <option value="">filter</option>
                                @foreach ($filters->sub_filters as $subfilter)
                                    <option value="{{$subfilter->id}}">{{$subfilter->name}}</option>
                                @endforeach
                            </select>
                        </div>
                            @endforeach
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('cruds.close') }}</button>
                        <button type="button" onclick="addFilter()" class="btn btn-primary">{{ trans('cruds.add') }}</button>
                    </div>
             </div>
        </div>
      </div>
    </div>
</div>

<script>
    var count = 0;
    function addFilter(){
        var filters = document.querySelectorAll('select[id="filter[]"]');
         var arr=[];
         for(i=0;i<filters.length;i++)
         arr.push(filters[i].value)
         let url = new URL("{{route('get_filters')}}")
         url.search = new URLSearchParams({
             id: arr,
         })

         fetch(url)
         .then(response => response.json())
         .then(result =>{
             console.log(result);
             for(i=0;i<result.length;i++){
                var x = document.createElement("LABEL");
                x.setAttribute("class", "badge-primary badge-pill col-3");
                var y = document.createTextNode(result[i].filter.name+' ');x.appendChild(y);add(x);
                var y = document.createTextNode(result[i].name);x.appendChild(y);add(x);
                myFun('filter['+count+'][]',result[i].id,'hidden');
            }
            myFun('price['+count+'][]',0,'number');
            myFun('amount['+count+'][]',0,'number');
            } )
         .catch(error => {
           alert(error);
       });
       count++;

    }

    function myFun(name,value,type) {
                    var x = document.createElement("INPUT");
                        x.setAttribute("type", type);
                        x.setAttribute("name", name);
                        x.setAttribute("value", value);
                        x.setAttribute("class", "form-control col-3");
                        add(x);
            }
    function add(x) {
        var div = document.getElementById("after");
        div.parentNode.insertBefore(x, div);
    }


</script>


@endsection
