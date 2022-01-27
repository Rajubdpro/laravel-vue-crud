<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
Use Image;

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


        // Input Request Validaiton.
           $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);


        // Create Data.

        $data = Product::create($request->all());

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
        if(Product::where('id', $id)->exists()){

            $product = Product::find($id);

              // Input Request Validaiton.
            $request->validate([
                'name' => 'required',
                'description' => 'required',
                'price' => 'required',
            ]);


            $data = $product->fill($request->all())->save();

            return response()->json([
                'status' => '1',
                'message' => 'Product Details Found.',
                'data' => $data
    
            ]);

        }else{
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
     
        if(Product::where('id', $id)->exists()){

            $product = Product::destroy($id);

            return response()->json([
                'status' => '0',
                'message' => 'Product Deleted Successfully.',
                'data' => $product
    
            ], 200);

        }else{
             return response()->json([
                'status' => '0',
                'message' => 'Product Not Found.',
    
            ], 404);
        }
    }
}
