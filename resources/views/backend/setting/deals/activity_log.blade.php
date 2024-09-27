@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title">Deals Activity Log</h4>
                        <!-- Add any additional buttons here if needed -->
                    </div>
                    <hr>

                    <table id="datatable" class="table table-bordered dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>User</th>
                                <th>Action</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($activities as $activity)
                                <tr>
                                    <td>{{ $activity->created_at->format('d M, Y --> (g:i A)') }}</td>
                                    <td>{{ $activity->causer->name ?? 'System' }}</td>
                                    <td>{{ $activity->description }}</td>
                                    <td>
                                        @if ($activity->subject)
                                            {{ class_basename($activity->subject_type) }} (ID: {{ $activity->subject_id }})
                                        @endif
                                        @if ($activity->properties->has('username'))
                                            by {{ $activity->properties['username'] }}
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $activities->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
