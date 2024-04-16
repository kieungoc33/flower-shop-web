<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserCatalogueServiceInterface as UserCatalogueService;
use App\Http\Requests\StoreUserCatalogueRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;


class UserCatalogueController extends Controller
{
    protected $userCatalogueService;
    protected $userCatalogueRespository;
    public function __construct(UserCatalogueService $userCatalogueService, UserCatalogueRepository $userCatalogueRespository)
    {
        $this->userCatalogueService = $userCatalogueService;
        $this->userCatalogueRespository = $userCatalogueRespository;
    }
     
    
    public function index(Request $request){
        $userCatalogues= $this->userCatalogueService->paginate($request);

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
        $config['seo'] = config('apps.usercatalogue'); 
        $template='backend.user.catalogue.index';
        return view('backend.dashboard.layout', compact('template', 'config',
         'userCatalogues')) ;
    }
   public function create(){
       
        $config['seo'] = config('apps.usercatalogue');
        $config['method'] = 'create';


        $template='backend.user.catalogue.store';
        return view ('backend.dashboard.layout', compact('template', 'config'));
    }
    public function store(StoreUserCatalogueRequest $request){
        if($this->userCatalogueService->create( $request)){
            return redirect()->route('user.catalogue.index')->with('success', 'Thêm mới thành công');
        }
        return redirect()->route('user.catalogue.index')->with('error', 'Thêm mới thất bại');
    }
    public function edit($id){  
        $userCatalogue = $this->userCatalogueRespository->findById($id);
    
        $config['seo'] = config('apps.usercatalogue');
        $config['method'] = 'edit';


        $template='backend.user.catalogue.store';
        return view ('backend.dashboard.layout', compact('template', 'config', 'userCatalogue'));
    }
    public function update( $id,StoreUserCatalogueRequest $request,){
        if($this->userCatalogueService->update( $id, $request)){
            return redirect()->route('user.catalogue.index')->with('success', 'Cập nhật thành công');
        }
        return redirect()->route('user.catalogue.index')->with('error', 'Cập nhật thất bại');
        
        
    }
    public function delete($id){
        $config['seo'] = config('apps.usercatalogue');
        $userCatalogue = $this->userCatalogueRespository->findById($id);
        $template='backend.user.catalogue.delete';
        return view ('backend.dashboard.layout', compact('template', 'userCatalogue', 'config'));

    }
    public function destroy($id){
        if($this->userCatalogueService->destroy($id)){
            return redirect()->route('user.catalogue.index')->with('success', 'Xóa  thành công');
        }
        return redirect()->route('user.catalogue.index')->with('error', 'Xóa thất bại');
    }
    
   
}
