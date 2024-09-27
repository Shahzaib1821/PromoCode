@extends('backend.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title mb-4">Website Settings</h2>
                        <form method="POST" action="{{ route('admin.settings.update') }}" enctype="multipart/form-data">
                            @csrf

                            <h3 class="mt-4">General Settings</h3>
                            <div class="form-group mb-4">
                                <label for="site_title">Site Title</label>
                                <input type="text" class="form-control @error('site_title') is-invalid @enderror"
                                    id="site_title" name="site_title" value="{{ $settings['site_title'] ?? '' }}">
                                @error('site_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row">
                                <h3 class="mt-4">Logos</h3>
                                <div class="col-12 mb-3">
                                    <div class="form-group">
                                        <label for="logo_max_width">Logo Max Width (px)</label>
                                        <input type="number" class="form-control" id="logo_max_width" name="logo_max_width"
                                            value="{{ $settings['logo_max_width'] ?? 200 }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-4">
                                        <label for="header_logo">Header Logo</label>
                                        <input type="file" class="form-control" id="header_logo" name="header_logo">
                                    </div>
                                    @if (isset($settings['header_logo']))
                                        <img src="{{ asset('uploads/' . $settings['header_logo']) }}"
                                            alt="Current Header Logo" class="mt-2"
                                            style="max-width: {{ $settings['logo_max_width'] ?? 200 }}px;">
                                    @endif
                                </div>
                                <div class="col-6">
                                    <div class="form-group mb-4">
                                        <label for="footer_logo">Footer Logo</label>
                                        <input type="file" class="form-control" id="footer_logo" name="footer_logo">
                                    </div>
                                    @if (isset($settings['footer_logo']))
                                        <img src="{{ asset('uploads/' . $settings['footer_logo']) }}"
                                            alt="Current Footer Logo" class="mt-2"
                                            style="max-width: {{ $settings['logo_max_width'] ?? 200 }}px;">
                                    @endif
                                </div>
                            </div>

                            <h3 class="mt-4">Colors</h3>
                            <div class="form-group mb-4">
                                <label for="primary_color">Primary Color</label>
                                <input type="color" class="form-control" id="primary_color" name="primary_color"
                                    value="{{ $settings['primary_color'] ?? '#000000' }}">
                            </div>
                            <div class="form-group mb-4">
                                <label for="secondary_color">Secondary Color</label>
                                <input type="color" class="form-control" id="secondary_color" name="secondary_color"
                                    value="{{ $settings['secondary_color'] ?? '#ffffff' }}">
                            </div>

                            <h3 class="mt-4">Typography</h3>
                            @foreach (['h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'p', 'span'] as $element)
                                <div class="form-group mb-4">
                                    <label for="{{ $element }}_font_size">{{ strtoupper($element) }} Font Size
                                        (px)
                                    </label>
                                    <input type="number" class="form-control" id="{{ $element }}_font_size"
                                        name="{{ $element }}_font_size"
                                        value="{{ $settings[$element . '_font_size'] ?? '' }}">
                                </div>
                            @endforeach

                            <h3 class="mt-4">Buttons</h3>
                            <div class="form-group mb-4">
                                <label for="primary_button_color">Primary Button Color</label>
                                <input type="color" class="form-control" id="primary_button_color"
                                    name="primary_button_color"
                                    value="{{ $settings['primary_button_color'] ?? '#007bff' }}">
                            </div>
                            <div class="form-group mb-4">
                                <label for="secondary_button_color">Secondary Button Color</label>
                                <input type="color" class="form-control" id="secondary_button_color"
                                    name="secondary_button_color"
                                    value="{{ $settings['secondary_button_color'] ?? '#6c757d' }}">
                            </div>

                            <h3 class="mt-4">Social Media Links</h3>
                            @foreach (['facebook', 'twitter', 'instagram', 'linkedin'] as $social)
                                <div class="form-group mb-4">
                                    <label for="{{ $social }}_link">{{ ucfirst($social) }} Link</label>
                                    <input type="url" class="form-control" id="{{ $social }}_link"
                                        name="{{ $social }}_link" value="{{ $settings[$social . '_link'] ?? '' }}">
                                </div>
                            @endforeach

                            <div class="row justify-content-end">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary w-md">Save Settings</button>
                                    <button type="button" class="btn btn-danger" onclick="resetSettings()">Reset to
                                        Default</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function resetSettings() {
            if (confirm('Are you sure you want to reset all settings to default values? This action cannot be undone.')) {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route('admin.settings.reset') }}';
                var csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                form.appendChild(csrfToken);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endsection
