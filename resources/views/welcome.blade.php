<x-app>

    <x-slot name="content">

        <section id="header">
            <div class="container-fluid">
             <div class="row">

                <div class="col-md-4">

                </div>

                <div class="col-md-8 bg-danger p-5 text-center" style="clip-path: polygon(20% 0, 100% 0, 100% 100%, 0% 100%);">
                    <h1 class="fw-bold text-light">Buy Your Event Tieckets Here</h1>
                    <p class="col-lg-6 mx-auto mb-4">
                      This faded back jumbotron is useful for placeholder content. It's also a great way to add a bit of context to a page or section when no content is available and to encourage visitors to take a specific action.
                    </p>
                    <button class="btn btn-warning px-5 mb-5 btn-lg" type="button">
                       Browse events
                    </button>
                </div>

             </div>
            </div>
        </section>


        <section>
            <div class="container my-5">
                <h2 class="fw-bold">EVENTS</h2>
                <div class="row">

                    @foreach ($tickets as $ticket)
                    <div class="col-md-4 my-3">
                        <div>
                            <small>Date: {{$ticket->date}}</small>
                            |
                            <small>Venue: {{$ticket->venue}}</small>
                        </div>
                        <div class="" style="width: auto;">
                            <img src="/storage/img/{{$ticket->event_img}}" class="card-img-top img-thumbnail" alt="...">
                            <div class="card-body my-2">
                              <a href="#" class="card-link h4 text-decoration-none text-danger fw-bold">
                                {{$ticket->name}}
                              </a>
                              <a href="#" class="mx-2 h4 text-decoration-none text-muted fw-bold">
                                N{{$ticket->price}}
                              </a>
                              <a href="{{route('event', $ticket->name)}}" class="btn btn-danger">Buy Ticket</a>
                            </div>
                          </div>
                    </div>
                    @endforeach

                </div>
            </div>
        </section>

    </x-slot>

</x-app>
