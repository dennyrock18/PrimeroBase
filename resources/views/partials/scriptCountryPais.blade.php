<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css" rel="stylesheet" />
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $('select').select2({
            allowClear: true,
            placeholder: {
                id: "",
                text: 'Select value'
            }
        });
        $(document).on('change', '#state', function (e) {
            console.log(e);

            var state_id = e.target.value;

            $('#city_id').empty().change();

            $.get('{{url('admin/city')}}?state_id=' + state_id,
            function (data) {
                $('#city_id').empty().change();
                $.each(data, function (index, cityobj) {

                    $('#city_id').append('<option value="' + cityobj.id + '">' + cityobj.city + '</option>');
                });
            });
        });
    });

</script>
