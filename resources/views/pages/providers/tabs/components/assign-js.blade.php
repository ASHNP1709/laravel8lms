<script>
    let suburbs = [];
    let postcodeSuburbs = [];
    let userSubrubs = [];

    let suburbTable = $('#suburb-table').DataTable({
        responsive: false,
        searching: true,
        "sDom": "tipr",
    });

    let postcodeTable = $('#postcode-table').DataTable({
        responsive: false,
        searching: true,
        "sDom": "tipr",
    });

    
    $('.pagination').css('display','flex').css('flex-wrap','wrap').css('justify-content','flex-end')
    $(document).on('click','.paginate_button',function(){
        $('.pagination').css('display','flex').css('flex-wrap','wrap').css('justify-content','flex-end')
    })
    $('#search_suburb').keyup(function () {
        suburbTable.search($(this).val()).draw();
    })
    
    $('#search_postcode').keyup(function () {
        postcodeTable.search($(this).val()).draw();
    })
    $('#suburb-modal').on('hidden.bs.modal', function() {
        $('#assign_suburb_form')[0].reset();
        $('#assign_suburb_form [name=state_id]').val('').change();
        $('#assign_suburb_form #suburb').val('').change();
        $('.field-error').text('');
    })

    $('#postcode-modal').on('hidden.bs.modal', function() {
        $('#assign_postcode_form')[0].reset();
        $('#assign_postcode_form [name=assign_postcode_state_id]').val('').change();
        $('#assign_postcode_form [name=assign_postcode_suburb_id]').val('').change();
        $('#assign_postcode_form [name=assign_postcode_postcode_id]').val('').change();
        $('.field-error').text('');
    })

    $('.assign_suburb_submit_btn').click(function() {
        $('.errors').text('').removeClass('field-error').hide();
        loaderInstance.show();
        let formData = $('#assign_suburb_form').serialize();
        formData += "&provider_id={{encryptGdprData($providerdetails[0]['user_id'])}}";
        axios.post("/provider/assign-suburbs", formData)
            .then(function(response) {
                loaderInstance.hide();
                $('#suburb-modal').modal('hide');
                toastr.success(response.data.message)
                window.location.href = window.location.href ;
            }).catch(function(error) {
                loaderInstance.hide();
                if (error.response.status == 422) {
                    showValidationMessages(error.response.data.errors)
                }
                if (error.response.status && error.response.data.message)
                    toastr.error(error.response.data.message);
                else
                    toastr.error('Whoops! something went wrong.');
            })
    });


    $('#assign_postcodes_form_submit_btn').click(function() {
        $('.errors').text('').removeClass('field-error').hide();
        loaderInstance.show();
        let formData = $('#assign_postcode_form').serialize();
        formData += "&provider_id={{encryptGdprData($providerdetails[0]['user_id'])}}";
        axios.post("/provider/assign-postcodes", formData)
            .then(function(response) {
                loaderInstance.hide();
                $('#postcode-modal').modal('hide');
                toastr.success(response.data.message)
                window.location.href = window.location.href ;
            }).catch(function(error) {
                loaderInstance.hide();
                if (error.response.status == 422) {
                    showValidationMessages(error.response.data.errors)
                }
                if (error.response.status && error.response.data.message)
                    toastr.error(error.response.data.message);
                else
                    toastr.error('Whoops! something went wrong.');
            })
    });





    $('#assign_suburb_form [name=state_id]').change(function() {
        let state_id = $('#assign_suburb_form [name=state_id]').val();
        if (!state_id) {
            return false;
        }
        loaderInstance.show();
        $('#custom_loader').css('z-index', 9999);
        if (suburbs[state_id] && suburbs[state_id].length) {
            setStateSuburbs()
        } else {
            getStateSuburbs();
        }
    })

    const getStateSuburbs = () => {
        let state_id = $('#assign_suburb_form [name=state_id]').val();
        let formData = {
            state_id,
            'provider_id': "{{encryptGdprData($providerdetails[0]['user_id'])}}"
        }
        axios.post("/provider/get-suburbs", formData)
            .then(function(response) {
                suburbs[state_id] = response.data.suburbs.suburbs;
                userSubrubs = response.data.assignedSubrubs;
                setStateSuburbs();
            }).catch(function(error) {
                loaderInstance.hide();
                if (error.response.status && error.response.data.message)
                    toastr.error(error.response.data.message);
                else
                    toastr.error('Whoops! something went wrong.');
            })
    }

    const setStateSuburbs = () => {
        let state_id = $('#assign_suburb_form [name=state_id]').val();
        $('#assign_suburb_form #suburb').html('');
        suburbs[state_id].forEach(element => {
            $('#assign_suburb_form #suburb').append(`
                <option value="${element.id}" ${userSubrubs.includes(element.id) ? 'selected' :''}>${element.suburb}</option>
            `);
        });
        $('#assign_suburb_form #suburb').change();
        loaderInstance.hide();
    }



    $('[name=assign_postcode_state_id]').change(function() {
        let state_id = $(this).val();
        if (!state_id) {
            return false;
        }
        loaderInstance.show();
        $('#custom_loader').css('z-index', 9999);
        if (postcodeSuburbs[state_id] && postcodeSuburbs[state_id].length) {
            setPostcodeStateSuburbs()
        } else {
            getPostcodeStateSuburbs();
        }
    })

    const getPostcodeStateSuburbs = () => {
        let state_id = $('[name=assign_postcode_state_id]').val();
        if (!state_id) {
            return false;
        }
        let formData = {
            state_id,
            'provider_id': "{{encryptGdprData($providerdetails[0]['user_id'])}}"
        }
        axios.post("/provider/get-postcode-suburbs", formData)
            .then(function(response) {
                postcodeSuburbs[state_id] = response.data.assignedSubrubs;
                // userPostcodeSubrubs = response.data.assignedSubrubs;
                setPostcodeStateSuburbs();
            }).catch(function(error) {
                loaderInstance.hide();
                if (error.response.status && error.response.data.message)
                    toastr.error(error.response.data.message);
                else
                    toastr.error('Whoops! something went wrong.');
            })
    }

    const setPostcodeStateSuburbs = () => {
        let state_id = $('[name=assign_postcode_state_id]').val();
        if (!state_id) {
            return false;
        }
        $('[name=assign_postcode_suburb_id]').html('');
        postcodeSuburbs[state_id].forEach(element => {
            $('[name=assign_postcode_suburb_id]').append(`
                <option value="${element.subrubs.suburb}" ${userSubrubs.includes(element.subrubs.suburb) ? 'selected' :''}>${element.subrubs.suburb}</option>
            `);
        });
        $('[name=assign_postcode_suburb_id]').change();
        loaderInstance.hide();
    }


    $('[name=assign_postcode_suburb_id]').change(function() {
        let postcodes = [];
        let state_id = $('[name=assign_postcode_state_id]').val();
        let sururb_id = $(this).val();
        if (!state_id) {
            return false;
        }
        loaderInstance.show();

        $('#assign_postcode_postcode_id').html('');
        postcodeSuburbs[state_id].forEach(element => {
            if (sururb_id == element.subrubs.suburb) {

                $('#assign_postcode_postcode_id').append(`
                <option value="${element.subrubs.id}" ${userSubrubs.includes(element.subrubs.suburb) ? 'selected' :''}>${element.subrubs.postcode}</option>
                `);
            }
        });
        $('#assign_postcode_postcode_id').change();

        loaderInstance.hide();
    })

    //Change Status state
    $(document).on('click', '.changeSuburbStatus', function(e) {
        var check = $(this);
        var status = 0;
        var id = check.data("id");
        var isChecked = check.is(':checked');
        if (check.is(':checked'))
            status = 1;

        var url = '/provider/change-suburb-status';
        var formdata = {
            id,
            status
        };
        Swal.fire({
            title: "{{trans('affiliates.warning_msg_title')}}",
            text: "{{trans('affiliates.warning_msg_text')}}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "{{trans('affiliates.yes_text')}}",
        }).then(function(result) {
            if (result.isConfirmed) {
                axios.post(url, formdata)
                    .then(function(response) {

                        if (response.data.status == 400) {
                            toastr.error(response.data.message);
                            if (isChecked) {
                                check.prop('checked', false);
                            } else {
                                check.prop('checked', true);
                            }
                        } else {
                            toastr.success(response.data.message);
                        }

                    })
                    .catch(function(error) {
                        if (isChecked)
                            check.prop('checked', false);
                        else
                            check.prop('checked', true);

                        if (error.response.status && error.response.data.message)
                            toastr.error(error.response.data.message);
                        else
                            toastr.error('Whoops! something went wrong.');
                    })
                    .then(function() {

                    });
            } else {
                if (isChecked) {
                    check.prop('checked', false);
                } else {
                    check.prop('checked', true);
                }
            }
        });
    });

    //Delete state
    $(document).on('click', '.deleteSuburb', function(e) {
        e.preventDefault();
        var check = $(this);
        var id = check.data("id");
        var url = '/provider/delete-suburb';
        var providerId = '{{request()->segment(3)}}';
        var formdata = {
            id,
            providerId
        };
        Swal.fire({
            title: "{{trans('affiliates.warning_msg_title')}}",
            text: "{{trans('affiliates.delete_msg_text')}}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "{{trans('affiliates.yes_text')}}",
        }).then(function(result) {
            if (result.isConfirmed) {
                CardLoaderInstance.show('.tab-content');
                axios.post(url, formdata)
                    .then(function(response) {
                        if (response.data.status == 400) {
                            toastr.error(response.data.message);
                        } else {
                            check.closest('tr').remove();
                            toastr.success(response.data.message);
                        }
                        CardLoaderInstance.hide();
                    })
                    .catch(function(error) {
                        CardLoaderInstance.hide();
                        if (error.response.status && error.response.data.message)
                            toastr.error(error.response.data.message);
                        else
                            toastr.error('Whoops! something went wrong.');
                    })
                    .then(function() {
                        CardLoaderInstance.hide();
                    });
            }
        });

    });


    //Change Status state
    $(document).on('click', '.changePostcodeStatus', function(e) {
        var check = $(this);
        var status = 0;
        var id = check.data("id");
        var isChecked = check.is(':checked');
        if (check.is(':checked'))
            status = 1;

        var url = '/provider/change-postcode-status';
        var formdata = {
            id,
            status
        };
        Swal.fire({
            title: "{{trans('affiliates.warning_msg_title')}}",
            text: "{{trans('affiliates.warning_msg_text')}}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "{{trans('affiliates.yes_text')}}",
        }).then(function(result) {
            if (result.isConfirmed) {
                axios.post(url, formdata)
                    .then(function(response) {

                        if (response.data.status == 400) {
                            toastr.error(response.data.message);
                            if (isChecked) {
                                check.prop('checked', false);
                            } else {
                                check.prop('checked', true);
                            }
                        } else {
                            toastr.success(response.data.message);
                        }

                    })
                    .catch(function(error) {
                        if (isChecked)
                            check.prop('checked', false);
                        else
                            check.prop('checked', true);

                        if (error.response.status && error.response.data.message)
                            toastr.error(error.response.data.message);
                        else
                            toastr.error('Whoops! something went wrong.');
                    })
                    .then(function() {

                    });
            } else {
                if (isChecked) {
                    check.prop('checked', false);
                } else {
                    check.prop('checked', true);
                }
            }
        });
    });

    //Delete state
    $(document).on('click', '.deletePostcode', function(e) {
        e.preventDefault();
        var check = $(this);
        var id = check.data("id");
        var url = '/provider/delete-postcode';
        var providerId = '{{request()->segment(3)}}';
        var formdata = {
            id,
            providerId
        };
        Swal.fire({
            title: "{{trans('affiliates.warning_msg_title')}}",
            text: "{{trans('affiliates.delete_msg_text')}}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "{{trans('affiliates.yes_text')}}",
        }).then(function(result) {
            if (result.isConfirmed) {
                CardLoaderInstance.show('.tab-content');
                axios.post(url, formdata)
                    .then(function(response) {
                        if (response.data.status == 400) {
                            toastr.error(response.data.message);
                        } else {
                            check.closest('tr').remove();
                            toastr.success(response.data.message);
                        }
                        CardLoaderInstance.hide();
                    })
                    .catch(function(error) {
                        CardLoaderInstance.hide();
                        if (error.response.status && error.response.data.message)
                            toastr.error(error.response.data.message);
                        else
                            toastr.error('Whoops! something went wrong.');
                    })
                    .then(function() {
                        CardLoaderInstance.hide();
                    });
            }
        });

    });
</script>