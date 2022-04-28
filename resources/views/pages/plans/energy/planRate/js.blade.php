<script src="/common/plugins/custom/datatables/datatables.bundle.js"></script>

<script>
    var plan_id = "{{ isset($planId) ? $planId : '' }}";

    var rate_id = "{{ isset($editRate->id) ? $editRate->id : '' }}";
    var distributor_id = "{{ isset($editRate->distributor_id) ? $editRate->distributor_id : '' }}";
    const dataTable = $("#solar_data_table").DataTable({
        responsive: true,
        searching: true,
        "sDom": "tipr"
    });
    //  $("#rate_limit_table").DataTable({
    //     responsive: true,
    //     searching: true,
    //     "sDom": "tipr"
    // });

    $('#search_data').keyup(function() {

        dataTable.search($(this).val()).draw();
    })
    $('#add_plan_close, #cancel').click(function() {
        $("#add_plan_modal").modal('hide');
    });


    $(document).on('change', '.dmo_parameters', function() {
        let selected = $(this).val();
        CKEDITOR.instances.dmo_content.insertText(selected);
    });

    $(document).on('change', '.tele_dmo_parameter', function() {
        let selected = $(this).val();
        CKEDITOR.instances.tele_dmo_content.insertText(selected);
    });
    
    $(document).on('change', '.without_conditional', function() {
        var selected = $("input[name='without_conditional']:checked").val();
        if (selected == '3') {
            $("input[name='without_conditional_value']").val('');
            $("input[name='without_conditional_value']").prop("readonly", true);
        } else {
            $("input[name='without_conditional_value']").prop("readonly", false);
        }
    });

    $(document).on('change', '.with_conditional', function() {
        var selected = $("input[name='with_conditional']:checked").val();
        if (selected == '3') {
            $("input[name='with_conditional_value']").val('');
            $("input[name='with_conditional_value']").prop("readonly", true);
        } else {
            $("input[name='with_conditional_value']").prop("readonly", false);
        }
    });

    $("#solar_rate_btn").click(function() {
        var formData = new FormData($("#add_edit_solar")[0]);
        action = $('#add_edit_solar').attr('action');
        formData.append('solar_desc', editorsArr.solar_desc.getData());
        formData.append('plan_id', plan_id);
        form_submit(action, formData);
    });


    $("#submit_rate_info").click(function() {
        var formData = new FormData($("#edit_plan_info")[0]);
        action = $('#edit_plan_info').attr('action');
        form_submit(action, formData);
    });



    $(".submit_dmo_btn").click(function() {
        var formData = new FormData($("#dmo_form")[0]);
        formData.append('dmo_content', CKEDITOR.instances.dmo_content.getData());
        formData.append('rate_id', rate_id);
        action = $('#edit_plan_info').attr('action');
        form_submit(action, formData);
    });

    $(".submit_tele_btn").click(function() {
        var formData = new FormData($("#tele_form")[0]);
        formData.append('tele_dmo_content', CKEDITOR.instances.tele_dmo_content.getData());
        formData.append('rate_id', rate_id);
        action = $('#edit_plan_info').attr('action');
        form_submit(action, formData);
    });

    $("#dmo_static_btn").click(function() {
        var formData = new FormData($("#dmo_static_form")[0]);
        action = $('#dmo_static_form').attr('action');
        formData.append('rate_id', rate_id);
        form_submit(action, formData);
    });


    $("#copy_dmo_btn").click(function() {
        var formData = new FormData();
        formData.append('dmo_content', editorsArr.dmo_content.getData());
        formData.append('rate_id', rate_id);
        formData.append('distributor_id', distributor_id);
        formData.append('plan_id', "{{isset($editRate->plan_id)?$editRate->plan_id:'' }}");
        action = "{{ route('energyplans.copy-dmo-content') }}";

        formData.append('rate_id', rate_id);
        form_submit(action, formData);
    });

    $("#copy_telesale_btn").click(function() {
        var formData = new FormData();
        formData.append('tele_dmo_content', editorsArr.tele_dmo_content.getData());
        formData.append('rate_id', rate_id);
        formData.append('distributor_id', distributor_id);
        formData.append('plan_id', "{{isset($editRate->plan_id)?$editRate->plan_id:'' }}");
        action = "{{ route('energyplans.copy-dmo-content') }}";
        formData.append('rate_id', rate_id);
        form_submit(action, formData);
    });
    $("#plan_limt_btn").on("click", function() {
        var formData = new FormData($("#add_plan_rate_limt")[0]);
        formData.append('rate_id', rate_id);
        action = $('#add_plan_rate_limt').attr('action');
        form_submit(action, formData);
        $('#get_limt_list').trigger('click');
    });




    //submit data function
    function form_submit(action, formData) {
        $('form').find('input').css('border-color', '');
        $(".form_error").text("");
        let submitButton = document.querySelector('.submit_button');
        submitButton.setAttribute('data-kt-indicator', 'on');
        submitButton.disabled = true;
        axios.post(action, formData)
            .then(function(response) {
                if (response.data.status == 1) {
                   
                    $("#add_plan_rate_modal").modal('hide');

                    toastr.success(response.data.message);
                    
                    if(response.data.action == "dmo_content"){
                        $('.dmo_pid').val(response.data.id);
                    }

                    if(response.data.action == "telesale_content"){
                        $('.tele_pid').val(response.data.id);
                    }

                    if(response.data.action == "dmo_static_content"){
                        $('.static_pid').val(response.data.id);
                    }

                    if(response.data.reload_page != undefined){
                        location.reload();
                    }else{
                        $('#add_plan_rate_limt')[0].reset();
                    }
                } else {
                    toastr.error(response.data.message);
                }


            })
            .catch(function(error) {
                console.log(error);
                if (error.response.status == 422) {
                    errors = error.response.data.errors;

                    $.each(errors, function(key, value) {
                        $('textarea[name=' + key + ']').parent('.field-holder').find('span.form_error')
                            .slideDown(400).html(value);
                        $('textarea[name=' + key + ']').css('border-color', 'red');
                        $('input[name=' + key + ']').parent('.field-holder').find('span.form_error')
                            .slideDown(400).html(value);
                        $('input[name=' + key + ']').css('border-color', 'red');
                        $('select[name=' + key + ']').parent('.field-holder').find('span.form_error')
                            .slideDown(400).html(value);
                        $('select[name=' + key + ']').css('border-color', 'red');

                    });

                } else {
                    toastr.error(error.response.data.message);
                }
            })
            .then(function() {
                submitButton.setAttribute('data-kt-indicator', 'off');
                submitButton.disabled = false;
                // always executed
            });

    }

    $(".change_status,.change_show_frontend").click(function(e) {
        let check = $(this).data("status");
        let change_show_frontend = $(this).data("show_frontend");
        Swal.fire({
            title: "{{ trans('plans.warning_msg_title') }}",
            text: "{{ trans('plans.warning_msg_text') }}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "{{ trans('plans.yes_text') }}",
            cancelButtonClass: "cancel_aff",
        }).then((result) => {
            if (result.value) {
                var status = $(this).data("status");
                if (status == 0 || status == '') {
                    status = 1;
                } else {
                    status = 0;
                }
                if (change_show_frontend == 0) {
                    change_show_frontend = 1;
                } else if (change_show_frontend == 1) {
                    change_show_frontend = 0;
                }

                formData = {
                    'status': status,
                    'id': $(this).data("id"),
                    'plan_id': plan_id,
                    'change_show_frontend': change_show_frontend
                }
                form_submit("{{ route('solar.status') }}", formData)
            }
        });
        $(".cancel_aff").click(function() {
            $(thisVal).prop('checked', check);

        });
    });
    $(".edit_solar_rate").click(function(e) {
        let id = $(this).data("id");
        let name = $(this).data("name");
        let desc = $(this).data("desc");
        let charge = $(this).data("charge");
        editorsArr.solar_desc.setData(desc);
        $("input[name=solar_rate]").val(name);
        $("input[name=id]").val(id);
        $("input[name=charge]").val(charge);
    });
    $(document).on('click', '#get_limt_list', function() {
        action = "{{route('energyplans.getrate.limit')}}"
        axios.post(action, {'rate_id':rate_id})
            .then(function(response) {
                $('#rate_limit_tables').DataTable().destroy();
                $(".rate_limit_list").html(response.data);


                const table= $("#rate_limit_tables").DataTable({
                    responsive: true,
                    searching: true,
                    "sDom": "tipr"
                });
                $('#search_data').keyup(function() {

                    table.search($(this).val()).draw();
                })
                KTMenu.createInstances();
            })
            .catch(function(error) {
                if (error.response.status == 422) {
                    errors = error.response.data.errors;
                } else {
                    toastr.error(error.response.data.message);
                }
            })
    });
    $(document).on('click', '.edit_limit', function() {
        $(".hide_limit").hide();
        $(".limit_level").show();
        $(".limit_type").show();
        $('#add_plan_rate_limt')[0].reset();
        $('form').find('input').css('border-color', '');
        $('form').find('textarea').css('border-color', '');
        $(".form_error").text("");
        var type= $(this).data("type");
        var level= $(this).data("level");
        $('#limit_level').html('');
        $("input[name=limit_daily]").val($(this).data("daily"));
        $("input[name=limit_charges]").val($(this).data("charges"));
        $("input[name=limit_year]").val($(this).data("year"));
        $("input[name=id]").val($(this).data("id"));
        $("textarea[name=limit_desc]").val($(this).data("desc"));

        $('#limit_type option[value="'+type+'"]').attr("selected", true);
        $('#limit_level option[value="'+level+'"]').attr("selected", true);
        $('#limit_type').attr("disabled", true);
        $('#limit_level').attr("disabled", true);
        $(".limit_type").html(type);
        $(".limit_level").html(level);
    });
    $(document).on('click', '.add_rate_limit', function() {
        $(".hide_limit").show();
        $(".limit_level").hide();
        $(".limit_type").hide();
    });


    $(document).on('change', '#limit_type', function() {

        var limit_type= $("#limit_type").val();
        $('#limit_level').html('');
        action = "{{route('energyplans.limit')}}"
        axios.post(action, {'rate_id':rate_id,'limit_type':limit_type})
            .then(function(response) {
                $.each(response.data.Limit_type_dropdown,function(i,val){
                            if(val==1)
                                numeric_text = 'First';
                            if(val==2)
                                numeric_text = 'Second';
                            if(val==3)
                                numeric_text = 'Third';
                            if(val==4)
                                numeric_text = 'Fourth';
                            if(val==5)
                                numeric_text = 'Fifth';
                            if(val==6)
                                numeric_text = 'Sixth';
                            if(val==7)
                                numeric_text = 'Seven';
                            if(val==8)
                                numeric_text = 'Eight';
                            if(val==9)
                                numeric_text = 'Nine';
                            if(val==32768)
                                numeric_text = 'Remaining';
                            $('#limit_level').append('<option value='+val+'>'+numeric_text+'</option>');
                        });
            })
            .catch(function(error) {
                if (error.response.status == 422) {
                    errors = error.response.data.errors;
                } else {
                    toastr.error(error.response.data.message);
                }
            })

    });

    localStorage.removeItem('dmo');
    $(document).on('click', '.dmo_vdo,.tele_dmo_vdo,.dmo_static', function() {
        if(localStorage.getItem("dmo")){

        }else{
            localStorage.setItem("dmo", 1);

            var formdata = new FormData();
            formdata.append("plan_rate_id", rate_id);
            formdata.append("type", 1);
            action = "{{route('energyplans.dmoplan')}}"
            axios.post(action,formdata )
            .then(function (response) {
                if(response.data.result.length > 0){
                    var dmocontent  = ''; 
                    var dmostatus = '';
                    var dmoid = '';
                    var telecontent  = '';
                    var telestatus = '';
                    var teleid = '';
                    var staticstatus = '';
                    var lowest_annual_cost = '';
                    var without_conditional_value = '';
                    var with_conditional_value = '';
                    var without_conditional = '';
                    var with_conditional = '';
                    var static_pid = '';
                    var consider_master = '';
                    $.each(response.data.result, function (key, val) {
                        if(val.variant == 1){
                            dmocontent= val.dmo_vdo_content;
                                checked = false;
                            if(val.dmo_content_status == 1){
                                checked = true;
                            }else{
                                $('.considermaster').show();
                            }
                            dmostatus= checked;
                            dmoid= val.id;

                            mastercheck = false;
                            if(val.consider_master_content == 1){
                                mastercheck = true;
                            }
                            consider_master = mastercheck;
                        }

                        if(val.variant == 2){
                            telecontent= val.dmo_vdo_content;
                            checked = false;
                            if(val.dmo_content_status == 1){
                                checked = true;
                            }
                            telestatus= checked;
                            teleid= val.id;
                        }

                        if(val.variant == 3){
                            checked = false;
                            if(val.dmo_content_status == 1){
                                checked = true;
                            }
                            staticstatus= checked;
                            lowest_annual_cost = val.lowest_annual_cost;
                            without_conditional_value = val.without_conditional_value;
                            with_conditional_value = val.with_conditional_value;
                            without_conditional = val.without_conditional;
                            with_conditional = val.with_conditional;
                            static_pid = val.id;
                        }

                    });
                 
                    $('.dmo_checked_status').prop('checked',dmostatus);
                    $('#consider_master_content').prop('checked',consider_master);
                    CKEDITOR.instances.dmo_content.setData(dmocontent);
                    $('.dmo_pid').val(dmoid);

                    $('.tele_checked_status').prop('checked',telestatus);
                    CKEDITOR.instances.tele_dmo_content.setData(telecontent);
                    $('.tele_pid').val(teleid);

                    $('.static_checked_status').prop('checked',staticstatus);
                    $('.lowest_annual_cost').val(lowest_annual_cost);
                    $('.without_conditional_value').val(without_conditional_value);
                    $('.with_conditional_value').val(with_conditional_value);
                    $('.static_pid').val(static_pid);
                   
                    if(without_conditional == 1){
                        $('.without_conditionalfirst').prop('checked',with_conditional);
                    }
                    if(without_conditional == 2){
                        $('.without_conditionalsecond').prop('checked',with_conditional);
                    }
                    if(without_conditional == 3){
                        $('.without_conditionalthird').prop('checked',with_conditional);
                    }


                    if(with_conditional == 1){
                        $('.with_conditionalfirst').prop('checked',with_conditional);
                    }
                    if(with_conditional == 2){
                        $('.with_conditionalsecond').prop('checked',with_conditional);
                    }
                    if(with_conditional == 3){
                        $('.with_conditionalthird').prop('checked',with_conditional);
                    }

                }	
                
                
            })
            .catch(function (error) {
                
            })
            .then(function () {
            
            });


        }


        
    });
    
    $('.considermaster').hide();
    $(document).on('click', '#dmo_content_status', function() {
        if($(this).is(":checked")){
            $('#consider_master_content').prop('checked',false);
            $('.considermaster').hide();
        }else{
            $('.considermaster').show();
        }
    });
    

</script>
