<?php
namespace App\Http\Traits;

trait CRUD
{
    /**
     * Get all
     * 
     * @return Eloquent
     */
    public function getAll( )
    {
        return $this->model->all();
    }

    /**
     * Get by id
     * 
     * @param Int $id
     * @return Eloquent
     */
    public function getById( $id )
    {
        return $this->model->find( $id );
    }
    
    /**
     * Get by id
     * 
     * @param array $data
     * @return Eloquent
     */
    public function getByData( $data )
    {
        return $this->model->where($data)->get();
    }
    
    /**
     * Update By Id
     * 
     * @param array $data
     * @param Int $id
     */
    public function updateById( $id, $data )
    {
        if($model = $this->getById($id))
            return $model->update($data);
        return false ;
    }
    
    /**
     * Delete By Id
     * 
     * @param Int $id
     * @return Eloquent
     */
    public function deleteById( $id )
    {
        if( $model = $this->getById($id) )
            return $model->delete();
        return false;
    }
    
    /**
     * Create 
     * 
     * @param array $data
     * @return 
     */
    public function create($data)
     {
      return $this->model->create($data);
     }
}
