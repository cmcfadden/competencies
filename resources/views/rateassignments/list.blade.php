@extends('base')


@section('content')
<p><a href="{{ action('RateAssignmentController@create') }}" class="btn btn-primary">Create an Assignment</a></p>
<table id="assignment" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Assignment Title</th>
                <th>Link</th>
                <th>Creation Date</th>
                <th>Edit</th>
                
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Assignment Title</th>
                <th>Link</th>
                <th>Creation Date</th>
                <th>Edit</th>
            </tr>
        </tfoot>
    </table>

@endsection

@section('footer')


<script>

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("#assignment").DataTable({
        "ajax": {
            "url": '/rateassignment/',
            "dataSrc": ''
        },
        "columns": [
            { "data": "assignment_title" },
            {
                "data": "id",
                "render": function (data, type, row, meta) {
                    return '<a href="{{action('RateController@create')}}/' + row.id + '">{{action('RateController@create')}}/' + row.id + '</a>';
                }
            },
            { "data": "created_at"},
            {   
                "data": "id",
                "render": function (data, type, row, meta) {
                    return '<a href="/rateassignment/' + row.id + '/edit/">Edit</a>';
                }
            }
        ]
    });

});

</script>

@endsection