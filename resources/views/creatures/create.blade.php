@extends('layouts.sidebar')
@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Add New Creature</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{ route('creatures.index') }}"> Back</a>
        </div>
    </div>
</div>
   
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
   
<form action="{{ route('creatures.store') }}" method="POST">
    @csrf
  
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <strong>user_id: *</strong>
                <input type="text" name="user_id" class="form-control" placeholder="Enter user_id">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <strong>Creature Name: *</strong>
                <input type="text" name="name" class="form-control" placeholder="Enter Creature name"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <strong>Size: *</strong><select name="size" class="form-control">
                    <option value="Tiny">Tiny</Option>
                    <option value="Small">Small</Option>
                    <option value="Medium">Medium</Option>
                    <option value="Large">Large</Option>
                    <option value="Huge">Huge</Option>
                    <option value="Gargantuan">Gargantuan</Option>
                    <option value="Massive">Massive</Option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <strong>Type: *</strong>
                <select name="type" class="form-control">
                    <option value="Abberation">Abberation</Option>
                    <option value="Beast">Beast</Option>
                    <option value="Elemental">Elemental</Option>
                    <option value="Plant">Plant</Option>
                    <option value="Humanoid">Humanoid</Option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <strong>Alignment: *</strong>
                <select name="alignment" class="form-control">
                    <option value="Lawful Neutral">Lawful Neutral</Option>
                    <option value="True Neutral">True Neutral</Option>
                    <option value="Chaotic Neutral">Chaotic Neutral</Option>
                    <option value="Lawful Evil">Lawful Evil</Option>
                    <option value="Neutral Evil">Neutral Evil</Option>
                    <option value="Chaotic Evil">Chaotic Evil</Option>
                    <option value="Lawful Good">Lawful Good</Option>
                    <option value="Neutral Good">Neutral Good</Option>
                    <option value="Chaotic Good">Chaotic Good</Option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
   
</form>
@endsection
