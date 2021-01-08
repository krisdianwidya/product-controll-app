$('#products').DataTable();

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
        .done((data) => {
            Swal.hideLoading()

            $('#add-product-modal').modal('hide');

            Swal.fire(
                'Success',
                'Product has been inserted.',
                'success'
            )
            console.log(data);
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