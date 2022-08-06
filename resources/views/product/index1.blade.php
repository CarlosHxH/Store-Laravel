<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/shopping.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>

    @component('layouts.navbar')@endcomponent
    @component('layouts.carousel')@endcomponent

    <div class="container my-2 pt-3 align-text-bottom" style="background-color: #e9ecef;">
        <div class="row">
            <div class="col">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Produtos</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-3">
                <form class="row mb-2 g-3">
                    <div class="col-12">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search...">
                            <div class="input-group-text">
                                <i class="fa fa-search"></i>
                            </div>
                        </div>
                    </div>
                </form>

                <div class="card bg-light mb-3">
                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#categories" role="button" aria-expanded="false" aria-controls="categories">
                        <div class="card-header bg-primary text-white text-uppercase">
                            <i class="fa fa-list"></i>Categorias
                        </div>
                    </a>
                    <ul class="accordion-collapse collapse show list-group" id="categories">
                        <a class="list-group-item list-group-item-action" href="/">Todos os produtos</a>
                        <div id="cat">
                            @foreach ($category as $cat)
                            <a class="list-group-item list-group-item-action" href="/view/{{ $cat->id }}">{{ $cat->name }}</a>
                            @endforeach
                        </div>
                        <p class="text text-center">{{ $category->links('layouts.paginate') }}</p>
                    </ul>
                </div>

                <!--div class="card bg-light mb-3">
                    <div class="card-header bg-success text-white text-uppercase">Last product</div>
                    <div class="card-body">
                        <img class="img-fluid"
                            src="https://statics.angeloni.com.br/super/files/produtos/731285/731285_1_zoom.jpg">
                        <h5 class="card-title text-muted">Product title</h5>
                        <p class="card-text text-muted">R$ 21,99</p>
                    </div>
                    <ul class="rating">
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star"></li>
                        <li class="fa fa-star disable"></li>
                    </ul>
                </div-->
            </div>

            <div id="products" class="col">
                <div class="row">

                    <div class="d-flex justify-content-end">
                        <div class="mt-3">{{ $product->links('pagination::bootstrap-4') }}</div>
                    </div>


                    @if (Request::is('view/*'))
                    @foreach ($product as $key)
                        @foreach ($key->product as $prod)
                            <div class="col-md-4 col-sm-6 mb-2">
                                <div class="product-grid border border-light border-2 p-2">
                                    <div class="product-image3">
                                        <a href="#">
                                            <img class="pic" src="{{$prod->file}}">
                                        </a>
                                        <ul class="social">
                                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                        <span class="product-new-label">New</span>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title"><a href="{{$prod->id}}">{{$prod->name}}</a></h3>
                                        <div class="price">
                                            R$ {{$prod->price}}
                                            <span></span>
                                        </div>
                                        <ul class="rating">
                                            <li class="fa fa-star {{$prod->star <= 0?'disable':'';}}"></li>
                                            <li class="fa fa-star {{$prod->star <= 1?'disable':'';}}"></li>
                                            <li class="fa fa-star {{$prod->star <= 2?'disable':'';}}"></li>
                                            <li class="fa fa-star {{$prod->star <= 3?'disable':'';}}"></li>
                                            <li class="fa fa-star {{$prod->star <= 4?'disable':'';}}"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach

                    @else

                    @foreach ($product as $prod)
                        <div class="col-md-4 col-sm-6 mb-2">
                            <div class="product-grid border border-light border-2 p-2">
                                <div class="product-image3">
                                    <a href="#">
                                        <img class="pic" src="{{$prod->file}}">
                                    </a>
                                    <ul class="social">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-eye"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                    <span class="product-new-label">New</span>
                                </div>
                                <div class="product-content">
                                    <h3 class="title"><a href="{{$prod->id}}">{{$prod->name}}</a></h3>
                                    <div class="price">
                                        R$ {{$prod->price}}
                                        <span></span>
                                    </div>
                                    <ul class="rating">
                                        <li class="fa fa-star {{$prod->star <= 0?'disable':'';}}"></li>
                                        <li class="fa fa-star {{$prod->star <= 1?'disable':'';}}"></li>
                                        <li class="fa fa-star {{$prod->star <= 2?'disable':'';}}"></li>
                                        <li class="fa fa-star {{$prod->star <= 3?'disable':'';}}"></li>
                                        <li class="fa fa-star {{$prod->star <= 4?'disable':'';}}"></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach'
                    @endif
                    <div class="d-flex justify-content-end">
                        <div class="mt-3">{{ $product->links('pagination::bootstrap-4') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="d-flex justify-content-around bg-dark text-light">
        <div class="container pt-4">
            <div class="row">
                <div class="col-md-3 col-lg-4 col-xl-3">
                    <h5>About</h5>
                    <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                    <p class="mb-4">
                        Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant
                        impression.
                    </p>
                </div>

                <div class="col-md-2 col-lg-2 col-xl-2 mx-auto">
                    <h5>Informations</h5>
                    <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                    <ul class="nav flex-column">
                        <a href="" class="nav-link text-light">Link 1</a>
                        <a href="" class="nav-link text-light">Link 2</a>
                        <a href="" class="nav-link text-light">Link 3</a>
                        <a href="" class="nav-link text-light">Link 4</a>
                    </ul>
                </div>

                <div class="col-md-3 col-lg-2 col-xl-2 mx-auto">
                    <h5>Others links</h5>
                    <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                    <ul class="nav flex-column">
                        <a href="" class="nav-link text-light">Link 1</a>
                        <a href="" class="nav-link text-light">Link 2</a>
                        <a href="" class="nav-link text-light">Link 3</a>
                        <a href="" class="nav-link text-light">Link 4</a>
                    </ul>
                </div>

                <div class="col-md-4 col-lg-3 col-xl-3">
                    <h5>Contact</h5>
                    <hr class="bg-white mb-2 mt-0 d-inline-block mx-auto w-25">
                    <ul class="list-unstyled">
                        <li><i class="fa fa-home mr-2"></i> My company</li>
                        <li><i class="fa fa-envelope mr-2"></i> email@example.com</li>
                        <li><i class="fa fa-phone mr-2"></i> + 33 12 14 15 16</li>
                        <li><i class="fa fa-print mr-2"></i> + 33 12 14 15 16</li>
                    </ul>
                </div>
                <div class="col-12 copyright mt-3">
                    <p class="float-left">
                        <a href="#" class="text-light">Back to top</a>
                    </p>
                    <p class="text-end text-muted">created with
                        <i class="fa fa-heart"></i> by
                        <a href="#" class="text-link"><i class="text-light">CrxCode</i></a> | <span>v:
                            1.0</span>
                    </p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
