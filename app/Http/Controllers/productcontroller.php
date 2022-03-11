<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class productcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $product = product::all();
    return view("inventory views/index")->with("products", $product);
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("inventory views/create");//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "name"=>"required",
            "description"=>"required",
            "price"=>"required",
            "nafdacno"=>"required",
            "quantity"=>"required"
        ]);
            $input = $request->all();
            product::create($input);
            return redirect("products")->with('flash message',"student added successfuly");//
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $product = product::find($id);
       return view("inventory views/show")->with("products",$product); //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $products = product::find($id);
       return view("inventory views/edit")->with("products",$products); //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "name"=>"required",
            "description"=>"required",
            "price"=>"required",
            "nafdacno"=>"required",
            "quantity"=>"required"
        ]);
        $product = product::find($id);
        $product->name=$request->name;
        $product->description=$request->description;
        $product->nafdacno=$request->nafdacno;
        $product->price=$request->price;
        $product->quantity=$request->quantity;
        $product->save();
        return redirect('products')->with("flash message","product updated successfully ");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $delete = product::destroy($id);
      return redirect("products")->with("flash message", "product removed");
        //
    }
public function display(){
    return view('search');
}

    public function search(){
        $search= $_GET["searchquery"];
        $products=product::where('name','LIKE', '%'.$search.'%')->andWhere('description','LIKE','%'.$search.'%')->get();
        if(count($search)>0){
            return view("search")->with('products',$products);}
        else{
        return view('search')->with('message','no goods available match your search');
        }
    } 
}
