<?php

namespace App\Services;
use App\Services\Interfaces\PostCatalogueServiceInterface;
use App\Repositories\Interfaces\PostCatalogueRepositoryInterface as PostCatalogueRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Termwind\Components\Hr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;


/**
 * Class UserCatalogueService
 * @package App\Services
 */
class PostCatalogueService  implements PostCatalogueServiceInterface
{
    protected $postCatalogueRepository;
    
    public function __construct(PostCatalogueRepository $postCatalogueRepository)
    {
        $this->postCatalogueRepository = $postCatalogueRepository;
    }
    public function paginate($request)
    { 
        $condition['keyword']= addslashes($request->input('keyword'));
        $condition['publish']= $request->integer('publish');
        $perPage= $request->integer('perpage') ;
        
        $postCatalogues = $this->postCatalogueRepository->pagination
        ($this->paginateSelect(),$condition, [],['path'=>'PostCatalogue/index'], 
        $perPage,[]
    );
        return $postCatalogues;
    }
    public function create( $request)
    {
        DB::beginTransaction();
        try {
            $payload=$request->except(['_token', 'send']);
            $payload['user_id']=Auth::id();
            $postCatalogue=$this->postCatalogueRepository->create($payload);        
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die() ;
            return false;
        }
        
    }
    public function update( $id, $request)
    {   
        DB::beginTransaction();
        try {
            $payload=$request->except(['_token','send']);
            $postCatalogue=$this->postCatalogueRepository->update($id,$payload);        
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die() ;
            return false;
        }
        
    }
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $postCatalogue=$this->postCatalogueRepository->delete($id);        
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die() ;
            return false;
        }
    }
    public function updateStatus($post=[]){
        DB::beginTransaction();
        try {
            $payload[$post['field']] = (($post['value'] == 1) ? 2 : 1);
            $postCatalogue= $this->postCatalogueRepository->update($post['modelId'],$payload); 
           // $this->changeUserStatus($post, $payload[$post['field']] );
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die() ;
            return false;
        }
        
    }
    public function updateStatusAll($post){
        DB::beginTransaction();
        try {
            $payload[$post['field']] =$post['value'];
            $flag = $this->postCatalogueRepository->updateByWhereIn('id',$post['id'],$payload); 
           // $this->changeUserStatus($post, $post['value'] );
            
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die() ;
            return false;
        }
        
    }
  /*  private function changeUserStatus($post,$value){
        
        DB::beginTransaction();
        try {
            $array=[];
            if(isset($post['modelId'])){
                $array[]= $post['modelId'] ; 
            }else{
                $array= $post['id'];
            }
            $payload[$post['field']] = $value ;
            $this->languageRepository->updateByWhereIn('user_catalogue_id',$array,$payload);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();die() ;
            return false;
        }
    }
    */
   
    
    private function paginateSelect(){
        return ['id','name','canonical','publish','image'];

    }


}
