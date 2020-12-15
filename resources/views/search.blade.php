@extends('layouts.app')

@section('title-block')Search page @endsection


@section('content')
    @isset($data)
        @foreach($data as $video)
            <div class="card border-top-0">
                <a class="nav-link text-dark p-0" href="{{ route('download-page',$video['videoId']) }}">
                    <div class="row g-0">
                        <div class="col-md-1 pb-3">
                            <img src="{{ $video['thumbnails']}}"
                                 alt="{{$video['title']}}" style="width: 90px">
                        </div>
                        <div class="col-md-11">
                            <div class="card-body">
                                <h5 class="card-title">{{$video['title']}}</h5>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    @endisset
@endsection
