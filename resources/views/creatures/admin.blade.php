@extends('layouts.sidebar')
@section('content')
<div class="row" style="margin-top: 5rem;">
        <div class="col-lg-10 margin-tb">
            <div class="pull-left">
                <h2>Creature Codex</h2>
            </div>
            <div class="pull-right">
                <div class="row">
                    <div class="col-md-6">
                        <a class="btn btn-success" href="{{ route('creatures.create') }}"> Create New Creature</a>
                        <a href="{{ route('creatures.admin')}}" class="btn btn-primary"> Admin </a>
                        <a href="{{ route('creatures.review')}}" class="btn btn-primary"> Review </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            <form action="{{ route('creatures.admin') }}" method="GET" role="search">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-info" type="submit" title="Search creatures">
                            Search
                        </button>
                    </span>
                    <input type="text" class="form-control col-md-4" name="term" placeholder="{{$search_term}}" id="term" @if($search_term !== "Search creatures") value="{{$search_term}}" @endif>
                    <select class="form-control col-md-2" name="filter_type" id="filter_type">
                        <option value="" @if (isset($filter_type) && $filter_type == "") selected @endif>Creature Type</option>
                        @foreach ($types as $type)
                            <option value="{{$type}}" @if (isset($filter_type) && $type == $filter_type) selected @endif>{{$type}}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Status</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $value)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $value->name }}</td>
            <td>
                @if ($value->status == 0)
                    in review
                @else
                    approved
                @endif
            </td>
            <td>
                <form action="{{ route('creatures.destroy',$value->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('creatures.show',$value->id) }}">Show</a>    
                    <a class="btn btn-primary" href="{{ route('creatures.edit',$value->id) }}">Edit</a>   
                    @csrf
                    @method('DELETE')      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>  
    {!! $data->links() !!} 
@endsection