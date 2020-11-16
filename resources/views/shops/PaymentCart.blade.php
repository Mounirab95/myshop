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
                        <h2>L'etape de paiement</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
        <!-- Checkout Section Begin -->
        <section class="checkout spad">
        <div class="container">
        @if(Session::has('successpayement'))
            <p class="alert {{ Session::get('alert-class', 'alert-success') }}"><i class="fas fa-check-circle"> </i> {{ Session::get('successpayement') }}</p>
        @endif
        @if(Session::has('errorpayement'))
            <p class="alert {{ Session::get('alert-class', 'alert-danger') }}"><i class="fas fa-check-circle"> </i> {{ Session::get('errorpayement') }}</p>
        @endif
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span>Une fois payé le process de livraison commancera
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Vous informations</h4>
                <form action="{{ url('charge') }}" method="POST">
                    @csrf
                    <div class="row">
                    @forelse( usersinformations() as $information)
                       <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Nom: {{$information->name}}</p>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Prénom: {{$information->familyname}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Tél: {{$information->telephone}}</p>
                            </div>
                            <div class="checkout__input">
                                <p>Mon Adresse:  {{$information->address}}</p>
                            </div>
                            <div class="checkout__input">
                                <p>Ville: {{$information->city}}</p>
                            </div>
                            <div class="checkout__input">
                                <p>Pays:  {{$information->country}}</p>
                            </div>
                            <div class="checkout__input">
                                <p>Code postale: {{$information->postale}}</p>
                            </div>
                        </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="checkout__order">
                                    <h4>Vous Produit Commander</h4>
                                    <div class="checkout__order__products">Products <span>Total</span></div>
                                    <ul>
                                    @if(Auth::check())    
                                        @forelse($detailOfProduct as $item)
                                        <li>{{$item->name}} <span>{{$item->myprice}}€</span></li>
                                        @empty
                                        <li>Charette vide <span> 0€ </span></li>
                                        @endforelse  
                                    @else
                                    <li>Charette vide <span> 0€ </span></li>
                                    @endif      
                                    </ul>
                                    <br>
                                    <br>
                                    @if(Auth::check())
                                    <div class="checkout__order__total">Total <span>{{$price}}€</div>
                                    <input type="hidden" name="amount" value="{{$price}}">
                                    @else
                                    <div class="checkout__order__total">Total <span>0€</span></div>
                                    @endif

                                    <p>La Methode de paiement proposé pour le moment est <span class="badge badge-info">PayPal</span></p>
                                    <input type="submit" name="submit" class="site-btn" value="Confirmer le Paiement"> 
                                </div>
                            </div>
                        </form>
                    @empty
                    <form>
                        <div class="col-lg-8 col-md-6">
                            <div class="checkout__input">
                                <p>Veuiller ajouter votre Adresse  dans votre profil pour confirmer votre commande<span>*</span></p>
                                <a  href="{{url('/home')}}" class="btn btn-warning">Ajouter votre adresse</a>
                            </div>
                        </div>
                    </form>

                            <div class="col-lg-4 col-md-6">
                                <div class="checkout__order">
                                    <h4>Vous Produit Commander</h4>
                                    <div class="checkout__order__products">Products <span>Total</span></div>
                                    <ul>
                                    @if(Auth::check())    
                                        @forelse($detailOfProduct as $item)
                                        <li>{{$item->name}} <span> {{$item->myprice}}€ </span></li>
                                        @empty
                                        <li>Charette vide <span> 0€ </span></li>
                                        @endforelse  
                                    @else
                                    <li>Charette vide <span> 0€ </span></li>
                                    @endif      
                                    </ul>
                                    @if(Auth::check())
                                    <!-- <div class="checkout__order__total">Total <span>{{$price}}€</span></div> -->
                                    @else
                                    <div class="checkout__order__total">Total <span>0€<</span></div>
                                    @endif

                                    <p>La Methode de paiement proposé pour le moment est <span class="badge badge-info">PayPal</span></p>
                                    <button  disabled class="btn btn-warning">Ajouter votre adresse</button>
                                </div>
                            </div>
                        @endforelse
                    </div>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->
@include('layouts.footer')
