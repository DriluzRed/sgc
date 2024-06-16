@extends('layouts.app')
@section('main-content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-primary" onclick="window.history.back()">{{__('clients.Cancel')}}</button>
            <h2>{{__('clients.Add Client')}}</h2>
            <form action="{{ route('clients.store') }}" method="POST">
                @csrf
                <div class="form-group
                @error('name')
                    has-error
                @enderror">
                    <label for="name">{{__('clients.Name')}}</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                        <span class="help-block
                        @error('name')
                            text-danger
                        @enderror">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group
                @error('email')
                    has-error
                @enderror">
                    <label for="email">{{__('clients.Email')}}</label>
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                    @error('email')
                        <span class="help-block
                        @error('email')
                            text-danger
                        @enderror">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group
                @error('phone')
                    has-error
                @enderror">
                    <label for="phone">{{__('clients.Phone')}}</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                    @error('phone')
                        <span class="help-block
                        @error('phone')
                            text-danger
                        @enderror">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group
                @error('phone')
                    has-error
                @enderror">
                    <label for="ruc">{{__('clients.RUC')}}</label>
                    <input type="text" class="form-control" id="ruc" name="ruc" value="{{ old('ruc') }}">
                    @error('ruc')
                        <span class="help-block
                        @error('ruc')
                            text-danger
                        @enderror">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">{{__('clients.Save')}}</button>
            </form>
        </div>
    </div>
</div>

@endsection