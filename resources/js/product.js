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
                    { data: 'price' },
                    { data: 'description' },
                    {
                        data: 'id',
                        render: (data) => {
                            return `<button class="btn btn-primary btn-edit" data-id="${data}" data-toggle="modal" data-target="#update-product-modal">Edit</button>
                            <button class="btn btn-danger" id="btn-delete">Delete</button>`
                        }
                    }
                ]
            });
        });
}

$('#btn-add').on('click', e => {
    e.preventDefault();

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

            // $('#add-product-modal').modal('hide');

            Swal.fire(
                'Success',
                'Product has been inserted.',
                'success'
            )

            getProducts();
        })
        .fail((error) => {
            Swal.hideLoading()
            if (error) {
                $('#name').addClass('is-invalid');
                $('#name-error')
                    .append(`<p class='m-0 text-danger'>${error.responseJSON.errors.name[0]}</p>`);

                $('#price').addClass('is-invalid');
                $('#price-error')
                    .append(`<p class='m-0 text-danger'>${error.responseJSON.errors.price[0]}</p>`);

                $('#description').addClass('is-invalid');
                $('#description-error')
                    .append(`<p class='m-0 text-danger'>${error.responseJSON.errors.description[0]}</p>`);

                $('#image').addClass('is-invalid');
                $('#image-error')
                    .append(`<p class='m-0 text-danger'>${error.responseJSON.errors.image[0]}</p>`);
            }
        });
});

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

                    // $('#add-product-modal').modal('hide');

                    Swal.fire(
                        'Success',
                        'Product has been updated.',
                        'success'
                    )
                    getProducts();
                })
                .fail((error) => {
                    Swal.hideLoading()
                    console.log(error);
                    // if (error) {
                    //     $('#update-name').addClass('is-invalid');
                    //     $('#name-error')
                    //         .append(`<p class='m-0 text-danger'>${error.responseJSON.errors.name[0]}</p>`);

                    //     $('#update-price').addClass('is-invalid');
                    //     $('#price-error')
                    //         .append(`<p class='m-0 text-danger'>${error.responseJSON.errors.price[0]}</p>`);

                    //     $('#update-description').addClass('is-invalid');
                    //     $('#description-error')
                    //         .append(`<p class='m-0 text-danger'>${error.responseJSON.errors.description[0]}</p>`);

                    //     $('#update-image').addClass('is-invalid');
                    //     $('#image-error')
                    //         .append(`<p class='m-0 text-danger'>${error.responseJSON.errors.image[0]}</p>`);
                    // }
                });
        });
    }
});