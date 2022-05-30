@extends('user/layout')
@section('page_title', 'Cart | The Ethical Man')
@section('additional_css')
    <script src="{{ asset('user_assets/assets/js/jquery.min.js') }}"></script>
@endsection

@section('content-wrapper')
    <section class="my-account py-4">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    @if (session('verify_msg'))
                        <h6 class="text-success">{{ session('verify_msg') }}</h6>
                    @endif
                    @if (session('address_msg'))
                        <h6 class="text-success">{{ session('address_msg') }}</h6>
                    @endif
                    <div class="section-title">
                        <h2 class="fs-3">
                            My Account
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row d-flex align-items-start">
                <div class="col-lg-3 offset-lg-1">
                    <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active border" id="v-pills-dashboard-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-dashboard" type="button" role="tab" aria-controls="v-pills-dashboard"
                            aria-selected="true">Dashboard</button>
                        <button class="nav-link border" id="v-pills-orders-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-orders" type="button" role="tab" aria-controls="v-pills-orders"
                            aria-selected="false">Orders</button>
                        <button class="nav-link border" id="v-pills-address-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-address" type="button" role="tab" aria-controls="v-pills-address"
                            aria-selected="false">Address</button>
                        <button class="nav-link border" id="v-pills-account-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-account" type="button" role="tab" aria-controls="v-pills-account"
                            aria-selected="false">Account Details</button>
                        <button class="nav-link border" id="v-pills-coupon-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-coupon" type="button" role="tab" aria-controls="v-pills-coupon"
                            aria-selected="false">My Coupons</button>
                        <button class="nav-link border" id="v-pills-return-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-return" type="button" role="tab" aria-controls="v-pills-return"
                            aria-selected="false">Return</button>
                        <button class="nav-link border" id="v-pills-logout-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-logout" type="button" role="tab" aria-controls="v-pills-logout"
                            aria-selected="false">Logout</button>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="tab-content" id="v-pills-tabContent">
                        <div class="tab-pane fade show active" id="v-pills-dashboard" role="tabpanel"
                            aria-labelledby="v-pills-dashboard-tab">
                            <p>Hello <b>{{ $userinfo[0]->name }}</b> (not <b>{{ $userinfo[0]->name }}</b>? <a
                                    href="{{ url('logout') }}">Log out</a> )</p>
                            <p>From your account dashboard you can view your <a href="javascript:void(0)">recent orders</a>,
                                manage your <a href="javascript:void(0)">shipping and billing addresses</a>, and <a
                                    href="javascript:void(0)">edit your password and
                                    account details</a>.</p>
                        </div>
                        <div class="tab-pane fade" id="v-pills-orders" role="tabpanel"
                            aria-labelledby="v-pills-orders-tab">
                            <table class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">S. No</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $list)
                                        <tr>
                                            <td><a href="">{{ $loop->iteration }}</a></td>
                                            <td>
                                                {{ \Carbon\Carbon::parse($list->created_at)->isoFormat('MMM Do, YYYY') }}
                                            </td>
                                            <td>{{ $list->order_status }} </td>
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($orders_detail[$list->order_id] as $data)
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                            <td><b>₹{{ $list->total_amount }}</b> for @php echo $i; @endphp item</td>
                                            <td><a href="{{ url('my-account/order-details/' . $list->order_id . '') }}"
                                                    class="btn bg-red text-white">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="v-pills-address" role="tabpanel"
                            aria-labelledby="v-pills-address-tab">
                            <p>The following addresses will be used on the checkout page by default.</p>
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between py-3">
                                            <span class="fs-6 f-700 text-black">Billing address</span>
                                            <span><a class=" collapsed" data-bs-toggle="collapse"
                                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                                    aria-controls="flush-collapseOne" href="">Edit</a></span>
                                        </div>
                                        <div class="card-body">
                                            @if (isset($billingAddress[0]))
                                                <p class="m-0"> {{ $billingAddress[0]->name }}</p>
                                                <p class="m-0"> {{ $billingAddress[0]->address }}</p>
                                                <p class="m-0"> {{ $billingAddress[0]->city }}</p>
                                                <p class="m-0"> {{ $billingAddress[0]->state }}</p>
                                                <p class="m-0"> {{ $billingAddress[0]->zip }}</p>
                                                <p class="m-0"> {{ $billingAddress[0]->company }}</p>
                                                <p class="m-0"> {{ $billingAddress[0]->gstin }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between py-3">
                                            <span class="fs-6 f-700 text-black">Shipping address</span>
                                            <span><a class=" collapsed" data-bs-toggle="collapse"
                                                    data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                                    aria-controls="flush-collapseTwo" href="">Edit</a></span>
                                        </div>
                                        <div class="card-body">
                                            @if (isset($shippingAddress[0]))
                                                <p class="m-0"> {{ $shippingAddress[0]->name }}</p>
                                                <p class="m-0"> {{ $shippingAddress[0]->address }}</p>
                                                <p class="m-0"> {{ $shippingAddress[0]->city }}</p>
                                                <p class="m-0"> {{ $shippingAddress[0]->state }}</p>
                                                <p class="m-0"> {{ $shippingAddress[0]->zip }}</p>
                                                <p class="m-0"> {{ $shippingAddress[0]->company }}</p>
                                                <p class="m-0"> {{ $shippingAddress[0]->gstin }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-10 accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                                            aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <form class="row g-3" method="post"
                                                    action="{{ url('update-address') }}">
                                                    @csrf
                                                    <div class="col-md-12">
                                                        <label for="inputFirstB" class="form-label fs-6 f-600">Full
                                                            Name<span class="vstar">*</span></label>
                                                        <input type="text" class="form-control"
                                                            value="@if (isset($billingAddress[0])) {{ $billingAddress[0]->name }} @endif"
                                                            name="b-name" id="inputFirstB">
                                                        <input type="text" class="form-control" value="Billing"
                                                            name="address-type" hidden>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="inputEmailB" class="form-label fs-6 f-600">Address<span
                                                                class="vstar">*</span></label>
                                                        <input type="text" class="form-control"
                                                            value="@if (isset($billingAddress[0])) {{ $billingAddress[0]->address }} @endif"
                                                            name="b-address" id="inputEmailB">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="inputCityB" class="form-label fs-6 f-600">Town /
                                                            City<span class="vstar">*</span></label>
                                                        <input type="text" class="form-control"
                                                            value="@if (isset($billingAddress[0])) {{ $billingAddress[0]->city }} @endif"
                                                            name="b-city" id="inputCityB">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="inputStateB" class="form-label fs-6 f-600">State<span
                                                                class="vstar">*</span></label>
                                                        <select name="b-state" id="inputsstate4" class="form-control">
                                                            @if (isset($billingAddress[0]))
                                                                <option label="{{ $billingAddress[0]->state }}"
                                                                    value="{{ $billingAddress[0]->state }}"
                                                                    selected="selected">
                                                                    {{ $billingAddress[0]->state }}
                                                                </option>
                                                            @else
                                                                <option label="Please Select State" selected="selected">
                                                                    Please
                                                                    Select
                                                            @endif
                                                            <option label="Andaman and Nicobar Islands"
                                                                value="Andaman and Nicobar Islands">Andaman and Nicobar
                                                                Islands</option>
                                                            <option label="Andhra Pradesh" value="Andhra Pradesh">Andhra
                                                                Pradesh
                                                            </option>
                                                            <option label="Arunachal Pradesh" value="Arunachal Pradesh">
                                                                Arunachal
                                                                Pradesh</option>
                                                            <option label="Assam" value="Assam">Assam</option>
                                                            <option label="Bihar" value="Bihar">Bihar</option>
                                                            <option label="Chandigarh" value="Chandigarh">Chandigarh
                                                            </option>
                                                            <option label="Dadra and Nagar Haveli"
                                                                value="Dadra and Nagar Haveli">
                                                                Dadra and Nagar Haveli
                                                            </option>
                                                            <option label="Daman and Diu" value="Daman and Diu">Daman and
                                                                Diu
                                                            </option>
                                                            <option label="Delhi" value="Delhi">Delhi</option>
                                                            <option label="Goa" value="Goa">Goa</option>
                                                            <option label="Gujarat" value="Gujarat">Gujarat</option>
                                                            <option label="Haryana" value="Haryana">Haryana</option>
                                                            <option label="Himachal Pradesh" value="Himachal Pradesh">
                                                                Himachal
                                                                Pradesh</option>
                                                            <option label="Jammu and Kashmir" value="Jammu and Kashmir">
                                                                Jammu and
                                                                Kashmir</option>
                                                            <option label="Karnataka" value="Karnataka">Karnataka</option>
                                                            <option label="Kerala" value="Kerala">Kerala</option>
                                                            <option label="Lakshadweep Islands" value="Lakshadweep Islands">
                                                                Lakshadweep Islands</option>
                                                            <option label="Madhya Pradesh" value="Madhya Pradesh">Madhya
                                                                Pradesh
                                                            </option>
                                                            <option label="Maharashtra" value="Maharashtra">Maharashtra
                                                            </option>
                                                            <option label="Manipur" value="Manipur">Manipur</option>
                                                            <option label="Meghalaya" value="Meghalaya">Meghalaya</option>
                                                            <option label="Mizoram" value="Mizoram">Mizoram</option>
                                                            <option label="Nagaland" value="Nagaland">Nagaland</option>
                                                            <option label="Odisha" value="Odisha">Odisha</option>
                                                            <option label="Pondicherry" value="Pondicherry">Pondicherry
                                                            </option>
                                                            <option label="Punjab" value="Punjab">Punjab</option>
                                                            <option label="Rajasthan" value="Rajasthan">Rajasthan</option>
                                                            <option label="Sikkim" value="Sikkim">Sikkim</option>
                                                            <option label="Tamil Nadu" value="Tamil Nadu">Tamil Nadu
                                                            </option>
                                                            <option label="Tripura" value="1504">Tripura</option>
                                                            <option label="Uttar Pradesh" value="Uttar Pradesh">Uttar
                                                                Pradesh
                                                            </option>
                                                            <option label="West Bengal" value="West Bengal">West Bengal
                                                            </option>
                                                            <option label="Jharkhand" value="Jharkhand">Jharkhand</option>
                                                            <option label="Uttarakhand" value="Uttarakhand">Uttarakhand
                                                            </option>
                                                            <option label="Chhattisgarh" value="Chhattisgarh">Chhattisgarh
                                                            </option>
                                                            <option label="Telangana" value="Telangana">Telangana</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="inputPinB" class="form-label fs-6 f-600">PIN<span
                                                                class="vstar">*</span></label>
                                                        <input type="text" class="form-control"
                                                            value="@if (isset($billingAddress[0])) {{ $billingAddress[0]->zip }} @endif"
                                                            name="b-pin" id="inputPinB">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="inputCompanyB" class="form-label fs-6 f-600">Company
                                                            name
                                                            (optional)</label>
                                                        <input type="text" class="form-control"
                                                            value="@if (isset($billingAddress[0])) {{ $billingAddress[0]->company }} @endif"
                                                            name="b-company" id="inputCompanyB">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="inputGstinB" class="form-label fs-6 f-600">GSTIN
                                                            (optional)</label>
                                                        <input type="text" class="form-control"
                                                            value="@if (isset($billingAddress[0])) {{ $billingAddress[0]->gstin }} @endif"
                                                            name="b-gstin" id="inputGstinB">
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" name="billing-address-update"
                                                            class="btn btn-red">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                            aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <form class="row g-3" method="post"
                                                    action="{{ url('update-address') }}">
                                                    @csrf
                                                    <div class="col-md-12">
                                                        <label for="inputFirstS" class="form-label fs-6 f-600">Full
                                                            Name<span class="vstar">*</span></label>
                                                        <input type="text" class="form-control"
                                                            value="@if (isset($shippingAddress[0])) {{ $shippingAddress[0]->name }} @endif"
                                                            name="s-name" id="inputFirstS">
                                                        <input type="text" class="form-control" value="Shipping"
                                                            name="address-type" hidden>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="inputEmailS" class="form-label fs-6 f-600">Address<span
                                                                class="vstar">*</span></label>
                                                        <input type="text" class="form-control"
                                                            value="@if (isset($shippingAddress[0])) {{ $shippingAddress[0]->address }} @endif"
                                                            name="s-address" id="inputEmailS">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="inputCityS" class="form-label fs-6 f-600">Town /
                                                            City<span class="vstar">*</span></label>
                                                        <input type="text" class="form-control"
                                                            value="@if (isset($shippingAddress[0])) {{ $shippingAddress[0]->city }} @endif"
                                                            name="s-city" id="inputCityS">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="inputStateS" class="form-label fs-6 f-600">State<span
                                                                class="vstar">*</span></label>
                                                        <select name="s-state" id="inputsstate4" class="form-control">
                                                            @if (isset($shippingAddress[0]))
                                                                <option label="{{ $shippingAddress[0]->state }}"
                                                                    value="{{ $shippingAddress[0]->state }}"
                                                                    selected="selected">
                                                                    {{ $shippingAddress[0]->state }}
                                                                </option>
                                                            @else
                                                                <option label="Please Select State" selected="selected">
                                                                    Please
                                                                    Select
                                                            @endif
                                                            <option label="Andaman and Nicobar Islands"
                                                                value="Andaman and Nicobar Islands">Andaman and Nicobar
                                                                Islands</option>
                                                            <option label="Andhra Pradesh" value="Andhra Pradesh">Andhra
                                                                Pradesh
                                                            </option>
                                                            <option label="Arunachal Pradesh" value="Arunachal Pradesh">
                                                                Arunachal
                                                                Pradesh</option>
                                                            <option label="Assam" value="Assam">Assam</option>
                                                            <option label="Bihar" value="Bihar">Bihar</option>
                                                            <option label="Chandigarh" value="Chandigarh">Chandigarh
                                                            </option>
                                                            <option label="Dadra and Nagar Haveli"
                                                                value="Dadra and Nagar Haveli">
                                                                Dadra and Nagar Haveli
                                                            </option>
                                                            <option label="Daman and Diu" value="Daman and Diu">Daman and
                                                                Diu
                                                            </option>
                                                            <option label="Delhi" value="Delhi">Delhi</option>
                                                            <option label="Goa" value="Goa">Goa</option>
                                                            <option label="Gujarat" value="Gujarat">Gujarat</option>
                                                            <option label="Haryana" value="Haryana">Haryana</option>
                                                            <option label="Himachal Pradesh" value="Himachal Pradesh">
                                                                Himachal
                                                                Pradesh</option>
                                                            <option label="Jammu and Kashmir" value="Jammu and Kashmir">
                                                                Jammu and
                                                                Kashmir</option>
                                                            <option label="Karnataka" value="Karnataka">Karnataka</option>
                                                            <option label="Kerala" value="Kerala">Kerala</option>
                                                            <option label="Lakshadweep Islands" value="Lakshadweep Islands">
                                                                Lakshadweep Islands</option>
                                                            <option label="Madhya Pradesh" value="Madhya Pradesh">Madhya
                                                                Pradesh
                                                            </option>
                                                            <option label="Maharashtra" value="Maharashtra">Maharashtra
                                                            </option>
                                                            <option label="Manipur" value="Manipur">Manipur</option>
                                                            <option label="Meghalaya" value="Meghalaya">Meghalaya</option>
                                                            <option label="Mizoram" value="Mizoram">Mizoram</option>
                                                            <option label="Nagaland" value="Nagaland">Nagaland</option>
                                                            <option label="Odisha" value="Odisha">Odisha</option>
                                                            <option label="Pondicherry" value="Pondicherry">Pondicherry
                                                            </option>
                                                            <option label="Punjab" value="Punjab">Punjab</option>
                                                            <option label="Rajasthan" value="Rajasthan">Rajasthan</option>
                                                            <option label="Sikkim" value="Sikkim">Sikkim</option>
                                                            <option label="Tamil Nadu" value="Tamil Nadu">Tamil Nadu
                                                            </option>
                                                            <option label="Tripura" value="1504">Tripura</option>
                                                            <option label="Uttar Pradesh" value="Uttar Pradesh">Uttar
                                                                Pradesh
                                                            </option>
                                                            <option label="West Bengal" value="West Bengal">West Bengal
                                                            </option>
                                                            <option label="Jharkhand" value="Jharkhand">Jharkhand</option>
                                                            <option label="Uttarakhand" value="Uttarakhand">Uttarakhand
                                                            </option>
                                                            <option label="Chhattisgarh" value="Chhattisgarh">Chhattisgarh
                                                            </option>
                                                            <option label="Telangana" value="Telangana">Telangana</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="inputPinS" class="form-label fs-6 f-600">PIN<span
                                                                class="vstar">*</span></label>
                                                        <input type="text" class="form-control"
                                                            value="@if (isset($shippingAddress[0])) {{ $shippingAddress[0]->zip }} @endif"
                                                            name="s-pin" id="inputPinS">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="inputCompanyS" class="form-label fs-6 f-600">Company
                                                            name
                                                            (optional)</label>
                                                        <input type="text" class="form-control"
                                                            value="@if (isset($shippingAddress[0])) {{ $shippingAddress[0]->company }} @endif"
                                                            name="s-comapny" id="inputCompanyS">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="inputGstinS" class="form-label fs-6 f-600">GSTIN
                                                            (optional)</label>
                                                        <input type="text" class="form-control"
                                                            value="@if (isset($shippingAddress[0])) {{ $shippingAddress[0]->gstin }} @endif"
                                                            name="s-gstin" id="inputGstinS">
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" name="shipping-address-update"
                                                            class="btn btn-red">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-account" role="tabpanel"
                            aria-labelledby="v-pills-account-tab">
                            <div class="row">
                                <div class="col-lg-10">
                                    <form class="row g-3" method="post"
                                        action="{{ url('/update-account-info') }}">
                                        @csrf
                                        <div class="col-md-12">
                                            <label for="inputAccName4" class="form-label fs-6 f-600">Full Name<span
                                                    class="vstar">*</span></label>
                                            <input type="text" name="accname" class="form-control"
                                                value="{{ $userinfo[0]->name }}" id="inputAccName4">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputAccEmail4" class="form-label fs-6 f-600">Email<span
                                                    class="vstar">*</span></label>
                                            <input type="text" class="form-control" value="{{ $userinfo[0]->email }}"
                                                id="inputAccEmail4" readonly="readonly">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputAccPhone4" class="form-label fs-6 f-600">Phone<span
                                                    class="vstar">*</span></label>
                                            <input type="tel" class="form-control" value="{{ $userinfo[0]->phone }}"
                                                id="inputAccPhone4" readonly="readonly">
                                        </div>
                                        <div class="col-md-12">
                                            <p>Password change</p>
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputCPassword4" class="form-label fs-6 f-600">Current password
                                                (leave blank to leave unchanged)</label>
                                            <input type="password" name="currpassword" class="form-control"
                                                id="inputCPassword4">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputNPassword4" class="form-label fs-6 f-600">New password (leave
                                                blank to leave unchanged)</label>
                                            <input type="password" name="newpassword" class="form-control"
                                                id="inputNPassword4">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputCNPassword4" class="form-label fs-6 f-600">Confirm new
                                                password</label>
                                            <input type="password" name="newcpassword" class="form-control"
                                                id="inputCNPassword4">
                                        </div>

                                        <div class="col-12">
                                            <input type="submit" class="btn btn-red" name="accinfoupdate"
                                                value="Save Changes" />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-coupon" role="tabpanel"
                            aria-labelledby="v-pills-coupon-tab">

                        </div>
                        <div class="tab-pane fade" id="v-pills-return" role="tabpanel"
                            aria-labelledby="v-pills-return-tab">
                            <table class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Request ID</th>
                                        <th scope="col">Order ID</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Items</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Created Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="">#352</a></td>
                                        <td><a href="">#3592</a></td>
                                        <td>Refund</td>
                                        <td><a href="">The Ethical Man Forest Green Shirt</a> × 1</td>
                                        <td>Completed</td>
                                        <td>February 21, 2022</td>
                                    </tr>
                                    <tr>
                                        <td><a href="">#352</a></td>
                                        <td><a href="">#3592</a></td>
                                        <td>Refund</td>
                                        <td><a href="">The Ethical Man Forest Green Shirt</a> × 1</td>
                                        <td>Completed</td>
                                        <td>February 21, 2022</td>
                                    </tr>
                                    <tr>
                                        <td><a href="">#352</a></td>
                                        <td><a href="">#3592</a></td>
                                        <td>Refund</td>
                                        <td><a href="">The Ethical Man Forest Green Shirt</a> × 1</td>
                                        <td>Completed</td>
                                        <td>February 21, 2022</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('additional_js')
@endsection
