@extends('layouts.app')

@section('content')

<a href="{{ url('/home') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>

@foreach ($item->parameters as $param)
{{$param->title}} {{$param->pivot->data}} {{$param->data_type}}
@endforeach
@endsection