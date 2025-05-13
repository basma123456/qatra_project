@extends('layouts.app')
@section('title')
@endsection
@section('css')
    <style>
        .font-social {
            font-size: 35px;
        }

        .facebook {
            color: #4267B2;
        }

        .twitter {
            color: #1DA1F2;
        }

        .instagram {
            color: #C13584;
        }

        .line200 {
            line-height: 200%;
        }

        .operationby {
            margin: 3%;
            padding: 3%;
            border: dotted 1px #1DA1F2;
        }

        /* .operationby ul {
                list-style: square;
            } */

        .operationby ul li {
            line-height: 200%;
            margin-right: 8%;
        }

        .content-color {
            text-align: justify;
            line-height: 150%;
        }

        .list-section {
            list-style: none;
        }

        .list-section li::before {
            content: "\2022";
            /* Add content: \2022 is the CSS Code/unicode for a bullet */
            color: #1DA1F2;
            /* Change the color */
            font-weight: bold;
            /* If you want it to be bold */
            display: inline-block;
            /* Needed to add space between the bullet and the text */
            width: 1em;
            /* Also needed for space (tweak if needed) */
            margin-right: -1em;
            /* Also needed for space (tweak if needed) */
        }
    </style>
@endsection
@section('skeleton')
@endsection
@section('content')
    <main class="main-wrap about-us-page mb-xxl">
        <div class="banner-box">
            <div class="bg-shape">
                <img src="{{ url('') }}/assets/images/Qatrah-Pattern.png" alt="about-us" />
            </div>
        </div>

        <section class="who-we-are">
            <h2 class="title-color font-md mt-3">حول قطرة خير</h2>
            <p class="content-color my-2 line200">
                أهلاً بكم في موقع وتطبيق "قطرة خير" الإلكتروني الذي ينطلق من مكة المكرمة بالمملكة العربية السعودية.
            </p>
            <p class="content-color my-2 line200 mt-3">
                <b>يا باغي الخير أقبل!</b>
            </p>
            <p class="content-color my-2 line200">
                يقدم لكم الموقع الإلكتروني فرصاً عظيمة لكسب الأجر من خلال خدمة شراء مياه الشرب بغرض توزيعها على مساجد مكة
                المكرمة وداخل حدود الحرم. حيث يجتمع أجر السقيا مع شرف المكان.
            </p>
            <p class="content-color my-2 line200">
                عند شرائكم من الموقع يمكنكم تحديد المسجد الذي ترغبون التوصيل له، وسنقوم بعملية توفير المنتجات وتوصيلها عنكم
                للعنوان الذي قمتم باختياره، مع تصوير وتوثيق ذلك ومشاركته معكم.
            </p>
            <p class="content-color my-2 line200">
                يمكنكم متابعة حالة طلبكم بعد الشراء من خلال خاصية التتبّع في الموقع.
            </p>
            <p class="content-color my-2 line200 mt-3">
                <b>وختاماً... </b>
            </p>
            <p class="content-color my-2 line200">
                ورد في حديث أبي سعيد الخدري أن رسول الله ﷺ قال: <span style="color:#1DA1F2">(... وأيُّما مسلمٍ سقى مسلمًا
                    على ظمَأٍ سقاه
                    اللهُ من الرحيقِ المختومِ)</span> رواه أبو داود.
            </p>
            <p class="content-color my-2 line200">
                نسأل الله أن يوفقنا وإياكم ويعيننا على اغتنام عظيم الأجر
            </p>
            <div class="operationby">
                <ul class="list-section">
                    <li class="content-color"> يتم تشغيل الموقع وإدارته من قبل "شركة رؤية للتجارة" (سجل تجاري رقم:
                        4031250119) </li>
                    <li class="content-color"> "قطرة خير" هي علامة تجارية مسجلة رسمياً في المملكة العربية السعودية</li>
                    <li class="content-color"> موقع قطرة مسجل رسمياً في دليل "معروف" للمتاجر الرسمية في المملكة العربية
                        السعودية (<a href="https://maroof.sa/261803" target="_blank">رابط التحقق</a>)
                    </li>
                </ul>
            </div>
            <p class="content-color my-2 line200">
                لأي مقترحات أو استفسارات يمكنكم التواصل معنا، من خلال <a href="#">نموذج الاتصال</a> أو على الرقم (واتس
                أب) أدناه.
            </p>
            <p class="content-color my-2 line200 text-center">
                <a href="https://wa.me/966551122267" target="_blank"><i class="ri-whatsapp-line"
                        style="color:#25D366;font-size:30px;"></i></a>
            </p>
            <div class="operationby">
                <p class="content-color my-2 line200 text-center">
                    قريباً سيتم إطلاق تطبيقات الجوال الخاصة بالموقع على أندرويد وآيفون
                </p>
            </div>
            <p class="content-color my-2 mt-4 line200 text-center">
                <a href="#" target="_blank" class="mx-3"><i class="ri-app-store-line"
                        style="color:#00a0df;font-size:40px;"></i></a>
                <a href="#" target="_blank" class="mx-3"><i class="ri-google-play-line"
                        style="color:#00a0df;font-size:40px;"></i></a>
            </p>

        </section>

        {{-- <iframe class="mb-5" width="100%" height="315" src="https://www.youtube.com/embed/LF-Osq5cI_g"
            title="YouTube video player" frameborder="0"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen></iframe> --}}
    </main>
@endsection
@section('js')
@endsection
