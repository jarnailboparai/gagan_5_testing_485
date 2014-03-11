<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
        
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();
        
        public function filters() {
            return array(
                // array('application.modules.rights.components.RightsFilter'),
                'rights',
                array('application.components.LayoutFilter'),
            );
        }

                /**
         * The filter method for 'rights' access filter.
         * This filter is a wrapper of {@link CAccessControlFilter}.
         * @param CFilterChain $filterChain the filter chain that the filter is on.
         */
        public function filterRights($filterChain) {

            $filter = new RightsFilter;						
            $filter->allowedActions = $this->allowedActions();
            $filter->filter($filterChain);			
        }

        /**
         * @return string the actions that are always allowed separated by commas.
         */
        public function allowedActions() {
            return 'login,logout'; 
        }

        /**
         * Denies the access of the user.
         * @param string $message the message to display to the user.
         * This method may be invoked when access check fails.
         * @throws CHttpException when called unless login is required.
         */
        public function accessDenied($message=null) {
            if ($message === null)
                $message = Rights::t('core', 'You are not authorized to perform this action.');

            $user = Yii::app()->getUser();
            if ($user->isGuest === true) {
                $this->redirect(array('/'));
            }

            else
                throw new CHttpException(403, $message);
        }
        
}
