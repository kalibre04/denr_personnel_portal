<script src="{{ URL::asset('/public/assets/libs/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap tether Core JavaScript -->
<!-- <script src="{{ URL::asset('assets/libs/popper.js/dist/umd/popper.min.js') }}"></script> -->
<!-- <script src="{{ URL::asset('assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script> -->
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ URL::asset('/public/assets/extra-libs/sparkline/sparkline.js') }}"></script>
<!--Wave Effects -->
<script src="{{ URL::asset('/public/dist/js/waves.js') }}"></script>
<!--Menu sidebar -->
<script src="{{ URL::asset('/public/dist/js/sidebarmenu.js') }}"></script>
<!--Custom JavaScript -->
<script src="{{ URL::asset('/public/dist/js/custom.min.js') }}"></script>
<!--This page JavaScript -->
<!--chartis chart-->
<!-- <script src="{{ URL::asset('assets/libs/chartist/dist/chartist.min.js') }}"></script> -->
<!-- <script src="{{ URL::asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js') }}"></script> -->
<script src="{{ URL::asset('/public/dist/js/pages/dashboards/dashboard1.js') }}"></script>
<script src="{{asset('/public/js/app.js')}}" ></script>

<!-- Script sa parts.main -->
<script src="{{ URL::asset('/public/js/emfedit.js') }}"></script>
<script src="{{ URL::asset('/public/dist/js/custom.min.js') }}"></script>
<script>
    $(document).ready(function(){
        // $('#grandChild').hide();
        $('#sub_activity_amount').hide();
        $('#sub_sub_activity_amount').hide();
        $('.dynamic').change(function(){
            if($(this).val() != '')
            {
                var select = $(this).attr("id");
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ route('dynamic.budget') }}",
                    method:"POST",
                    data:{select:select, value:value, _token:_token, dependent:dependent},
                    success:function(result)
                    {
                        $('#'+dependent).html(result);
                    }

                });
            }
        });

        $('.dynamic2').change(function(){
            if($(this).val() != '')
            {
                var select = $(this).attr("id");
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ route('dynamic.budgetother') }}",
                    method:"POST",
                    data:{select:select, value:value, _token:_token, dependent:dependent},
                    success:function(result)
                    {
                        $('#'+dependent).html(result);
                    }

                });
            }
        });

        $('.dynamic3').change(function(){
            if($(this).val() != '')
            {
                let select = $(this).attr("id");
                let value = $(this).val();
                let dependent = $(this).data('dependent');
                let _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('dynamic.budgetchecker') }}",
                    method: "POST",
                    data: {select:select, value:value, _token:_token, dependent:dependent},
                    success:function(result)
                    {
                        if(result === 'No grand child data'){
                            $('#grandChild').hide();
                        }else if(result === 'wala'){
                            $('#grandChild').hide();
                        }else{
                            $('#grandChild').show();
                            $('#'+dependent).html(result).show();
                        }
                    }
                });
            }
        });

        $('.heads').change(function(){
            if($(this).val() != '')
            {
                var select = $(this).attr("id");
                var value = $(this).val();
                var dependent = $(this).data('dependent');
                var _token = $('input[name="_token"]').val();
                var val = value.split("||")[1];
                $.ajax({
                    url:"{{ route('budgetheads') }}",
                    method:"POST",
                    data:{select:select, val:val, _token:_token, dependent:dependent},
                    success:function(result)
                    {
                        $('#'+dependent).html(result);
                    }

                });
            }
        });
    });
</script>
