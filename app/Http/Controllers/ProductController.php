<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    function index(Request $request,) {
        try {
            $products = Product::orderBy('id','desc')->get();
            return response()->json([
                "code" => 200,
                "data" => $products
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "code" => 500,
                "data" => $e->getMessage()
            ]);
        }
    }

    function edit(Request $request, $id){
        DB::beginTransaction();
        if ($request->hasFile('image')) {
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs("images", $fileName, "public");
        } else {
            $path = "images/icon.png";
        }

        $product = Product::findOrFail($id);
        $product->name = $request["name"]??$product->name;
        $product->image = $path??$product->image;
        $product->price = $request["price"]??$product->price;
        $product->status= $request["status"]??$product->status;
        $product->description = $request["description"]??$product->description;
        $product->save();
        DB::commit();
        return response()->json([
            "code"=>200,
            "data"=>$product
        ]);
    }

    function delete($id){
        $product=Product::where('id',$id)->delete();
        return response()->json([
            "code"=>200,
            "data"=>$product
        ]);
    }

    function create(Request $request){
        DB::beginTransaction();
        if($request->file('image')){
            $fileName = time().'_'.$request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('images',$fileName,'public');
        }else
        {
            $path = 'images/icon.png';
        }
        $product = new Product();
        $product->name = $request["name"];
        $product->image = $path;
        $product->price = $request["price"];
        $product->status = $request["status"];
        $product->description = $request["description"];
        $product->save();

        DB::commit();
        return response()->json([
            "code"=>200,
            "data"=>$product
        ]);
    }

    function detail($id){
        $product = Product::where('id',$id)->get();
        return response()->json([
            "code"=>200,
            "data"=>$product
        ]);
    }
}
