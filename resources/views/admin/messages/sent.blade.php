@extends('admin.layout')

@section('title')
    إدارة الرسائل المرسلة
@endsection

@section('css')
@endsection

@section('breadcrumb')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">إدارة الرسائل /</span>
        استعراض
        الرسائل
        المرسلة
    </h4>
@endsection

@section('content')
    <div class="card mt-4">
        <h5 class="card-header">استعراض الرسائل المرسلة</h5>
        <div class="row mx-2 mb-4">
            <div class="col-md-2">

            </div>
            <div class="col-md-10">
                <div
                    class="text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0">
                    {{-- <div class="dt-buttons"> <a href="{{ route('admin.transfer.create') }}"
                            class="btn btn-primary ms-3"><span><i class="bx bx-plus me-0 me-lg-2"></i> إضافة مسجد</span></a>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="table-responsive text-nowrap">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>رقم الجوال</th>
                        <th>الرسالة</th>
                        <th>تاريخ الإرسال</th>
                    </tr>
                </thead>
                <tbody class="table-btransfer-bottom-0">
                    @foreach ($messages as $message)
                        <tr id="message_{{ $message->id }}">
                            <td>{{ $message->id }}</td>
                            <td><strong>{{ $message->mobile }}</strong></td>
                            <td>
                                @if ($message->file != null)
                                    <a target="_blank" href="{{ $message->file }}">
                                        @if (strpos($message->file, 'pdf'))
                                            <i class='bx bxs-file-pdf fs-1'></i>
                                        @else
                                            <img src="{{ $message->file }}" class="border rounded p-1"
                                                style="width: 100px" />
                                        @endif
                                    </a><br>
                                @endif
                                {!! nl2br($message->message) !!}
                            </td>
                            <td>{{ $message->created_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="min-height: 100px;">
                {{ $messages->links() }}
            </div>
        </div>
    </div>
@endsection

@section('js')
@endsection
