@extends('layouts.app', ['activePage' => 'product', 'title' => 'Edit Products', 'navName' => 'Add Product', 'activeButton' => 'product'])

@section('content')
<div class="container">
  	<section class="panel panel-default">
		<div class="panel-heading add-product-heading"> 
			<h3 class="panel-title">Edit Product</h3> 
			<a href="http://127.0.0.1:8000/product" class="btn btn-primary pull-right product-list-on-add">Products list</a>
		</div> 
		@if ($errors->any())
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		@endif
		@if(session()->has('success_msg'))
			<div class="alert alert-success">
				{{ session()->get('success_msg') }}
			</div>
		@endif
		<hr>
		<div class="panel-body">
			<form action="{{ route('product.update',$products->id) }}" method="post" class="form-horizontal" role="form" id="addProducts" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<div class="form-group">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-4 col-sm-6 mb-3">
								<label for="title" class="control-label">Title</label>
								<input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{$products->title}}">
							</div>
							<div class="col-md-4 col-sm-6 mb-3">
								<label for="brand_name" class="control-label">Brand Name</label>
								<input type="text" class="form-control" name="brand_name" id="brand_name" placeholder="Brand Name" value="{{$products->brand_name}}">
							</div>
							<div class="col-md-4 col-sm-6 mb-3">
								<label for="sku_number" class="control-label">Sku Number</label>
								<input type="text" class="form-control" name="sku_number" id="sku_number" placeholder="Sku Number" value="{{$products->sku_number}}">
							</div>
						</div>
				</div>
				</div>

				<div class="form-group">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-4 col-sm-6 mb-3">
								<label for="supplier_name" class="control-label">Supplier Name</label>
								<input type="text" class="form-control" name="supplier_name" id="supplier_name" placeholder="Supplier Name" value="{{$products->supplier_name}}">
							</div>
							<div class="col-md-4 col-sm-6 mb-3">
								<label for="product_weight" class="control-label">Product Weight( KG )</label>
								<input type="text" class="form-control" name="product_weight" id="product_weight" placeholder="Product Weight" value="{{$products->product_weight}}">
							</div>
							<div class="col-md-4 col-sm-6 mb-3">
								<label for="tech" class="control-label">Status</label>
								<select class="form-control" name="status" >
									
								<option value="1" @if( $products->status==1) selected @endif>Active</option>
									<option value="0" @if( $products->status==0) selected @endif>Inactive</option>
								</select>
							</div>
						</div> 
					</div> 
				</div>

				<div class="form-group">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-4 col-sm-6 mb-3">
								<label for="description" class="control-label">Description</label>
								<textarea class="form-control description" name="description" rows="4" cols="50">{{ $products->description }}</textarea>
							</div>
																							
							<div class="col-md-4 col-sm-6 mb-3">
								<label for="name" class="control-label">Product Image</label></br>
								<input type="file" name="main_image" id="main_image">
							</div>
							<div class="col-md-4 col-sm-6 mb-3">
								@if(file_exists(url('/').'/images/thumbnail/'.$products->thumb_image))
									<img src="{{ url('/').'/images/thumbnail/'.$products->thumb_image }}" />
								@else
									<img src="{{ $products->thumb_image }}" />
								@endif
							</div>
						</div>
					</div>
				</div> 

				<hr>
				<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9">
					<button type="submit" class="btn btn-primary">Save</button>
				</div>
				</div> <!-- form-group // -->
			</form>
		</div><!-- panel-body // -->
  	</section><!-- panel// -->
</div> <!-- container// -->

<style>
.description{
  height:150px
}
</style>
@endsection
