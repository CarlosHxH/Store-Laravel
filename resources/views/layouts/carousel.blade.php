
<style>
    .carousel-item img{height: 300px;}
</style>
<section class="jumbotron text-center">
    <div id="carousel" class="carousel slide" data-bs-ride="false">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('banners/banner-1.png')}}" class="d-block w-100" alt="">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{asset('banners/banner-2.png')}}" class="d-block w-100" alt="">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{asset('banners/banner-3.png')}}" class="d-block w-100" alt="">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
 <!--section class="jumbotron text-center bg-secondary p-5">
        <div class="container">
            <h1 class="jumbotron-heading text-white">E-COMMERCE CATEGORY</h1>
            <p class="lead text-light mb-0">Le Lorem Ipsum est simplement du faux texte employé dans la composition et
                la
                mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les
                années
                1500, quand un peintre anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen
                de
                polices de texte...</p>
        </div>
    </section-->
