<div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto my-5">
                <img src="{{asset('assets/images/products')}}/{{$orderItem->product->image}}" alt="" width="200px" height="250px">
                <div class="row mt-3 w-50">
                    <div class="col-6">
                        <p>{{$orderItem->product->name}}</p>
                    </div>
                    <div class="col-6">
                        <strong>MMK {{$orderItem->price}}</strong>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mx-auto my-5">
                <div class="card">
                    <div class="card-header">
                        <h3>Your rating</h3>
                    </div>
                    <div class="card-body">
                        @if (Session::has('review_message'))
                            <div class="alert alert-success">
                                {{Session::get('review_message')}}
                            </div>
                        @endif
                        <form wire:submit.prevent="addReview">
                            <div class="comment-form-rating row">

                                <p class="stars">

                                    <label for="rated-1"></label>
                                    <input type="radio" id="rated-1" name="rating" value="1" wire:model="rating">
                                    <label for="rated-2"></label>
                                    <input type="radio" id="rated-2" name="rating" value="2"  wire:model="rating">
                                    <label for="rated-3"></label>
                                    <input type="radio" id="rated-3" name="rating" value="3"  wire:model="rating">
                                    <label for="rated-4"></label>
                                    <input type="radio" id="rated-4" name="rating" value="4"  wire:model="rating">
                                    <label for="rated-5"></label>
                                    <input type="radio" id="rated-5" name="rating" value="5" checked="checked"  wire:model="rating">
                                </p>
                                @error('rating') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Comment:</label>
                                <textarea class="form-control" id="comment" rows="5"  wire:model="comment"></textarea>
                                @error('rating') <p class="text-danger">{{$message}}</p> @enderror
                            </div>
                            <button type="submit" class="btn btn-success">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
