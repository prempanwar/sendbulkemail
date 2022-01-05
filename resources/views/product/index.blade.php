 @extends('layouts.app', ['activePage' => 'product-list', 'title' => 'Product List', 'navName' => 'Products List', 'activeButton' => 'product'])

@section('content')

<div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                @if(session()->has('success_msg'))
                    <div class="alert alert-success">
                        {{ session()->get('success_msg') }}
                    </div>
                @endif
                @if(session()->has('error_msg'))
                    <div class="alert alert-error">
                        {{ session()->get('error_msg') }}
                    </div>
                @endif
                <div class="panel-body">
			<form action="{{ route('product.index')}}" method="GET" class="form-horizontal" role="form">
				<div class="form-group">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-2 col-sm-6 mb-3">
								<label for="title" class="control-label">Title</label>
								<input type="text" class="form-control" name="title" id="title" placeholder="Title" value="{{ app('request')->input('title') }}">
							</div>
							<div class="col-md-2 col-sm-6 mb-3">
								<label for="brand_name" class="control-label">Brand Name</label>
								<input type="text" class="form-control" name="brand_name" id="brand_name" placeholder="Brand Name" value="{{ app('request')->input('brand_name') }}">
							</div>
							<div class="col-md-2 col-sm-6 mb-3">
								<label for="sku_number" class="control-label">Sku Number</label>
								<input type="text" class="form-control" name="sku_number" id="sku_number" placeholder="Sku Number" value="{{  app('request')->input('sku_number') }}">
							</div>
                            <div class="col-md-2 col-sm-6 mb-3">
								<label for="supplier_name" class="control-label">Supplier Name</label>
								<input type="text" class="form-control" name="supplier_name" id="supplier_name" placeholder="Supplier Name" value="{{  app('request')->input('supplier_name') }}">
							</div>
                            <div class="col-md-2 col-sm-6 mb-3">
								<label for="tech" class="control-label">Status</label>
								<select class="form-control" name="status" >
									<option value="">All</option>
									<option value="1" {{ (app('request')->input('status')==1) ?'selected':'' }} >Active</option>
									<option value="0" {{ ( app('request')->input('status')==0 && app('request')->input('status')!=null ) ? 'selected':'' }}>Inactive</option>
								</select>
							</div>
                            <div class="col-md-2 col-sm-6 mb-3">
                                <a href="{{ url('/product') }}" class="reset-submit-button" rel="tooltip" title=""  data-original-title="Reset Search"><i class="fa fa-refresh"></i></a>
                                <button type="submit" class="btn btn-primary search-submit-button">Submit</button>
                            </div>
						</div>
				</div>
				</div>
                </form>
                </div>
                    <div class="card strpied-tabled-with-hover">
                        <!-- <div class="card-header ">
                            <a href="{{ url('/product/create') }}" class="btn btn-primary pull-right">Add Products</a>
                        </div> -->
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Title</th>
                                        <th>Brand Name</th>
                                        <th>SKU Number</th>
                                        <th>Supplier Name</th>
                                        <th>Weight</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $i = 1;
                                        $page =  app('request')->input('page');
                                        $pageNum = 0;
                                        if($page && $page>1)
                                            $pageNum = ($page-1)*15;
                                    //print_r($products); die;
                                    @endphp
                                    
                                    @if(!$products->isEmpty())
                                        @foreach($products as $row)
                                            <tr>
                                                <td>{{ ($pageNum)+$i++ }}</td>
                                                <td>{{ucfirst($row->title)}}</td>
                                                <td>{{ucfirst($row->brand_name)}}</td>
                                                <td>{{$row->sku_number}}</td>
                                                <td>{{$row->supplier_name}}</td>
                                                <td>{{$row->product_weight}}kg</td>
                                                <td>@if(strlen($row->description) < 15) 
                                                        {{ $row->description }} 
                                                    @else
                                                        {{ \Illuminate\Support\Str::limit($row->description, 15, '...') }} 
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($row->status==1) 
                                                        <span class="badge badge-success product-status" data-id="{{ $row->id }}" data-status='Inactive' >Active</span> 
                                                    @else 
                                                        <span class="badge badge-danger product-status" data-id="{{ $row->id }}" data-status='active'>Inative</span> @endif</td>
                                                <td>
                                                <a href="{{ url('/product/'.$row->id.'/edit/' ) }}" rel="tooltip" title="" class="btn btn-info btn-simple btn-link" data-original-title="Edit Task">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                               
                                                    <a href="javascript:void(0)" rel="tooltip" title="" class="btn btn-info btn-simple btn-link delete-product" data-id="{{$row->id}}" data-original-title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                    </a>
                                                   
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            
                                            <th colspan="3">No data Found</th>
                                            
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="pagination-custom pull-right">
                                @if($products)
                                    {{ $products->appends(request()->all())->links() }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
