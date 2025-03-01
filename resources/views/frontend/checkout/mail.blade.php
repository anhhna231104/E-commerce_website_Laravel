<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$data['subject']}}</title>
    <style>
        table{
            width: 100%;
            margin-bottom: 20px;
            border-collapse: collapse;
            border-spacing: 0;
        }

        .cart_menu {
            background: #FE980F;
            color: #fff;
            font-size: 16px;
            font-family: 'Roboto', sans-serif;
            font-weight: normal;
        }
        
        thead{
            display: table-header-group;
            vertical-align: middle;
            unicode-bidi: isolate;
            border-color: inherit;
        }

        #cart_items .cart_info .cart_total_price {
            color: #FE980F;
            font-size: 24px;
        }

        p {
            margin: 0 0 10px;
        }

        .cart_info table tr td {
            border-top: 0 none;
            vertical-align: inherit;
            margin-right: 5px;
        }

        .table-condensed>thead>tr>th, .table-condensed>tbody>tr>th, .table-condensed>tfoot>tr>th, .table-condensed>thead>tr>td, .table-condensed>tbody>tr>td, .table-condensed>tfoot>tr>td {
            padding: 5px;
        }
    </style>

</head>

<body>
    <h2>Your Order Details</h2>

    <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <!-- <td class="image">Item</td> -->
                        <td class="description">Item</td>
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
                    @foreach ($data['cartData'] as $value)
                                @foreach ($data['productData'] as $valueProd)
                                            @if ($valueProd->id == $value->id_product)
                                                        <tr id="{{$value->id}}">
                                                            
                                                            <td class="cart_description">
                                                                <h4><a href="">{{$valueProd->name}}</a></h4>
                                                                <p>Web ID: 1089772</p>
                                                            </td>
                                                            <td class="cart_price">
                                                                <p>${{$valueProd->price}}</p>
                                                            </td>
                                                            <td class="cart_quantity">
                                                                <div class="cart_quantity_button">

                                                                        <p>{{$value->qty}}</p>
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
</body>

</html>