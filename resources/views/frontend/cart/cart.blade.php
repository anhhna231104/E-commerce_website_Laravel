@extends('frontend.layouts.app')

@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
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
                <tbody>
                    @php
                        $sum = 0;
                    @endphp
                    @foreach ($cartData as $value)
                                @foreach ($productData as $valueProd)
                                            @if ($valueProd->id == $value->id_product)
                                                        <tr id="{{$value->id}}">
                                                            <td class="cart_product">
                                                                <a href=""><img
                                                                        src="{{asset('upload/product/' . $valueProd->id_user . '/hinh85_' . json_decode($valueProd->image)[0])}}"
                                                                        alt=""></a>
                                                            </td>
                                                            <td class="cart_description">
                                                                <h4><a href="">{{$valueProd->name}}</a></h4>
                                                                <p>Web ID: 1089772</p>
                                                            </td>
                                                            <td class="cart_price">
                                                                <p>${{$valueProd->price}}</p>
                                                            </td>
                                                            <td class="cart_quantity">
                                                                <div class="cart_quantity_button">
                                                                    <a class="cart_quantity_up" href=""> + </a>
                                                                    <input class="cart_quantity_input" type="text" name="quantity" value="{{$value->qty}}"
                                                                        autocomplete="off" size="2">
                                                                    <a class="cart_quantity_down" href=""> - </a>
                                                                </div>
                                                            </td>
                                                            <td class="cart_total">
                                                                <p class="cart_total_price">${{(int) $valueProd->price * (int) $value->qty}}</p>
                                                            </td>
                                                            <td class="cart_delete">
                                                                <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                                                            </td>
                                                        </tr>
                                                        @php
                                                            $sum = $sum + (int) $valueProd->price * (int) $value->qty
                                                        @endphp
                                            @endif

                                @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

<section id="do_action">
    <div class="container">
        <div class="heading">
            <h3>What would you like to do next?</h3>
            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your
                delivery cost.</p>
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
                        <li>Cart Sub Total <span class="cart-sub-total">${{$sum}}</span></li>
                        <li>Eco Tax <span>$2</span></li>
                        <li>Shipping Cost <span>Free</span></li>
                        <li>Total <span class="cart-total">${{$sum + 2}}</span></li>
                    </ul>
                    <a class="btn btn-default update" href="">Update</a>
                    <a class="btn btn-default check_out" href="">Check Out</a>
                </div>
            </div>
        </div>
    </div>
</section><!--/#do_action-->
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('a.cart_quantity_up').click(function (e) {
            e.preventDefault()
            //Tăng qty khi nhấn dấu +
            var getQty = $(this).closest("tr").find(".cart_quantity_input")
            var newQty = parseInt(getQty.val())
            newQty++
            getQty.val(newQty)

            //Tính total mới sau khi + qty
            var getTotal = $(this).closest("tr").find(".cart_total_price")
            var getPrice = $(this).closest("tr").find(".cart_price").text()
            var newPriceNo = getPrice.replace("$", "")

            oldTotal = getTotal.text()
            newTotal = parseInt(newPriceNo) * newQty
            getTotal.text("$" + newTotal)

            var getIDUp = $(this).closest("tr").attr("id")

            var subTotal = $("span.cart-sub-total")
            var newSubTotal = subTotal.text().replace("$", "")
            oldTotal = oldTotal.replace("$", "")
            subTotal.text("$ " + (parseInt(newSubTotal) - parseInt(oldTotal) + parseInt(newTotal)))
            $("span.cart-total").text("$ " + (parseInt(newSubTotal) - parseInt(oldTotal) + parseInt(newTotal) + 2))

            var getIdUpQty = $(this).closest('tr').attr('id')

            $.ajax({
                type: 'post',
                url: `{{url('/cart/qty-up/')}}/` + getIdUpQty,
                data: {
                    id: getIdUpQty
                },
                success: function (res) {
                    console.log(res.res);
                    // alert(res.res)
                },
                error: function (err) {
                    console.log(err.responseText);
                }
            })

        })

        $("a.cart_quantity_down").click(function (e) {
            e.preventDefault()
            var getQty = $(this).closest("tr").find(".cart_quantity_input")
            var newQty = parseInt(getQty.val())
            newQty--

            var getIDDown = $(this).closest("tr").attr("id")

            var getIdDownQty = $(this).closest('tr').attr('id')
            $.ajax({
                type: 'post',
                url: `{{url('/cart/qty-down/')}}/` + getIdDownQty,
                data: {
                    id: getIdDownQty
                },
                success: function (res) {
                    console.log(res.res);
                    // alert(res.res)
                },
                error: function (err) {
                    console.log(err.responseText);
                }
            });

            if (newQty < 1) {
                var getPrice = $(this).closest("tr").find(".cart_price").text().replace("$", "")
                var subTotal = $("span.cart-sub-total")
                var newSubTotal = subTotal.text().replace("$", "")

                subTotal.text("$" + (parseInt(newSubTotal) - parseInt(getPrice)))
                $("span.cart-total").text("$" + (parseInt(newSubTotal) - parseInt(getPrice) + 2))

                $(this).closest("tr").remove()


            }
            else {
                getQty.val(newQty)

                // Tính total mới sau khi - qty
                var getTotal = $(this).closest("tr").find(".cart_total_price")
                var getPrice = $(this).closest("tr").find(".cart_price").text()
                var newPriceNo = getPrice.replace("$", "")

                oldTotal = getTotal.text()
                newTotal = parseInt(newPriceNo) * newQty
                getTotal.text("$" + newTotal)

                var subTotal = $("span.cart-sub-total")
                var newSubTotal = subTotal.text().replace("$", "")
                oldTotal = oldTotal.replace("$", "")
                subTotal.text("$ " + (parseInt(newSubTotal) - parseInt(oldTotal) + parseInt(newTotal)))
                $("span.cart-total").text("$ " + (parseInt(newSubTotal) - parseInt(oldTotal) + parseInt(newTotal) + 2))
            }


        })

        $('a.cart_quantity_delete').click(function (e) {
            e.preventDefault()
            var getIdDel = $(this).closest('tr').attr('id')

            $.ajax({
                type: 'post',
                url: `{{url('/cart/delete-product')}}/` + getIdDel,
                data: {
                    id: getIdDel
                },
                success: function (res) {
                    console.log(res.res);
                    alert(res.res)
                },
                error: function (err) {
                    console.log(err.responseText);
                }
            })

            var getPrice = $(this).closest("tr").find(".cart_price").text().replace("$", "")
            var getQty = $(this).closest("tr").find("input.cart_quantity_input").val()
            // alert (getQty)
            var subTotal = $("span.cart-sub-total")
            var newSubTotal = subTotal.text().replace("$", "")
            // alert (newSubTotal)

            subTotal.text("$ " + (parseInt(newSubTotal) - parseInt(getPrice) * parseInt(getQty)))
            $("span.cart-total").text("$ " + (parseInt(newSubTotal) - parseInt(getPrice) * parseInt(getQty) + 2))

            $(this).closest("tr").remove();

        })
    })
</script>
@endsection