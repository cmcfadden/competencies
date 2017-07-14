@extends('base')


@section('content')

<table id="reflect" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Experience</th>
                <th>Competencies</th>
                <th>View</th>
                
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>Experience</th>
                <th>Competencies</th>
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
    $("#reflect").DataTable({
        "ajax": {
            "url": '/reflect/',
            "dataSrc": ''
        },
        "columns": [
            { "data": "experience" },
            { "render": 
                function (data, type, row, meta) {
                    var compOutput = [];
                    row.competencies.forEach(function(item) {
                        compOutput.push(item.competency);
                    });
                    return compOutput.join(",");
                }
            },
            {   
                "data": "id",
                "render": function (data, type, row, meta) {
                    return '<a href="/reflect/' + row.id + '/edit/">View Response</a>';
                }
            }
        ]
    });

});

</script>

@endsection