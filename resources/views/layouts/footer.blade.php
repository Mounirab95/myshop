 <!-- Footer Section Begin -->
 <footer class="footer spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="footer__about">
                        <div class="footer__about__logo">
                            <a href="#"><img style="width: 100px;" src="{{asset('frontend')}}/img/logo.png" alt=""></a>
                        </div>
                        <ul>
                        @forelse(infowebsite() as $info)
                            <li>Adresse: {{$info->address}}</li>
                            <li>Télè: {{$info->phone}}</li>
                            <li>Email: {{$info->Email}}</li>
                        @empty
                            <li>Adresse: vide</li>
                            <li>Télé: vide</li>
                            <li>Email: vide</li>
                        @endforelse    
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 offset-lg-1">
                    <div class="footer__widget">
                        <h6>Nos catégories</h6>
                        <ul>
                            @forelse(myCategory() as $category)
                            <li><a href="{{url('filterCategory',$category->id)}}">{{$category->categorie}}</a></li>
                            @empty
                            <li><a href="#">pas de categorie</a></li>
                            @endforelse
                        </ul>
                        <ul>
                        <li><a href="{{url('/')}}">Acceuil</a></li>
                            <li><a href="{{route('shop')}}">Boutique</a></li>
                            <li><a href="{{route('about')}}">A Propos</a></li>
                            <li><a href="{{route('contact')}}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="footer__widget">
                         @forelse(infowebsite() as $info)
                        <h6>A Propos du site</h6>
                        <p>{{$info->brefinfo}}</p>
                        <div class="footer__widget__social">
                            <a href="{{$info->facebook}}"><i class="fa fa-facebook"></i></a>
                            <a href="{{$info->instagram}}"><i class="fa fa-instagram"></i></a>
                            <a href="{{$info->twitter}}"><i class="fa fa-twitter"></i></a>
                            <a href="{{$info->youtube}}"><i class="fa fa-youtube"></i></a>
                        </div>
                        @empty
                        <h6>A Propos du site</h6>
                        <p>vide</p>
                        <div class="footer__widget__social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href=""><i class="fa fa-instagram"></i></a>
                            <a href=""><i class="fa fa-twitter"></i></a>
                            <a href=""><i class="fa fa-youtube"></i></a>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer__copyright">
                        <div class="footer__copyright__text"><p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
  Copyright &copy;<script>document.write(new Date().getFullYear());</script> Tout les droits son reserver | by Aboulama Mounir
  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p></div>
                        <div class="footer__copyright__payment"><img src="{{asset('frontend')}}/img/payment-item.png" alt=""></div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{asset('frontend')}}/js/jquery-3.3.1.min.js"></script>
    <script src="{{asset('frontend')}}/js/bootstrap.min.js"></script>
    <script src="{{asset('frontend')}}/js/jquery.nice-select.min.js"></script>
    <script src="{{asset('frontend')}}/js/jquery-ui.min.js"></script>
    <script src="{{asset('frontend')}}/js/jquery.slicknav.js"></script>
    <script src="{{asset('frontend')}}/js/mixitup.min.js"></script>
    <script src="{{asset('frontend')}}/js/owl.carousel.min.js"></script>
    <script src="{{asset('frontend')}}/js/main.js"></script>



</body>

</html>