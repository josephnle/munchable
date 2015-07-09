@extends('layouts.master')

@section('content')
    <div class="container">
        @foreach($results as $result)
            <a href="{{ action('PlacesController@show', $result['id']) }}">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="cover-image"
                                         style="background: url('{{ $result['photo'] or '' }}');background-size: cover;
                                                 width: 100%;">
                                    </div>
                                </div>
                            </div>
                            <div class="row content">
                                <div class="col-xs-12">
                                    {{-- Name --}}
                                    <div class="content-header">
                                        <div class="content-header-title">
                                            <h2>{{ $result['name'] }}</h2>
                                    <span class="pull-right rating">
                                        <small>{{ $result['rating'] or 'N/A' }}</small>
                                    </span>
                                        </div>
                                        <div class="content-header-meta">
                                            <div>
                                                <span>{{ $result['category'] }}</span>
                                                <span>{{ $result['price'] or '' }}</span>
                                            </div>
                                            {{--<div class="pull-right">--}}
                                            {{--<span>0.3 miles</span>--}}
                                            {{--<span>SoMA</span>--}}
                                            {{--</div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection