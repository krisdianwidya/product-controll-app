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
                            return `<img src="/storage/assets/uploads/${data}" class="img-fluid" style="max-width: 200px; max-height: 200px; object-fit: scale-down;" alt="...">`
                        },
                        orderable: false
                    },
                    { data: 'name' },
                    { data: 'price' },
                    { data: 'description' },
                    {
                        render: () => {
                            return `<button class="btn btn-primary" id="btn-update"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger" id="btn-delete"><i class="fas fa-trash"></i></button>`
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