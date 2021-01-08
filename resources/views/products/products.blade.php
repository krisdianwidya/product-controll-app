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
</div>
@endsection