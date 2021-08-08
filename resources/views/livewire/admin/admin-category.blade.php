<div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light d-flex justify-content-between">
                    <h4 class="card-title">Categories</h4>
                    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#addCategory">Add Category</button>
                </div>
                <div class="card-body">
                    <p class="card-title-desc">This is a categories table you can CRUD categories.</p>

                    <table class="table table-bordered mb-0">

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>NAME</th>
                                <th>SLUG</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach ($categories as $category)
                                <tr>
                                    <td>{{$category->id}}</td>
                                    <td>{{$category->name}}</td>
                                    <td>{{$category->slug}}</td>
                                    <td>
                                        <a href="javascript:void(0)"  data-bs-target="#editCategory" wire:click.prevent="edit({{$category->id}})" data-bs-toggle="modal" class="text-decoration-none text-dark">Edit</a>  |
                                        <a href="javascript:void(0)" onclick="confirm('Are you Sure?') || event.stopImmediatePropagation()" wire:click.prevent="delete({{$category->id}})" class="text-decoration-none text-dark">Delete</a>
                                    </td>
                                </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->


    {{-- Add Modal  --}}
    <div class="modal fade" wire:ignore.self id="addCategory">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Add Category</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="name" wire:model="name" wire:keyup="slugGenerate" placeholder="Category Name">
                        @error('name')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Slug</label>
                        <input type="text" class="form-control" id="slug" placeholder="{{$slug}}" value="{{$slug}}" wire:model="slug"  readonly>
                        @error('slug')
                            <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <button type="button" wire:click.prevent="storeCategory" class="btn btn-dark float-right">Create</button>
                </form>
            </div>
          </div>
        </div>
      </div>

       {{-- Edit Modal  --}}
    <div class="modal fade" wire:ignore.self id="editCategory">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Edit Category</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <input type="hidden" id="id" name="id" wire:model="ids" value="{{$ids}}">
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="name" wire:model="name" wire:keyup="slugGenerate"  placeholder="Category Name">
                        @error('name')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Slug</label>
                        <input type="text" class="form-control" id="slug" placeholder="{{$slug}}"  wire:model="slug"  readonly>
                        @error('slug')
                        <p class="text-danger">{{$message}}</p>
                        @enderror
                    </div>
                    <button type="button" wire:click.prevent="updateCategory" class="btn btn-dark float-right">Update</button>
                </form>
            </div>
          </div>
        </div>
      </div>


</div>
@push('scripts')
<script>
livewire.emit('createSuccess',()=>{
    $('addCategory').modal('hide');
});
livewire.emit('updateSuccess',()=>{
    $('addCategory').modal('hide');
});


</script>
@endpush
