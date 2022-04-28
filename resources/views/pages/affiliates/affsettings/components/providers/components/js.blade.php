
<script>
    
    $(document).ready(function() {
        localStorage.removeItem('providers');
        //provider click
        $(document).on('click', '.getproviders', function(e) {
            if(localStorage.getItem("providers")){
                
            }else{
                localStorage.setItem("providers", 1);
                CardLoaderInstance.show('.tab-content');
                var id = $('#show_apikeypopup').data('user_id');
                let myForm = document.getElementById('providerFilter');
                let formData = new FormData(myForm);
                formData.append('user',$('#checksegment').val());
                formData.append('request_from',$('#providerFilter').closest('form').attr('name'));
                var url = "/affiliates/link-providers/" + id;
                axios.post(url, formData)
                .then(function (response) {
            
                    $('.providerTabledata').empty();
                    if(response.data.getAssignedProviders.length > 0){
                        var users = ``;
                        $.each(response.data.getAssignedProviders, function (key, val) {
                            checked = '';
                            if (val.status == 1) { checked = 'checked' }
                            users+= `
                            <tr>
                            <td>${val.name}</td>
                            <td>${val.service}</td>
                            <td>${val.rolename}</td>
                            <td>${val.assignedby}</td>
                            <td>
                                <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid" title="Change Status">
                                    <input class="form-check-input sweetalert_demo change-provider-status" type="checkbox"  ${checked}  data-id="${val.id}">
                                </div>
                            </td>
                            <td class="text-end">
                                <a class="deletemanageprovider" data-id="${val.id}" data-relation="${val.relationaluser}" data-service="${val.servive_id}" data-source="${val.source_user_id}" title="Delete">
                                    <i class="bi bi-trash fs-2 mx-1 text-primary"></i>
                                </a>
                            </td>
                            </tr>
                            `;
                        });
                    
                        
                    }else{
                        users = `<tr class="no_record"><td colspan="6" align="center">{{trans('affiliates.norecord')}}</td></tr>`;
                    }
                    $('.providerTabledata').append(users);
                    CardLoaderInstance.hide();

                })
                .catch(function (error) {
                    console.log(error);
                    CardLoaderInstance.hide();
                })
                .then(function () {
                    CardLoaderInstance.hide();
                });
            } 
        });

        $(document).on('change', '#providerservice', function(e) {
            CardLoaderInstance.show('.tab-content');
            var service = $(this).val();
            let myForm = document.getElementById('providerFilter');
            let formData = new FormData(myForm);
            formData.append('id',$('#show_apikeypopup').data('user_id'));
            formData.append('user',$('#checksegment').val());
            formData.append('type',2);
            var url = "/affiliates/get-providers";
            axios.post(url, formData)
            .then(function (response) {
               
                $('#providers').empty();
                var html = ``;
                if(response.data.result.users.length > 0){
                    html+= ``;
                    $.each(response.data.result.users, function (key, val) {
                        html+= `<option value="${val.id}">${val.name}</option>`;
                    });
                }
                $('#providers').append(html);

                $('.providerTabledata').empty();
                if(response.data.result.getAssignedProviders.length > 0){
                    var users = ``;
                    $.each(response.data.result.getAssignedProviders, function (key, val) {
                        checked = '';
                        if (val.status == 1) { checked = 'checked' }
                        users+= `
                        <tr>
                        <td>${val.name}</td>
                        <td>${val.service}</td>
                        <td>${val.rolename}</td>
                        <td>${val.assignedby}</td>
                        <td>
                            <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid" title="Change Status">
                                <input class="form-check-input sweetalert_demo change-provider-status" type="checkbox"  ${checked}  data-id="${val.id}">
                            </div>
                        </td>
                        <td class="text-end">
                            <a class="deletemanageprovider" data-id="${val.id}" data-relation="${val.relationaluser}" data-service="${val.servive_id}" data-source="${val.source_user_id}" title="Delete">
                                <i class="bi bi-trash fs-2 mx-1 text-primary"></i>
                            </a>
                        </td>
                        </tr>
                        `;
                    });
                    
                }else{
                    users = `<tr class="no_record"><td colspan="6" align="center">{{trans('affiliates.norecord')}}</td></tr>`;
                }
                $('.providerTabledata').append(users);
                
                CardLoaderInstance.hide();
            })
            .catch(function (error) {
                console.log(error);
                CardLoaderInstance.hide();
            })
            .then(function () {
                CardLoaderInstance.hide();
            });
        });

        $(document).on('submit', '.submitProviderServices', function(e) {
            e.preventDefault();
            CardLoaderInstance.show('.tab-content');
            let myForm = document.getElementById('providerFilter');
            let formData = new FormData(myForm);
            formData.append('id',$('#show_apikeypopup').data('user_id'));
            formData.append('user',$('#checksegment').val());
            formData.append('request_from',$('#providerFilter').closest('form').attr('name'));
            formData.append('type',2);
            var url = "/affiliates/assign-providers";
            axios.post(url, formData)
            .then(function (response) {
                $(".error").html("");
                if (response.data.status == 200) {
                    toastr.success(response.data.message);

                    $('.providerTabledata').empty();
                    if(response.data.result.length > 0){
                        
                        var users = ``;
                        $.each(response.data.result, function (key, val) {
                            checked = '';
                            if (val.status == 1) { checked = 'checked' }
                            users+= `
                            <tr>
                            <td>${val.name}</td>
                            <td>${val.service}</td>
                            <td>${val.rolename}</td>
                            <td>${val.assignedby}</td>
                            <td>
                                <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid" title="Change Status">
                                    <input class="form-check-input sweetalert_demo change-provider-status" type="checkbox"  ${checked}  data-id="${val.id}">
                                </div>
                            </td>
                            <td class="text-end">
                                <a class="deletemanageprovider" data-id="${val.id}" data-relation="${val.relationaluser}" data-service="${val.servive_id}" data-source="${val.source_user_id}" title="Delete">
                                    <i class="bi bi-trash fs-2 mx-1 text-primary"></i>
                                </a>
                            </td>
                            </tr>
                            `;
                        });
                        
                        
                    }else{
                        users = `<tr class="no_record"><td colspan="6" align="center">{{trans('affiliates.norecord')}}</td></tr>`;
                    }

                    $('.providerTabledata').append(users);

                    $('#providers').empty();
                    var html = ``;
                    if(response.data.users.length > 0){
                        html+= ``;
                        $.each(response.data.users, function (key, val) {
                            html+= `<option value="${val.id}">${val.name}</option>`;
                        });
                    }
                    $('#providers').append(html);
                    $('#providers').select2({
                        placeholder: "Select Providers",
                        allowClear: true 
                    });


                }else{
                    toastr.error(response.data.message);
                } 
                CardLoaderInstance.hide();

            })
            .catch(function (error) {
                CardLoaderInstance.hide();
                $(".error").html("");
                if(error.response.status == 422) {
                    errors = error.response.data.errors;
                    $.each(errors, function(key, value) {
                        $('.'+key).find('span.error').empty().addClass('text-danger').text(value).finish().fadeIn();
                    });
                }
                else if(error.response.status == 400) {
                    console.log(error.response);
                }
            })
            .then(function () {
                CardLoaderInstance.hide();
            });
        });

        $('.selectmultipleuers').select2({
            placeholder: 'Select Providers',
        });

        $(document).on('click', '.deletemanageprovider', function(e) {
            e.preventDefault();
            var check = $(this);
            var id = check.attr("data-id");
            var service = check.attr("data-service");
            var relation = check.attr("data-relation");
            var source = check.attr("data-source");
            var url = '/affiliates/deleteprovider';
            
            let myForm = document.getElementById('providerFilter');
            var formdata = new FormData();
            formdata.append("did", id);
            formdata.append("service", service);
            formdata.append("relation", relation);
            formdata.append("source", source);
            formdata.append('id',$('#show_apikeypopup').data('user_id'));
            formdata.append('user',$('#checksegment').val());
            formdata.append('type',2);
            formdata.append('providerservice',$('#providerservice').val());
            Swal.fire({
                title: "{{trans('affiliates.warning_msg_title')}}",
                text: "{{trans('affiliates.delete_msg_text')}}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "{{trans('affiliates.yes_text')}}",
            }).then(function(result) {
                if (result.isConfirmed) {
                    CardLoaderInstance.show('.tab-content');
                    axios.post(url,formdata )
                    .then(function (response) {
                        if(response.data.status == 400){
                            toastr.error(response.data.message);
                        }else{
                            check.closest('tr').remove();
                            toastr.success(response.data.message);
                            $('#providers').empty();
                            var html = ``;
                            if(response.data.users.length > 0){
                                html+= ``;
                                $.each(response.data.users, function (key, val) {
                                    html+= `<option value="${val.id}">${val.name}</option>`;
                                });
                            }
                            $('#providers').append(html);
                            $('#providers').select2({
                                placeholder: "Select Providers",
                                allowClear: true 
                            });
                        }
                        CardLoaderInstance.hide();
                    })
                    .catch(function (error) {
                        console.log(error);
                        CardLoaderInstance.hide();
                    })
                    .then(function () {
                        CardLoaderInstance.hide();
                    });
                }
            });

        });

        //This code is done for add Select All Button on Multiselect
        $(".selectmultipleuers").on('change', function () {
            //Check Select All Selected 
            if ($(this).children("option[value=select_all]:selected").length > 0) {
                $(this).children('option').prop('selected', true);
                $(this).children('option[value=select_all]').prop('selected', false);
                $(this).children("option[value=select_all]").hide();
                $('#providers').select2({ });
            }
            else {
                //if not select all selected option selected
                var total_option = $(this).children('option').length;
                var selected_option = $(this).children('option:selected').length;
                if (total_option === (selected_option + 1)) {
                    $(this).children("option[value=select_all]").hide();

                } else {

                    $(this).children("option[value=select_all]").show();
                    $('#providers').select2({
                        placeholder: "Select Providers",
                    });
                }
            }
        });

        //Change Status
        $(document).on('click', '.change-provider-status', function(e) {
            var check = $(this);
            var id = check.attr("data-id");
            var isChecked = check.is(':checked');
            if (check.is(':checked'))
                var status = 1;
            else
                var status = 0;

            var url = '/affiliates/change-provider-status';   
            var formdata = new FormData();
            formdata.append("id", id);
            formdata.append("status", status);
            Swal.fire({
                title: "{{trans('affiliates.warning_msg_title')}}",
                text: "{{trans('affiliates.warning_msg_text')}}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "{{trans('affiliates.yes_text')}}",
            }).then(function(result) {
                if (result.isConfirmed) {
                    axios.post(url,formdata )
                    .then(function (response) {
                        
                        if(response.data.status == 400){
                            toastr.error(response.data.message);
                            if (isChecked) {
                                check.prop('checked', false);
                            } else {
                                check.prop('checked', true);
                            }
                        }else{
                            toastr.success(response.data.message);
                        }
                        
                    })
                    .catch(function (error) {
                        console.log(error);
                        if (isChecked) {
                            check.prop('checked', false);
                        } else {
                            check.prop('checked', true);
                        }
                    })
                    .then(function () {
                    
                    });
                }else {
                    if (isChecked) {
                        check.prop('checked', false);
                    } else {
                        check.prop('checked', true);
                    }
                }
            });


        });
        

    });
   
</script>