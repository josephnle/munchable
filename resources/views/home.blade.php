@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div id="recipe1" class="card">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="cover-image"
                                 style="background: url('http://lorempixel.com/800/800/food');background-size: cover;
                                 width: 100%;">
                            </div>
                        </div>
                    </div>
                    <div class="row content">
                        <div class="col-xs-12">
                            {{-- Name --}}
                            <div class="content-header">
                                <div class="content-header-title">
                                    <h2>Dragon Eats</h2>
                                    <span class="pull-right rating"><small>8.9</small></span>
                                </div>
                                <div class="content-header-meta">
                                    <div>
                                        <span>Vietnamese</span>
                                        <span>$</span>
                                    </div>
                                    <div class="pull-right">
                                        <span>0.3 miles</span>
                                        <span>SoMA</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection