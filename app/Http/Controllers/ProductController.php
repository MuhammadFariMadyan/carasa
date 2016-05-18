<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Hash;
use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $product = Product::paginate(6);

        return view('product', compact('product'));        
    }

    /**
     * Display food category
     * 
     * @return $food
     */
    public function filterFood() 
    {
        $food = Product::where('id_kategori', '=', '1')->paginate(6);

        return view('food', compact('food'));

    }

    /**
     * Display drink category
     * 
     * @return $drink
     */
     public function filterDrink() 
    {
        $drink = Product::where('id_kategori', '=', '2')->paginate(6);

        return view('drink', compact('drink'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function sort(Request $request)
    {
        $string =  $request->input('sortselect');
        $product = Product::orderBy($string,'ASC')->paginate(6);
        return view('product', compact('product'));   
    }

    public function search(Request $request)
    {
        $key=$request->get('keyword');
        $product = Product::where('nama','like','%'.$key.'%')->paginate(6);
        return view('product', compact('product'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
