<?php

require 'include.php';

$me = getAuthedUser();

if (isset($_POST['new_submission'])) {
    $url = sendToImgur($_FILES['picture']['tmp_name']);

    createSubmission(1, $_POST['theme'], $url);
}

$my_submissions = getSubmissionsForUser($me->id);
$my_unsubmitted_themes = getUnsubmittedThemesForUser($me->id);

?>
<DOCTYPE html>
<html>
    <head>
        <title>My Submissions - Through The Keyhole</title>
    </head>
    <body>
        <pre><?php var_dump($my_unsubmitted_themes) ?></pre>
        <h1>New Submission</h1>
        <?php if (empty($my_unsubmitted_themes)) : ?>
            <p>There are no themes left for you to submit</p>
        <?php else : ?>
        <form method="post" enctype="multipart/form-data">
            <select name="theme">
                <?php foreach ($my_unsubmitted_themes as $theme) : ?>
                <option value="<?php e($theme->id) ?>"><?php e($theme->name) ?></option>
                <?php endforeach ?>
            </select>
            <br>
            <input type="file" name="picture">
            <br>
            <input type="submit" name="new_submission">
        </form>
        <?php endif ?>
        <h1>My Submissions</h1>
        <?php if (empty($my_submissions)) : ?>
            <p>You have no submissions yet</p>
        <?php else : ?>
            <ul>
            <?php foreach ($my_submissions as $submission) : ?>
                <li>
                    <p>Submission for theme: <em><?php e($submission->theme->name) ?></em></p>
                    <img src="<?php e($submission->url) ?>">
                </li>
            <?php endforeach ?>
            </ul>
        <?php endif ?>
    </body>
</html>
