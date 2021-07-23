<form action="{{action('HomeController@download1', $coa_name)}}" method="get">
    @csrf
    <button class="inline-block align-middle text-center select-none border font-normal whitespace-no-wrap rounded  no-underline bg-green-500 text-white hover:bg-green-600 py-1 px-2 leading-tight text-xs " type="submit">Download</button>
</form>

