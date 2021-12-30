<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;
use App\Models\Type;
use App\Models\Furniture;

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

        return redirect('/home');
    }

    public function home(){
        $furnitures = Furniture::inRandomOrder()->limit(4)->get();

        return view('home', ['furnitures' => $furnitures]);
    }
}
