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
							<div class="form-group col-md-3">
								<select name="users" class="form-control form-control-lg" placeholder="Users">
									@foreach ($search_users as $user)
										<option value="{{ $user->id }}">{{ $user->name }}</option>
									@endforeach
								</select>
								<p class="help-block"></p>
								@if($errors->has('users'))
									<p class="help-block">
										{{ $errors->first('users') }}
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
<!--===================================
=            Store Section            =
====================================-->
<section class="section bg-gray">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<!-- Left sidebar -->
			<div class="col-md-8">
				<div class="product-details">
					<h1 class="product-title">{{ $section->name }}</h1>
					<div class="product-meta">
						<ul class="list-inline">
                            @foreach ($section->users as $singleSections)
                                <li class="list-inline-item"><i class="fa fa-folder-open-o"></i> Users<a href="{{ route('user', [$singleSections->id]) }}">
                                        <span class="label label-info label-many">{{ $singleSections->name }}</span>
                                </a></li>
                            @endforeach
							<li class="list-inline-item"><i class="fa fa-location-arrow"></i> Location<a href="{{ route('search', ['city_id' => $section->city->id]) }}">{{ $section->city->name }}</a></li>
						</ul>
					</div>
                    <br>
                    <div class="col-md-4">
                        @if($section->logo)
							<a href="{{ $section->logo->getUrl() }}" target="_blank">
								<img src="{{ $section->logo->getUrl() }}" width="200">
							</a>
						@endif
                    </div>
					<div class="content">
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								<h3 class="tab-title">About section</h3>
								<p>{{ $section->description}}</p>
							</div>
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								<h3 class="tab-title">Where to find</h3>
								<p>{{ $section->address}}</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="sidebar">
					<!-- User Profile widget -->
					<div class="widget user">
						<h4>Other sections in this user</h4>
                        @foreach ($section->users as $singleSections)
                            @foreach ($singleSections->sections->shuffle()->take(10) as $singleSection)
                            <li><a href="{{ route('section', [$singleSection->id]) }}">{{ $singleSection->name }}</a></li>
                            @endforeach
                        @endforeach
					</div>
					<!-- Map Widget -->
				</div>
			</div>

		</div>
	</div>
	<!-- Container End -->
</section>

@stop
