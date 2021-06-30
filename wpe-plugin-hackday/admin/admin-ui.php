<h1>cache plugin settings</h2>

<form method="post" name="options" action="<?php echo get_admin_url()."admin-post.php" ?>">

  <input type='hidden' name='action' value='submit-hack-form' />
  <input type='hidden' name='hide' value='$ques' />

<input type="submit" name="purge-all" value="Purge Object Cache" class="button-primary" onclick="return confirm('Please be patient, this sometimes takes a while.');"/> This will purge the object cache (probably)
</form>