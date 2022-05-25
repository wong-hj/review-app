<?php 

namespace App\Models;

class ReviewModel extends \CodeIgniter\Model
{
    protected $table = 'review';
    protected $allowedFields = ['username', 'rating', 'restaurant', 'description', 'stall_pic'];

    
    // set validation rules for description input to be required.
    protected $validationRules = [
        'description' => 'required',
        'username' => 'required',
        'restaurant' => 'required',
        'rating' => 'required'
        
    ];

    protected $returnType = "App\Entities\Reviews";

    // set custom error message.
    protected $validationMessages = [
        'description' => [
            'required' => "Please Fill in the Description."
        ],
        'username' => [
            'required' => "Please fill in the Name."
        ],
        'restaurant' => [
            'required' => "Please fill in the Restaurant."
        ],
        'rating' => [
            'required' => "Please leave a Rating."     
        ]
    ];

    protected $useTimestamps = true;

    public function search($term)
    {
        if($term === null) {

            return [];

        }


        return $this->select('*')
                    ->like('restaurant', $term) 
                    ->orLike('description', $term)
                    ->get()
                    ->getResultArray();
    }

}

?>