@extends('layouts.app')

@section('content')
        <div class="container mx-auto">
            <div class="">
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="/upload/csv1">
                    @csrf
                  <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="gdrive">
                      Google Drive Link
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="gdrive" name="sheets_url" type="text" value="{{ Session::get('sheets_url') ?? old('sheets_url') }}" placeholder="Paste in Google Drive Link">
                  </div>
                  <div class="font-hairline text-center">
                      <h4>or</h4>
                  </div>
                  <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="csv">
                      CSV File
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="csv" name="csv_file" type="file">
                  </div>
                  <div class="flex items-center justify-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                      Upload
                    </button>
                  </div>
                </form>

                


                @if(Session::has('csv'))
                <form action="/upload/csv2" method="post">
                @csrf
                @php $csv = Session::get('csv'); @endphp
                <input type="hidden" name="sheets_url" value="{{ Session::get('sheets_url') ?? old('sheets_url') }}">
                <button class="bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                  Submit
                </button>
                <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                  <h1 class="text-3xl text-bold">Data</h1>
                  <p class="text-lg mb-8">Deselect unwanted rows.</p>
                  <div class="grid-wrapper border">
                    <div class="grid grid-table" style="grid-template-columns: 1fr repeat({{ $csv->getLongestRow() }}, minmax(20%, auto))">
                      @foreach($csv->rows as $id => $row)
                        <label class="inline-flex items-center bg-white sticky left-0">
                          <input type="checkbox" class="form-checkbox h-6 w-6 text-green-400" checked value="{{ $id }}" name="rows[]">
                        </label>
                        @foreach($row as $item)
                          <div><div class="overflow-hidden">{{ $item }}</div></div>
                        @endforeach
                      @endforeach
                    </div>
                  </div>
                </div>  
                </form>
                              
                @endif

                
              </div>
        </div>
@endsection