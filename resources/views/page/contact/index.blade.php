@extends('admin.app')

@section('contact')
    <div class="container mt-1">
        <div class="row">
            <div class="col-md-12 mt-4">
                <div class="bg-light rounded h-100 p-4">
                    <h6 class="mb-4">Contact Table</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Created_at</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contacts as $contact)
                                <tr>
                                    <th>{{ $loop->index+1 }}</th>
                                    <th scope="row">{{ $contact->name }}</th>
                                    <td>{{ $contact->email }}</td>
                                    <td>{{ $contact->subject }}</td>
                                    <td>{{ $contact->message }}</td>
                                    <td>{{ $contact->created_at->format('d-M-Y') }}</td>
                                    <td>
                                        <div class="d-flex">
                                            {{-- <button class="btn btn-primary editCategoryBtn">Edit</button> --}}
                                            <a href="{{ route('member#contact_delete',$contact->id) }}" class="btn btn-danger mx-1 ">Delete</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class=" float-end">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            activeSidebar('.contact_view');
        });
    </script>
@endpush
