$(document).ready(function () {
    $('#areas').off('change').change(function () {
        var id = $(this).val();
        $.ajax({
            'url': 'main/get-list-citys-ajax',
            'dataType': 'json',
            'method': 'post',
            'data': {id: id},
            success: function (result) {
                $('#citys').html('');
                $.map(result, function (val, i) {
                    $('#citys').append('<option id="' + val.id + '">' + val.title + '</option>');

                });
            },
            error: function () {

            }
        })
    });
});