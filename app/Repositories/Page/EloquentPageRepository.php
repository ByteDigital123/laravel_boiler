<?php

namespace App\Repositories\Page;
use Illuminate\Support\Str;
use App\Page;
use App\Http\Resources\PageResource;
use App\Repositories\BaseRepository;
use App\Repositories\Page\PageInterface as PageInterface;


class EloquentPageRepository extends BaseRepository implements PageInterface
{
    public $model;

    // set the protect model to the admin user
    // this will be used in the repository
    function __construct(Page $model) {
        $this->model = $model;
    }

    /**
     * Create something new!
     * @param  array  $attributes [description]
     * @return [type]             [description]
     */
    public function create(array $attributes)
    {

        try{
            $page = $this->model->create([
                'title' => $attributes['title'],
                'blocks' => $attributes['blocks']
            ]);



        } catch(Exception $e){
            return response()->error($e->message);
        }

        return response()->success('Your page has been created');
    }

    /**
     * Update the model
     * @param  [type] $id         [description]
     * @param  array  $attributes [description]
     * @return [type]             [description]
     */
    public function update($id, array $attributes)
    {
        try{

        	$page = $this->model->find($id);

          $page->update($attributes);


        } catch(Exception $e){
            return response()->error($e->message);
        }

        return response()->success('Your page has been updated');
    }

    /**
     * DESTROY ALL HUMANS!!!!
     * @param  array  $attributes [description]
     * @return [type]             [description]
     */
    public function destroy(array $attributes)
    {

    }


}
