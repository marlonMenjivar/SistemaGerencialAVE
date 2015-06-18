<?php
App::uses('AppModel', 'Model');
/**
 * GoalBranchOffice Model
 *
 * @property BranchOffice $BranchOffice
 */
class GoalBranchOffice extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
        public $validate=array(
            'mes' => array(
                'rule' => 'notEmpty',
                'message' => 'Por favor ingrese un valor monetario válido.'
            ),
            'meta_boletos' => array(
                'rule' => array('money','left'),
                'message' => 'Por favor ingrese un valor monetario válido.'
            ),
            'meta_servicios' => array(
                'rule' => array('money','left'),
                'message' => 'Por favor ingrese un valor monetario válido.'
            ),
            
        );
	public $belongsTo = array(
		'BranchOffice' => array(
			'className' => 'BranchOffice',
			'foreignKey' => 'branch_office_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
