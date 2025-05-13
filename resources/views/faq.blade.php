@extends('layouts.app')
@section('title')
@endsection
@section('css')
@endsection
@section('skeleton')
@endsection
@section('content')
    <main class="main-wrap help-page mb-xxl">
        <!-- Search Box Start -->
        <div class="search-box">
            <i class="iconly-Search icli search"></i>
            <input class="form-control" type="search" placeholder="Search here..." />
            <i class="iconly-Voice icli mic"></i>
        </div>
        <!-- Search Box End -->

        <!-- Frequently Asked Questions Start -->
        <section class="questions-section pb-0">
            <!-- Catagories Tabs  Start -->
            <ul class="nav nav-tab nav-pills custom-scroll-hidden" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="catagories1-tab" data-bs-toggle="pill" data-bs-target="#catagories1"
                        type="button" role="tab" aria-controls="catagories1" aria-selected="true">
                        Payment
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="catagories2-tab" data-bs-toggle="pill" data-bs-target="#catagories2"
                        type="button" role="tab" aria-controls="catagories2" aria-selected="false">
                        Coupons
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="catagories3-tab" data-bs-toggle="pill" data-bs-target="#catagories3"
                        type="button" role="tab" aria-controls="catagories3" aria-selected="false">
                        Reservation
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="catagories4-tab" data-bs-toggle="pill" data-bs-target="#catagories4"
                        type="button" role="tab" aria-controls="catagories4" aria-selected="false">
                        Return Order
                    </button>
                </li>
            </ul>
            <!-- Catagories Tabs  End -->

            <div class="banner section-p-tb">
                <img src="{{ url("") }}/assets/svg/help.svg" alt="help" />
            </div>

            <!-- Tab Content Start -->
            <div class="tab-content ratio2_1" id="pills-tabContent">
                <!-- Catagories Content Start -->
                <div class="tab-pane fade show active" id="catagories1" role="tabpanel" aria-labelledby="catagories1-tab">
                    <h1 class="font-md fw-600">Frequently Asked Questions</h1>
                    <!-- Product Detail Accordian Start -->
                    <div class="accordion" id="accordionExample-1">
                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    Do you also have a physical store?
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse show" aria-labelledby="heading1"
                                data-bs-parent="#accordionExample-1">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->

                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    Where can i subscribe to newsletter?
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2"
                                data-bs-parent="#accordionExample-1">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->

                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    Can I reserve a magazine?
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3"
                                data-bs-parent="#accordionExample-1">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->

                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    What are your opening hours?
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4"
                                data-bs-parent="#accordionExample-1">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->

                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                    General Terms & Conditions (GTC)
                                </button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5"
                                data-bs-parent="#accordionExample-1">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->

                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading6">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                    Do I have the right to return an item?
                                </button>
                            </h2>
                            <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6"
                                data-bs-parent="#accordionExample-1">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->
                    </div>
                </div>
                <!-- Catagories Content End -->

                <!-- Catagories Content Start -->
                <div class="tab-pane fade" id="catagories2" role="tabpanel" aria-labelledby="catagories2-tab">
                    <h1 class="font-md fw-600">Frequently Asked Questions</h1>
                    <!-- Product Detail Accordian Start -->
                    <div class="accordion" id="accordionExample-7">
                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading7">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse7" aria-expanded="true" aria-controls="collapse7">
                                    Do you also have a physical store?
                                </button>
                            </h2>
                            <div id="collapse7" class="accordion-collapse collapse show" aria-labelledby="heading7"
                                data-bs-parent="#accordionExample-7">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->

                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading8">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                    Where can i subscribe to newsletter?
                                </button>
                            </h2>
                            <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="heading8"
                                data-bs-parent="#accordionExample-7">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->

                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading9">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                                    Can I reserve a magazine?
                                </button>
                            </h2>
                            <div id="collapse9" class="accordion-collapse collapse" aria-labelledby="heading9"
                                data-bs-parent="#accordionExample-7">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->

                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading10">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
                                    What are your opening hours?
                                </button>
                            </h2>
                            <div id="collapse10" class="accordion-collapse collapse" aria-labelledby="heading10"
                                data-bs-parent="#accordionExample-7">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->

                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading11">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
                                    General Terms & Conditions (GTC)
                                </button>
                            </h2>
                            <div id="collapse11" class="accordion-collapse collapse" aria-labelledby="heading11"
                                data-bs-parent="#accordionExample-7">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->

                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading12">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
                                    Do I have the right to return an item?
                                </button>
                            </h2>
                            <div id="collapse12" class="accordion-collapse collapse" aria-labelledby="heading12"
                                data-bs-parent="#accordionExample-7">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->
                    </div>
                </div>
                <!-- Catagories Content End -->

                <!-- Catagories Content Start -->
                <div class="tab-pane fade" id="catagories3" role="tabpanel" aria-labelledby="catagories3-tab">
                    <h1 class="font-md fw-600">Frequently Asked Questions</h1>
                    <!-- Product Detail Accordian Start -->
                    <div class="accordion" id="accordionExample-13">
                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading13">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse13" aria-expanded="true" aria-controls="collapse13">
                                    Do you also have a physical store?
                                </button>
                            </h2>
                            <div id="collapse13" class="accordion-collapse collapse show" aria-labelledby="heading13"
                                data-bs-parent="#accordionExample-13">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->

                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading14">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse14" aria-expanded="false" aria-controls="collapse14">
                                    Where can i subscribe to newsletter?
                                </button>
                            </h2>
                            <div id="collapse14" class="accordion-collapse collapse" aria-labelledby="heading14"
                                data-bs-parent="#accordionExample-13">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->

                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading15">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse15" aria-expanded="false" aria-controls="collapse15">
                                    Can I reserve a magazine?
                                </button>
                            </h2>
                            <div id="collapse15" class="accordion-collapse collapse" aria-labelledby="heading15"
                                data-bs-parent="#accordionExample-13">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->

                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading16">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse16" aria-expanded="false" aria-controls="collapse16">
                                    What are your opening hours?
                                </button>
                            </h2>
                            <div id="collapse16" class="accordion-collapse collapse" aria-labelledby="heading16"
                                data-bs-parent="#accordionExample-13">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->

                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading17">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse17" aria-expanded="false" aria-controls="collapse17">
                                    General Terms & Conditions (GTC)
                                </button>
                            </h2>
                            <div id="collapse17" class="accordion-collapse collapse" aria-labelledby="heading17"
                                data-bs-parent="#accordionExample-13">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->

                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading18">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse18" aria-expanded="false" aria-controls="collapse18">
                                    Do I have the right to return an item?
                                </button>
                            </h2>
                            <div id="collapse18" class="accordion-collapse collapse" aria-labelledby="heading18"
                                data-bs-parent="#accordionExample-13">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->
                    </div>
                </div>
                <!-- Catagories Content End -->

                <!-- Catagories Content Start -->
                <div class="tab-pane fade" id="catagories4" role="tabpanel" aria-labelledby="catagories4-tab">
                    <h1 class="font-md fw-600">Frequently Asked Questions</h1>
                    <!-- Product Detail Accordian Start -->
                    <div class="accordion" id="accordionExample-19">
                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading19">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse19" aria-expanded="true" aria-controls="collapse19">
                                    Do you also have a physical store?
                                </button>
                            </h2>
                            <div id="collapse19" class="accordion-collapse collapse show" aria-labelledby="heading19"
                                data-bs-parent="#accordionExample-19">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->

                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading20">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse20" aria-expanded="false" aria-controls="collapse20">
                                    Where can i subscribe to newsletter?
                                </button>
                            </h2>
                            <div id="collapse20" class="accordion-collapse collapse" aria-labelledby="heading20"
                                data-bs-parent="#accordionExample-19">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->

                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading21">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse21" aria-expanded="false" aria-controls="collapse21">
                                    Can I reserve a magazine?
                                </button>
                            </h2>
                            <div id="collapse21" class="accordion-collapse collapse" aria-labelledby="heading21"
                                data-bs-parent="#accordionExample-19">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->

                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading22">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse22" aria-expanded="false" aria-controls="collapse22">
                                    What are your opening hours?
                                </button>
                            </h2>
                            <div id="collapse22" class="accordion-collapse collapse" aria-labelledby="heading22"
                                data-bs-parent="#accordionExample-19">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->

                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading23">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse23" aria-expanded="false" aria-controls="collapse23">
                                    General Terms & Conditions (GTC)
                                </button>
                            </h2>
                            <div id="collapse23" class="accordion-collapse collapse" aria-labelledby="heading23"
                                data-bs-parent="#accordionExample-19">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->

                        <!-- Accordion Satart -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading24">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapse24" aria-expanded="false" aria-controls="collapse24">
                                    Do I have the right to return an item?
                                </button>
                            </h2>
                            <div id="collapse24" class="accordion-collapse collapse" aria-labelledby="heading24"
                                data-bs-parent="#accordionExample-19">
                                <div class="accordion-body">
                                    <p class="content-color font-xs">
                                        No, we don’t have a physical store location at the moment. We accept only orders
                                        through our online shop and we’re shipping all orders. Please visit our shipping
                                        section for more
                                        details.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <!-- Accordion End -->
                    </div>
                </div>
                <!-- Catagories Content End -->
            </div>
            <!-- Tab Content End -->
        </section>
        <!-- Frequently Asked Questions End -->
    </main>
@endsection
@section('js')
@endsection
