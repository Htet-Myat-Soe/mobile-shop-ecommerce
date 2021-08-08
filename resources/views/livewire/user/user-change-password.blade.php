<div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h3>Change Password</h3>
                    </div>
                    <div class="card-body">
                        @if (Session::has('success_message'))
                            <div class="alert alert-success">
                                {{Session::get('success_message')}}
                            </div>
                        @endif
                        @if (Session::has('fail_message'))
                            <div class="alert alert-danger">
                                {{Session::get('fail_message')}}
                            </div>
                        @endif
                        <form wire:submit.prevent="changePassword">
                            @csrf
                            <input class="form-control" type="password" name="current_password" placeholder="Current Password" wire:model="current_password"><br>
                            @error('current_password')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                            <input class="form-control" type="password" name="password" placeholder="Password" wire:model="password"><br>
                            @error('password')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                            <input class="form-control" type="password" name="password_confirmation" placeholder="Password" wire:model="password_confirmation"><br>
                            @error('password_confirmation')
                            <p class="text-danger">{{$message}}</p>
                            @enderror
                            <button type="submit" class="btn btn-primary">Change</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
