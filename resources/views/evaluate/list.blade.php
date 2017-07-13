@extends('base')


@section('content')

<table id="evaluation" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Competency</th>
                <th>Level</th>
                <th>Completion Date</th>
                <th>View</th>
                
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Competency</th>
                <th>Level</th>
                <th>Completion Date</th>
                <th>View</th>
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
    $("#evaluation").DataTable({
        "ajax": {
            "url": '/evaluate',
            "dataSrc": ''
        },
        "columns": [
            { "data": "competency.competency"},
            { "data": "level" },
            { "data": "updated_at"},
            {   
                "data": "id",
                "render": function (data, type, row, meta) {
                    return '<a href="evaluate/' + row.id + '/edit">View Response</a>';
                }
            }
        ]
    });

});

</script>

@endsection