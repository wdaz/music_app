@extends('layouts.app')


@section('title-block')Download page @endsection


@section('content')
    <div class="ps-2 pe-1 g-0">
        <div class="alert alert-secondary text-md-end">
            {{$result->title}}
        </div>
        <div class="text-md-end">
            <iframe width="650" height="315" src="https://www.youtube.com/embed/{{$result->videoId}}"></iframe>
        </div>
        <p class="text-md-end ">
            <a class="btn btn-primary rounded-pill"
               @isset($result->vlink)  href="{{ route('download',["link"=>$result->vlink,"title"=>$result->title,"type"=>$result->vtype]) }}" @endisset>
                Download Video
            </a>
            <a class="btn btn-success rounded-pill"
               href="{{ route('download',['id'=>$result->videoId,"title"=>$result->title]) }}">
             Download MP3
            </a>
        </p>
    </div>

@endsection
