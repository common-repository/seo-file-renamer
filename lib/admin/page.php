<?php

if ( !defined('ABSPATH') ){ exit; }

$options = get_option( 'wp_seo_file_renamer_settings' );
$name = isset( $options['name'] ) && $options['name'] ? esc_attr( $options['name'] ) : 0;

?>
<div id="sfr-settings">
    <div class="wp-seo-file-renamer-group">
        <form method="post" action="options.php">        
            <input type="hidden" name="reset" id="reset-option" value="" />
            <input type="hidden" name="import" id="import" value="" />
            <?php settings_fields( 'wp_seo_file_renamer_settings' ); ?>
            <div class="wp-seo-file-renamer-title wdes-table">
                <span class="wdes-cell">				
				    <img src="<?php echo plugin_dir_url( __FILE__ ) . '/images/seo-renamer-icon.png'; ?>" style="margin-right:5px;vertical-align: middle;" alt="<?php _e( 'SEO File Renamer', 'seo-file-renamer' ); ?>" />
				    <strong style=" vertical-align: middle; "><?php _e( 'SEO File Renamer', 'seo-file-renamer' ); ?></strong>
                </span>
                <span class="align-right wdes-cell"></span>
            </div>
            <div class="wdes-toggle-content-first">
                <div class="wdes-table ">
                    <div class="wdes-cell h4"><?php _e( 'Capitalization Settings', 'seo-file-renamer' ); ?></div>
                    <div class="">
                        <input type="checkbox" name="wp_seo_file_renamer_settings[name]" id="responsive-mobile-menu" class="wp-seo-file-renamer on-off" data-class="" value="1" <?php checked( $name, 1 ); ?>><i><?php _e( 'Enable to allow Capital letters then Save Changes', 'seo-file-renamer' ); ?></i>
                    </div>
                </div>
            </div>
            <div class="wdes-table wp-seo-file-renamer-footer">
                <div class="submit-wrap align-left wdes-cell"></div>
                <div class="author wdes-center wdes-cell"></div>
                <div class="submit-wrap align-right wdes-cell">
                    <input name="submit" id="submit" class="transition button" value="<?php _e( 'Save Changes', 'seo-file-renamer' ); ?>" type="submit">
                </div>
            </div>
        </form>
    </div>
</div>