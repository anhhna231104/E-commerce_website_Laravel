<?php

namespace App\Http\Controllers\Frontend\Cart;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Cart;
use App\Models\Frontend\Products;
use Auth;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartData = Cart::where('id_user', Auth::user()->id)->get();
        $productData = Products::all();

        return view('frontend.cart.cart', compact('cartData', 'productData'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $flag = false;
        $data = $request->all();

        $cartData = Cart::where('id_user', Auth::user()->id)->where('id_product', $data['id_product'])->first();

        if ($cartData) {
            $newQty = (int) $data['qty'] + (int) $cartData->qty;
            $cartData->update(['qty' => $newQty]);
            $flag = true;

        } else {
            $cart = Cart::create([
                'id_user' => $data['id_user'],
                'id_product' => $data['id_product'],
                'qty' => $data['qty']
            ]);
            $flag = true;

        }




        if ($flag) {
            return response()->json(
                [
                    'res' => 'Add to cart successfully',
                ]
            );
        } else {
            return response()->json(['error' => 'Error']);
        }


    }

    public function getCartQty()
    {
        if (Auth::check()) {
            $totalQty = Cart::where('id_user', Auth::user()->id)->sum('qty');
            return response()->json(['totalQty' => $totalQty]);
        }
        return response()->json(['totalQty' => 0]);
    }

    public function upCartQty(Request $request)
    {
        $idUp = $request->id;
        $flag = false;
        $cartItem = Cart::where('id_user', Auth::user()->id)
            ->where('id', $idUp)
            ->first();

        if ($cartItem) {
            $cartItem->qty += 1;
            $cartItem->save();
            $flag = true;
        }

        if ($flag) {
            return response()->json(
                [
                    'res' => 'Up quantity successfully',
                ]
            );
        } else {
            return response()->json(['error' => 'Error']);
        }
    }

    public function downCartQty(Request $request)
    {
        $idDown = $request->id;
        $flag = false;

        $cartItem = Cart::where('id_user', Auth::user()->id)
            ->where('id', $idDown)
            ->first();

        if ($cartItem) {
            if ($cartItem->qty <= 1) {
                if (Cart::destroy($request->id)) {
                    $flag = true;
                }

            } else {
                $cartItem->qty -= 1;
                $cartItem->save();
                $flag = true;
            }

        }

        if ($flag) {
            return response()->json(
                [
                    'res' => 'Down quantity successfully',
                ]
            );
        } else {
            return response()->json(['error' => 'Error']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        if (Cart::destroy($request->id)) {
            return response()->json(
                [
                    'res' => 'Delete product(s) from cart successfully',
                ]
            );
        } else {
            return response()->json(['error' => 'Error']);
        }
    }
}
