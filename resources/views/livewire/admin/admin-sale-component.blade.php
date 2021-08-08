<div>
    <div class="card col-lg-6 col-sm-12 mx-auto">
        <div class="card-header">
            <h3>Sale Setting</h3>
        </div>
        <div class="card-body">
            @if (Session::has('message'))
            <div class="alert alert-success">
                {{Session::get('message')}}
            </div>
            @endif
            <form wire:submit.prevent="update">
                @csrf
                <div class="mb-3">
                    <label for="sale_date" class="form-label">Sale Date</label>
                    <input type="text" class="form-control" wire:model="sale_date" id="sale_date" placeholder="YY/MM/DD hh:mm:ss">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" wire:model="status" value="1" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      Active
                    </label>
                  </div><br>
                <button type="submit" class="btn btn-dark">Change</button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(function(){
        $('#sale_date').datetimepicker({
            format: 'Y-MM-DD h:m:s',
        })
        .on('dp.change',function(e){
            $data =  $('#sale_date').value();
            @this.set('sale_date',data);
        });
    });
</script>
@endpush
