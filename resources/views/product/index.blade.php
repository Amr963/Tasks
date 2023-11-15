@extends('layout.master')

@section('content')
    <div class="container">
        <div class="my-5">
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="my-5">
            <a href="{{ route('product.create') }}" class="btn btn-primary">Add Product</a>
        </div>
        <div class="row">
            <div class="col-8 mx-auto">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">price</th>
                            <th scope="col">serial number</th>
                            <th scope="col">description</th>
                            <th scope="col">options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->serial_number }}</td>
                                <td>{{ $product->description }}</td>
                                <td>
                                    <a href="{{ route('product.edit', $product->id) }}">edit</a>
                                    <a href="{{ route('product.delete', $product->id) }}">delete</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="100">there is no records on products table</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
