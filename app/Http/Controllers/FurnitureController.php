<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Type;
use App\Models\Furniture;
use DB;

class FurnitureController extends Controller
{
    //
    public function add(){
        $colors = Color::all();
        $types = Type::all();

        $data = [
            'colors' => $colors,
            'types' => $types
        ];

        return view('furniture.add', $data);
    }

    public function insert(Request $request){
        $request->validate([
            'name' => 'required|max:15|unique:furniture',
            'price' => 'required|numeric|gte:5000|lte:10000000',
            'typeId' => 'required',
            'colorId' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg'
        ]);

        $path = $request->file('image')->store('public/images');

        Furniture::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'typeId' => $request->input('typeId'),
            'colorId' => $request->input('colorId'),
            'image' => $path
        ]);

        return redirect('/home')->with('success', 'Insert Product Success!');
    }

    public function home(){
        $furnitures = Furniture::inRandomOrder()->limit(4)->get();

        return view('home', ['furnitures' => $furnitures]);
    }

    public function view(Request $request){
        $name = $request->input('search');

        $furnitures;
        if($name == null){
            $furnitures = Furniture::paginate(4);
        }
        else{
            $furnitures = Furniture::where('name', $name)->paginate(4);
        }

        return view('furniture.view', ['furnitures' => $furnitures]);
    }

    public function edit($id){
        $colors = Color::all();
        $types = Type::all();
        $furniture = Furniture::where('id', $id)->first();

        $data = [
            'colors' => $colors,
            'types' => $types,
            'furniture' => $furniture
        ];

        return view('furniture.update', $data);
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|max:15|unique:furniture,name,'.$id,
            'price' => 'required|numeric|gte:5000|lte:10000000',
            'typeId' => 'required',
            'colorId' => 'required'
        ]);

        Furniture::where('id', $id)->update([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'typeId' => $request->input('typeId'),
            'colorId' => $request->input('colorId')
        ]);

        if($request->hasFile('image')){
            $request->validate([
                'image' => 'mimes:jpg,png,jpeg' 
            ]);
            
            $path = $request->file('image')->store('public/images');

            Furniture::where('id', $id)->update([
                'image' => $path
            ]);
        }

        return redirect('/home')->with('success', 'Update Product Success!');
    }

    public function delete($id){
        Furniture::where('id', $id)->delete();

        return redirect('/home')->with('success', 'Delete Product Success!');;
    }

    public function detail($id){
        $furniture = DB::table('furniture')
                     ->join('colors', 'furniture.colorId', '=', 'colors.id')
                     ->join('types', 'furniture.typeId', '=', 'types.id')
                     ->select('furniture.*', 'colors.name as color', 'types.name as type')
                     ->where('furniture.id', $id)
                     ->first();

        return view('furniture.detail', ['furniture' => $furniture]);
    }
}
