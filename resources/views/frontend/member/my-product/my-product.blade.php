@extends('frontend.layouts.app')
@section('content')
<div class="col-sm-9">
    <div class="table-responsive cart_info">
        <table class="table table-condensed">
            <thead>
                <tr class="cart_menu">
                    <td class="image">Image</td>
                    <td class="name">Name</td>
                    <td class="price">Price</td>
                    <td class="action">Action</td>

                </tr>
            </thead>
            <tbody>
                @foreach ($data as $value)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img style="width: 110px; height: 110px;"
                                    src="{{asset('upload/product/'. Auth::user()->id .'/' . json_decode($value->image)[0])}}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$value->name}}</a></h4>

                        </td>
                        <td class="cart_price">
                            <p>${{$value->price}}</p>
                        </td>

                        <td class="cart_total">
                            <a class="cart_quantity_edit" href="{{url('/member/account/edit-product/' . $value->id)}}"><i
                                    class="fa fa-edit"></i></a>
                            &emsp;
                            <a class="cart_quantity_delete"
                                href="{{url('/member/account/delete-product/' . $value->id)}}"><i
                                    class="fa fa-times"></i></a>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{url('/member/account/add-product')}}" class="btn btn-default"
            style="background-color: #FE980F; color:  #fff; float: right; margin-bottom: 20px;">Add new product</a>
    </div>
</div>

@endsection