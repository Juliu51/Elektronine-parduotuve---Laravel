@extends('layouts.app')

@section('content')
<div class="card-body">
<form style="display : inline-block" action="{{route('category.store')}}" method="post" >
@csrf
<input class="form-control m-2" type="text" name="name" placeholder="Kategorijos pavadinimas">


<select class="custom-select m-2" name="parameters[]" multiple> 
   @foreach ($parameters as $parameter)
    <option value="{{$parameter->id}}">{{$parameter->title}} | {{$parameter->data_type}}</option>
     @endforeach
                    </select>
<input type="hidden" name="category_id" value="{{$categoryId}}">
<button class="btn btn-secondary m-2" type="submit"> prideti</button>
</form>
</div>
@endsection