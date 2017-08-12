@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Session::has('success'))
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                    <div id="charge-massage" class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                </div>
            </div>
        @endif
        @if(Session::has('error'))
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4 col-sm-offset-3">
                    <div id="charge-massage" class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="row">
            @forelse ($posts as $post)
                <div class="col-sm-6 col-md-3 float">
                    <div class="thumbnail products">
                        <img src="{{ asset(''. $post->image .'') }}" alt="product Title" class="img-responsive" style=" height: 142px; width: 100%; ">
                        <div class="caption">
                            <h3>{{ unserialize($post->title)[LaravelLocalization::getCurrentLocale()] }}</h3>
                            <p class="desc">
                                {{ unserialize($post->body)[LaravelLocalization::getCurrentLocale()] }}
                            </p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-danger">No Results</div>
            @endforelse
        </div>
        <div class="row">
            <div class="col-md-6 col-md-offset-5">
                <div class="pagination">
                    {{ $posts->render() }}
                </div>
            </div>
        </div>
        <div class="row">
            <form action="{{ url('/posts/store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="row">
                        @foreach (LaravelLocalization::getSupportedLocales() as $key => $value)
                            <div class="col-md-6">
                          <div class="form-group">
                              <label for="title">title</label>
                              <input type="text" class="form-control"  name="title[{{ $key }}]" id="title" placeholder="{{ trans('main.title') }}{{ $value['native'] }}">
                          </div>

                          <div class="form-group">
                              <label for="body">Body</label>
                              <textarea type="text" class="form-control" name="body[{{ $key }}]" rows="10" col="50" id="body" placeholder="{{ trans('main.body') }}{{ $value['native'] }}"></textarea>
                          </div>

                      </div>
                        @endforeach
                    </div>
                    <div class="form-group">
                        <label for="image">image</label>
                        <input type="file" class="form-control"  name="image" id="image">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success float">Add Post</button>
                    </div>
                    <br>
                    <br>
                    <br>

            </form>
        </div>
    </div>
@endsection
