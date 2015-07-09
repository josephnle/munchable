@extends('layouts.master')

@section('content')
    <div class="container-fluid container-full">
        <div class="place">
            <div class="place-slider" style="width: 100%;">
                <div>
                    <img class="place-slide" src="http://lorempixel.com/1000/400/food" alt="" />
                </div>
                <div>
                    <img class="place-slide" src="http://lorempixel.com/1000/200/food" alt="" />
                </div>
            </div>

            <div class="place-content-header">
                <div class="place-content-header-title">
                    <h2>Dragon Eats</h2>
                    <span class="pull-right place-rating"><small>8.9</small></span>
                </div>
                <div class="place-content-header-meta">
                    <div>
                        <span>Persian</span>
                        <span>$$$</span>
                    </div>
                    <div class="pull-right">
                        <span>450ft</span>
                        <span>SoMA</span>
                    </div>
                </div>
            </div>

            <div class="place-content">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Highlights
                    </div>
                    <div class="panel-body tips">
                        <div class="tip">
                            "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet architecto deserunt dolorum eos error illum laborum neque numquam quae quo sequi, soluta ullam vero voluptas voluptatem. Debitis illo quaerat repellendus."
                        </div>
                        <div class="tip">
                            "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Amet architecto deserunt dolorum eos error illum laborum neque numquam quae quo sequi, soluta ullam vero voluptas voluptatem. Debitis illo quaerat repellendus."
                        </div>
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