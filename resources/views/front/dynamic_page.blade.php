@extends('layouts.new-master')

@section('title')
    {{ $page->meta_title ?? $page->title }}
@endsection

@section('meta_tags')
    <meta name="title" content="{{ $page->meta_title }}">
    <meta name="description" content="{{ $page->meta_description }}">
    <meta name="keywords" content="{{ $page->meta_keyword }}">
@endsection

@section('content')
    @if($page && $page->status === 'published')
        <!--Start breadcrumb area-->
        <section class="breadcrumb-area"
            style="background-image: url({{ asset('site_assets') }}//images/breadcrumb/breadcrumb-1.png);">
            <div class="banner-curve-gray"></div>
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="inner-content clearfix text-center">
                            <div class="title wow slideInUp animated" data-wow-delay="0.3s" data-wow-duration="1500ms">
                                <h2>{{ $page->page_name }}<span class="dotted"></span></h2>
                            </div>
                            <div class="breadcrumb-menu wow slideInDown animated" data-wow-delay="0.3s"
                                data-wow-duration="1500ms">
                                <ul class="clearfix">
                                    <li><a href="index-2.html">Home</a></li>
                                    <li class="active">{{ $page->page_name }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--End breadcrumb area-->
        <!--Start Contact Info Area-->
        <section class="contact-info-area style3" style="margin-bottom:50px">
            <div class="container">
                <div class="row">
                    {!! $page->detail !!}
                </div>
            </div>
        </section>

    @else
        <div class="page-wrapper">
            <div class="page-content text-center py-5">
                <h3>Page not found or unpublished.</h3>
            </div>
        </div>
    @endif



@endsection