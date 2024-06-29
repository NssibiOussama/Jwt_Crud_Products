<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Api\BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Yajra\DataTables\Facades\DataTables;
use Validator;

/**
 * @OA\Tag(
 *     name="Products",
 *     description="API Endpoints for managing products"
 * )
 */
class ProductController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/products",
     *     tags={"Products"},
     *     summary="Get all products",
     *     description="Returns a list of all products",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=true
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="All products"
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Product")
     *             )
     *         )
     *     )
     * )
     */

    public function index()
    {

        $product = Product::all();
        return response()->json([
            'success' => true,
            'message' => 'All products',
            'data' => $product
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/products",
     *     tags={"Products"},
     *     summary="Create a new product",
     *     description="Create a new product with the provided data",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=true
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Product created successfully"
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 ref="#/components/schemas/Product"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation failed",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=false
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Validation failed"
     *             ),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 @OA\AdditionalProperties(
     *                     type="array",
     *                     @OA\Items(type="string")
     *                 )
     *             )
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {

        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',

        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry not stored',
                'error' => $validator->errors()
            ], 422);
        }

        $product = Product::create($input);

        return response()->json([
            'success' => true,
            'message' => 'product created successfully',
            'data' => $product
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     tags={"Products"},
     *     summary="Fetch a specific product",
     *     description="Returns a specific product based on ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the product to fetch",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=true
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Product fetched successfully"
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 ref="#/components/schemas/Product"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=false
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Sorry not found!"
     *             )
     *         )
     *     )
     * )
     */
    public function show($id)
    {

        $product = Product::find($id);

        if (is_null($product)) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry not found!'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'product fetched successfully',
            'data' => $product
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/products/{id}",
     *     tags={"Products"},
     *     summary="Update a product",
     *     description="Updates an existing product by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the product to update",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 example="New Product Name"
     *             ),
     *             @OA\Property(
     *                 property="description",
     *                 type="string",
     *                 example="New product description."
     *             ),
     *             @OA\Property(
     *                 property="price",
     *                 type="number",
     *                 format="decimal",
     *                 example=99.99
     *             ),
     *             @OA\Property(
     *                 property="stock",
     *                 type="integer",
     *                 example=100
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=true
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Product updated successfully"
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 ref="#/components/schemas/Product"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation failed",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=false
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Validation failed"
     *             ),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 additionalProperties={
     *                     "type": "array",
     *                     "items": { "type": "string" }
     *                 },
     *                 example={
     *                     "name": {"The name field is required."},
     *                     "price": {"The price must be a number."}
     *                 }
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=false
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Sorry not found!"
     *             )
     *         )
     *     )
     * )
     */
    public function update(Request $request, Product $product)
    {
        // Validate the updated input
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        // Update the product's fields with validated data
        foreach ($input as $key => $value) {
            if (!is_null($value)) {
                $product->{$key} = $value;
            }
        }

        // Save the updated product
        $product->save();

        return response()->json([
            'success' => true,
            'message' => 'Product updated successfully',
            'data' => $product
        ], 200);
    }



    /**
     * @OA\Delete(
     *     path="/api/products/{id}",
     *     tags={"Products"},
     *     summary="Delete a product",
     *     description="Deletes an existing product by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the product to delete",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product deleted successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=true
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Product deleted successfully"
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 ref="#/components/schemas/Product"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="success",
     *                 type="boolean",
     *                 example=false
     *             ),
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Sorry, product not found!"
     *             )
     *         )
     *     )
     * )
     */
    public function destroy(Product $product)
    {
        if (is_null($product)) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, product not found!'
            ], 404);
        }

        $product->delete();

        return response()->json([
            'success' => true,
            'message' => 'Product deleted successfully',
            'data' => $product
        ], 200);
    }



    /**
     * @OA\Get(
     *     path="/api/products/data",
     *     tags={"Products"},
     *     summary="Fetch products with pagination",
     *     description="Fetches products with pagination using DataTables format",
     *     @OA\Parameter(
     *         name="start",
     *         in="query",
     *         description="Start index for pagination (default: 0)",
     *         required=false,
     *         @OA\Schema(type="integer", default="0")
     *     ),
     *     @OA\Parameter(
     *         name="length",
     *         in="query",
     *         description="Number of items to fetch per page (default: 10)",
     *         required=false,
     *         @OA\Schema(type="integer", default="10")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="List of products",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="draw",
     *                 type="integer",
     *                 description="Draw counter for DataTables",
     *                 example=1
     *             ),
     *             @OA\Property(
     *                 property="recordsTotal",
     *                 type="integer",
     *                 description="Total number of records",
     *                 example=100
     *             ),
     *             @OA\Property(
     *                 property="recordsFiltered",
     *                 type="integer",
     *                 description="Total number of records after filtering",
     *                 example=10
     *             ),
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/Product")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Unauthorized action"
     *     )
     * )
     */
    public function data(Request $request)
    {
        $products = Product::query();
        $start = $request->input('start', 0);
        $length = $request->input('length', 10);

        // Apply pagination
        $products->skip($start)->take($length);

        // Prepare DataTables response
        $dataTables = DataTables::of($products)
            ->setTotalRecords(Product::count()) // Total records without any filtering
            ->toJson();

        return $dataTables;
    }



}
