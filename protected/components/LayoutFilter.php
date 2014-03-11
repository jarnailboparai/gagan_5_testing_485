<?php

class LayoutFilter extends CFilter {

    protected function preFilter($filterChain) {
        // logic being applied before the action is executed
        if (Yii::app()->user->isGuest) {
            $filterChain->controller->layout = '//layouts/guest';
        } else {
            $role = Yii::app()->user->getState('roles');
            if (in_array(User::ROLE_ADMIN, $role) ) {
                Yii::app()->theme = '';
                $filterChain->controller->layout = '//layouts/column2';
            } else{
                $filterChain->controller->layout = '//layouts/column1';
            }
        }
		
        return parent::preFilter($filterChain);
    }

    protected function postFilter($filterChain) {
        // logic being applied after the action is executed
        return parent::postFilter($filterChain);
    }
}
?>
