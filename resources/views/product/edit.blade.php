@extends('layout.master')


@section('content')
    <div class="container ">

        <div class="container ">
            <h1 class="my-5">Update a Product Info</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('product.update', $oldProduct->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" value="{{ $oldProduct->name }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">serial Number</label>
                    <input type="text" class="form-control" name="serial_number"
                        value="{{ $oldProduct->serial_number }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">price</label>
                    <input type="text" class="form-control" name="price" value="{{ $oldProduct->price }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Update Image</label>
                    <input type="file" class="form-control" name="image" value="{{ old('image') }}">
                </div>
                <img src="{{ asset($oldProduct->image) }}">
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" rows="7" cols="30" class="form-control">{{ $oldProduct->description }}</textarea>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>
        </div>

    </div>
@endsection
