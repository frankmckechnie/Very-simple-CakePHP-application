<?php
class Post extends AppModel {
	var $name = 'Post';
	var $validate = array(
		'title' => array(
    		 'rule' => 'notEmpty'
		),
		'submittedfile' => array(
			'isUploadedFile' => array(
            	'rule' => array('isUploadedFile'), // Is a function below
            	'message' => 'Error uploading file'
            )
		),
		'file_size' => array(
			'numeric' => array(
				'rule' => 'numeric',
				'required' => false
			)
		),
		'user_id' => array(
			'numeric' => array(
				'rule' => 'numeric',
				
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		)
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Comment' => array(
			'className' => 'Comment',
			'foreignKey' => 'post_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	public function isUploadedFile($params) {
	    $val = array_shift($params);
	    if ((isset($val['error']) && $val['error'] == 0) ||
	        (!empty( $val['tmp_name']) && $val['tmp_name'] != 'none')
	    ) {
	        return is_uploaded_file($val['tmp_name']);
	    }
	    return false;
	}

}
?>