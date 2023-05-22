<script>
    function swal_confirm_delete(url, rowId) {
        Swal.fire({
            title: "{{ __('dashboard.alerts.do_you_want_to_delete_this_row') }}",
            // text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{ __('dashboard.action.yes_delete') }}",
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-danger ml-1',
            cancelButtonText: '{{ __('dashboard.action.cancel') }}',
            buttonsStyling: false,
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url: url,
                    method: 'get',
                    // _token: "{{ csrf_token() }}",
                    success: function (response) {
                        fireSuccess('{{ __('dashboard.alerts.deleted')  }}')
                        // Remove the raw
                        $('#row-' + rowId).remove();
                    }
                });
            }
        })
    }

    function swal_confirm_delete_selected(url, selectedItems) {
        if (selectedItems.length < 1)
            Swal.fire({
                type: 'error',
                title: '{{ __('dashboard.alerts.no_data_selected') }}',
                text: '{{ __('dashboard.alerts.select_data') }}',
                confirmButtonClass: 'btn btn-primary',
                buttonsStyling: false,
            })
        else {
            Swal.fire({
                title: '{{ __('dashboard.alerts.do_you_want_to_delete_selected_data') }}',
                // text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ __('dashboard.action.yes_delete_selected') }}',
                confirmButtonClass: 'btn btn-primary',
                cancelButtonClass: 'btn btn-danger ml-1',
                cancelButtonText: '{{ __('dashboard.action.cancel') }}',
                buttonsStyling: false,
            }).then(function (result) {
                if (result.value) {
                    $.ajax({
                        url,
                        method: 'POST',
                        data: {
                            ids: selectedItems
                        },
                        success: function () {
                            fireSuccess('{{ __('dashboard.alerts.deleted')  }}')

                            console.log(selectedItems);
                            selectedItems.forEach((element) => {
                                console.log('element : ' + element);
                                $('#row-' + element).remove();
                            });
                        }
                    });
                }
            })

        }
    }
</script>
