<?php

namespace App\Http\Controllers\Frontend\Checkout;

use App\Http\Controllers\Controller;
use App\Mail\MailNotify;
use App\Models\Admin\Country;
use App\Models\Frontend\Cart;
use App\Models\Frontend\History;
use App\Models\Frontend\Products;
use Auth;
use Exception;
use Illuminate\Http\Request;
use Mail;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cartData = Cart::where('id_user', Auth::user()->id)->get();
        $productData = Products::all();
        return view('frontend.checkout.checkout', compact('cartData', 'productData'));
    }

    public function mailIndex(Request $request)
    {
        $cartData = Cart::where('id_user', Auth::user()->id)->get();
        $productData = Products::all();

        $data = [
            'subject' => 'Your Order Details',
            'body' => 'Here are the details of your order.',
            'cartData' => $cartData,
            'productData' => $productData
        ];

        $sum = 0;
        foreach ($cartData as $value) {
            foreach ($productData as $valueProd) {
                if ($value->id_product == $valueProd->id) {
                    $sum = $sum + (int) $valueProd->price * (int) $value->qty;
                }
            }
        }

        History::create([
            'email' => Auth::user()->email,
            'phone' => Auth::user()->phone,
            'name' => Auth::user()->name,
            'id_user' => Auth::user()->id,
            'price' => $sum
        ]);

        try {
            Mail::to(Auth::user()->email)->send(new MailNotify($data));
            return redirect()->back()->with('success', _('Email has been sent to you successfully.'));
            // return response()->json(['Great, check your mailbox']);
        } catch (Exception $th) {
            // dd($th);
            return redirect()->back()->withErrors("Error, can't send complete your checkout.");
            // return response()->json(['Sorry, there was an error sending the email']);
        }
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
