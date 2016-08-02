@extends('layouts.master')

@section('title', 'Trending Quotes')

@section('styles')
  <link rel="stylesheet" href="{{ @url()->to('src/css/font-awesome.min.css') }}">
@endsection

@section('content')

  @if (!empty(Request::segment(1)))
    <div class="col-centered">
      @if ($author_info['quotes'] > 0)
        <div class="alert alert-success">
          Quotes by: {{ $author_info['author'] }}<br><a class="alert-link" href="{{ route('index') }}">Show All Quotes</a>
        </div>
      @else
        <div class="alert alert-danger">
          Quotes by: {{ $author_info['author'] }} - No Quotes found - Showing All Quotes
        </div>
      @endif
    </div>
  @endif

  @if (count($errors) > 0)
    <div class="col-centered">
      <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
          {{ $error }}
        @endforeach
      </div>
    </div>
  @endif

  @if (Session::has('success'))
    <div class="col-centered">
      <div class="alert alert-success">
        {{ Session::get('success') }}
      </div>
    </div>
  @endif

  <section class="quotes">
    <div class="page-header text-center">
      <h1>Latest Quotes</h1>
    </div>

    <?php
      $start = 0;
      $end = 2;
    ?>

    @for ($i = 0; $i < count($quotes); $i++)

          @if ($i === $start)
            <div class="row">
          @endif

          <div class="col-md-4">
            <article class="alert alert-warning alert-dismissable">
              <a class="close" href="{{ route('delete', ['id' => $quotes[$i]->id]) }}"><span>&times;</span></a>
              <blockquote class="quote">
                <p class="text-center">{{ $quotes[$i]->quote }}</p>
                <footer>created by
                  <a href="{{ route('index', ['author' => $quotes[$i]->author->name]) }}" class="text-muted">{{ $quotes[$i]->author->name }}</a>
                  <span class=""> on {{ $quotes[$i]->created_at }}</span>
                </footer>
              </blockquote>
            </article>
          </div>

          @if ($i === $end || $i == count($quotes) - 1)
            </div>
            <?php $start+=3; $end+=3; ?>
          @endif

    @endfor

    <div class="col-centered">
      <div class="pagination">
        @if ($quotes->currentPage() !== 1)
          <a href="{{ $quotes->previousPageUrl() }}"><span class="fa fa-caret-left"></span></a>
        @endif

        @if (($quotes->currentPage() !== $quotes->lastPage()) && $quotes->hasPages())
            <a href="{{ $quotes->nextPageUrl() }}"><span class="fa fa-caret-right"></span></a>
        @endif
      </div>
    </div>
  </section>
  <section class="edit-quote text-center">
    <h1>Add a Quote</h1>
    <form action="{{ route('create') }}" method="post" class="col-sm-12">
      <div class="col-sm-6 col-centered">
        <div class="form-group row">
          <div class="col-sm-8 col-centered">
            <label for="author" class="control-label">Your Name</label>
            <input type="text" class="form-control col-sm-6" name="author" id="author" placeholder="Your Name">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-8 col-centered">
            <label for="email" class="control-label">Your Email</label>
            <input type="text" class="form-control col-sm-6" name="email" id="email" placeholder="Your Email">
          </div>
        </div>
        <div class="form-group row">
          <label for="quote" class="control-label">Your Quote</label>
          <textarea name="quote" id="quote" rows="6" class="form-control" placeholder="Your Quote"></textarea>
        </div>
        <div class="form-group row">
          <input type="hidden" name="_token" value="{{ Session::token() }}">
          <button type="submit" class="btn btn-primary btn-lg">SEND</button>
        </div>
      </div>
    </form>
  </section>
@endsection