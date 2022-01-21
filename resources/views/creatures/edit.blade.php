@extends('layouts.sidebar')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Creature</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('creatures.index') }}"> Back</a>
            </div>
        </div>
    </div>
   
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error</strong> you haven't filled in all required fields.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
  
    <form action="{{ route('creatures.update',$creature->id) }}" method="POST">
        @csrf
        @method('PUT')
        @php
            $size = $creature->size;
            $type = $creature->type;
            $alignment = $creature->alignment;
        @endphp
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <strong>Creature Name: *</strong>
                    <input type="text" name="name" value="{{ $creature->name }}" class="form-control" placeholder="Enter Creature name"></textarea>
                </div>
            </div>
        </div>
        <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <strong>Size: *</strong><select name="size" class="form-control">
                    <option value="Tiny" @if ($size == "Tiny") selected @endif >Tiny</Option>
                    <option value="Small" @if ($size == "Small") selected @endif>Small</Option>
                    <option value="Medium" @if ($size == "Medium") selected @endif>Medium</Option>
                    <option value="Large" @if ($size == "Large") selected @endif>Large</Option>
                    <option value="Huge" @if ($size == "Huge") selected @endif>Huge</Option>
                    <option value="Gargantuan" @if ($size == "Gargantuan") selected @endif>Gargantuan</Option>
                    <option value="Massive" @if ($size == "Massive") selected @endif>Massive</Option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <strong>Type: *</strong>
                <select name="type" class="form-control">
                    <option value="Abberation" @if ($type == "Abberation") selected @endif>Abberation</Option>
                    <option value="Beast" @if ($type == "Beast") selected @endif>Beast</Option>
                    <option value="Elemental" @if ($type == "Elemental") selected @endif>Elemental</Option>
                    <option value="Plant" @if ($type == "Plant") selected @endif>Plant</Option>
                    <option value="Humanoid" @if ($type == "Humanoid") selected @endif>Humanoid</Option>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <strong>Alignment: *</strong>
                <select name="alignment" class="form-control">
                    <option value="Lawful Neutral" @if ($alignment == "Lawful Neutral") selected @endif>Lawful Neutral</Option>
                    <option value="True Neutral" @if ($alignment == "True Neutral") selected @endif>True Neutral</Option>
                    <option value="Chaotic Neutral" @if ($alignment == "Chaotic Neutral") selected @endif>Chaotic Neutral</Option>
                    <option value="Lawful Evil" @if ($alignment == "Lawful Evil") selected @endif>Lawful Evil</Option>
                    <option value="Neutral Evil" @if ($alignment == "Neutral Evil") selected @endif>Neutral Evil</Option>
                    <option value="Chaotic Evil" @if ($alignment == "Chaotic Evil") selected @endif>Chaotic Evil</Option>
                    <option value="Lawful Good" @if ($alignment == "Lawful Good") selected @endif>Lawful Good</Option>
                    <option value="Neutral Good" @if ($alignment == "Neutral Good") selected @endif>Neutral Good</Option>
                    <option value="Chaotic Good" @if ($alignment == "Chaotic Good") selected @endif>Chaotic Good</Option>
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