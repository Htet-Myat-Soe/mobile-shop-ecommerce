<div>
   <div class="card">
       <div class="card-header">
           <h3>Home Slider Add Form</h3>
       </div>
       <div class="card-body col-lg-6 mx-auto">
           <form enctype="multipart/form-data" wire:submit.prevent="store">
            @csrf
            <input class="form-control form-control-md" type="text" placeholder="Title" wire:model="title" aria-label=".form-control-md"><br>
            <input class="form-control form-control-md" type="text" placeholder="Subtitle" wire:model="subtitle" aria-label=".form-control-md"><br>
            <input class="form-control form-control-md" type="url" placeholder="Link" wire:model="url" aria-label=".form-control-md"><br>
            <input class="form-control form-control-md" type="number" placeholder="Price" wire:model="price" aria-label=".form-control-md"><br>
            <input class="form-control form-control-md" type="file" placeholder="Image" wire:model="image" aria-label=".form-control-md"><br>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" wire:model="status" value="1" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  Active
                </label>
              </div><br>
              <button type="submit" class="btn btn-dark">Create</button>
            </form>
       </div>
   </div>
</div>
