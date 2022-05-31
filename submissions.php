<?php

require 'include.php';

$me = getAuthedUser();

if (isset($_POST['new_submission'])) {
    $url = sendToImgur($_FILES['picture']['tmp_name']);

    createSubmission($me->id, $_POST['theme'], $url);
}

if (isset($_POST['delete_submission'])) {
    deleteSubmission($me->id, $_POST['theme']);
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
                <form method="post">
                    <input
                        type="submit"
                        name="delete_submission"
                        value="Delete Submission"
                        onClick="return confirm('Are you sure you want to delete this submission?')"
                    >
                    <input type="hidden" name="theme" value="<?php e($submission->theme->id) ?>">
                </form>
            <?php endforeach ?>
            </ul>
        <?php endif ?>
    </body>
</html>
