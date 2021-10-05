@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">Atnaujinti</div>

            <div class="card-body">
               <form method="POST" action="{{route('category.update',$category)}}" enctype="multipart/form-data">
                  <div class="form-group">
                      <label>Pavadinimas</label>
                      <input type="text" name="name" value="{{$category->name}}" class="form-control">
                  </div>

                  <div class="form-group">
                     <label>Kuriai Kategorijai priskirti?</label>
                     <select class="custom-select" name="category_id">
                     <option value="0">Pagrindine kategorija</option>
                        @foreach ($categories as $categoriesOne)
                            <option value="{{$categoriesOne->id}}" @if($categoriesOne->id == $category->category_id) selected="selected" @endif> {{$categoriesOne->name}}</option>
                        @endforeach

                     </select>
                 </div>

                 <div class="form-group">
                    <label>Kategorijos parametrai</label>
                    <select class="custom-select" name="parameters[]" multiple>

                    @foreach ($parameters as $parameter)
<option value="{{$parameter->id}}" @if ( in_array($parameter->id,$catIds )) selected="selected" @endif>{{$parameter->title}}, {{$parameter->data_type}}</option>
@endforeach
                    </select>
                </div>

                  @csrf
                  <button class="btn btn-success" type="submit">EDIT</button>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
