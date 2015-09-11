<?php

/*
 *  This file is part of the Quantum Unit Solutions development package.
 * 
 *  (c) Quantum Unit Solutions <http://github.com/dmeikle/>
 * 
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace extensions\angular\views;

use core\views\TemplateView;

/**
 * the view for all HTML requests that are drawn from a group of templates.
 * 
 * @author Dave Meikle
 */
class AngularTemplateView extends TemplateView {

    /**
     * calls all the render methods
     */
    protected function renderView() {
       
        if(!array_key_exists('template', $this->config)) {
            throw new \exceptions\YamlKeyNotFoundException(__YML_KEY . ' template not set in views configuration');
        }
        
        $this->configureAngular();
        parent::renderView();
   
    }
    
    protected function configureAngular() {
  
        if(!array_key_exists('angular', $this->config) || !array_key_exists('bootstrap_modules', $this->config['angular'])) {
            echo 'returning';
            return;            
        }
       
        $moduleList = $this->data['modules'];
        if($moduleList == "''") {
            $moduleList = '';//lose the empty quotes
        }
        $modules = '';
        foreach($this->config['angular']['bootstrap_modules'] as $module) {
           
            $modules .= ",'$module'"; 
        }
        
        
        $this->data['modules'] = $moduleList . (strlen($moduleList) == 0) ? ltrim($modules, ',') : $modules;
       
    }

}
