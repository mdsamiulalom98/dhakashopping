@extends('frontEnd.layouts.master')
@section('title', 'Blogs')
@section('content')
    <section class=" main-details-page">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="breadcrumb">
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <span>
                                <i data-feather="chevron-right"></i>
                            </span>
                            <li><a href="{{ route('blogs') }}">Blogs</a>
                            </li>
                            <span>
                                <i data-feather="chevron-right"></i>
                            </span>
                            <li><a>{{ $details->title }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-page-section">
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="blog-sidebar">
                        <div class="header">
                            <h3>Blog Categories</h3>
                        </div>
                        <div class="body">
                            <ul>
                                @foreach ($blog_categories as $key => $value)
                                <li>
                                    <a href="{{ route('blog.categories', $value->slug) }}">{{ $value->name }}</a>
                                    <span>{{ $value->blogs->count() }}</span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="blog-info-wrapper">
                        <div class="title">
                            <h1>{{ $details->title }}</h1>
                        </div>
                        <div class="body">
                            <div class="blog-details-image">
                                <img src="{{ asset($details->image) }}">
                            </div>
                            <div class="blog-details-desc">
                                {!! $details->description !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
