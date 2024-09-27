@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Manage deals</h4>
                            <a href="{{ route('deals.create') }}"
                                class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                <i class="bx bx-plus"></i> Add New deal
                            </a>
                        </div>
                        <hr>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Discount</th>
                                    <th>Store</th>
                                    <th>Expiry Date</th>
                                    <th>Status</th>
                                    <th>Created by</th>
                                    <th>Updated by</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deals as $deal)
                                    <tr>
                                        <td>{{ $deal->name }}</td>
                                        <td>{{ $deal->discounted_price }}</td>
                                        <td>
                                            {{ $deal->store->name }}
                                            {{-- {{ $deal->store->subcategory->category->name ?? 'N/A' }} --}}
                                        </td>
                                        <td>{{ $deal->expiry_date->format('d-F-Y') }}</td>
                                        <td>{{ $deal->status ? 'Active' : 'Inactive' }}</td>
                                        <td>{{ $deal->creator ? $deal->creator->name : '' }}</td>
                                        <td>{{ $deal->updater ? $deal->updater->name : '' }}</td>
                                        <td>
                                            <a href="{{ route('deals.edit', $deal) }}"
                                                class="btn btn-soft-info waves-effect waves-light">
                                                <i class="bx bx-pencil"></i> Edit
                                            </a>
                                            <form action="{{ route('deals.destroy', $deal) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-soft-danger waves-effect waves-light"
                                                    onclick="return confirm('Are You Sure ?')">
                                                    <i class="bx bx-trash-alt"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
