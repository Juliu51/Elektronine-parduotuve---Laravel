@extends('layouts.app')
@section('content')
<div class="container">
<div class="row w-100">
<div class="col-12 col-lg-3">
@if(Auth::user()->isAdmin())
<div class="panel">
        <div class="">
            <div class="card-header admin_head shadow bg-body ">
                Admino panelė
            </div>
            <div class="card-body admin_body">
                @if ((count($chain) > 0))
                <div class="kategorija">
                <a  class="kategorija" href="{{route('item.create',[ $chain[count($chain)-1] ] )}}">Įdėti prekę į "{{$chain[count($chain)-1]->name}}" kategoriją</a>
                </div>
                <?php $category = $chain[count($chain) - 1]?>
               @else
               <?php $category = 0?>
                @endif
                <div class="kategorija">
                <a class="kategorija" href="{{route('category.create',[$category] )}}">Sukurti kategorija siame gylije</a>
             </div>
             </div>
         </div>
</div>
@endif
      <div class="findCategory">
        <table class="table table-striped">
            <tbody>
              <td class="CategoryAll"><a class="CategoryAlltext" href="{{route('category.index')}}">Visos Kategorijos</a></td>
            @foreach ($categories as $category)
            <tr class="CategoryNameH">
              <td > <a class="CategoryName" href="{{route('category.map',$category)}}"> {{$category->name}}</a></td>
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
  </div>
<div class="col-12 col-lg-9">
@if (count($chain)== 0)
<div class="Perkamiausios ">
  <div id="searchas" class="searchas"></div>
  <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img class="d-block w-100" src="../public/images/front/n1.jpg" alt="First slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="../public/images/front/n2.jpg" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img class="d-block w-100" src="../public/images/front/n3.jpg" alt="Third slide">
      </div>
    </div>
  </div>
  <p class="top justify-content-center text-white">TOP PERKAMIAUSIOS </p>
</div>

<!-- 
 //kortelems parodyti main puslapi top 6 perkamausius random -->

  <div class="korteles">
    
              @foreach ($Allitems as $item)
                              {!!$item->cards()!!}
              @endforeach
              
  </div>
@else
<div class="Perkamiausios">
  <div id="searchas" class="searchas"></div>
  <div class="headas">
            <h1 class="CatUniqName">{{(count($chain) > 0)?$chain[count($chain)-1]->name :""}}</h1>
        </div>
        <div class="chainHead">
            @if (count($chain)== 0)
                Prekės
            @endif
             @foreach ($chain as $item)
             @if(next($chain))
                  <a class="chain" href="{{route('category.map',$item)}}"> {{$item->name}} ></a>
                 @else
                  <a class="chain chain-last" href="{{route('category.map',$item)}}"> {{$item->name}} </a>
                 @endif
             @endforeach
         </div>
         <!-- @foreach($categories as $cat)
          <p>{{$cat}}</p>
      @endforeach -->

<!-- //korteles parodyti unikalios kategorijos prekes    -->

            <div class="korteles">
        @if (isset($item))
            @foreach ($items as $item)
                              {!!$item->cards()!!}
            @endforeach
            </div>
</div>
    @else 
        @endif

<!-- //korteles parodyti kas yra kategorijose visos prekems// -->

        <div class="korteles">
              @foreach ($zz as $items)
              @foreach($items as $item)
                            {!!$item->cards()!!}
              @endforeach
              @endforeach
       </div>

        @endif
</div>
</a>
</div>
@endsection
<script>
  let urlSearchBar = "{{route('item.searchBar')}}";
  let itemShow = "{{route('item.show',[1,1])}}";
</script> 