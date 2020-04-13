<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;
	use App\Coa;

	class CoaController extends Controller
	{
		/**
		 * Display a listing of the resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function index()
		{
			return view('coa.index')->with('coas',Coa::all());
		}

		/**
		 * Show the form for creating a new resource.
		 *
		 * @return \Illuminate\Http\Response
		 */
		public function create()
		{
			return view('coa.create');
		}

		/**
		 * Store a newly created resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @return \Illuminate\Http\Response
		 */
		public function store(Request $request)
		{
		//	dd($request);

			$request->validate([
				'product_name' => 'required',
			]);
			$request->validate([
				'coa_number' => 'required',
			]);
			$request->validate([
				'fileToUpload' => 'required|file|max:1024',
			]);
			$request->validate([
				'coa_number' => 'required',
			]);
			$fileName = mb_ereg_replace("([^\w\s\d\_])", '_', $request->get('coa_number')) . '.' . request()->fileToUpload->getClientOriginalExtension();
			$originalName = request()->fileToUpload->getClientOriginalName();
			$request->fileToUpload->storeAs('', $fileName,'s3');

/*			$path = public_path().'coa_files';
			$uplaod = $originalName->move($path,$fileName);*/

			$coa = new Coa;
			$coa->product_name = $request->get('product_name');
			$coa->coa_number = $request->get('coa_number');
			$coa->coa_name = $fileName;
			$coa->original_name = $originalName;
			$coa->save();

			return redirect('coas');
		}

		/**
		 * Display the specified resource.
		 *
		 * @param  int $id
		 * @return \Illuminate\Http\Response
		 */
		public function show()
		{
			$coas =  Coa:: all();
			dd($coas);
			return view('coa.list')->with('coas', $coas);

		}

        public function download1($coa_name)
        {
            $coa = Coa::find($coa_name);
            return Storage::download('coapath/' . $coa_name);
        }

        public function download($id)
        {
            $coa = Coa::find($id);
            return Storage::download('coapath/' . $coa->coa_name);
        }

		/**
		 * Show the form for editing the specified resource.
		 *
		 * @param  int $id
		 * @return \Illuminate\Http\Response
		 */
		public function edit($id)
		{
			$coa = Coa::find($id);
			return view('coa.edit', compact('coa', 'id'));
		}

		/**
		 * Update the specified resource in storage.
		 *
		 * @param  \Illuminate\Http\Request $request
		 * @param  int $id
		 * @return \Illuminate\Http\Response
		 */
		public function update(Request $request, $id)
		{
			$request->validate([
				'product_name' => 'required',
			]);
			$request->validate([
				'fileToUpload' => 'required|file|max:10240',
			]);
			$request->validate([
				'coa_number' => 'required',
			]);
			$fileName = mb_ereg_replace("([^\w\s\d\_])", '_', $request->get('coa_number')) . '.' . request()->fileToUpload->getClientOriginalExtension();

			$originalName = request()->fileToUpload->getClientOriginalName();
			request()->fileToUpload->storeAs('public', $fileName,'s3');
		//	dd($request);
			$coa = Coa::find($id);
			$coa->product_name = $request->get('product_name');
			$coa->coa_number = $request->get('coa_number');
			$coa->coa_name = $fileName;
			$coa->original_name = $originalName;
			$coa->update();
			return redirect('coas')->with('success', 'You have successfully uploaded file.');
		}

		/**
		 * Remove the specified resource from storage.
		 *
		 * @param  int $id
		 * @return \Illuminate\Http\Response
		 */
		public function destroy($id)
		{
			$coa = Coa::find($id);
			$coa->delete();
			return redirect('coas')->with('success', 'Record' . $id . ' has been deleted');
		}
	}
