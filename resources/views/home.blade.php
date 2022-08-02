@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/shopping.css') }}">

    <div class="container">

        <nav class="navbar bg-light mb-2">
            <div class="container-fluid">
                <a class="navbar-brand">Categorias</a>
                <a class="nav-link active" aria-current="page" href="#">Active</a>
                <a class="nav-link" href="#">Link</a>
                <a class="nav-link" href="#">Link</a>
                <a class="nav-link disabled">Disabled</a>

                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </nav>
<!-- https://fakeimg.pl/365x365/ -->
        <h3 class="h3">Destaques</h3>
        <div class="row">
            @for ($i = 0; $i < 8; $i++)
                <div class="col-md-3 col-sm-6 mb-2">
                    <div class="product-grid border border-light border-2 p-2">
                        <div class="product-image3">
                            <a href="#">
                                <img class="pic-1"
                                    src="https://s.cornershopapp.com/product-images/3890115.jpg?versionId=WYYDIdZLM3Ua4KRpw8ZbP6HYG0vRtrho">
                                <img class="pic-2"
                                    src="https://s.cornershopapp.com/product-images/3890115.jpg?versionId=WYYDIdZLM3Ua4KRpw8ZbP6HYG0vRtrho">
                            </a>
                            <ul class="social">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                            <span class="product-new-label">New</span>
                        </div>
                        <div class="product-content">
                            <h3 class="title"><a href="#">Men's Blazer</a></h3>
                            <div class="price">
                                $63.50
                                <span>$75.00</span>
                            </div>
                            <ul class="rating">
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star"></li>
                                <li class="fa fa-star disable"></li>
                                <li class="fa fa-star disable"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>
    <hr>

    <div class="container">
        <div class="row justify-content-center">



            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>

        </div>
    </div>
@endsection
