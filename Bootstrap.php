<?php
/**
 * ESD Link Configuration
 * @link http://www.kloepper.in
 * @package Plugins
 * @subpackage Frontend
 * @copyright Copyright (c) 2014, shopware AG
 * @author Sebastian Kloepper
 */
class Shopware_Plugins_Frontend_SkEsdLink_Bootstrap extends Shopware_Components_Plugin_Bootstrap
{
	/**
	 * standard install method - subscribe an event
	 * @return bool
	 */
	public function install()
	{		
		$this->subscribeEvent('Enlight_Controller_Action_PostDispatch', 'onPostDispatch');
		
		$form = $this->Form();
		$form->setElement(
			'checkbox', 
			'active', 
			array('label'=>'Download bei kostenlosen Artikeln direkt anzeigen',
			'value'=>'',
			'scope'=> \Shopware\Models\Config\Element::SCOPE_SHOP));
		$form->save();
		
	 	return true;
	}
	
	/**
	 * Returns the version of this plugin
	 *
	 * @return string
	 */
	public function getVersion()
	{
		return '1.0.0';
	}
	
	/**
	 * Define template and variables
	 * @param Enlight_Event_EventArgs $args
	 */
	public function onPostDispatch(Enlight_Event_EventArgs $args)
	{
		$request = $args->getSubject()->Request();
		$response = $args->getSubject()->Response();
		
		$view = $args->getSubject()->View();
		$config = Shopware()->Plugins()->Frontend()->SkEsdLink()->Config();
        if (!$request->isDispatched() || $response->isException() || $request->getModuleName() != 'frontend' || !$view->hasTemplate()) {
             return;
         }
		$view->SkEsdLink = $config;
        $view->addTemplateDir($this->Path() . 'Views/');
		$args->getSubject()->View()->extendsTemplate('frontend/plugins/sk_esdlink/index.tpl');
	}
	
	/**
	 * standard meta description
	 * @return unknown
	 */
	public function getInfo()
    {
		return array(
			'version' => '1.0.0',
			'autor' => 'Sebastian Kloepper',
			'copyright' => 'Copyright © 2014',
			'label' => 'ESD Link Konfiguration',
			'source' => $this->getSource(),
			'description' => 'Erm&ouml;glicht die Definition, dass nach einer Bestellung die kostenlosen ESD-Artikel direkt downgeloadet werden k&ouml;nnen - unabh&auml;ngig vom Zahlungsstatus!',
			'license' => '',
			'support' => 'http://forum.shopware.de',
			'link' => 'http://www.kloepper.in',
			'changes' => array(
				'1.0.1'=>array('releasedate'=>'2014-11-08', 'lines' => array(
					'First release'
				))
			),
		);
    }
}