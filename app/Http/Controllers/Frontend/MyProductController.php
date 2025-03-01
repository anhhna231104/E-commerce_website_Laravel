<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\AddProductRequest;
use App\Http\Requests\Frontend\UpdateProductRequest;
use App\Models\Frontend\Brand;
use App\Models\Frontend\Category;
use App\Models\Frontend\Products;
use Auth;
use Illuminate\Http\Request;

use Intervention\Image\Laravel\Facades\Image;

// use Intervention\Image;


class MyProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Products::where('id_user', Auth::user()->id)->get();
        return view('frontend.member.my-product.my-product', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brand = Brand::all();
        $category = Category::all();
        return view('frontend.member.my-product.add.add-product', compact('brand', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */

    public function uploadImg($request)
    {
        $imgName = [];
        foreach ($request->file('image') as $xx) {
            $image = Image::read($xx);

            if ($xx->getSize() > 1024 * 1024) { // 1MB
                return back()->withErrors('Each image size must be less than 1MB');
            }


            if (!is_dir('upload/product/' . Auth::user()->id . '/')) {
                mkdir('upload/product/' . Auth::user()->id . '/');
            }

            $name = $xx->getClientOriginalName();
            $name_2 = "hinh85_" . $xx->getClientOriginalName();
            $name_3 = "hinh329_" . $xx->getClientOriginalName();

            //$image->move('upload/product/', $name);

            $path = public_path('upload/product/' . Auth::user()->id . '/' . $name);
            $path2 = public_path('upload/product/' . Auth::user()->id . '/' . $name_2);
            $path3 = public_path('upload/product/' . Auth::user()->id . '/' . $name_3);

            $image->save($path);
            $image->resize(85, 84)->save($path2);
            $image->resize(329, 380)->save($path3);

            // lấy từng tên hình ảnh đưa vào mảng
            $imgName[] = $name;

        }
        return $imgName;
    }
    public function add(AddProductRequest $request)
    {

        $data = $request->all();

        $imgName = [];
        if ($request->hasfile('image')) {
            if (count($request->file('image')) > 3) {
                return back()->withErrors('You can only add up to 3 images');
            }
            $imgName = $this->uploadImg($request);

        }

        // json_encode:chuyen mảng sang chuỗi
        // $product->image = json_encode($imgName);
        $sale = isset($data['sale']) ? $data['sale'] : 0;

        $product = Products::create([
            'id_user' => $data['id_user'],
            'id_brand' => $data['id_brand'],
            'id_category' => $data['id_category'],
            'image' => json_encode($imgName),
            'name' => $data['name'],
            'price' => $data['price'],
            'status' => $data['status'],
            'sale' => $sale,
            'detail' => $data['detail'],
            'company_profile' => $data['company_profile'],
        ]);
        // $product->save();
        if ($product) {
            return back()->with('success', 'Your product has been added successfully');
        } else {
            return back()->withErrors('Failed to add you product');
        }


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
        $data = Products::where('id', $id)->get()->first();
        $brand = Brand::all();
        $category = Category::all();
        return view('frontend.member.my-product.edit.edit-product', compact('brand', 'category', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $data = $request->all();
        $product = Products::findOrFail($id);

        $delImg = $request->delImg;
        $dbImg = json_decode($product->image);
        // $newImgName = [];
        // dd($dbImg);

        if (!empty($delImg)) {
            foreach ($dbImg as $key => $value) {
                foreach ($delImg as $valueChild) {
                    if ($value == $valueChild) {
                        unset($dbImg[$key]);
                    }
                }
            }
            $dbImg = array_values($dbImg);
        }

        if ($request->hasFile('image')) {
            if (count($dbImg) + count($request->file('image')) > 3) {
                return back()->withErrors('You can only add up to 3 images');
            }

            $new = $this->uploadImg($request);
            $dbImg = array_merge($dbImg, $new);
            $dbImg = array_values($dbImg);
            // dd($dbImg);

        }

        $sale = isset($data['sale']) ? $data['sale'] : 0;

        $updateProd = $product->update([
            'id_user' => $data['id_user'],
            'id_brand' => $data['id_brand'],
            'id_category' => $data['id_category'],
            'image' => json_encode($dbImg),
            'name' => $data['name'],
            'price' => $data['price'],
            'status' => $data['status'],
            'sale' => $sale,
            'detail' => $data['detail'],
            'company_profile' => $data['company_profile'],
        ]);

        if ($updateProd) {
            return back()->with('success', 'Your product has been edited successfully');
        } else {
            return back()->withErrors('Failed to edit you product');
        }

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Products::destroy($id)) {
            return redirect()->back()->with('success', _('Delete product successfully.'));
        } else {
            return redirect()->back()->withErrors('Delete product failed.');
        }
    }
}
