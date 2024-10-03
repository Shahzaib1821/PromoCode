<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Dashboard | Skote - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    @include('backend.layouts.includes.head')
    @yield('head')
</head>

<body data-sidebar="dark">
    @include('backend.layouts.includes.header')

    @include('backend.layouts.includes.sidebar')

    @yield('content')

    @include('backend.layouts.includes.footer')

    @include('backend.layouts.includes.foot')

    @yield('scripts')
    <script>
        $(document).ready(function() {
            var table = $('#datatable').DataTable();

            // Check for stored filter value
            var storedFilter = localStorage.getItem('storeFilter');
            if (storedFilter) {
                $('#storeFilter').val(storedFilter);
                table.search(storedFilter).draw();
            }

            // Event listener for filter input
            $('#storeFilter').on('keyup', function() {
                var filterValue = this.value;
                localStorage.setItem('storeFilter', filterValue);
                table.search(filterValue).draw();
            });

            // Clear filter button
            $('#clearFilter').on('click', function() {
                $('#storeFilter').val('');
                localStorage.removeItem('storeFilter');
                table.search('').draw();
            });
        });
    </script>
</body>

</html>
