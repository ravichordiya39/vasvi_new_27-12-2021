<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Http\Requests\MassDestroySliderRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Models\HomeBestSeller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Response;

use App\Models\NewArrivalBanner;
use App\Models\BestSellerBanner;
use App\Models\LatestBanner;

use App\Models\Slider;

class SliderController extends Controller
{
    use FileUploadTrait;

    public function index(Request $request)
    {
        // abort_if(Gate::denies('slider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Slider::query()->select(sprintf('%s.*', (new Slider())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'slider_show';
                $editGate = 'slider_edit';
                $deleteGate = 'slider_delete';
                $crudRoutePart = 'sliders';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                $id =  $row->id ? $row->id : '';
                return '<div class="text-center"><span class="text-dark">'.$id.'</span></div>';
            });
            $table->editColumn('title', function ($row) {
                $title =  $row->title ? $row->title : '';
                return '<div class="text-center"><span class="badge badge-dark p-2">'.$title.'</span></div>';
            });
            $table->editColumn('image', function ($row) {

                if ($photo = $row->photo) {
                    return sprintf(
                        '<div class="text-center"><a href="%s" target="_blank"><img src="%s" width="50px" height="50px" style="border : 2px solid lightgray; border-radius : 5px;"></a></div>',
                        $photo->url,
                        $photo->thumb
                    );
                }

                return '';
            });
            $table->editColumn('status', function ($row) {
                $status =  $row->status ? Slider::STATUS_SELECT[$row->status] : '';
                $is_attribute = $status === 'Active' ? 'checked' : '';
                return '<div class="text-center">
                            <label class="switch">
                                <input type="checkbox" '.$is_attribute.' id="is-attribute-chk" data-id="'.$row->id.'">
                                <span class="slider round"></span>
                            </label>
                        </div>';
            });

            $table->rawColumns(['actions', 'placeholder', 'image','id','title','status']);

            return $table->make(true);
        }

        return view('admin.sliders.index');
    }

    public function create()
    {
        // abort_if(Gate::denies('slider_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sliders.create');
    }

    public function homeBestsellerBanners(){
        // abort_if(Gate::denies('slider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $bestsellers=HomeBestSeller::where('type',0)->get();
        $arrivals=HomeBestSeller::where('type',1)->get();
        $exc=HomeBestSeller::where('type',2)->first();
        return view('admin.banners.bestseller',compact('bestsellers','arrivals','exc'));
    }

    public function homeBestsellerBannersEdit($id){
        // abort_if(Gate::denies('slider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $banner=HomeBestSeller::find($id);
        return view('admin.banners.bestselleredit',compact('banner'));
    }

    public function homeNewArrivalsEdit($id){
        // abort_if(Gate::denies('slider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $banner=HomeBestSeller::find($id);
        return view('admin.banners.newarrivalsedit',compact('banner'));
    }

    public function homeExclusivesEdit($id){
        // abort_if(Gate::denies('slider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $banner=HomeBestSeller::find($id);
        return view('admin.banners.exclusiveedit',compact('banner'));
    }

    public function homeBestsellerBannersUpdate(Request $request,$id){
        // abort_if(Gate::denies('slider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $banner=HomeBestSeller::find($id);
        $this->validate($request, [
            'image' => 'required'
       ]);
        // $newvalue=$request->image;
        // if ($request->image != null && isset($request->image)) {
        //     $imagepath            = time().$newvalue->getClientOriginalName();
        //     $path               = 'storage/bannerimages/';
        //     $upload             = $newvalue->move($path, $imagepath);
        //     $banner->update([
        //     'image'=>$imagepath,
        //     'link'=>$request->link
        //     ]);
        // }
        // $banner->update([
        //     'link'=>$request->link
        //     ]);

        $banner->update([
            'image' => $request->image,
            'link' => $request->link,
        ]);

        return redirect()->route('admin.home.banners.index');
    }

    public function homeNewArrivalUpdate(Request $request,$id){
        // abort_if(Gate::denies('slider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $banner=HomeBestSeller::find($id);
        $this->validate($request, [
            // 'image' => 'dimensions:min_width=340,max_width=790|mimes:jpeg,jpg,png,gif'
            'image' => 'required'
       ]);
        // $newvalue=$request->image;
        // if ($request->image != null && isset($request->image)) {
        //     $imagepath            = time().$newvalue->getClientOriginalName();
        //     $path               = 'storage/bannerimages/';
        //     $upload             = $newvalue->move($path, $imagepath);
        //     $banner->update([
        //     'image'=>$imagepath,
        //     'link'=>$request->link
        //     ]);
        // }
        // $banner->update([
        //     'link'=>$request->link
        //     ]);

        $banner->update([
            'image' => $request->image,
            'link' => $request->link,
        ]);

        return redirect()->route('admin.home.banners.index');
    }
    public function homeExclusiveUpdate(Request $request,$id){
        // abort_if(Gate::denies('slider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $banner=HomeBestSeller::find($id);
        $this->validate($request, [
            'image' => 'required'
       ]);
        // $newvalue=$request->image;
        // if ($request->image != null && isset($request->image)) {
        //     $imagepath            = time().$newvalue->getClientOriginalName();
        //     $path               = 'storage/bannerimages/';
        //     $upload             = $newvalue->move($path, $imagepath);
        //     $banner->update([
        //     'image'=>$imagepath,
        //     'link'=>$request->link
        //     ]);
        // }
        // $banner->update([
        //     'link'=>$request->link
        //     ]);

        $banner->update([
            'image' => $request->image,
            'link' => $request->link,
        ]);

        return redirect()->route('admin.home.banners.index');
    }

    public function store(StoreSliderRequest $request)
    {
        // $request = $this->imageUpload($request, 'slider');

        Slider::create($request->all());

        return redirect()->route('admin.sliders.index');
    }

    public function edit(Slider $slider)
    {
        // abort_if(Gate::denies('slider_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        // $request = $this->imageUpload($request, 'slider');
        $slider->update($request->all());


        // if ($request->input('image', false)) {
        //     if (!$slider->image || $request->input('image') !== $slider->image->file_name) {
        //         if ($slider->image) {
        //             $slider->image->delete();
        //         }
        //         $slider->addMedia(storage_path('tmp/uploads/' . basename($request->input('image'))))->toMediaCollection('image');
        //     }
        // } elseif ($slider->image) {
        //     $slider->image->delete();
        // }

        return redirect()->route('admin.sliders.index');
    }

    public function show(Slider $slider)
    {
        // abort_if(Gate::denies('slider_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.sliders.show', compact('slider'));
    }

    public function destroy(Slider $slider)
    {
        // abort_if(Gate::denies('slider_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $slider->delete();

        return back();
    }

    public function massDestroy(MassDestroySliderRequest $request)
    {
        Slider::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        // abort_if(Gate::denies('slider_create') && Gate::denies('slider_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Slider();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }


    public function update_status(Request $request)
    {
        $id = $request->id;
        $status = $request->status;

        $slider = Slider::find($id);
        $slider->status = $status;
        $slider->save();

        if($slider->id)
            return response()->json(['code' => 200, 'success' => true, 'message' => 'Status updated successfully.']);
        else
            return response()->json(['code' => 503, 'success' => false, 'message' => 'Status updation failed.']);
    }

    public function new_arrival_banner(Request $request)
    {
        $banners = NewArrivalBanner::all();
        return view('admin.newarrivals.index', compact('banners'));
    }


    public function new_arrival_banner_edit(Request $request, $id)
    {
        $banner = NewArrivalBanner::find($id);
        return view('admin.newarrivals.edit', compact('banner'));
    }


    public function new_arrival_banner_update(Request $request,$id)
    {
        // abort_if(Gate::denies('slider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $banner=NewArrivalBanner::find($id);
        $this->validate($request, [
            'image' => 'required'
        ]);


        $banner->update([
            'image' => $request->image,
            'link' => $request->link,
        ]);

        return redirect()->route('admin.newarrivalbanners.index')->with('success','Banner updated successfully');
    }


    public function best_seller_banner(Request $request)
    {
        $banners = BestSellerBanner::all();
        return view('admin.bestsellers.index', compact('banners'));
    }


    public function best_seller_banner_edit(Request $request, $id)
    {
        $banner = BestSellerBanner::find($id);
        return view('admin.bestsellers.edit', compact('banner'));
    }


    public function best_seller_banner_update(Request $request,$id)
    {
        // abort_if(Gate::denies('slider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $banner=BestSellerBanner::find($id);
        $this->validate($request, [
            'image' => 'required'
        ]);


        $banner->update([
            'image' => $request->image,
            'link' => $request->link,
        ]);

        return redirect()->route('admin.bestsellerbanners.index')->with('success','Banner updated successfully');
    }


    public function latest_banner(Request $request)
    {
        $banners = LatestBanner::all();
        return view('admin.latestbanners.index', compact('banners'));
    }


    public function latest_banner_edit(Request $request, $id)
    {
        $banner = LatestBanner::find($id);
        return view('admin.latestbanners.edit', compact('banner'));
    }


    public function latest_banner_update(Request $request,$id)
    {
        // abort_if(Gate::denies('slider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $banner=LatestBanner::find($id);
        $this->validate($request, [
            'image' => 'required'
        ]);


        $banner->update([
            'image' => $request->image,
            'link' => $request->link,
        ]);

        return redirect()->route('admin.latestbanners.index')->with('success','Banner updated successfully');
    }

}
