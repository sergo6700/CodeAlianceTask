$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $("input:checkbox").change(function() {
        let isChecked = $("input:checkbox").is(":checked") ? 1:0;
        let id        = $("input:checkbox").attr('data-id');
        $.ajax({
            type:'POST',
            url:'/dashboard/status',
            data: {
                status : isChecked,
                id     : id
            },
        });
    });
});
