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
                                <th scope="col">Country's name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $value)
                                <tr>
                                    <th scope="row">{{$value->id_country}}</th>
                                    <td>{{$value->name_country}}</td>
                                    <td><a href="{{ url('/country/edit/' . $value->id_country) }}">Edit</a> &emsp;
                                        <a href="{{ url('/country/delete/' . $value->id_country) }}">Delete</a>
                                    </td>

                                </tr>

                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <a href= "{{url('/country/add')}}"name="add-country" class="btn btn-success" style="color: #fff">Add country</a>
        </div>
    </div>
</div>
@endsection