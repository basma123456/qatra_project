@extends('layouts.app')
@section('title')
@endsection
@section('css')
@endsection
@section('skeleton')
@endsection
@section('content')
    <main class="main-wrap order-history mb-xxl">
        <!-- Catagories Tabs  Start -->
        <ul class="nav nav-tab nav-pills custom-scroll-hidden" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="catagories1-tab" data-bs-toggle="pill" data-bs-target="#catagories1"
                    type="button" role="tab" aria-controls="catagories1" aria-selected="true">
                    تحت التنفيذ
                </button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="catagories2-tab" data-bs-toggle="pill" data-bs-target="#catagories2"
                    type="button" role="tab" aria-controls="catagories2" aria-selected="false">
                    تم التنفيذ
                </button>
            </li>

            <li class="nav-item" role="presentation">
                <button class="nav-link" id="catagories3-tab" data-bs-toggle="pill" data-bs-target="#catagories3"
                    type="button" role="tab" aria-controls="catagories3" aria-selected="false">ملغي</button>
            </li>

            
        </ul>
        <!-- Catagories Tabs  End -->

        <!-- Search Box Start -->
        <div class="search-box">
            <div>
                <i class="iconly-Search icli search"></i>
                <input class="form-control" type="search" placeholder="ابحث عن طلب سابق..." />
                <i class="iconly-Voice icli mic"></i>
            </div>
            <button class="filter font-md" type="button" data-bs-toggle="offcanvas" data-bs-target="#filter"
                aria-controls="filter">بحث</button>
        </div>
        <!-- Search Box End -->

        <!-- Tab Content Start -->
        <section class="tab-content ratio2_1" id="pills-tabContent">
            <!-- Catagories Content Start -->
            <div class="tab-pane fade show active" id="catagories1" role="tabpanel" aria-labelledby="catagories1-tab">
                
                
                
                
                
                <div class="text-center p-4">
                <div class="spinner-border" role="status">
                    <span class="sr-only"></span>
                </div>
                </div>
                <!-- Order Box End -->

            </div>
            <!-- Catagories Content End -->

            <!-- Catagories Content Start -->
            <div class="tab-pane fade" id="catagories2" role="tabpanel" aria-labelledby="catagories2-tab">
                
                
                
                
                
                <div class="text-center p-4">
                <div class="spinner-border" role="status">
                    <span class="sr-only"></span>
                </div>
                </div>
                <!-- Order Box End -->
            </div>
            <!-- Catagories Content End -->

            <!-- Catagories Content Start -->
            <div class="tab-pane fade" id="catagories3" role="tabpanel" aria-labelledby="catagories3-tab">
                
                
                
                
                
                <div class="text-center p-4">
                <div class="spinner-border" role="status">
                    <span class="sr-only"></span>
                </div>
                </div>
                <!-- Order Box End -->
            </div>
            <!-- Catagories Content End -->

            <!-- Catagories Content Start -->
            <div class="tab-pane fade" id="catagories4" role="tabpanel" aria-labelledby="catagories4-tab">
                
                
                
                <div class="text-center p-4">
                <div class="spinner-border" role="status">
                    <span class="sr-only"></span>
                </div>
                </div>
                <!-- Order Box End -->
            </div>
            <!-- Catagories Content End -->
        </section>
        <!-- Tab Content End -->
    </main>
@endsection
@section('js')
@endsection
