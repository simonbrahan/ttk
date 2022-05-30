<?php

require 'include.php';

if (isset($_POST['new_theme'])) {
    createTheme($_POST['user'], $_POST['theme_name']);
}

$all_themes = getAllThemes();

?>
<DOCTYPE html>
<html>
    <head>
        <title>Through The Keyhole</title>
    </head>
    <body>
        <h1>Create a new theme</h1>
        <form method="post">
            <select name="user">
                <?php foreach (getAllUsers() as $user) : ?>
                <option value="<?php e($user->id) ?>"><?php e($user->name) ?></option>
                <?php endforeach ?>
            </select>
            <br>
            <label>
                Enter theme name
                <input type="text" name="theme_name" maxlength="255">
            </label>
            <br>
            <input type="submit" name="new_theme">
        </form>
        <?php if (empty($all_themes)) : ?>
        <p>There are no themes yet</p>
        <?php else : ?>
        <ul>
            <?php foreach ($all_themes as $theme) : ?>
            <li><?php e($theme->name) ?> - by <?php e($theme->creator) ?></li>
            <?php endforeach ?>
        </ul>
        <?php endif ?>
    </body>
</html>
