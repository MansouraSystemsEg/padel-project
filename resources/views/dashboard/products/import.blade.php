@extends('layouts.dashboard')

@section('title-page', 'Import Product')

@section('title', 'Import Product')

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active">Import Product</li>
@endsection

@section('content')
    <div class="container">
        <form action="{{ route('products.import') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <x-form.input label='Products Count' type="text" name="count"/>
            </div>
          <button type="submit" class="btn btn-primary">Import</button>
    </form>
    </div>
@endsection
