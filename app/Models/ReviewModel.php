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
            'required' => "Please Fill in the description."
        ],
        'username' => [
            'required' => "Please fill in the username."
        ],
        'restaurant' => [
            'required' => "Please fill in the restaurant name."
        ],
        'rating' => [
            'required' => "Please leave a rating."
        ]
    ];

    public function search($term)
    {
        if($term === null) {

            return [];

        }
        return $this->select('id, description, restaurant')
                    ->like('restaurant', $term) 
                    ->orLike('description', $term)
                    ->get()
                    ->getResultArray();
    }

    
}

?>