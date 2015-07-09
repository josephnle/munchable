@extends('layouts.master')

@section('content')
    <div class="container">
        <h2>Saved Places</h2>
        <hr />

        @foreach($places as $place)
            <a href="{{ action('PlacesController@show', $place['id']) }}">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="card">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="cover-image"
                                         style="background: url('{{ $place['photo'] or '' }}');background-size: cover;
                                                 width: 100%;">
                                    </div>
                                </div>
                            </div>
                            <div class="row content">
                                <div class="col-xs-12">
                                    {{-- Name --}}
                                    <div class="content-header">
                                        <div class="content-header-title">
                                            <h2>{{ $place['name'] }}</h2>
                                    <span class="pull-right rating">
                                        <small>{{ $place['rating'] or 'N/A' }}</small>
                                    </span>
                                        </div>
                                        <div class="content-header-meta">
                                            <div>
                                                <span>{{ $place['category'] }}</span>
                                                <span>{{ $place['price'] or '' }}</span>
                                            </div>
                                            {{--<div class="pull-right">--}}
                                            {{--<span>0.3 miles</span>--}}
                                            {{--<span>SoMA</span>--}}
                                            {{--</div>--}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <a class="save-place-button pull-right" data-venue="{{ $place['id']
                                }}"><i class="fa fa-heart-o fa-lg"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection