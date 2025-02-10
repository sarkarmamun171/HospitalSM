@extends('admin.master')
@section('title')
  Doctor List
@endsection
@section('content')
<div class="container-fluid px-4">
    <br>
    @if (session('success'))
        <div class="alert alert-success">
            <button data-dismiss="alert" type="button" class="close">&times;</button>
            {{ session('success') }}
        </div>
    @endif
    <div class="card shadow-lg">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-table me-2"></i>Manage Doctor</h5>
            <a href="{{ route('add-doctor') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Add Doctor
            </a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Doctor Name</th>
                        <th>Phone</th>
                        <th>Speciality</th>
                        <th>Room No</th>
                        <th>Fees</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($doctors as $doctor)
                        <tr>
                            <td>{{ $doctor->name }}</td>
                            <td>{{ $doctor->phone }}</td>
                            <td>{{ $doctor->speciality }}</td>
                            <td>{{ $doctor->room }}</td>
                            <td>{{ $doctor->fee }}/=</td>
                            <td>
                                <img src="{{ asset($doctor->image) }}" alt="Doctor Image" class="img-thumbnail rounded" width="50">
                            </td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('add-doctor.edit', $doctor->id) }}" class="btn btn-sm btn-warning me-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('add-doctor.delete', $doctor->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this doctor?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
