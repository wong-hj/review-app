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

        $results = $this->model->findAll();
        
        return view('index', [
            "results" => $results
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


        if(! $file->isValid()) {

            $error_code = $file->getError();

            if($error_code == UPLOAD_ERR_NO_FILE) {

                return redirect()->back()
                                 ->with('info', 'No File Selected')
                                 ->withInput();
            }

            throw new \RuntimeException($file->getErrorString(). "" . $error_code);
        }

        $size = $file->getSizeByUnit('mb');

        if ($size > 5) {
            return redirect()->back()
                             ->with('info', 'File too large (max 2MB)');
        }

        $type = $file->getMimeType();

        if(! in_array($type, ['image/png', 'image/jpeg'])) {

            return redirect()->back()
                             ->with('info', 'Invalid File Format (PNG or JPEG only)');
        }

        $imgName = $file->getRandomName();
        $file->move('../public/images' , $imgName);

        $data['stall_pic'] = $imgName;
        
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
                             ->with('info', 'Nothing to Update')
                             ->withInput();

        }

        if ($this->model->save($review)) {

            return redirect()->to("/review")
                             ->with('info', 'Task Updated Successfully');

        } else {
            return redirect()->back()
                             ->with('errors', $this->model->errors())
                             ->with('info', 'Invalid Data')
                             ->withInput();
        }
    }
    
    public function changePhoto($id){

        $review = $this->model->where('id', $id)
                              ->first();

        return view('changePhoto', [
            'review' => $review
        ]);

    }

    public function updatePhoto($id)
    {
        $file = $this->request->getFile('stall_pic');

        if(! $file->isValid()) {

            $error_code = $file->getError();

            if($error_code == UPLOAD_ERR_NO_FILE) {

                return redirect()->back()
                                 ->with('info', 'No File Selected');
            }

            throw new \RuntimeException($file->getErrorString(). "" . $error_code);
        }

        $size = $file->getSizeByUnit('mb');

        if ($size > 5) {
            return redirect()->back()
                             ->with('info', 'File too large (max 2MB)');
        }

        $type = $file->getMimeType();

        if(! in_array($type, ['image/png', 'image/jpeg'])) {

            return redirect()->back()
                             ->with('info', 'Invalid File Format (PNG or JPEG only)');
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
                                ->with('info', 'Task Deleted Successfully');
        }
    }

    public function search()
    {
        $reviews = $this->model->search($this->request->getGet('q'));


        return $this->response->setJSON($reviews);
    }
}
