<div>
    <div class="card">
        <div class="card-header">
            <h3>Home Slider Edit Form</h3>
        </div>
        <div class="card-body col-lg-6 mx-auto">
            <form enctype="multipart/form-data" wire:submit.prevent="update">
             @csrf
             <input type="hidden" name="ids" wire:model="ids" value="{{$ids}}">
             <input class="form-control form-control-md" type="text" placeholder="Title" value="{{$title}}" wire:model="title" aria-label=".form-control-md"><br>
             <input class="form-control form-control-md" type="text" placeholder="Subtitle" wire. value="{{$subtitle}}" wire:model="subtitle" aria-label=".form-control-md"><br>
             <input class="form-control form-control-md" type="url" placeholder="Link" value="{{$url}}" wire:model="url" aria-label=".form-control-md"><br>
             <input class="form-control form-control-md" type="number" placeholder="Price" value="{{$price}}" wire:model="price" aria-label=".form-control-md"><br>
             <input class="form-control form-control-md" type="file" value="{{$newImage}}" wire:model="newImage" placeholder="Image"  aria-label=".form-control-md"><br>
             <div class="form-check">
                 <input class="form-check-input" type="checkbox" wire:model="status" value="1" id="flexCheckDefault">
                 <label class="form-check-label" for="flexCheckDefault">
                   Active
                 </label>
               </div><br>
               <button type="submit" class="btn btn-dark">Update</button>
             </form>
        </div>
    </div>
 </div>
