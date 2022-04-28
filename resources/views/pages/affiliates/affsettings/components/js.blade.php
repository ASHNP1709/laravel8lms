<script src="/common/plugins/custom/flatpickr/flatpickr.bundle.js"></script>
@include('pages.affiliates.affsettings.components.target.components.js')
@include('pages.affiliates.affsettings.components.users.components.js')
@include('pages.affiliates.affsettings.components.providers.components.js')
@include('pages.affiliates.affsettings.components.distributors.components.js')
@include('pages.affiliates.affsettings.components.ipwhitelist.components.js')

<script>
    var abc = "{{ ($records) ? decryptGdprData($records['phone']) : "
    " }}";

    jQuery(document).ready(function() {
        var pageNumber = 2;
        $(document).on('click', '#affdetails', function(e) {
            phoneCall();
        });

        function phoneCall() {
            (function() {
                window.open(`tel:${abc}`);
            })()
        }

        //show popup on eye click
        $(document).on('click', '.toggleKey', function(e) {
            if ($(this).hasClass('fa-eye-slash')) {
                $(this).removeClass('fa-eye-slash');
                $(this).addClass('fa-eye');
                $("#apikeyshow").modal('show');
                $("#api-key-input").text($(this).data('id'));
                $(".copyapikey").attr('onClick', copyToClipboard("#api-key-input"));
                $(".copyapikey").text('copy');
            } else {
                $(this).removeClass('fa-eye');
                $(this).addClass('fa-eye-slash');
                $(this).next('.span_apikey').hide();
                $("#apikeyshow").modal('show');
            }
        });
        jQuery('#apikeyshow').modal({
            backdrop: 'static',
            keyboard: false // to prevent closing with Esc button (if you want this too)
        });


    });
    
    //show values on Update
    var tagsArr = '';
    $(document).on('click', '.api_popup', function(e) {
        $('.popheading').text('Update');
        var myModal = new bootstrap.Modal(document.getElementById("apicreatemodal"), {});
        myModal.show();
        var id = $(this).data('id');
        $('#api_key_id').val(id);
        $('span.form_error').hide();
        $('#add_update_apikeyform').find('input').css('border-color', '');
        $("#editApiKeyModel").modal('show');
        $('input[name=name]').val($(this).data('name'));
        $('input[name=page_url]').val($(this).data('page'));
        $('input[name=origin_url]').val($(this).data('origin'));

    });

    $(document).on('click', '.hideapkipopup', function(e) {
        //remove class if poup closed
        $(".toggleKey").removeClass('fa-eye');
        $(".toggleKey").addClass('fa-eye-slash');
    });

    //add-update API Key
    $(document).on('click', '#submit_apikeydata', function(e) {
        e.preventDefault();
        $('#add_update_apikeyform').find('input').css('border-color', '');
        var formData = new FormData($("#add_update_apikeyform")[0]);
        formData.append('user_id', $('#show_apikeypopup').data('user_id'));
        formData.append('id', $("#api_key_id").val());
        if($("#aff_statusfeild").val()) {
            var affStatus = $("#aff_statusfeild").val();
        }
        else {
            var affStatus = 1;
        }
        formData.append('status', affStatus);
        CardLoaderInstance.show('.modal-content');

        axios.post("{{ route('apikey.store')}}", formData)
            .then(function(response) {
                $("#apicreatemodal").modal('hide');
                if (response.data.status == true) {
                    toastr.success(response.data.message);
                } else {
                    toastr.error(response.data.message);
                }
                setTimeout(function() {
                    location.reload();
                }, 1000); //add delay
                CardLoaderInstance.hide();


            })
            .catch(function(error) {
                if (error.response.status == 422) {
                    errors = error.response.data.errors;
                    $("span.form_error").hide();
                    $('#add_update_apikeyform').find('input').css('border-color', '');
                    $.each(errors, function(key, value) {
                        $('input[name=' + key + ']').next("span.form_error_" + key).html(value).show();;
                        $('input[name=' + key + ']').css('border-color', 'red');
                    });
                    CardLoaderInstance.hide();

                }
            })
            .then(function() {
                //CardLoaderInstance.hide();

            });
    });
    $(document).on('click', '#show_apikeypopup', function(e) {
        $('span.form_error').text("").hide();
        $('input').css('border-color', '');
        $('.form-control').val('');
    });
    //change status api-key
    $(document).on('click', '.changeAffStatus', function(e) {
        let check = $(this).data("check");
        let thisVal = $(this);
        Swal.fire({
            title: "{{trans('affiliates.warning_msg_title')}}",
            text: "{{trans('affiliates.warning_msg_text')}}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "{{trans('affiliates.yes_text')}}",
            cancelButtonClass: "cancel_aff",
        }).then((result) => {
            if (result.value) {
                var status = $(this).data("status");
                var user_id = $('#show_apikeypopup').data('user_id');
                axios.post("{{ route('apikey.changestatus')}}", {
                        'status': status,
                        'user_id': user_id,
                        'id': $(this).data("id")
                    })
                    .then(function(response) {
                        $("#apicreatemodal").modal('hide');
                        if (response.data.status == true) {
                            toastr.success(response.data.message);
                        } else {
                            toastr.error(response.data.message);
                        }
                        setTimeout(function() {
                            location.reload();
                        }, 1000); //add delay
                    })
                    .catch(function(error) {})
                    .then(function() {

                    });
            }
        });
        $(".cancel_aff").click(function() {
            $(thisVal).prop('checked', check);
        });
    });
    KTMenu.createInstances();
    //datatablse
    const dataTable = $("#affiliatekeys_table").DataTable({
        searching: true,
        "sDom": "tipr",
        "pageLength": 20

    });

    if (($("#affiliatekeys_table >tbody >tr >td").hasClass("dataTables_empty"))) {
        $('.pagination').hide();
        $('#affiliatekeys_table_info').hide();
        $('#affiliatekeys_table_paginate').hide();

    } else {
        $('.pagination').hide();
        $('#affiliatekeys_table_info').hide();
        $('#affiliatekeys_table_paginate').hide();

    }
    $("#affiliatekeys_table_info").addClass('pagination');

    //breadcrumbs code
    var aff_head = '{{$headArr["title"]}}';
    var titleVal = '{{$headArr["settingTitle"]}}';
    var link = '{{$headArr["redirect_link"]}}';
    $('#search_affiliate').keyup(function() {
        dataTable.search($(this).val()).draw();
    });
    var info = '{{request()->segment(2)}}';

    const breadArray = [{
        title: 'Dashboard',
        link: '/',
        active: false
    }, ];

    if (info == 'sub-affiliates') {
        breadArray.push({
            title: 'Affiliates',
            link: '/affiliates/list',
            active: false
        }, );
    }

    breadArray.push({
        title: aff_head,
        link: link,
        active: false
    }, {
        title: titleVal,
        link: '#',
        active: true
    }, );

    const breadInstance = new BreadCrumbs(breadArray);
    breadInstance.init();
    //target js start here
    function formSubmit(action, formData) {
        $(".form_error").text("");
        $('.cke').css('border-color', '');
        $(".select2-selection").css('border-color', '');
        var checkAction = formData.get('action_form');
        let submitButton = document.querySelector('#add_matrix');
        submitButton.setAttribute('data-kt-indicator', 'on');
        submitButton.disabled = true;
        axios.post(action, formData)
            .then(function(response) {
                if (response.data.edit_id !== null && response.data.edit_id !== undefined)
                    $("#matrix_edit_id").val(response.data.edit_id);
                if (response.data.status == true) {
                    toastr.success(response.data.message);
                } else {
                    toastr.error(response.data.message);
                }
            })
            .catch(function(error) {
                console.log(error);
                if (error.response.status == 422) {
                    errors = error.response.data.errors;
                    $.each(errors, function(key, value) {
                        var id = $("#"+key);
                        // if select2
                        var error_field = $(id).nextAll('.form_error').addClass('field-error').text(value).fadeIn();
                        $(error_field).parent().find('.select2-selection').css('border-color', 'red');

                        // if cke editor
                        var error_field1 = $(id).nextAll('.form_error').addClass('field-error').text(value).fadeIn();
                        $(error_field1).parent().find("#cke_"+key).css('border-color', 'red');

                    });
                    toastr.error(error.response.data.message);
                } else {
                    toastr.error('Whoops! something went wrong');
                }
            })
            .then(function() {
                submitButton.setAttribute('data-kt-indicator', 'off');
                submitButton.disabled = false;
            });
    }

    $(document).on('click', '.reset_password', function(e) {
        e.preventDefault();
        let submitButton = $(this);
        submitButton.attr('data-kt-indicator', 'on');
        submitButton.prop('disabled', true)

        var id = $(this).attr('data-id');
        var url = '/affiliates/send-reset-password';
        var formdata = new FormData();
        formdata.append("id", id);
        axios.post(url, formdata)
            .then(function(response) {
                if (response.data.status == 400) {
                    toastr.error(response.data.message);
                } else {
                    toastr.success(response.data.message);
                }

            })
            .catch(function(error) {
                console.log(error);

            })
            .then(function() {
                // always executed
                submitButton.attr('data-kt-indicator', 'off');
                submitButton.prop('disabled', false);
            });

    });
    //filter
    $('#applyapkifilter').click(function(e) {
        e.preventDefault();
        pageNumber = 1;
        getFilterApiKey();
    });

    function getFilterApiKey(type) {
        var requestFrom = "{{Request::segment(2)}}";
        processing = true;
        var subaffRow = "";

        var sub = '';
        let myForm = document.getElementById('apikeyform');
        let formData = new FormData(myForm);
        formData.append('requestFrom', requestFrom);

        axios.post("/affiliates/affiliate-settings/" + $('#show_apikeypopup').data('user_id') + '?page =' + pageNumber, formData)
            .then(function(response) {
                var requestFrom = response.data.requestFrom;
                var i = 1;
                var html = '';
                var requestFrom = response.data.requestFrom;
                if (response.data.records.affiliate.referral_code_title)
                    subaffRow = response.data.records.affiliate.referral_code_title ? response.data.records.affiliate.referral_code_title : "N/A";

                var i = 1;
                if (requestFrom == "sub-affiliates") {
                    var i = 2;
                    html += ` <tr>
                        <td>1</td>
                        <td><span>${subaffRow}</span></td>

                        <td>
                            <span>${response.data.records.affiliate.referral_code_url ? response.data.records.affiliate.referral_code_url+'?rc='+response.data.records.affiliate.referal_code: "N/A"}</span>
                        </td>

                        <td>----</td>
                        <td>----</td>
                        <td>----</td>
                        <td>----</td>
                    </tr>`;
                }
                if (response.data.records.api_keys !== "undefined")
                    if (response.data.records.api_keys.length > 0) {
                        $.each(response.data.records.api_keys, function(key, val) {
                            var pageUrl = val.page_url;
                            if (requestFrom == "sub-affiliates") {
                                var pageUrl = val.page_url +
                                    '?rc=' + val.rc_code;
                            }
                            html += `
                             <tr>
                            <td>${i}
                            </td>
                            <td>
                            <span> ${
                                val.name
                            } </span></td>
                            <td><span>${pageUrl}</span></td>
                            <td>
                            <i class="fa fa-eye-slash"  class="toggleKey" data-id ='${val.api_key}' dats-bs-target= "#apikeyshow" style= 'font-size:25px;cursor:pointer;' aria-hidden ="true"></i></td>
                        <td><span>${val.created_at}</span></td>
                        <td>`;
                            if (val.status && val.status == 1) {
                                html += `<div class ="form-check form-switch form-switch-sm form-check-custom form-check-solid" title = "Change Status"><input id="aff_statusfeild" class ="form-check-input changeAffStatus" data-check ="${val.status}" data-id="${val.id}" type = "checkbox" data-status="0" title="Disable"  value= "1" name="status" checked="${val.status ? 'checked' : ''}" ></div>`;
                            } else {
                                html += `<div class ="form-check form-switch form-switch-sm form-check-custom form-check-solid" title = "Change Status" ><input  id="aff_statusfeild" class ="form-check-input changeAffStatus" data-check="${val.status}" data-id="${val.id}" type ="checkbox" data-status="1" title="enable"
                                value = "0" name="status" >
                            </div>`;
                            }
                            html += `</td>
                            <td>
                                    <a href = "#" class = "btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement = "bottom-end">Actions<span class = "svg-icon svg-icon-5 m-0">
                                    <svg xmlns = "http://www.w3.org/2000/svg" width = "24" height = "24" viewBox = "0 0 24 24" fill ="none">
                                    <path d = "M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill = "black"/></svg> </span></a>
                                    <div class = "menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu= "true" >
                                    <div class = "menu-item" ><span class ="menu-link api_popup" data-id="${val.id}" data-name ="${val.name}" data-page="${pageUrl}" data-origin = "${val.origin_url}">Edit</span></div>
                                    <div class= "menu-item"><span class ="menu-link">Delete</span></div></div>
                                    </td></tr>
                       `;
                            i++;
                        })
                        if (type == 'scroll') {
                            $('#affiliatekeys_table_body').append(html);
                            KTMenu.createInstances();
                            pageNumber += 1;
                            return;
                        }

                        pageNumber = 2;
                        $('#affiliatekeys_table_body').html(html);
                        KTMenu.createInstances();


                    } else {
                        $('#affiliatekeys_table_info').hide();
                        $('#affiliatekeys_table_paginate').hide();
                        $("#affiliatekeys_table_body").empty().html('<tr class="no_record"><td colspan="7" align="center">No data available in table</td></tr>');

                    }


            })
            .catch(function(error) {
                console.log(error);
            });

    }
    $(document).on("click", ".resetApiKey", function(e) {
        $('#search_affiliate').val("");
        $('#filter_status').val("1").change();
        pageNumber = 1;
        getFilterApiKey();
    });

    $(document).on('change', '#permission_service_id', function(e) {
        let service_id = $(this).val();
        let user_id = $('.affiliate_user_id').val();
        var formdata = new FormData();
        formdata.append('service_id',service_id);
        formdata.append('user_id',user_id);
        loaderInstance.show();
        axios.post('/affiliates/get-service-permissions', formdata)
            .then(function (response) {
                setPermissionCheckbox(response);
                setServiceTabs(id);
                loaderInstance.hide();
            })
            .catch(function (error) {
                loaderInstance.hide();
            });
    });

    function setPermissionCheckbox(response)
    {
        var html = '';
        var assignedPermissions = response.data.assignPermissions;
        $.each(response.data.permissions, function (key, mainPermissions)
        {
            html +=
            `<div class="card-body row mb-5 mt-5 border pt-5 pb-5">
                <div>
                    <div>
                        <div>
                            <div class="row mb-2 pb-3">
                                <div class="col-lg-12">
                                    <label class="checkbox-inline">
                                        <div class="checker">
                                            <input type="checkbox" name="permissions[]" value="${mainPermissions[1]}" ${assignedPermissions.includes(mainPermissions[1])?'checked':''}>
                                            <b>Enable ${mainPermissions[0]} Section</b>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="col-lg-10" style="margin-left: 15%;">`;

                                    $.each(mainPermissions[3], function (key, subPermission)
                                    {
                                        html +=
                                            `<div class="${subPermission[2]}_service_sub_heading">
                                                <div class="heading pb-2">
                                                    <label class="checkbox-inline">
                                                        <div class="checker">
                                                            <input type="checkbox" name="permissions[]" value="${subPermission[1]}" ${assignedPermissions.includes(subPermission[1])?'checked':''}>
                                                            <b>
                                                                ${subPermission[0]}
                                                            </b>
                                                        </div>
                                                    </label>
                                                </div>

                                                <div class="checkbox-list pb-5 px-5">`;

                                                $.each(subPermission[3], function (key, value)
                                                {
                                                    html +=
                                                        `<label class="checkbox-inline" style="vertical-align: top">
                                                            <div class="checker">
                                                                <input type="checkbox" class="${value[1]}_service" name="permissions[]" value="${value[1]}" ${assignedPermissions.includes(value[1])?'checked':''}>
                                                                ${value[0]}
                                                            </div>
                                                        </label>`;
                                                });
                                        html += `</div>
                                            </div>
                                            `;
                                    });
                                    html += `
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> `;
                });
            $('#permission_checkboxes').html(html);
    }

    function setServiceTabs(serviceId)
    {
        $(".mobile_service,.broadband_service,.energy_service,.mobile_broadband_service").parent().parent().hide();
        $(".mobile_service_sub_heading,.broadband_service_sub_heading,.energy_service_sub_heading,.mobile_broadband_service_sub_heading").hide();
        if (serviceId != null) {
            if (serviceId == 1) {
                $(".energy_service").parent().parent().show();
                $(".energy_service_sub_heading").show();
            }
            if (serviceId == 2) {
                $(".mobile_broadband_service,.mobile_service").parent().parent().show();
                $(".mobile_broadband_service_sub_heading,.mobile_service_sub_heading").show();
            }
            if (serviceId == 3) {
                $(".mobile_broadband_service,.broadband_service").parent().parent().show();
                $(".mobile_broadband_service_sub_heading,.broadband_service_sub_heading").show();
            }
        }
    }

    $(document).on('submit', '.affiliate-permissions-form', function(e) {
        e.preventDefault();
        $('.service_id_permission_error').html('');
        loaderInstance.show();
        var formdata = new FormData(this);
        axios.post('/affiliates/save-permissions', formdata)
        .then(function (response) {
            loaderInstance.hide();
            toastr.success('Permission saved successfully');
        })
        .catch(function (error) {
            loaderInstance.hide();
            if(error.response.status == 422) {
                errors = error.response.data.errors;
                $.each(errors, function(key, value) {

                    $('.'+key+'_permission_error').empty().addClass('text-danger').text(value).finish().fadeIn();
                });
            }
        });
    });
</script>
@include('pages.affiliates.affsettings.components.tags.js');
@include('pages.affiliates.affsettings.components.matrix.js');
@include('pages.affiliates.affsettings.components.retention.js');
