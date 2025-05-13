<!DOCTYPE html>
<html lang="en" dir="rtl">
<!-- Head Start -->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

    <title>منصة قطرة خير | @yield('title')</title>
    <meta name="theme-color" content="#00a0df"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black"/>
    <meta name="apple-mobile-web-app-title" content="قطرة خير"/>
    <link rel="apple-touch-icon" sizes="72x72" href="{{ url('assets/images/fav.jpg') }}">
    <meta name="msapplication-TileColor" content="#00a0df"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <link rel="manifest" href="{{ url("manifest.json") }}">

    <style>
        .logo {
            width: calc(100px + (130 - 100) * ((100vw - 320px) / (1920 - 320)));
        }


        .header .avatar-wrap {
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            gap: calc(6px + (10 - 6) * ((100vw - 320px) / (1920 - 320)))
        }

        .btn-check:focus + .btn-primary,
        .btn-primary:focus {
            box-shadow: none !important;
        }

        .btn-check:focus + .btn,
        .btn:focus {
            box-shadow: none !important;
        }

        .floating-btn {
            position: fixed;
            bottom: 60px;
            left: 5px;
            z-index: 10;
            gap: 5px;
        }

    </style>
    <!-- Bootstrap 5 -->
    <link rel="stylesheet" id="rtl-link" type="text/css"
          href="{{ url('') }}/assets/css/vendors/bootstrap.rtl.css"/>

    <!-- Iconly Icon css -->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/iconly.css"/>
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/fonts/remixicon/remixicon.css"/>

    <!-- Slick css -->
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/slick.css"/>
    <link rel="stylesheet" type="text/css" href="{{ url('') }}/assets/css/vendors/slick-theme.css"/>

    <!-- Style css -->
    <link rel="stylesheet" id="change-link" type="text/css" href="{{ url('') }}/assets/css/style.css"/>
    @yield('css')
    <style>
        .footer-wrap {
            background-color: #53a3d6;
        }

        .back-icon {
            color: #6c757d;
        }

        body {
            background-color: #aac0d3;
            background-attachment: fixed;
        }

        main,
        .header {
            background-color: #fff;
            background-attachment: fixed;
        }

        main {
            min-height: 100%;
        }

        html,
        body {
            height: 100%;
        }
    </style>
    <base href='{{ url('') }}'/>

    <script>
        var base_url = "{{ url('') }}";
    </script>

    <!-- Snap Pixel Code -->
    <script type='text/javascript'>
        (function (e, t, n) {
            if (e.snaptr) return;
            var a = e.snaptr = function () {
                a.handleRequest ? a.handleRequest.apply(a, arguments) : a.queue.push(arguments)
            };
            a.queue = [];
            var s = 'script';
            r = t.createElement(s);
            r.async = !0;
            r.src = n;
            var u = t.getElementsByTagName(s)[0];
            u.parentNode.insertBefore(r, u);
        })(window, document,
            'https://sc-static.net/scevent.min.js');
        snaptr('init', '6f3b5e08-1392-4c5e-ab2e-d66278418dbf');
        snaptr('track', 'PAGE_VIEW');
    </script>
    <!-- End Snap Pixel Code -->

    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-N59V7W5');</script>
    <!-- End Google Tag Manager -->


    <!-- Google tag Old -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-11084470637"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());

        gtag('config', 'AW-11084470637');
    </script>
    <!-- Google Tag Manager Old -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-539W8DQF');</script>
    <!-- End Google Tag Manager -->
    <!-- Google Tag Manager -->
    <script>(function (w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start':
                    new Date().getTime(), event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5GM9MMJQ');</script>
    <!-- End Google Tag Manager Old -->


    <!-- Hotjar Tracking Code for منصة قطرة -->
    <script>
        (function (h, o, t, j, a, r) {
            h.hj = h.hj || function () {
                (h.hj.q = h.hj.q || []).push(arguments)
            };
            h._hjSettings = {hjid: 3375020, hjsv: 6};
            a = o.getElementsByTagName('head')[0];
            r = o.createElement('script');
            r.async = 1;
            r.src = t + h._hjSettings.hjid + j + h._hjSettings.hjsv;
            a.appendChild(r);
        })(window, document, 'https://static.hotjar.com/c/hotjar-', '.js?sv=');
    </script>
    <!-- Meta Pixel Code -->
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '375537572185019');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none"
             src="https://www.facebook.com/tr?id=375537572185019&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Meta Pixel Code -->

    <!-- Meta Pixel Code -->
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1541580259998313');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none"
             src="https://www.facebook.com/tr?id=1541580259998313&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Meta Pixel Code -->

    <script type="text/javascript">
        (function (c, l, a, r, i, t, y) {
            c[a] = c[a] || function () {
                (c[a].q = c[a].q || []).push(arguments)
            };
            t = l.createElement(r);
            t.async = 1;
            t.src = "https://www.clarity.ms/tag/" + i;
            y = l.getElementsByTagName(r)[0];
            y.parentNode.insertBefore(t, y);
        })(window, document, "clarity", "script", "jcuyndklim");
    </script>

    <script type="text/javascript">
        (function (c, l, a, r, i, t, y) {
            c[a] = c[a] || function () {
                (c[a].q = c[a].q || []).push(arguments)
            };
            t = l.createElement(r);
            t.async = 1;
            t.src = "https://www.clarity.ms/tag/" + i;
            y = l.getElementsByTagName(r)[0];
            y.parentNode.insertBefore(t, y);
        })(window, document, "clarity", "script", "mm2ieebkwr");
    </script>

</head>
<!-- Head End -->

<!-- Body Start -->

<body>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-539W8DQF"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5GM9MMJQ"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N59V7W5" height="0" width="0"
            style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- End Google Tag Manager (noscript) -->
<!-- Skeleton loader Start -->
{{-- @yield('skeleton') --}}
<div class="skeleton-loader">
    <div class="row h-100">
        <div class="d-flex justify-content-center m-auto">
            <img src="{{ url('') }}/assets/images/loader.gif" width="50" height="50"
                 style="width:50px;height:50px;">
            {{-- <div class="spinner-grow text-primary m-5" role="status"> --}}

            {{-- <span class="visually-hidden">جاري التحميل...</span> --}}
            {{-- </div> --}}
        </div>
    </div>
</div>
<!-- Skeleton loader End -->

<!-- Header Start -->
<header class="header">

    <div class="logo-wrap">
        @hasSection('back_url')
            <a href="@yield('back_url')" class="text-gray">
                <i class="ri-arrow-left-s-line back-icon"></i>
            </a>
        @endif

        <a href="{{ route('front.home') }}"> <img class="logo"
                                                  src="{{ url('') }}/assets/images/logo/logo.png" alt="logo"/></a>
    </div>
    <div class="avatar-wrap">
        {{-- <span class="font-sm"><i class="iconly-Location icli font-xl"></i> مكة المكرمة</span> --}}
{{--        <a href="{{ route('lang') }}"> <img class="avatar"--}}
{{--                                            src="{{ url('') }}/assets/images/saudi-arabia-flag.png?v={{ time() }}"--}}
{{--                                            alt="avatar"/></a>--}}
    </div>
    {{-- {{ URL::previous() }} --}}
</header>
<!-- Header End -->


{{-- <div style="background-color: red;min-height: 100%;height: 100%;"> --}}
<!-- Main Start -->
@yield('content')
<!-- Main End -->
{{-- </div> --}}

<!-- Footer Start -->
{{--<footer id="layout_footer">--}}
{{--    <div class="floating-btn d-flex flex-column gap-5">--}}
{{--        <a class="whatsapp-floating" target="_blank" rel="nofollow noopener noreferrer"--}}
{{--           href="https://api.whatsapp.com/send?phone={{config('static.whatsapp')}}">--}}
{{--            <img src="/images/whatsapp.png" width="60">--}}
{{--        </a>--}}
{{--    </div>--}}
{{--    <div class="footer-wrap">--}}
{{--        <ul class="footer">--}}
{{--            <li class="footer-item @if (URL::current() == route('front.home')) active @endif">--}}
{{--                <a href="{{ route('front.home') }}" class="footer-link">--}}
{{--                    <i class="ri-home-6-line icli"></i>--}}
{{--                    <span>الرئيسية</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            --}}{{-- <li class="footer-item @if (Request::is('mosques')) active @endif">--}}
{{--                <a href="{{ route('front.mosques') }}" class="footer-link">--}}
{{--                    <i class="ri-map-pin-range-line icli"></i>--}}
{{--                    <span>المساجد</span>--}}
{{--                </a>--}}
{{--            </li> --}}

{{--            <li class="footer-item @if (URL::current() == route('front.orders')) active @endif">--}}
{{--                <a href="{{ route('front.orders') }}" class="footer-link">--}}
{{--                    <i class="ri-bill-line icli"></i>--}}
{{--                    <span>طلباتي</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            <li class="footer-item @if (URL::current() == route('about')) active @endif">--}}
{{--                <a href="{{ route('about') }}" class="footer-link">--}}
{{--                    <i class="ri-book-open-line icli"></i>--}}
{{--                    <span>حول</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--            <li class="footer-item @if (URL::current() == route('lang')) active @endif">--}}
{{--                <a href="{{ route('lang') }}" class="footer-link">--}}
{{--                    --}}{{-- <lord-icon class="icon" src="{{ url('') }}/assets/icons/gift.json" trigger="loop"--}}
{{--                        stroke="70" colors="primary:#ffffff,secondary:#ffffff"></lord-icon> --}}
{{--                    <i class="ri-global-line"></i>--}}
{{--                    <span class="offer">اللغة</span>--}}
{{--                </a>--}}
{{--            </li>--}}
{{--            --}}{{-- <li class="footer-item">--}}
{{--                <a href="https://wa.me/966551122267?text={{ urlencode("لدي طلب أو استفسار بخصوص منصة قطرة خير\n") }}" target="_blank" class="footer-link">--}}
{{--                    <i class="ri-whatsapp-line"></i>--}}
{{--                    <span class="offer">واتساب</span>--}}
{{--                </a>--}}
{{--            </li> --}}
{{--            <li class="footer-item @if (Request::is('user/account')) active @endif">--}}
{{--                <a href="{{ route('user.account') }}" class="footer-link">--}}
{{--                    --}}{{-- <lord-icon class="icon" src="{{ url('') }}/assets/icons/gift.json" trigger="loop"--}}
{{--                        stroke="70" colors="primary:#ffffff,secondary:#ffffff"></lord-icon> --}}
{{--                    <i class="ri-account-circle-line"></i>--}}
{{--                    <span class="offer">حسابي</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--        </ul>--}}
{{--    </div>--}}

{{--</footer>--}}
<!-- Footer End -->

<!-- Action Language Start -->
{{-- <div class="action action-language offcanvas offcanvas-bottom" tabindex="-1" id="language"
    aria-labelledby="language">
    <div class="offcanvas-body small">
        <h2 class="m-b-title1 font-md">Select Language</h2>

        <ul class="list">
            <li>
                <a href="javascript:void(0)" data-bs-dismiss="offcanvas" aria-label="Close"> <img
                        src="{{ url('') }}/assets/icons/flag/us.svg" alt="us" /> English </a>
            </li>

            <li>
                <a href="javascript:void(0)" data-bs-dismiss="offcanvas" aria-label="Close"> <img
                        src="{{ url('') }}/assets/icons/flag/in.svg" alt="us" />Indian </a>
            </li>

            <li>
                <a href="javascript:void(0)" data-bs-dismiss="offcanvas" aria-label="Close"> <img
                        src="{{ url('') }}/assets/icons/flag/it.svg" alt="us" />Italian</a>
            </li>

            <li>
                <a href="javascript:void(0)" data-bs-dismiss="offcanvas" aria-label="Close"> <img
                        src="{{ url('') }}/assets/icons/flag/tf.svg" alt="us" /> French</a>
            </li>

            <li>
                <a href="javascript:void(0)" data-bs-dismiss="offcanvas" aria-label="Close"> <img
                        src="{{ url('') }}/assets/icons/flag/cn.svg" alt="us" /> Chines</a>
            </li>
        </ul>
    </div>
</div> --}}
<!-- Action Language End -->

<!-- Pwa Install App Popup Start -->
{{-- <div class="offcanvas offcanvas-bottom addtohome-popup show" tabindex="-1" id="offcanvas">
  <div class="offcanvas-body small">
    <div class="app-info">
      <img src="{{ url('assets/images/fav.jpg') }}" class="img-fluid" alt="" />
      <div class="content">
        <h3>قطرة خير <i data-feather="x" data-bs-dismiss="offcanvas"></i></h3>
        <a href="https://qatra.sa">qatra.sa</a>
      </div>
    </div>
    <button class="btn-solid install-app" id="installApp">Add to home screen</button>
  </div>
</div> --}}
<!-- Pwa Install App Popup End -->

<!-- jquery 3.6.0 -->
<script src="{{ url('') }}/assets/js/jquery-3.6.0.min.js"></script>

<!-- Bootstrap Js -->
<script src="{{ url('') }}/assets/js/bootstrap.bundle.min.js"></script>

<!-- Lord Icon -->
<script src="{{ url('') }}/assets/js/lord-icon-2.1.0.js"></script>

<!-- Feather Icon -->
<script src="{{ url('') }}/assets/js/feather.min.js"></script>

<!-- Slick Slider js -->


<!-- Add To Home  js -->
{{-- <script src="{{ url('') }}/assets/js/homescreen-popup.js"></script> --}}

<!-- Theme Setting js -->
{{-- <script src="{{ url('') }}/assets/js/theme-setting.js?v={{ time() }}"></script> --}}

<!-- Script js -->
<script src="{{ url('') }}/assets/js/script.js?v=5"></script>
<script>
    $('.disableafterclick').on('click', function () {
        $(this).attr('disabled', 'disabled');
        $(this).html(
            '<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>'
        );
        $(this).parents('form').submit();
    });
</script>
{{--
<script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/9.10.0/firebase-app.js";
    const firebaseConfig = {
        apiKey: "AIzaSyBt1J8Sw2fZzmzKdBviTpL1biFzQv3-Ugg",
        authDomain: "qatra-361619.firebaseapp.com",
        projectId: "qatra-361619",
        storageBucket: "qatra-361619.appspot.com",
        messagingSenderId: "972020496108",
        appId: "1:972020496108:web:bea323e9db727d9e8f97c9"
    };
    const app = initializeApp(firebaseConfig);
</script>
--}}
@auth
    {{--
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase.js"></script>
    <script>
        var firebaseConfig = {
            apiKey: "AIzaSyBt1J8Sw2fZzmzKdBviTpL1biFzQv3-Ugg",
            authDomain: "qatra-361619.firebaseapp.com",
            projectId: "qatra-361619",
            storageBucket: "qatra-361619.appspot.com",
            messagingSenderId: "972020496108",
            appId: "1:972020496108:web:bea323e9db727d9e8f97c9"
        };
        firebase.initializeApp(firebaseConfig);
        const messaging = firebase.messaging();

        function startFCM() {
            messaging
                .requestPermission()
                .then(function() {
                    return messaging.getToken()
                })
                .then(function(response) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: '{{ route('store.token') }}',
                        type: 'POST',
                        data: {
                            token: response
                        },
                        dataType: 'JSON',
                        success: function(response) {
                            alert('Token stored.');
                        },
                        error: function(error) {
                            alert(error);
                        },
                    });
                }).catch(function(error) {
                    alert(error);
                });
        }
        messaging.onMessage(function(payload) {
            const title = payload.notification.title;
            const options = {
                body: payload.notification.body,
                icon: payload.notification.icon,
            };
            new Notification(title, options);
        });
        startFCM();
    </script>
    --}}
