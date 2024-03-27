<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Components\CategoryRicusive;
use App\Traits\UploadImagesToStorage;
use App\Models\Tags;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ValidateRequestAddProduct;

class AdminProductController extends Controller
{
    use UploadImagesToStorage;
    private $categoryRicusive;
    function __construct(CategoryRicusive $categoryRicusive)
    {
        $this->categoryRicusive = $categoryRicusive;
    }

    function index()
    {
        $products = Products::orderBy("id", "desc")->latest()->paginate(5);
        foreach ($products as $product) {
        }
        return view("admin.products.index", compact("products"));
    }

    function create()
    {
        $optionSelect = $this->categoryRicusive->categoryRicusiveAdd();
        return view("admin.products.add", compact('optionSelect'));
    }

    function store(ValidateRequestAddProduct $request)
    {

        try {
            DB::beginTransaction();
            $dataProduct = [
                'name'           => $request->name,
                'price'          => $request->price,
                'category_id'    => $request->category_id,
                'user_id'        => $request->user()->id,
                'product_content' => $request->product_content,
            ];

            $dataUploadImage = $this->UploadImagesToStorage($request, "product_images", "products");

            if (!empty($dataUploadImage)) {
                $dataProduct['product_images'] = $dataUploadImage['product_images'];
                $dataProduct['image_path']     = $dataUploadImage['image_path'];
            }

            $productInsert = Products::create($dataProduct);

            // Insert data to product_images table
            if ($request->hasFile('pro_img_path')) {
                foreach ($request->file('pro_img_path') as $file) {
                    $dataProductImages = $this->uploadMultipleImageToStorage($file, 'products');

                    $productInsert->images()->create([
                        'pro_img_path' => $dataProductImages['pro_img_path'],
                        'pro_img_name' => $dataProductImages['pro_img_name'],
                    ]);
                }
            }

            // Insert Tags for Product
            if (!empty($request->input('tags'))) {
                foreach ($request->input('tags') as $tag) {
                    // Method firstOrCreate() will insert data if data does not exist
                    $tagInstance = Tags::firstOrCreate(["tag_name" => $tag]);

                    $listTagId[] = $tagInstance->id;
                }

                $productInsert->tags()->attach($listTagId);
            }

            DB::commit();

            return redirect("/admin/products");
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage() . ' --- ' . $e->getFile() . '' . $e->getLine());
        }
    }

    function edit($id)
    {
        $product = Products::find($id);
        $optionSelect = $this->categoryRicusive->getCategory($product->category_id);
        return view("admin.products.edit", compact('optionSelect', 'product'));
    }

    function update($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $dataProductUpdate = [
                'name'           => $request->name,
                'price'          => $request->price,
                'category_id'    => $request->category_id,
                'user_id'        => $request->user()->id,
                'product_content' => $request->product_content,
            ];

            $dataUploadImage = $this->UploadImagesToStorage($request, "product_images", "products");

            if (!empty($dataUploadImage)) {
                $dataProductUpdate['product_images'] = $dataUploadImage['product_images'];
                $dataProductUpdate['image_path']     = $dataUploadImage['image_path'];
            }

            Products::find($id)->update($dataProductUpdate);
            $productInsert = Products::find($id);

            // Insert data to product_images table
            if ($request->hasFile('pro_img_path')) {

                $productInsert->images()->where("product_id", $id)->delete(); //Delete image path old in Database

                foreach ($request->file('pro_img_path') as $file) {
                    $dataProductImages = $this->uploadMultipleImageToStorage($file, 'products');
                    $productInsert->images()->create([
                        'pro_img_path' => $dataProductImages['pro_img_path'],
                        'pro_img_name' => $dataProductImages['pro_img_name'],
                    ]);
                }
            }

            // Insert Tags for Product
            if (!empty($request->input('tags'))) {
                foreach ($request->input('tags') as $tag) {
                    // Method firstOrCreate() will insert data if data does not exist
                    $tagInstance = Tags::firstOrCreate(["tag_name" => $tag]);

                    $listTagId[] = $tagInstance->id;
                }
                $productInsert->tags()->sync($listTagId);
            }

            DB::commit();

            return redirect("/admin/products");
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage() . ' --- ' . $e->getFile() . '' . $e->getLine());
        }
    }

    function delete($id)
    {
        try {
            Products::find($id)->delete();
            return response()->json([
                "code"    => 200,
                "message" => "True"
            ], 200);

        } catch (Exception $e) {
            return response()->json([
                "code"    => 500,
                "message" => "False"
            ], 500);
        }

    }
}
