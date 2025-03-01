@extends ('admin.layouts.app')

@section('content')
<div class="page-breadcrumb">
    <div class="row">

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Table Header</h4>
                    <h6 class="card-subtitle">Similar to tables, use the modifier classes .thead-light to make
                        <code>&lt;thead&gt;</code>s appear light.
                    </h6>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Title</th>
                                <th scope="col">Image</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $value)
                                <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{{$value->title}}</td>
                                    <td>{{$value->image}}</td>
                                    <td>{{$value->description}}</td>
                                    <td><a href="{{ url('/blog/edit/' . $value->id) }}">Edit</a> &emsp;
                                        <a href="{{ url('/blog/delete/' . $value->id) }}">Delete</a>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <a href="{{url('/blog/add')}}" name="add-country" class="btn btn-success" style="color: #fff">Add blog</a>
        </div>
    </div>
</div>
@endsection