@extends('layouts.app')
@section('content')
<div class="container">
@if(Auth::user()->isAdmin())
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Admino panelė
            </div>
            <div class="card-body">
                @if ((count($chain) > 0))

                <a style="font-size:20px" href="{{route('item.create',[ $chain[count($chain)-1] ] )}}">Įdėti prekę į "{{$chain[count($chain)-1]->name}}" kategoriją</a>
              <br>
                <?php $category = $chain[count($chain) - 1]?>
               @else
               <?php $category = 0?>
                @endif
                <a style="font-size:20px" href="{{route('category.create',[$category] )}}">Sukurti kategorija siame gylije</a>
            </div>
        </div>
    </div>
</div>
@endif
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">
            <h1>{{(count($chain) > 0)?$chain[count($chain)-1]->name :""}}</h1>
        </div>
        <div class="card-header">
            @if (count($chain)== 0)
                HOME
            @endif
             @foreach ($chain as $item)
             @if(next($chain))
                  <a class="chain" href="{{route('category.map',$item)}}"> {{$item->name}} ></a>
                 @else
                  <a class="chain chain-last" href="{{route('category.map',$item)}}"> {{$item->name}} </a>
                 @endif
             @endforeach
         </div>

        <div class="card-body">
        <table class="table table-striped">
            <tbody>
            @foreach ($categories as $category)
            <tr>
              <td class=""> <a href="{{route('category.map',$category)}}"> {{$category->name}}</a></td>
              {{-- <td class="align-middle text-center">{{$parameter->data_type}}</td> --}}
              @if(Auth::user()->isAdmin())
              <td class="align-middle text-center">
                <a class="btn btn-primary" href="{{route('category.edit',[$category])}}">EDIT</a>
                <form style="display: inline-block" method="POST" action="{{route('category.destroy', $category)}}">
                    @csrf
                    <button class="btn btn-danger" type="submit">DELETE</button>
                  </form>
              </td>
              @endif
            </tr>
            @endforeach
            </tbody>
          </table>
        </div>

        <div class="card-body">
        <table class="table table-striped">
            <tbody>
              @if (isset($item))
            @foreach ($items as $item)
            <tr>
             <td>{{$item->name}}<td>
              <td class="align-middle text-center">
              <a class="btn btn-secondary" href="{{route('item.show',[$item])}}">SHOW</a>
                <a class="btn btn-primary" href="{{route('item.edit',[$item,$chain[count($chain)-1]])}}">EDIT</a>
                <form style="display: inline-block" method="POST" action="{{route('item.destroy', [$item])}}">
                    @csrf
                    <button class="btn btn-danger" type="submit">DELETE</button>
                  </form>
              </td>
            </tr>
            @endforeach
            </tbody>
          </table>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection