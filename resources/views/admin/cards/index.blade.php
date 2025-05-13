@extends('admin.layout')

@section('title')
    البطاقات
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css') }}" />
@endsection
@section('breadcrumb')
    <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light"> نظام قطرة /</span><span class="text-muted fw-light">إدارة البطاقات /</span> استعراض
        البطاقات
    </h4>
@endsection
@section('content')

        <div class="card">

            <div class="row">
                <div class="col-9">
                    {{-- <h4 class="mt-3 mx-2">استعراض البطاقات</h4> --}}
                </div>
                <div class="col-3 text-end">
                    <a class="my-3 mx-2 btn btn-secondary add-new btn-primary" href="{{ route('admin.cards.create') }}">
                        إضافة بطاقة
                    </a>
                </div>
            </div>
            <div class="card-datatable table-responsive">
                <table class="invoice-list-table table border-top">
                    <thead>
                        <tr>
                            {{-- <th class="text-center">
                                <h5 class="my-3">#</h5>
                            </th> --}}
                            <th class="text-center">
                                <h5 class="my-3">الصورة</h5>
                            </th>
                            <th>
                                <h5 class="my-3">بطاقة تبرع</h5>
                            </th>
                            <th class="text-center">
                                <h5 class="my-3">بطاقة إهداء</h5>
                            </th>
                            <th class="text-center">
                                <h5 class="my-3">الحالة</h5>
                            </th>
                            <th class="text-center">
                                <h5 class="my-3">عمليات</h5>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cards as $card)
                            <tr>
                                {{-- <td class="text-center">{{ $card->id }}</td> --}}
                                <td class="text-center">
                                    @if ($card->img != null)
                                        <img style="max-width: 200px;" src="{{ url('storage/' . $card->img) }}"
                                            class="img-fluid border rounded" />
                                    @endif
                                </td>
                                <td class="text-center">{{ $card->is_payment ? 'نعم' : 'لا' }}</td>
                                <td class="text-center">{{ $card->is_gift ? 'نعم' : 'لا' }}</td>
                                <td class="text-center">{{ $card->status ? 'مفعلة' : 'غير مفعلة' }}</td>
                                <td class="text-center">
                                    <div class="d-inline-block text-nowrap">
                                        <a href="{{ route('admin.cards.edit', $card) }}"
                                            class="btn btn-sm btn-icon delete-record" title="تعديل">
                                            <i class='bx bx-edit'></i>
                                        </a>
                                        <a href="{{ route('admin.cards.delete', $card) }}"
                                            class="btn btn-sm btn-icon delete-record" title="حذف">
                                            <i class='bx bx-trash'></i>
                                        </a>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-3 d-flex justify-content-center">
                    {{ $cards->links() }}
                </div>
            </div>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser"
                aria-labelledby="offcanvasAddUserLabel">
                <div class="offcanvas-body mx-0 flex-grow-0">
                    <div class="offcanvas-header border-bottom">
                        <h6 id="offcanvasAddUserLabel" class="offcanvas-title">Add User</h6>
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                            aria-label="Close"></button>
                    </div>
                    <form class="add-new-user pt-0" id="addNewUserForm" onsubmit="return false">
                        <div class="mb-3">
                            <label class="form-label" for="add-user-fullname">Full Name</label>
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="John Doe"
                                name="userFullname" aria-label="John Doe" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="add-user-email">Email</label>
                            <input type="text" id="add-user-email" class="form-control"
                                placeholder="john.doe@example.com" aria-label="john.doe@example.com" name="userEmail" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="add-user-contact">Contact</label>
                            <input type="text" id="add-user-contact" class="form-control phone-mask"
                                placeholder="+1 (609) 988-44-11" aria-label="john.doe@example.com" name="userContact" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="add-user-company">Company</label>
                            <input type="text" id="add-user-company" class="form-control" placeholder="Web Developer"
                                aria-label="jdoe1" name="companyName" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="country">Country</label>
                            <select id="country" class="select2 form-select">
                                <option value="">Select</option>
                                <option value="Australia">Australia</option>
                                <option value="Bangladesh">Bangladesh</option>
                                <option value="Belarus">Belarus</option>
                                <option value="Brazil">Brazil</option>
                                <option value="Canada">Canada</option>
                                <option value="China">China</option>
                                <option value="France">France</option>
                                <option value="Germany">Germany</option>
                                <option value="India">India</option>
                                <option value="Indonesia">Indonesia</option>
                                <option value="Israel">Israel</option>
                                <option value="Italy">Italy</option>
                                <option value="Japan">Japan</option>
                                <option value="Korea">Korea, Republic of</option>
                                <option value="Mexico">Mexico</option>
                                <option value="Philippines">Philippines</option>
                                <option value="Russia">Russian Federation</option>
                                <option value="South Africa">South Africa</option>
                                <option value="Thailand">Thailand</option>
                                <option value="Turkey">Turkey</option>
                                <option value="Ukraine">Ukraine</option>
                                <option value="United Arab Emirates">United Arab Emirates</option>
                                <option value="United Kingdom">United Kingdom</option>
                                <option value="United States">United States</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="user-role">User Role</label>
                            <select id="user-role" class="form-select">
                                <option value="subscriber">Subscriber</option>
                                <option value="editor">Editor</option>
                                <option value="maintainer">Maintainer</option>
                                <option value="author">Author</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="form-label" for="user-plan">Select Plan</label>
                            <select id="user-plan" class="form-select">
                                <option value="basic">Basic</option>
                                <option value="enterprise">Enterprise</option>
                                <option value="company">Company</option>
                                <option value="team">Team</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
                        <button type="reset" class="btn btn-label-secondary"
                            data-bs-dismiss="offcanvas">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
@endsection
@section('js')
    {{-- <script src="{{ asset('assets/js/app-user-list.js') }}"></script> --}}
@endsection
