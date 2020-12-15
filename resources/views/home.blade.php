@extends('layouts.app')

@section('title-block')Home page @endsection

@section('content')
    @foreach($data as $list)
        <div>
            <a class="nav-link text-dark" href="{{route('search',$list['name'])}}">{{$list['name']}}</a>
        </div>

    @endforeach
@endsection
