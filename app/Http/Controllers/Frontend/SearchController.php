<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Brand;
use App\Models\Frontend\Category;
use App\Models\Frontend\Products;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $productData = Products::where('name', 'like', '%' . $keyword . '%')->get();
        // dd($productData);
        return view('frontend.search.search-name', compact('productData'));
    }

    public function SearchPrice(Request $request)
    {
        if (session('productData')) {
            session()->forget('productData');
        }
        list($start, $end) = explode(',', $request->price);
        $productData = Products::whereBetween('price', [(int) $start, (int) $end]);
        // $productData = 1;

        // if ($productData->count() > 0) {
        //     session()->flash('productData', $productData->get());
        // } else {
        //     session()->forget('productData');
        // }

        // dd($productData);
        return response()->json([
            'success' => 'Search complete.',
            'productData' => $productData->get()
        ]);
    }

    public function indexSearchPrice(Request $request)
    {
        return view('frontend.search.search-price');
    }


    public function indexSearchAdvanced(Request $request)
    {
        $flag = false;
        $sql = Products::query();

        if ($request->has('name')) {
            $sql->where('name', 'like', '%' . $request->name . '%');
            $flag = true;
        }

        if ($request->has('price')) {
            list($start, $end) = explode('-', $request->price);

            $sql->whereBetween('price', [(int) $start, (int) $end]);
            $flag = true;
        }

        if ($request->has('id_category')) {
            $sql->where('id_category', $request->id_category);
            $flag = true;
        }

        if ($request->has('id_brand')) {
            $sql->where('id_brand', $request->id_brand);
            $flag = true;
        }

        if ($request->has('status')) {
            $sql->where('status', $request->status);
            $flag = true;
        }

        $brand = Brand::all();
        $category = Category::all();
        if ($flag) {
            $data = $sql->orderBy('created_at', 'desc')->paginate(6);
        } else {
            $data = Products::orderBy('created_at', 'desc')->paginate(6);
        }

        return view('frontend.search.search-advanced', compact('data', 'brand', 'category'));
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
