<!DOCTYPE html>
<html>
<head>
    <title>PHP Teszt Feladat</title>
</head>
<body>
<h1>Teszt Feladat</h1>
<p>Szabó Patrik, 1994.08.10</p>

<?php

include('constants.php');
include('Database.php');
include('DatabaseUsers.php');
include('DatabaseGroups.php');
include('functions.php');

$db = new Database(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);

$users = new DatabaseUsers();
$groups = new DatabaseGroups();

$user_ids = [];
$all_groups = $groups->all();
$matches = initMatches($all_groups);

echo '<h3>Felhasználók</h3><br />';

foreach ($users->all() as $user) {
    $user_ids[] = $user['id'];
    $group = matchUserToGroup($user['firstname'] . '' . $user['lastname'], $all_groups, $matches);
    echo $user['id'] . ' | ' . $user['firstname'] . ' ' . $user['lastname'] . '(' . $group['group_code'] . ')' . '<br />';
}

$group_ids = [];
foreach ($groups->all() as $group) {
    $group_ids[] = $group['id'];
}

$random_group_key = array_rand($group_ids, 1);

echo '<h2>RANDOM GROUP</h2>';
echo '<p>' . $groups->find($group_ids[$random_group_key])['group_name'] . '</p>';

$random_user_key = array_rand($user_ids, 1);
echo '<h2>RANDOM USER</h2>';
$user = $users->find($user_ids[$random_user_key]);
echo '<p>' . $user['firstname'] . ' ' . $user['lastname']  . '</p>';

$db->close();

?>
<a href="http://lpsolutions.hu">L&P Solutions</a>
</body>
</html>
