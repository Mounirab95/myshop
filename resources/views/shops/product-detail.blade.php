@include('layouts.header')
   
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('frontend')}}/img/breadcrumbtest.png">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>{{$product->title}}</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Boutique</a>
                            <span>{{$product->title}}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <!-- ajouter dans favori -->
        @if(Session::has('addwishlist'))
            <p class="alert {{ Session::get('alert-class', 'alert-success') }}"><i class="fas fa-check-circle"> </i> {{ Session::get('addwishlist') }}</p>
        @endif
        @if(Session::has('errorwishlist'))
            <p class="alert {{ Session::get('alert-class', 'alert-danger') }}"><i class="fas fa-check-circle"> </i> {{ Session::get('errorwishlist') }}</p>
        @endif
        <!-- ajouter dans la charette -->
        @if(Session::has('addcart'))
            <p class="alert {{ Session::get('alert-class', 'alert-success') }}"><i class="fas fa-check-circle"> </i> {{ Session::get('addcart') }}</p>
        @endif
        @if(Session::has('errorcart'))
            <p class="alert {{ Session::get('alert-class', 'alert-danger') }}"><i class="fas fa-check-circle"> </i> {{ Session::get('errorcart') }}</p>
        @endif
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{asset('storage/'.$product->url)}}" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                        @foreach($photo as $item)
                            <img data-imgbigurl="{{asset('storage/'.$item->url)}}"src="{{asset('storage/'.$item->url)}}" alt="">
                        @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{$product->title}}</h3>

                        <div class="product__details__price">€{{$product->price}}</div>
                        @if($product->reduction>0)
                        <p> Le produit est en promotion <span class="badge badge-danger">- {{$product->reduction}}% reduction</span></p>
                            @else
                        <p>Pas de reduction sur le produit</p>
                         @endif   
                        <div class="row">
                      @if(Auth::check())
                        <form action="{{route('addToCart')}}" method="post">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                            <input type="hidden" value="{{$product->categorie_id}}" name="categorie_id"> 
                            <input type="hidden" value="{{$product->id}}" name="product_id"> 
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" name="quantity" min="1" value="1">
                                    </div>
                                </div>
                            </div>
                        <button  class="btn primary-btn">Ajouter au Charette</button>
                        @else
                        <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" name="quantity" value="1">
                                    </div>
                                </div>
                            </div>
                        <button href="{{ route('login') }}" class="btn primary-btn">Ajouter au Charette</button>
                        @endif
                        </form>
                         @if(Auth::check())         
                             <form action="{{route('wishliste')}}" method="POST"> 
                              @csrf   
                              <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                              <input type="hidden" value="{{$product->id}}" name="product_id">
                              <input type="hidden" value="{{$product->categorie_id}}" name="categorie_id"> 
                             <button  class="btn  heart-icon"><span class="icon_heart_alt"></span></button>
                             </form>
                             @else
                             <a href="{{ route('login') }}" class="heart-icon"><span class="icon_heart_alt"></span></a>
                             @endif
                        </div>
                        
                        <ul>
                            <li><b>livraison</b> <span>dans  {{$product->livraison}} jours. <samp>livraison gratuit</samp></span></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Description</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Infomation</h6>
                                    <div>{!!html_entity_decode($product->description)!!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Related Product</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                @forelse(productpromo() as $promo)
                                    @if($promo->reduction != 0)
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="{{asset('storage/'.$promo->url)}}">
                                            <div class="product__discount__percent">-{{$promo->reduction}}%</div>
                                            <ul class="product__item__pic__hover">
                                            @if(Auth::check())
                                         <li>
                                            <form action="{{route('wishliste')}}" method="POST"> 
                                                @csrf
                                                <input type="hidden" name="user_id" value="{{ Auth::user()->id}}">
                                                <input type="hidden" value="{{$promo->id}}" name="product_id"> 
                                                <input type="hidden" value="{{$promo->categorie_id}}" name="categorie_id"> 
                                                <button  class="btn btn-danger rounded-circle"><i class="fa fa-heart"></i></button>
                                             </form>
                                             
                                         </li>
                                        @else
                                        <li><a href="{{ route('login') }}"><i class="fa fa-heart"></i></a></li>
                                        @endif
                                            </ul>
                                        </div>
                                        <div class="product__discount__item__text">
                                            <span>{{$promo->categorie}}</span>
                                            <h5><a href="{{url ('detail',$promo->id)}}">{{$promo->title}}</a></h5>
                                            <div class="product__item__price">€{{$promo->price}}</div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @empty
                                <p>vide</p>
                                @endforelse
                            </div>
                        </div>
        </div>
    </section>
    <!-- Related Product Section End -->
@include('layouts.footer')