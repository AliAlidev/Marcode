## about aaplication
You are a web developer at the Acme Software Company. You are asked to build a polished
prototype of a GIF browsing app. Since the back-end has not yet been created, you are asked
to get started by using a publicly available API.

## installation steps
- **[Add user management (Register, Login)]()**
- **[Add user authentication blades]()**
- **[Add data models, migrate to database]()**
- **[Edit home blade to support gif searching]()**
- **[Add controller to support gif searching]()**
- **[Add unit tests]()**

## Add user management (Register, Login)

- Add user authentication package **[Fortify]()**

        composer require laravel/fortify

- Migrate to database
  
        php artisan migrate

- Customizing the authentication views
  
        use Laravel\Fortify\Fortify;

        /**
         * Bootstrap any application services.
         *
         * @return void
         */
        public function boot()
        {
            Fortify::loginView(function () {
                return view('auth.login');
            });

            Fortify::registerView(function () {
                return view('auth.register');
            });
        }

## Add user authentication blades
- Login blade
  
        <form action="{{ route('login') }}" method="POST" role="form" id="login-form">
            @csrf
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="email"
                    value="{{ old('email') }}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                    placeholder="Password">
                    @error('password]')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="checkbox form-group">
                <label>
                    <input type="checkbox"> Remember me
                </label>
            </div>
            <button type="submit" class="btn btn-default">Login</button>
        </form>

- Register blade
  
        <form action="{{ route('register') }}" method="POST" role="form">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    id="exampleInputName1" placeholder="Full Name" value="{{ old('name') }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-info">
                        <input type="radio" name="gender" value="Male" value="{{ old('gender') }}"> Male
                    </label>
                    <label class="btn btn-info">
                        <input type="radio" name="gender" value="Female" value="{{ old('gender') }}"> Female
                    </label>
                </div>
            </div>
            <div class="form-group">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    id="exampleInputEmail1" placeholder="Enter email" value="{{ old('email') }}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                    placeholder="Password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword2"
                    placeholder="Re-Password">
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        {{ $message }}
                    </span>
                @enderror
            </div>
            <div class="checkbox form-group">
                <label>
                    <input type="checkbox" name="agreeConditions"> I agree with all terms and conditions.
                </label>
            </div>
            <div>
                <button type="submit" class="btn btn-default">SignUp</button>&nbsp;
                <button type="reset" class="btn btn-default">Reset</button>
            </div>
        </form>

## Add data models, migrate to database
  - Add serach model with migration to support seraching process.

            php artisan make:model Search -m

  - Edit migration file

  - Database migrate

        php artisan migrate         

## Edit home blade to support gif searching

  - Add search form

            <form action="{{ route('search-text') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="string" id="searched_text" name="searched_text" class="form-control autocomplete"
                        placeholder="searched text">
                    @error('searched_text')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="submit" value="search" class="btn btn-primary">
                </div>
            </form>

  - Show results in **show more** way

            <div class="container">
                <div class="default-heading">
                    <!-- heading -->
                    @if (isset($results) && $results['images'] != null)
                        <h4>Showing
                            <div id="image_count">
                                {{ $results['count'] ?? '' }}
                            </div>
                            out of
                            {{ $results['total_count'] ?? '' }}
                        </h4>
                        <div class="row results">
                            @forelse ($results['images'] as $result)
                                <div class="col-md-3 col-sm-3">
                                    <div class="member">
                                        <!-- images -->
                                        <img src={{ $result }} width="200" height="200" alt="Team Member" />
                                    </div>
                                </div>
                            @empty
                                type to search
                            @endforelse
                        </div>

                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-primary" onclick="showMore()">
                                    Show more
                                </button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        
            /* Add script for show more action  */
                <script>
                    let limit = {{ $results['count'] }}          
                    let offset = {{ $results['offset'] }}
                    function showMore() {
                        $.ajax({
                            "url": "{{ route('search-text-ajax') }}",
                            "method": "post",
                            "data": {
                                "_token": "{{ csrf_token() }}",
                                "searched_text": "qwerty",
                                "limit": limit,
                                "offset": offset
                            },
                            success: function(data) {
                                offset += data.count
                                $("#image_count").html(offset + limit);
                                for (let image in data.images) {
                                    console.log(data.images[image]);
                                    document.getElementsByClassName('results')[0].innerHTML += `
                                    <div class="col-md-3 col-sm-3">
                                        <div class="member">
                                            <img src="${data.images[image]}" alt="Team Member" width="200" height="200" />
                                        </div>
                                    </div>
                                    `;
                                }
                            },
                            error: function(err) {
                                console.log(err);
                            }
                        })
                    }
                </script>

## Add controller to support gif searching

        public function searchGifArray(searchRequest $request)
        {
            $request->validated();
    
            search::create([
                'searched_text' => $request->searched_text,
                'user_id' => Auth::user()->id
            ]);
            // request api to git gify
    
            $offset = $request->get("offset", 0);
            $limit = $request->get("limit", 10);
    
            $response = Http::get('http://api.giphy.com/v1/gifs/search', [
                'api_key' => 'UtkmBH2j9kzFZz4cf3FYCr68lCneVp1R',
                'Content-Type' => 'application/json',
                'q' => $request->searched_text,
                'offset' => $offset,
                'limit' => $limit,
            ]);
            $res = [
                "images" => [],
                "total_count" => $response->json()['pagination']['total_count'],
                "count" => $response->json()['pagination']['count'],
                "offset" => $offset
            ];
            foreach ($response->json()['data'] as $key => $value) {
                $res["images"][] = $value['images']['downsized']['url'];
            }
            return $res;
        }