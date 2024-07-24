@isset($vehicle)
    <script>
        $(function() {
            $('#category_id').on('change', function() {
                var category_id = this.value;
                $("#brand_name").html('');
                $("#vehicle_type").html('');
                $("#model_name").html('<option value="">Select Model</option>');
                $("#model_variant_name").html('<option value="">Select Model Variant</option>');
                $.ajax({
                    url: "{{ url('get-vehicle-brand') }}",
                    type: "POST",
                    data: {
                        category_id: category_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#brand_name').html(result.options);
                        $("#vehicle_type").html(result.vehicleTypeOption);
                    }
                });
            });

            $('#brand_name').on('change', function() {
                var brand_id = this.value;
                $("#model_name").html('');
                $.ajax({
                    url: "{{ url('get-vehicle-model') }}",
                    type: "POST",
                    data: {
                        brand_id: brand_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#model_name').html(result.options);
                    }
                });
            });

            $('#model_name').on('change', function() {
                var model_id = this.value;
                $("#model_variant_name").html('');
                $.ajax({
                    url: "{{ url('get-vehicle-model-variant') }}",
                    type: "POST",
                    data: {
                        model_id: model_id,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        $('#model_variant_name').html(result.options);
                    }
                });
            });
        })
    </script>
@endisset

@isset($datePicker)
    @section('head')
        <link href="{{ asset('assets/css/plugins/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    @endsection

    @section('script')
        <script src="{{ asset('assets/js/plugins/bootstrap-datepicker.min.js') }}"></script>

        <script>
            $(function() {
                $('.datepicker').datepicker({
                    autoclose: true,
                    format: 'yyyy-mm-dd'
                });
            })
        </script>
    @endsection
@endisset
