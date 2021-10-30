@extends('layouts.sidebar')
@section('content')
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Type</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($data as $key => $value)
        <tr>
            <td>{{ ++$i }}</td>
            <td><a href="{{ route('creatures.show',$value->id) }}">{{ $value->name }}</a></td>
            <td>{{ $value->type }}</td>
            <td>
                <form action="{{ route('creatures.destroy',$value->id) }}" method="POST">
                    <a class="btn btn-primary" href="{{ route('creatures.approve',$value->id) }}">Approve</a>
                </form>
            </td>
        </tr>
        @endforeach
    </table>  
    {!! $data->links() !!} 
@endsection