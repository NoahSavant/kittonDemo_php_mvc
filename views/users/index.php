<?php
echo 'hello ' . $user->username . ' ' . $user->email . ' ';
echo '<div class="form-group">
<button class="d-block custom-button"><a href="index.php?controller=users&action=logout">Logout</a></button>
</div>';