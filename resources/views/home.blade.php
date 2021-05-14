@extends('Layouts.app')

@section('content')
    <br>

    <!-- our customer -->
    <div class="team" id="customer">
        <div class="container">
            <div class="default-heading">
                <!-- heading -->
                <h2>Search</h2>
            </div>
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

            <br>
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

        </div>
    </div>
    <!-- end our customer -->

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


    <!-- Script -->
    @push('js-stack')

        <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/css/bootstrap.css" rel="stylesheet" />
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-bootstrap/0.5pre/css/custom-theme/jquery-ui-1.10.0.custom.css"
            rel="stylesheet" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/css/bootstrap.css" rel="stylesheet" />


        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    @endpush


    <script type="text/javascript">
        $(document).ready(function() {

            $("#searched_text").autocomplete({
                source: function(request, response) {
                    // Fetch data
                    $.ajax({
                        url: "{{ route('getAutocomplete') }}",
                        type: 'post',
                        dataType: "json",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            search: request
                        },
                        success: function(data) {
                            response(data);
                        },
                        error: function(err) {
                            console.log(err);
                        }
                    });
                },
                select: function(event, ui) {
                    $('#searched_text').val(ui.item.value);
                    return false;
                }
            });

        });

    </script>

@endsection
