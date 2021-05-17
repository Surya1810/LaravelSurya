<footer>

    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-6">
                <div class="footer-section">

                    {{--<a class="logo" href="#"><img src="images/logo.png" alt="Logo Image"></a>--}}
                    <p class="copyright">{{ env('APP_NAME') }} @ {{ date('Y') }}. All rights reserved.</p>
                    <p class="copyright"><strong> Developed &amp; <i class="far fa-heart"></i> by </strong>
                        <a href="https://www.instagram.com/surya_dnrt/" target="_blank">Surya</a></p>
                    <ul class="icons">
                        <li><a target="_blank" href="https://www.facebook.com/"><i class="ion-social-facebook-outline"></i></a></li>
                        <li><a target="_blank" href="https://twitter.com/"><i class="ion-social-twitter-outline"></i></a></li>
                        <li><a target="_blank" href="https://www.instagram.com/surya_dnrt/"><i class="ion-social-instagram-outline"></i></a></li>
                        <li><a target="_blank" href="https://www.youtube.com/channel/UCE8O_5p-zSmVcCpNtal52XQ"><i class="ion-social-youtube-outline"></i></a></li>
                    </ul>

                </div><!-- footer-section -->
            </div><!-- col-lg-4 col-md-6 -->

            <div class="col-lg-4 col-md-6">
                <div class="footer-section">
                    <h4 class="title"><b>CATAGORIES</b></h4>
                    <ul>
                        @php
                        $categories = App\Models\Category::all();
                        @endphp


                        @foreach($categories as $category)
                            <li><a href="{{ route('category.posts',$category->slug) }}">{{ $category->name }}</a></li>
                        @endforeach
                    </ul>
                </div><!-- footer-section -->
            </div><!-- col-lg-4 col-md-6 -->

            <div class="col-lg-4 col-md-6">
                <div class="footer-section">
                {{-- @role ('guest|super admin|admin|operator')
                <!-- Begin Mailchimp Signup Form -->
                <div id="mc_embed_signup">
                    <form action="https://4visionmedia.us7.list-manage.com/subscribe/post?u=38836bc40d6d8eaab52fe798b&amp;id=5a6e92f631" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                        <div id="mc_embed_signup_scroll">
                            <h6>Verify your account !</h6><br>
                            <div class="mc-field-group" hidden>
                                <label for="mce-EMAIL">Email Address </label>
                                <input type="email" value="{{ Auth::user()->email }}" name="EMAIL" class="required email" id="mce-EMAIL">
                </div>
                <div id="mce-responses" class="clear">
                    <div class="response" id="mce-error-response" style="display:none"></div>
                    <div class="response" id="mce-success-response" style="display:none"></div>
                </div>
                <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                <div style="position: absolute; left: -5000px;" aria-hidden="true">
                    <input type="text" name="b_38836bc40d6d8eaab52fe798b_5a6e92f631" tabindex="-1" value="">
                </div>
                <div class="clear">
                    <input type="submit" value="Verify" name="subscribe" id="mc-embedded-subscribe" class="button">
                </div>
                </div>
                </form>
                </div>
                <!--End mc_embed_signup-->
                @endrole --}}
                @can ('Subscriber')
                <h4 class="title"><b>SUBSCRIBE</b></h4>



                    <div class="input-area">
                        <form method="POST" action="{{ route('subscriber.store') }}">
                            @csrf
                            <input class="email-input" name="email" type="email" placeholder="Enter your email" value="{{ Auth::user()->email }}">
                            <button class="submit-btn" type="submit"><i class="icon ion-ios-email-outline"></i></button>
                        </form>
                    </div>
                    @endcan


                </div><!-- footer-section -->
            </div><!-- col-lg-4 col-md-6 -->

        </div><!-- row -->
    </div><!-- container -->
</footer>


