@extends('layouts.app')

@section('content')
    @if (session()->has('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Purchase Details</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Purchase Id</th>
                                    <th>User Id</th>
                                    <th>Product Id</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Date Created</th>
                                    <th>Date Modified</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($userpurchases as $purchase)
                                    <tr>
                                        <td>{{ $purchase->id }}</td>
                                        <td>{{ $purchase->purchase_id }}</td>
                                        <td>{{ $purchase->user_id }}</td>
                                        <td>{{ $purchase->product_id }}</td>
                                        <td>{{ $purchase->quantity }}</td>
                                        <td>{{ $purchase->price }}</td>
                                        <td>{{ $purchase->created_at }}</td>
                                        <td>{{ $purchase->updated_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8">No purchase details found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
