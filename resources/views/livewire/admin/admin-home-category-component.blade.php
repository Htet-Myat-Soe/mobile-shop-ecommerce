<div>
    <div class="card col-lg-6 mx-auto">
        <div class="card-header">
            <h3>Add Home Categories</h3>
        </div>
        @if(Session::has('message'))
                <div class="alert alert-success">
                    <p>{{Session::get('message')}}</p>
                </div>
        @endif
        <div class="card-body">
            <form wire:submit.prevent="updateHomeCategory" class="form-horizontal">
                <div class="mb-3">
                    <label class="form-label" class="control-label">Choose Categories</label>
                    <select class="form-control selected_categories" wire:model="sel_categories"  name="categories[]" multiple="multiple" data-placeholder="Choose ...">
                        @foreach ($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group my-3">
                    <label for="" class="col-md-12 control-label">Number of Products</label>
                    <div class="col-md-12">
                        <input type="number" class="form-control input-md" wire:model="num_products">
                    </div>
                </div>
                <button type="submit" class="btn btn-dark">Create</button>
            </form>
        </div>
    </div>
</div>


@push('scripts')
<script>
    $(document).ready(function(){
        $('.selected_categories').select2();
        $('.selected_categories').on('change',function(e){
            var data = $('.selected_categories').select2("val");
            @this.set('sel_categories',data);
        });
    });
</script>
@endpush
