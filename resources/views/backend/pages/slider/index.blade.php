@extends('backend.layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title">Sliders</h4>
                            <a href="{{ route('sliders.create') }}"
                                class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                <i class="bx bx-plus"></i> Add New Slider
                            </a>
                        </div>
                        <hr>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Store Name/Link</th>
                                    <th>Store Logo</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $slider)
                                    <tr>
                                        <td>{{ $slider->title }}</td>
                                        <td>{{ $slider->store_name }} <br> <a href="{{ $slider->link }}" target="_blank">{{ $slider->link }}</a></td>
                                        <td><img src="{{asset('uploads/sliders/logo/' . $slider->logo_path)}}" width="100px" alt="{{$slider->store_name}}"></td>
                                        <td>
                                            <a href="{{ route('sliders.edit', $slider->id) }}"
                                                class="btn btn-soft-info waves-effect waves-light">
                                                <i class="bx bx-pencil"></i> Edit
                                            </a>
                                            <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-soft-danger waves-effect waves-light"
                                                    onclick="return confirm('Are you sure?')">
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
