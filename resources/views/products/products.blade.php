@extends('layouts.app')

@section('content')
<div class="container">
    <h4>Control Products</h4>

    <hr>

    <button class="btn btn-primary mb-1" data-toggle="modal" data-target="#add-product-modal">+ Add Product</button>

    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th></th>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
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
                    <input type="text" class="form-control mb-2" placeholder="Product name">
                    <input type="number" class="form-control mb-2" placeholder="Product price">
                    <textarea class="form-control mb-2" name="description" id="description" rows="3" placeholder="Product Description"></textarea>

                    <div>
                        <label for="image">Product image</label>
                        <input class="form-control-file" type="file">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    <button type="button" class="btn btn-primary" id="btn-update">Save</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End modal add product -->

</div>
@endsection