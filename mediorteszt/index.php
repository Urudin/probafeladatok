<?php

include('constants.php');
include('Database.php');
include('DatabaseUsers.php');
include('DatabaseGroups.php');

$db = new Database(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);

$users = new DatabaseUsers();
if (isset($_POST['firstname']) && isset($_POST['lastname'])) {
    $users->insert($_POST['firstname'], $_POST['lastname'], $_POST['email']);
}

$user_ids = [];
echo '<h2>USERS</h2><br />';
foreach ($users->all() as $user) {
    $user_ids[] = $user['id'];
    echo $user['id'] . ' | ' . $user['firstname'] . ' ' . $user['lastname'] . '<br />';
}

echo '<h2>GROUPS</h2><br />';
$groups = new DatabaseGroups();
if (isset($_POST['group_name']) && isset($_POST['group_code'])) {
    $groups->insert($_POST['group_name'], $_POST['group_code']);
}

$group_ids = [];
foreach ($groups->all() as $group) {
    $group_ids[] = $group['id'];
    echo $group['id'] . ' | ' . $group['group_name'] . '(' . $group['group_code'] . ')' . '<br />';
}

$random_group_key = array_rand($group_ids, 1);

echo '<h2>RANDOM GROUP</h2><br />';
var_dump($groups->find($group_ids[$random_group_key]));

$random_user_key = array_rand($user_ids, 1);
var_dump($random_user_key);
echo '<h2>RANDOM USER</h2><br />';
var_dump($users->find($user_ids[$random_user_key]));

$db->close();

?>

<h1>Add User</h1>
<form action="/" method="post">
    <label for="firstname">Firstname</label>
    <input type="text" id="firstname" name="firstname">
    <label for="lastname">Lastname</label>
    <input type="text" id="lastname" name="lastname">
    <label for="email">E-mail</label>
    <input type="text" id="email" name="email">
    <button type="submit">Save</button>
</form>

<h1>Add Group</h1>
<form action="/" method="post">
    <label for="group_name">Group Name</label>
    <input type="text" id="group_name" name="group_name">
    <label for="lastname">Group Code</label>
    <input type="text" id="group_code" name="group_code">
    <button type="submit">Save</button>
</form>
