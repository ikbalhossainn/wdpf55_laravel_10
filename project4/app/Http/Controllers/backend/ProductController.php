<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category; // to add category here
use App\Models\Product;
use Illuminate\Http\Request;



class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['products'] = Product::All();
        //dd($products);
        return view('backend.product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['cats'] = Category::All(); // for dropdown option
        return view('backend.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validate = $request->validate([  // left side = form name
            'name' => 'required | min:4',
            'description' => 'required | min:6',
            'price' => 'required | numeric',
            'category' => 'required',
            'photo' => 'mimes:jpg,jpeg,png',
        ]);

        // dd($request->all()) // for checking everything should be in comment

        if ($validate) {
            $data = [  // left side = database name
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category,
            ];

            $model = new Product();
            if ($model->insert($data)) {
                return redirect('product')->with('msg', 'Successfully Product Added');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
