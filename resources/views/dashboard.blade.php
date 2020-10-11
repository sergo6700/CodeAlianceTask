<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    @if(Auth::user()->role == 'client')
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <x-jet-validation-errors class="mb-4"/>
                            @if(session()->has('message'))
                                <div class="alert alert-success">
                                    {{ session()->get('message') }}
                                </div>
                            @endif
                            <form method="POST" action="{{route('create')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <!-- subject -->
                                            <div class="col-span-6 sm:col-span-4">
                                                <label class="block font-medium text-sm text-gray-700" for="name">
                                                    Subject
                                                </label>
                                                <input class="form-input rounded-md shadow-sm mt-1 block w-full"
                                                       id="subject"  name="subject" type="text" autocomplete="subject">
                                            </div>
                                            <!-- subject -->
                                            <div class="col-span-6 sm:col-span-4">
                                                <label class="block font-medium text-sm text-gray-700" for="message">
                                                    Message
                                                </label>
                                                <textarea class="form-input rounded-md shadow-sm mt-1 block w-full"
                                                          name="message" id="message"></textarea>
                                            </div>
                                            <!-- file -->
                                            <div class="col-span-6 sm:col-span-4">
                                                <label class="block font-medium text-sm text-gray-700" for="file">
                                                    File
                                                </label>

                                                <input class="form-input rounded-md shadow-sm mt-1 block w-full"
                                                       name="file" id="file" type="file">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                        <button type="submit"
                                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150"
                                                wire:loading.attr="disabled" wire:target="photo">
                                            Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    @elseif(Auth::user()->role == 'manager')
                        <div class="container">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">*</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Subject</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">File</th>
                                    <th scope="col">Created</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($requests as $request)
                                    <tr>
                                        <th scope="row">{{$request->id}}</th>
                                        <th scope="row"><input type="checkbox" @if($request->status == 1) checked="checked" @endif name="status" data-id="{{$request->id}}" id=""></th>
                                        <td>{{$request->user->name}}</td>
                                        <td>{{$request->user->email}}</td>
                                        <td>{{$request->subject}}</td>
                                        <td>{!! $request->message !!}</td>
                                        <td><a href="{{ asset($request->file) }}" target="_blank">See File</a></td>
                                        <td>{{$request->created_at}}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $requests->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @push('script')
        <script src="{{asset('js/custom/changeStatus.js')}}"></script>
    @endpush
</x-app-layout>