@endauth


<script async src="https://www.googletagmanager.com/gtag/js?id=G-LB26SXQV0Z"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());

    gtag('config', 'G-LB26SXQV0Z');
</script>


@if(config('app.env') === 'production')
   {{-- <script>
        !function (w, d, t) {
            w.TiktokAnalyticsObject = t;
            var ttq = w[t] = w[t] || [];
            ttq.methods = ["page", "track", "identify", "instances", "debug", "on", "off", "once", "ready", "alias", "group", "enableCookie", "disableCookie"], ttq.setAndDefer = function (t, e) {
                t[e] = function () {
                    t.push([e].concat(Array.prototype.slice.call(arguments, 0)))
                }
            };
            for (var i = 0; i < ttq.methods.length; i++) ttq.setAndDefer(ttq, ttq.methods[i]);
            ttq.instance = function (t) {
                for (var e = ttq._i[t] || [], n = 0; n < ttq.methods.length; n++
                ) ttq.setAndDefer(e, ttq.methods[n]);
                return e
            }, ttq.load = function (e, n) {
                var i = "https://analytics.tiktok.com/i18n/pixel/events.js";
                ttq._i = ttq._i || {}, ttq._i[e] = [], ttq._i[e]._u = i, ttq._t = ttq._t || {}, ttq._t[e] = +new Date, ttq._o = ttq._o || {}, ttq._o[e] = n || {};
                n = document.createElement("script");
                n.type = "text/javascript", n.async = !0, n.src = i + "?sdkid=" + e + "&lib=" + t;
                e = document.getElementsByTagName("script")[0];
                e.parentNode.insertBefore(n, e)
            };

            ttq.load('CM0ESUBC77U38ABK1L8G');
            ttq.page();
        }(window, document, 'ttq');
        @auth
        ttq.identify({
            email: '{{ Auth::user()->email }}',
            phone_number: '+{{ Auth::user()->mobile }}',
        })
        @endauth

    </script>--}}
@endif

<!-- Twitter conversion tracking base code -->
<script>
    !function (e, t, n, s, u, a) {
        e.twq || (s = e.twq = function () {
            s.exe ? s.exe.apply(s, arguments) : s.queue.push(arguments);
        }, s.version = '1.1', s.queue = [], u = t.createElement(n), u.async = !0, u.src = 'https://static.ads-twitter.com/uwt.js',
            a = t.getElementsByTagName(n)[0], a.parentNode.insertBefore(u, a))
    }(window, document, 'script');
    twq('config', 'oi6qe');
</script>

<!-- End Twitter conversion tracking base code -->

@yield('js')


</body>
<!-- Body End -->

</html>
