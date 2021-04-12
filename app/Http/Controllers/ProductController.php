<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    //
    public function addimg(Request $req)
    {

        $product=new Product;
        $product->name=$req->name;
        $product->description=$req->description;
        $product->price=$req->price;
        $product->file_path=$req->file('file')->store('products');
        $product->save();
        return $product;
       // return $req->input();
        //return $req->file('file')->store('products'); //store laravel file
        //return "imgggg";
    }
    public function list()
    {
        return Product::all();
    }
    public function delete($id)
    {
        $result=Product::where('id',$id)->delete();
        if($result)
        {
            return ["result"=>"DEleted successfully"];
        }
        else{
            return ["result"=>"Not Found! Nothing to delete.."];
        }
    }
    public function getproduct($id)
    {
        $result= Product::find($id);
        if($result)
        {
            return $result;
        }
        else{
            return ["result"=>"Not Found!!."];
        }
    }
    public function search($name)
    {
        $result=Product::where('name','like','%'.$name.'%')->get();
        if (count($result)) {
            return $result;
        } else {
            return array('Result', 'No records found');
        }
      //  return "sercgh";
    }
}
