<div>
    <div class="table-responsive text-nowrap">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>م</th>
                    <th> الاسم </th>
                    <th> رقم الجوال </th>
                    <th> رقم الاشتراك </th>
                    <th>الحالة</th>
                    <th>عمليات</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                {{-- @foreach ($mosquetypes as $item) --}}
                @php $result =  $instance->status() @endphp
                <tr>
                    <td>1</td>
                    <td><strong>
                            @if ($result !== false)
                                {{ $result->name }}
                            @else
                                الجهاز غير متصل
                            @endif
                        </strong></td>
                    <td><strong>
                            @if ($result !== false)
                                {{ $result->phone }}
                            @else
                                الجهاز غير متصل
                            @endif
                        </strong></td>
                    <td><strong>{{ $instance->appkey }}
                        </strong></td>
                    <td wire:poll.10000ms><strong>

                            @if ($result !== false)
                                الجهاز متصل
                            @else
                                <p>الجهاز غير متصل</p>

                                @php $qr =  $instance->qrcode() @endphp
                                @if ($qr !== false)
                                    <p><img src="{{ $qr }}" style="max-width: 300px"></p>
                                @endif

                                <p>{{ now() }}</p>
                            @endif
                        </strong></td>
                    <td>
                        <div class="btn-group btn-group-sm" role="group" aria-label="Basic button group">
                            <button wire:click="restart" class="btn btn-light" title=" إعادة تشغيل"><i
                                    class="bx bx-reset me-1"></i></button>
                            @if ($result !== false)
                                <button wire:click="logout" class="btn btn-light" title="تسجيل الخروج"><i
                                        class="bx bx-log-out-circle me-1"></i> </button>
                            @endif
                        </div>
                    </td>
                </tr>
                {{-- @endforeach --}}
            </tbody>
        </table>
    </div>
</div>
