<x-app>
<x-slot name="content">

    <div class="alert alert-danger text-center">
        {{$event->name}}
    </div>

    <div class="container my-5">
        <div class="row">


            <div class="col-md-6">
             <img src="/storage/img/{{$event->event_img}}" class="img-fluid rounded" alt="">

             <div class="my-4">
                <h4 class="mb-3">Billing address</h4>
                <form class="needs-validation" action="{{route('payment')}}" method="POST">
                    @csrf
                    {{-- hidden inputs  --}}
                    <input type="hidden" value="{{$event->id}}" name="event_id">
                    <input type="hidden" value="{{$event->name}}" name="event_name">
                    <input type="hidden" value="{{$event->price}}" name="event_price">
                  <div class="row g-3">
                    <div class="col-sm-6">
                      <label for="firstName" class="form-label">First name</label>
                      <input type="text" name="first_name" class="form-control" id="firstName" placeholder="" value="" required>
                      <div class="invalid-feedback">
                        Valid first name is required.
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <label for="lastName" class="form-label">Last name</label>
                      <input type="text" name="last_name" class="form-control" id="lastName" placeholder="" value="" required>
                      <div class="invalid-feedback">
                        Valid last name is required.
                      </div>
                    </div>


                    <div class="col-sm-6">
                      <label for="email" class="form-label">Email <span class="text-body-secondary"></span></label>
                      <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com">
                      <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                      </div>
                    </div>

                    <div class="col-sm-6">
                        <label for="Phone" class="form-label">Phone Number</label>
                        <input type="number" name="phone" class="form-control" id="lastName" placeholder="" value="" required>
                        <div class="invalid-feedback">
                          Valid last name is required.
                        </div>
                      </div>


                    <div class="col-12">
                      <label for="address" class="form-label">Address</label>
                      <input type="text" name="address" class="form-control" id="address" placeholder="1234 Main St" required>
                      <div class="invalid-feedback">
                        Please enter your shipping address.
                      </div>
                    </div>

                  </div>

                  <button class="w-100 btn btn-warning btn-lg my-4" type="submit">Payment</button>
                </form>
             </div>

            </div>

            <div class="col-md-6">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-danger text-uppercase">Your Order</span>
                  </h4>
                  <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                      <div>
                        <h6 class="my-0">Event</h6>
                      </div>
                      <span class="text-body-secondary">{{$event->name}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                          <h6 class="my-0">Price</h6>
                        </div>
                        <span class="text-body-secondary">N{{number_format($event->price, 2)}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                          <h6 class="my-0">Venue</h6>
                        </div>
                        <span class="text-body-secondary">{{$event->venue}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                          <h6 class="my-0">Time</h6>
                        </div>
                        <span class="text-body-secondary">{{$event->date}}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
                      <div class="text-success">
                        <h6 class="my-0">Promo code</h6>
                      </div>
                      <span class="text-success">−30%</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                      <span>Total (NGN)</span>
                      <strong>N{{number_format($event->price, 2)}}</strong>
                    </li>
                  </ul>

                  <form class="card p-2">
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Promo code">
                      <button type="submit" class="btn btn-danger" disabled>Redeem</button>
                    </div>
                  </form>
            </div>

        </div>
    </div>

</x-slot>
</x-app>
