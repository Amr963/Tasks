@extends('layout.master')


@section('content')
    <div class="container ">

        <div class="container ">
            <h1 class="my-5">Add a Product</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="container">
                <div class="my-5">
                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            <form action="{{ route('product.store') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">serial Number</label>
                    <input type="text" class="form-control" name="serial_number" value="{{ old('serial_number') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">price</label>
                    <input type="text" class="form-control" name="price" value="{{ old('price') }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="7" cols="30" class="form-control">{{ old('description') }}</textarea>
                </div>
                <button type="submit" name="create" class="btn btn-primary">Add</button>
            </form>
        </div>

    </div>
@endsection
