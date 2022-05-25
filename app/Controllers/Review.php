<?php

namespace App\Controllers;


use App\Entities\Reviews;

class Review extends BaseController
{
    
    public function __construct() {
        $this->model = new \App\Models\ReviewModel;
    }
    public function index()
    {
        
        $result = $this->model->findAll();
        
        // $post = $_POST['input'] ;
       

        return view('index', [
            "results" => $result
        ]) ;
        
    }

    public function new()
    {
       
        return view('upload', [
            'data' => $this->model
        ]);
    }

    public function upload()
    {
        $data = $this->request->getPost();
       
        $file = $this->request->getFile('stall_pic');

        foreach ($data as $string){
            if(strlen($string) == 0) {
                $error = true;
            } else {
                $error = false;
            }
        }

        if(! $error){

            if((! $file->isValid())) {

                $error_code = $file->getError();
    
                if($error_code == UPLOAD_ERR_NO_FILE) {
    
                    return redirect()->back()
                                     ->with('warning', 'No File Selected')
                                     ->withInput();
                }
    
                throw new \RuntimeException($file->getErrorString(). "" . $error_code);
            }
    
            $size = $file->getSizeByUnit('mb');
    
            if ($size > 5) {
                return redirect()->back()
                                 ->with('warning', 'File too large (max 2MB)');
            }
    
            $type = $file->getMimeType();
    
            if(! in_array($type, ['image/png', 'image/jpeg'])) {
    
                return redirect()->back()
                                 ->with('warning', 'Invalid File Format (PNG or JPEG only)');
            }
    
            $imgName = $file->getRandomName();
            $file->move('../public/images' , $imgName);
            $data['stall_pic'] = $imgName;
    
        }
        
        
        
        if($this->model->insert($data)) {
            return redirect()->to("/review/index")
                             ->with('info', "Review Created Successfully!");
                             
        } else {
            
            return redirect()->back()
                             ->with('errors', $this->model->errors())
                             ->withInput();
        }

    }

    public function edit($id)
    {

        $review = $this->model->where('id', $id)
                              ->first();

        return view('edit', [
            'review' => $review
        ]);
    }

    public function update($id)
    {
        
        $review = $this->model->where('id', $id)
                              ->first();

        $post = $this->request->getPost();
        unset($post['id']);

        $review->fill($post);
        

        if (! $review->hasChanged()) {

            return redirect()->back()
                             ->with('warning', 'Nothing to Update')
                             ->withInput();

        }

        if ($this->model->save($review)) {

            return redirect()->to("/review")
                             ->with('info', 'Task Updated Successfully');

        } else {
            return redirect()->back()
                             ->with('errors', $this->model->errors())
                             ->with('warning', 'Invalid Data')
                             ->withInput();
        }
    }
    

    public function updatePhoto($id)
    {
        $file = $this->request->getFile('stall_pic');

        if(! $file->isValid()) {

            $error_code = $file->getError();

            if($error_code == UPLOAD_ERR_NO_FILE) {

                return redirect()->back()
                                 ->with('warning', 'No File Selected')
                                 ->with('update', 'no_update');
            }

            throw new \RuntimeException($file->getErrorString(). "" . $error_code);
        }

        $size = $file->getSizeByUnit('mb');

        if ($size > 5) {
            return redirect()->back()
                             ->with('warning', 'File too large (max 2MB)');
        }

        $type = $file->getMimeType();

        if(! in_array($type, ['image/png', 'image/jpeg'])) {

            return redirect()->back()
                             ->with('warning', 'Invalid File Format (PNG or JPEG only)');
        }

        $imgName = $file->getRandomName();
        $file->move('../public/images' , $imgName);

        $data = $this->model->where('id', $id)
                              ->first();

        $data->stall_pic = $imgName;

        if($this->model->save($data)) {
            return redirect()->to("/review/show/" . $data->id)
                             ->with('info', 'Task Updated Successfully');
        };

        
    }

    public function show($id)
    {
        $review = $this->model->where('id', $id)
                              ->first();

        return view('show', [

            'review' => $review

        ]);        
    }

    public function delete($id)
    {
        $review = $this->model->where('id', $id)
                              ->first();

        if($this->request->getMethod() === 'post') {


            unlink("../public/images/" . $review->stall_pic);

            $this->model->delete($id);

            

            return redirect()->to("/review/index")
                                ->with('warning', 'Task Deleted Successfully');
        }
    }

    public function search()
    {

        $reviews = $this->model->search($this->request->getGet('q'));

        return $this->response->setJSON($reviews);
    }

}
