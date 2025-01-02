        <div class ="wrapper">
            {{-- Navigation --}}
                <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #a9a9a9;">
                    <div class="container">
                    
                  <a class="navbar-brand" href="{{ url('/')}}"><h2><b>Travel-mate</b></h2></a>
                  
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>



                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                      @if (Route::has('login'))
                        @auth
                          <li class="nav-item active">
                            <a class="nav-link" href="{{ url('/home') }}">Home <span class="sr-only">(current)</span></a>
                          </li>
                        @else
                          <li class="nav-item active">
                            <a class="nav-link" href="{{ route('login') }}">Login</span></a>
                          </li>

                          @if (Route::has('register'))
                            <li class="nav-item active">
                              <a class="nav-link" href="{{ route('register') }}">Register</span></a>
                            </li>
                          @endif
                        @endauth
                      @endif
                    </ul>
                    <!--
                    <form class="form-inline my-2 my-lg-0">
                        <div class="input-group mb-3">
                              <input type="text" class="form-control" placeholder="Search your location " aria-label="Search your " aria-describedby="button-addon2">
                              <div class="input-group-append">
                                <button class="btn btn-outline-secondary" type="button" id="button-addon2"><i class="fa fa-search">Search</i></button>
                              </div>
                        </div>
                    </form>
                    -->
                  </div>
                </div>
                </nav>

        </div>
        
        <!--end navigation part-->