@extends('layouts.sidebar')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Show Creature</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('creatures.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>user_id:</strong>
                {{ $creature->user_id }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Creature Name:</strong>
                {{ $creature->name }}
            </div>
        </div>
    </div>
@endsection