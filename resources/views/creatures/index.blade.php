@extends('layouts.sidebar')
@section('content')
    <div class="row">
        <a href="{{ route('creatures.admin')}}" class="btn btn-default"> Admin </a>
    </div>
    <div class="col-md-6">
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <th>Type</th>
            </tr>
            @foreach ($data as $key => $value)
            <tr>
                <td>{{ $value->name }}</td>
                <td>{{ $value->type }}</td>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
@endsection