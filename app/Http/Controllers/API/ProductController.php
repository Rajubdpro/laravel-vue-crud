<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::get();

        return response()->json([
            'status' => '200',
            'message' => 'Product List',
            'data' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $requestAll = $request->all();

        // Input Request Validaiton.
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);


        // Building Image Updated
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $imageName = 'image' . '_' . time() . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save(public_path('uploads/image/' . $imageName));
            $requestAll['image'] = $imageName;
        }


        // Create Data.

        $data = Product::create($requestAll);

        // Send Response.
        return response()->json([
            'status' => '200',
            'message' => 'Product created successfully.',
            'data' => $data

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $singleProduct = Product::find($id);

        return response()->json([
            'status' => '1',
            'message' => 'Product Details Found.',
            'data' => $singleProduct

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Product::where('id', $id)->exists()) {

            $requestAll = $request->all();

            $product = Product::find($id);

            // Input Request Validaiton.
            $request->validate([
                'name' => 'required',
                'category' => 'required',
                'description' => 'required',
                'price' => 'required',
            ]);

            // Update Building image
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = 'product' . '_' . time() . '.' . $image->getClientOriginalExtension();
                Image::make($image)->save(public_path('uploads/image/' . $imageName));
                $requestAll['image'] = $imageName;
                if ($product->image && file_exists(public_path() . '/uploads/image/' . $product->image)) {
                    unlink(public_path() . '/uploads/image/' . $product->image);
                }
            }

            $data = $product->fill($requestAll)->save();

            return response()->json([
                'status' => '1',
                'message' => 'Product Updated.',
                'data' => $data

            ]);
        } else {
            return response()->json([
                'status' => '0',
                'message' => 'Product Not Found.',

            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

        if (Product::where('id', $id)->exists()) {

            $find_data = Product::find($id);
            $product = Product::destroy($id);

            if ($product) {
                if ($find_data->image && file_exists(public_path() . '/uploads/image/' . $find_data->image)) {
                    unlink(public_path() . '/uploads/image/' . $find_data->image);
                }
            }

            return response()->json([
                'status' => '0',
                'message' => 'Product Deleted Successfully.',
                'data' => $product

            ], 200);
        } else {
            return response()->json([
                'status' => '0',
                'message' => 'Product Not Found.',

            ], 404);
        }
    }
}
