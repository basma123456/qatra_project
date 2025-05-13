@extends('admin.layout')

@section('title')
البطاقات | إضافة بطاقة
@endsection
@section('css')
@endsection
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4"><span class="text-muted fw-light">البطاقات /</span> استعراض البطاقات</h4>
        <!-- Invoice List Table -->

        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">إضافة بطاقة</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.cards.create') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <div class="mb-3">
                                <label class="form-label" for="img">صورة البطاقة</label>
                                <input class="form-control" name="img" type="file" accept="image/png, image/jpeg" />
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <div class="text-light small fw-semibold mb-3">بطاقة تبرع</div>
                            <label class="switch">
                                <input type="checkbox" class="switch-input" name="is_payment" value="1"/>
                                <span class="switch-toggle-slider">
                                    <span class="switch-on"></span>
                                    <span class="switch-off"></span>
                                </span>
                                <span class="switch-label">تفعيل</span>
                            </label>
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <div class="text-light small fw-semibold mb-3">بطاقة إهداء</div>
                            <label class="switch">
                                <input type="checkbox" class="switch-input" name="is_gift" value="1"/>
                                <span class="switch-toggle-slider">
                                    <span class="switch-on"></span>
                                    <span class="switch-off"></span>
                                </span>
                                <span class="switch-label">تفعيل</span>
                            </label>
                        </div>
                        <div class="col-sm-6 col-md-2">
                            <div class="text-light small fw-semibold mb-3">الحالة</div>
                            <label class="switch">
                                <input type="checkbox" class="switch-input" name="status" value="1"/>
                                <span class="switch-toggle-slider">
                                    <span class="switch-on"></span>
                                    <span class="switch-off"></span>
                                </span>
                                <span class="switch-label">مفعلة</span>
                            </label>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="mb-3">
                                <label class="form-label" for="img">النص المرسل مع البطاقة</label>
                                <textarea class="form-control" name="text" rows="5"></textarea>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">حفظ</button>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection
