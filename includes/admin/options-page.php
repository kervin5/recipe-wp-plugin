<?php
function r_plugin_opts_page(){
    $recipe_opts = get_option('r_opts');
	?>
	<div class="wrap">
        <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title"><?php _e('Recipe Settings', 'recipe' ); ?></h3>
            </div>
            <div class="panel-body">
                <?php
                    if(isset($_GET['status']) && $_GET['status'] == 1){
                        ?>
                        <div class="alert alert-success"> Options updated successfully!</div>
                        <?php
                    }
                ?>
                <form method="post" action="admin-post.php">
                    <input type="hidden" name="action" value="r_save_options">
                    <?php wp_nonce_field('r_options_verify');?>
                    <div class="form-group">
                        <label><?php _e('User login required for rating recipes', 'recipe'); ?></label>
                        <select class="form-control" name="r_rating_login_required">
                            <option value="1">No</option>
                            <option value="2" <?php echo $recipe_opts['rating_login_required'] == 2 ? "SELECTED" : '' ;?> >Yes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><?php _e('User login required for submitting recipes', 'recipe'); ?></label>
                        <select class="form-control" name="r_submission_login_required">
                            <option value="1">No</option>
                            <option value="2" <?php echo $recipe_opts['recipe_submission_login_required'] == 2 ? "SELECTED" : '' ;?> >Yes</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary"><?php _e('Update', 'recipe'); ?></button>
                    </div>
                </form>
            </div>
        </div>

    </div>
	<?php
}