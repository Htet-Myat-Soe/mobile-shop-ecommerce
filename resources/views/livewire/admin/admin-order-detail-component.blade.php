<div>
    <div class="container">
        <div class="row">
            <h3>Order Derails</h3>
        </div>
        <div class="row">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                     Order Items
                    </button>
                  </h2>
                  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6">
                         <h5>Photo</h5>
                        </div>

                        <div class="col-lg-3 col-md-4 col-sm-6">
                         <h5> Product Name</h5>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                        <h5>Amount</h5>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6">
                          <h5>Quantity</h5>
                        </div>
                      </div>
                      @foreach ($orders->orderItems as $item)
                        <div class="row">
                          <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="product-image">
                              <figure><img src="{{asset('assets/images/products')}}/{{$item->product->image}}" width="100px" height="150px" alt=""></figure>
                            </div>
                          </div>

                          <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="product-name">
                              {{$item->product->name}}
                            </div>
                          </div>
                          <div class="col-lg-3 col-md-4 col-sm-6">
                            @if ($item->product->sale_price > 0 && $sale->status == 1 && $sale->sale_date > Carbon\Carbon::now())
                            <div class="price-field produtc-price"><p class="price">$ {{$item->product->sale_price}}</p></div>
                            @else
                            <div class="price-field produtc-price"><p class="price">$ {{$item->product->regular_price}}</p></div>
                            @endif
                          </div>
                          <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="price-field sub-total"><p class="price">{{$item->quantity}}</p></div>
                          </div>
                        </div>

                      @endforeach

                        </div>
                        <div class="container">
                            <div class="summary mx-4 my-2">
                            <div class="order-summary">
                                <h4 class="title-box">Order Summary</h4>
                                <p class="summary-info d-flex justify-content-between"><span class="title">Subtotal </span><b class="index">$ {{$orders->subtotal}}</b></p>
                                <p class="summary-info d-flex justify-content-between"><span class="title">Tax </span><b class="index">$ {{$orders->tax}}</b></p>
                                <p class="summary-info d-flex justify-content-between"><span class="title">Discount </span><b class="index">$ {{$orders->discount}}</b></p>
                                <p class="summary-info d-flex justify-content-between"><span class="title">Total </span><b class="index">$ {{$orders->total}}</b></p>

                            </div>
                        </div>
                    </div>

                    </div>
                </div>
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      Billing Details
                    </button>
                  </h2>
                  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <table class="table table-striped table-hovered">
                            <tr>
                              <th>First Name</th>
                              <td>{{$orders->firstname}}</td>
                              <th>Last Name</th>
                              <td>{{$orders->lastname}}</td>
                            </tr>
                            <tr>
                              <th>Phone</th>
                              <td>{{$orders->mobile}}</td>
                              <th>Email</th>
                              <td>{{$orders->email}}</td>
                            </tr>
                            <tr>
                              <th>Line 1</th>
                              <td>{{$orders->line1}}</td>
                              <th>Line 2</th>
                              <td>{{$orders->line2}}</td>
                            </tr>
                            <tr>
                              <th>City</th>
                              <td>{{$orders->city}}</td>
                              <th>Province</th>
                              <td>{{$orders->province}}</td>
                            </tr>
                            <tr>
                              <th>Country</th>
                              <td>{{$orders->country}}</td>
                              <th>Zipcode</th>
                              <td>{{$orders->zipcode}}</td>
                            </tr>
                        </table>
                    </div>
                  </div>
                </div>
                @if ($orders->is_shipping_different)
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                       Shipping Address
                      </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                      <div class="accordion-body">
                        <table class="table table-striped table-hovered">
                            <tr>
                              <th>First Name</th>
                              <td>{{$orders->shipping->firstname}}</td>
                              <th>Last Name</th>
                              <td>{{$orders->shipping->lastname}}</td>
                            </tr>
                            <tr>
                              <th>Phone</th>
                              <td>{{$orders->shipping->mobile}}</td>
                              <th>Email</th>
                              <td>{{$orders->shipping->email}}</td>
                            </tr>
                            <tr>
                              <th>Line 1</th>
                              <td>{{$orders->shipping->line1}}</td>
                              <th>Line 2</th>
                              <td>{{$orders->shipping->line2}}</td>
                            </tr>
                            <tr>
                              <th>City</th>
                              <td>{{$orders->shipping->city}}</td>
                              <th>Province</th>
                              <td>{{$orders->shipping->province}}</td>
                            </tr>
                            <tr>
                              <th>Country</th>
                              <td>{{$orders->shipping->country}}</td>
                              <th>Zipcode</th>
                              <td>{{$orders->shipping->zipcode}}</td>
                            </tr>
                        </table>
                    </div>
                    </div>
                  </div>
                @endif
                <div class="accordion-item">
                  <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                      Transaction
                    </button>
                  </h2>
                  <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <table class="table table-striped table-hovered">
                            <tr>
                              <th>Transaction Mode</th>
                              <td>{{$orders->transaction->mode}}</td>
                            </tr>
                            <tr>
                                <th>Transaction Status</th>
                                <td>{{$orders->transaction->status}}</td>
                            </tr>
                            <tr>
                                <th>Transaction Time</th>
                                <td>{{$orders->transaction->created_at}}</td>
                            </tr>
                        </table>
                    </div>
                  </div>
                </div>
              </div>
        </div>
    </div>
</div>
