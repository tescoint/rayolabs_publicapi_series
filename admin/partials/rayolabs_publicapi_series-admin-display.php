<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://facebook.com/tsal3
 * @since      1.0.0
 *
 * @package    Rayolabs_publicapi_series
 * @subpackage Rayolabs_publicapi_series/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<?php
        //Grab all options
        $options = get_option($this->plugin_name);

        // Cleanup
        if(!empty($options['site_token'])){
        $site_token = $options['site_token'];
         }
         if(!empty($options['post_type'])){
         $post_type = $options['post_type'];
         }
         if(!empty($options['categories'])){
         $categories = $options['categories'];
         }
     ?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>

    <form method="post" name="<?php echo $this->plugin_name; ?>" action="options.php">
    <?php settings_fields($this->plugin_name); ?>
        <!-- Enter Token Gotten From PublicApi  -->
        <fieldset>
            <legend class="screen-reader-text"><span>Site Token</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-site_token">
            	<span>Site Token:</span>
                <input type="text" id="<?php echo $this->plugin_name; ?>-site_token" name="<?php echo $this->plugin_name; ?>[site_token]" value="<?php if(!empty($site_token)){ echo $site_token; } ?>"/>
                <span><?php esc_attr_e('Enter Site Token Gotten From https://publicapi.org.ng', $this->plugin_name); ?></span>
            </label>
        </fieldset>
        <?php if(!empty($site_token)){?>
        <!-- Post Type -->
        <fieldset>
            <legend class="screen-reader-text"><span>Post Type:</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-post_type">
            <span>Post Type:</span>
            <select id="<?php echo $this->plugin_name; ?>-post_type" name="<?php echo $this->plugin_name; ?>[post_type]">
            	<option <?php if($post_type == 'wd'){echo "selected";} ?> value="wd">Watch and Download</option>
            	<option <?php if($post_type == 'do'){echo "selected";} ?> value="do">Download Only</option>
            </select>
                <span><?php esc_attr_e('Should The series posted be watchable or only download libk should be posted', $this->plugin_name); ?></span>
            </label>
        </fieldset>
         <!-- Create Categories Or Not -->
        <fieldset>
            <legend class="screen-reader-text"><span>Create Non-Existing Categories With Series Name:</span></legend>
            <label for="<?php echo $this->plugin_name; ?>-categories">
            <span>Create Non-Existing Categories:</span>
            <select id="<?php echo $this->plugin_name; ?>-categories" name="<?php echo $this->plugin_name; ?>[categories]">
                <option <?php if($categories == 'yes'){echo "selected";} ?> value="yes">Yes</option>
                <option <?php if($categories == 'no'){echo "selected";} ?> value="no">No</option>
            </select>
                <span><?php esc_attr_e('Should Non-Existing Categories be created automatically', $this->plugin_name); ?></span>
            </label>
        </fieldset>
        <?php }?>


        

        <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>

    </form>

</div>
