$(document).ready(function() {
    $(document, this).on('click', '.delete-button', function(e) {
        e.preventDefault();
        let url = DELETE_STUDENT_URL;
        let id = $(this).data('id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: url.replace('_id', id),
                    method: 'DELETE',
                    data: {
                        "_token": CSRF_TOKEN
                    },
                    success: function(response) {
                        let title = response.success ? 'Deleted!' : 'Oops!';
                        let icon = response.success ? 'success' : 'error';
                        let text = response.success ? 'Your data has been deleted.' : 'Something went wrong';
                        Swal.fire({
                            icon: icon,
                            title: title,
                            text: text,
                        });

                        getStudentList();
                    },
                    error: function(response) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: 'Something went wrong',
                        });
                    }
                });
            }
          })

    });

    $(document, this).on('keyup', '#table-search', function(e){
        e.preventDefault();
        setTimeout(() => {
            getStudentList($(this).val());
        }, 1500)
    });

    $(document, this).on('click', '.edit-button', function(e){
        e.preventDefault();
        let url = EDIT_STUDENT_URL;
        let id = $(this).data('id');
        $.ajax({
            url: url.replace('_id', id),
            method: 'GET',
            dataType: 'json',
            success: function(response){
                $('#name').val(response.data.name);
                $('#level').val(response.data.level);
                $('#class_id').val(response.data.class_id);
                $('#parent_phone_number').val(response.data.parent_phone_number);
                $('#id_student').val(response.data.id);
                $(".head_text").html('Update User');
                $(".button_text").html('Update');
                $("#typeProcess").val(2);
                $("#triggerEditModal").trigger('click');
            }
        })
    })

    $(document, this).on('click', '.add-button', function(e){
        e.preventDefault();
        $(".head_text").html('Create User');
        $(".button_text").html('Save');
        $("#typeProcess").val(1);
        $("#triggerEditModal").trigger('click');

    })

    $(document, this).on('click', '.save_button', function(e){
        e.preventDefault();
        let url = $("#typeProcess").val() == '1' ? ADD_STUDENT_URL : UPDATE_STUDENT_URL;
        let formData = new FormData($("#formStudent")[0]);
        formData.append('_token', CSRF_TOKEN);
        formData.append('_method', $("#typeProcess").val() == '1' ? "POST" : "PUT");
        $.ajax({
            url: url,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response){
                let title = response.success ? 'Saved!' : 'Oops!';
                let icon = response.success ? 'success' : 'error';
                let text = response.success ? 'Your data has been saved.' : 'Something went wrong';
                Swal.fire({
                    icon: icon,
                    title: title,
                    text: text,
                });
                getStudentList();
                $(".closeModal").trigger('click');
            },
            error: function (_xhr) {
                var responseErrors = _xhr.responseJSON.errors;
                var separator = ', ';
                var textError = '';
                $.each(responseErrors, function (index, item) {
                    textError += item + separator;
                });

                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: textError.replace(/,(\s+)?$/, ''),
                });
            },

        });

    });

    $(document, this).on('click', '.upload_import', function(e){
        //create ajax to import file from importForm
        e.preventDefault();
        let formData = new FormData($("#importForm")[0]);
        $.ajax({
            url: IMPORT_STUDENT_URL,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response){
                let title = response.success ? 'Imported!' : 'Oops!';
                let icon = response.success ? 'success' : 'error';
                let text = response.success ? 'Your data has been imported.' : 'Something went wrong';
                Swal.fire({
                    icon: icon,
                    title: title,
                    text: text,
                });
                getStudentList();
            },
            error: function (_xhr) {
                var responseErrors = _xhr.responseJSON.errors;
                var separator = ', ';
                var textError = '';
                $.each(responseErrors, function (index, item) {
                    textError += item + separator;
                });

                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: textError.replace(/,(\s+)?$/, ''),
                });
            },
        });

    });

    function getStudentList(keywordText = ''){
        $.ajax({
            url: SEARCH_STUDENT_URL,
            method: 'GET',
            dataType: 'json',
            data: {keyword: keywordText},
            success: function(response){
                let studentSearchBody = $("#student_search_body");
                studentSearchBody.empty();
                let html = '';
                $.each(response.data, function(index, value){
                    html += `<tr class="bg-white hover:bg-gray-200">
                                <td class="w-4 p-4">${index+1}</td>
                                <th scope="row"
                                    class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    ${value.name}
                                </th>
                                <td class="px-6 py-4">${value.level}</td>
                                <td class="px-6 py-4">${value.classes == null ? '' : value.classes.name}</td>
                                <td class="px-6 py-4">${value.parent_phone_number}</td>
                                <td class="px-6 py-4">
                                    <div class="flex justify-start">
                                    <button type="button"
                                        class="bg-yellow-300 px-2 py-1 rounded-lg text-white hover:bg-white hover:text-black mr-2 edit-button"
                                        data-id="${value.id}">
                                            <i class="fas fa-pen"> </i>
                                        </button>
                                        <button type="button"
                                            class="bg-red-500 px-2 py-1 rounded-lg text-white hover:bg-white hover:text-black delete-button"
                                            data-id="${value.id}">
                                            <i class="fas fa-trash-can"> </i>
                                        </button>
                                    </div>
                                </td>
                            </tr>`;
                });
                studentSearchBody.append(html);
            }
        })

    }

});
