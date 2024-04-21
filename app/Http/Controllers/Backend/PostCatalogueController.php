<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePostCatalogueRequest;
use Illuminate\Http\Request;
use App\Services\Interfaces\PostCatalogueServiceInterface as PostCatalogueService;
use App\Http\Requests\StorePostCatalogueRequest;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;


class PostCatalogueController extends Controller
{
    protected $postCatalogueService;
    protected $postCatalogueRespository;
    public function __construct(PostCatalogueService $postCatalogueService
                             , PostCatalogueRepository $postCatalogueRespository)
    {
        $this->postCatalogueService = $postCatalogueService;
        $this->postCatalogueRespository = $postCatalogueRespository;
    }
     
    
    public function index(Request $request){
        $postCatalogues= $this->postCatalogueService->paginate($request);

        $config = [
            'js' =>[
                'backend/js/plugins/switchery/switchery.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
            ],
            'css' =>[
                'backend/css/plugins/switchery/switchery.css',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
        ] ;
        $config['seo'] = config('apps.postcatalogue'); 
        $template='backend.post.catalogue.index';
        return view('backend.dashboard.layout', compact('template', 'config',
         'postCatalogues')) ;
    }
   public function create(){
        $config= $this->configData();
       
        $config['seo'] = config('apps.postcatalogue');
        $config['method'] = 'create';


        $template='backend.post.catalogue.store';
        return view ('backend.dashboard.layout', compact('template', 'config'));
    }
   public function store(StorePostCatalogueRequest $request){
        if($this->postCatalogueService->create( $request)){
            return redirect()->route('post.catalogue.index')->with('success', 'Thêm mới thành công');
        }
        return redirect()->route('post.catalogue.index')->with('error', 'Thêm mới thất bại');
    }
    
    
    public function edit($id){  
        $config= $this->configData();
        $postCatalogue = $this->postCatalogueRespository->findById($id);
        $config['seo'] = config('apps.postcatalogue');
        $config['method'] = 'edit';
        $template='backend.post.catalogue.store';
        return view ('backend.dashboard.layout', compact('template', 'config', 'postCatalogue'));
    }
    /*public function update( $id,UpdatePostCatalogueRequest $request,){
        if($this->postCatalogueService->update( $id, $request)){
            return redirect()->route('post.catalogue.index')->with('success', 'Cập nhật thành công');
        }
        return redirect()->route('post.catalogue.index')->with('error', 'Cập nhật thất bại');
        
        
    }
    */
    
    
    public function delete($id){
        $config['seo'] = config('apps.postcatalogue');
        $postCatalogue = $this->postCatalogueRespository->findById($id);
        $template='backend.post.catalogue.delete';
        return view ('backend.dashboard.layout', compact('template', 'postCatalogue', 'config'));

    }
    public function destroy($id){
        if($this->postCatalogueService->destroy($id)){
            return redirect()->route('post.catalogue.index')->with('success', 'Xóa  thành công');
        }
        return redirect()->route('post.catalogue.index')->with('error', 'Xóa thất bại');
    }
    private function configData(){
        return [
            'js' =>[
                'backend/plugin/ckeditor/ckeditor.js',
                'backend/plugin/ckfinder_2/ckfinder.js',
                'backend/library/finder.js',
                'backend/library/seo.js',
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js'
            ],
            'css' =>[
                'https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css'
            ],
        ];
       
    }
   
}
