@extends('templates.layout')

@section('content')
    <div class="container">
        <h1>Kelola Deadline User</h1>
        <div class="card mb-3">
            <div class="card-header">Atur Deadline Global</div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.users.setGlobalDeadline') }}">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <input type="date" name="deadline" class="form-control" required>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Atur Deadline</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
