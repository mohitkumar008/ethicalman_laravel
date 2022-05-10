@extends('user/layout')
@section('page_title', 'Cart | The Ethical Man')
@section('additional_css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
@endsection

@section('content-wrapper')
    <section class="my-account py-4">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
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
                            <p>Hello <b>admin</b> (not <b>admin</b>? <a href="">Log out</a> )</p>
                            <p>From your account dashboard you can view your <a href="">recent orders</a>, manage your <a
                                    href="">shipping and billing addresses</a>, and <a href="">edit your password and
                                    account details</a>.</p>
                        </div>
                        <div class="tab-pane fade" id="v-pills-orders" role="tabpanel"
                            aria-labelledby="v-pills-orders-tab">
                            <table class="table table-bordered table-hover text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Order</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Total</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><a href="">#352</a></td>
                                        <td>February 21, 2022</td>
                                        <td>Completed</td>
                                        <td><b>₹1,125.00</b> for 1 item</td>
                                        <td><button class="btn bg-red text-white">View</button></td>
                                    </tr>
                                    <tr>
                                        <td><a href="">#352</a></td>
                                        <td>February 21, 2022</td>
                                        <td>Completed</td>
                                        <td><b>₹1,125.00</b> for 1 item</td>
                                        <td><button class="btn bg-red text-white">View</button></td>
                                    </tr>
                                    <tr>
                                        <td><a href="">#352</a></td>
                                        <td>February 21, 2022</td>
                                        <td>Completed</td>
                                        <td><b>₹1,125.00</b> for 1 item</td>
                                        <td><button class="btn bg-red text-white">View</button></td>
                                    </tr>
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
                                            <span><a href="">Edit</a></span>
                                        </div>
                                        <div class="card-body">
                                            <p class="m-0">I-Techverse Solutions India Pvt. Ltd.</p>
                                            <p class="m-0"> Mohit Kumar</p>
                                            <p class="m-0"> Sector-3, Noida</p>
                                            <p class="m-0"> E-46, Basement</p>
                                            <p class="m-0"> Noida 201301</p>
                                            <p class="m-0"> Uttar Pradesh</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between py-3">
                                            <span class="fs-6 f-700 text-black">Shipping address</span>
                                            <span><a href="">Edit</a></span>
                                        </div>
                                        <div class="card-body">
                                            <p class="m-0">I-Techverse Solutions India Pvt. Ltd.</p>
                                            <p class="m-0"> Mohit Kumar</p>
                                            <p class="m-0"> Sector-3, Noida</p>
                                            <p class="m-0"> E-46, Basement</p>
                                            <p class="m-0"> Noida 201301</p>
                                            <p class="m-0"> Uttar Pradesh</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-account" role="tabpanel"
                            aria-labelledby="v-pills-account-tab">
                            <div class="row">
                                <div class="col-lg-10">
                                    <form class="row g-3">
                                        <div class="col-md-6">
                                            <label for="inputFirst4" class="form-label fs-6 f-600">First Name<span
                                                    class="vstar">*</span></label>
                                            <input type="text" class="form-control" id="inputFirst4">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="inputLast4" class="form-label fs-6 f-600">Last Name<span
                                                    class="vstar">*</span></label>
                                            <input type="text" class="form-control" id="inputLast4">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputDisplayname4" class="form-label fs-6 f-600">Display Name<span
                                                    class="vstar">*</span></label>
                                            <input type="text" class="form-control" id="inputDisplayname4">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputEmail4" class="form-label fs-6 f-600">Email<span
                                                    class="vstar">*</span></label>
                                            <input type="email" class="form-control" id="inputEmail4">
                                        </div>
                                        <div class="col-md-12">
                                            <p>Password change</p>
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputCPassword4" class="form-label fs-6 f-600">Current password
                                                (leave blank to leave unchanged)</label>
                                            <input type="password" class="form-control" id="inputCPassword4">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputNPassword4" class="form-label fs-6 f-600">New password (leave
                                                blank to leave unchanged)</label>
                                            <input type="password" class="form-control" id="inputNPassword4">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputCNPassword4" class="form-label fs-6 f-600">Confirm new
                                                password</label>
                                            <input type="password" class="form-control" id="inputCNPassword4">
                                        </div>

                                        <div class="col-12">
                                            <button type="submit" class="btn btn-red">Save Changes</button>
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
