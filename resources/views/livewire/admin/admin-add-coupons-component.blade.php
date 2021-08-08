<div>
    <div class="card">
        <div class="card-header">
            <h3>Coupons Add Form</h3>
        </div>
        <div class="card-body col-lg-6 mx-auto">
            <form wire:submit.prevent="store">
             @csrf
             <input class="form-control form-control-md" type="text" placeholder="Coupon Code" wire:model="code" aria-label=".form-control-md"><br>
             @error('code')
                        <p class="text-danger">{{$message}}</p>
                    @enderror
             <div class="mb-3">
                <label class="form-label" class="control-label">Coupon Type</label>
                <select class="form-control select1" wire:model="type">
                    <option>Select</option>
                    <option value="fixed">Fixed</option>
                    <option value="percent">Percentage</option>
                </select>
                @error('type')
                    <p class="text-danger">{{$message}}</p>
                @enderror
            </div>
            <input class="form-control form-control-md" type="text" placeholder="Coupon Value" wire:model="value" aria-label=".form-control-md"><br>
            @error('value')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <input class="form-control form-control-md" type="text" placeholder="Cart Value" wire:model="cart_value" aria-label=".form-control-md"><br>
            @error('cart_value')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <input class="form-control form-control-md" type="text" placeholder="Expiry Date" wire:model="expiry_date" id="expiry_date" aria-label=".form-control-md"><br>
            @error('expiry_date')
            <p class="text-danger">{{$message}}</p>
            @enderror
            <button type="submit" class="btn btn-dark">Create</button>
             </form>
        </div>
    </div>
 </div>

 @push('scripts')
<script>
    $(function(){
        $('#expiry_date').datetimepicker({
            format: 'Y-MM-DD h:m:s',
        })
        .on('dp.change',function(e){
            $data =  $('#expiry_date').value();
            @this.set('expiry_date',data);
        });
    });
</script>
@endpush
