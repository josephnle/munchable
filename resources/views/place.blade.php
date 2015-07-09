@extends('layouts.master')

@section('content')
    <div class="container-fluid container-full">
        <div class="place">
            <div class="place-slider" style="width: 100%;">
                @foreach($place['photos'] as $photo)
                <div class="text-center place-slide">
                    <img class="place-img" src="{{ $photo['prefix'] . '500x500' . $photo['suffix'] }}" alt="" />
                </div>
                @endforeach
            </div>

            <div class="place-content-header">
                <div class="place-content-header-title">
                    <h2>{{ $place['name'] }}</h2>
                    <span class="pull-right place-rating"><small>{{ $place['rating'] or 'N/A' }}</small></span>
                </div>
                <div class="place-content-header-meta">
                    <div>
                        <span>{{ $place['category'] }}</span>
                        <span>{{ $place['price'] or '' }}</span>
                    </div>
                </div>
            </div>

            <div class="place-content">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Highlights
                    </div>
                    <div class="panel-body tips">
                        @foreach($place['tips'] as $tip)
                        <div class="tip">
                            "{{ $tip['text'] }}"
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="place-option">
                <img class="logo" src="{{ asset('img/logo/uber_logo.png') }}" />
                <div class="name">Uber</div>
                <div class="info">12 mins</div>
            </div>

            <div class="place-option">
                <img class="logo" src="{{ asset('img/logo/postmates_logo.png') }}" />
                <div class="name">Postmates</div>
                <div class="info">12 mins</div>
            </div>

            <div class="place-option">
                <img class="logo" src="{{ asset('img/logo/gmaps_logo.png') }}" />
                <div class="name">Maps</div>
                <div class="info">12 mins</div>
            </div>

            <div class="place-option">
                <div class="name text-center">OpenTable</div>
            </div>
        </div>
    </div>
@endsection