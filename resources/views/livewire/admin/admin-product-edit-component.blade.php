<div>
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0">Add Product</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Ecommerce</a></li>
                        <li class="breadcrumb-item active">Add Product</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <form wire:submit.prevent="updateProduct" enctype="multipart/form-data">
            @csrf
            <div class="col-lg-12">
                <input type="hidden" wire:model="product_id" value="{{$product_id}}">
                <div id="addproduct-accordion" class="custom-accordion">
                    <div class="card">
                        <a href="#addproduct-billinginfo-collapse" class="text-dark text-decoration-none"  wire:ignore.self data-bs-toggle="collapse" aria-expanded="true" aria-controls="addproduct-billinginfo-collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-xs">
                                            <div class="avatar-title rounded-circle bg-soft-primary text-primary"> 01 </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Billing Info</h5>
                                        <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                    </div>
                                    <div class="flex-shrink-0"> <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                                </div>
                            </div>
                        </a>
                        <div id="addproduct-billinginfo-collapse" class="collapse show" data-bs-parent="#addproduct-accordion"  wire:ignore.self>
                            <div class="p-4 border-top">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="productname">Product Name</label>
                                                <input id="productname" name="name" wire:model="name" value="{{$name}}" type="text" class="form-control"> </div>
                                                @error('name')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                            </div>
                                        <input type="hidden" wire:model="slug">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="productname">SKU</label>
                                                <input id="productname" name="sku" value="{{$sku}}" wire:model="sku" type="text" class="form-control"> </div>
                                                @error('sku')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                            </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="manufacturername">Regular Price</label>
                                                <input id="manufacturername" name="regular_price" value="{{$regular_price}}" wire:model="regular_price" type="text" placeholder="MMK" class="form-control"> </div>
                                                @error('regular_price')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                            </div>
                                        <div class="col-lg-6">
                                            <div class="mb-3">
                                                <label class="form-label" for="manufacturerbrand">Sale Price</label>
                                                <input id="manufacturerbrand" name="sale_price" value="{{$sale_price}}" wire:model="sale_price" type="text" placeholder="MMK" class="form-control"> </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" class="control-label">Category</label>
                                                <select class="form-control select1" value="{{$category_id}}" wire:model="category_id">
                                                    <option>Select</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label class="form-label" class="control-label">Stock Status</label>
                                                <select class="form-control select1" value="{{$stock}}" name="stock" wire:model="stock">
                                                    <option>Select</option>
                                                    <option value="instock">Instock</option>
                                                    <option value="outstock">Outstock</option>
                                                </select>
                                            </div>
                                            {{-- <div class="mb-3">
                                                <label class="form-label" class="control-label">Specifications</label>
                                                <select class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Choose ...">
                                                    <option value="HI" selected>High Quality</option>
                                                    <option value="LE" selected>Leather</option>
                                                    <option value="NO">Notifications</option>
                                                    <option value="SI">Sizes</option>
                                                    <option value="DI">Different Color</option>
                                                </select>
                                            </div> --}}
                                        </div>
                                    </div>
                                    <div class="mb-0" wire:ignore>
                                        <label class="form-label" for="">Product Short Description</label>
                                        <textarea class="form-control" id="short_desc" value="{{$short_desc}}" name="short_desc" wire:model="short_desc" rows="4"></textarea>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <a href="#addproduct-metadata-collapse" class="text-dark collapsed text-decoration-none"  wire:ignore.self data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false" aria-haspopup="true" aria-controls="addproduct-metadata-collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-xs">
                                            <div class="avatar-title rounded-circle bg-soft-primary text-primary"> 03 </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Product Image and Description</h5>
                                        <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                    </div>
                                    <div class="flex-shrink-0"> <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                                </div>
                            </div>
                        </a>
                        <div id="addproduct-metadata-collapse" class="collapse"  wire:ignore.self data-bs-parent="#addproduct-accordion">
                            <div class="p-4 border-top">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="metatitle">Image</label>
                                                <input id="metatitle" name="image" value="{{$image}}" wire:model="newImage" type="file" class="form-control"> </div>
                                        </div>
                                       <div class="col-sm-4">
                                        @if ($newImage)
                                        <img src="{{$newImage->temporaryUrl()}}" alt="No Photo" width="150px" height="150px">
                                        @else
                                            <img src="{{asset('admin_asset/images/products')}}/{{$image}}" alt="No Photo" width="120px" height="120px">
                                        @endif
                                       </div>
                                        <div class="col-sm-4">
                                            <div class="mb-3">
                                                <label class="form-label" for="metakeywords">Quantity</label>
                                                <input id="metakeywords" name="qty" wire:model="qty" value="{{$qty}}" type="number" class="form-control"> </div>
                                                @error('qty')
                                                <p class="text-danger">{{$message}}</p>
                                            @enderror
                                            </div>
                                    </div>
                                    <div class="mb-0" wire:ignore>
                                        <label class="form-label" for="metadescription">Product Description</label>
                                        <textarea class="form-control" name="desc" wire:model="desc" value="{{$desc}}" id="desc" rows="4"></textarea>
                                        @error('desc')
                                        <p class="text-danger">{{$message}}</p>
                                    @enderror
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <a href="#addproduct-img-collapse" class="text-dark collapsed text-decoration-none"  wire:ignore.self data-bs-toggle="collapse" aria-haspopup="true" aria-expanded="false" aria-haspopup="true" aria-controls="addproduct-img-collapse">
                            <div class="p-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar-xs">
                                            <div class="avatar-title rounded-circle bg-soft-primary text-primary"> 02 </div>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 overflow-hidden">
                                        <h5 class="font-size-16 mb-1">Product Related Image</h5>
                                        <p class="text-muted text-truncate mb-0">Fill all information below</p>
                                    </div>
                                    <div class="flex-shrink-0"> <i class="mdi mdi-chevron-up accor-down-icon font-size-24"></i> </div>
                                </div>
                            </div>
                        </a>
                        <div id="addproduct-img-collapse" class="collapse"  wire:ignore.self data-bs-parent="#addproduct-accordion">
                            <div class="p-4 border-top">
                                <div class="dropzone">
                                    <div class="fallback">
                                        <input name="file" type="file" multiple="multiple" wire:model="newImages">
                                     </div>
                                     @if ($newImages)
                                        @foreach ($newImages as $image)
                                            <img src="{{$image->temporaryUrl()}}" width="100px" height="130px" alt="">
                                        @endforeach
                                     @else
                                     <div class="dz-message needsclick">
                                        <div class="mb-3"> <i class="display-4 text-muted uil uil-cloud-upload"></i> </div>
                                        <h4>Drop files here or click to upload.</h4> </div>
                                     </div>
                                     @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row my-4">
                <div class="col text-end">
                    <button class="btn btn-outline-danger" wire:click.prevent="resetForm"> <i class="uil uil-times me-1"></i> Cancel </button>
                    <button type="submit" class="btn btn-dark" > <i class="uil uil-file-alt me-1"></i> Update </button>
                </div>
                <!-- end col -->
            </div>
        </form>
    </div>
    <!-- end row -->
</div>

@push('scripts')
   <script>
       $(function(){
            tinymce.init({
                selector: '#short_desc',
                setup: function(editor){
                    editor.on('Change',function(e){
                        tinyMCE.triggerSave();
                        var sd_data = $('#short_desc').val();
                        @this.set('short_desc',sd_data);
                    });
                }
            });

            tinymce.init({
                selector: '#desc',
                setup: function(editor){
                    editor.on('Change',function(e){
                        tinyMCE.triggerSave();
                        var d_data = $('#desc').val();
                        @this.set('desc',d_data);
                    });
                }
            })
       });
   </script>
@endpush
