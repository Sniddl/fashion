@extends('layouts.app')

@section('content')
        <div class="container mx-auto">
            <div class="">
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="POST" action="/upload/csv">
                    @csrf
                  <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="gdrive">
                      Google Drive Link
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="gdrive" type="text" placeholder="Paste in Google Drive Link">
                  </div>
                  <div class="font-hairline text-center">
                      <h4>or</h4>
                  </div>
                  <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="csv">
                      CSV File
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="csv" type="file">
                  </div>
                  <div class="flex items-center justify-center">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="button">
                      Upload
                    </button>
                  </div>
                </form>

                <div class="overflow-x-auto">
                    <table class="table-auto bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                        <tbody>
                          <tr>
                            <td class="sticky-column border px-4 py-2 pl-8"><input type="checkbox" /></td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                          </tr>
                          <tr class="bg-gray-100">
                            <td class="sticky-column border px-4 py-2 pl-8"><input type="checkbox" /></td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                          </tr>
                          <tr>
                            <td class="sticky-column border px-4 py-2 pl-8"><input type="checkbox" /></td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                            <td class="border px-4 py-2">placeholder</td>
                          </tr>
                        </tbody>
                      </table>
                </div>
              </div>
        </div>
@endsection