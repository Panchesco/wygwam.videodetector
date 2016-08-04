#Videodetector
ExpressionEngine 3 Extension for using the CKEditor VideoDetector plugin with WYGWAM fields.

## Requirements
 - [ExpressionEngine 3](https://ellislab.com/expressionengine)
 - [WYGWAM](https://devot-ee.com/add-ons/wygwam)

##Installation

1. Download the CKEditor [Videodetector plugin](http://ckeditor.com/addon/videodetector)
2. Unzip the plugin to /themes/user/wygwam/lib/ckeditor/plugins/videodetector
3. Download this EE extension to /system/user/addons/ and activate it in the Add-on manager.

## Configuration
1. Navigate to Add-On Manager / Wygwam / Edit Configurition / MyWYGWAM 
2. Under "Customize the Toolbar" add the VideoDetector icon (the play symbol in a circle).
3. Under "Advanced Settings", add videodetector to extraPlugins after selecting that option.

<figure>
	<img src="http://panchesco.com/media/mywygwam-videodetector-config.png" alt="WYGWAM field configuration">
</figure>

## Usage
Once the VideoDetector has been added to the custom field toolbar configuration, you can add a player to WYGWAM fields by clicking on the VideoDetector icon and providing a YouTube, Vimeo, or DailyMotion URL in the pop-up dialag.

The player is already fluid in the control panel WYGWAM field. If you'd like it to be fluid to its parent container when rendered in your template, add the following CSS to your stylesheet: 
```
.videodetector {
  height: 0;
  overflow: hidden;
  padding-bottom: 56.25%; // For ratio 16:9. 75% if ratio is 4:3
  position: relative;
}

.videodetector embed,
.videodetector object,
.videodetector iframe {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
}
```

More information about styling fluid width media players that fit their parent container at [CSS-Tricks](https://css-tricks.com/NetMag/FluidWidthVideo/Article-FluidWidthVideo.php).







