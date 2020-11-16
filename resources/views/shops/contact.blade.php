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
                        <h2>Nos Contact</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
@forelse(infowebsite() as $info)
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>Télèphone</h4>
                        <p>{{$info->phone}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>Adresse</h4>
                        <p>{{$info->address}}</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_clock_alt"></span>
                        <h4>Temps d'ouverture</h4>
                        <p>8:00 am to 20:00 pm</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                    <div class="contact__widget">
                        <span class="icon_mail_alt"></span>
                        <h4>Email</h4>
                        <p>{{$info->Email}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Map Begin -->
    <div class="map">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2627.4468793679944!2d2.3735377150854786!3d48.81153441195964!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e673cdedac3b69%3A0x9542567e622404a2!2s51%20Rue%20Hoche%2C%2094200%20Ivry-sur-Seine%2C%20France!5e0!3m2!1sen!2sma!4v1603896884458!5m2!1sen!2sma"
            height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        <div class="map-inside">
            <i class="icon_pin"></i>
            <div class="inside-widget">
                <h4>France</h4>
                <ul>
                    <li>Télè: {{$info->phone}}</li>
                    <li>Adresse: {{$info->address}}</li>
                </ul>
            </div>
        </div>
    </div>
    @empty
    <p>vide</p>
    @endforelse
    <!-- Map End -->
    <!-- Related Product Section End -->
@include('layouts.footer')