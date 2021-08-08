<div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h3>Settings</h3>
                    </div>
                    <div class="card-body">
                        @if(Session::has('setting_success'))
                        <div class="alert alert-success">
                            {{Session::get('setting_success')}}
                        </div>
                        @endif

                        <form wire:submit.prevent="saveSettings">
                            <input class="form-control" type="text" name="email" placeholder="Email Address" wire:model="email"><br>
                            @error('email')
                            <p class="text-danger">{{$message}}</p>
                            @enderror

                            <input class="form-control" type="text" name="phone" placeholder="Phone Number" wire:model="phone"><br>
                            @error('phone')
                            <p class="text-danger">{{$message}}</p>
                            @enderror

                            <input class="form-control" type="text" name="phone2" placeholder="Phone2 Number" wire:model="phone2"><br>
                            @error('phone2')
                            <p class="text-danger">{{$message}}</p>
                            @enderror

                            <input class="form-control" type="text" name="facebook" placeholder="Facebook" wire:model="facebook"><br>
                            @error('facebook')
                            <p class="text-danger">{{$message}}</p>
                            @enderror

                            <input class="form-control" type="text" name="twiter" placeholder="Twiter" wire:model="twiter"><br>
                            @error('twiter')
                            <p class="text-danger">{{$message}}</p>
                            @enderror

                            <input class="form-control" type="text" name="pinterest" placeholder="Pinterest" wire:model="pinterest"><br>
                            @error('pinterest')
                            <p class="text-danger">{{$message}}</p>
                            @enderror

                            <input class="form-control" type="text" name="youtube" placeholder="Youtube" wire:model="youtube"><br>
                            @error('youtube')
                            <p class="text-danger">{{$message}}</p>
                            @enderror

                            <input class="form-control" type="text" name="address" placeholder="Address" wire:model="address"><br>
                            @error('address')
                            <p class="text-danger">{{$message}}</p>
                            @enderror

                            <input class="form-control" type="text" name="map" placeholder="Map" wire:model="map"><br>
                            @error('map')
                            <p class="text-danger">{{$message}}</p>
                            @enderror

                            <button type="submit" class="btn btn-dark">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
