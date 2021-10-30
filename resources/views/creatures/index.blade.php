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
            <form @if($action == "review") action="{{ route('creatures.review') }}" @else action="{{ route('creatures.index') }}" @endif method="GET" role="search">
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

    <div class="col-md-6">
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Size</th>
                <th>Alignment</th>
                @if($action == "review")
                    <th>Status</th>
                    <th>Toggle Status</th>
                @endif
            </tr>
            @foreach ($data as $key => $creature)
            <tr>
                <td><a href="{{ route('creatures.show',$creature->id) }}">{{ $creature->name }}</a></td>
                <td>{{ $creature->size }}</td>
                <td>{{ $creature->type }}</td>
                <td>{{ $creature->alignment }}</td>
                @if($action == "review")
                    <td>{{ $creature->status }}</td>
                    <td>
                        <livewire:toggle-button
                            :model="$creature"
                            field="status"
                            key="{{$creature->id}}"
                        >
                    </td>
                @endif
            </tr>
            @endforeach
        </table>
    </div>
@endsection