@extends('layouts.app')

@section('title')
Users
@endsection

@section('content')

<div class="container">
  <div class="row">
    <div class="col-2">
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            Sorted by
          </div>
        </div>
        <hr>
        <div class="row">
          <div class="col-12">
            <a href="{{ route('admin.users.latest') }}"
              class="{{ request()->route()->named('admin.users.latest') ? 'text-danger' : 'text-dark' }}">Latest</a>
          </div>
        </div>
      </div>
    </div>
    <div class="col-10">

      @include('layouts.success')
      <div class="card-body">
        <div class="row">
          <div class="col-12">
            Users sorted by latest
          </div>
        </div>
        <hr>
        @forelse ($users as $user)
        <div class="card mt-2">
          <div class="card-body">
            <a
              href="/profile/{{ $user->name_slug }}">
              {{ $user->name }}
            </a>
            <span class="float-right">
              <a href="{{ route('admin.user.status',['user' => $user->id,'status' => 'deleted_by_admin']) }}"
                onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle text-danger"></i></a>
            </span>
          </div>
        </div>
        @empty
        <div class="text-center mt-2">
          No Users
        </div>
        @endforelse
      </div>
    </div>

  </div>
</div>
@endsection