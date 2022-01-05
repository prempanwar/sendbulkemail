@extends('layouts.app', ['activePage' => 'email', 'title' => 'Send Email', 'navName' => 'Send Bulk Email', 'activeButton' => 'laravel'])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card strpied-tabled-with-hover">
                        <div class="card-header ">
                            <form action="{{ route('email')}}" method="GET" class="form-horizontal" role="form">
                                <div class="form-group">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-2 col-sm-6 mb-3">
                                                <label for="tech" class="control-label">Email Status</label>
                                                <select class="form-control" name="status" >
                                                    <option value="">All</option>
                                                    <option value="1" {{ (app('request')->input('status')==1) ?'selected':'' }} >Delivered</option>
                                                    <option value="2" {{ ( app('request')->input('status')==2 && app('request')->input('status')!=null ) ? 'selected':'' }}>Not Delivered</option>
                                                </select>
                                            </div>
                                            <div class="col-md-2 col-sm-6 mb-3">
                                                <a href="{{ url('/email') }}" class="reset-submit-button" rel="tooltip" title=""  data-original-title="Reset Search"><i class="fa fa-refresh"></i></a>
                                                <button type="submit" class="btn btn-primary search-submit-button">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover table-striped">
                                @php 
                                    $i = 1;
                                    $page =  app('request')->input('page');
                                    $pageNum = 0;
                                    if($page && $page>1)
                                        $pageNum = ($page-1)*15;
                                @endphp       
                                <thead>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                    @if(!$emails->isEmpty())
                                        @foreach($emails as $key => $value)
                                            <tr>
                                                <td>{{ ($pageNum)+$i++ }}</td>
                                                <td>{{ $value->name }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>@if($value->status==1) Delivered @else Not Delivered @endif</td>
                                            </tr>
                                        @endforeach
                                    @else
                                    <tr>
                                        
                                        <th colspan="4">No data Found</th>
                                        
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                            <div class="pagination-custom pull-right">
                                @if($emails)
                                    {{ $emails->appends(request()->all())->links() }}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-md-12">
                    <div class="card card-plain table-plain-bg">
                        <div class="card-header ">
                            <h4 class="card-title">Table on Plain Background</h4>
                            <p class="card-category">Here is a subtitle for this table</p>
                        </div>
                        <div class="card-body table-full-width table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Salary</th>
                                    <th>Country</th>
                                    <th>City</th>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Dakota Rice</td>
                                        <td>$36,738</td>
                                        <td>Niger</td>
                                        <td>Oud-Turnhout</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Minerva Hooper</td>
                                        <td>$23,789</td>
                                        <td>Curaçao</td>
                                        <td>Sinaai-Waas</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Sage Rodriguez</td>
                                        <td>$56,142</td>
                                        <td>Netherlands</td>
                                        <td>Baileux</td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Philip Chaney</td>
                                        <td>$38,735</td>
                                        <td>Korea, South</td>
                                        <td>Overland Park</td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Doris Greene</td>
                                        <td>$63,542</td>
                                        <td>Malawi</td>
                                        <td>Feldkirchen in Kärnten</td>
                                    </tr>
                                    <tr>
                                        <td>6</td>
                                        <td>Mason Porter</td>
                                        <td>$78,615</td>
                                        <td>Chile</td>
                                        <td>Gloucester</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
@endsection