<?php if (! defined('BASEPATH')) exit('No direct script access allowed');
	
class Videodetector_ext
{
    var $name           = 'WYGWAM/CKEditor Videodetector Plugin';
    var $version        = '1.0.1';
    var $description    = 'ExpressionEngine 3 Extension for adding CKEditor Video Detector Plugin to WYGWAM fields';
    var $docs_url       = 'https://github.com/panchesco/wygwam.videodetector/';
    var $settings_exist = 'n';
    
    private $_hooks = array(
        'wygwam_config',
        'wygwam_tb_groups'
    );

    public function activate_extension()
    {
        foreach ($this->_hooks as $hook)
        {
            ee()->db->insert('extensions', array(
                'class'    => get_class($this),
                'method'   => $hook,
                'hook'     => $hook,
                'settings' => '',
                'priority' => 10,
                'version'  => $this->version,
                'enabled'  => 'y'
            ));
        }
    }
    
    //-----------------------------------------------------------------------------

    public function update_extension($current = NULL)
    {
   
        return FALSE;
    }
    
    //-----------------------------------------------------------------------------

    public function disable_extension()
    {
        ee()->db->where('class', get_class($this))->delete('extensions');
    }

    //-----------------------------------------------------------------------------
    
     private static $_included_resources = FALSE;

	//-----------------------------------------------------------------------------
	
    public function wygwam_config($config, $settings)
    {
        
        if (($last_call = ee()->extensions->last_call) !== FALSE)
        {
            $config = $last_call;
        }
        
        // Check if our toolbar button has been added
        $include_btn = FALSE;

        foreach ($config['toolbar'] as $tbgroup)
        {
            if (in_array('videodetector', $tbgroup))
            {
                $include_btn = TRUE;
                break;
            }
        }
        
        if ($include_btn)
        {
            // Add our plugin to CKEditor
            if (!empty($config['extraPlugins']))
            {
                $config['extraPlugins'] .= ',';
            }

            $config['extraPlugins'] .= 'videodetector';

            $this->_include_resources();
        }

        return $config;
    }
    
    	//-----------------------------------------------------------------------------


    private function _include_resources()
    {
        // Is this the first time we've been called?
        if (!self::$_included_resources)
        {
            // Tell CKEditor where to find our plugin
            $plugin_url = URL_THIRD_THEMES.'ckeditor-plugins/videodetector/';
            ee()->cp->add_to_foot('<script type="text/javascript">CKEDITOR.plugins.addExternal("videodetector", "'.$plugin_url.'");</script>');

            // Don't do that again
            self::$_included_resources = TRUE;
        }
    }
    
    	//-----------------------------------------------------------------------------
    
    
    public function wygwam_tb_groups($tb_groups)
    {
       
        if (($last_call = ee()->extensions->last_call) !== FALSE)
        {
            $tb_groups = $last_call;
        }

        $tb_groups[] = array('VideoDetector');
        
        // Is this the toolbar editor?
        if (ee()->uri->segment(4)=='wygwam' && ee()->uri->segment(5)=='editConfig')
        {
            // Give our toolbar button an icon
            $icon_url = URL_THIRD_THEMES.'ckeditor-plugins/videodetector/icons/icon_black.png';
		  ee()->cp->add_to_head('<style type="text/css">.cke_button_icon.cke_button__videodetector_icon { background-image: url('.$icon_url.'); }</style>');
         
        }

        return $tb_groups;
    }
    
    	//-----------------------------------------------------------------------------
 
    
}
