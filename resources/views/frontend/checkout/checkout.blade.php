@extends('frontend.layouts.app')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="#">Home</a></li>
                <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        <div class="step-one">
            <h2 class="heading">Step1</h2>
        </div>
        <div class="checkout-options">
            <h3>New User</h3>
            <p>Checkout options</p>
            <ul class="nav">
                <li>
                    <label><input type="checkbox"> Register Account</label>
                </li>
                <li>
                    <label><input type="checkbox"> Guest Checkout</label>
                </li>
                <li>
                    <a href=""><i class="fa fa-times"></i>Cancel</a>
                </li>
            </ul>
        </div><!--/checkout-options-->

        <div class="register-req">
            <p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">

                <div class="col-sm-12">
                    <div class="bill-to">
                        <p>Quick register</p>
                        <div class="form-one">
                            <a href="{{url('/cart/checkout/send-mail')}}" style="display:" class="btn btn-primary">Continue</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="review-payment" style="margin-top: 10px">
                <h2>Review & Payment</h2>
            </div>

            @if (session('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                            {{session('success')}}
                        </div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

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
                    <tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>${{$sum}}</td>
									</tr>
									<tr>
										<td>Exo Tax</td>
										<td>$2</td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span>${{$sum+2}}</span></td>
									</tr>
								</table>
							</td>
						</tr>
                </tbody>
            </table>
            </div>
            
            <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>
        </div>
</section> <!--/#cart_items-->
@endsection