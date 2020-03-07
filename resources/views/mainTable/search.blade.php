@extends('layouts.mainTable')

@section('content')


<section class="page-search">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Advance Search -->
				<div class="advance-search">
                    <form action="{{ route('search') }}" method="GET">

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <input type="text" name="search" value="{{ old('search') }}" class="form-control" placeholder="Search section" />
                                <p class="help-block"></p>
                                @if($errors->has('name'))
                                    <p class="help-block">
                                        {{ $errors->first('name') }}
                                    </p>
                                @endif
                            </div>
                            <div class="form-group col-md-2">
                                <button type="submit"
                                        class="btn btn-main">
                                    Search Now
                                </button>
                            </div>
                        </div>

                    </form>

				</div>
			</div>
		</div>
	</div>
</section>

<section class="section-sm">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="search-result bg-gray">
					<h2>Results</h2>
					<p>{{ $section->count() }} Results</p>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">

			</div>
            <div class="col-md-9">
				<div class="product-grid-list">
					<div class="row mt-30">
                        @if (count($section) > 0)
                            @foreach ($section as $section)
                                <div class="col-sm-12 col-lg-4 col-md-6">

                                    <!-- product card -->

                                    <div class="product-item bg-light">
                                        <div class="card">
                                            <div class="thumb-content">
                                                @if($section->logo)<a href="{{ route('section', [$section->id]) }}"><img class="card-img-top img-fluid" src="{{ asset(env('UPLOAD_PATH').'/thumb/' . $section->logo) }}"/></a>@endif
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title"><a href="{{ route('section', [$section->id]) }}">{{$section->name}}</a></h4>
                                                @foreach ($section->users as $singleUsers)
                                                    <ul class="list-inline product-meta">
                                                        <li class="list-inline-item">
                                                            <a href="{{ route('user', [$singleUsers->id]) }}"><i class="fa fa-folder-open-o"></i>{{ $singleUsers->name }}</a>
                                                        </li>
                                                    </ul>
                                                @endforeach
                                                <p class="card-text">{{ substr($section->description, 0, 100) }}...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
				</div>
            {{ $section->appends(request()->all())->links() }}
			</div>
		</div>
	</div>
</section>


@stop
