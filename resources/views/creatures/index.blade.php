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
            <form action="{{ route('creatures.index') }}" method="GET" role="search">
                <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-info" type="submit" title="Search creatures">
                            Search
                        </button>
                    </span>
                    <input type="text" class="form-control col-md-4" name="term" placeholder="Search creatures" id="term">
                    <select class="form-control col-md-2" name="filter_type" id="filter_type">
                        <option value="" @if ($filter_type == "") selected @endif>Creature Type</option>
                        @foreach ($types as $type)
                            <option value="{{$type}}" @if ($type == $filter_type) selected @endif>{{$type}}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Size</th>
                <th>Alignment</th>
            </tr>
            @foreach ($data as $key => $value)
            <tr>
                <td><a href="{{ route('creatures.show',$value->id) }}">{{ $value->name }}</a></td>
                <td>{{ $value->size }}</td>
                <td>{{ $value->type }}</td>
                <td>{{ $value->alignment }}</td>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection