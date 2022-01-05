<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
Use Image;
use Intervention\Image\Exception\NotReadableException;
use lluminate\Pagination\LengthAwarePaginator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $allProducts = Product::query();
        if($request->input('title') !='' || $request->input('brand_name') !='' || $request->input('sku_number') !='' || $request->input('supplier_name') !='' || $request->input('status') !=''){
            
            if($request->input('title') !=''){
                $allProducts->where('title','like','%'.$request->title.'%');
            }
            if($request->input('brand_name') !='' ){
                $allProducts->where('brand_name','like','%'.$request->brand_name.'%');
            }
            if($request->input('sku_number') !=''){
                $allProducts->where('sku_number','like','%'.$request->sku_number.'%');
            }
            if($request->input('supplier_name') !=''){
                $allProducts->where('supplier_name','like','%'.$request->supplier_name.'%');
            }
            if($request->input('status')!=''){
                $allProducts->where('status',$request->status);   
            }
        }
        $result = $allProducts->orderBy('id','desc')->paginate(15);
        return view('product/index')->with(array('products'=>$result));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product/add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:40',
            'brand_name' => 'required|max:40',
            'sku_number' => 'required|max:40',
            'supplier_name' => 'required|max:50',
            'product_weight' => 'required',
            'description' => 'required|min:10',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($files = $request->file('main_image')) {
            // for save original image
            $ImageUpload = Image::make($files);
            $originalPath = public_path().'/images/main/';
            $originalImageName = time().'-'.$files->getClientOriginalName();
            $originalFullPath = $originalPath.$originalImageName;
            $mainImagePath = $ImageUpload->save($originalFullPath);
             
            // for save thumnail image
            $thumbnailPath = public_path().'/images/thumbnail/';
            $ImageUpload->resize(250,125);
            $thumbImageName = time().'-thumb-'.$files->getClientOriginalName();
            $thumbFullPath = $thumbnailPath.$thumbImageName;
            $thumbnailPath = $ImageUpload->save($thumbFullPath);

            $shortThumbnailPath = public_path().'/images/shortThumbnail/';
            $ImageUpload->resize(100,100);
            $shortThumbImageName = time().'-shortthumb-'.$files->getClientOriginalName();
            $shortThumbFullPath = $shortThumbnailPath.$shortThumbImageName;
            $shortThumbnailPath = $ImageUpload->save($shortThumbFullPath);
        }
        $product = Product::create([
            'title'  => $request->title,
            'brand_name'  => $request->brand_name,
            'sku_number'  => $request->sku_number,
            'supplier_name'  => $request->supplier_name,
            'product_weight'  => $request->product_weight,
            'description'  => $request->description,
            'status'  => $request->status,
            'main_image'  => $originalImageName,
            'thumb_image'  => $thumbImageName,
            'short_thumb_image'  => $shortThumbImageName
        ]);

        if($product)
            return redirect()->back()->with('success_msg', 'Product data saved succesfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::find($id);
        return view('product/edit')->with(array('products'=>$products));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Product $product)
    {
        $validated = $request->validate([
            'title' => 'required|max:40',
            'brand_name' => 'required|max:40',
            'sku_number' => 'required|max:40',
            'supplier_name' => 'required|max:50',
            'product_weight' => 'required',
            'description' => 'required|min:10',
        ]);
        $productData = array(
            'title'  => $request->title,
            'brand_name'  => $request->brand_name,
            'sku_number'  => $request->sku_number,
            'supplier_name'  => $request->supplier_name,
            'product_weight'  => $request->product_weight,
            'description'  => $request->description,
            'status'  => $request->status
        );
        if ($files = $request->file('main_image')) {
            // Validation for the image if there is an image selected by user
            $request->validate(['main_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']);
           
            // for save original image
            $ImageUpload = Image::make($files);
            $originalPath = public_path().'/images/main/';
            $originalImageName = time().'-'.$files->getClientOriginalName();
            $originalFullPath = $originalPath.$originalImageName;
            $mainImagePath = $ImageUpload->save($originalFullPath);
             
            // for save thumnail image
            $thumbnailPath = public_path().'/images/thumbnail/';
            $ImageUpload->resize(250,125);
            $thumbImageName = time().'-thumb-'.$files->getClientOriginalName();
            $thumbFullPath = $thumbnailPath.$thumbImageName;
            $thumbnailPath = $ImageUpload->save($thumbFullPath);

            // for save 100X100 thumnail image
            $shortThumbnailPath = public_path().'/images/shortThumbnail/';
            $ImageUpload->resize(100,100);
            $shortThumbImageName = time().'-shortthumb-'.$files->getClientOriginalName();
            $shortThumbFullPath = $shortThumbnailPath.$shortThumbImageName;
            $shortThumbnailPath = $ImageUpload->save($shortThumbFullPath);
           
            // adding images name for inserting in the database, in the already created array in productData
            $productData['main_image']  = $originalImageName;
            $productData['thumb_image']  = $thumbImageName;
            $productData['short_thumb_image']  = $shortThumbImageName;
        }
        // Updating the data in the database
        $updatedData = $product->update($productData);
        if($updatedData)
        // Redirecting user on the product index page after updating the data
            return redirect()->route('product.index')
                        ->with('success_msg','Product updated successfully');
        else
            return redirect()->back()->with('error_msg','Product updated successfully');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')
        ->with('success_msg','Product deleted successfully');
    }
    public function change_status($id)
    {
       $status =  $_GET['status'];
       if(!empty($id)){
           $statusUpdate = Product::find($id);
            if($status=='active')
                $statusUpdate->status = 1;
            else
                $statusUpdate->status = 0;
            
            $statusUpdate->save();
        echo json_encode(array('status'=>'success'));        
       }    
    }
}
