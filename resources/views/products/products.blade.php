@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Control Products</h4>

    <hr>

    <button class="btn btn-primary mb-2" data-toggle="modal" data-target="#add-product-modal">+ Add Product</button>

    <table id="products" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>

    </table>

    <!-- Modal add product -->
    <div class="modal fade " id="add-product-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control mb-2" id="name" placeholder="Product name">
                    <div id="name-error">

                    </div>

                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" class="form-control" id="price" placeholder="Product price">
                    </div>
                    <div id="price-error">

                    </div>

                    <textarea class="form-control mb-2" name="description" id="description" rows="3" placeholder="Product Description"></textarea>
                    <div id="description-error">

                    </div>

                    <div>
                        <label for="image">Product image</label>
                        <input class="form-control-file" id="image" type="file">
                        <div id="image-error">

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <button type="button" class="btn btn-primary" id="btn-add">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal add product -->


    <!-- Modal update product -->
    <div class="modal fade " id="update-product-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Update Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" class="form-control mb-2" id="update-name" placeholder="Product name">
                    <div id="name-error">

                    </div>

                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" class="form-control" id="update-price" placeholder="Product price">
                    </div>
                    <div id="price-error">

                    </div>

                    <textarea class="form-control mb-2" name="description" id="update-description" rows="3" placeholder="Product Description"></textarea>
                    <div id="description-error">

                    </div>

                    <div>
                        <label for="image">Product image</label>
                        <input class="form-control-file" id="update-image" type="file">
                        <div id="image-error">

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <button type="button" class="btn btn-primary" id="btn-update">Update</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal update product -->

    <!-- Modal delete product -->
    <!-- <div class="modal fade " id="delete-product-modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Delete Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                    </svg>
                    <h3 class="text-center">Are you sure want to delete this product?</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <button type="button" class="btn btn-danger" id="btn-delete">Delete</button>
                </div>
            </div>
        </div>
    </div> -->
    <!-- End modal delete product -->

</div>
@endsection