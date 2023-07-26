@extends('layouts.app')


@section('content')
    <div class="container-fluid">

        <div class="block-header py-lg-4 py-3">
            <div class="row g-3">
                <div class="col-md-6 col-sm-12">
                    <h2 class="m-0 fs-5"><a href="javascript:void(0);" class="btn btn-sm btn-link ps-0 btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Tickets</h2>
                    <ul class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="index.html">Lucid</a></li>
                        <li class="breadcrumb-item active">Ticket</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row clearfix">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h6 class="card-title">Order Your Ticket</h6>
                    </div>
                    <div class="card-body">
                        <h1> Ticket </h1>

                        <form wire:submit.prevent='store'>
                            <div class="modal-body">
                                {{-- Title --}}
                                <div class="row align-items-end my-2 ">
                                    <div class="col-md">
                                        <label>Title :</label>
                                        <input class="form-control" type="text" wire:model.lazy="title" placeholder="Title" required>

                                        @error('title')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- Description --}}
                                <div class="row align-items-end my-2 ">
                                    <div class="col-md">
                                        <label>Description :</label>
                                        <textarea class="form-control" rows="5" wire:model.lazy="description" placeholder="Description" required></textarea>
                                        
                                        @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                

                            </div>
                            <div class="modal-footer mt-3">
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

