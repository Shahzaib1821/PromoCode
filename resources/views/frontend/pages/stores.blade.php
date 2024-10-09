@extends('frontend.layouts.app')

@section('content')
<section class="section">
    <div class="container">
        <div class="store-alphabets m30top text-center">
            <ul class="d-flex justify-content-center flex-wrap gap-1 p-0">
                <li class="mt-2"><a class="list-style-none stores-alphabets" href="#">ALL</a></li>
                @foreach (range('A', 'Z') as $letter)
                    <li class="mt-2"><a class="list-style-none stores-alphabets" href="#{{ $letter }}">{{ $letter }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="row mb-4 mt-4 m-auto">
            <div class="col-md-12">
                <h2 class="main-head m30top">All Stores</h2>
            </div>
        </div>
        <div class="row mb-4 mt-4 m-auto">
            <div class="col-md-12">
                <div class="about-content redius white padding30 m30top m30bottom z-depth-2">
                    <div class="row mb-4 mt-4 m-auto">
                        @foreach ($organizedStores as $letter => $stores)
                            <div class="store-entry col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12" data-letter="{{ $letter }}" id="{{ $letter }}">
                                <h3>{{ $letter }}</h3>
                                <ul class="m-3 bullet">
                                    @foreach ($stores as $store)
                                        <li>
                                            <a class="store-name" href="{{ route('stores-details', $store->slug) }}" style="font-size:13px">
                                                <strong>{{ $store->name }}</strong>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach
                        <div id="noDataFound" style="display: none; text-align: center; width: 100%">
                            <div class="alert alert-success" role="alert">
                                No Data Found !
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
