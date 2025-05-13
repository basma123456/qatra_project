@extends('admin.layout')

@section('title')
    إضافة كوبون
@endsection
@section('css')
@endsection
@section('breadcrumb')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">إدارة الكوبونات /</span>
        إضافة كوبون
    </h4>
@endsection
@section('content')
    <div class="card mb-4">
        <h5 class="card-header">إضافة كوبون</h5>
        <form class="card-body" action="{{ route('admin.coupon.store') }}" method="POST">
            @csrf
            <div class="row g-3">
                <div class="col-md-12">
                    <h4 class="mt-4 mb-0">معلومات الكوبون</h4>
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-state">المسوق</label>
                    <p>{{ $marketer->name }}</p>
                    @error('marketer_id')
                        <div class="is-invalid"></div>
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-fullname">كود الكوبون</label>
                    <input type="text" name="code" value="{{ old('code') }}"
                        class="form-control @error('code') is-invalid @enderror" placeholder="كود الكوبون" />
                    @error('code')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-state"> المنتجات الذي لديها هديه</label>
                    <select name="products[]" multiple class="select2 form-control @error('products') is-invalid @enderror"
                        data-allow-clear="true">
                        <option value="" disabled>اختر المنتج الهدية</option>
                        @foreach ($products as $product)
                            <option @if (in_array($product->id,  old('products')??[]) ) selected @endif value="{{ $product->id }}">
                                {{ $product->name_ar }}</option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <div class="is-invalid"></div>
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-state">المنتج الهدية</label>
                    <select name="product_id" class="select2 form-select @error('product_id') is-invalid @enderror"
                        data-allow-clear="true">
                        <option value="" disabled selected>اختر المنتج الهدية</option>
                        @foreach ($products as $product)
                            <option @if (old('product_id') == $product->id) selected @endif value="{{ $product->id }}">
                                {{ $product->name_ar }}</option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <div class="is-invalid"></div>
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-3">
                    <label class="form-label" for="collapsible-fullname">الكمية لكل 100 ريال</label>
                    <input type="number" name="quantity" value="{{ old('quantity') }}"
                        class="form-control @error('quantity') is-invalid @enderror" placeholder="العدد" />
                    @error('quantity')
                        <div class="invalid-feedback" role="alert">{{ $message }}</div>
                    @enderror
                </div>


                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>

            </div>
            <input type="hidden" name="marketer_id" value="{{ $marketer->id }}" />
        </form>
    </div>
@endsection
@section('js')
    <script></script>
@endsection
