<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Brand;
use App\State;
use App\Category;
use App\Area;
use App\Subcategory;
use App\Http\Requests\CreateProductRequest;
use Alert;
use App\Http\middleware\CheckUserRole;

class AdminProductsController extends Controller
{
    public function __construct(){

        //check dah login ke belum
        $this->middleware('auth');

        //check user role
        $this->middleware('check_user_role:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $products = Product::with('brand','subcategory','area','user');

        //conditional searching
        if (!empty($request->search_anything)) {

            $search_anything = $request->search_anything;

            $products = $products->where(function($query) use ($search_anything) {

                $query->orWhere('product_name','like','%'.$search_anything."%")->orWhere('product_description','like','%'.$search_anything.'%');
            });
        }
            //search by state
        if (!empty($request->search_state)) {

            $search_state = $request->search_state;

            $products = $products->whereHas('area', function ($query) use ($search_state) {
            $query->where('state_id', $search_state);
            });
        }

        if (!empty($request->search_brand)) {

            $search_brand = $request->search_brand;

            $products = $products->whereBrandId($search_brand);
        }

        if (!empty($request->search_category)) {

            $search_category = $request->search_category;

            $products = $products->whereHas('subcategory', function ($query) use ($search_category) {
            $query->where('category_id', $search_category);
            });
        }

        if (!empty($request->search_area)) {

            $search_area = $request->search_area;

            $products = $products->whereAreaId($search_area);
        }

        if (!empty($request->search_subcategory)) {

            $search_subcategory = $request->search_subcategory;

            $products = $products->whereSubcategoryId($search_subcategory);
        }

        $products = $products->orderBy('id','desc');

        //paginate the data
        $products = $products->paginate(6);


        $brands =Brand::pluck('brand_name','id');

        $categories =Category::pluck('category_name','id');

        $states =State::pluck('state_name','id');

        return view('admin.products.index',compact('products','brands','categories','states'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $brands = Brand::pluck('brand_name','id');

        $states = State::pluck('state_name','id');

        $categories = Category::pluck('category_name','id');

        return view('admin.products.create',compact('brands','states','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProductRequest $request)
    {
        //
        $product = new Product;

        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->product_price = $request->product_price;
        $product->condition = $request->condition;
        $product->brand_id = $request->brand_id;
        $product->state_id = $request->state_id;
        $product->area_id = $request->area_id;
        // $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;

        $product->user_id = auth()->id();

        if ($request->hasFile('product_image')) {

            $path = $request->product_image->store('public/uploads');

            $product->product_image = $request->product_image->hashName();
        }

        $product->save();
            Alert::success('Product succesfully create!')->autoclose(4000);

        // flash('Product succesfully created')->overlay();

        return redirect()->route('admin.products.index');

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
        $product = Product::find($id);

        $brands = Brand::pluck('brand_name','id');

        $states = State::pluck('state_name','id');

        $categories = Category::pluck('category_name','id');

        $areas = $this->getStateAreas($product->area->state_id);

        $subcategories = $this->getSubCategories($product->subcategory->category_id);


        return view('admin.products.edit',compact('brands','states','categories','product','areas','subcategories'));
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
        $product = Product::findOrFail($id);

        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->product_price = $request->product_price;
        $product->condition = $request->condition;
        $product->brand_id = $request->brand_id;
        $product->state_id = $request->state_id;
        $product->area_id = $request->area_id;
        // $product->category_id = $request->category_id;
        $product->subcategory_id = $request->subcategory_id;

        if ($request->hasFile('product_image')) {

            $path = $request->product_image->store('public/uploads');

            $product->product_image = $request->product_image->hashNAme();

        }

        $product->save();

        Alert::success('Product succesfully updated!')->autoclose(4000);

        // flash('Product succesfully updated')->overlay();

        return redirect()->route('admin.products.index');



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
        $product = Product::findOrFail($id);

        $product->delete();

        Alert::success('Product Succesfully Deleted!')->autoclose(3000);

        // flash('Product succesfully deleted')->overlay();

        return redirect()->route('admin.products.index');
    }

    public function getStateAreas($state_id)
    {
        
        $areas = Area::whereStateId($state_id)->pluck('area_name','id');

        return $areas;
        // echo 'at controller'.$state_id;
    }

    public function getSubCategories($category_id)
    {
        
        $categories = Subcategory::whereCategoryId($category_id)->pluck('subcategory_name','id');

        return $categories;
        // echo 'at controller'.$state_id;
    }
}
