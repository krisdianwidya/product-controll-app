getProducts();

function getProducts() {
    $.get('/getproducts')
        .done(data => {
            $('#products').DataTable({
                destroy: true,
                data: data,
                columns: [
                    {
                        data: 'image',
                        render: function (data) {
                            return `<img src="/storage/assets/uploads/${data}" class="img-fluid" alt="...">`
                        },
                        orderable: false
                    },
                    { data: 'name' },
                    {
                        data: 'price',
                        render: data => {
                            return new Intl.NumberFormat('IN', { style: 'currency', currency: 'IDR' }).format(data)
                        }
                    },
                    { data: 'description' },
                    {
                        data: 'id',
                        render: (data) => {
                            return `<button class="btn btn-primary btn-edit" data-id="${data}" data-toggle="modal" data-target="#update-product-modal">Edit</button>
                            <button class="btn btn-danger btn-del" data-id="${data}">Delete</button>`
                        }
                    }
                ]
            });
        });
}

let field = ['name', 'price', 'description', 'image'];

// add data product
$('#btn-add').on('click', e => {
    e.preventDefault();

    resetError();

    Swal.showLoading()

    let productData = new FormData();
    productData.append('name', $('#name').val());
    productData.append('price', $('#price').val());
    productData.append('description', $('#description').val());
    productData.append('image', $("#image")[0].files[0]);

    $.ajax({
        url: `/products`,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: "post",
        data: productData,
        contentType: false,
        processData: false
    })
        .done(() => {
            Swal.hideLoading()

            $('#update-product-modal').removeClass('show').css({ display: "none" });

            Swal.fire(
                'Success',
                'Product has been inserted.',
                'success'
            )

            $('.modal-backdrop').remove();
            $('body').css({ paddingRight: "0" }).removeClass('modal-open');

            getProducts();
        })
        .fail((error) => {
            Swal.hideLoading()

            displayError(error);
        });
});

function displayError(error) {
    if (error) {

        if (error.responseJSON.errors.name) {
            $('#name').addClass('is-invalid');
            $('#name-error')
                .append(`<p class='m-0 text-danger'>${error.responseJSON.errors.name[0]}</p>`);
        }

        if (error.responseJSON.errors.price) {
            $('#price').addClass('is-invalid');
            $('#price-error')
                .append(`<p class='m-0 text-danger'>${error.responseJSON.errors.price[0]}</p>`);
        }

        if (error.responseJSON.errors.description) {
            $('#description').addClass('is-invalid');
            $('#description-error')
                .append(`<p class='m-0 text-danger'>${error.responseJSON.errors.description[0]}</p>`);
        }

        if (error.responseJSON.errors.image) {
            $('#image').addClass('is-invalid');
            $('#image-error')
                .append(`<p class='m-0 text-danger'>${error.responseJSON.errors.image[0]}</p>`);
        }
    }
}


function resetError() {
    for (let i = 0; i < field.length; i++) {
        console.log(field[i]);

        if ($(`#${field[i]}`).hasClass('is-invalid')) {
            $(`#${field[i]}`).removeClass('is-invalid');
            $(`#${field[i]}-error`)
                .html(``);
        }
    }
}
// end add data product

// update data product
$(document).on('click', e => {
    if (e.target.classList.contains('btn-edit')) {
        const productId = e.target.dataset.id;

        $.get(`/product/${productId}`)
            .done(data => {
                $('#update-name').val(data.name);
                $('#update-price').val(data.price);
                $('#update-description').val(data.description);
            });

        // update data product
        $('#btn-update').on('click', e => {
            e.preventDefault();

            resetErrorUpdate();

            Swal.showLoading()

            let productUpdateData = new FormData();
            productUpdateData.append('name', $('#update-name').val());
            productUpdateData.append('price', $('#update-price').val());
            productUpdateData.append('description', $('#update-description').val());
            productUpdateData.append('image', $("#update-image")[0].files[0]);

            $.ajax({
                url: `/product/${productId}`,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "post",
                data: productUpdateData,
                contentType: false,
                processData: false
            })
                .done((data) => {
                    console.log(data);

                    Swal.hideLoading()

                    $('#update-product-modal').removeClass('show').css({ display: "none" });

                    Swal.fire(
                        'Success',
                        'Product has been updated.',
                        'success'
                    )

                    $('.modal-backdrop').remove();
                    $('body').css({ paddingRight: "0" }).removeClass('modal-open');

                    getProducts();
                })
                .fail((error) => {
                    Swal.hideLoading()

                    displayErrorUpdate(error);
                });
        });
    }
});

function displayErrorUpdate(error) {
    if (error) {
        if (error.responseJSON.errors.name) {
            $('#update-name').addClass('is-invalid');
            $('#update-name-error')
                .append(`<p class='m-0 text-danger'>${error.responseJSON.errors.name[0]}</p>`);
        }

        if (error.responseJSON.errors.price) {
            $('#update-price').addClass('is-invalid');
            $('#update-price-error')
                .append(`<p class='m-0 text-danger'>${error.responseJSON.errors.price[0]}</p>`);
        }

        if (error.responseJSON.errors.description) {
            $('#update-description').addClass('is-invalid');
            $('#update-description-error')
                .append(`<p class='m-0 text-danger'>${error.responseJSON.errors.description[0]}</p>`);
        }

        if (error.responseJSON.errors.image) {
            $('#update-image').addClass('is-invalid');
            $('#update-image-error')
                .append(`<p class='m-0 text-danger'>${error.responseJSON.errors.image[0]}</p>`);
        }
    }
}

function resetErrorUpdate() {
    for (let i = 0; i < field.length; i++) {
        console.log(field[i]);

        if ($(`#update-${field[i]}`).hasClass('is-invalid')) {
            $(`#update-${field[i]}`).removeClass('is-invalid');
            $(`#update-${field[i]}-error`)
                .html(``);
        }
    }
}
//end update data product


//delete data product
$(document).on('click', e => {
    if (e.target.classList.contains('btn-del')) {
        const productId = e.target.dataset.id;

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
                    url: `/product/${productId}`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "delete"
                })
                    .done((data) => {
                        console.log(data);

                        Swal.hideLoading()

                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )

                        getProducts();
                    })
                    .fail((error) => {
                        Swal.hideLoading()
                        console.log(error);
                    });
            }
        })
    }
});
// end delete data product