@extends('base')


@section('content')

<table id="translate" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Experience</th>
                <th>Competency</th>
                <th>View</th>
                
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Experience</th>
                <th>Competency</th>
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
    $("#translate").DataTable({
        "ajax": {
            "url": '/translate/',
            "dataSrc": ''
        },
        "columns": [
            { "data": "experience" },
            { "data": "primary_competency.competency" },
            {   
                "data": "id",
                "render": function (data, type, row, meta) {
                    return '<a href="/translate/' + row.id + '/edit/' + row.translateComponentId  +'" >View Response</a>';
                }
            }
        ]
    });

});

</script>

@endsection