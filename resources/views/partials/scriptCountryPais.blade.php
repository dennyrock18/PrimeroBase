<script>
    $('#state').on('change', function (e) {
        console.log(e);

        var state_id = e.target.value;

        $.get('{{url('admin/city')}}?state_id=' + state_id,
                function (data) {
                    $('#city').empty();
                    $.each(data, function (index, cityobj) {

                        $('#city').append('<option value="' + cityobj.id + '">' + cityobj.city + '</option>');
                    });
                });
    });
</script>