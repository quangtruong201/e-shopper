@extends('frontend.layouts.app')

@section('app')
<section id="cart_items">
    <div class="container">
        <!-- Breadcrumbs -->
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <!-- Cart Items -->
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <!-- Table Headings -->
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Item</td>
                        <td class="description"></td>
                        <td class="price">Price</td>
                        <td class="quantity">Quantity</td>
                        <td class="total">Total</td>
                        <td></td>
                    </tr>
                </thead>
               

                <form method="POST" action="">
                    @csrf
                    <?php
                    if(Auth::check()){
                    ?>
                    <input type="hidden" placeholder="Email" name="email" value="{{ Auth::user()->email }}">
                    <input type="hidden" placeholder="User Name" name="name"value="{{ Auth::user()->name }}">
                    <input type="hidden" placeholder="Phone" name="phone" value="{{ Auth::user()->phone }}">
                    <input type="hidden" placeholder="Address" name="address"value="{{ Auth::user()->address }}">
                    <input type="hidden" id="user_id" value="{{ Auth::user()->id }}">
                    <button type="submit" class="btn btn-primary">Continue</button>
                    <?php
                    }else{
                    ?>
                    <p>
                        <a href="{{ url('/member/login') }}">Vui lòng click vào đây đăng nhập để mua hang!</a>
                    </p>
                    <?php
                    }
                    ?>
                </form>
                <!-- Table Body -->
                <tbody>
                    @if(isset($products) && count($products) > 0)
                        @foreach ($products as $product)
                            <tr data-id="{{ $product->id }}">
                                <td class="cart_product">
                                    <a href="">
                                        <img src="{{ asset('upload/product/avatar/' . json_decode($product->avatar)[0]) }}" alt="{{ $product->name }}" style="width:100px; height:100px;">
                                    </a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{ $product->name }}</a></h4>
                                    <p>Product ID: {{ $product->id }}</p>
                                </td>
                                <td class="cart_price">
                                    <p>${{ $product->price }}</p>
                                </td>
                                <td class="cart_quantity">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up" href=""> + </a>
                                        <input class="cart_quantity_input" type="text" name="quantity" value="{{ $product->qty }}" autocomplete="off" size="2">
                                        <a class="cart_quantity_down" href=""> - </a>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p class="cart_total_price">${{ $product->price * $product->qty }}</p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href="{{ url('/cart-delete/'.$product->id) }}"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6"><p>No items in cart.</p></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</section>
<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="chose_area">
                    <ul class="user_option">
                        <li>
                            <input type="checkbox">
                            <label>Use Coupon Code</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Use Gift Voucher</label>
                        </li>
                        <li>
                            <input type="checkbox">
                            <label>Estimate Shipping & Taxes</label>
                        </li>
                    </ul>
                    <ul class="user_info">
                        <li class="single_field">
                            <label>Country:</label>
                            <select>
                                <option>United States</option>
                                <option>Bangladesh</option>
                                <option>UK</option>
                                <option>India</option>
                                <option>Pakistan</option>
                                <option>Ucrane</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                        </li>
                        <li class="single_field">
                            <label>Region / State:</label>
                            <select>
                                <option>Select</option>
                                <option>Dhaka</option>
                                <option>London</option>
                                <option>Dillih</option>
                                <option>Lahore</option>
                                <option>Alaska</option>
                                <option>Canada</option>
                                <option>Dubai</option>
                            </select>
                        </li>
                        <li class="single_field zip-field">
                            <label>Zip Code:</label>
                            <input type="text">
                        </li>
                    </ul>
                    <a class="btn btn-default update" href="">Get Quotes</a>
                    <a class="btn btn-default check_out" href="">Continue</a>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        <li>Cart Sub Total <span>$59</span></li>
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span>${{$sum}}</span></li>
                    </ul>
                        <a class="btn btn-default update" href="">Update</a>
                        <a class="btn btn-default check_out" href="">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->

<script type="text/javascript">
$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("a.cart_quantity_up").click(function (e) {
        e.preventDefault();
        var row = $(this).closest('tr');
        var id = row.data('id');
        var input = row.find(".cart_quantity_input");
        var qty = parseInt(input.val()) || 0;
        var newQty = qty + 1;
        input.val(newQty);

        var priceElement = row.find(".cart_price p");
        var price = parseFloat(priceElement.text().replace("$", ""));
        var newTotal = price * newQty;
        row.find(".cart_total_price").text("$" + newTotal);

        // Update session with new quantity
        updateSession(id, newQty);
    });

    $("a.cart_quantity_down").click(function (e) {
        e.preventDefault();
        var row = $(this).closest('tr');
        var id = row.data('id');
        var input = row.find(".cart_quantity_input");
        var qty = parseInt(input.val()) || 0;
        var newQty = qty - 1;

        if (newQty > 0) {
            input.val(newQty);

            var priceElement = row.find(".cart_price p");
            var price = parseFloat(priceElement.text().replace("$", ""));
            var newTotal = price * newQty;
            row.find(".cart_total_price").text("$" + newTotal);

            // Update session with new quantity
            updateSession(id, newQty);
        } else {
            row.remove();
            updateSession(id, 0);
        }
    });

    function updateSession(id, newQty) {
        $.ajax({
            method: "POST",
            url: "{{ route('cart.update-session') }}",
            data: {
                productId: id,
                quantity: newQty
            },
            success: function (response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    }
});
</script>
@endsection
